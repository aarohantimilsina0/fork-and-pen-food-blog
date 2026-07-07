<?php
/**
 * restaurants.php  –  PAGE 3: Restaurant Directory
 */
$pageTitle = 'Restaurants';
include 'includes/header.php';
?>

<div class="page-hero" aria-labelledby="rest-page-title">
    <div class="container">
        <nav aria-label="Breadcrumb navigation">
            <ol class="breadcrumb breadcrumb-fork">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Restaurants</li>
            </ol>
        </nav>
        <h1 id="rest-page-title">
            <i class="bi bi-map" aria-hidden="true"></i> Restaurant Directory
        </h1>
        <p>Melbourne's best dining spots, curated and reviewed by our team.</p>
    </div>
</div>

<!-- Filter Bar -->
<section class="section-pad-sm bg-warm" aria-label="Filter restaurants">
    <div class="container">
        <div class="filter-bar">
            <div class="row g-3 align-items-end">
                <div class="col-sm-6 col-md-3">
                    <label for="cuisine-filter" class="form-label fw-semibold"
                           style="font-size:0.85rem;">Cuisine Type</label>
                    <!-- fw-semibold = Bootstrap: font-weight:600 -->
                    <!-- JS change event listener in main.js filters cards based on this value -->
                    <select id="cuisine-filter" class="form-select"
                            aria-label="Filter by cuisine type">
                        <option value="all">All Cuisines</option>
                        <!-- These values MUST match data-cuisine on the restaurant cards below -->
                        <option value="australian">Australian</option>
                        <option value="american">American</option>
                        <option value="japanese">Japanese</option>
                        <option value="vietnamese">Vietnamese</option>
                        <option value="italian">Italian</option>
                        <option value="french">French</option>
                    </select>
                </div>
                <div class="col-sm-6 col-md-3">
                    <label for="price-filter" class="form-label fw-semibold"
                           style="font-size:0.85rem;">Price Range</label>
                    <select id="price-filter" class="form-select"
                            aria-label="Filter by price range">
                        <option value="all">All Prices</option>
                        <option value="budget">$ Budget (under $20)</option>
                        <option value="mid">$$ Mid-range ($20–$50)</option>
                        <option value="upscale">$$$ Upscale ($50+)</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <!-- Reset button - JS click event clears all filter dropdowns -->
                    <button id="btn-filter-reset" class="btn-fork-outline w-100"
                            aria-label="Reset all filters">
                        <i class="bi bi-arrow-counterclockwise" aria-hidden="true"></i>
                        Reset Filters
                    </button>
                </div>
                <div class="col-md-3 text-md-end">
                    <span style="font-size:0.85rem;color:#888;" role="status" aria-live="polite">
                        Showing Melbourne's top venues
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Restaurant Cards -->
<section class="section-pad" aria-labelledby="restaurants-heading">
    <div class="container">
        <h2 class="section-title" id="restaurants-heading">Featured Restaurants</h2>
        <p class="section-subtitle">Independently verified and reviewed</p>

        <div class="row g-4">
            <?php
            // Restaurant data array - each element is an associative array with restaurant info
            // 'img' = the image filename in our images/ folder
            // 'cuisine' = lowercase, must match <option value> in the filter dropdown
            // 'price' = must match the price filter option values (budget/mid/upscale)
            $restaurants = [
                [
                    'name'        => 'The Morning Glory',
                    'suburb'      => 'Fitzroy',
                    'cuisine'     => 'australian',
                    'price'       => 'mid',
                    'price_label' => '$$',
                    'rating'      => 5,
                    'desc'        => 'The gold standard for Melbourne brunch. Expect queues on weekends, but the Eggs Benedict Royale is worth every minute of the wait.',
                    'hours'       => 'Mon–Fri 7am–3pm | Sat–Sun 7:30am–4pm',
                    'img'         => 'morning-glory.jpg',
                    'img_alt'     => 'Interior of The Morning Glory café in Fitzroy with natural light and timber tables',
                    'badge'       => 'Australian',
                    'features'    => 'Wheelchair Access · Vegan Options · Outdoor Seating',
                ],
                [
                    'name'        => 'The Patty Lab',
                    'suburb'      => 'Richmond',
                    'cuisine'     => 'american',
                    'price'       => 'mid',
                    'price_label' => '$$',
                    'rating'      => 4,
                    'desc'        => 'Smash burger specialists doing wagyu patties with creative toppings. The truffle aioli is exceptional. Book ahead on Friday evenings.',
                    'hours'       => 'Tue–Sun 11:30am–9pm',
                    'img'         => 'patty-lab.jpg',
                    'img_alt'     => 'The Patty Lab restaurant in Richmond with neon burger sign',
                    'badge'       => 'American',
                    'features'    => 'Takeaway · Delivery · Group Bookings',
                ],
                [
                    'name'        => 'Yuki Desserts',
                    'suburb'      => 'South Yarra',
                    'cuisine'     => 'japanese',
                    'price'       => 'budget',
                    'price_label' => '$',
                    'rating'      => 5,
                    'desc'        => 'A tiny Japanese dessert café that punches well above its weight. The matcha tiramisu has a loyal following and regularly sells out.',
                    'hours'       => 'Wed–Mon 12pm–9pm | Closed Tuesdays',
                    'img'         => 'yuki-desserts.jpg',
                    'img_alt'     => 'Yuki Desserts café in South Yarra with Japanese minimal décor',
                    'badge'       => 'Japanese Fusion',
                    'features'    => 'Vegan Options · Halal-Friendly',
                ],
                [
                    'name'        => 'Pho Nom',
                    'suburb'      => 'Richmond',
                    'cuisine'     => 'vietnamese',
                    'price'       => 'budget',
                    'price_label' => '$',
                    'rating'      => 4,
                    'desc'        => 'A true Vietnamese institution on Victoria Street. The bone broth is made fresh daily and the banh mi is some of the best in the city.',
                    'hours'       => 'Daily 10am–10pm',
                    'img'         => 'pho-nom.webp',
                    'img_alt'     => 'Pho Nom Vietnamese restaurant exterior on Victoria Street Richmond',
                    'badge'       => 'Vietnamese',
                    'features'    => 'BYO · Cash/Card · Takeaway',
                ],
                [
                    'name'        => 'Pasta Vera',
                    'suburb'      => 'Carlton',
                    'cuisine'     => 'italian',
                    'price'       => 'upscale',
                    'price_label' => '$$$',
                    'rating'      => 5,
                    'desc'        => 'Handmade pasta in the heart of Melbourne\'s Italian quarter. The truffle tagliatelle has been on the menu for 20 years for very good reason.',
                    'hours'       => 'Tue–Sun 5:30pm–10pm',
                    'img'         => 'pasta-vera.png',
                    'img_alt'     => 'Pasta Vera restaurant in Carlton with intimate candlelit dining room',
                    'badge'       => 'Italian',
                    'features'    => 'Fine Dining · Wine Pairing · Reservations Required',
                ],
                [
                    'name'        => 'Café Lumière',
                    'suburb'      => 'Hawthorn',
                    'cuisine'     => 'french',
                    'price'       => 'mid',
                    'price_label' => '$$',
                    'rating'      => 4,
                    'desc'        => 'A charming French-inspired café known for their croffle and single-origin filter coffees. The weekend menu is a treat.',
                    'hours'       => 'Daily 7am–4pm',
                    'img'         => 'cafe-lumiere.webp',
                    'img_alt'     => 'Café Lumière in Hawthorn with French bistro style seating and pastry display',
                    'badge'       => 'French Fusion',
                    'features'    => 'Pet-Friendly Outdoor Area · Gluten-Free Options',
                ],
            ];

            // foreach: iterates through each restaurant in the array
            foreach ($restaurants as $rest):
            ?>
            <!-- data-cuisine and data-price: custom HTML data attributes
                 JavaScript reads these via element.dataset.cuisine / element.dataset.price
                 to apply filter logic without making server requests -->
            <div class="col-md-6 col-lg-4 restaurant-card-item"
                 data-cuisine="<?= htmlspecialchars($rest['cuisine']) ?>"
                 data-price="<?= htmlspecialchars($rest['price']) ?>">

                <!-- <article> = semantic element for self-contained restaurant listing -->
                <article class="restaurant-card"
                         aria-label="<?= htmlspecialchars($rest['name']) ?> in <?= htmlspecialchars($rest['suburb']) ?>">

                    <!-- Real photo (Requirement: image with alt text)
                         alt = $rest['img_alt'] provides a descriptive text alternative
                         object-fit:cover = fills container maintaining aspect ratio (crops edges)
                         loading="lazy" = browser only fetches image when near viewport -->
                    <img src="images/<?= htmlspecialchars($rest['img']) ?>"
                         alt="<?= htmlspecialchars($rest['img_alt']) ?>"
                         class="rest-img"
                         style="width:100%;height:180px;object-fit:cover;display:block;"
                         loading="lazy">

                    <div class="rest-body">
                        <span class="cuisine-tag"><?= htmlspecialchars($rest['badge']) ?></span>
                        <h3 style="font-size:1.1rem;margin-bottom:0.25rem;">
                            <?= htmlspecialchars($rest['name']) ?>
                        </h3>
                        <p style="font-size:0.82rem;color:#999;margin-bottom:0.5rem;">
                            <i class="bi bi-geo-alt" aria-hidden="true"></i>
                            <?= htmlspecialchars($rest['suburb']) ?>
                            &nbsp;·&nbsp; <?= htmlspecialchars($rest['price_label']) ?>
                        </p>
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <!-- str_repeat() repeats a string N times
                                 Generates ★★★★★ for rating=5, ★★★★☆ for rating=4 etc. -->
                            <span class="star-rating"
                                  aria-label="<?= $rest['rating'] ?> out of 5 stars">
                                <?= str_repeat('★', $rest['rating']) . str_repeat('☆', 5 - $rest['rating']) ?>
                            </span>
                        </div>
                        <p style="font-size:0.88rem;color:#666;margin-bottom:0.8rem;">
                            <?= htmlspecialchars($rest['desc']) ?>
                        </p>
                        <p style="font-size:0.78rem;color:#aaa;margin-bottom:0.5rem;">
                            <i class="bi bi-clock" aria-hidden="true"></i>
                            <?= htmlspecialchars($rest['hours']) ?>
                        </p>
                        <p style="font-size:0.75rem;color:#bbb;margin:0;">
                            <i class="bi bi-check2-all" aria-hidden="true"></i>
                            <?= htmlspecialchars($rest['features']) ?>
                        </p>
                    </div>
                </article>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Quick Reference Table (Requirement: table) -->
        <div class="mt-5">
            <h3 class="section-title" id="quick-ref-heading">Quick Reference Table</h3>
            <p class="section-subtitle">All venues at a glance</p>
            <div class="table-responsive">
                <table class="table table-fork table-bordered"
                       role="table"
                       aria-labelledby="quick-ref-heading">
                    <!-- table-bordered = Bootstrap: adds borders to all cells -->
                    <caption class="visually-hidden">
                        Quick reference table for all reviewed restaurants
                    </caption>
                    <thead>
                        <tr>
                            <th scope="col">Restaurant</th>
                            <th scope="col">Suburb</th>
                            <th scope="col">Cuisine</th>
                            <th scope="col">Price Range</th>
                            <th scope="col">Rating</th>
                            <th scope="col">Best Dish</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- We reuse the $restaurants array to populate this table
                             DRY principle: define data once, use it in multiple places -->
                        <?php foreach ($restaurants as $r): ?>
                        <tr>
                            <th scope="row"><?= htmlspecialchars($r['name']) ?></th>
                            <td><?= htmlspecialchars($r['suburb']) ?></td>
                            <td><?= htmlspecialchars($r['badge']) ?></td>
                            <td><?= htmlspecialchars($r['price_label']) ?></td>
                            <td aria-label="<?= $r['rating'] ?> out of 5 stars">
                                <?= str_repeat('★', $r['rating']) . str_repeat('☆', 5 - $r['rating']) ?>
                            </td>
                            <td>See full review →</td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
