<?php 
    $route = "/about";
    template_include("/frontend/partials/header" ,compact('page','route'));
    template_include("/frontend/partials/banner",compact('page'));

?>
<style>
    /* Added title styling */
    .page-title {
        font-size: 22px;
        font-weight: 600;
        color: #000000;
        border-bottom: 2px solid #ff0000;
        padding-bottom: 10px;
        display: inline-block;
        margin-bottom: 15px;
        letter-spacing: 0.5px;
    }

    /* Existing custom dropdown styles */
    .custom-dropdown {
        position: relative;
        width: 300px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        background: white;
        cursor: pointer;
    }
    
    .dropdown-header {
        padding: 10px 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .dropdown-icon {
        font-size: 12px;
        transition: transform 0.3s;
    }
    
    .custom-dropdown.open .dropdown-icon {
        transform: rotate(180deg);
    }
    
    .dropdown-options {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: white;
        border: 1px solid #ddd;
        border-top: none;
        border-radius: 0 0 4px 4px;
        z-index: 1000;
        max-height: 300px;
        overflow-y: auto;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    .options-container {
        padding: 5px 0;
    }
    
    .region-group {
        margin-bottom: 5px;
    }
    
    .region-header {
        padding: 8px 15px;
        background-color: #f5f5f5;
        font-weight: bold;
        color: #333;
    }
    
    .country-option {
        padding: 8px 15px 8px 25px;
        transition: background-color 0.2s;
    }
    
    .country-option:hover {
        background-color: #f0f8ff;
    }
</style>

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
                <a class="nav-link active" role="menuitem" href="/distributor" aria-current="page">Distributor</a>
                <a class="nav-link" role="menuitem" href="/blog">Blog</a>
                <a class="nav-link" role="menuitem" href="/faq">FAQs</a>
                <a class="nav-link" role="menuitem" href="/contact-us">Contact us</a>
            </div>
        </div>
        <div class="col-md-9">
            <div class="pinfo" style="width: 100%; background: #ffffff; padding: 10px; min-height: 40vh;">
                <!-- Updated heading with styled H1 tag -->
                <div>
                    <h1 class="page-title">Global Distributors</h1>
                    <p>Please select a country to locate a partner</p>
                </div>
                
                <!-- Dropdown Container -->
                <div class="custom-dropdown">
                    <div class="dropdown-header" id="dropdownHeader" role="button" aria-expanded="false" aria-haspopup="listbox">
                        <span class="selected-option">Select a Country</span>
                        <span class="dropdown-icon" aria-hidden="true">▼</span>
                    </div>
                    <div class="dropdown-options" role="listbox" aria-labelledby="dropdownHeader">
                        <div class="options-container">
                            <?php 
                                $regions = \app\http\models\Region::all()->get();
                                foreach($regions as $region):
                            ?>
                            <div class="region-group" role="group" aria-labelledby="region-<?= $region['id'] ?>">
                                <div class="region-header" id="region-<?= $region['id'] ?>"><?= $region['region'] ?></div>
                                <?php 
                                    $partners = app\http\models\Partners::where($region['id'], 'region_id')->get();
                                    foreach($partners as $partner):
                                ?>
                                <div class="country-option" 
                                    role="option" 
                                    data-id="<?= $partner['id'] ?>" 
                                    tabindex="0"
                                    aria-selected="false">
                                    <?= $partner['country_name'] ?>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                
                <hr class="hr" />
                <div id="address_show" style="display: block; margin-top: 10px" role="region" aria-live="polite"></div>
                
                <script>
                    // Dropdown functionality
                    const dropdownHeader = document.querySelector('.dropdown-header');
                    const dropdownOptions = document.querySelector('.dropdown-options');
                    const selectedOption = document.querySelector('.selected-option');
                    const countryOptions = document.querySelectorAll('.country-option');
                    
                    // Toggle dropdown visibility
                    dropdownHeader.addEventListener('click', function() {
                        const isOpen = dropdownOptions.style.display === 'block';
                        dropdownOptions.style.display = isOpen ? 'none' : 'block';
                        this.setAttribute('aria-expanded', !isOpen);
                    });
                    
                    // Handle keyboard navigation
                    dropdownHeader.addEventListener('keydown', function(e) {
                        if (e.key === 'Enter' || e.key === ' ') {
                            e.preventDefault();
                            const isOpen = dropdownOptions.style.display === 'block';
                            dropdownOptions.style.display = isOpen ? 'none' : 'block';
                            this.setAttribute('aria-expanded', !isOpen);
                        }
                    });
                    
                    // Handle country selection
                    countryOptions.forEach(option => {
                        option.addEventListener('click', function() {
                            selectOption(this);
                        });
                        
                        option.addEventListener('keydown', function(e) {
                            if (e.key === 'Enter' || e.key === ' ') {
                                e.preventDefault();
                                selectOption(this);
                            }
                        });
                    });
                    
                    function selectOption(option) {
                        const id = option.getAttribute('data-id');
                        selectedOption.textContent = option.textContent;
                        dropdownOptions.style.display = 'none';
                        dropdownHeader.setAttribute('aria-expanded', 'false');
                        
                        // Update ARIA states
                        countryOptions.forEach(opt => {
                            opt.setAttribute('aria-selected', 'false');
                        });
                        option.setAttribute('aria-selected', 'true');
                        
                        // Make AJAX call to get partner details
                        let xhr = new XMLHttpRequest();
                        xhr.open('GET', "/global/partners/details?target=" + id, true);
                        xhr.onload = (e) => {
                            if(xhr.readyState === 4) {
                                if(xhr.status === 200) {
                                    let data = JSON.parse(xhr.response);
                                    let show = document.getElementById("address_show");
                                    show.innerHTML = "";
                                    if(data.company_details) {
                                        show.innerHTML = data.company_details;
                                    } else {
                                        show.innerHTML = "<p>Nothing found for this country</p>";
                                    }
                                }
                            } else {
                                console.log(JSON.parse(xhr.response));
                            }
                        }
                        xhr.send(null);
                    }
                    
                    // Close dropdown when clicking outside
                    document.addEventListener('click', function(event) {
                        if (!event.target.closest('.custom-dropdown')) {
                            dropdownOptions.style.display = 'none';
                            dropdownHeader.setAttribute('aria-expanded', 'false');
                        }
                    });
                </script>
            </div>
        </div>
    </div>
</div>
<?php 
    template_include("/frontend/partials/footer");
?>