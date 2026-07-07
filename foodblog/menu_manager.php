<?php
/**
 * menu_manager.php  –  PAGE 4: Database-driven Menu Manager
 *
 * Database Operations (all 4 required):
 *  - SELECT:  Display all products by category        ✓
 *  - INSERT:  Add a new product                       ✓
 *  - DELETE:  Remove a product                        ✓
 *  - UPDATE:  Edit product name & price               ✓
 *  - ORDER BY: Sort ASC and DESC                      ✓
 *
 * PHP techniques used:
 *  - for loop, associative array, nested if/else,
 *    include, input validation, prepared statements
 */

$pageTitle = 'Menu Manager';
// include 'includes/db_connect.php': pastes db_connect.php's code here
// This sets up $conn (the database connection object) for use on this page
include 'includes/db_connect.php';

// ============================================================
// Process POST Actions (runs BEFORE outputting any HTML)
// POST requests come from the form submissions on this page
// ============================================================
$feedback     = '';        // Will hold success/error message text
$feedbackType = 'success'; // Default feedback type (used for CSS class)

// isset() checks if a POST variable exists and is not null
// $_POST is a PHP superglobal - an associative array of all POST data sent to this page
if (isset($_POST['action'])) {

    // ── ADD product (INSERT) ──
    if ($_POST['action'] === 'add') {
        // intval() converts to integer - strips non-numeric characters
        // This is input sanitisation: prevents SQL injection for numeric fields
        $categoryID  = intval($_POST['categoryID'] ?? 0);
        // ?? 0 = null coalescing: if $_POST['categoryID'] is not set, use 0

        // trim() removes leading/trailing whitespace from user input
        // htmlspecialchars() converts HTML special chars to entities for display safety
        // ENT_QUOTES converts both single and double quotes
        $productCode = trim(htmlspecialchars($_POST['productCode'] ?? '', ENT_QUOTES));
        $productName = trim(htmlspecialchars($_POST['productName'] ?? '', ENT_QUOTES));
        $listPrice   = floatval($_POST['listPrice'] ?? 0);
        // floatval() converts to a floating-point decimal number

        // NESTED IF/ELSE VALIDATION (requirement: nested if/else)
        // Each condition is checked in order; first failure sets error and stops
        if ($categoryID <= 0) {
            $feedback     = 'Please select a valid category.';
            $feedbackType = 'error';
        } elseif (strlen($productCode) < 2) {
            // strlen() returns the number of characters in a string
            $feedback     = 'Product code must be at least 2 characters.';
            $feedbackType = 'error';
        } elseif (strlen($productName) < 2) {
            $feedback     = 'Product name must be at least 2 characters.';
            $feedbackType = 'error';
        } elseif ($listPrice <= 0) {
            $feedback     = 'Please enter a valid price greater than 0.';
            $feedbackType = 'error';
        } else {
            // PREPARED STATEMENT for security (prevents SQL injection)
            // ? = placeholder - the value is bound separately, never inserted raw into SQL
            $checkStmt = $conn->prepare(
                "SELECT productID FROM Products WHERE productCode = ?"
            );
            // bind_param('s', $productCode): 's' = string type, binds $productCode to ?
            $checkStmt->bind_param('s', $productCode);
            $checkStmt->execute(); // Runs the query
            $checkStmt->store_result(); // Fetches result metadata

            if ($checkStmt->num_rows > 0) {
                // Product code already exists - reject duplicate
                $feedback     = 'Product code already exists. Please use a unique code.';
                $feedbackType = 'error';
            } else {
                // INSERT: adds a new row to the Products table
                $stmt = $conn->prepare(
                    "INSERT INTO Products (categoryID, productCode, productName, listPrice)
                     VALUES (?, ?, ?, ?)"
                );
                // 'issd' = bind types: i=integer, s=string, s=string, d=double(decimal)
                $stmt->bind_param('issd', $categoryID, $productCode, $productName, $listPrice);
                if ($stmt->execute()) {
                    $feedback = 'Menu item "' . htmlspecialchars($productName) . '" added!';
                } else {
                    $feedback     = 'Database error: ' . htmlspecialchars($conn->error);
                    $feedbackType = 'error';
                }
                $stmt->close(); // Free the prepared statement resources
            }
            $checkStmt->close();
        }
    }

    // ── DELETE product ──
    if ($_POST['action'] === 'delete') {
        $productID = intval($_POST['productID'] ?? 0);
        if ($productID > 0) {
            // DELETE: removes a row from Products table matching the productID
            $stmt = $conn->prepare("DELETE FROM Products WHERE productID = ?");
            $stmt->bind_param('i', $productID); // 'i' = integer type
            if ($stmt->execute() && $stmt->affected_rows > 0) {
                // affected_rows: number of rows actually changed by the query
                $feedback = 'Menu item deleted successfully.';
            } else {
                $feedback     = 'Item not found or could not be deleted.';
                $feedbackType = 'error';
            }
            $stmt->close();
        } else {
            $feedback     = 'Invalid product ID.';
            $feedbackType = 'error';
        }
    }

    // ── MODIFY product (UPDATE) ──
    if ($_POST['action'] === 'modify') {
        $productID   = intval($_POST['productID'] ?? 0);
        $productName = trim(htmlspecialchars($_POST['productName'] ?? '', ENT_QUOTES));
        $listPrice   = floatval($_POST['listPrice'] ?? 0);

        // Nested if/else validation for modify
        if ($productID <= 0) {
            $feedback = 'Invalid product ID.'; $feedbackType = 'error';
        } elseif (strlen($productName) < 2) {
            $feedback = 'Product name must be at least 2 characters.'; $feedbackType = 'error';
        } elseif ($listPrice <= 0) {
            $feedback = 'Please enter a valid price greater than 0.'; $feedbackType = 'error';
        } else {
            // UPDATE: modifies an existing row in the Products table
            $stmt = $conn->prepare(
                "UPDATE Products SET productName = ?, listPrice = ? WHERE productID = ?"
            );
            // 'sdi': s=string(name), d=double(price), i=integer(id)
            $stmt->bind_param('sdi', $productName, $listPrice, $productID);
            if ($stmt->execute() && $stmt->affected_rows > 0) {
                $feedback = 'Menu item updated to "' . htmlspecialchars($productName) . '"!';
            } else {
                $feedback     = 'No changes made or item not found.';
                $feedbackType = 'error';
            }
            $stmt->close();
        }
    }
}

// ============================================================
// Determine sort order for ORDER BY clause (SORT operation)
// $_GET is the superglobal for URL query string parameters
// e.g. menu_manager.php?sort=DESC sets $_GET['sort'] = 'DESC'
// ============================================================
$sortOrder = 'ASC'; // Default: A to Z
if (isset($_GET['sort'])) {
    // Whitelist: only allow 'ASC' or 'DESC' - never use raw GET values in SQL
    $sortOrder = strtoupper($_GET['sort']) === 'DESC' ? 'DESC' : 'ASC';
    // strtoupper() converts to uppercase so 'desc', 'Desc', 'DESC' all work
}

// Determine active category from URL: menu_manager.php?cat=2
$activeCatID = isset($_GET['cat']) ? intval($_GET['cat']) : 0;

// ============================================================
// Fetch all categories (SELECT query)
// ============================================================
$categories = []; // Initialise empty array - will be populated from DB
$catResult = $conn->query(
    "SELECT categoryID, categoryName FROM Categories ORDER BY categoryID ASC"
);
// query() executes a simple SQL statement and returns a result set
if ($catResult) {
    // fetch_assoc() returns the next row as an associative array
    // e.g. ['categoryID' => 1, 'categoryName' => 'Breakfast']
    while ($row = $catResult->fetch_assoc()) {
        $categories[] = $row; // [] appends to the array
    }
    $catResult->free(); // Release memory used by result set
}

// Default to first category if none specified in URL
if ($activeCatID <= 0 && count($categories) > 0) {
    // count() returns the number of elements in an array
    $activeCatID = $categories[0]['categoryID'];
    // [0] accesses the first element, ['categoryID'] gets the id value
}

// ============================================================
// Fetch products for active category (SELECT + ORDER BY = SORT)
// ============================================================
$products = []; // Array to hold the product rows
if ($activeCatID > 0) {
    // Prepared statement with two dynamic values: categoryID and sort order
    // NOTE: $sortOrder is safe to concatenate because it was whitelisted above
    // (only 'ASC' or 'DESC' can reach this point)
    $stmt = $conn->prepare(
        "SELECT p.productID, p.productCode, p.productName, p.listPrice, c.categoryName
         FROM Products p
         JOIN Categories c ON p.categoryID = c.categoryID
         WHERE p.categoryID = ?
         ORDER BY p.productName " . $sortOrder
        // JOIN: combines rows from Products and Categories where categoryID matches
        // p. prefix = alias for Products table  |  c. prefix = alias for Categories table
    );
    $stmt->bind_param('i', $activeCatID);
    $stmt->execute();
    $result = $stmt->get_result(); // Returns a result object from a prepared statement

    // ARRAY population using while loop (Requirement: loop + array)
    while ($row = $result->fetch_assoc()) {
        $products[] = $row; // Build the $products array row by row
    }
    $stmt->close();
}

// Get the name of the active category for display
$activeCatName = '';
// foreach loop through categories to find the matching name
foreach ($categories as $cat) {
    if ($cat['categoryID'] === $activeCatID) {
        $activeCatName = $cat['categoryName'];
        break; // break exits the loop as soon as we find the match
    }
}

// Fetch product data for the modify form (pre-populate fields)
$modifyProduct = null; // null = no product selected for modification
if (isset($_GET['modify'])) {
    $modID = intval($_GET['modify']);
    $modStmt = $conn->prepare("SELECT * FROM Products WHERE productID = ?");
    // SELECT * = selects all columns from the row
    $modStmt->bind_param('i', $modID);
    $modStmt->execute();
    $modResult = $modStmt->get_result();
    $modifyProduct = $modResult->fetch_assoc(); // Returns one row or null if not found
    $modStmt->close();
}

// NOW include header.php (after all DB operations so any redirect/die works correctly)
include 'includes/header.php';
?>

<!-- Page Hero -->
<div class="page-hero" aria-labelledby="mm-page-title">
    <div class="container">
        <nav aria-label="Breadcrumb navigation">
            <ol class="breadcrumb breadcrumb-fork">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Menu Manager</li>
            </ol>
        </nav>
        <h1 id="mm-page-title">
            <i class="bi bi-database" aria-hidden="true"></i> Menu Manager
        </h1>
        <p>Database-driven food menu management – add, edit, delete, and sort items.</p>
    </div>
</div>

<section class="section-pad" aria-labelledby="manager-heading">
    <div class="container">
        <h2 class="visually-hidden" id="manager-heading">Menu Manager Database Interface</h2>

        <!-- PHP feedback message from DB operations
             Shown only if $feedback is not empty string -->
        <?php if ($feedback !== ''): ?>
        <div class="alert alert-<?= ($feedbackType === 'success') ? 'success' : 'danger' ?>
                    d-flex align-items-center gap-2 mb-4"
             role="alert" aria-live="polite">
            <!-- Ternary operator chooses icon based on feedback type -->
            <i class="bi <?= ($feedbackType === 'success')
                ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill' ?>"
               aria-hidden="true"></i>
            <?= htmlspecialchars($feedback) ?>
        </div>
        <?php endif; // ends the if block for feedback display ?>

        <!-- MODIFY FORM (shown only when ?modify=ID is in the URL) -->
        <?php if ($modifyProduct !== null): ?>
        <div class="manager-panel mb-4" id="modify-panel">
            <div class="manager-header">
                <i class="bi bi-pencil-square" aria-hidden="true"></i> Modify Menu Item
            </div>
            <div class="manager-body">
                <!-- action URL preserves current category and sort in query string
                     so after saving, user returns to the same view -->
                <form method="POST"
                      action="menu_manager.php?cat=<?= $activeCatID ?>&sort=<?= $sortOrder ?>"
                      class="form-fork" novalidate aria-label="Modify menu item form">
                    <!-- type="hidden": not visible but sends the action value with form
                         The server reads $_POST['action'] to know what operation to perform -->
                    <input type="hidden" name="action"    value="modify">
                    <input type="hidden" name="productID"
                           value="<?= intval($modifyProduct['productID']) ?>">
                    <div class="row g-3 align-items-end">
                        <div class="col-sm-6">
                            <label class="form-label" for="mod-name">Product Name</label>
                            <!-- value="..." pre-populates the field with current product name
                                 This is the "pre-populate modify form" pattern -->
                            <input type="text" id="mod-name" name="productName"
                                   class="form-control"
                                   value="<?= htmlspecialchars($modifyProduct['productName']) ?>"
                                   required aria-required="true">
                        </div>
                        <div class="col-sm-3">
                            <label class="form-label" for="mod-price">List Price ($)</label>
                            <input type="number" id="mod-price" name="listPrice"
                                   class="form-control"
                                   value="<?= htmlspecialchars($modifyProduct['listPrice']) ?>"
                                   step="0.01" min="0.01" required aria-required="true">
                        </div>
                        <div class="col-sm-3 d-flex gap-2">
                            <button type="submit" class="btn-fork"
                                    aria-label="Save changes">
                                <i class="bi bi-check2" aria-hidden="true"></i> Save
                            </button>
                            <!-- Cancel link removes the ?modify= parameter from URL -->
                            <a href="menu_manager.php?cat=<?= $activeCatID ?>&sort=<?= $sortOrder ?>"
                               class="btn-fork-outline" aria-label="Cancel modification">
                                Cancel
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php endif; ?>

        <!-- Main Manager Panel: Category Sidebar + Product Table -->
        <div class="row g-4">

            <!-- ── Category Sidebar (left column) ── -->
            <div class="col-lg-3">
                <div class="manager-panel">
                    <div class="manager-header">
                        <i class="bi bi-grid-3x3-gap" aria-hidden="true"></i> Categories
                    </div>
                    <div class="manager-body" style="padding:1rem;">
                        <nav aria-label="Category navigation">
                            <ul class="category-nav" role="list">
                                <!-- PHP foreach loop renders one link per category -->
                                <?php foreach ($categories as $cat): ?>
                                <li>
                                    <!-- Each category link sets ?cat= in the URL
                                         PHP reads this on the next page load to filter products -->
                                    <a href="menu_manager.php?cat=<?= $cat['categoryID'] ?>&sort=<?= $sortOrder ?>"
                                       class="<?= ($cat['categoryID'] === $activeCatID) ? 'active' : '' ?>"
                                       aria-current="<?= ($cat['categoryID'] === $activeCatID) ? 'page' : 'false' ?>">
                                        <?= htmlspecialchars($cat['categoryName']) ?>
                                    </a>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- ── Product Table + Controls (right column) ── -->
            <div class="col-lg-9">
                <div class="manager-panel">
                    <div class="manager-header d-flex justify-content-between
                                align-items-center flex-wrap gap-2">
                        <span>
                            <i class="bi bi-list-ul" aria-hidden="true"></i>
                            <?= htmlspecialchars($activeCatName) ?> Menu Items
                        </span>
                        <!-- count() returns number of items in $products array -->
                        <span style="font-size:0.8rem;color:#aaa;">
                            <?= count($products) ?> item<?= count($products) !== 1 ? 's' : '' ?>
                        </span>
                    </div>
                    <div class="manager-body">

                        <!-- Sort Controls (SORT operation - ORDER BY ASC/DESC) -->
                        <div class="d-flex gap-2 mb-3 flex-wrap"
                             role="group" aria-label="Sort menu items">
                            <!-- Clicking these links changes ?sort= in the URL
                                 PHP re-queries the DB with the new sort order on page reload -->
                            <a href="menu_manager.php?cat=<?= $activeCatID ?>&sort=ASC"
                               class="btn-fork <?= $sortOrder === 'ASC' ? '' : 'btn-fork-outline' ?>"
                               style="font-size:0.82rem;padding:7px 16px;"
                               aria-pressed="<?= $sortOrder === 'ASC' ? 'true' : 'false' ?>">
                                <i class="bi bi-sort-alpha-down" aria-hidden="true"></i> Sort A–Z
                            </a>
                            <a href="menu_manager.php?cat=<?= $activeCatID ?>&sort=DESC"
                               class="btn-fork <?= $sortOrder === 'DESC' ? '' : 'btn-fork-outline' ?>"
                               style="font-size:0.82rem;padding:7px 16px;"
                               aria-pressed="<?= $sortOrder === 'DESC' ? 'true' : 'false' ?>">
                                <i class="bi bi-sort-alpha-down-alt" aria-hidden="true"></i> Sort Z–A
                            </a>
                            <!-- Add Item toggle button - JS in main.js shows/hides the form -->
                            <button id="btn-show-add" class="btn-fork-outline ms-auto"
                                    style="font-size:0.82rem;padding:7px 16px;"
                                    aria-expanded="false" aria-controls="add-form-wrapper">
                                <i class="bi bi-plus-circle" aria-hidden="true"></i> Add Menu Item
                            </button>
                        </div>

                        <!-- ADD FORM (hidden by default, shown by JS toggle) -->
                        <div id="add-form-wrapper" style="display:none;">
                            <div class="p-3 mb-3 rounded-3"
                                 style="background:#F9F6F2;border:1.5px dashed #DDD;">
                                <h3 style="font-size:1rem;margin-bottom:1rem;">
                                    Add New Menu Item
                                </h3>
                                <!-- method="POST": form data sent in request body (not URL)
                                     action: where the form submits to (this same page) -->
                                <form method="POST"
                                      action="menu_manager.php?cat=<?= $activeCatID ?>&sort=<?= $sortOrder ?>"
                                      class="form-fork" novalidate>
                                    <input type="hidden" name="action" value="add">
                                    <div class="row g-3">
                                        <div class="col-sm-6 col-md-3">
                                            <label for="add-cat" class="form-label">Category</label>
                                            <select id="add-cat" name="categoryID"
                                                    class="form-select" required>
                                                <option value="">Select…</option>
                                                <?php foreach ($categories as $cat): ?>
                                                <option value="<?= $cat['categoryID'] ?>"
                                                    <?= ($cat['categoryID'] === $activeCatID)
                                                        ? 'selected' : '' ?>>
                                                    <!-- selected attribute pre-selects the
                                                         currently active category -->
                                                    <?= htmlspecialchars($cat['categoryName']) ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6 col-md-2">
                                            <label for="add-code" class="form-label">Code</label>
                                            <!-- maxlength="20" = HTML attribute limiting input length -->
                                            <input type="text" id="add-code" name="productCode"
                                                   class="form-control" placeholder="e.g. BRK005"
                                                   required maxlength="20">
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <label for="add-name" class="form-label">Product Name</label>
                                            <input type="text" id="add-name" name="productName"
                                                   class="form-control"
                                                   placeholder="e.g. Sourdough French Toast"
                                                   required>
                                        </div>
                                        <div class="col-sm-6 col-md-2">
                                            <label for="add-price" class="form-label">Price ($)</label>
                                            <!-- step="0.01" allows cents (2 decimal places)
                                                 min="0.01" prevents zero or negative prices -->
                                            <input type="number" id="add-price" name="listPrice"
                                                   class="form-control" placeholder="0.00"
                                                   step="0.01" min="0.01" required>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn-fork">
                                                <i class="bi bi-plus" aria-hidden="true"></i>
                                                Add Item
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- PRODUCTS TABLE (SELECT result display) -->
                        <?php if (count($products) === 0): ?>
                        <div class="text-center py-4" role="status">
                            <i class="bi bi-inbox"
                               style="font-size:2.5rem;color:#ccc;" aria-hidden="true"></i>
                            <p style="color:#aaa;margin-top:0.5rem;">
                                No items in this category yet. Add one above.
                            </p>
                        </div>
                        <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-fork table-hover" role="table"
                                   aria-label="<?= htmlspecialchars($activeCatName) ?> menu items">
                                <thead>
                                    <tr>
                                        <th scope="col">Code</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // FOR LOOP (Requirement: for loop) to iterate $products array
                                    // $i = index, count($products) = total items
                                    for ($i = 0; $i < count($products); $i++):
                                        $p = $products[$i]; // Access current product by index
                                    ?>
                                    <tr>
                                        <!-- <code> = semantic inline code text, shown in monospace -->
                                        <td><code><?= htmlspecialchars($p['productCode']) ?></code></td>
                                        <td><strong><?= htmlspecialchars($p['productName']) ?></strong></td>
                                        <!-- number_format($p['listPrice'], 2) = formats decimal
                                             to always show 2 decimal places e.g. 12.00 not 12 -->
                                        <td>$<?= number_format($p['listPrice'], 2) ?></td>
                                        <td>
                                            <!-- MODIFY: links to same page with ?modify=ID
                                                 PHP detects this and pre-populates modify form -->
                                            <a href="menu_manager.php?cat=<?= $activeCatID ?>&sort=<?= $sortOrder ?>&modify=<?= intval($p['productID']) ?>#modify-panel"
                                               class="action-btn btn-modify me-1"
                                               aria-label="Modify <?= htmlspecialchars($p['productName']) ?>">
                                                Modify
                                            </a>
                                            <!-- DELETE: a form that POSTs with action=delete
                                                 onclick confirm() shows a browser dialog
                                                 addslashes() escapes quotes in the JS string -->
                                            <form method="POST"
                                                  action="menu_manager.php?cat=<?= $activeCatID ?>&sort=<?= $sortOrder ?>"
                                                  style="display:inline;">
                                                <input type="hidden" name="action" value="delete">
                                                <input type="hidden" name="productID"
                                                       value="<?= intval($p['productID']) ?>">
                                                <button type="submit"
                                                        class="action-btn btn-delete"
                                                        onclick="return confirm('Delete \'<?= addslashes(htmlspecialchars($p['productName'])) ?>\'? This cannot be undone.');">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endfor; // end of for loop ?>
                                </tbody>
                            </table>
                        </div>
                        <p style="font-size:0.8rem;color:#aaa;margin-top:0.5rem;">
                            Showing <?= count($products) ?> item(s) in
                            <strong><?= htmlspecialchars($activeCatName) ?></strong>,
                            sorted <?= $sortOrder === 'ASC' ? 'A–Z' : 'Z–A' ?>.
                        </p>
                        <?php endif; ?>

                    </div><!-- /manager-body -->
                </div><!-- /manager-panel -->
            </div><!-- /col-lg-9 -->
        </div><!-- /row -->

        <!-- ALL PRODUCTS OVERVIEW (data structure: associative array grouped by category) -->
        <div class="mt-5">
            <h3 class="section-title" id="all-products-heading">All Menu Items Overview</h3>
            <p class="section-subtitle">Complete product listing across all categories</p>
            <?php
            // Fetch all products joined with their category names
            // ORDER BY c.categoryID puts Breakfast, Mains, Desserts in consistent order
            $allResult = $conn->query(
                "SELECT p.productID, p.productCode, p.productName, p.listPrice,
                        c.categoryName, c.categoryID
                 FROM Products p
                 JOIN Categories c ON p.categoryID = c.categoryID
                 ORDER BY c.categoryID ASC, p.productName ASC"
            );
            // DATA STRUCTURE: associative array grouped by category name
            // $allProducts['Breakfast'] = [ [...row1...], [...row2...], ... ]
            // $allProducts['Mains']     = [ [...row1...], [...row2...], ... ]
            $allProducts = [];
            if ($allResult) {
                while ($row = $allResult->fetch_assoc()) {
                    // $row['categoryName'] = 'Breakfast', 'Mains', or 'Desserts'
                    // [] at end appends to that category's sub-array
                    $allProducts[$row['categoryName']][] = $row;
                }
                $allResult->free(); // Free result memory
            }
            ?>
            <?php if (!empty($allProducts)): ?>
            <!-- foreach over the grouped array: $catName = category, $items = products array -->
            <?php foreach ($allProducts as $catName => $items): ?>
            <div class="mb-4">
                <h4 style="font-size:1rem;color:#555;font-weight:600;margin-bottom:0.75rem;">
                    <span class="badge-category badge-<?= strtolower($catName) ?>">
                        <?= htmlspecialchars($catName) ?>
                    </span>
                </h4>
                <div class="table-responsive">
                    <table class="table table-fork table-sm"
                           aria-label="<?= htmlspecialchars($catName) ?> menu items">
                        <!-- table-sm = Bootstrap: compact table with less padding -->
                        <thead>
                            <tr>
                                <th scope="col">Code</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $item): ?>
                            <tr>
                                <td><code><?= htmlspecialchars($item['productCode']) ?></code></td>
                                <td><?= htmlspecialchars($item['productName']) ?></td>
                                <td>$<?= number_format($item['listPrice'], 2) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endforeach; ?>
            <?php else: ?>
            <p style="color:#aaa;">No products found. Please run the database setup SQL script.</p>
            <?php endif; ?>
        </div>

    </div><!-- /container -->
</section>

<?php
// Close the database connection - good practice to free resources
$conn->close();
include 'includes/footer.php';
?>
