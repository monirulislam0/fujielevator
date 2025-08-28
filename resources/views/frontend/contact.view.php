<?php 
    $route = '/contact-us';
    template_include("/frontend/partials/header",compact('page','route'));
    template_include("/frontend/partials/banner",compact('page'));

?>

<div class="p-3"></div>
<div class="container">
<div class="row">
    <div class="col-md-3">
        <!-- Fixed ARIA roles -->
        <div class="nav flex-column nav-pills" role="menu" aria-orientation="vertical">
            <a class="nav-link" role="menuitem" href="/about">About us</a>
            <a class="nav-link" role="menuitem" href="/why-choose-us">Why Choose us</a>
            <a class="nav-link" role="menuitem" href="/company-profile">Company Profile</a>
            <a class="nav-link" role="menuitem" href="/projects">Our Projects</a>
            <a class="nav-link" role="menuitem" href="/products">Products</a>
            <a class="nav-link" role="menuitem" href="/distributor">Distributor</a>
            <a class="nav-link" role="menuitem" href="/blog">Blog</a>
            <a class="nav-link" role="menuitem" href="/faq">FAQs</a>
            <a class="nav-link active" role="menuitem" href="/contact-us" aria-current="page">Contact us</a>
        </div>
    </div>
    <div class="col-md-9">
        <div>
            <?= $page['page_content'] ?>
        </div>
        
        <style>
            iframe{
                width:100% !important;
                height: 380px !important;
            }
            #inquiry-section {
                scroll-margin-top: 150px; /* Added space above the section */
            }
        </style>
        <?= $page['google_iframe']?>
        

        <div class="p-3 bg-transparent"></div>
        <!-- Changed text color to black -->
        <h4 class="text-black">Send Inquiry</h4>
        <hr class="hr">
        <div>
            <?php if(session_get('message')):?>
                <p style="padding:7px; background-color: green; color: white; "><?= session_get('message')?></p>
            <?php endif; ?>
        </div>
        
        <!-- Added anchor point and modified form action -->
        <div id="inquiry-section">
        <form action="/admin/contact-us/store#inquiry-section" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <?php if(error('name')): ?>
                    <p class="text-danger"> <?= error('name') ?></p>
                <?php endif; ?>
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter your full name" >
            </div>
            <div class="mb-3">
                <?php if(error('email')): ?>
                    <p class="text-danger"> <?= error('email') ?></p>
                <?php endif; ?>
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email">
            </div>
            <div class="mb-3">
                <?php if(error('message')): ?>
                    <p class="text-danger"> <?= error('message') ?></p>
                <?php endif; ?>
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" id="message" rows="5" placeholder="Enter your message" name="message"></textarea>
            </div>
            <!-- Changed button to black with red hover -->
            <button type="submit" class="btn btn-black">Submit</button>
        </form>
        </div>
    </div>
</div>
</div>
<style>
    /* Added button styles */
    .btn-black {
        background-color: #000 !important;
        border-color: #000 !important;
        color: #fff !important;
        transition: background-color 0.3s, border-color 0.3s;
    }
    .btn-black:hover {
        background-color: #ff0000 !important;
        border-color: #ff0000 !important;
    }
</style>
<?php 
    template_include("/frontend/partials/footer");
?>