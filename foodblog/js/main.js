/**
 * main.js  –  The Fork & Pen  |  NIT1101 Assessment 2
 * Food Review Blog – JavaScript Interactivity
 *
 * Events used: click, submit, keydown, keyup, change, DOMContentLoaded, input
 * Logic:  show/hide content, calculators, toggles, dynamic content updates,
 *         font-size, high-contrast, text-to-speech, search filter, form validation
 */

'use strict';

// ============================================================
// 1. Accessibility Toolbar  (click events)
// ============================================================
(function initAccessibility() {
    const FONT_STEP = 2;
    const FONT_MIN  = 12;
    const FONT_MAX  = 24;

    // Font-size control
    const btnIncrease = document.getElementById('btn-font-increase');
    const btnDecrease = document.getElementById('btn-font-decrease');

    if (btnIncrease) {
        btnIncrease.addEventListener('click', function () {
            let current = parseInt(getComputedStyle(document.documentElement).fontSize);
            if (current < FONT_MAX) {
                document.documentElement.style.fontSize = (current + FONT_STEP) + 'px';
                announceToSR('Font size increased');
            }
        });
    }
    if (btnDecrease) {
        btnDecrease.addEventListener('click', function () {
            let current = parseInt(getComputedStyle(document.documentElement).fontSize);
            if (current > FONT_MIN) {
                document.documentElement.style.fontSize = (current - FONT_STEP) + 'px';
                announceToSR('Font size decreased');
            }
        });
    }

    // High-contrast toggle
    const btnContrast = document.getElementById('btn-contrast');
    if (btnContrast) {
        // Restore saved preference
        if (localStorage.getItem('hc') === '1') {
            document.body.classList.add('high-contrast');
        }
        btnContrast.addEventListener('click', function () {
            document.body.classList.toggle('high-contrast');
            const isHC = document.body.classList.contains('high-contrast');
            localStorage.setItem('hc', isHC ? '1' : '0');
            announceToSR(isHC ? 'High contrast mode on' : 'High contrast mode off');
        });
    }

    // Text-to-speech
    const btnTTS     = document.getElementById('btn-tts');
    const btnTTSStop = document.getElementById('btn-tts-stop');

    if (btnTTS && 'speechSynthesis' in window) {
        btnTTS.addEventListener('click', function () {
            window.speechSynthesis.cancel();
            const mainEl = document.getElementById('main-content');
            const text = mainEl ? mainEl.innerText : document.body.innerText;
            const utterance = new SpeechSynthesisUtterance(text.substring(0, 5000));
            utterance.lang  = 'en-AU';
            utterance.rate  = 0.95;
            window.speechSynthesis.speak(utterance);
        });
    } else if (btnTTS) {
        btnTTS.style.display = 'none';
    }

    if (btnTTSStop) {
        btnTTSStop.addEventListener('click', function () {
            if ('speechSynthesis' in window) window.speechSynthesis.cancel();
        });
    }
})();


// ============================================================
// 2. SR-only live region (Accessibility announcer)
// ============================================================
function announceToSR(message) {
    let announcer = document.getElementById('sr-announcer');
    if (!announcer) {
        announcer = document.createElement('div');
        announcer.id = 'sr-announcer';
        announcer.setAttribute('aria-live', 'polite');
        announcer.setAttribute('aria-atomic', 'true');
        announcer.className = 'visually-hidden';
        document.body.appendChild(announcer);
    }
    announcer.textContent = message;
    setTimeout(function () { announcer.textContent = ''; }, 3000);
}


// ============================================================
// 3. Review Search Filter  (keyup + input events)
// ============================================================
(function initSearchFilter() {
    const searchInput = document.getElementById('review-search');
    const cards       = document.querySelectorAll('.review-card-item');
    const noResults   = document.getElementById('no-results-msg');

    if (!searchInput || cards.length === 0) return;

    function filterCards() {
        const query = searchInput.value.trim().toLowerCase();
        let visibleCount = 0;

        cards.forEach(function (card) {
            const text = card.textContent.toLowerCase();
            const match = text.includes(query);
            card.style.display = match ? '' : 'none';
            if (match) visibleCount++;
        });

        if (noResults) {
            noResults.style.display = visibleCount === 0 ? 'block' : 'none';
        }
        announceToSR(visibleCount + ' results found');
    }

    // keyup event
    searchInput.addEventListener('keyup', filterCards);
    // input event covers paste/autofill
    searchInput.addEventListener('input', filterCards);
})();


// ============================================================
// 4. Restaurant Filter  (change event + click event)
// ============================================================
(function initRestaurantFilter() {
    const filterSelect = document.getElementById('cuisine-filter');
    const priceFilter  = document.getElementById('price-filter');
    const cards        = document.querySelectorAll('.restaurant-card-item');

    if (!filterSelect || cards.length === 0) return;

    function applyFilters() {
        const cuisine = filterSelect.value.toLowerCase();
        const price   = priceFilter ? priceFilter.value.toLowerCase() : '';

        cards.forEach(function (card) {
            const cardCuisine = (card.dataset.cuisine || '').toLowerCase();
            const cardPrice   = (card.dataset.price   || '').toLowerCase();

            const cuisineMatch = (cuisine === '' || cuisine === 'all' || cardCuisine === cuisine);
            const priceMatch   = (price   === '' || price   === 'all' || cardPrice   === price);

            card.style.display = (cuisineMatch && priceMatch) ? '' : 'none';
        });
        announceToSR('Restaurant list updated');
    }

    filterSelect.addEventListener('change', applyFilters);
    if (priceFilter) priceFilter.addEventListener('change', applyFilters);

    // Reset button
    const btnReset = document.getElementById('btn-filter-reset');
    if (btnReset) {
        btnReset.addEventListener('click', function () {
            if (filterSelect) filterSelect.value = 'all';
            if (priceFilter)  priceFilter.value  = 'all';
            applyFilters();
        });
    }
})();


// ============================================================
// 5. Contact Form Validation  (submit event + keydown)
// ============================================================
(function initContactForm() {
    const form         = document.getElementById('contact-form');
    const successAlert = document.getElementById('form-success');
    const errorAlert   = document.getElementById('form-error');

    if (!form) return;

    // Validation helpers
    function showError(inputEl, message) {
        inputEl.classList.add('is-invalid');
        const fb = inputEl.nextElementSibling;
        if (fb && fb.classList.contains('invalid-feedback')) fb.textContent = message;
    }
    function clearError(inputEl) {
        inputEl.classList.remove('is-invalid');
        inputEl.classList.add('is-valid');
    }

    // Real-time validation on keydown
    const inputs = form.querySelectorAll('input, textarea, select');
    inputs.forEach(function (el) {
        el.addEventListener('keydown', function () {
            if (el.classList.contains('is-invalid')) {
                el.classList.remove('is-invalid');
            }
        });
    });

    form.addEventListener('submit', function (e) {
        e.preventDefault(); // Prevent default submission

        // Hide alerts
        if (successAlert) successAlert.style.display = 'none';
        if (errorAlert)   errorAlert.style.display   = 'none';

        let valid = true;
        const nameEl    = document.getElementById('contact-name');
        const emailEl   = document.getElementById('contact-email');
        const subjectEl = document.getElementById('contact-subject');
        const msgEl     = document.getElementById('contact-message');
        const ratingEl  = document.getElementById('contact-rating');

        // Clear previous states
        [nameEl, emailEl, subjectEl, msgEl, ratingEl].forEach(function (el) {
            if (el) { el.classList.remove('is-invalid', 'is-valid'); }
        });

        // Name validation
        if (!nameEl || nameEl.value.trim().length < 2) {
            showError(nameEl, 'Please enter your full name (at least 2 characters).');
            valid = false;
        } else { clearError(nameEl); }

        // Email validation
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailEl || !emailPattern.test(emailEl.value.trim())) {
            showError(emailEl, 'Please enter a valid email address.');
            valid = false;
        } else { clearError(emailEl); }

        // Subject validation
        if (!subjectEl || subjectEl.value.trim().length < 3) {
            showError(subjectEl, 'Please enter a subject.');
            valid = false;
        } else { clearError(subjectEl); }

        // Message validation (min 15 chars)
        if (!msgEl || msgEl.value.trim().length < 15) {
            showError(msgEl, 'Please write a message with at least 15 characters.');
            valid = false;
        } else { clearError(msgEl); }

        if (valid) {
            // Show success, reset form
            if (successAlert) { successAlert.style.display = 'block'; }
            form.reset();
            inputs.forEach(function (el) { el.classList.remove('is-valid'); });
            announceToSR('Your message has been sent successfully!');
            // Scroll to success
            if (successAlert) { successAlert.scrollIntoView({ behavior: 'smooth', block: 'nearest' }); }
        } else {
            if (errorAlert) { errorAlert.style.display = 'block'; }
            announceToSR('Please fix the errors in the form before submitting.');
        }
    });
})();


// ============================================================
// 6. Average Rating Calculator (logic rule – calculators) – on index.php
// ============================================================
(function initRatingCalculator() {
    const btnCalc     = document.getElementById('btn-calc-rating');
    const foodInput   = document.getElementById('calc-food');
    const serviceInp  = document.getElementById('calc-service');
    const valueInp    = document.getElementById('calc-value');
    const ambianceSel = document.getElementById('calc-ambiance');
    const resultEl    = document.getElementById('calc-result');

    if (!btnCalc) return;

    // Weighting reflects "Our Scoring Criteria" order on reviews.php:
    // Food Quality > Value for Money > Service > Ambiance
    const WEIGHT_FOOD     = 0.40;
    const WEIGHT_VALUE    = 0.25;
    const WEIGHT_SERVICE  = 0.20;
    const WEIGHT_AMBIANCE = 0.15;

    btnCalc.addEventListener('click', function () {
        const food     = parseFloat(foodInput.value);
        const service  = parseFloat(serviceInp.value);
        const value    = parseFloat(valueInp.value);
        const ambiance = parseFloat(ambianceSel.value);

        // Validate each score is a number between 0 and 10
        const scores = [
            { val: food,     label: 'Food Quality' },
            { val: service,  label: 'Service' },
            { val: value,    label: 'Value for Money' },
            { val: ambiance, label: 'Ambiance' },
        ];

        for (const s of scores) {
            if (isNaN(s.val) || s.val < 0 || s.val > 10) {
                resultEl.innerHTML =
                    '<span class="text-danger">Please enter a ' + s.label +
                    ' score between 0 and 10.</span>';
                resultEl.style.display = 'block';
                announceToSR('Invalid ' + s.label + ' score entered');
                return;
            }
        }

        const overall = (food * WEIGHT_FOOD)
                      + (value * WEIGHT_VALUE)
                      + (service * WEIGHT_SERVICE)
                      + (ambiance * WEIGHT_AMBIANCE);

        // Convert the 0-10 overall score to a 0-5 star rating for display
        const starRating = (overall / 2);
        const fullStars  = Math.round(starRating * 2) / 2; // round to nearest 0.5

        resultEl.innerHTML =
            '<strong>Overall Rating:</strong> ' + overall.toFixed(1) + ' / 10<br>' +
            '<strong>Star Rating:</strong> ' + fullStars.toFixed(1) + ' / 5 ★<br>' +
            '<span style="font-size:0.85rem;color:#888;">' +
            'Calculated as: (Food × 40%) + (Value × 25%) + (Service × 20%) + (Ambiance × 15%)' +
            '</span>';
        resultEl.style.display = 'block';
        announceToSR('Overall rating calculated: ' + overall.toFixed(1) + ' out of 10');
    });

    // keydown event on inputs – allow Enter to calculate
    [foodInput, serviceInp, valueInp].forEach(function (el) {
        if (el) {
            el.addEventListener('keydown', function (e) {
                if (e.key === 'Enter') { btnCalc.click(); }
            });
        }
    });
})();


// ============================================================
// 7. Toggle Show/Hide (logic rule – show/hide content)
// ============================================================
(function initToggles() {
    // Toggle FAQ-style items
    const toggleBtns = document.querySelectorAll('[data-toggle-target]');
    toggleBtns.forEach(function (btn) {
        btn.addEventListener('click', function () {
            const targetId = btn.getAttribute('data-toggle-target');
            const target   = document.getElementById(targetId);
            if (!target) return;

            const isHidden = target.style.display === 'none' || target.style.display === '';
            target.style.display = isHidden ? 'block' : 'none';
            btn.setAttribute('aria-expanded', isHidden ? 'true' : 'false');
            announceToSR(isHidden ? 'Content expanded' : 'Content collapsed');
        });

        // Keyboard: Space / Enter
        btn.addEventListener('keydown', function (e) {
            if (e.key === ' ' || e.key === 'Enter') {
                e.preventDefault();
                btn.click();
            }
        });
    });

    // Rating stars interactive (logic rule – dynamic content update)
    const starContainers = document.querySelectorAll('.interactive-stars');
    starContainers.forEach(function (container) {
        const stars      = container.querySelectorAll('.istar');
        const ratingInput = document.getElementById(container.dataset.inputId);

        stars.forEach(function (star, index) {
            star.addEventListener('click', function () {
                const rating = index + 1;
                if (ratingInput) ratingInput.value = rating;
                stars.forEach(function (s, i) {
                    s.classList.toggle('bi-star-fill', i <= index);
                    s.classList.toggle('bi-star',      i >  index);
                });
                announceToSR('Rating set to ' + rating + ' out of 5');
            });

            star.addEventListener('keydown', function (e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    star.click();
                }
            });
        });
    });
})();


// ============================================================
// 8. Navbar scroll effect (click via scroll)
// ============================================================
(function initNavScroll() {
    const nav = document.getElementById('main-nav');
    if (!nav) return;
    window.addEventListener('scroll', function () {
        if (window.scrollY > 60) {
            nav.classList.add('scrolled');
        } else {
            nav.classList.remove('scrolled');
        }
    }, { passive: true });
})();


// ============================================================
// 9. Image gallery lightbox (click event)
// ============================================================
(function initGallery() {
    const galleryItems = document.querySelectorAll('.gallery-item');
    if (galleryItems.length === 0) return;

    galleryItems.forEach(function (item) {
        item.addEventListener('click', function () {
            const img = item.querySelector('img');
            if (!img) return;
            openLightbox(img.src, img.alt);
        });
        // Keyboard accessible
        item.setAttribute('tabindex', '0');
        item.setAttribute('role', 'button');
        item.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); item.click(); }
        });
    });

    function openLightbox(src, altText) {
        // Remove existing
        const existing = document.getElementById('lightbox-overlay');
        if (existing) existing.remove();

        const overlay = document.createElement('div');
        overlay.id = 'lightbox-overlay';
        overlay.setAttribute('role', 'dialog');
        overlay.setAttribute('aria-label', 'Image lightbox: ' + altText);
        overlay.setAttribute('aria-modal', 'true');
        overlay.style.cssText =
            'position:fixed;inset:0;background:rgba(0,0,0,0.88);z-index:9998;' +
            'display:flex;align-items:center;justify-content:center;cursor:zoom-out;' +
            'animation:fadeIn 0.2s ease;';

        const img = document.createElement('img');
        img.src = src;
        img.alt = altText;
        img.style.cssText =
            'max-width:90vw;max-height:85vh;border-radius:8px;box-shadow:0 8px 40px rgba(0,0,0,0.5);';

        const closeBtn = document.createElement('button');
        closeBtn.textContent = '✕';
        closeBtn.setAttribute('aria-label', 'Close lightbox');
        closeBtn.style.cssText =
            'position:absolute;top:20px;right:24px;background:transparent;border:none;' +
            'color:#fff;font-size:2rem;cursor:pointer;line-height:1;';

        overlay.appendChild(img);
        overlay.appendChild(closeBtn);
        document.body.appendChild(overlay);

        // Close on click overlay or button
        function closeLightbox() { overlay.remove(); }
        overlay.addEventListener('click', function (e) { if (e.target === overlay) closeLightbox(); });
        closeBtn.addEventListener('click', closeLightbox);

        // Close on Escape keydown
        document.addEventListener('keydown', function escHandler(e) {
            if (e.key === 'Escape') { closeLightbox(); document.removeEventListener('keydown', escHandler); }
        });
        closeBtn.focus();
    }
})();


// ============================================================
// 10. Menu Manager – inline form show/hide (click events)
// ============================================================
(function initManagerUI() {
    // Toggle "Add" form visibility
    const btnShowAdd = document.getElementById('btn-show-add');
    const addFormEl  = document.getElementById('add-form-wrapper');
    if (btnShowAdd && addFormEl) {
        addFormEl.style.display = 'none';
        btnShowAdd.addEventListener('click', function () {
            const hidden = addFormEl.style.display === 'none';
            addFormEl.style.display = hidden ? 'block' : 'none';
            btnShowAdd.setAttribute('aria-expanded', hidden ? 'true' : 'false');
            if (hidden) addFormEl.querySelector('input, select')?.focus();
        });
    }
})();


// ============================================================
// 11. Dynamic Word Counter (input event)
// ============================================================
(function initWordCounter() {
    const textAreas = document.querySelectorAll('[data-word-count]');
    textAreas.forEach(function (ta) {
        const counterId = ta.getAttribute('data-word-count');
        const counter   = document.getElementById(counterId);
        if (!counter) return;

        ta.addEventListener('input', function () {
            const words = ta.value.trim() === '' ? 0 : ta.value.trim().split(/\s+/).length;
            counter.textContent = words + ' word' + (words !== 1 ? 's' : '');
        });
    });
})();