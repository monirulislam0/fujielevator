<?php 

$route = "/projects";
template_include("/frontend/partials/header" ,compact('page','route'));
template_include("/frontend/partials/banner",compact('page'));

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
        margin-bottom: 25px;
        letter-spacing: 0.5px;
    }
    
    /* Modern Project Card Styling */
    .project-card {
        border-radius: 8px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        height: 100%;
        background: white;
    }
    .project-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .project-image-container {
        height: 220px;
        width: 100%;
        background-color: #f8f9fa;
        background-size: contain; /* Changed from cover to contain */
        background-position: center;
        background-repeat: no-repeat; /* Added to prevent repeating */
        position: relative;
        transition: all 0.3s ease;
    }
    /* Hover effect for images */
    .project-card:hover .project-image-container {
        transform: scale(1.03);
    }
    
    /* Project title below image */
    .project-title-container {
        padding: 15px;
        text-align: center;
    }
    .project-title-container h5 {
        font-size: 16px;
        font-weight: 700;
        color: #000;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin: 0;
        transition: color 0.3s ease;
    }
    /* Hover effect for title */
    .project-card:hover .project-title-container h5 {
        color: #ff0000;
    }
</style>

<div class="p-3"></div>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <!-- Fixed ARIA roles -->
            <div class="nav flex-column nav-pills" role="menu" aria-orientation="vertical">
                <a class="nav-link " role="menuitem" href="/about">About us</a>
                <a class="nav-link" role="menuitem" href="/why-choose-us">Why Choose Us</a>
                <a class="nav-link" role="menuitem" href="/company-profile">Commpany Profile</a>
                <a class="nav-link active" role="menuitem" href="/projects">Our Projects</a>
                <a class="nav-link" role="menuitem" href="/products">Products</a>
                <a class="nav-link" role="menuitem" href="/distributor">Distributor</a>
                <a class="nav-link" role="menuitem" href="/blog">Blog</a>
                <a class="nav-link" role="menuitem" href="/faq">FAQs</a>
                <a class="nav-link" role="menuitem" href="/contact-us">Contact us</a>
            </div>
        </div>
        
        <div class="col-md-9">
            <h1 class="page-title">Handed over projects</h1>
            
            <div class="row" id="item-list">
               
            </div>
        </div>
        
          <style>
                .pagination {
                    justify-content: center;
                    margin-top: 20px;
                }
                .page-item.active .page-link {
                    background-color: red;
                    border-color: transparent;
                }
                .active a {
                    background-color: red;
                    border-color: transparent;
                }
                .page-link {
                    border-radius: 50px;
                    padding: 10px 20px;
                    font-size: 16px;
                }
                .page-item:hover .page-link {
                    background-color: black;
                    color: white;
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
                let arr = <?php echo json_encode($projects); ?> 
                console.log(arr.length)
                const itemsPerPage = 12;
                const itemList = document.getElementById('item-list');
                const paginationControls = document.getElementById('pagination-controls');
                
                const totalPages = Math.ceil(arr.length / itemsPerPage);
                let currentPage = 1;
                
                // Get current page from URL if available
                const urlParams = new URLSearchParams(window.location.search);
                const pageParam = urlParams.get('page');
                if (pageParam && pageParam >= 1 && pageParam <= totalPages) {
                    currentPage = parseInt(pageParam);
                }
                
                function renderItems(page) {
                    itemList.innerHTML = '';
                    const start = (page - 1) * itemsPerPage;
                    const end = start + itemsPerPage;
                
                    const currentItems = arr.slice(start, end);
                    currentItems.forEach(item => {
                        const div = document.createElement('div');
                              div.classList.add('col-md-4', 'mb-4');
                        const div2 = document.createElement('div');
                              div2.classList.add('project-card', 'border-0' ,'rounded', 'overflow-hidden' ,'h-100' ,'transition-all');
                        const divBackground = document.createElement('div');
                              divBackground.classList.add('project-image-container');
                        const basePath = <?= json_encode(assets('/uploads/')) ?>;
                              divBackground.style.backgroundImage = `url(${basePath}${item.project_image})`;
                        
                        // Create title container below image
                        const titleContainer = document.createElement('div');
                              titleContainer.classList.add('project-title-container');
                        const h2 = document.createElement("h2");
                              h2.textContent = item.location;
                              h2.style.fontSize = "16px";
                              
                        titleContainer.appendChild(h2);
                        div2.appendChild(divBackground);
                        div2.appendChild(titleContainer);
                        div.appendChild(div2);
                        itemList.appendChild(div);
                    });
                }
                
                function renderPagination() {
                    paginationControls.innerHTML = '';
                    
                    // Previous button
                    if (totalPages > 1) {
                        const prevLi = document.createElement('li');
                        prevLi.classList.add("page-item", currentPage === 1 ? "disabled" : "");
                        
                        const prevA = document.createElement('a');
                        prevA.classList.add("page-link");
                        prevA.innerHTML = "&laquo;";
                        
                        if (currentPage > 1) {
                            const prevUrl = new URL(window.location);
                            prevUrl.searchParams.set('page', currentPage - 1);
                            prevA.href = prevUrl.toString();
                            
                            prevA.addEventListener('click', (e) => {
                                e.preventDefault();
                                currentPage--;
                                updatePage();
                            });
                        }
                        
                        prevLi.appendChild(prevA);
                        paginationControls.appendChild(prevLi);
                    }
                    
                    // Page numbers
                    for (let i = 1; i <= totalPages; i++) {
                        const li = document.createElement('li');
                        li.classList.add("page-item");
                        if (i === currentPage) li.classList.add("active");
                        
                        const a = document.createElement('a');
                        a.classList.add("page-link");
                        a.textContent = i;
                        
                        // Set href for crawlable links
                        const pageUrl = new URL(window.location);
                        pageUrl.searchParams.set('page', i);
                        a.href = pageUrl.toString();
                        
                        a.addEventListener('click', (e) => {
                            e.preventDefault();
                            currentPage = i;
                            updatePage();
                        });
                        
                        li.appendChild(a);
                        paginationControls.appendChild(li);
                    }
                    
                    // Next button
                    if (totalPages > 1) {
                        const nextLi = document.createElement('li');
                        nextLi.classList.add("page-item", currentPage === totalPages ? "disabled" : "");
                        
                        const nextA = document.createElement('a');
                        nextA.classList.add("page-link");
                        nextA.innerHTML = "&raquo;";
                        
                        if (currentPage < totalPages) {
                            const nextUrl = new URL(window.location);
                            nextUrl.searchParams.set('page', currentPage + 1);
                            nextA.href = nextUrl.toString();
                            
                            nextA.addEventListener('click', (e) => {
                                e.preventDefault();
                                currentPage++;
                                updatePage();
                            });
                        }
                        
                        nextLi.appendChild(nextA);
                        paginationControls.appendChild(nextLi);
                    }
                }
                
                function updatePage() {
                    // Update URL
                    const newUrl = new URL(window.location);
                    newUrl.searchParams.set('page', currentPage);
                    window.history.pushState({}, '', newUrl.toString());
                    
                    // Re-render content
                    renderItems(currentPage);
                    renderPagination();
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }
                
                // Handle back/forward navigation
                window.addEventListener('popstate', () => {
                    const urlParams = new URLSearchParams(window.location.search);
                    const pageParam = urlParams.get('page');
                    if (pageParam) {
                        currentPage = parseInt(pageParam);
                        renderItems(currentPage);
                        renderPagination();
                    }
                });
                
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