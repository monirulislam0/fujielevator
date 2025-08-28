<?php
$page['meta_description'] = "Trusted elevator solutions since 1965. FUJI Industry designs & exports innovative, reliable lifts for homes, 
offices & factories worldwide. Discover quality";
template_include("/frontend/partials/header",compact('page'));
?>

<!-- Bootstrap Carousel -->
<style>
    /* Custom styling to remove bullet points from the carousel */
    .carousel-indicators {
        display: none;
    }
</style>
<div id="HayashimuCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <!-- 1st image -->
        <div class="carousel-item active">
            <img src="<?= assets("/uploads/".$sliders[0]['slider_image']) ?>" class="d-block w-100" alt="<?= $slides[0]['alternative_text'] ?>">
        </div>
        <?php 
          foreach($sliders as $keys => $slide):
            if(0 == $keys) continue;
        ?>
        <!-- 2nd image -->
        <div class="carousel-item">
            <img src="<?= assets("/uploads/".$slide['slider_image']) ?>" class="d-block w-100" alt="<?= $slide['alternative_text'] ?>">
        </div>
        <?php endforeach; ?>
    </div>
    <!-- Carousel Navigation Buttons -->
    <button class="carousel-control-prev" type="button" data-bs-target="#HayashimuCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#HayashimuCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<script>
    // Automatically change carousel every 3 second
    var myCarousel = document.getElementById('HayashimuCarousel');
    var carousel = new bootstrap.Carousel(myCarousel, {
        interval: 2000, // Change slide every  second
        ride: 'carousel' // Enable automatic slide transition
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Slider End -->


<!-- Product Categories -->
<div class="container">
    <h1 class="text-center my-4" style="font-size: 22px;font-weight: 700;text-decoration: underline;">Product Categories</h1>
    <div class="row">
        <?php 
            $categories = \app\http\models\Categories::all()->get();
            foreach($categories as $key => $category):
        ?>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12 mt-2">
            <a href="/products-categories/<?= strtolower(rtrim(preg_replace('/[\/\s]+/', '-', $category['category_name']), '-'))."-".$category['id'] ?>" 
               class="text-decoration-none">
                <div class="card border-0" style="width:100%; height: auto;">
                    <div style="
                    height: 240px; 
                    width: 100%;
                    background-color: rgba(0,0,0,0.15);
                    background-image: url('<?= assets("/uploads/".$category['category_image'])?>');
                    background-size: contain;
                    background-repeat: no-repeat;
                    background-position: center center;
                    "></div>
                    <div class="card-body">
                        <p class="card-text text-center text-black">
                            <?= $category['category_name']?>
                        </p>
                    </div>
                </div>
            </a>
        </div>
        <?php 
            if($key == 7) break;
        endforeach; ?>
    </div>
</div>

<!--Popular Products -->
<div class="container">
    <h2 class="text-center my-4" style="font-size: 22px;font-weight: 700;text-decoration: underline;">Popular Products</h2>
    <div class="row">
        <?php 
            $products = \app\http\models\Products::where(1, 'trending')->get();
            foreach($products as $key => $product):
        ?>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12 mt-2">
            <a href="/product/<?= strtolower(rtrim(preg_replace('/[\/\s]+/', '-', $product['product_title']), '-'))."-".$product['id'] ?>" 
               class="text-decoration-none">
                <div class="card border-0" style="width:100%; height: auto;">
                    <div style="
                    height: 350px; 
                    width: 100%;
                    background-color: rgba(0,0,0,0.15);
                    background-image: url('<?= assets("/uploads/".$product['product_thumbnail'])?>');
                    background-size: contain;
                    background-repeat: no-repeat;
                    background-position: center center;
                    "></div>
                    <div class="card-body">
                        <p class="card-text text-left text-black">
                            <?= substr($product['product_title'], 0, 30)."...." ?>
                        </p>
                    </div>
                </div>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
    .why-choose-section {
        padding: 4rem 0;
        position: relative;
        overflow: hidden;
    }

    .section-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .section-header__title {
        font-size: 2.8rem;
        color: #2b2d42;
        margin-bottom: 1rem;
        position: relative;
        display: inline-block;
    }

    .section-header__title:after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background: #ef233c;
    }

    .feature-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        padding: 0 2rem;
    }

.feature-item {
    background: rgba(255, 255, 255, 0.9);
    border-radius: 15px;
    padding: 2.5rem;
    border: 1px solid #ddd; /* visible edges */
    box-shadow: none;       /* remove shadow */
    transition: none;       /* remove hover animation */
    text-align: center;     /* center all content */
}

.feature-icon {
    width: 60px;
    height: 60px;
    background: #ef233c; /* keep same red */
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem auto; /* centers the icon */
    color: white;
    font-size: 1.8rem;
}

.feature-content h4 {
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 0.8rem;
}

.feature-content p {
    color: #000000;
    line-height: 1.7;
    margin: 0 auto;
}

    .company-profile {
    background: white;
    max-width: 800px;
    margin: 3rem auto;
    padding: 2.5rem;
    border-radius: 15px;
    text-align: center;

    /* Remove shadow */
    box-shadow: none;  
    border: 1px solid #ddd; /* Optional: keeps edges visible */
}

    .company-profile h2 {
        color: #2b2d42;
        margin-bottom: 1.5rem;
        font-size: 2rem;
    }

    .company-profile p {
        color: #000000;
        line-height: 1.8;
        font-size: 1.1rem;
    }
</style>

<section class="why-choose-section">
    <div class="container">
        <div class="section-header">
            <h2 class="text-center my-4" style="font-size: 24px;font-weight: 700;text-decoration: underline;">Why Choose Us</h2>
        </div>

        <div class="company-profile">
            <h3 style="font-size: 24px;font-weight: 700;">FUJI Industry CO., LTD.</h3>
            <p>FUJI Industry Co., Ltd. is a global elevator and industrial solutions manufacturer with over 60 years of expertise. 
            Headquartered in Japan, with advanced production hubs in Thailand and China, the company delivers cutting-edge elevator systems, 
            precision components, and energy-efficient technologies to more than 50 countries. Backed by strong R&D, patented innovations, 
            and world-class certifications (ISO, CE, TÜV), FUJI combines Japanese engineering excellence with large-scale manufacturing to 
            ensure quality, sustainability, and reliability worldwide.</p>
        </div>

        <div class="feature-grid">
            <div class="feature-item">
                <div class="feature-icon"><i class="fas fa-microchip"></i></div>
                <div class="feature-content">
                    <h4 style="font-size: 20px;font-weight: 700;">10000+ Production Capacity</h4>
                    <p>Our factories achieve a combined annual output of 10,000+ elevator units</p>
                </div>
            </div>

            <div class="feature-item">
                <div class="feature-icon"><i class="fas fa-globe-asia"></i></div>
                <div class="feature-content">
                    <h4 style="font-size: 20px;font-weight: 700;">Global Reach: 55+ Countries</h4>
                    <p>Operating reliably in commercial and residential spaces across 55+ countries.</p>
                </div>
            </div>

            <div class="feature-item">
                <div class="feature-icon"><i class="fas fa-user-tie"></i></div>
                <div class="feature-content">
                    <h4 style="font-size: 20px;font-weight: 700;">65+ years of Experience</h4>
                    <p>Over 65 years of proven expertise in elevator manufacturing and innovation.</p>
                </div>
            </div>

            <div class="feature-item">
                <div class="feature-icon"><i class="fas fa-leaf"></i></div>
                <div class="feature-content">
                    <h4 style="font-size: 20px;font-weight: 700;">Eco-Friendly Design</h4>
                    <p>Energy-efficient motors, LED lighting, and recyclable systems.</p>
                </div>
            </div>

            <div class="feature-item">
                <div class="feature-icon"><i class="fas fa-clock"></i></div>
                <div class="feature-content">
                    <h4 style="font-size: 20px;font-weight: 700;">24/7 Digital Support</h4>
                    <p>24/7 Digital Support: Seamless assistance anytime, anywhere..</p>
                </div>
            </div>

            <div class="feature-item">
                <div class="feature-icon"><i class="fas fa-certificate"></i></div>
                <div class="feature-content">
                    <h4 style="font-size: 20px;font-weight: 700;">Full Certification</h4>
                    <p>Certified for safety, quality, and compliance in every elevator system.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Latest News Section -->
<div class="container">
    <h2 class="text-center my-4" style="font-size: 22px; font-weight:700;text-decoration: underline;">Latest Blogs</h2>
    <div class="row">
        <?php 
        $news = \app\http\models\News::where(1,'featured')->get();
        foreach($news as $key => $item):
            $slug = makeSlug($item['news_title'])."-".$item['id'];
        ?>
        <div class="col-lg-3 col-md-4 col-sm-6 news-item mb-4">
            <a href="/blog/<?= $slug ?>" class="news-link" style="text-decoration: none; color: inherit;">
                <!-- Image -->
                <div class="news-image" style="
                    height: 250px;
                    width: 100%;
                    background-color: rgba(0,0,0,0.15);
                    background-image: url('<?= assets("/uploads/".$item['news_image'])?>');
                    background-size: contain;
                    background-repeat: no-repeat;
                    background-position: center center;
                    border-radius: 5px;
                    overflow: hidden;
                    transition: transform 0.3s;
                "></div>

                <!-- Title below image -->
                <div class="news-title" style="
                    font-size: 16px;
                    font-weight: 700;
                    margin-top: 10px;
                    display: -webkit-box;
                    -webkit-line-clamp: 2;
                    -webkit-box-orient: vertical;
                    overflow: hidden;
                    text-overflow: ellipsis;
                    color: #000;
                ">
                    <?= $item['news_title'] ?>
                </div>
            </a>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="text-center mt-5">
        <a href="/blog" class="btn btn-secondary">View All Blogs</a>
    </div>
</div>

<style>
/* Hover zoom effect */
.news-link .news-image:hover {
    transform: scale(1.05);
}

/* Responsive adjustments */
@media (max-width: 1199px) {
    .news-image {
        height: 220px;
    }
}

@media (max-width: 991px) {
    .news-image {
        height: 200px;
    }
}

@media (max-width: 767px) {
    .news-image {
        height: 180px;
    }
    .news-title {
        font-size: 14px;
    }
}

@media (max-width: 575px) {
    .news-image {
        height: 160px;
    }
    .news-title {
        font-size: 13px;
    }
}
</style>


<?php 
template_include("/frontend/partials/footer");
?>