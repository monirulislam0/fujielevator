<?php 
    $route = "/certificate";
    template_include("/frontend/partials/header" ,compact('page','route'));
    template_include("/frontend/partials/banner",compact('page'));

?>
<div class="p-3"></div>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            
        <div class="nav flex-column nav-pills" aria-orientation="vertical">
                    <a class="nav-link " href="/about">About us</a>

                    <a class="nav-link active" href="/why-choose-us">Why Chosse Us</a>
                    <a class="nav-link" href="/company-profile">Commpany Profile</a>
                    <a class="nav-link" href="/projects">Our Projects</a>
                    <a class="nav-link" href="/products">Products</a>
                    <a class="nav-link" href="/global-partners">Dstributor</a>
                    <a class="nav-link" href="/news">Blog</a>
                    <a class="nav-link" href="/contact-us">Contact us</a>

                </div>
        </div>
        <div class="col-md-9">
            <?= $page['page_content'] ?>
        </div>
    </div>
</div>
<?php 

    template_include("/frontend/partials/footer");

?>