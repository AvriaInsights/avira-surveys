<?php 
require_once("survey/classes/cls-survey.php");
$obj_survey = new Survey();
$page = "home";
$page_title = "Global Market Surveys | Industry Insights - " . SITETITLE;
$meta_description = "The insights that help you with worldwide industry survey, markets trends for future outlook and actionable insights to impact your industry.";
$meta_keywords = "";
include('header.php')?>
<!--banner-section-start-->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<header class="home-header" id="myHeader">
    <div class="top-header pt-4 pb-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-6"></div>
                <div class="col-lg-6">
                    <ul class="list-unstyled justify-content-end d-flex mb-0 pe-6 mob-top-menu">
                        <li>
                            <a href="tel:1 (407) 768-2028">
                                <i class="fa fa-phone"></i>
                                  +1 (407) 768-2028
                            </a>
                        </li>
                        <li>
                            <a href="mailto:<?php echo SITEEMAIL; ?>">
                                <i class="fa fa-envelope"></i>
                                <?php echo SITEEMAIL; ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7"></div>
                <div class="col-md-5">
                    <ul class="list-unstyled d-flex top-list justify-content-end tab-view mt-3 mb-0">
                         <li>
                            <a href="<?php echo SITEPATHFRONT; ?>survey" class="btn-login">Login</a>
                        </li>
                        <li>
                             <a href="<?php echo SITEPATHFRONT; ?>register" class="btn ms-0 me-0 btn-signup">Sign Up</a>
                        </li>
                    </ul>
                </div>
            </div>
            
        </div>
    </div>
    
    <div class="header-menu">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="<?php echo SITEPATHFRONT; ?>">
                    <img src="<?php echo SITEPATHFRONT; ?>images/logo-dark.png" alt="survey-logo" class="img-fluid company-logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="ms-auto d-flex">
                        <!--<form class="d-flex">-->
                        <!--    <input class="form-control search-holder" type="search" placeholder="Search" aria-label="Search">-->
                        <!--    <button class="btn search-btn" type="submit">-->
                        <!--        <i class="fa fa-search"></i>-->
                        <!--    </button>-->
                        <!--</form>-->
                        
                        <div class="">
                            <div class="site-mobile-menu-header">
                                <div class="site-mobile-menu-close mt-3">
                                    <span class="icon-close2 js-menu-toggle">
                                    </span>
                                </div>
                            </div>
                        </div>
                            <ul class="list-unstyled d-flex top-list align-items-center mb-0 mob-menu">
                                
                                <li class="nav-menu2 first-menu" id="survey-list">
                                    <a href="<?php echo SITEPATHFRONT; ?>survey-list">Survey List</a>
                                </li>
                                
                                 <li class="nav-menu2" id="contact-us">
                                    <a href="<?php echo SITEPATHFRONT; ?>contact-us">Contact Us</a>
                                </li>
                                
                                <li>
                                    <a href="<?php echo SITEPATHFRONT; ?>survey/login" class="btn-login desk-top-btn">Login</a>
                                </li>
                                <li>
                                     <a href="<?php echo SITEPATHFRONT; ?>register" class="btn ms-0 me-0 btn-signup desk-top-btn">Sign Up</a>
                                </li>
                                <li>
                                    <div class="search-menu toggled " style="display:none">
                                    <div class="site-mobile-menu-close mt-3">
                                        <span class="icon-close2 js-menu-toggle text-white search-bar-close"></span>
                                    </div>
                                    <div class="wrapper">
                                        <div class="text-center pb-5">
                                           <img src="images/logo-dark.png" alt="survey-logo" class="img-fluid company-logo">
                                        </div>
                                        <div id="form">
                                            <input class="popup-search" type="text" placeholder="Find Market Research Report"
                                            id="popupsearch" name="popupsearch">
                                            <div class="">
                                                <div class="searchrow">
                                                    <div class="col-md-12">
                                                    <div id="searchpopup" style="display: none;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <button class="popup-search-button" type="button" id="header_search">
                                                <i class="fa fa-search search-icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                  </div>
                                     <i class="fa fa-search search-icon" style="display: none;"></i>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>



<section class="banner-1">
    <!--<div class="overlay-element">-->
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-md-4"></div>
            <div class="col-xl-6 col-md-12">
                <div class="banner-one-text"> 
                    <div>
                        <h1>Brilliant
                            <span class="typewrite tick-tack " data-period="2000" data-type='[ " Ideas!",  "People! "]' 
                            <span class="wrap"></span></span></h1>
                        <p>
                         AviraSurveys applies Experience-Management strategies to deliver actionable insights across a broad spectrum</p>
                    </div>
                    <!--<form class="d-flex mb-4 ">-->
                    <!--    <input class="form-control search-holder" type="search" placeholder="Search" aria-label="Search">-->
                    <!--    <button class="btn search-btn search-btn-1" type="submit">-->
                    <!--       <a href="<?php echo SITEPATHFRONT;?>register">Free Trial</a>-->
                    <!--    </button>-->
                    <!--</form>-->
                    <!--<a href="<?php echo SITEPATH?>" class="text-decoration-underline">Take Survey</a>-->
                </div>
            </div>
        </div>
    </div>
  <!--</div> -->                                                            
</section>

<section class="part-2 d-flex align-items-center justify-content-center">
    <div class="container">
        <div class="row row d-flex align-items-center">
            <div class="col-md-12">
                <div class="text-end">
                    <img src="images/pattern-top.png" class="img-fluid pattern-img-right">
                </div>
            </div>
            <div class="col-lg-6 aos-init aos-animate" data-aos="fade-right" data-aos-delay="200">
                <!--<img src="images/section-2-img.png" alt="second-img" class="img-fluid">-->
                <div class="desktop-wrapper">
                    <iframe   width="700" height="315" src="<?php echo SITEPATHFRONT?>images/video/survey-demo-new.mp4" frameborder="0" allowfullscreen></iframe>
                </div>
                
            </div>
            <div class="col-lg-4 offset-lg-1 aos-init aos-animate" data-aos="fade-left" data-aos-delay="200">
                <div class="second-part-content">
                    <h2 class="mb-0 ttl">Beyond just a Survey</h2>
                    <p class="mb-0">AviraSurveys combines the best of Business Knowledge, Marketing Prowess and Technology Integration to deliver the most relevant
                    and appropriate output for efficient decision making!</p>
                    <a href="<?php echo SITEPATHFRONT;?>survey-list" class="btn cta-btn m-0 btn5">View Sample Survey</a>
                </div>
            </div>
            <div class="col-md-12">
                <div class="">
                    <img src="<?php echo SITEPATHFRONT ?>images/pattern-bottom.png" class="img-fluid pattern-bottom-img">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="d-flex align-items-center justify-content-center ptb position-relative">
    <div class="container">
        <div class="row">
            <div class="col-md-12 aos-init aos-animate" data-aos="fade-right" data-aos-delay="200">
                <h2 class="ttl pb-4">Categories</h2>
            </div>
        </div>
        <div class="row desktop-ind">
            <div class="col-lg-4 aos-init aos-animate" data-aos="fade-right" data-aos-delay="200">
                <div class="industry-tabs">
                    <div class="d-flex align-items-start">
                      <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link active" id="v-pills-ind-1-tab" data-bs-toggle="pill" data-bs-target="#v-pills-ind-1" 
                        type="button" role="tab" aria-controls="v-pills-ind-1" aria-selected="true">Product Research
                            <i class="fa fa-angle-right"></i>
                        </button>
                        
                        <button class="nav-link" id="v-pills-ind-2-tab" data-bs-toggle="pill" data-bs-target="#v-pills-ind-2"
                        type="button" role="tab" aria-controls="v-pills-ind-2" aria-selected="false">Brand Research
                            <i class="fa fa-angle-right"></i>
                        </button>
                        
                        <button class="nav-link" id="v-pills-ind-3-tab" data-bs-toggle="pill" data-bs-target="#v-pills-ind-3" 
                        type="button" role="tab" aria-controls="v-pills-ind-3" aria-selected="false">Lead Generation
                            <i class="fa fa-angle-right"></i>
                        </button>
                        
                        <button class="nav-link" id="v-pills-ind-4-tab" data-bs-toggle="pill" data-bs-target="#v-pills-ind-4" 
                        type="button" role="tab" aria-controls="v-pills-ind-4" aria-selected="false">Client Research
                            <i class="fa fa-angle-right"></i>
                        </button>
                        
                        <button class="nav-link" id="v-pills-ind-5-tab" data-bs-toggle="pill" data-bs-target="#v-pills-ind-5" 
                        type="button" role="tab" aria-controls="v-pills-ind-5" aria-selected="false">Market Research & Analysis
                            <i class="fa fa-angle-right"></i>
                        </button>
                        
                        <button class="nav-link" id="v-pills-ind-6-tab" data-bs-toggle="pill" data-bs-target="#v-pills-ind-6" 
                        type="button" role="tab" aria-controls="v-pills-ind-6" aria-selected="false">Customer Satisfaction
                            <i class="fa fa-angle-right"></i>
                        </button>
                        
                      </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 aos-init aos-animate" data-aos="zoom-in" data-aos-delay="200">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-ind-1" role="tabpanel" aria-labelledby="v-pills-ind-1-tab">
                        <div class="industry-content">
                            <img src="<?php echo SITEPATHFRONT?>images/category/Product-Research.png" alt="Product Research" class="img-fluid pb-3">
                            <div class="">
                                <h3>Product Research</h3>
                                <p class="para">It is always important to know if a Product or Service has what it takes to reach the Leadership board.
                                And even if the Ranking is amongst the Top, it is important to be wary of the customer pain-points and unmet needs on a continual 
                                basis. The dynamic market changes keep highlighting the need to thrive in the competitive landscape. AviraSurveys, through its 
                                Analyst expertise, understands the right approach to conduct Primary Research based Product-opinion
                                </p>
                                <a href="<?php echo SITEPATHFRONT; ?>survey-list" class="btn cta-btn m-0 btn5">Take Survey</a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-ind-2" role="tabpanel" aria-labelledby="v-pills-ind-2-tab">
                        <div class="industry-content">
                            <img src="<?php echo SITEPATHFRONT?>images/category/Brand-Reserach.png" alt="Brand Research" class="img-fluid pb-3">
                            <div class="">
                                <h3>Brand Research</h3>
                                <p class="para">To rightly monitor and act-on the execution of the various business strategies, it is imperative to gauge the health of 
                                the Company. The perception of the ecosystem in which a Company operates is of utmost priority to materialize all the goals and targets. 
                                Through our competitive intelligence, AviraSurveys applies all the right triggers – right target audience, ecosystem approach, market 
                                player analysis, expectation setting – to derive the right brand value
                                </p>
                                 <a href="<?php echo SITEPATHFRONT; ?>survey-list" class="btn cta-btn m-0 btn5">Take Survey</a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-ind-3" role="tabpanel" aria-labelledby="v-pills-ind-3-tab">
                        <div class="industry-content">
                            <img src="<?php echo SITEPATHFRONT?>images/category/Lead-Generation.png" alt="Lead-Generation" class="img-fluid pb-3">
                            <div class="">
                                <h3>Lead Generation</h3>
                                <p class="para">With the ‘new normal’ changing the outreach mechanism, connecting with business prospects comes with newer challenges.
                                Without investing too much time, money, and energies, it is important to churn the universe of potential clientele by effectively
                                reaching out. AviraSurveys, through its understanding of the entire Lead Gen funnel, applies Market Intelligence to identify new 
                                revenue opportunities by mapping right prospects, all the time!
                                </p>
                                <a href="<?php echo SITEPATHFRONT; ?>survey-list" class="btn cta-btn m-0 btn5">Take Survey</a>
                            </div>
                        </div>    
                    </div>
                    <div class="tab-pane fade" id="v-pills-ind-4" role="tabpanel" aria-labelledby="v-pills-ind-4-tab">
                        <div class="industry-content">
                            <img src="<?php echo SITEPATHFRONT?>images/category/Client-Research.png" alt="Client-Research" class="img-fluid pb-3">
                            <div class="">
                                <h3>Client Research</h3>
                                <p class="para">Any business is relevant for as along as it has something valuable to provide to its clients. And that requires a
                                thorough understanding of customer expectations, their pain-points and unmet needs, new business applications, and more. AviraSurveys, 
                                through its Technology integration and Market Research partnerships, reaches out to the clients and generates the necessary
                                information to stay ahead in the cutting-edge competitive universe
                                </p>
                                 <a href="<?php echo SITEPATHFRONT; ?>survey-list" class="btn cta-btn m-0 btn5">Take Survey</a>
                            </div>
                        </div> 
                    </div>
                    <div class="tab-pane fade" id="v-pills-ind-5" role="tabpanel" aria-labelledby="v-pills-ind-5-tab">
                        <div class="industry-content">
                            <img src="<?php echo SITEPATHFRONT?>images/category/Market-Research-and-Analysis.png" alt="Market Research & Analysis" class="img-fluid pb-3">
                            <div class="">
                                <h3>Market Research & Analysis</h3>
                                <p class="para">The starting point of all business plans and execution is to understand the playing field. Market Trends, Market
                                Forecast, Key Drivers, Restraints, Competition Analysis, and more are to be analysed to validate the business strategies.
                                utilize AviraSurveys to make well informed decision
                                </p>
                                 <a href="<?php echo SITEPATHFRONT; ?>survey-list" class="btn cta-btn m-0 btn5">Take Survey</a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-ind-6" role="tabpanel" aria-labelledby="v-pills-ind-6-tab">
                        <div class="industry-content">
                            <img src="<?php echo SITEPATHFRONT?>images/category/Customer-Satisfaction.png" alt="Customer-Satisfaction" class="img-fluid pb-3">
                            <div class="">
                                <h3>Customer Satisfaction</h3>
                                <p class="para">AviraSurveys are suitable to conduct customer satisfaction campaigns and ensure that ‘client-delight’ is not just a
                                hypothetical term, but that which decides the ethos of a Business. Always knowing the satisfaction levels of the Clients through 
                                regular and appropriate reach-out will ensure organic business growth is not hampered at any stages of business life cycle.
                                </p>
                                <a href="<?php echo SITEPATHFRONT; ?>survey-list" class="btn cta-btn m-0 btn5">Take Survey</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 aos-init aos-animate" data-aos="fade-left" data-aos-delay="300">
                <img src="<?php echo SITEPATHFRONT?>images/Industry-side-character1.png" class="img-fluid category-img">
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="accordion mob-industry" id="accordionExample">
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="ind-1">
                      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-ind-1"
                      aria-expanded="true" aria-controls="collapse-ind-1">
                        Product Research
                      </button>
                    </h2>
                    <div id="collapse-ind-1" class="accordion-collapse collapse show" aria-labelledby="ind-1" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                          <div class="industry-content">
                            <img src="<?php echo SITEPATHFRONT?>images/category/Product-Research.png" alt="Product Research" class="img-fluid pb-3">
                          </div>
                        <p>It is always important to know if a Product or Service has what it takes to reach the Leadership board. And even if the Ranking is
                        amongst the Top, it is important to be wary of the customer pain-points and unmet needs on a continual basis. The dynamic market changes 
                        keep highlighting the need to thrive in the competitive landscape. AviraSurveys, through its Analyst expertise, understands the right 
                        approach to conduct Primary Research based Product-opinion</p>
                         <a href="<?php echo SITEPATHFRONT; ?>survey-list" class="btn cta-btn m-0 btn5">Take Survey</a>
                      </div>
                    </div>
                  </div>
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="ind-2">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-ind-2"
                      aria-expanded="false" aria-controls="collapse-ind-2">
                        Brand Research
                      </button>
                    </h2>
                    <div id="collapse-ind-2" class="accordion-collapse collapse" aria-labelledby="ind-2" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                          <div class="industry-content">
                            <img src="<?php echo SITEPATHFRONT?>images/category/Brand-Reserach.png" alt="Brand Research" class="img-fluid pb-3">
                          </div>
                        <p>To rightly monitor and act-on the execution of the various business strategies, it is imperative to gauge the health of the Company.
                        The perception of the ecosystem in which a Company operates is of utmost priority to materialize all the goals and targets. Through
                        our competitive intelligence, AviraSurveys applies all the right triggers – right target audience, ecosystem approach, market player 
                        analysis, expectation setting – to derive the right brand value</p>
                         <a href="<?php echo SITEPATHFRONT; ?>survey-list" class="btn cta-btn m-0 btn5">Take Survey</a>
                      </div>
                    </div>
                  </div>
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="ind-3">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-ind-3"
                      aria-expanded="false" aria-controls="collapse-ind-3">
                        Lead Generation
                      </button>
                    </h2>
                    <div id="collapse-ind-3" class="accordion-collapse collapse" aria-labelledby="ind-3" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                          <div class="industry-content">
                           <img src="<?php echo SITEPATHFRONT?>images/category/Lead-Generation.png" alt="Lead-Generation" class="img-fluid pb-3">
                          </div>
                        <p>With the ‘new normal’ changing the outreach mechanism, connecting with business prospects comes with newer challenges. Without
                        investing too much time, money, and energies, it is important to churn the universe of potential clientele by effectively reaching out.
                        AviraSurveys, through its understanding of the entire Lead Gen funnel, applies Market Intelligence to identify new revenue opportunities
                        by mapping right prospects, all the time!</p>
                         <a href="<?php echo SITEPATHFRONT; ?>survey-list" class="btn cta-btn m-0 btn5">Take Survey</a>
                      </div>
                    </div>
                  </div>
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="ind-4">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-ind-4"
                      aria-expanded="false" aria-controls="collapse-ind-4">
                        Client Research
                      </button>
                    </h2>
                    <div id="collapse-ind-4" class="accordion-collapse collapse" aria-labelledby="ind-4" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                          <div class="industry-content">
                            <img src="<?php echo SITEPATHFRONT?>images/category/Client-Research.png" alt="Client-Research" class="img-fluid pb-3">
                          </div>
                        <p>Any business is relevant for as along as it has something valuable to provide to its clients. And that requires a thorough
                        understanding of customer expectations, their pain-points and unmet needs, new business applications, and more. AviraSurveys, 
                        through its Technology integration and Market Research partnerships, reaches out to the clients and generates the necessary 
                        information to stay ahead in the cutting-edge competitive universe</p>
                         <a href="<?php echo SITEPATHFRONT; ?>survey-list" class="btn cta-btn m-0 btn5">Take Survey</a>
                      </div>
                    </div>
                  </div>
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="ind-5">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-ind-5"
                      aria-expanded="false" aria-controls="collapse-ind-5">
                       Market Research & Analysis
                      </button>
                    </h2>
                    <div id="collapse-ind-5" class="accordion-collapse collapse" aria-labelledby="ind-5" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                          <div class="industry-content">
                            <img src="<?php echo SITEPATHFRONT?>images/category/Market-Research-and-Analysis.png" alt="Market Research & Analysis" class="img-fluid pb-3">
                          </div>
                         <p>The starting point of all business plans and execution is to understand the playing field. Market Trends, Market Forecast, 
                         Key Drivers, Restraints, Competition Analysis, and more are to be analysed to validate the business strategies. Whether it’s a
                         Go-to-market strategy, Digital Transformation, Commercial feasibility analysis or any other key business plan – utilize AviraSurveys
                         to make well informed decision</p>
                          <a href="<?php echo SITEPATHFRONT; ?>survey-list" class="btn cta-btn m-0 btn5">Take Survey</a>
                      </div>
                    </div>
                  </div>
                 
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="ind-7">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-ind-7"
                      aria-expanded="false" aria-controls="collapse-ind-7">
                       Customer Satisfaction
                      </button>
                    </h2>
                    <div id="collapse-ind-7" class="accordion-collapse collapse" aria-labelledby="ind-7" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                          <div class="industry-content">
                             <img src="<?php echo SITEPATHFRONT?>images/category/Customer-Satisfaction.png" alt="Customer-Satisfaction" class="img-fluid pb-3">
                          </div>
                        <p>AviraSurveys are suitable to conduct customer satisfaction campaigns and ensure that ‘client-delight’ is not just a hypothetical term,
                        but that which decides the ethos of a Business. Always knowing the satisfaction levels of the Clients through regular and appropriate
                        reach-out will ensure organic business growth is not hampered at any stages of business life cycle.</p>
                         <a href="<?php echo SITEPATHFRONT; ?>survey-list" class="btn cta-btn m-0 btn5">Take Survey</a>
                      </div>
                    </div>
                  </div>
                  
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="text-end">
                    <img src="images/pattern-right.png" class="img-fluid pattern-img-right-vertical">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="count-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12 aos-init aos-animate" data-aos="fade-down" data-aos-delay="200">
                <h3 class="counter-text text-center ttl">Some facts about Avira Survey</h3>
            </div>
        </div>
        <div class="row">
                <div class="col-md-4 aos-init aos-animate" data-aos="zoom-out-up" data-aos-delay="200">
                    <div class="num-counter text-center">
                        <h4 class="text-light">Happy Clients</h4>
                       <span class="timer count-title count-number" data-to="50" data-speed="1500">50
                       </span>
                       <span>+</span>
                    </div>
                </div>
                <div class="col-md-4 aos-init aos-animate" data-aos="zoom-out-up" data-aos-delay="200">
                    <div class="num-counter text-center">
                        <h4 class="text-light">Survey Done</h4>
                         <span class="timer count-title count-number" data-to="900" data-speed="1500">900</span>
                         <span>+</span>
                     </div>
                </div>
                <div class="col-md-4 aos-init aos-animate" data-aos="zoom-out-up" data-aos-delay="200">
                    <div class="num-counter text-center">
                        <h4 class="text-light">Countries Covered</h4>
                         <span class="timer count-title count-number" data-to="145" data-speed="1500">145</span>
                         <span>+</span>
                     </div>
                </div>
                <!--<div class="col">
                    <div class="num-counter text-center">
                         <span class="timer count-title count-number" data-to="86" data-speed="1500">100000</span>
                         <span>+</span>
                     </div>
                </div>
                <div class="col">
                    <div class="num-counter text-center">
                         <span class="timer count-title count-number" data-to="149" data-speed="1500">149</span>
                         <span>+</span>
                     </div>
                </div>-->
            </div>
    </div>
</section>


</div>

<!--banner-section-end---->
<?php include('footer.php')?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>


<script>
  AOS.init();
</script>
<script>
    window.onscroll = function () {
    changeHeader();
    };

    var header = document.getElementById("myHeader");
    var sticky = header.offsetTop;
    
    function changeHeader() {
        if (window.pageYOffset > sticky) {
            header.classList.add("sticky");
        } else {
            header.classList.remove("sticky");
        }
    }
</script>

<script>
    $(document).ready(function(){
         $('.js-menu-toggle').click(function(){
            $(".navbar-collapse").hide();
       });
       
       $('.navbar-toggler').click(function(){
          $(".navbar-collapse").show(); 
       });
      
    });
 </script>


 <script>
          	(function ($) {
	$.fn.countTo = function (options) {
		options = options || {};

		return $(this).each(function () {
			// set options for current element
			var settings = $.extend({}, $.fn.countTo.defaults, {
				from:            $(this).data('from'),
				to:              $(this).data('to'),
				speed:           $(this).data('speed'),
				refreshInterval: $(this).data('refresh-interval'),
				decimals:        $(this).data('decimals')
			}, options);

			// how many times to update the value, and how much to increment the value on each update
			var loops = Math.ceil(settings.speed / settings.refreshInterval),
				increment = (settings.to - settings.from) / loops;

			// references & variables that will change with each update
			var self = this,
				$self = $(this),
				loopCount = 0,
				value = settings.from,
				data = $self.data('countTo') || {};

			$self.data('countTo', data);

			// if an existing interval can be found, clear it first
			if (data.interval) {
				clearInterval(data.interval);
			}
			data.interval = setInterval(updateTimer, settings.refreshInterval);

			// initialize the element with the starting value
			render(value);

			function updateTimer() {
				value += increment;
				loopCount++;

				render(value);

				if (typeof(settings.onUpdate) == 'function') {
					settings.onUpdate.call(self, value);
				}

				if (loopCount >= loops) {
					// remove the interval
					$self.removeData('countTo');
					clearInterval(data.interval);
					value = settings.to;

					if (typeof(settings.onComplete) == 'function') {
						settings.onComplete.call(self, value);
					}
				}
			}

			function render(value) {
				var formattedValue = settings.formatter.call(self, value, settings);
				$self.text(formattedValue);
			}
		});
	};

	$.fn.countTo.defaults = {
		from: 0,               // the number the element should start at
		to: 0,                 // the number the element should end at
		speed: 500,           // how long it should take to count between the target numbers
		refreshInterval: 100,  // how often the element should be updated
		decimals: 0,           // the number of decimal places to show
		formatter: formatter,  // handler for formatting the value before rendering
		onUpdate: null,        // callback method for every time the element is updated
		onComplete: null       // callback method for when the element finishes updating
	};

	function formatter(value, settings) {
		return value.toFixed(settings.decimals);
	}
}(jQuery));

    jQuery(function ($) {
     
      // start all the timers
      $('.timer').each(count);
      
      // restart a timer when a button is clicked
      $( window ).scroll(function () {console.log($(window).scrollTop());
    if($(window).scrollTop() > 300 && $(window).scrollTop() < 850)
    {
       $('.timer').each(count);
     }
      });
      
      function count(options) {
        var $this = $(this);
        options = $.extend({}, options || {}, $this.data('countToOptions') || {});
        $this.countTo(options);
      }
    });
</script>

<script>
$(function() {
    $('.search-menu').removeClass('toggled');

    $('.search-icon').click(function(e) {
        e.stopPropagation();
        $('.search-menu').toggleClass('toggled');
        $(".popup-search").focus();
    });

    $('.search-menu input').click(function(e) {
        e.stopPropagation();
    });

   /* $('.search-menu, body').click(function() {
        $('.search-menu').removeClass('toggled');
    });*/
    
    $('.search-bar-close').click(function() {
        $("#popupsearch").val("");
        $("#searchpopup").fadeOut();
        $("#searchpopup").html("");
        $('.search-menu').removeClass('toggled');
    });
});
</script>
<script>
    var TxtType = function(el, toRotate, period) {
        this.toRotate = toRotate;
        this.el = el;
        this.loopNum = 0;
        this.period = parseInt(period, 10) || 500;
        this.txt = '';
        this.tick();
        this.isDeleting = false;
    };

    TxtType.prototype.tick = function() {
        var i = this.loopNum % this.toRotate.length;
        var fullTxt = this.toRotate[i];

        if (this.isDeleting) {
        this.txt = fullTxt.substring(0, this.txt.length - 1);
        } else {
        this.txt = fullTxt.substring(0, this.txt.length + 1);
        }

        this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

        var that = this;
        var delta = 200 - Math.random() * 100;

        if (this.isDeleting) { delta /= 2; }

        if (!this.isDeleting && this.txt === fullTxt) {
        delta = this.period;
        this.isDeleting = true;
        } else if (this.isDeleting && this.txt === '') {
        this.isDeleting = false;
        this.loopNum++;
        delta = 500;
        }

        setTimeout(function() {
        that.tick();
        }, delta);
    };

    window.onload = function() {
        var elements = document.getElementsByClassName('typewrite');
        for (var i=0; i<elements.length; i++) {
            var toRotate = elements[i].getAttribute('data-type');
            var period = elements[i].getAttribute('data-period');
            if (toRotate) {
              new TxtType(elements[i], JSON.parse(toRotate), period);
            }
        }
        // INJECT CSS
        var css = document.createElement("style");
        css.type = "text/css";
        css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}";
        document.body.appendChild(css);
    };
</script>