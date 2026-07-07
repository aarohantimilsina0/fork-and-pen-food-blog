<?php
/**
 * about.php  –  PAGE 6: About Us
 * BUG FIXED: Team section was not closed (missing </div></section>)
 * BUG FIXED: Aarohan's bio said "Alex covers..." - corrected to Aarohan
 *
 * Requirements:
 *  - Description of brand/team              ✓
 *  - Minimum three accessibility features   ✓
 *  - Inclusive and respectful language      ✓
 *  - Acknowledgement of Country             ✓
 *  - Contact information / social links     ✓
 */

$pageTitle = 'About Us';
include 'includes/header.php';
?>

<!-- Page Hero -->
<div class="page-hero" aria-labelledby="about-page-title">
    <div class="container">
        <nav aria-label="Breadcrumb navigation">
            <ol class="breadcrumb breadcrumb-fork">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">About Us</li>
            </ol>
        </nav>
        <h1 id="about-page-title">
            <i class="bi bi-people" aria-hidden="true"></i> About The Fork &amp; Pen
        </h1>
        <p>Who we are, what we stand for, and why we started this blog.</p>
    </div>
</div>


<!-- ===== BRAND STORY ===== -->
<section class="section-pad" aria-labelledby="story-heading">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <h2 class="section-title" id="story-heading">Our Story</h2>
                <p class="section-subtitle">How The Fork &amp; Pen came to life</p>

                <!-- <strong> = semantic bold - marks text as important, not just visually bold -->
                <p style="color:#555;font-weight:300;line-height:1.9;">
                    <strong>The Fork &amp; Pen</strong> was founded in 2026 by Aarohan Timilsina and
                    Saksham Bhandari — two friends who believed that honest food criticism was
                    disappearing under a wave of paid promotions and algorithmic recommendations.
                </p>
                <p style="color:#555;font-weight:300;line-height:1.9;">
                    What started as a shared notes document between friends quickly grew into a blog
                    with a dedicated readership. Today we publish weekly reviews, run an active
                    social community, and maintain Melbourne's most comprehensive independent
                    restaurant directory.
                </p>
                <p style="color:#555;font-weight:300;line-height:1.9;">
                    We are proud to be entirely self-funded. Every restaurant visit is paid for out
                    of our own pockets. No free meals. No sponsored posts. No affiliate links.
                    <strong>Just real food, honestly reviewed.</strong>
                </p>

                <!-- Statistics row using Bootstrap flex layout -->
                <div class="d-flex gap-3 flex-wrap mt-3">
                    <div class="text-center">
                        <!-- CSS variable: var(--clr-primary) references our custom property
                             defined in :root in style.css - allows consistent colour use -->
                        <div style="font-family:var(--font-display);font-size:2rem;
                                    font-weight:700;color:var(--clr-primary);">200+</div>
                        <div style="font-size:0.82rem;color:#aaa;">Reviews Published</div>
                    </div>
                    <div class="text-center">
                        <div style="font-family:var(--font-display);font-size:2rem;
                                    font-weight:700;color:var(--clr-primary);">80+</div>
                        <div style="font-size:0.82rem;color:#aaa;">Restaurants Visited</div>
                    </div>
                    <div class="text-center">
                        <div style="font-family:var(--font-display);font-size:2rem;
                                    font-weight:700;color:var(--clr-primary);">15k+</div>
                        <div style="font-size:0.82rem;color:#aaa;">Monthly Readers</div>
                    </div>
                </div>
            </div>

            <!-- Team photo placeholder with logo -->
            <div class="col-lg-6">
                <div class="text-center">
                    <!-- Logo image used as a large brand centrepiece -->
                    <img src="images/logo.png"
                         alt="The Fork and Pen brand logo - a fork and pen emblem representing honest food journalism"
                         style="width:200px;height:200px;border-radius:50%;
                                object-fit:cover;box-shadow:0 8px 40px rgba(0,0,0,0.18);"
                         loading="lazy">
                    <p style="color:#A8968A;margin-top:1.5rem;font-family:var(--font-display);
                               font-size:1rem;">
                        Aarohan Timilsina &amp; Saksham Bhandari — Melbourne, 2026
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ===== TEAM SECTION (Requirement: Brand/team description) ===== -->
<!-- aria-labelledby="team-heading" links this section to its h2 for screen readers -->
<section class="section-pad bg-warm" aria-labelledby="team-heading">
    <div class="container">
        <h2 class="section-title text-center" id="team-heading"
            style="margin:0 auto 0.5rem;">Meet the Team</h2>
        <p class="section-subtitle text-center">The people behind every review</p>

        <div class="row g-4 justify-content-center">

            <!-- ── Team Member 1 ── -->
            <div class="col-sm-6 col-md-4">
                <div class="team-card">
                    <!-- Team avatar: a circle with the initial letter
                         aria-hidden="true" because the name is in the <h4> below -->
                    <div class="team-avatar" aria-hidden="true">A</div>
                    <h4>Aarohan Timilsina</h4>
                    <p style="color:var(--clr-primary);font-size:0.82rem;
                               font-weight:600;margin-bottom:0.5rem;">
                        Co-founder &amp; Lead Reviewer
                    </p>
                    <!-- BUG FIX: Original had "Alex covers..." - corrected to Aarohan -->
                    <p>Former chef with 8 years of professional kitchen experience.
                       Aarohan covers fine dining, contemporary Australian, and Japanese cuisine.</p>
                    <div class="social-links justify-content-center mt-3">
                        <!-- justify-content-center = Bootstrap: centres flex items horizontally -->
                        <a href="https://www.instagram.com/aarohan_timilsina/"
                           target="_blank" rel="noopener noreferrer"
                           aria-label="Follow Aarohan Timilsina on Instagram (opens in new tab)">
                            <i class="bi bi-instagram" aria-hidden="true"></i>
                        </a>
                        <a href="https://x.com/AarohanTimilsi1"
                           target="_blank" rel="noopener noreferrer"
                           aria-label="Follow Aarohan Timilsina on X / Twitter (opens in new tab)">
                            <i class="bi bi-twitter-x" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- ── Team Member 2 ── -->
            <div class="col-sm-6 col-md-4">
                <div class="team-card">
                    <!-- Different background colour using CSS variable for accent colour -->
                    <div class="team-avatar" style="background:var(--clr-accent);"
                         aria-hidden="true">S</div>
                    <h4>Saksham Bhandari</h4>
                    <p style="color:var(--clr-accent);font-size:0.82rem;
                               font-weight:600;margin-bottom:0.5rem;">
                        Co-founder &amp; Food Writer
                    </p>
                    <p>Journalist and food writer with a passion for street food, budget eats,
                       and the stories behind Melbourne's diverse migrant food culture.</p>
                    <div class="social-links justify-content-center mt-3">
                        <a href="https://www.instagram.com/_sakkb_/"
                           target="_blank" rel="noopener noreferrer"
                           aria-label="Follow Saksham Bhandari on Instagram (opens in new tab)">
                            <i class="bi bi-instagram" aria-hidden="true"></i>
                        </a>
                        <a href="https://x.com/__nut_haru__?s=11"
                           target="_blank" rel="noopener noreferrer"
                           aria-label="Follow Saksham Bhandari on X / Twitter (opens in new tab)">
                            <i class="bi bi-twitter-x" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div><!-- /row (team cards) -->
    </div><!-- /container -->
</section>
<!-- BUG FIX: Original was missing </div></section> here — the section was never closed,
     causing all subsequent sections to be nested inside it, breaking the layout -->


<!-- ===== VALUES & INCLUSIVITY (Requirement: Inclusive and respectful language) ===== -->
<section class="section-pad" aria-labelledby="values-heading">
    <div class="container">
        <div class="row g-5">

            <!-- Values column -->
            <div class="col-lg-6">
                <h2 class="section-title" id="values-heading">Our Values</h2>
                <p class="section-subtitle">What we believe and how we operate</p>
                <?php
                // Array of value objects - each with icon, title, description
                // Bootstrap Icons classes for bi-shield-check, bi-people, etc.
                $values = [
                    ['icon' => 'bi-shield-check',
                     'title' => 'Independence',
                     'desc' => 'We pay for every meal we review. No free meals, no sponsorships, no conflicts of interest — ever.'],
                    ['icon' => 'bi-people',
                     'title' => 'Inclusivity',
                     'desc' => 'We celebrate Melbourne\'s diverse food cultures. We review restaurants across all price points, cuisines, and communities — from the most expensive degustation to the most affordable street food.'],
                    ['icon' => 'bi-universal-access',
                     'title' => 'Accessibility',
                     'desc' => 'We note wheelchair access, allergen awareness, and dietary options in every review so that everyone can dine with confidence.'],
                    ['icon' => 'bi-heart',
                     'title' => 'Respect',
                     'desc' => 'We write with honesty and fairness. Critical reviews are never personal — we critique food and service, never people. We use inclusive language in all content.'],
                ];
                // foreach: loops through $values, each $v = one value item
                foreach ($values as $v):
                ?>
                <!-- d-flex gap-3 mb-4 = Bootstrap flex row with 1rem gap and bottom margin -->
                <div class="d-flex gap-3 mb-4">
                    <!-- Icon circle: inline styles for one-off customisation
                         flex-shrink:0 stops the circle from shrinking in a flex row -->
                    <div style="width:44px;height:44px;border-radius:50%;
                                background:#FFF0ED;display:flex;align-items:center;
                                justify-content:center;flex-shrink:0;" aria-hidden="true">
                        <i class="bi <?= $v['icon'] ?>"
                           style="color:var(--clr-primary);font-size:1.1rem;"></i>
                    </div>
                    <div>
                        <h3 style="font-size:1rem;margin-bottom:0.25rem;">
                            <?= htmlspecialchars($v['title']) ?>
                        </h3>
                        <p style="color:#666;font-size:0.88rem;font-weight:300;margin:0;">
                            <?= htmlspecialchars($v['desc']) ?>
                        </p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Accessibility Features column (Requirement: minimum 3 accessibility features) -->
            <div class="col-lg-6">
                <h2 class="section-title" id="accessibility-heading">Accessibility Features</h2>
                <p class="section-subtitle">This website is built for everyone</p>

                <!-- id="accessibility" provides anchor target for links like about.php#accessibility -->
                <div class="p-4 bg-white rounded-3 shadow-sm" id="accessibility"
                     aria-labelledby="accessibility-heading">
                    <p style="color:#555;font-size:0.92rem;margin-bottom:1.2rem;">
                        The Fork &amp; Pen follows
                        <!-- <abbr> = abbreviation element: title attribute shows full form on hover
                             Screen readers read out the full title for the abbreviation -->
                        <abbr title="Web Content Accessibility Guidelines">WCAG</abbr>
                        2.1 Level AA standards.
                    </p>

                    <!-- Accessibility features list (Requirement: min 3 features)
                         aria-label on the <ul> provides context for screen reader users -->
                    <ul style="list-style:none;padding:0;"
                        aria-label="Accessibility features on this website">

                        <!-- Feature 1: Text-to-Speech (Read Aloud) -->
                        <li class="d-flex gap-3 align-items-start mb-3">
                            <i class="bi bi-volume-up-fill"
                               style="color:var(--clr-primary);font-size:1.2rem;
                                      flex-shrink:0;margin-top:2px;" aria-hidden="true"></i>
                            <div>
                                <strong style="font-size:0.92rem;">Read Aloud / Text-to-Speech</strong>
                                <p style="color:#666;font-size:0.85rem;margin:2px 0 0;">
                                    Every page includes a "Read Aloud" button in the accessibility
                                    toolbar using the Web Speech API — supporting users with visual
                                    impairments or reading difficulties.
                                </p>
                            </div>
                        </li>

                        <!-- Feature 2: Alt Text for Images -->
                        <li class="d-flex gap-3 align-items-start mb-3">
                            <i class="bi bi-image-alt"
                               style="color:var(--clr-primary);font-size:1.2rem;
                                      flex-shrink:0;margin-top:2px;" aria-hidden="true"></i>
                            <div>
                                <strong style="font-size:0.92rem;">Alt Text for All Images &amp; Media</strong>
                                <p style="color:#666;font-size:0.85rem;margin:2px 0 0;">
                                    Every image includes descriptive alt text. Decorative icons
                                    use <code>aria-hidden="true"</code> so screen readers skip them.
                                    <!-- <code> = semantic inline code element, displayed in monospace font -->
                                </p>
                            </div>
                        </li>

                        <!-- Feature 3: Keyboard Accessibility -->
                        <li class="d-flex gap-3 align-items-start mb-3">
                            <i class="bi bi-keyboard"
                               style="color:var(--clr-primary);font-size:1.2rem;
                                      flex-shrink:0;margin-top:2px;" aria-hidden="true"></i>
                            <div>
                                <strong style="font-size:0.92rem;">Full Keyboard Accessibility</strong>
                                <p style="color:#666;font-size:0.85rem;margin:2px 0 0;">
                                    All interactive elements are operable via keyboard alone.
                                    A "Skip to main content" link appears on focus,
                                    and all toggles respond to Enter and Space keys.
                                </p>
                            </div>
                        </li>

                        <!-- Feature 4: Colour Contrast -->
                        <li class="d-flex gap-3 align-items-start mb-3">
                            <i class="bi bi-palette"
                               style="color:var(--clr-primary);font-size:1.2rem;
                                      flex-shrink:0;margin-top:2px;" aria-hidden="true"></i>
                            <div>
                                <strong style="font-size:0.92rem;">Web-Safe &amp; Accessible Colour Scheme</strong>
                                <p style="color:#666;font-size:0.85rem;margin:2px 0 0;">
                                    All colour combinations meet WCAG AA contrast ratios
                                    (minimum 4.5:1 for body text). A high-contrast toggle is
                                    available in the accessibility toolbar.
                                </p>
                            </div>
                        </li>

                        <!-- Feature 5: Inclusive Language -->
                        <li class="d-flex gap-3 align-items-start mb-3">
                            <i class="bi bi-chat-heart"
                               style="color:var(--clr-accent);font-size:1.2rem;
                                      flex-shrink:0;margin-top:2px;" aria-hidden="true"></i>
                            <div>
                                <strong style="font-size:0.92rem;">Inclusive &amp; Respectful Language</strong>
                                <p style="color:#666;font-size:0.85rem;margin:2px 0 0;">
                                    All content uses inclusive language. Reviews focus on food
                                    quality and experience, never personal characteristics of
                                    restaurant staff or owners.
                                </p>
                            </div>
                        </li>

                        <!-- Feature 6: First Nations Acknowledgement -->
                        <li class="d-flex gap-3 align-items-start">
                            <i class="bi bi-globe-asia-australia"
                               style="color:#D4AC0D;font-size:1.2rem;
                                      flex-shrink:0;margin-top:2px;" aria-hidden="true"></i>
                            <div>
                                <strong style="font-size:0.92rem;">First Nations Acknowledgement</strong>
                                <p style="color:#666;font-size:0.85rem;margin:2px 0 0;">
                                    Every page includes an Acknowledgement of Country recognising
                                    the Wurundjeri Woi-wurrung and Bunurong Boon Wurrung peoples
                                    as Traditional Custodians.
                                </p>
                            </div>
                        </li>
                    </ul>
                </div><!-- /accessibility box -->
            </div><!-- /col -->

        </div><!-- /row -->
    </div><!-- /container -->
</section>


<!-- ===== ACKNOWLEDGEMENT OF COUNTRY (Requirement: First Nations) ===== -->
<!-- id="acknowledgement" allows direct linking: about.php#acknowledgement -->
<section class="section-pad bg-warm" aria-labelledby="ack-heading" id="acknowledgement">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Dark themed box for prominence and respect -->
                <div style="background:#1A1A1A;border-radius:16px;padding:2.5rem;
                            border:1px solid #3A2D20;">
                    <div class="text-center mb-3">
                        <span style="font-size:2.5rem;" aria-hidden="true">🌏</span>
                    </div>
                    <h2 class="text-center" id="ack-heading"
                        style="font-family:var(--font-display);color:#D4AC0D;
                               font-size:1.5rem;margin-bottom:1rem;">
                        Acknowledgement of Country
                    </h2>
                    <p style="color:#C8B98A;font-weight:300;line-height:1.9;
                               text-align:center;margin-bottom:1rem;">
                        The Fork &amp; Pen acknowledges the Traditional Custodians of the lands
                        on which we live, work, and share food — the
                        <strong style="color:#E0CFA0;">Wurundjeri Woi-wurrung</strong>
                        and <strong style="color:#E0CFA0;">Bunurong Boon Wurrung</strong>
                        peoples of the Eastern Kulin Nation.
                    </p>
                    <p style="color:#C8B98A;font-weight:300;line-height:1.9;
                               text-align:center;margin-bottom:1rem;">
                        We pay our deepest respects to their Elders — past, present, and emerging —
                        and extend that respect to all First Nations peoples who visit this website.
                    </p>
                    <p style="color:#C8B98A;font-weight:300;line-height:1.9;
                               text-align:center;margin-bottom:1rem;">
                        We recognise that sovereignty of this land was never ceded, and we honour
                        the enduring spiritual, cultural, and physical connection that First Nations
                        peoples have with Country, waterways, sky, and community.
                    </p>
                    <p style="color:#D4AC0D;font-weight:600;text-align:center;
                               font-family:var(--font-display);font-size:1.1rem;margin:0;">
                        Always was, always will be Aboriginal land.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ===== PRIVACY & TERMS (linked from form checkboxes) ===== -->
<!-- id="privacy" allows direct anchor link: about.php#privacy -->
<section class="section-pad" aria-labelledby="privacy-heading" id="privacy">
    <div class="container">
        <div class="row g-5">
            <div class="col-md-6">
                <h2 class="section-title" id="privacy-heading">Privacy Policy</h2>
                <p style="color:#666;font-size:0.92rem;line-height:1.9;">
                    The Fork &amp; Pen collects contact information (name and email address) only
                    when you voluntarily submit our contact form. This information is used solely
                    to respond to your enquiry and is never shared, sold, or used for marketing
                    without your explicit consent.
                </p>
                <p style="color:#666;font-size:0.92rem;line-height:1.9;">
                    We do not use tracking cookies or analytics platforms that collect personally
                    identifiable information. Any anonymous usage statistics are used only to
                    improve the quality and accessibility of this website.
                </p>
            </div>
            <!-- id="terms" allows direct anchor link: about.php#terms -->
            <div class="col-md-6" id="terms">
                <h2 class="section-title" style="font-size:1.5rem;">Terms of Use</h2>
                <p style="color:#666;font-size:0.92rem;line-height:1.9;">
                    All content on The Fork &amp; Pen — including reviews, photographs, and written
                    articles — is the original intellectual property of The Fork &amp; Pen and its
                    contributors. Content may not be reproduced without written permission.
                </p>
                <p style="color:#666;font-size:0.92rem;line-height:1.9;">
                    Opinions expressed are those of the individual reviewer at the time of their
                    anonymous visit and reflect their personal experience. Restaurant quality and
                    service may vary over time.
                </p>
            </div>
        </div>
    </div>
</section>


<!-- ===== CONTACT INFO (Requirement: contact information on page 6) ===== -->
<section class="section-pad-sm bg-warm" aria-labelledby="contact-info-heading">
    <div class="container text-center">
        <h2 class="section-title text-center" id="contact-info-heading"
            style="margin:0 auto 0.5rem;">Get in Touch</h2>
        <p class="section-subtitle text-center">We love hearing from fellow food enthusiasts</p>
        <div class="row justify-content-center g-4">
            <div class="col-auto">
                <!-- <address> = semantic HTML for contact information
                     font-style:normal overrides default italic styling -->
                <address style="font-style:normal;">
                    <p>
                        <i class="bi bi-envelope" aria-hidden="true"></i>
                        <!-- mailto: link opens the user's default email client -->
                        <a href="mailto:hello@forkandpen.com.au">hello@forkandpen.com.au</a>
                    </p>
                    <p>
                        <i class="bi bi-telephone" aria-hidden="true"></i>
                        <!-- tel: link opens the phone dialler on mobile devices -->
                        <a href="tel:+61399999999">+61 3 9999 9999</a>
                    </p>
                    <p>
                        <i class="bi bi-geo-alt" aria-hidden="true"></i>
                        Melbourne, Victoria, Australia
                    </p>
                </address>
            </div>
        </div>

        <!-- Social Links (Requirement: social links on about page) -->
        <div class="social-links justify-content-center mt-3">
            <a href="https://instagram.com" target="_blank" rel="noopener noreferrer"
               aria-label="Follow us on Instagram (opens in new tab)">
                <i class="bi bi-instagram" aria-hidden="true"></i>
            </a>
            <a href="https://tiktok.com" target="_blank" rel="noopener noreferrer"
               aria-label="Follow us on TikTok (opens in new tab)">
                <i class="bi bi-tiktok" aria-hidden="true"></i>
            </a>
            <a href="https://youtube.com" target="_blank" rel="noopener noreferrer"
               aria-label="Watch us on YouTube (opens in new tab)">
                <i class="bi bi-youtube" aria-hidden="true"></i>
            </a>
            <a href="https://facebook.com" target="_blank" rel="noopener noreferrer"
               aria-label="Find us on Facebook (opens in new tab)">
                <i class="bi bi-facebook" aria-hidden="true"></i>
            </a>
        </div>
        <div class="mt-4">
            <a href="contact.php" class="btn-fork">Send Us a Message</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
