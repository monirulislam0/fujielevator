<?php 
    $route = "/company-profile";
    template_include("/frontend/partials/header" ,compact('page','route'));
    template_include("/frontend/partials/banner",compact('page'));

?>
<div class="p-3"></div>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <!-- Fixed ARIA roles -->
            <div class="nav flex-column nav-pills" role="menu" aria-orientation="vertical">
                <a class="nav-link" role="menuitem" href="/about">About us</a>
                <a class="nav-link" role="menuitem" href="/why-choose-us">Why Choose Us</a>
                <a class="nav-link active" role="menuitem" href="/company-profile" aria-current="page">Commpany Profile</a>
                <a class="nav-link" role="menuitem" href="/projects">Our Projects</a>
                <a class="nav-link" role="menuitem" href="/products">Products</a>
                <a class="nav-link" role="menuitem" href="/distributor">Distributor</a>
                <a class="nav-link" role="menuitem" href="/blog">Blog</a>
                <a class="nav-link" role="menuitem" href="/faq">FAQs</a>
                <a class="nav-link" role="menuitem" href="/contact-us">Contact us</a>
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