<?php 
// Initialize page variables
$route = '/products';

template_include("/frontend/partials/header", compact('page','route'));
?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "Home",
      "item": "<?= $baseUrl . '/' ?>"
    },
    {
      "@type": "ListItem",
      "position": 2,
      "name": "Products",
      "item": "<?= $baseUrl . '/products' ?>"
    }
  ]
}
</script>


<!-- 4. PAGE STYLES -->
<style>
    .page-title {
        font-size: 22px;
        font-weight: 600;
        color: #000000;
        border-bottom: 2px solid #ff0000;
        padding-bottom: 10px;
        display: inline-block;
        margin-bottom: 25px;
        letter-spacing: 0.5px;
    }
    
    .product-card {
        height: 100%;
        transition: all 0.3s ease;
        border: 1px solid #eee;
        border-radius: 8px;
        overflow: hidden;
    }
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .product-image {
        height: 200px;
        width: 100%;
        background-color: #f8f9fa;
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center center;
    }
    .product-title {
        font-size: 0.9rem;
        overflow: hidden;
        text-overflow: ellipsis;
        margin-bottom: 0.5rem;
        text-align: center;
        font-weight: bold;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        height: 2.8em;
        line-height: 1.4;
        white-space: normal;
    }
    .product-item {
        margin-bottom: 1.5rem;
    }
    
    .pagination {
        justify-content: center;
        margin-top: 20px;
    }
    .page-item.active .page-link {
        background-color: #007bff;
        border-color: #007bff;
    }
    .page-link {
        border-radius: 50px;
        padding: 10px 20px;
        font-size: 16px;
    }
    .page-item:hover .page-link {
        background-color: #e9ecef;
    }
    .page-item:first-child .page-link,
    .page-item:last-child .page-link {
        padding: 10px 16px;
    }
</style>

<!-- 5. MAIN CONTENT -->
<div class="container py-5">
    <div class="row">
        <div class="col-md-3">
            <div class="nav flex-column nav-pills" role="menu" aria-orientation="vertical">
                <span class="nav-link active category-header" role="none">Categories</span>
                <?php
                    $categories = \app\http\models\Categories::all()->get();
                    foreach($categories as $category):
                        $slug = formatSlug($category['category_name']) . '-' . $category['id'];
                ?>
                <a class="nav-link" 
                   href="/products-categories/<?= $slug ?>" 
                   role="menuitem">
                   <?= htmlspecialchars($category['category_name'], ENT_QUOTES, 'UTF-8') ?>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
        
        <div class="col-md-9">
            <h1 class="page-title">Products</h1>
            
            <div class="row" id="product-list">
                <?php foreach($products as $product): 
                    $productSlug = formatSlug($product['product_title']) . '-' . $product['id'];
                    $thumbnail = !empty($product['product_thumbnail']) ? 
                        assets("/uploads/".$product['product_thumbnail']) : 
                        assets("/images/default-product.jpg");
                ?>
                <div class="col-md-3 product-item">
                    <a style="text-decoration:none; color: inherit;" href="/product/<?= $productSlug ?>">
                        <div class="card product-card">
                            <div class="product-image" 
                                 style="background-image: url('<?= $thumbnail ?>');">
                            </div>
                            <div class="card-body p-3">
                                <p class="product-title"><?= htmlspecialchars($product['product_title'], ENT_QUOTES, 'UTF-8') ?></p>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        
        <?php if(!empty($products) && $rows > 1): ?>
        <div class="col-md-9 offset-md-3">
            <div class="py-5">
                <nav>
                    <ul class="pagination">
                        <?php 
                        $currentPage = $_GET['page'] ?? 1;
                        $queryParams = $_GET;
                        unset($queryParams['page']);
                        $queryString = http_build_query($queryParams);
                        ?>
                        <li class="page-item <?= $currentPage == 1 ? 'active' : '' ?>">
                            <a class="page-link" href="/products?<?= $queryString ?>">1</a>
                        </li>
                        <?php for($i = 2; $i <= $rows; $i++): ?>
                            <li class="page-item <?= $currentPage == $i ? 'active' : '' ?>">
                                <a class="page-link" href="/products?page=<?= $i ?><?= $queryString ? '&' . $queryString : '' ?>">
                                    <?= $i ?>
                                </a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php 
// Helper function for URL slugs
function formatSlug($string) {
    $slug = preg_replace('/[^\p{L}\p{N}]+/u', '-', $string);
    $slug = preg_replace('/-+/', '-', $slug);
    return strtolower(trim($slug, '-'));
}

template_include("/frontend/partials/footer"); 
?>