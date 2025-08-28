<?php 
$site_settings = \app\http\models\SiteSettings::all()->first()->get();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- Seo Information -->
  <meta name="description" content="<?= !empty($page['meta_description']) ? htmlspecialchars($page['meta_description']) : htmlspecialchars($page['og_description'] ?? '') ?>">
  <meta name="keywords" content="<?= htmlspecialchars($page['meta_tags'] ?? '') ?>">
  <title><?= htmlspecialchars($page['page_title'] ?? '') ?></title>
  
  <!-- Open Graph Meta Tags for Social Media -->
  <meta property="og:title" content="<?= htmlspecialchars($page['og_title'] ?? $page['page_title'] ?? '') ?>">
  <meta property="og:description" content="<?= htmlspecialchars(trim($page['og_description'] ?? '')) ?>">
  <meta property="og:type" content="article">
  <meta property="og:image" content="<?= rtrim(getenv('SITE_URL'),'/').assets("/uploads/".($page['og_image'] ?? $page['banner_image'] ?? '')) ?>">
  <meta property="og:url" content="<?= rtrim(getenv('SITE_URL'),'/').($route ?? '') ?>">
  <link rel="shortcut icon" href="<?= assets('/uploads/').($site_settings['icon'] ?? '') ?>" type="image/x-icon">
  <link rel="canonical" href="<?= rtrim(getenv('SITE_URL'),'/').($route ?? '') ?>">
  
  <!--Meta Twitter-->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= htmlspecialchars($page['og_title'] ?? $page['page_title'] ?? '') ?>">
  <meta name="twitter:description" content="<?= htmlspecialchars(trim($page['og_description'] ?? '')) ?>">
  <meta name="twitter:image" content="<?= rtrim(getenv('SITE_URL'),'/').assets("/uploads/".($page['og_image'] ?? $page['banner_image'] ?? '')) ?>?v=1">
  <meta name="twitter:url" content="<?= rtrim(getenv('SITE_URL'),'/').($route ?? '') ?>">
  
  <!-- ========= SCHEMA MARKUP ========= -->
  <!-- Organization Schema -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": ["Organization"],
    "name": "Fuji Industry (Ningbo) Company Limited",
    "url": "https://www.fujielevatorjapan.com/",
    "logo": "https://www.fujielevatorjapan.com/uploads/1837155014298329.webp",
    "foundingDate": "1965",
    "founder": {
      "@type": "Person",
      "name": "Otani Notake"
    },
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "NO.489 WEST JINSHAN RD, YINZHOU DISTRICT",
      "addressLocality": "Ningbo",
      "addressRegion": "Zhejiang",
      "postalCode": "315000",
      "addressCountry": "CN"
    },
    "contactPoint": {
      "@type": "ContactPoint",
      "contactType": "Sales Director",
      "telephone": "+8618657970560",
      "availableLanguage": ["Chinese", "English", "Bangla", "Arabic"]
    },
    "sameAs": [
      "https://www.facebook.com/fujielevatorjp",
      "https://www.instagram.com/fujielevatorjp/",
      "https://www.youtube.com/@fujielevatorjp",
      "https://api.whatsapp.com/send/?phone=8618657970560"
    ]
  }
  </script>
  
  <link rel="stylesheet" type="text/css" href="<?= assets("/frontend/assets/bootstrap.min.css") ?>">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="<?= assets("/frontend/assets/style.css") ?>">
  
  <style>
    /* UPDATED: Contact Bar - Solid red background */
    .contact-bar {
      background: #ad1009;
      color: white;
      padding: 8px 0;
      font-size: 0.85rem;
    }
    
    .contact-bar a {
      color: #ffffff !important;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      margin: 0 6px;
      padding: 0;
      transition: color 0.3s ease;
    }
    
    .contact-bar a:hover {
      color: #a0d1ff !important;
    }
    
    /* Social Icons */
    .social-icons a {
      color: #ffffff !important;
      font-size: 1rem;
      margin: 0 6px;
      padding: 0;
      background: transparent !important;
      width: auto;
      height: auto;
    }
    
    /* Contact links - BOLD FONT */
    .contact-link {
      color: #ffffff !important;
      font-size: 0.9rem !important;
      font-weight: 700 !important; /* Added bold font weight */
      padding: 0 !important;
      background: transparent !important;
      border-radius: 0;
      white-space: nowrap;
      display: flex;
      align-items: center;
    }
    
    .contact-link i {
      margin-right: 8px;
      font-size: 1rem;
    }
    
    /* Search Bar - UPDATED with proper touch target size */
    .search-container {
      max-width: 250px;
    }
    
    .search-form {
      position: relative;
      display: flex;
      align-items: center;
    }
    
    .search-input {
      width: 100%;
      padding: 8px 50px 8px 15px; /* Increased right padding for larger touch target */
      height: 40px; /* Increased height for better touch target */
      font-size: 0.9rem;
      border: none;
      border-radius: 4px;
      background: #ffffff;
      color: #000000;
      transition: all 0.3s ease;
    }
    
    .search-input:focus {
      outline: none;
      box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.5);
    }
    
    .search-icon {
      position: absolute;
      right: 8px; /* Adjusted positioning */
      top: 50%;
      transform: translateY(-50%);
      color: #ad1009;
      font-size: 1.2rem; /* Larger icon size */
      cursor: pointer;
      background: none;
      border: none;
      padding: 8px; /* Increased padding for larger touch target */
      width: 40px; /* Minimum touch target size */
      height: 40px; /* Minimum touch target size */
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 4px;
      transition: background-color 0.3s ease;
    }
    
    .search-icon:hover {
      background-color: rgba(173, 16, 9, 0.1);
    }
    
    /* Navbar adjustments */
    .navbar {
      padding-top: 4px !important;
      padding-bottom: 4px !important;
    }
    
    /* Mobile Menu Toggler - Red Color */
    .navbar-toggler {
      color: #ad1009 !important;
      border: none !important;
      outline: none !important;
      box-shadow: none !important;
    }
    
    .navbar-toggler .fas {
      color: inherit;
    }
    
    /* ========= RESPONSIVE ADJUSTMENTS ========= */
    /* Contact bar grid adjustments */
    .contact-bar-grid {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      align-items: center;
      width: 100%;
    }
    
    .contact-bar-section {
      display: flex;
      align-items: center;
    }
    
    .social-icons-container {
      flex: 1;
      justify-content: flex-start;
    }
    
    .contact-info-section {
      flex: 2;
      justify-content: center;
      display: flex;
      flex-wrap: wrap;
      gap: 15px;
    }
    
    .search-section {
      flex: 1;
      justify-content: flex-end;
    }
    
    /* Email and WhatsApp side by side */
    .email-section, .whatsapp-section {
      display: flex;
      align-items: center;
    }
    
    /* Large desktop (1200px and above) */
    @media (min-width: 1200px) {
      .contact-info-section {
        justify-content: center;
        gap: 30px;
      }
    }
    
    /* Medium desktop (992px to 1199px) */
    @media (min-width: 992px) and (max-width: 1199px) {
      .social-icons-container {
        display: none !important;
      }
      
      .contact-info-section {
        flex: 2;
        justify-content: center;
        gap: 20px;
      }
      
      .search-section {
        flex: 1;
        justify-content: flex-end;
      }
    }
    
    /* Tablets (768px to 991px) */
    @media (min-width: 768px) and (max-width: 991px) {
      .social-icons-container {
        display: none !important;
      }
      
      .contact-info-section {
        flex: 2;
        justify-content: center;
        gap: 15px;
      }
      
      .search-section {
        flex: 1;
        justify-content: flex-end;
      }
      
      .search-container {
        max-width: 180px;
      }
      
      .search-input {
        height: 38px;
        padding: 8px 45px 8px 12px;
      }
      
      .search-icon {
        width: 38px;
        height: 38px;
        padding: 7px;
        font-size: 1.1rem;
      }
    }
    
    /* Mobile landscape (576px to 767px) */
    @media (min-width: 576px) and (max-width: 767px) {
      .social-icons-container {
        display: none !important;
      }
      
      .contact-info-section {
        flex: 1;
        justify-content: center;
        gap: 10px;
      }
      
      .search-section {
        display: none !important;
      }
      
      .contact-link span {
        font-size: 0.8rem;
      }
    }
    
    /* Mobile portrait (up to 575px) */
    @media (max-width: 575px) {
      .social-icons-container {
        display: none !important;
      }
      
      .contact-info-section {
        flex-direction: column;
        gap: 5px;
        width: 100%;
      }
      
      .search-section {
        display: none !important;
      }
      
      .email-section, .whatsapp-section {
        justify-content: center;
        width: 100%;
      }
      
      .contact-link {
        font-size: 0.8rem !important;
      }
      
      .contact-link span {
        font-size: 0.8rem;
      }
    }
    
    /* Extra small devices */
    @media (max-width: 400px) {
      .contact-link span {
        font-size: 0.75rem;
      }
      
      .contact-link i {
        font-size: 0.9rem;
        margin-right: 5px;
      }
    }
    
    /* Navbar styles */
    .nav-item.dropdown:hover > .dropdown-menu {
      display: block;
    }
    
    .dropdown-submenu .dropdown-menu {
      display: none;
      left: 100%;
      top: 0;
      margin-top: -1px;
    }
    
    .dropdown-submenu:hover > .dropdown-menu {
      display: block;
    }
    
    .navbar-nav .nav-link {
      padding: 5px 10px !important;
      min-height: 10px;
      display: flex;
      align-items: center;
    }
    
    .dropdown-item {
      padding: 5px 10px !important;
      min-height: 05px;
      display: flex;
      align-items: center;
    }
    
    .navbar-toggler {
      width: 60px;
      height: 60px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
  </style>
</head>
<body>

<!-- Contact Bar with Red Background -->
<div class="contact-bar">
  <div class="container">
    <div class="contact-bar-grid">
      <!-- Social Icons -->
      <div class="contact-bar-section social-icons-container">
        <div class="social-icons">
          <a href="https://www.linkedin.com/company/108412251/" target="_blank" aria-label="LinkedIn">
            <i class="fab fa-linkedin"></i>
          </a>
          <a href="#" target="_blank" aria-label="Twitter">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="https://www.youtube.com/@fujielevatorjp" target="_blank" aria-label="YouTube">
            <i class="fab fa-youtube"></i>
          </a>
          <a href="https://www.instagram.com/fujielevatorjapan/" target="_blank" aria-label="Instagram">
            <i class="fab fa-instagram"></i>
          </a>
          <a href="https://www.facebook.com/fujielevatorjp" target="_blank" aria-label="Facebook">
            <i class="fab fa-facebook"></i>
          </a>
        </div>
      </div>
      
      <!-- Contact Info Section - Email and WhatsApp side by side -->
      <div class="contact-bar-section contact-info-section">
        <!-- Email -->
        <div class="email-section">
          <a href="mailto:sales@fujielevatorjapan.com" class="contact-link" title="Email Us" aria-label="Email us">
            <i class="fas fa-envelope"></i>
            <span>sales@fujielevatorjapan.com</span>
          </a>
        </div>
        
        <!-- WhatsApp -->
        <div class="whatsapp-section">
          <a href="https://wa.me/8618260179694" class="contact-link" title="Chat on WhatsApp" aria-label="Chat on WhatsApp" target="_blank">
            <i class="fab fa-whatsapp"></i>
            <span>+86 182 6017 9694</span>
          </a>
        </div>
      </div>
      
      <!-- Search Bar -->
      <div class="contact-bar-section search-section">
        <div class="search-container">
          <form action="/search/content" method="GET" class="search-form">
            <input type="text" class="form-control search-input" placeholder="Search products..." aria-label="Search website" name="search_key">
            <button type="submit" class="search-icon" aria-label="Search">
              <i class="fas fa-search"></i>
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg sticky-top" style="padding-top:0px; padding-bottom:0px;">
  <div class="container-fluid">
    <a class="navbar-brand" href="/" aria-label="Home">
      <div class="logo" style="
        background-image: url('<?= assets("/uploads/".($site_settings['logo'] ?? '')) ?>');
        background-position: center;
        background-repeat: no-repeat;
        background-size:contain;
        height:60px;
        width: 250px;
      " role="img" aria-label="<?= htmlspecialchars($site_settings['company_name'] ?? 'Company Logo') ?>"></div>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fas fa-bars"></i>
      <span class="sr-only">Menu</span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="/">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="/about" id="aboutDropdown" role="button" aria-expanded="false" aria-haspopup="true">
            About Us
          </a>
          <ul class="dropdown-menu" style="border-radius:0;" aria-labelledby="aboutDropdown">
            <li><a href="/why-choose-us" class="dropdown-item">Why Choose Us</a></li>
            <li><a href="/company-profile" class="dropdown-item">Company Profile</a></li>
            <li><a href="/projects" class="dropdown-item">Our Projects</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="/products" id="productsDropdown" role="button" aria-expanded="false" aria-haspopup="true">
            Products
          </a>
          <?php 
            $categories = \app\http\models\Categories::all()->get();
            if(count($categories)):
          ?>
          <ul class="dropdown-menu" aria-labelledby="productsDropdown" style="border-radius:0;">
            <?php foreach($categories as $category) : 
              $subcategories = \app\http\models\SubCategories::where($category['id'],'category_id')->get();
              $has_subcategories = count($subcategories);
            ?>
            <li class="dropdown-submenu position-relative">
              <a class="dropdown-item <?= $has_subcategories ? 'dropdown-toggle' : '' ?>" 
                 href="/products-categories/<?= strtolower(rtrim(preg_replace('/[\/\s]+/', '-', $category['category_name']), '-'))."-".$category['id'] ?>"
                 <?= $has_subcategories ? 'aria-haspopup="true" aria-expanded="false"' : '' ?>>
                <?= htmlspecialchars($category['category_name']) ?>
              </a>
              <?php if($has_subcategories): ?>
              <ul class="dropdown-menu" style="border-radius:0;">
                <?php foreach($subcategories as $subcategory) : ?>
                <li><a class="dropdown-item" href="/products-subcategories/<?= strtolower(rtrim(preg_replace('/[\/\s]+/', '-', $subcategory['subcategory_name']), '-'))."-".$subcategory['id'] ?>">
                  <?= htmlspecialchars($subcategory['subcategory_name']) ?>
                </a></li>
                <?php endforeach; ?>
              </ul>
              <?php endif; ?>
            </li>
            <?php endforeach; ?>
          </ul>
          <?php endif; ?>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/distributor">Distributor</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/blog">Blog</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="/faq">Faq</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/contact-us">Contact Us</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Reliable Bootstrap JS with mobile menu fix -->
<script src="<?= assets("/frontend/assets/bootstrap.bundle.min.js") ?>"></script>
<script>
  // Enhanced mobile menu toggle functionality
  document.addEventListener('DOMContentLoaded', function() {
    const navbarToggler = document.querySelector('.navbar-toggler');
    const navbarCollapse = document.querySelector('.navbar-collapse');
    
    if (navbarToggler && navbarCollapse) {
      // Fix for mobile menu toggle
      navbarToggler.addEventListener('click', function() {
        // Toggle the 'show' class directly
        navbarCollapse.classList.toggle('show');
        
        // Update aria-expanded attribute
        const isExpanded = navbarCollapse.classList.contains('show');
        navbarToggler.setAttribute('aria-expanded', isExpanded);
      });
      
      // Close menu when clicking on nav links
      const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
      navLinks.forEach(link => {
        link.addEventListener('click', function() {
          if (navbarCollapse.classList.contains('show')) {
            navbarCollapse.classList.remove('show');
            navbarToggler.setAttribute('aria-expanded', 'false');
          }
        });
      });
      
      // Close menu when clicking outside
      document.addEventListener('click', function(event) {
        const isClickInsideNav = navbarCollapse.contains(event.target) || navbarToggler.contains(event.target);
        
        if (!isClickInsideNav && navbarCollapse.classList.contains('show')) {
          navbarCollapse.classList.remove('show');
          navbarToggler.setAttribute('aria-expanded', 'false');
        }
      });
    }
  });
</script>
</body>
</html>