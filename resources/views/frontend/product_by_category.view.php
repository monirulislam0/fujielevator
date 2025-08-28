<?php 
    template_include("/frontend/partials/header");
?>

<style>
    /* Page Title Styling */
    .page-title {
        font-size: 22px;
        font-weight: 600;
        color: #000000;
        border-bottom: 2px solid #ff0000;
        padding-bottom: 10px;
        display: inline-block;
        margin: 15px 0 25px 0;
        letter-spacing: 0.5px;
    }
    
    /* Product Card Styling */
    .product-card {
        height: 100%;
        border: 1px solid #eee;
        border-radius: 8px;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    .product-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
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
</style>

<!-- Shop Page -->
<div class="container py-5">
    <div class="row">
        <!-- Categories Sidebar -->
        <div class="col-md-3">
            <div class="nav flex-column nav-pills" aria-orientation="vertical">
                <a class="nav-link active" href="#">Categories</a>
                 <style>
                    .category_active {
                        border-bottom: 2px solid red;
                        border-radius: 0px !important;
                    }
                </style>
                <?php
                    $categories = \app\http\models\Categories::all()->get();
                    foreach($categories as $category):
                ?>
               
                <a class="nav-link <?= $searched['id'] == $category['id'] ? 'category_active' : '' ?> " href="/products-categories/<?= strtolower(rtrim(preg_replace('/[\/\s]+/', '-', $category['category_name']), '-'))."-".$category['id'] ?>"><?= $category['category_name'] ?></a>
                <?php endforeach; ?>
            </div>
        </div>
         
        <!-- Products Section -->        
        <div class="col-md-9">
            <!-- Updated H1 with consistent styling -->
            <h1 class="page-title"><?= $searched['category_name'] ?? $searched['subcategory_name'] ?></h1>
            
            <div class="row" id="product-list">
                <?php if(empty($products)): ?>
                    <h2 class="p-3">No Products Found  !!</h2>
                <?php else: ?>
                    <!-- Products will be rendered by JavaScript -->
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Pagination -->
         <style>
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
        <div class="col-md-9 offset-md-3">
            <div class="py-5">
                <nav>
                    <ul class="pagination" id="pagination-controls">
                        <!-- Pagination will be rendered by JavaScript -->
                    </ul>
                </nav>
            </div>
        </div>
        
        <script>
            let arr = <?php echo json_encode($products); ?> 
            const itemsPerPage = 16;
            const itemList = document.getElementById('product-list');
            const paginationControls = document.getElementById('pagination-controls');
            
            const totalPages = Math.ceil(arr.length / itemsPerPage);
            let currentPage = 1;
            
            function renderItems(page) {
                itemList.innerHTML = '';
                const start = (page - 1) * itemsPerPage;
                const end = start + itemsPerPage;
            
                const currentItems = arr.slice(start, end);
                currentItems.forEach(item => {
                    const div = document.createElement('div');
                    div.classList.add('col-md-3', 'mb-4', 'product-item');
                    
                    const a = document.createElement('a');
                    a.style.textDecoration = "none";
                    a.style.color = "inherit";
                    a.setAttribute('href', generateProductUrl(item));
                    
                    const card = document.createElement('div');
                    card.classList.add('card', 'product-card');
                    
                    const productImage = document.createElement('div');
                    productImage.classList.add('product-image');
                    const basePath = <?= json_encode(assets('/uploads/')) ?>;
                    productImage.style.backgroundImage = `url(${basePath}${item.product_thumbnail})`;
                    
                    const cardBody = document.createElement('div');
                    cardBody.classList.add('card-body', 'p-3');
                    
                    const title = document.createElement('p');
                    title.classList.add("product-title");
                    title.innerText = item.product_title;
                    
                    cardBody.appendChild(title);
                    card.appendChild(productImage);
                    card.appendChild(cardBody);
                    a.appendChild(card);
                    div.appendChild(a);
                    
                    itemList.appendChild(div);
                });
            }
            
            function generateProductUrl(item) {
                const slug = item.product_title
                    .replace(/[\/\s]+/g, '-')
                    .replace(/-+$/, '')
                    .toLowerCase();
                return `/product/${slug}-${item.id}`;
            }
            
            function renderPagination() {
                paginationControls.innerHTML = '';
                
                for (let i = 1; i <= totalPages; i++) {
                    const li = document.createElement('li');
                    li.classList.add("page-item");
                    if (i === currentPage) li.classList.add("active");
                    
                    const a = document.createElement('a');
                    a.classList.add("page-link");
                    a.textContent = i;
                    
                    a.addEventListener('click', (e) => {
                        e.preventDefault();
                        currentPage = i;
                        renderItems(currentPage);
                        renderPagination();
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                    });
                    
                    li.appendChild(a);
                    paginationControls.appendChild(li);
                }
            }
            
            // Initialize
            if (arr.length > 0) {
                renderItems(currentPage);
                renderPagination();
            }
        </script>
    </div>
</div>

<?php 
    template_include("/frontend/partials/footer");
?>