<?php
/**
 * contact.php  –  PAGE 5: Contact & Feedback
 * BUG FIXED: word counter data-word-count="word-counter" changed to match id="word-counter"
 * BUG FIXED: privacy consent checkbox now validated in the inline JS below
 */
$pageTitle = 'Contact Us';
include 'includes/header.php';
?>

<!-- Page Hero -->
<div class="page-hero" aria-labelledby="contact-page-title">
    <div class="container">
        <nav aria-label="Breadcrumb navigation">
            <ol class="breadcrumb breadcrumb-fork">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Contact</li>
            </ol>
        </nav>
        <h1 id="contact-page-title">
            <i class="bi bi-envelope-open" aria-hidden="true"></i> Contact Us
        </h1>
        <p>Get in touch — we read every message and respond within 48 hours.</p>
    </div>
</div>

<section class="section-pad" aria-labelledby="contact-section-heading">
    <div class="container">
        <div class="row g-5">

            <!-- ===== CONTACT FORM ===== -->
            <div class="col-lg-7">
                <h2 class="section-title" id="contact-section-heading">Send Us a Message</h2>
                <p class="section-subtitle">
                    Reviews, suggestions, restaurant tips, or complaints — we want to hear it all.
                </p>

                <!-- Success / Error banners: hidden by default (CSS display:none via class)
                     JS shows them after form validation runs
                     role="status" = ARIA live region for polite announcements (non-interrupting)
                     role="alert"  = ARIA live region for urgent announcements (interrupts) -->
                <div id="form-success" class="alert-fork-success" role="status" aria-live="polite">
                    <i class="bi bi-check-circle-fill" aria-hidden="true"></i>
                    <strong>Message sent!</strong> Thanks for reaching out.
                    We'll get back to you within 48 hours.
                </div>
                <div id="form-error" class="alert-fork-error" role="alert">
                    <i class="bi bi-exclamation-triangle-fill" aria-hidden="true"></i>
                    Please fix the highlighted fields below before submitting.
                </div>

                <!-- novalidate: disables HTML5 native validation popup bubbles
                     We use our own JS validation for better control and accessibility -->
                <form id="contact-form" class="form-fork" novalidate
                      aria-label="Contact and feedback form">

                    <div class="row g-3">

                        <!-- Name field -->
                        <div class="col-sm-6">
                            <!-- for="contact-name" links label to input id="contact-name"
                                 Clicking label focuses the input field -->
                            <label for="contact-name" class="form-label">
                                Full Name
                                <span aria-hidden="true" class="text-danger">*</span>
                            </label>
                            <input type="text" id="contact-name" name="name"
                                   class="form-control" placeholder="Your full name"
                                   required autocomplete="name" aria-required="true">
                            <!-- name="name" attribute: if the form were submitted to a server,
                                 this would be the POST/GET variable name -->
                            <div class="invalid-feedback">
                                Please enter your full name (at least 2 characters).
                            </div>
                        </div>

                        <!-- Email field -->
                        <div class="col-sm-6">
                            <label for="contact-email" class="form-label">
                                Email Address
                                <span aria-hidden="true" class="text-danger">*</span>
                            </label>
                            <input type="email" id="contact-email" name="email"
                                   class="form-control" placeholder="you@example.com"
                                   required autocomplete="email" aria-required="true">
                            <div class="invalid-feedback">
                                Please enter a valid email address.
                            </div>
                        </div>

                        <!-- Message Type dropdown -->
                        <div class="col-sm-6">
                            <label for="contact-subject" class="form-label">
                                Message Type
                                <span aria-hidden="true" class="text-danger">*</span>
                            </label>
                            <!-- aria-describedby="subject-help": links input to its hint text
                                 Screen readers read the hint when the input is focused -->
                            <select id="contact-subject" name="subject" class="form-select"
                                    required aria-required="true"
                                    aria-describedby="subject-help">
                                <option value="">Select a type…</option>
                                <!-- value="" means nothing selected - our JS checks for empty value -->
                                <option value="review">Review Request</option>
                                <option value="suggestion">Restaurant Suggestion</option>
                                <option value="feedback">General Feedback</option>
                                <option value="complaint">Complaint</option>
                                <option value="partnership">Partnership Enquiry</option>
                                <option value="other">Other</option>
                            </select>
                            <div id="subject-help" class="form-text">
                                Tell us what your message is about.
                            </div>
                            <div class="invalid-feedback">Please select a message type.</div>
                        </div>

                        <!-- Restaurant name (optional field) -->
                        <div class="col-sm-6">
                            <label for="contact-restaurant" class="form-label">
                                Restaurant Name
                                <span style="color:#aaa;font-weight:300;">(optional)</span>
                            </label>
                            <!-- Not required - no validation needed for optional fields
                                 autocomplete="off" prevents browser from suggesting past values -->
                            <input type="text" id="contact-restaurant" name="restaurant"
                                   class="form-control" placeholder="If applicable"
                                   autocomplete="off">
                        </div>

                        <!-- Interactive Star Rating (JS dynamic content update) -->
                        <div class="col-12">
                            <label class="form-label d-block">
                                Rate Your Experience
                                <span style="color:#aaa;font-weight:300;">(optional)</span>
                            </label>
                            <!-- role="radiogroup" + aria-label: groups the stars semantically
                                 Screen readers announce this as a radio button group -->
                            <div class="interactive-stars d-flex gap-1"
                                 data-input-id="contact-rating"
                                 role="radiogroup"
                                 aria-label="Rate your experience from 1 to 5 stars">
                                <?php
                                // PHP for loop generates 5 star icons
                                // $s = 1, 2, 3, 4, 5 - the star number
                                for ($s = 1; $s <= 5; $s++):
                                ?>
                                <!-- tabindex="0" makes non-focusable elements keyboard-focusable
                                     role="radio" + aria-checked for semantic star radio buttons
                                     JS in main.js handles click and keydown events on these -->
                                <i class="bi bi-star istar"
                                   style="font-size:1.6rem;color:#D4AC0D;cursor:pointer;"
                                   tabindex="0"
                                   role="radio"
                                   aria-label="<?= $s ?> star<?= $s > 1 ? 's' : '' ?>"
                                   aria-checked="false"></i>
                                <?php endfor; ?>
                            </div>
                            <!-- Hidden input stores the numeric rating value
                                 JS sets this when a star is clicked
                                 type="hidden" inputs are not visible but are sent with the form -->
                            <input type="hidden" id="contact-rating" name="rating" value="0">
                        </div>

                        <!-- Message textarea -->
                        <div class="col-12">
                            <label for="contact-message" class="form-label">
                                Your Message
                                <span aria-hidden="true" class="text-danger">*</span>
                            </label>
                            <!-- <textarea> = multi-line text input
                                 rows="6" = default visible height in lines
                                 BUG FIX: changed data-word-count="word-counter"
                                 to match id="word-counter" on the counter element below -->
                            <textarea id="contact-message" name="message"
                                      class="form-control" rows="6"
                                      placeholder="Write your message here (minimum 15 characters)…"
                                      required aria-required="true"
                                      data-word-count="word-counter"
                                      aria-describedby="word-counter"></textarea>
                            <!-- d-flex justify-content-between = Bootstrap: space between children -->
                            <div class="d-flex justify-content-between">
                                <div class="invalid-feedback">
                                    Please write a message with at least 15 characters.
                                </div>
                                <!-- id="word-counter" matches data-word-count above
                                     JS in main.js updates this text on input events
                                     aria-live="polite" announces count to screen readers -->
                                <small id="word-counter"
                                       style="color:#aaa;" aria-live="polite">0 words</small>
                            </div>
                        </div>

                        <!-- Privacy Consent Checkbox -->
                        <div class="col-12">
                            <div class="form-check">
                                <input type="checkbox" id="privacy-consent"
                                       class="form-check-input"
                                       name="consent" required aria-required="true">
                                <label for="privacy-consent" class="form-check-label"
                                       style="font-size:0.88rem;">
                                    I agree that my information may be used to respond to this
                                    enquiry, in accordance with the
                                    <a href="about.php#privacy">Privacy Policy</a>.
                                    <span aria-hidden="true" class="text-danger">*</span>
                                </label>
                                <!-- BUG FIX: Added invalid-feedback for the consent checkbox
                                     JS below now also validates this checkbox -->
                                <div class="invalid-feedback">
                                    You must agree to our Privacy Policy before submitting.
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-12">
                            <button type="submit" class="btn-fork px-5"
                                    aria-label="Submit your message to The Fork and Pen">
                                <i class="bi bi-send" aria-hidden="true"></i> Send Message
                            </button>
                            <span style="font-size:0.82rem;color:#aaa;margin-left:1rem;">
                                <span aria-hidden="true" class="text-danger">*</span>
                                Required fields
                            </span>
                        </div>
                    </div><!-- /row g-3 -->
                </form>
            </div><!-- /col-lg-7 (form column) -->


            <!-- ===== CONTACT INFO SIDEBAR ===== -->
            <div class="col-lg-5">
                <h2 class="section-title" style="font-size:1.4rem;">Other Ways to Reach Us</h2>
                <p class="section-subtitle">We're active on social media and respond quickly.</p>

                <!-- Contact Details using semantic <address> element -->
                <address>
                    <!-- Contact icon boxes: reusable layout component styled in CSS -->
                    <div class="contact-icon-box">
                        <div class="ci-icon" aria-hidden="true">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <div>
                            <strong style="font-size:0.88rem;color:#333;">Email</strong>
                            <p style="font-size:0.85rem;color:#666;margin:2px 0 0;">
                                <a href="mailto:hello@forkandpen.com.au">hello@forkandpen.com.au</a>
                            </p>
                            <p style="font-size:0.78rem;color:#aaa;margin:0;">
                                Replies within 48 hours
                            </p>
                        </div>
                    </div>

                    <div class="contact-icon-box">
                        <div class="ci-icon" aria-hidden="true">
                            <i class="bi bi-telephone"></i>
                        </div>
                        <div>
                            <strong style="font-size:0.88rem;color:#333;">Phone</strong>
                            <p style="font-size:0.85rem;color:#666;margin:2px 0 0;">
                                <a href="tel:+61399999999">+61 3 9999 9999</a>
                            </p>
                            <p style="font-size:0.78rem;color:#aaa;margin:0;">
                                Mon–Fri, 9am–5pm AEDT
                            </p>
                        </div>
                    </div>

                    <div class="contact-icon-box">
                        <div class="ci-icon" aria-hidden="true">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <div>
                            <strong style="font-size:0.88rem;color:#333;">Location</strong>
                            <p style="font-size:0.85rem;color:#666;margin:2px 0 0;">
                                Melbourne, Victoria, Australia
                            </p>
                            <p style="font-size:0.78rem;color:#aaa;margin:0;">
                                We cover all Melbourne suburbs
                            </p>
                        </div>
                    </div>
                </address>

                <!-- Social Media Links -->
                <h3 style="font-size:1rem;margin:1.5rem 0 0.75rem;
                           font-family:var(--font-display);">Follow Us</h3>
                <div class="d-flex flex-column gap-2">
                    <!-- flex-column = Bootstrap: flex direction vertical (stacked cards) -->
                    <a href="https://instagram.com" target="_blank" rel="noopener noreferrer"
                       class="d-flex align-items-center gap-3 p-3 bg-white rounded-3
                              shadow-sm text-decoration-none"
                       aria-label="Follow The Fork and Pen on Instagram (opens in new tab)">
                        <i class="bi bi-instagram"
                           style="font-size:1.3rem;color:#E1306C;" aria-hidden="true"></i>
                        <div>
                            <strong style="font-size:0.88rem;color:#333;">Instagram</strong>
                            <p style="font-size:0.78rem;color:#aaa;margin:0;">@forkandpen.au</p>
                        </div>
                    </a>
                    <a href="https://tiktok.com" target="_blank" rel="noopener noreferrer"
                       class="d-flex align-items-center gap-3 p-3 bg-white rounded-3
                              shadow-sm text-decoration-none"
                       aria-label="Follow The Fork and Pen on TikTok (opens in new tab)">
                        <i class="bi bi-tiktok"
                           style="font-size:1.3rem;color:#010101;" aria-hidden="true"></i>
                        <div>
                            <strong style="font-size:0.88rem;color:#333;">TikTok</strong>
                            <p style="font-size:0.78rem;color:#aaa;margin:0;">@forkandpen</p>
                        </div>
                    </a>
                    <a href="https://youtube.com" target="_blank" rel="noopener noreferrer"
                       class="d-flex align-items-center gap-3 p-3 bg-white rounded-3
                              shadow-sm text-decoration-none"
                       aria-label="Watch The Fork and Pen on YouTube (opens in new tab)">
                        <i class="bi bi-youtube"
                           style="font-size:1.3rem;color:#FF0000;" aria-hidden="true"></i>
                        <div>
                            <strong style="font-size:0.88rem;color:#333;">YouTube</strong>
                            <p style="font-size:0.78rem;color:#aaa;margin:0;">
                                The Fork &amp; Pen
                            </p>
                        </div>
                    </a>
                </div>

                <!-- FAQ Toggle (JS show/hide logic) -->
                <h3 style="font-size:1rem;margin:1.5rem 0 0.75rem;
                           font-family:var(--font-display);">FAQs</h3>
                <?php
                // Array of FAQ items - each with a question and answer
                $faqs = [
                    [
                        'q' => 'Do you accept paid reviews?',
                        'a' => 'Absolutely not. All reviews are independent, anonymous, and unpaid. We never accept money, free meals, or gifts in exchange for coverage.'
                    ],
                    [
                        'q' => 'How do I suggest a restaurant?',
                        'a' => 'Use the contact form above and select "Restaurant Suggestion". We read every submission and aim to visit within 3 months.'
                    ],
                    [
                        'q' => 'Can I write a guest review?',
                        'a' => 'Yes! We occasionally feature guest reviewers. Send us a sample review via the form and we\'ll be in touch if it\'s a fit.'
                    ],
                ];
                // $idx = index (0, 1, 2) used to create unique IDs for each FAQ
                foreach ($faqs as $idx => $faq):
                ?>
                <div class="mb-2">
                    <!-- data-toggle-target: JS in main.js listens for click on buttons
                         with this attribute and toggles the matching element's display
                         aria-expanded="false": ARIA state, updated by JS to "true" when open
                         aria-controls: links button to the element it controls -->
                    <button class="w-100 text-start p-3 bg-white rounded-3 shadow-sm
                                   border-0 d-flex justify-content-between align-items-center"
                            data-toggle-target="faq-<?= $idx ?>"
                            aria-expanded="false"
                            aria-controls="faq-<?= $idx ?>"
                            style="font-size:0.88rem;font-weight:600;color:#333;cursor:pointer;">
                        <?= htmlspecialchars($faq['q']) ?>
                        <i class="bi bi-chevron-down" aria-hidden="true"></i>
                    </button>
                    <!-- Initially hidden with display:none
                         JS sets display:block when the button above is clicked -->
                    <div id="faq-<?= $idx ?>"
                         style="display:none;padding:0.75rem 1rem;
                                background:#F9F6F2;border-radius:0 0 8px 8px;
                                font-size:0.85rem;color:#666;">
                        <?= htmlspecialchars($faq['a']) ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div><!-- /col-lg-5 sidebar -->

        </div><!-- /row -->
    </div><!-- /container -->
</section>

<?php
// ============================================================
// CONTACT FORM JS VALIDATION (inline, specific to this page)
// Note: main.js also has initContactForm() but the privacy
// consent fix is done here as a complete standalone version
// ============================================================
?>
<script>
(function() {
    'use strict'; // Strict mode: prevents use of undeclared variables, safer code

    var form        = document.getElementById('contact-form');
    var successAlert= document.getElementById('form-success');
    var errorAlert  = document.getElementById('form-error');

    if (!form) return; // Guard: exit if form not found on this page

    // Helper function: marks a field invalid and shows its error message
    // Parameters: el = the input element, msg = optional custom message string
    function setInvalid(el, msg) {
        el.classList.add('is-invalid');    // Bootstrap: shows red border
        el.classList.remove('is-valid');
        if (msg) {
            // Find the .invalid-feedback element that follows this input
            var fb = el.parentElement.querySelector('.invalid-feedback');
            if (fb) fb.textContent = msg; // Update error text
        }
    }

    // Helper function: marks a field as valid
    function setValid(el) {
        el.classList.remove('is-invalid');
        el.classList.add('is-valid');     // Bootstrap: shows green border
    }

    // Email validation RegEx (same pattern used in index.php)
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    // submit event: fires when form submit button clicked or Enter pressed
    form.addEventListener('submit', function(e) {
        e.preventDefault(); // Stop default form submission (which would reload page)

        // Hide previous feedback messages
        successAlert.style.display = 'none';
        errorAlert.style.display   = 'none';

        // Grab all the fields we need to validate
        var nameEl    = document.getElementById('contact-name');
        var emailEl   = document.getElementById('contact-email');
        var subjectEl = document.getElementById('contact-subject');
        var msgEl     = document.getElementById('contact-message');
        var consentEl = document.getElementById('privacy-consent'); // BUG FIX: now validated

        // Clear previous validation state on all fields
        [nameEl, emailEl, subjectEl, msgEl].forEach(function(el) {
            el.classList.remove('is-invalid', 'is-valid');
        });
        consentEl.classList.remove('is-invalid');

        var valid = true; // Assume valid until a check fails

        // ── Validate Name ──
        if (nameEl.value.trim().length < 2) {
            setInvalid(nameEl, 'Please enter your full name (at least 2 characters).');
            valid = false;
        } else {
            setValid(nameEl);
        }

        // ── Validate Email ──
        if (!emailRegex.test(emailEl.value.trim())) {
            setInvalid(emailEl, 'Please enter a valid email address.');
            valid = false;
        } else {
            setValid(emailEl);
        }

        // ── Validate Subject dropdown ──
        // .value === '' means the placeholder "Select a type…" option is still selected
        if (subjectEl.value === '') {
            setInvalid(subjectEl, 'Please select a message type.');
            valid = false;
        } else {
            setValid(subjectEl);
        }

        // ── Validate Message ──
        // .trim() removes leading/trailing whitespace before checking length
        if (msgEl.value.trim().length < 15) {
            setInvalid(msgEl, 'Please write a message with at least 15 characters.');
            valid = false;
        } else {
            setValid(msgEl);
        }

        // ── BUG FIX: Validate Privacy Consent Checkbox ──
        // .checked is a boolean property: true if the checkbox is ticked
        if (!consentEl.checked) {
            consentEl.classList.add('is-invalid');
            valid = false;
        }

        // ── Final result ──
        if (valid) {
            successAlert.style.display = 'block'; // Show green success banner
            form.reset(); // Clear all fields

            // Remove Bootstrap validation classes after reset
            // so fields don't show green borders on empty form
            [nameEl, emailEl, subjectEl, msgEl].forEach(function(el) {
                el.classList.remove('is-valid');
            });

            // Scroll success banner into view smoothly
            successAlert.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        } else {
            errorAlert.style.display = 'block'; // Show red error banner
            // Find and focus the first invalid field for better accessibility
            var firstInvalid = form.querySelector('.is-invalid');
            if (firstInvalid) firstInvalid.focus();
        }
    });

    // Real-time validation: clear errors as user types
    // This makes the form feel more responsive
    form.querySelectorAll('input, textarea, select').forEach(function(el) {
        // input event: fires on every keystroke for text/textarea
        // change event: fires when select value changes
        el.addEventListener('input', function() {
            if (el.classList.contains('is-invalid')) {
                el.classList.remove('is-invalid');
            }
        });
        el.addEventListener('change', function() {
            if (el.classList.contains('is-invalid')) {
                el.classList.remove('is-invalid');
            }
        });
    });
})(); // IIFE: Immediately Invoked Function Expression
     // Wraps code in a function scope to avoid polluting global namespace
     // The () at the end immediately calls the function
</script>

<?php include 'includes/footer.php'; ?>
