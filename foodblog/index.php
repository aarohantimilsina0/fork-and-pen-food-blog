<?php
/**
 * index.php  –  PAGE 1: Homepage
 * The Fork & Pen  |  NIT1101 Assessment 2
 *
 * Requirements covered on this page:
 *  - Brand logo and tagline           ✓ (hero section + nav)
 *  - Navigation menu                  ✓ (via includes/header.php)
 *  - Image slideshow / carousel       ✓ (Bootstrap carousel with real photos)
 *  - Introductory paragraph           ✓ (About section)
 *  - At least one video               ✓ (YouTube embed)
 *  - Ordered + unordered lists        ✓ (Lists section)
 *  - Tables                           ✓ (Top Picks table)
 *  - Sign-in/sign-up forms + JS validation ✓
 *  - External CSS                     ✓ (css/style.css)
 *  - Links to external webpages       ✓ (Resources section)
 */

// $pageTitle is used by header.php to set the <title> tag
// It must be set BEFORE including header.php
$pageTitle = 'Home';
include 'includes/header.php';
// include: finds the file and pastes its PHP/HTML output here
// This is how we share header code across all pages (DRY principle)
?>

<!-- ===== HERO SECTION ===== -->
<!-- <section> is a semantic HTML5 element grouping related content
     aria-label describes the section for screen readers since there's no heading visible at top -->
<section class="hero" aria-label="Hero section">
    <div class="container">
        <!-- Bootstrap grid: .row creates a flexbox row, .g-5 = gap of 3rem
             align-items-center = Bootstrap: vertically centres the two columns -->
        <div class="row align-items-center g-5">

            <!-- Hero text: col-lg-5 = 5/12 columns on large screens, full width on smaller -->
            <div class="col-lg-5 hero-content">
                <span class="hero-badge">🍽️ Melbourne's Food Authority</span>
                <h1>Taste. Review. <em>Repeat.</em></h1>
                <!-- <em> = emphasis - semantic italic, implies stressed content -->
                <p class="hero-lead">
                    Honest reviews, hidden gems, and unforgettable bites across Melbourne.
                    No sponsors. No bias. Just real food lovers telling it like it is.
                </p>
                <!-- d-flex gap-3 flex-wrap = Bootstrap: horizontal flex layout with wrapping -->
                <div class="d-flex gap-3 flex-wrap">
                    <a href="reviews.php" class="btn-fork">Read Reviews</a>
                    <a href="restaurants.php" class="btn-fork-outline"
                       style="color:#F0E8D8;border-color:#F0E8D8;">Browse Restaurants</a>
                </div>
            </div>

            <!-- BOOTSTRAP CAROUSEL (Requirement: Image slideshow / carousel)
                 col-lg-7 = 7/12 columns on large screens (7+5=12 fills the full row) -->
            <div class="col-lg-7">
                <!-- data-bs-ride="carousel": Bootstrap JS reads this attribute and auto-plays
                     the carousel. data-bs-* = Bootstrap 5's way of passing config via HTML -->
                <div id="heroCarousel" class="carousel slide hero-carousel"
                     data-bs-ride="carousel"
                     aria-label="Featured food photos slideshow" role="region">

                    <!-- Indicators: the dots at the bottom of the carousel
                         data-bs-slide-to="0" tells Bootstrap which slide to jump to on click -->
                    <div class="carousel-indicators" role="tablist" aria-label="Carousel slides">
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0"
                                class="active" role="tab" aria-label="Slide 1: Avocado Toast" aria-selected="true"></button>
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"
                                role="tab" aria-label="Slide 2: Wagyu Burger" aria-selected="false"></button>
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"
                                role="tab" aria-label="Slide 3: Matcha Tiramisu" aria-selected="false"></button>
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3"
                                role="tab" aria-label="Slide 4: Poke Bowl" aria-selected="false"></button>
                    </div>

                    <div class="carousel-inner">
                        <!-- Slide 1: class="active" is required on the first slide -->
                        <div class="carousel-item active">
                            <!-- Real photo replacing emoji placeholder
                                 object-fit:cover fills the space without distorting the image
                                 loading="lazy" defers loading until near viewport (performance) -->
                            <img src="images/smashed-avo.jpg"
                                 alt="Smashed avocado toast with poached eggs and microgreens on sourdough"
                                 class="d-block w-100 carousel-img"
                                 style="height:380px;object-fit:cover;border-radius:16px;"
                                 loading="lazy">
                            <!-- carousel-caption-fork = our custom CSS class for the overlay text -->
                            <div class="carousel-caption-fork">
                                <h5>Smashed Avocado Toast</h5>
                                <p>Fluffington's Café, Fitzroy — ★★★★★</p>
                            </div>
                        </div>
                        <!-- Slide 2 -->
                        <div class="carousel-item">
                            <img src="images/truffle-wagyu.jpg"
                                 alt="Truffle wagyu beef burger with caramelised onions and brioche bun"
                                 class="d-block w-100 carousel-img"
                                 style="height:380px;object-fit:cover;border-radius:16px;"
                                 loading="lazy">
                            <div class="carousel-caption-fork">
                                <h5>Wagyu Beef Burger</h5>
                                <p>The Patty Lab, Richmond — ★★★★½</p>
                            </div>
                        </div>
                        <!-- Slide 3 -->
                        <div class="carousel-item">
                            <img src="images/matcha-tiramisu.jpg"
                                 alt="Matcha tiramisu layered in a glass with ceremonial matcha dusting"
                                 class="d-block w-100 carousel-img"
                                 style="height:380px;object-fit:cover;border-radius:16px;"
                                 loading="lazy">
                            <div class="carousel-caption-fork">
                                <h5>Matcha Tiramisu</h5>
                                <p>Yuki Desserts, South Yarra — ★★★★★</p>
                            </div>
                        </div>
                        <!-- Slide 4 -->
                        <div class="carousel-item">
                            <img src="images/tuna-poke.jpg"
                                 alt="Colourful tuna poke bowl with edamame, mango and sesame seeds"
                                 class="d-block w-100 carousel-img"
                                 style="height:380px;object-fit:cover;border-radius:16px;"
                                 loading="lazy">
                            <div class="carousel-caption-fork">
                                <h5>Tuna Poke Bowl</h5>
                                <p>Aloha Bowls, Carlton — ★★★★☆</p>
                            </div>
                        </div>
                    </div>

                    <!-- Carousel prev/next controls
                         data-bs-slide="prev"/"next" = Bootstrap reads these to slide left/right -->
                    <button class="carousel-control-prev" type="button"
                            data-bs-target="#heroCarousel" data-bs-slide="prev"
                            aria-label="Previous slide">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    </button>
                    <button class="carousel-control-next" type="button"
                            data-bs-target="#heroCarousel" data-bs-slide="next"
                            aria-label="Next slide">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /HERO -->


<!-- ===== ABOUT / INTRO SECTION ===== -->
<!-- aria-labelledby links this section to its heading via matching id
     Screen readers announce "About The Fork & Pen - region" -->
<section class="section-pad bg-warm" aria-labelledby="intro-heading">
    <div class="container">
        <!-- justify-content-center = Bootstrap: centres the column(s) in the row -->
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <!-- text-center = Bootstrap: text-align:center -->
                <h2 class="section-title text-center" id="intro-heading"
                    style="margin:0 auto 0.5rem;">About The Fork &amp; Pen</h2>
                <p class="section-subtitle">Who we are and what we do</p>
                <!-- <strong> = bold with semantic meaning: this text is important
                     Unlike <b> which is purely visual, <strong> carries emphasis meaning -->
                <p class="lead" style="color:#555;font-weight:300;line-height:1.9;">
                    <strong>The Fork &amp; Pen</strong> is Melbourne's most trusted independent food review blog,
                    founded by two passionate food lovers who believe every meal tells a story worth sharing.
                    We explore restaurants, cafés, pop-ups, and street food stalls across the city —
                    capturing honest impressions, fair ratings, and memorable bites in every review.
                </p>
                <p style="color:#666;font-weight:300;line-height:1.9;">
                    From hole-in-the-wall brunch spots in Fitzroy to fine-dining degustation menus in the CBD,
                    our reviews are written for real food lovers — not algorithms. We have no affiliate deals,
                    no sponsored posts, and no conflicts of interest. Every visit is anonymous. Every score is earned.
                </p>
                <div class="d-flex justify-content-center gap-3 mt-4 flex-wrap">
                    <a href="about.php" class="btn-fork">Meet the Team</a>
                    <a href="reviews.php" class="btn-fork-outline">Read All Reviews</a>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ===== FEATURED VIDEO (Requirement: At least one video) ===== -->
<section class="section-pad" aria-labelledby="video-heading">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5">
                <h2 class="section-title" id="video-heading">Watch: Our Melbourne Food Journey</h2>
                <p class="section-subtitle">48 hours, 12 restaurants, one city</p>
                <p style="color:#666;font-weight:300;">
                    Follow us on a whirlwind food tour of Melbourne — from the iconic laneway coffee culture
                    to the diverse flavours of Victoria Street and the Dandenong Market.
                </p>
                <!-- Unordered list (no order matters) using Bootstrap Icons for bullet replacements -->
                <ul class="list-unstyled mt-3" style="color:#555;font-size:0.92rem;">
                    <!-- list-unstyled = Bootstrap: removes default list bullet and padding -->
                    <li><i class="bi bi-check-circle-fill text-primary-fork me-2" aria-hidden="true"></i>12 restaurants visited</li>
                    <li><i class="bi bi-check-circle-fill text-primary-fork me-2" aria-hidden="true"></i>Fitzroy, Richmond, South Yarra, CBD</li>
                    <li><i class="bi bi-check-circle-fill text-primary-fork me-2" aria-hidden="true"></i>From $10 banh mi to $180 degustation</li>
                </ul>
            </div>
            <div class="col-lg-7">
                <!-- video-wrapper: custom CSS class with aspect-ratio:16/9 so the video
                     always maintains correct proportions regardless of screen size -->
                <div class="video-wrapper" aria-label="Featured food video: Melbourne Food Journey">
                    <!-- <iframe> embeds an external webpage (here, YouTube) inside our page
                         allow= grants specific browser permissions to the iframe
                         allowfullscreen= lets users go fullscreen
                         loading="lazy"= browser only loads iframe when near viewport -->
                    <iframe
                        src="https://www.youtube.com/embed/ZfVHtUc-w4c?rel=0&modestbranding=1"
                        title="Trying all the BEST FOOD in MELBOURNE – Melbourne Food Tour 2024"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen
                        loading="lazy"
                        aria-label="YouTube video: Melbourne food tour 2024 – best food across the city">
                    </iframe>
                </div>
                <p class="mt-2" style="font-size:0.78rem;color:#aaa;">
                    <i class="bi bi-info-circle" aria-hidden="true"></i>
                    Video: "Melbourne Food Scene" — used under YouTube's standard embed terms.
                </p>
            </div>
        </div>
    </div>
</section>


<!-- ===== TOP PICKS TABLE (Requirement: Tables on homepage) ===== -->
<section class="section-pad bg-warm" aria-labelledby="table-heading">
    <div class="container">
        <h2 class="section-title" id="table-heading">This Week's Top Picks</h2>
        <p class="section-subtitle">Our highest-rated dishes this week, sorted by score</p>

        <!-- table-responsive = Bootstrap: wraps table in a horizontal-scrolling container on mobile
             Without this, wide tables break the layout on small screens -->
        <div class="table-responsive">
            <!-- <table> for tabular data (rows and columns of related data)
                 role="table" and aria-label improve screen reader experience
                 table-striped = Bootstrap: alternating row background colours -->
            <table class="table table-fork table-striped" role="table"
                   aria-label="Top rated food picks this week">
                <!-- <caption> = table description for screen readers
                     visually-hidden = Bootstrap: hidden visually but read by screen readers -->
                <caption class="visually-hidden">
                    Table of top food picks for this week with restaurant, dish, cuisine type, and rating
                </caption>
                <thead>
                    <!-- <thead> = table header section - not just visual, semantic grouping -->
                    <tr>
                        <!-- <th scope="col"> = table header cell
                             scope="col" tells screen readers this header applies to its column -->
                        <th scope="col">#</th>
                        <th scope="col">Dish</th>
                        <th scope="col">Restaurant</th>
                        <th scope="col">Suburb</th>
                        <th scope="col">Cuisine</th>
                        <th scope="col">Price</th>
                        <th scope="col">Rating</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- <tbody> = table body - contains data rows (<tr>) -->
                    <!-- <td> = table data cell (regular cell, not a header) -->
                    <tr>
                        <td>1</td>
                        <td><strong>Eggs Benedict Royale</strong></td>
                        <td>The Morning Glory</td>
                        <td>Fitzroy</td>
                        <td>Australian</td>
                        <td>$19</td>
                        <!-- aria-label on the star span provides text description for screen readers
                             since ★★★★★ would be read character by character otherwise -->
                        <td><span class="star-rating" aria-label="5 out of 5 stars">★★★★★</span></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td><strong>Truffle Wagyu Burger</strong></td>
                        <td>The Patty Lab</td>
                        <td>Richmond</td>
                        <td>Modern American</td>
                        <td>$26</td>
                        <td><span class="star-rating" aria-label="4.5 out of 5 stars">★★★★½</span></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td><strong>Matcha Tiramisu</strong></td>
                        <td>Yuki Desserts</td>
                        <td>South Yarra</td>
                        <td>Japanese Fusion</td>
                        <td>$14</td>
                        <td><span class="star-rating" aria-label="5 out of 5 stars">★★★★★</span></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td><strong>Pho Bo Dac Biet</strong></td>
                        <td>Pho Nom</td>
                        <td>Richmond</td>
                        <td>Vietnamese</td>
                        <td>$17</td>
                        <td><span class="star-rating" aria-label="4 out of 5 stars">★★★★☆</span></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td><strong>Smoked Salmon Bagel</strong></td>
                        <td>Bagel Brothers</td>
                        <td>Carlton</td>
                        <td>American Deli</td>
                        <td>$15</td>
                        <td><span class="star-rating" aria-label="4.5 out of 5 stars">★★★★½</span></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td><strong>Croffle with Dulce de Leche</strong></td>
                        <td>Café Lumière</td>
                        <td>Hawthorn</td>
                        <td>French Fusion</td>
                        <td>$13</td>
                        <td><span class="star-rating" aria-label="4 out of 5 stars">★★★★☆</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>


<!-- ===== LISTS SECTION (Requirement: Ordered + Unordered lists) ===== -->
<section class="section-pad" aria-labelledby="lists-heading">
    <div class="container">
        <div class="row g-5">
            <div class="col-md-6">
                <h3 class="section-title" id="top5-heading">Top 5 Must-Try Experiences</h3>
                <p style="color:#666;font-weight:300;margin-bottom:1.2rem;">
                    Our personal shortlist of Melbourne food experiences you absolutely cannot miss:
                </p>
                <!-- ORDERED LIST (Requirement): <ol> = numbered list, order matters here
                     Numbers 1-5 convey priority/ranking -->
                <ol class="styled-list" style="color:#444;font-size:0.95rem;line-height:2;">
                    <li>Breakfast at Auction Rooms, North Melbourne — the espresso alone is worth the tram ride</li>
                    <li>Dumpling feast on Little Bourke Street — $12 per head, unlimited soup dumplings</li>
                    <li>Late-night ramen at Kodawari Ramen, CBD — open past midnight and worth every minute</li>
                    <li>Gelato walk along Lygon Street, Carlton — try at least three shops for a proper comparison</li>
                    <li>Farmers market at Queen Victoria Market — Sunday morning ritual for every Melburnian</li>
                </ol>
            </div>
            <div class="col-md-6">
                <h3 class="section-title" id="tips-heading">What Makes a Great Review</h3>
                <p style="color:#666;font-weight:300;margin-bottom:1.2rem;">
                    Our editorial standards for every review published on The Fork &amp; Pen:
                </p>
                <!-- UNORDERED LIST (Requirement): <ul> = bulleted list, order doesn't matter
                     These editorial standards have no priority order -->
                <ul style="color:#444;font-size:0.95rem;line-height:2;list-style:none;padding:0;">
                    <li><i class="bi bi-dot text-primary-fork" aria-hidden="true"></i> Anonymous visit — restaurant never knows we're there</li>
                    <li><i class="bi bi-dot text-primary-fork" aria-hidden="true"></i> At least one full meal per review, often multiple dishes</li>
                    <li><i class="bi bi-dot text-primary-fork" aria-hidden="true"></i> Photographs taken discreetly without flash</li>
                    <li><i class="bi bi-dot text-primary-fork" aria-hidden="true"></i> Scores based on food quality, service, value, and ambiance</li>
                    <li><i class="bi bi-dot text-primary-fork" aria-hidden="true"></i> No advertiser relationships — ever</li>
                    <li><i class="bi bi-dot text-primary-fork" aria-hidden="true"></i> Revisits when warranted — we give second chances</li>
                </ul>
            </div>
        </div>
    </div>
</section>


<!-- ===== AVERAGE RATING CALCULATOR (JS Logic / Calculator requirement) ===== -->
<section class="section-pad bg-warm" aria-labelledby="calc-heading">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <h2 class="section-title text-center" id="calc-heading"
                    style="margin:0 auto 0.5rem;">Average Rating Calculator</h2>
                <p class="section-subtitle text-center">
                    See how we turn four scores into one overall rating
                </p>
                <div class="p-4 bg-white rounded-3 shadow-sm">
                    <!-- p-4 = Bootstrap: padding 1.5rem all sides
                         rounded-3 = Bootstrap: border-radius 0.5rem
                         shadow-sm = Bootstrap: small box-shadow -->
                    <p style="color:#666;font-size:0.88rem;font-weight:300;margin-bottom:1rem;">
                        Every review on The Fork &amp; Pen is scored out of 10 across four criteria.
                        Enter scores below to see how the overall rating is calculated using our
                        weighting system.
                    </p>
                    <div class="form-fork">
                        <div class="mb-3">
                            <!-- <label for="calc-food"> links this label to the input with id="calc-food"
                                 Clicking the label focuses the input - accessibility + usability -->
                            <label for="calc-food" class="form-label">Food Quality (out of 10)</label>
                            <!-- type="number" = browser shows numeric keyboard on mobile,
                                 allows only numbers, and shows up/down arrows
                                 min="0" max="10" restricts to a valid 0-10 score
                                 aria-describedby links this input to its help text for screen readers -->
                            <input type="number" id="calc-food" class="form-control"
                                   placeholder="e.g. 9.5" min="0" max="10" step="0.5"
                                   aria-describedby="food-help">
                            <div id="food-help" class="form-text text-muted">Taste, technique, freshness, presentation</div>
                        </div>
                        <div class="mb-3">
                            <label for="calc-service" class="form-label">Service (out of 10)</label>
                            <input type="number" id="calc-service" class="form-control"
                                   placeholder="e.g. 8.5" min="0" max="10" step="0.5"
                                   aria-describedby="service-help">
                            <div id="service-help" class="form-text text-muted">Speed, friendliness, menu knowledge</div>
                        </div>
                        <div class="mb-3">
                            <label for="calc-value" class="form-label">Value for Money (out of 10)</label>
                            <input type="number" id="calc-value" class="form-control"
                                   placeholder="e.g. 8.0" min="0" max="10" step="0.5"
                                   aria-describedby="value-help">
                            <div id="value-help" class="form-text text-muted">Portion size vs price paid</div>
                        </div>
                        <div class="mb-3">
                            <label for="calc-ambiance" class="form-label">Ambiance (out of 10)</label>
                            <!-- <select> = dropdown menu, user picks one option
                                 value attribute on <option> is what JS reads (not the visible text) -->
                            <select id="calc-ambiance" class="form-select" aria-label="Select ambiance score">
                                <option value="">Select a score…</option>
                                <option value="6">6 – Basic</option>
                                <option value="7">7 – Pleasant</option>
                                <option value="8" selected>8 – Great atmosphere</option>
                                <!-- selected attribute makes this the default chosen option -->
                                <option value="9">9 – Excellent atmosphere</option>
                                <option value="10">10 – Outstanding atmosphere</option>
                            </select>
                            <div id="ambiance-help" class="form-text text-muted">Interior, music, lighting, overall vibe</div>
                        </div>
                        <button id="btn-calc-rating" class="btn-fork w-100"
                                aria-label="Calculate overall rating">
                            <!-- w-100 = Bootstrap: width:100% - makes button full width -->
                            <i class="bi bi-calculator" aria-hidden="true"></i> Calculate Overall Rating
                        </button>
                        <!-- role="status" + aria-live="polite": when JS updates this div,
                             screen readers announce the new content without interrupting the user -->
                        <div id="calc-result" class="alert-fork-success mt-3"
                             role="status" aria-live="polite" style="display:none;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ===== SIGN-IN / SIGN-UP FORMS (Requirement: JS Validation) ===== -->
<section class="section-pad" aria-labelledby="auth-heading" id="join">
    <div class="container">
        <h2 class="section-title text-center" id="auth-heading"
            style="margin:0 auto 0.5rem;">Join Our Community</h2>
        <p class="section-subtitle text-center">Create a free account or sign in to save your favourite reviews</p>
        <div class="row g-4 justify-content-center">

            <!-- SIGN UP FORM -->
            <div class="col-lg-5">
                <div class="p-4 bg-white rounded-3 shadow-sm h-100">
                    <!-- h-100 = Bootstrap: height:100% - makes card same height as sibling -->
                    <h3 class="mb-4" style="font-size:1.3rem;">Create an Account</h3>
                    <!-- novalidate = disables browser's built-in HTML5 validation
                         We handle validation ourselves in JS for a better user experience
                         aria-label = describes the form purpose to screen readers -->
                    <form id="signup-form" class="form-fork" novalidate aria-label="Sign up form">
                        <div class="mb-3">
                            <label for="su-name" class="form-label">
                                Full Name <span aria-hidden="true" class="text-danger">*</span>
                            </label>
                            <!-- autocomplete="name" = browser knows this is a name field
                                 and can auto-fill from saved data -->
                            <input type="text" id="su-name" class="form-control"
                                   placeholder="Jane Smith" required autocomplete="name"
                                   aria-required="true">
                            <!-- required = HTML5 attribute (ignored because of novalidate,
                                 but useful for semantics and our JS validation checks it)
                                 aria-required="true" = ARIA equivalent for screen readers -->
                            <div class="invalid-feedback">Please enter your full name.</div>
                            <!-- invalid-feedback = Bootstrap: hidden by default, shown when
                                 the input gets class="is-invalid" via JavaScript -->
                        </div>
                        <div class="mb-3">
                            <label for="su-email" class="form-label">
                                Email Address <span aria-hidden="true" class="text-danger">*</span>
                            </label>
                            <!-- type="email" = browser validates email format on mobile
                                 shows @ keyboard on mobile -->
                            <input type="email" id="su-email" class="form-control"
                                   placeholder="jane@example.com" required autocomplete="email"
                                   aria-required="true">
                            <div class="invalid-feedback">Please enter a valid email address.</div>
                        </div>
                        <div class="mb-3">
                            <label for="su-password" class="form-label">
                                Password <span aria-hidden="true" class="text-danger">*</span>
                            </label>
                            <!-- type="password" = masks input with dots/asterisks
                                 minlength="8" = HTML5 minimum length attribute -->
                            <input type="password" id="su-password" class="form-control"
                                   placeholder="Min 8 characters" required minlength="8"
                                   aria-required="true" autocomplete="new-password">
                            <div class="invalid-feedback">Password must be at least 8 characters.</div>
                        </div>
                        <div class="mb-3">
                            <label for="su-confirm" class="form-label">
                                Confirm Password <span aria-hidden="true" class="text-danger">*</span>
                            </label>
                            <input type="password" id="su-confirm" class="form-control"
                                   placeholder="Repeat password" required autocomplete="new-password">
                            <div class="invalid-feedback">Passwords do not match.</div>
                        </div>
                        <div class="mb-3 form-check">
                            <!-- form-check = Bootstrap: styled checkbox + label pair
                                 type="checkbox" = creates a tick-box input -->
                            <input type="checkbox" id="su-agree" class="form-check-input" required>
                            <label for="su-agree" class="form-check-label" style="font-size:0.85rem;">
                                I agree to the <a href="about.php#privacy">Privacy Policy</a> and
                                <a href="about.php#terms">Terms of Use</a>
                            </label>
                            <div class="invalid-feedback">You must agree before submitting.</div>
                        </div>
                        <button type="submit" class="btn-fork w-100"
                                aria-label="Create your free account">Create Account</button>
                        <!-- These success/error divs start hidden (CSS display:none)
                             JS shows them after validation -->
                        <div id="signup-success" class="alert-fork-success mt-3"
                             role="status" aria-live="polite">
                            <i class="bi bi-check-circle" aria-hidden="true"></i>
                            Account created! Welcome to The Fork &amp; Pen.
                        </div>
                        <div id="signup-error" class="alert-fork-error mt-3" role="alert">
                            Please fix the highlighted errors and try again.
                        </div>
                    </form>
                </div>
            </div>

            <!-- SIGN IN FORM -->
            <div class="col-lg-5">
                <div class="p-4 bg-white rounded-3 shadow-sm h-100">
                    <h3 class="mb-4" style="font-size:1.3rem;">Sign In</h3>
                    <form id="signin-form" class="form-fork" novalidate aria-label="Sign in form">
                        <div class="mb-3">
                            <label for="si-email" class="form-label">
                                Email Address <span aria-hidden="true" class="text-danger">*</span>
                            </label>
                            <input type="email" id="si-email" class="form-control"
                                   placeholder="jane@example.com" required autocomplete="email"
                                   aria-required="true">
                            <div class="invalid-feedback">Please enter your email address.</div>
                        </div>
                        <div class="mb-3">
                            <label for="si-password" class="form-label">
                                Password <span aria-hidden="true" class="text-danger">*</span>
                            </label>
                            <input type="password" id="si-password" class="form-control"
                                   placeholder="Your password" required
                                   autocomplete="current-password" aria-required="true">
                            <div class="invalid-feedback">Please enter your password.</div>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" id="si-remember" class="form-check-input">
                            <label for="si-remember" class="form-check-label"
                                   style="font-size:0.85rem;">Remember me</label>
                        </div>
                        <button type="submit" class="btn-fork w-100"
                                aria-label="Sign in to your account">Sign In</button>
                        <div id="signin-success" class="alert-fork-success mt-3"
                             role="status" aria-live="polite">
                            <i class="bi bi-check-circle" aria-hidden="true"></i>
                            Signed in successfully! Welcome back.
                        </div>
                        <div id="signin-error" class="alert-fork-error mt-3" role="alert">
                            Please enter a valid email and password.
                        </div>
                        <p class="mt-3 text-center" style="font-size:0.85rem;color:#999;">
                            Don't have an account? <a href="#join">Sign up above</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ===== EXTERNAL LINKS (Requirement: Links to external webpages) ===== -->
<section class="section-pad-sm bg-warm" aria-labelledby="resources-heading">
    <div class="container">
        <h2 class="section-title" id="resources-heading">Useful Food Resources</h2>
        <p class="section-subtitle">Explore more from trusted external food platforms</p>
        <div class="row g-3">
            <?php
            // Associative array: an array where each element has a named key
            // $extLinks is an array of arrays (2D array)
            // 'url', 'title', 'desc', 'icon' are the keys for each link item
            $extLinks = [
                ['url' => 'https://www.goodfood.com.au',
                 'title' => 'Good Food Australia',
                 'desc' => 'Restaurant guides and chef interviews.',
                 'icon' => 'bi-newspaper'],
                ['url' => 'https://www.tripadvisor.com.au',
                 'title' => 'TripAdvisor',
                 'desc' => 'Millions of real traveller reviews.',
                 'icon' => 'bi-star-half'],
                ['url' => 'https://www.zomato.com/australia',
                 'title' => 'Zomato Australia',
                 'desc' => 'Discover restaurants near you.',
                 'icon' => 'bi-geo-alt'],
                ['url' => 'https://www.broadsheet.com.au/melbourne',
                 'title' => 'Broadsheet Melbourne',
                 'desc' => 'Melbourne food, bars and culture guide.',
                 'icon' => 'bi-journal-bookmark'],
            ];
            // foreach loop: iterates through $extLinks, each iteration $link = one row
            foreach ($extLinks as $link):
            ?>
            <div class="col-sm-6 col-lg-3">
                <!-- col-sm-6: 2 columns on small, col-lg-3: 4 columns on large screens -->
                <a href="<?= htmlspecialchars($link['url']) ?>"
                   target="_blank" rel="noopener noreferrer"
                   class="d-flex gap-3 align-items-start p-3 bg-white rounded-3 shadow-sm text-decoration-none"
                   aria-label="<?= htmlspecialchars($link['title']) ?> – <?= htmlspecialchars($link['desc']) ?> (opens in new tab)">
                    <!-- text-decoration-none = Bootstrap: removes underline from the link -->
                    <i class="bi <?= $link['icon'] ?> text-primary-fork fs-4" aria-hidden="true"></i>
                    <!-- fs-4 = Bootstrap: font-size 1.5rem for the icon -->
                    <div>
                        <strong style="color:#333;font-size:0.9rem;">
                            <?= htmlspecialchars($link['title']) ?>
                        </strong>
                        <p style="font-size:0.8rem;color:#888;margin:2px 0 0;">
                            <?= htmlspecialchars($link['desc']) ?>
                        </p>
                    </div>
                    <i class="bi bi-box-arrow-up-right ms-auto text-muted" aria-hidden="true"></i>
                    <!-- ms-auto = Bootstrap: margin-start:auto - pushes icon to far right -->
                </a>
            </div>
            <?php endforeach; // end of foreach loop ?>
        </div>
    </div>
</section>

<?php
// ============================================================
// INLINE JAVASCRIPT (Requirement: Sign-in / Sign-up JS Validation)
// Note: The calculator and toggle JS is in js/main.js
// The form validation below handles only the two forms on this page
// ============================================================
?>
<script>
// Sign-up Form JS Validation
// addEventListener('submit', ...) fires when the form's submit button is clicked
// OR when Enter is pressed inside the form
document.getElementById('signup-form').addEventListener('submit', function(e) {
    e.preventDefault(); // preventDefault stops the form from actually submitting to a server
    // Without this, the page would reload and all data would be lost

    var valid  = true;   // Tracks whether ALL validations pass
    // getElementById returns the DOM element with that id
    var name   = document.getElementById('su-name');
    var email  = document.getElementById('su-email');
    var pass   = document.getElementById('su-password');
    var conf   = document.getElementById('su-confirm');
    var agree  = document.getElementById('su-agree');
    var sucEl  = document.getElementById('signup-success');
    var errEl  = document.getElementById('signup-error');

    // First: hide any previous success/error messages and clear validation classes
    [name, email, pass, conf, agree].forEach(function(el) {
        // forEach = array method that runs a function on each element
        el.classList.remove('is-invalid', 'is-valid');
        // classList.remove() removes CSS classes from an element
    });
    sucEl.style.display = 'none'; // Hide success alert
    errEl.style.display = 'none'; // Hide error alert

    // VALIDATION CHECKS:
    // .trim() removes whitespace from both ends of a string
    // .length gives the number of characters
    if (name.value.trim().length < 2) {
        name.classList.add('is-invalid');  // is-invalid = Bootstrap: shows red border + error message
        valid = false;
    } else {
        name.classList.add('is-valid');    // is-valid = Bootstrap: shows green border
    }

    // Regular Expression (RegEx) to validate email format:
    // ^ = start of string
    // [^\s@]+ = one or more characters that are NOT whitespace or @
    // @ = literal @
    // [^\s@]+ = domain name part
    // \. = literal dot
    // [^\s@]+ = TLD (.com, .au etc.)
    // $ = end of string
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
        email.classList.add('is-invalid');
        valid = false;
    } else {
        email.classList.add('is-valid');
    }

    if (pass.value.length < 8) {
        pass.classList.add('is-invalid');
        valid = false;
    } else {
        pass.classList.add('is-valid');
    }

    // Check confirm password matches password AND is not empty
    if (conf.value !== pass.value || conf.value === '') {
        conf.classList.add('is-invalid');
        valid = false;
    } else {
        conf.classList.add('is-valid');
    }

    // .checked = boolean property of checkbox, true if ticked
    if (!agree.checked) {
        agree.classList.add('is-invalid');
        valid = false;
    }

    if (valid) {
        sucEl.style.display = 'block'; // Show success message
        this.reset();  // this = the form element, reset() clears all fields
        // Remove is-valid classes after reset so fields don't show green on empty form
        [name, email, pass, conf].forEach(function(el) {
            el.classList.remove('is-valid');
        });
    } else {
        errEl.style.display = 'block'; // Show general error message
    }
});

// Sign-in Form Validation
document.getElementById('signin-form').addEventListener('submit', function(e) {
    e.preventDefault();
    var valid = true;
    var email = document.getElementById('si-email');
    var pass  = document.getElementById('si-password');
    var sucEl = document.getElementById('signin-success');
    var errEl = document.getElementById('signin-error');

    [email, pass].forEach(function(el) { el.classList.remove('is-invalid', 'is-valid'); });
    sucEl.style.display = 'none';
    errEl.style.display = 'none';

    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
        email.classList.add('is-invalid'); valid = false;
    } else { email.classList.add('is-valid'); }

    // For sign-in, any non-empty password is accepted (demo - real app would check server)
    if (pass.value.length < 1) {
        pass.classList.add('is-invalid'); valid = false;
    } else { pass.classList.add('is-valid'); }

    if (valid) {
        sucEl.style.display = 'block';
        this.reset();
        [email, pass].forEach(function(el) { el.classList.remove('is-valid'); });
    } else {
        errEl.style.display = 'block';
    }
});
</script>

<?php include 'includes/footer.php'; ?>