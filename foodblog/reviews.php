<?php
/**
 * reviews.php  –  PAGE 2: Food Reviews
 * Requirements: Table (4+ rows), ordered list, external link, image with alt text
 */
$pageTitle = 'Food Reviews';
include 'includes/header.php';
?>

<!-- Page Hero Banner -->
<div class="page-hero" aria-labelledby="page-title">
    <div class="container">
        <!-- Breadcrumb navigation: shows path Home > Reviews
             Helps users understand where they are in the site hierarchy
             aria-label distinguishes from main navigation -->
        <nav aria-label="Breadcrumb navigation">
            <ol class="breadcrumb breadcrumb-fork">
                <!-- aria-current="page" marks the current page in the breadcrumb -->
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Reviews</li>
            </ol>
        </nav>
        <h1 id="page-title"><i class="bi bi-pen" aria-hidden="true"></i> Food Reviews</h1>
        <p>Honest ratings from real visits across Melbourne's dining scene.</p>
    </div>
</div>

<!-- Search Bar Section -->
<section class="section-pad-sm bg-warm" aria-label="Review search">
    <div class="container">
        <div class="row align-items-center g-3">
            <div class="col-md-6">
                <div class="search-bar-wrap">
                    <i class="bi bi-search search-icon" aria-hidden="true"></i>
                    <!-- type="search" = semantic search input (shows X clear button in some browsers)
                         The JS in main.js listens to keyup + input events on this element -->
                    <input type="search" id="review-search" class="form-control"
                           placeholder="Search reviews by dish, restaurant, suburb..."
                           aria-label="Search reviews">
                </div>
            </div>
            <div class="col-md-3">
                <!-- Category filter dropdown - JS listens to 'change' event -->
                <select id="category-filter" class="form-select"
                        aria-label="Filter reviews by category">
                    <option value="">All Categories</option>
                    <!-- value attributes must match data-category on review cards (lowercase) -->
                    <option value="breakfast">Breakfast</option>
                    <option value="mains">Mains</option>
                    <option value="desserts">Desserts</option>
                    <option value="drinks">Drinks</option>
                </select>
            </div>
            <div class="col-md-3 text-md-end">
                <!-- role="status" + aria-live="polite": screen readers announce
                     when JS updates this to show "No reviews match your search" -->
                <span id="no-results-msg" style="display:none;color:#E74C3C;font-size:0.9rem;"
                      role="status" aria-live="polite">
                    <i class="bi bi-exclamation-circle"></i> No reviews match your search.
                </span>
            </div>
        </div>
    </div>
</section>


<!-- ===== REVIEW CARDS ===== -->
<section class="section-pad" aria-labelledby="reviews-heading">
    <div class="container">
        <h2 class="section-title" id="reviews-heading">Latest Reviews</h2>
        <p class="section-subtitle">Most recent first</p>

        <div class="row g-4" id="reviews-grid">
            <?php
            // $reviews is a PHP array of associative arrays
            // Each element represents one review with multiple properties
            // 'img' key = filename from our images/ folder
            $reviews = [
                [
                    'id'         => 1,
                    'restaurant' => 'The Morning Glory',
                    'suburb'     => 'Fitzroy',
                    'dish'       => 'Eggs Benedict Royale',
                    'category'   => 'Breakfast',
                    'price'      => '$19',
                    'rating'     => 5,
                    'summary'    => 'Perfectly poached eggs, house-smoked salmon, and a hollandaise that should be illegal. The sourdough base had a satisfying crunch that held everything together without turning soggy.',
                    'img'        => 'eggs-benedict.jpg',
                    'date'       => '28 May 2026',
                    'reviewer'   => 'Aarohan Timilsina',
                ],
                [
                    'id'         => 2,
                    'restaurant' => 'The Patty Lab',
                    'suburb'     => 'Richmond',
                    'dish'       => 'Truffle Wagyu Burger',
                    'category'   => 'Mains',
                    'price'      => '$26',
                    'rating'     => 4,
                    'summary'    => 'A genuinely impressive smash burger with a truffle aioli that cuts through the richness beautifully. The wagyu patty had a deep char crust and a pink, juicy interior. Fries were forgettable though.',
                    'img'        => 'truffle-wagyu.jpg',
                    'date'       => '25 May 2026',
                    'reviewer'   => 'Saksham Bhandari',
                ],
                [
                    'id'         => 3,
                    'restaurant' => 'Yuki Desserts',
                    'suburb'     => 'South Yarra',
                    'dish'       => 'Matcha Tiramisu',
                    'category'   => 'Desserts',
                    'price'      => '$14',
                    'rating'     => 5,
                    'summary'    => 'The matcha mascarpone was velvety and nuanced — not too bitter, not too sweet. Served in a beautiful glass jar with a ceremonial matcha dusting on top. One of the best desserts we\'ve had in Melbourne.',
                    'img'        => 'matcha-tiramisu.jpg',
                    'date'       => '22 May 2026',
                    'reviewer'   => 'Aarohan Timilsina',
                ],
                [
                    'id'         => 4,
                    'restaurant' => 'Pho Nom',
                    'suburb'     => 'Richmond',
                    'dish'       => 'Pho Bo Dac Biet',
                    'category'   => 'Mains',
                    'price'      => '$17',
                    'rating'     => 4,
                    'summary'    => 'A rich, clear bone broth that had clearly been simmered for hours. Loaded with thinly sliced rare beef, brisket, and tendon. Fresh herbs and bean sprouts on the side. Authentic and comforting.',
                    'img'        => 'pho-bo.jpg',
                    'date'       => '19 May 2026',
                    'reviewer'   => 'Saksham Bhandari',
                ],
                [
                    'id'         => 5,
                    'restaurant' => 'Acai Vibes',
                    'suburb'     => 'St Kilda',
                    'dish'       => 'Acai Bowl',
                    'category'   => 'Breakfast',
                    'price'      => '$16',
                    'rating'     => 4,
                    'summary'    => 'Thick, frozen acai base topped with granola, sliced banana, fresh blueberries, honey, and shredded coconut. Refreshing and filling. Could use more toppings for the price, but consistently good quality.',
                    'img'        => 'acai-bowl.jpg',
                    'date'       => '15 May 2026',
                    'reviewer'   => 'Aarohan Timilsina',
                ],
                [
                    'id'         => 6,
                    'restaurant' => 'Café Lumière',
                    'suburb'     => 'Hawthorn',
                    'dish'       => 'Croffle with Dulce de Leche',
                    'category'   => 'Desserts',
                    'price'      => '$13',
                    'rating'     => 4,
                    'summary'    => 'The croissant-waffle hybrid had the perfect flaky crunch of a croissant with the grid pattern of a waffle. Topped with dulce de leche and vanilla cream. Decadent and deeply satisfying.',
                    'img'        => 'croffle.jpg',
                    'date'       => '11 May 2026',
                    'reviewer'   => 'Saksham Bhandari',
                ],
            ];

            // PHP function declaration: function keyword, name, parameters in ()
            // renderStars($rating) builds a string of filled and empty star characters
            function renderStars($rating) {
                // Start building output string
                // $rating = number 1-5
                $output = '<span class="star-rating" aria-label="' . $rating . ' out of 5 stars">';
                // for loop: $i starts at 1, runs while $i <= 5, increments by 1 each time
                for ($i = 1; $i <= 5; $i++) {
                    // Ternary: if $i <= $rating use filled star ★ else empty star ☆
                    $output .= $i <= $rating ? '★' : '☆';
                    // .= is string concatenation assignment (appends to $output)
                }
                $output .= '</span>';
                return $output; // return sends the built string back to the caller
            }

            // foreach iterates through $reviews array
            // $r = current review (associative array)
            foreach ($reviews as $r):
            ?>
            <!-- data-category is used by JS filter: value must match <option value> in the dropdown -->
            <div class="col-md-6 col-lg-4 review-card-item"
                 data-category="<?= strtolower(htmlspecialchars($r['category'])) ?>">
                <!-- strtolower() converts to lowercase to match the filter option values -->

                <!-- <article> = semantic element for self-contained content
                     Appropriate here because each review can stand alone -->
                <article class="card-fork"
                         aria-label="Review of <?= htmlspecialchars($r['dish']) ?> at <?= htmlspecialchars($r['restaurant']) ?>">

                    <!-- Real image (Requirement: at least one image with alt text) -->
                    <div class="card-img-wrap">
                        <!-- The alt attribute: describes the image content for
                             - screen reader users who can't see images
                             - users with slow connections where images don't load
                             - search engine indexing
                             Good alt text describes what is IN the image, not just "food photo" -->
                        <img src="images/<?= htmlspecialchars($r['img']) ?>"
                             alt="<?= htmlspecialchars($r['dish']) ?> from <?= htmlspecialchars($r['restaurant']) ?> in <?= htmlspecialchars($r['suburb']) ?>"
                             class="w-100"
                             style="height:200px;object-fit:cover;display:block;"
                             loading="lazy">
                    </div>

                    <div class="card-body">
                        <span class="card-tag"><?= htmlspecialchars($r['category']) ?></span>
                        <h3 class="card-title"><?= htmlspecialchars($r['dish']) ?></h3>
                        <p class="mb-1" style="font-size:0.85rem;color:#999;">
                            <i class="bi bi-geo-alt" aria-hidden="true"></i>
                            <strong><?= htmlspecialchars($r['restaurant']) ?></strong>
                            · <?= htmlspecialchars($r['suburb']) ?>
                        </p>
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <!-- PHP function call: we call renderStars() defined above
                                 echo is implicit with shorthand -->
                            <?= renderStars($r['rating']) ?>
                            <span style="font-size:0.8rem;color:#aaa;"><?= htmlspecialchars($r['date']) ?></span>
                        </div>
                        <p class="card-text"><?= htmlspecialchars($r['summary']) ?></p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <span style="font-size:0.88rem;font-weight:600;color:#333;">
                                <?= htmlspecialchars($r['price']) ?>
                            </span>
                            <!-- data-toggle-target: custom data attribute our JS reads
                                 When clicked, JS finds the element with this ID and toggles it -->
                            <button class="btn-fork-outline"
                                    data-toggle-target="review-detail-<?= $r['id'] ?>"
                                    aria-expanded="false"
                                    aria-controls="review-detail-<?= $r['id'] ?>"
                                    style="font-size:0.78rem;padding:5px 14px;">
                                Read More <i class="bi bi-chevron-down" aria-hidden="true"></i>
                            </button>
                        </div>

                        <!-- Expandable detail (JS show/hide logic - initially hidden) -->
                        <div id="review-detail-<?= $r['id'] ?>" style="display:none;margin-top:1rem;">
                            <hr><!-- <hr> = horizontal rule, a semantic thematic break -->
                            <p style="font-size:0.85rem;color:#666;margin:0;">
                                <i class="bi bi-person-circle" aria-hidden="true"></i>
                                Reviewed by <strong><?= htmlspecialchars($r['reviewer']) ?></strong>
                            </p>
                            <p style="font-size:0.85rem;color:#666;margin-top:0.5rem;">
                                For full details, visit
                                <!-- External link (Requirement: external hyperlink) -->
                                <a href="https://www.tripadvisor.com.au"
                                   target="_blank" rel="noopener noreferrer"
                                   aria-label="Find this restaurant on TripAdvisor (opens in new tab)">
                                    TripAdvisor <i class="bi bi-box-arrow-up-right" aria-hidden="true"></i>
                                </a>
                            </p>
                        </div>
                    </div>
                </article>
            </div>
            <?php endforeach; // end of foreach loop for review cards ?>
        </div>
    </div>
</section>


<!-- ===== RATINGS TABLE (Requirement: Table with at least 4 rows) ===== -->
<section class="section-pad bg-warm" aria-labelledby="ratings-table-heading">
    <div class="container">
        <h2 class="section-title" id="ratings-table-heading">Review Score Breakdown</h2>
        <p class="section-subtitle">How each reviewed restaurant scored across our key criteria</p>
        <div class="table-responsive">
            <table class="table table-fork table-hover"
                   role="table"
                   aria-label="Restaurant review score breakdown table">
                <!-- <caption> provides a title/description for the table
                     caption-side:bottom = CSS positions it below the table -->
                <caption style="caption-side:bottom;font-size:0.8rem;color:#aaa;padding-top:8px;">
                    Scores out of 10. Ratings based on anonymous visits.
                </caption>
                <thead>
                    <tr>
                        <th scope="col">Restaurant</th>
                        <th scope="col">Suburb</th>
                        <th scope="col">Food /10</th>
                        <th scope="col">Service /10</th>
                        <th scope="col">Value /10</th>
                        <th scope="col">Ambiance /10</th>
                        <th scope="col">Overall</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- scope="row" on th cells means this header identifies its row
                         Used on the first cell of a data row when it's a row header -->
                    <tr>
                        <th scope="row">The Morning Glory</th>
                        <td>Fitzroy</td>
                        <td>9.5</td><td>9.0</td><td>8.5</td><td>9.0</td>
                        <td><strong>9.0</strong> <span class="star-rating" aria-hidden="true">★★★★★</span></td>
                    </tr>
                    <tr>
                        <th scope="row">The Patty Lab</th>
                        <td>Richmond</td>
                        <td>9.0</td><td>8.0</td><td>7.5</td><td>8.5</td>
                        <td><strong>8.3</strong> <span class="star-rating" aria-hidden="true">★★★★☆</span></td>
                    </tr>
                    <tr>
                        <th scope="row">Yuki Desserts</th>
                        <td>South Yarra</td>
                        <td>10</td><td>9.0</td><td>8.0</td><td>9.5</td>
                        <td><strong>9.1</strong> <span class="star-rating" aria-hidden="true">★★★★★</span></td>
                    </tr>
                    <tr>
                        <th scope="row">Pho Nom</th>
                        <td>Richmond</td>
                        <td>9.0</td><td>7.5</td><td>9.5</td><td>7.0</td>
                        <td><strong>8.3</strong> <span class="star-rating" aria-hidden="true">★★★★☆</span></td>
                    </tr>
                    <tr>
                        <th scope="row">Acai Vibes</th>
                        <td>St Kilda</td>
                        <td>8.5</td><td>8.0</td><td>7.5</td><td>8.0</td>
                        <td><strong>8.0</strong> <span class="star-rating" aria-hidden="true">★★★★☆</span></td>
                    </tr>
                    <tr>
                        <th scope="row">Café Lumière</th>
                        <td>Hawthorn</td>
                        <td>8.8</td><td>8.5</td><td>8.0</td><td>9.0</td>
                        <td><strong>8.6</strong> <span class="star-rating" aria-hidden="true">★★★★½</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Scoring criteria ordered list (Requirement: ordered list) -->
        <div class="row g-4 mt-3">
            <div class="col-md-6">
                <h3 style="font-size:1.2rem;font-family:var(--font-display);">Our Scoring Criteria (in order of importance)</h3>
                <!-- <ol> = ordered list - the numbers convey importance ranking here -->
                <ol style="color:#555;line-height:2.2;font-size:0.92rem;">
                    <li><strong>Food Quality</strong> – Taste, technique, freshness, and presentation</li>
                    <li><strong>Value for Money</strong> – Portion size vs price paid</li>
                    <li><strong>Service</strong> – Speed, friendliness, and knowledge of menu</li>
                    <li><strong>Ambiance</strong> – Interior, music, lighting, and overall atmosphere</li>
                    <li><strong>Accessibility</strong> – Wheelchair access, menu options, allergy awareness</li>
                </ol>
            </div>
            <div class="col-md-6">
                <h3 style="font-size:1.2rem;font-family:var(--font-display);">Useful Food Review Resources</h3>
                <ul style="color:#555;line-height:2.2;font-size:0.92rem;list-style:none;padding:0;">
                    <li><i class="bi bi-link-45deg text-primary-fork" aria-hidden="true"></i>
                        <!-- External hyperlinks (Requirement) -->
                        <a href="https://www.goodfood.com.au" target="_blank" rel="noopener noreferrer"
                           aria-label="Good Food Australia (opens in new tab)">Good Food Australia</a>
                        – Restaurant guides and reviews</li>
                    <li><i class="bi bi-link-45deg text-primary-fork" aria-hidden="true"></i>
                        <a href="https://www.tripadvisor.com.au" target="_blank" rel="noopener noreferrer"
                           aria-label="TripAdvisor (opens in new tab)">TripAdvisor</a>
                        – Traveller restaurant reviews</li>
                    <li><i class="bi bi-link-45deg text-primary-fork" aria-hidden="true"></i>
                        <a href="https://www.zomato.com/australia" target="_blank" rel="noopener noreferrer"
                           aria-label="Zomato Australia (opens in new tab)">Zomato Australia</a>
                        – Menus, hours and ratings</li>
                    <li><i class="bi bi-link-45deg text-primary-fork" aria-hidden="true"></i>
                        <a href="https://www.broadsheet.com.au/melbourne" target="_blank" rel="noopener noreferrer"
                           aria-label="Broadsheet Melbourne (opens in new tab)">Broadsheet Melbourne</a>
                        – Culture and dining</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
