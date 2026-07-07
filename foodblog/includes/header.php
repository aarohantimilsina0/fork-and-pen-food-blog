<?php
// ============================================================
// header.php – Shared navigation header for all pages
// ============================================================
// $pageTitle must be set BEFORE including this file
if (!isset($pageTitle)) { $pageTitle = 'The Fork & Pen'; }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="The Fork &amp; Pen – Melbourne's premier food review blog. Honest reviews, hidden gems, unforgettable bites.">
    <!-- Accessibility: language declared, viewport set -->

    <title><?= htmlspecialchars($pageTitle) ?> | The Fork &amp; Pen</title>

    <!-- Bootstrap 5 CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <!-- External CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Print stylesheet -->
    <link rel="stylesheet" href="css/print.css" media="print">

    <!-- Accessibility: Skip to content link target -->
</head>
<body>

<!-- Accessibility: Skip Navigation -->
<a href="#main-content" class="skip-link visually-hidden-focusable">Skip to main content</a>

<!-- Accessibility: Toolbar (Text-to-speech + Font size) -->
<div id="accessibility-bar" role="complementary" aria-label="Accessibility tools">
    <div class="container-fluid d-flex align-items-center gap-3 py-1 px-3">
        <span class="acc-label"><i class="bi bi-universal-access"></i> Accessibility:</span>
        <button id="btn-tts" class="acc-btn" title="Read page aloud" aria-label="Read page aloud (text to speech)">
            <i class="bi bi-volume-up-fill"></i> Read Aloud
        </button>
        <button id="btn-tts-stop" class="acc-btn" title="Stop reading" aria-label="Stop reading">
            <i class="bi bi-stop-fill"></i> Stop
        </button>
        <button id="btn-font-increase" class="acc-btn" title="Increase font size" aria-label="Increase font size">
            A+
        </button>
        <button id="btn-font-decrease" class="acc-btn" title="Decrease font size" aria-label="Decrease font size">
            A−
        </button>
        <button id="btn-contrast" class="acc-btn" title="Toggle high contrast" aria-label="Toggle high contrast mode">
            <i class="bi bi-circle-half"></i> Contrast
        </button>
    </div>
</div>

<!-- ===== NAVIGATION ===== -->
<nav class="navbar navbar-expand-lg sticky-top" id="main-nav" role="navigation" aria-label="Main navigation">
    <div class="container">
        <!-- Brand Logo & Tagline -->
        <a class="navbar-brand d-flex align-items-center gap-2" href="index.php" aria-label="The Fork and Pen – Home">
            <span class="brand-icon" aria-hidden="true"></span>
            <span>
                <img src="images/logo.png"
                         alt="The Fork and Pen brand logo - a fork and pen emblem representing honest food journalism"
                         style="width:100px;height:100px;border-radius:50%;
                                object-fit:cover;box-shadow:0 4px 20px rgba(0,0,0,0.18);"
                         loading="lazy">
                <small class="brand-tagline d-block">Melbourne's Honest Food Voice</small>
            </span>
        </a>

        <!-- Mobile Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#mainMenu" aria-controls="mainMenu"
                aria-expanded="false" aria-label="Toggle navigation menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Nav Links -->
        <div class="collapse navbar-collapse" id="mainMenu">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0" role="list">
                <li class="nav-item"><a class="nav-link <?= (basename($_SERVER['PHP_SELF'])=='index.php'?'active':'') ?>" href="index.php" <?= (basename($_SERVER['PHP_SELF'])=='index.php'?'aria-current="page"':'') ?>>Home</a></li>
                <li class="nav-item"><a class="nav-link <?= (basename($_SERVER['PHP_SELF'])=='reviews.php'?'active':'') ?>" href="reviews.php" <?= (basename($_SERVER['PHP_SELF'])=='reviews.php'?'aria-current="page"':'') ?>>Reviews</a></li>
                <li class="nav-item"><a class="nav-link <?= (basename($_SERVER['PHP_SELF'])=='restaurants.php'?'active':'') ?>" href="restaurants.php" <?= (basename($_SERVER['PHP_SELF'])=='restaurants.php'?'aria-current="page"':'') ?>>Restaurants</a></li>
                <li class="nav-item"><a class="nav-link <?= (basename($_SERVER['PHP_SELF'])=='menu_manager.php'?'active':'') ?>" href="menu_manager.php" <?= (basename($_SERVER['PHP_SELF'])=='menu_manager.php'?'aria-current="page"':'') ?>>Menu Manager</a></li>
                <li class="nav-item"><a class="nav-link <?= (basename($_SERVER['PHP_SELF'])=='about.php'?'active':'') ?>" href="about.php" <?= (basename($_SERVER['PHP_SELF'])=='about.php'?'aria-current="page"':'') ?>>About</a></li>
                <li class="nav-item"><a class="nav-link <?= (basename($_SERVER['PHP_SELF'])=='contact.php'?'active':'') ?>" href="contact.php" <?= (basename($_SERVER['PHP_SELF'])=='contact.php'?'aria-current="page"':'') ?>>Contact</a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- /NAVIGATION -->

<main id="main-content" tabindex="-1">
