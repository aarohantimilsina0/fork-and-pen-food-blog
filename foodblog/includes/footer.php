<?php
// ============================================================
// footer.php – Shared footer for all pages
// ============================================================
?>
</main><!-- /main#main-content -->

<!-- ===== FOOTER ===== -->
<footer class="site-footer" role="contentinfo">
    <div class="container">
        <div class="row g-4 py-5">
            <!-- Brand Column -->
            <div class="col-md-4">
                <h3 class="footer-brand"><span aria-hidden="true"><img src="images/logo.png"
                         alt="The Fork and Pen brand logo - a fork and pen emblem representing honest food journalism"
                         style="width:100px;height:100px;border-radius:50%;
                                object-fit:cover;box-shadow:0 4px 20px rgba(0,0,0,0.18);"
                         loading="lazy"></h3>
                <p class="footer-desc">Melbourne's most honest food voice. We eat, we write, we repeat. No sponsored content – just real reviews from real food lovers.</p>
                <!-- Social Links -->
                <div class="social-links" aria-label="Social media links">
                    <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" aria-label="Follow us on Instagram (opens in new tab)"><i class="bi bi-instagram" aria-hidden="true"></i></a>
                    <a href="https://tiktok.com"    target="_blank" rel="noopener noreferrer" aria-label="Follow us on TikTok (opens in new tab)"><i class="bi bi-tiktok"     aria-hidden="true"></i></a>
                    <a href="https://youtube.com"   target="_blank" rel="noopener noreferrer" aria-label="Watch us on YouTube (opens in new tab)"><i class="bi bi-youtube"    aria-hidden="true"></i></a>
                    <a href="https://facebook.com"  target="_blank" rel="noopener noreferrer" aria-label="Find us on Facebook (opens in new tab)"><i class="bi bi-facebook"   aria-hidden="true"></i></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-md-2">
                <h4 class="footer-heading">Explore</h4>
                <ul class="footer-links" role="list">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="reviews.php">Reviews</a></li>
                    <li><a href="restaurants.php">Restaurants</a></li>
                    <li><a href="menu_manager.php">Menu Manager</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </div>

            <!-- External Links -->
            <div class="col-md-3">
                <h4 class="footer-heading">Resources</h4>
                <ul class="footer-links" role="list">
                    <li><a href="https://www.tripadvisor.com.au" target="_blank" rel="noopener noreferrer">TripAdvisor <i class="bi bi-box-arrow-up-right" aria-label="(opens in new tab)"></i></a></li>
                    <li><a href="https://www.zomato.com/australia" target="_blank" rel="noopener noreferrer">Zomato <i class="bi bi-box-arrow-up-right" aria-label="(opens in new tab)"></i></a></li>
                    <li><a href="https://www.goodfood.com.au" target="_blank" rel="noopener noreferrer">Good Food AU <i class="bi bi-box-arrow-up-right" aria-label="(opens in new tab)"></i></a></li>
                    <li><a href="https://www.yelp.com" target="_blank" rel="noopener noreferrer">Yelp <i class="bi bi-box-arrow-up-right" aria-label="(opens in new tab)"></i></a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="col-md-3">
                <h4 class="footer-heading">Contact Us</h4>
                <address class="footer-contact">
                    <p><i class="bi bi-geo-alt" aria-hidden="true"></i> Melbourne, Victoria, Australia</p>
                    <p><i class="bi bi-envelope" aria-hidden="true"></i> <a href="mailto:hello@forkandpen.com.au">hello@forkandpen.com.au</a></p>
                    <p><i class="bi bi-telephone" aria-hidden="true"></i> <a href="tel:+61399999999">+61 3 9999 9999</a></p>
                </address>
            </div>
        </div>

        <!-- First Nations Acknowledgement -->
        <div class="acknowledgement-section" role="complementary" aria-label="Acknowledgement of Country">
            <div class="row">
                <div class="col-12">
                    <h4 class="ack-title"><i class="bi bi-circle" aria-hidden="true"></i> Acknowledgement of Country</h4>
                    <p class="ack-text">
                        The Fork &amp; Pen acknowledges the Traditional Custodians of the land on which we operate —
                        the Wurundjeri Woi-wurrung and Bunurong Boon Wurrung peoples of the Eastern Kulin Nation.
                        We pay our deepest respects to their Elders, past, present, and emerging.
                        We recognise that sovereignty was never ceded, and honour the enduring connection
                        that First Nations peoples have with Country, culture, and community.
                        Always was, always will be Aboriginal land.
                    </p>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="footer-bottom">
            <p>&copy; <?= date('Y') ?> The Fork &amp; Pen. All rights reserved. | <a href="about.php">Privacy &amp; Accessibility</a></p>
            <p class="footer-note">Content created with inclusive and respectful language. This website is committed to accessibility for all users.</p>
        </div>
    </div>
</footer>
<!-- /FOOTER -->

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Site-wide JavaScript -->
<script src="js/main.js"></script>
</body>
</html>
