<?php 
    $route = "/blog";
    template_include("/frontend/partials/header" ,compact('page','route'));
    template_include("/frontend/partials/banner",compact('page'));
?>

<style>
    /* Page Title Styling - Updated with black font and red underline */
    .page-title {
        font-size: 22px;
        font-weight: 600;
        color: #000000; /* Black font color */
        border-bottom: 2px solid #ff0000; /* Red underline */
        padding-bottom: 10px;
        display: inline-block;
        margin-bottom: 25px;
        letter-spacing: 0.5px;
    }

    /* News Card Styles */
    .news-item-container {
        padding: 0 15px;
        margin-bottom: 30px;
    }
    .news-card {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        overflow: hidden;
        transition: all 0.3s ease;
        height: 100%;
    }
    .news-card:hover {
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transform: translateY(-3px);
    }
    .news-image-container {
        height: 200px;
        width: 100%;
        background-color: rgba(0,0,0,0.15);
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center center;
    }
    .news-content {
        padding: 20px;
    }
    .news-date {
        color: #666;
        font-size: 0.9rem;
        margin-bottom: 8px;
    }
    .news-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 10px;
        color: #333;
        transition: color 0.3s ease;
    }
    .news-card:hover .news-title {
        color: #ff0000; /* Red on hover */
    }
    .news-link {
        text-decoration: none;
        color: inherit;
        display: block;
        height: 100%;
    }
</style>

<div class="container pt-5">
    <div class="row">
        <!-- Left Navigation - Fixed ARIA roles -->
        <div class="col-md-3">
            <div class="nav flex-column nav-pills sidebar-nav" role="menu" aria-orientation="vertical">
                <a class="nav-link" role="menuitem" href="/about">About us</a>
                <a class="nav-link" role="menuitem" href="/why-choose-us">Why Choose Us</a>
                <a class="nav-link" role="menuitem" href="/company-profile">Company Profile</a>
                <a class="nav-link" role="menuitem" href="/projects">Our Projects</a>
                <a class="nav-link" role="menuitem" href="/products">Products</a>
                <a class="nav-link" role="menuitem" href="/distributor">Distributor</a>
                <a class="nav-link active" role="menuitem" href="/blog" aria-current="page">Blog</a>
                <a class="nav-link" role="menuitem" href="/faq">FAQs</a>
                <a class="nav-link" role="menuitem" href="/contact-us">Contact us</a>
            </div>
        </div>
        
        <!-- News Grid -->
        <div class="col-md-9">
            <h1 class="page-title">Elevator Industry Blog</h1>
            
            <div class="row" id="item-list">
                
            </div>
        </div>
        
        <!-- Pagination -->
        <div class="col-12">
    <div class="py-5 d-flex justify-content-center">
        <nav aria-label="News pagination">
            <ul class="pagination" id="pagination-controls">
                        <!-- Pagination will be rendered by JavaScript -->
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<script>
    let arr = <?php echo json_encode($news); ?>;
    const itemsPerPage = 15;
    const itemList = document.getElementById('item-list');
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
            div.classList.add('col-md-6', 'col-xl-4', 'mb-4');

            const div2 = document.createElement('div');
            div2.classList.add('news-card');
            div.appendChild(div2);

            const a = document.createElement('a');
            a.classList.add('news-link');
            a.setAttribute('href', generateNewsUrl(item.news_title, item.id));

            const divBackground = document.createElement('div');
            divBackground.classList.add('news-img');

            const basePath = <?= json_encode(assets('/uploads/')) ?>;
            divBackground.style.backgroundColor = "grey";
            divBackground.style.backgroundImage = `url(${basePath}${item.news_image})`;
            divBackground.style.height = "220px";
            divBackground.style.backgroundSize = "cover";
            divBackground.style.backgroundPosition = "center";

            a.appendChild(divBackground);

            const newsContent = document.createElement('div');
            newsContent.classList.add('news-content');
            a.appendChild(newsContent);

            const newsDate = document.createElement('div');
            newsDate.classList.add('news-date');
            newsContent.appendChild(newsDate);

            const icon = document.createElement('i');
            icon.classList.add('far', 'fa-calendar', 'me-2');
            newsDate.appendChild(icon);

            const date = new Date(item.date_time);
            const formattedDate = date.toLocaleDateString('en-GB', {
                day: '2-digit',
                month: 'short',
                year: 'numeric'
            }).replace(/ /g, ' ').replace(' ', ', ');

            const spanDate = document.createElement('span');
            spanDate.textContent = formattedDate;
            newsDate.appendChild(spanDate);

            const h3 = document.createElement("h3");
            h3.classList.add('news-title');
            h3.textContent = item.news_title;
            newsContent.appendChild(h3);

            div2.appendChild(a);
            itemList.appendChild(div);
        });
    }

    function generateNewsUrl(str, id) {
        str = str.toLowerCase();
        str = str.replace(/<\/?[^>]+(>|$)/g, "");
        str = str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
        str = str.replace(/[^a-z0-9\s-]/g, "");
        str = str.replace(/[\s-]+/g, "-");
        str = str.replace(/^-+|-+$/g, "");
        return `/blog/${str}-${id}`;
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

    if (arr.length > 0) {
        renderItems(currentPage);
        renderPagination();
    }
</script>

<?php 
    template_include("/frontend/partials/footer");
?>
