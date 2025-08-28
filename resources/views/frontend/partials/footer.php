<?php 
$site_settings = \app\http\models\SiteSettings::all()->first()->get();
?>

<!-- Floating QR Codes Container - Updated for icon toggle -->
<div class="floating-qr-container">
    <!-- WhatsApp QR Code -->
    <div class="qr-item whatsapp">
        <div class="qr-icon">
            <i class="fab fa-whatsapp"></i>
        </div>
        <div class="qr-content">
            <img src="<?= assets('/public/frontend/media/whatsapp-qr.png') ?>" 
                 alt="WhatsApp QR Code" 
                 class="qr-code">
            <div class="qr-label">WhatsApp</div>
        </div>
    </div>
    
    <!-- WeChat QR Code -->
    <div class="qr-item wechat">
        <div class="qr-icon">
            <i class="fab fa-weixin"></i>
        </div>
        <div class="qr-content">
            <img src="<?= assets('/public/frontend/media/wechat-qr.png') ?>" 
                 alt="WeChat QR Code" 
                 class="qr-code">
            <div class="qr-label">WeChat</div>
        </div>
    </div>
</div>

<!-- Scroll to Top Button -->
<button id="scrollTopBtn" class="scroll-top-btn" title="Go to top">
    <i class="fas fa-arrow-up"></i>
</button>

<footer class="footer mt-5 pt-4 pb-2" style="background: #ad1009; color: white;">
    <div class="container">
        <div class="row">
            <!-- Company Info -->
            <div class="col-md-4 mb-4">
                <div class="logo mb-3" style="
                    background-image: url('<?= assets("/uploads/".($site_settings['logo'] ?? '')) ?>');
                    background-position: center;
                    background-repeat: no-repeat;
                    background-size: contain;
                    height: 60px;
                    width: 100%;
                    max-width: 250px;
                    margin: 0 auto;
                    filter: brightness(0) invert(1);
                " role="img" aria-label="<?= htmlspecialchars($site_settings['company_name'] ?? 'Company Logo') ?>">
                </div>
                <p class="opacity-100">FUJI Industry, established in 1965, specializes in the development and manufacturing of high-quality elevators, including passenger, home, cargo, car elevators, and escalators.</p>
            </div>
            
            <!-- Quick Links -->
            <div class="col-md-4 mb-4">
                <h3 class="text-uppercase border-bottom border-white pb-2 mb-3 d-inline-block" style="font-size: 18px; font-weight: bold;">Quick Links</h3>
                <ul class="list-unstyled">
                    <?php 
                    $categories = \app\http\models\Categories::all()->get();
                    foreach($categories as $keys => $category) :
                        if($keys == 7) break;
                    ?>
                    <li class="mb-2">
                        <a href="/products-categories/<?= strtolower(rtrim(preg_replace('/[\/\s]+/', '-', $category['category_name']), '-'))."-".$category['id'] ?>" 
                           class="text-white text-decoration-none hover-light">
                            <i class="fas fa-angle-right me-2"></i>
                            <?= htmlspecialchars($category['category_name']) ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            
            <!-- Contact Info -->
            <div class="col-md-4 mb-4">
                <h4 class="text-uppercase border-bottom border-white pb-2 mb-3 d-inline-block" style="font-size: 18px; font-weight: bold;">Contact Us</b></h4>
                <ul class="list-unstyled">
                    <li class="mb-3 d-flex align-items-start">
                        <i class="fas fa-phone-alt me-3 mt-1"></i>
                        <a href="tel:+8618260179694" class="text-white text-decoration-none">+8618260179694</a>
                    </li>
                    <li class="mb-3 d-flex align-items-start">
                        <i class="fas fa-envelope me-3 mt-1"></i>
                        <a href="mailto:sales@fujielevatorjapan.com" class="text-white text-decoration-none">sales@fujielevatorjapan.com</a>
                    </li>
                    <li class="mb-3 d-flex align-items-start">
                        <i class="fas fa-map-marker-alt me-3 mt-1"></i>
                        <span class="opacity-100">NO.489 WEST JINSHAN RD, YINZHOU DISTRICT, NINGBO, ZHEJIANG, CHINA</span>
                    </li>
                </ul>
                
                <!-- Social Icons -->
                <div class="social-icons mt-4">
                    <a href="https://www.linkedin.com/company/108412251/"target="_blank" class="text-white me-3 hover-light" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="text-white me-3 hover-light" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.youtube.com/@fujielevatorjp" target="_blank" class="text-white me-3 hover-light" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                    <a href="https://www.instagram.com/fujielevatorjapan/" target="_blank" class="text-white me-3 hover-light" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.facebook.com/fujielevatorjp" target="_blank" class="text-white hover-light" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                </div>
            </div>
        </div>
        
        <hr class="opacity-25">
        
        <!-- Copyright -->
        <div class="row">
            <div class="col-12 text-center">
                <p class="mb-0 opacity 100"><?= htmlspecialchars($site_settings['copywrite_text'] ?? '') ?></p>
            </div>
        </div>
    </div>
</footer>

<style>
    /* General hover effects */
    .hover-light:hover {
        color: #ffffff !important;
        text-shadow: 0 0 8px rgba(255,255,255,0.5);
        transform: translateY(-1px);
        transition: all 0.3s ease;
    }
    
    .social-icons a {
        display: inline-block;
        width: 36px;
        height: 36px;
        line-height: 36px;
        text-align: center;
        border-radius: 50%;
        background: rgba(255,255,255,0.1);
        transition: all 0.3s ease;
    }
    
    .social-icons a:hover {
        background: rgba(255,255,255,0.2);
        transform: translateY(-3px);
    }
    
    @media (max-width: 768px) {
        .footer .col-md-4 {
            margin-bottom: 30px;
            text-align: center;
        }
    }
    
    /* Floating QR Code Styles - Updated for icon toggle */
    .floating-qr-container {
        position: fixed;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        z-index: 1000;
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    
    .qr-item {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    
    .qr-icon {
        width: 50px;
        height: 50px;
        background: #e30613;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
        cursor: pointer;
        box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        transition: all 0.3s ease;
        z-index: 2;
    }
    
    .qr-icon:hover {
        background: #ff0a18;
        transform: scale(1.1);
    }
    
    .qr-content {
        position: absolute;
        right: 60px;
        top: 50%;
        transform: translateY(-50%) scale(0);
        transform-origin: right center;
        background: #e30613;
        border-radius: 8px;
        padding: 10px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        opacity: 0;
        transition: all 0.3s ease;
        width: 0;
        height: 0;
        overflow: hidden;
        z-index: 1;
    }
    
    .qr-item.active .qr-content {
        transform: translateY(-50%) scale(1);
        opacity: 1;
        width: auto;
        height: auto;
        overflow: visible;
    }
    
    .qr-code {
        width: 120px;
        height: 120px;
        border: 2px solid white;
        border-radius: 5px;
        object-fit: cover;
        background: white;
        padding: 5px;
    }
    
    .qr-label {
        font-weight: 600;
        margin-top: 8px;
        color: white;
        font-size: 14px;
        text-align: center;
        text-shadow: 0 1px 2px rgba(0,0,0,0.3);
    }
    
    @media (max-width: 768px) {
        .floating-qr-container {
            right: 15px;
            gap: 12px;
        }
        
        .qr-icon {
            width: 45px;
            height: 45px;
            font-size: 22px;
        }
        
        .qr-content {
            right: 50px;
        }
        
        .qr-code {
            width: 110px;
            height: 110px;
        }
    }
    
    @media (max-width: 480px) {
        .floating-qr-container {
            bottom: 100px;
            top: auto;
            right: 15px;
            transform: none;
        }
        
        .qr-icon {
            width: 40px;
            height: 40px;
            font-size: 20px;
        }
        
        .qr-content {
            right: 45px;
        }
        
        .qr-code {
            width: 100px;
            height: 100px;
        }
        
        .qr-label {
            font-size: 12px;
        }
    }
    
    /* Scroll to Top Button Styles */
    .scroll-top-btn {
        display: none;
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 99;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: #e30613;
        color: white;
        border: none;
        outline: none;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        transition: all 0.4s ease;
        font-size: 20px;
        align-items: center;
        justify-content: center;
    }

    .scroll-top-btn:hover {
        background: #ff0a18;
        transform: translateY(-3px) scale(1.1);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.4);
    }

    .scroll-top-btn:active {
        transform: translateY(1px) scale(0.95);
    }

    @media (max-width: 768px) {
        .scroll-top-btn {
            width: 45px;
            height: 45px;
            bottom: 25px;
            right: 25px;
            font-size: 18px;
        }
    }

    @media (max-width: 480px) {
        .scroll-top-btn {
            width: 40px;
            height: 40px;
            bottom: 20px;
            right: 20px;
            font-size: 16px;
        }
    }
</style>

<script>
    // Scroll to top button functionality
    document.addEventListener('DOMContentLoaded', function() {
        const scrollTopBtn = document.getElementById('scrollTopBtn');
        
        // Show button when user scrolls down 300px
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                scrollTopBtn.style.display = 'flex';
            } else {
                scrollTopBtn.style.display = 'none';
            }
        });
        
        // Smooth scroll to top when clicked
        scrollTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
        
        // QR code toggle functionality
        const qrItems = document.querySelectorAll('.qr-item');
        
        qrItems.forEach(item => {
            const qrIcon = item.querySelector('.qr-icon');
            
            qrIcon.addEventListener('click', function(e) {
                e.stopPropagation();
                
                // Toggle the clicked item
                item.classList.toggle('active');
                
                // Close other QR items
                qrItems.forEach(otherItem => {
                    if (otherItem !== item && otherItem.classList.contains('active')) {
                        otherItem.classList.remove('active');
                    }
                });
            });
        });
        
        // Close QR codes when clicking outside
        document.addEventListener('click', function() {
            qrItems.forEach(item => {
                item.classList.remove('active');
            });
        });
        
        // Prevent QR content clicks from closing the QR code
        document.querySelectorAll('.qr-content').forEach(content => {
            content.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        });
    });
</script>