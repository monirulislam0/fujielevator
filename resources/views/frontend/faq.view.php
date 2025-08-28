<?php 
    $route = "/faq";
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
                <a class="nav-link" role="menuitem" href="/company-profile">Company Profile</a>
                <a class="nav-link" role="menuitem" href="/projects">Our Projects</a>
                <a class="nav-link" role="menuitem" href="/products">Products</a>
                <a class="nav-link" role="menuitem" href="/distributor">Distributor</a>
                <a class="nav-link" role="menuitem" href="/blog">Blog</a>
                <a class="nav-link active" role="menuitem" href="/faq" aria-current="page">FAQs</a>
                <a class="nav-link" role="menuitem" href="/contact-us">Contact us</a>
            </div>
        </div>
        <div class="col-md-9">
            
            <?= $page['page_content'] ?>
            <style>
            .faq-container {
              margin: 40px auto;
              font-family: Arial, sans-serif;
            }
        
            .faq-item {
              border-bottom: 1px solid #eee;
              padding: 15px 0;
              position: relative;
            }
        
            .faq-question {
              display: flex;
              justify-content: space-between;
              cursor: pointer;
              font-weight: 505;
              font-size: 16px;
            }
        
            .faq-toggle {
              font-size: 22px;
              transition: transform 0.3s ease;
            }
        
            .faq-item.active .faq-toggle {
              transform: rotate(45deg);
            }
        
            .faq-answer {
              display: none;
              padding: 10px 0;
              font-size: 14px;
              color: #333;
            }
        
            .faq-item.active .faq-answer {
              display: block;
            }
          </style>
        <div class="faq-container" id="faqList">
            <?php foreach($items as $item):?>
          <div class="faq-item">
            <div class="faq-question" role="button" aria-expanded="false" aria-controls="faq-answer-<?= $item['id'] ?>">
              <span class="faq-title"><?= htmlspecialchars($item['faq_question']) ?></span>
              <span class="faq-toggle" aria-hidden="true">+</span>
            </div>
            <div class="faq-answer" id="faq-answer-<?= $item['id'] ?>">
             <?= htmlspecialchars($item['answer']) ?>
            </div>
          </div>
            <?php endforeach;?>
        </div>
        </div>
    </div>
</div>

<!-- FAQ Schema Markup -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    <?php
    $faqItems = [];
    foreach ($items as $item) {
        $faqItems[] = json_encode([
            '@type' => 'Question',
            'name' => htmlspecialchars_decode($item['faq_question']),
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => htmlspecialchars_decode($item['answer'])
            ]
        ], JSON_UNESCAPED_SLASHES);
    }
    echo implode(",\n    ", $faqItems);
    ?>
  ]
}
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const faqContainer = document.getElementById('faqList');

    faqContainer.addEventListener('click', function (e) {
        const questionEl = e.target.closest('.faq-question');
        if (questionEl) {
            const clickedItem = questionEl.parentElement;
            const isExpanded = clickedItem.classList.contains('active');
            const answerId = questionEl.getAttribute('aria-controls');
            
            // Toggle active class
            clickedItem.classList.toggle('active');
            
            // Update ARIA attributes
            questionEl.setAttribute('aria-expanded', !isExpanded);
            document.getElementById(answerId).setAttribute('aria-hidden', isExpanded);
            
            // Close other items
            faqContainer.querySelectorAll('.faq-item').forEach(item => {
                if (item !== clickedItem && item.classList.contains('active')) {
                    item.classList.remove('active');
                    const otherQuestion = item.querySelector('.faq-question');
                    const otherAnswerId = otherQuestion.getAttribute('aria-controls');
                    otherQuestion.setAttribute('aria-expanded', 'false');
                    document.getElementById(otherAnswerId).setAttribute('aria-hidden', 'true');
                }
            });
        }
    });
});
</script>

<?php 
    template_include("/frontend/partials/footer");
?>