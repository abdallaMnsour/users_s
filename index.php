<?php
include 'includes/header.php';

require_once 'functions/connect.php';

if ($user_bool) {
    try {
        $query = "SELECT * FROM skills WHERE user_id = '{$user['id']}'";
        $query = mysqli_query($conn, $query);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

?>
<!-- main-area -->
<main>

    <!-- banner-area -->
    <section class="banner">
        <div class="container custom-container">
            <div class="row align-items-center justify-content-center justify-content-lg-between">
                <div class="col-lg-6 order-0 order-lg-2">
                    <div class="banner__img text-center text-xxl-end">
                        <?php if ($user_bool) : ?>
                            <img src="img/users/<?= $user['image'] ?>" alt="">
                        <?php else : ?>
                            <img src="assets/img/banner/banner_img.png" alt="">
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-6">
                    <div class="banner__content">
                        <h2 class="title wow fadeInUp" data-wow-delay=".2s"><span>I will give you Best</span> <br> Product in the shortest time.</h2>
                        <p class="wow fadeInUp" data-wow-delay=".4s">I'm a Rasalina based product design & visual designer focused on crafting clean & user‑friendly experiences</p>
                        <a href="about.php" class="btn banner__btn wow fadeInUp" data-wow-delay=".6s">more about me</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="scroll__down">
            <a href="#aboutSection" class="scroll__link">Scroll down</a>
        </div>
        <div class="banner__video">
            <a href="https://www.youtube.com/watch?v=XHOmBV4js_E" class="popup-video"><i class="fas fa-play"></i></a>

    </section>
    <!-- banner-area-end -->

    <!-- about-area -->
    <section id="aboutSection" class="about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <ul class="about__icons__wrap">
                        <?php
                        if ($user_bool) :
                            while ($skill = mysqli_fetch_assoc($query)) : ?>
                                <li>
                                    <img src="files_users/<?= $user['email'] ?>/<?= $skill['image'] ?>" alt="<?= $skill['skill_name'] ?>">
                                </li>
                            <?php
                            endwhile;
                        else :
                            ?>
                            <li>
                                <img class="light" src="assets/img/icons/skeatch_light.png" alt="Skeatch">
                                <img class="dark" src="assets/img/icons/skeatch.png" alt="Skeatch">
                            </li>
                            <li>
                                <img class="light" src="assets/img/icons/illustrator_light.png" alt="Illustrator">
                                <img class="dark" src="assets/img/icons/illustrator.png" alt="Illustrator">
                            </li>
                            <li>
                                <img class="light" src="assets/img/icons/hotjar_light.png" alt="Hotjar">
                                <img class="dark" src="assets/img/icons/hotjar.png" alt="Hotjar">
                            </li>
                            <li>
                                <img class="light" src="assets/img/icons/invision_light.png" alt="Invision">
                                <img class="dark" src="assets/img/icons/invision.png" alt="Invision">
                            </li>
                            <li>
                                <img class="light" src="assets/img/icons/photoshop_light.png" alt="Photoshop">
                                <img class="dark" src="assets/img/icons/photoshop.png" alt="Photoshop">
                            </li>
                            <li>
                                <img class="light" src="assets/img/icons/figma_light.png" alt="Figma">
                                <img class="dark" src="assets/img/icons/figma.png" alt="Figma">
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <div class="about__content">
                        <div class="section__title">
                            <span class="sub-title">01 - About me</span>
                            <h2 class="title">I have transform your ideas into remarkable digital products</h2>
                        </div>
                        <div class="about__exp">
                            <div class="about__exp__icon">
                                <img src="assets/img/icons/about_icon.png" alt="">
                            </div>
                            <div class="about__exp__content">
                                <p>20+ Years Experience In this game, Means <br> Product Designing</p>
                            </div>
                        </div>
                        <p class="desc">I love to work in User Experience & User Interface designing. Because I love to solve the design problem and find easy and better solutions to solve it. I always try my best to make good user interface with the best user experience. I have been working as a UX Designer</p>
                        <?php if ($user_bool && $user['cv'] != 'no_cv') : ?>
                            <a download href="files_users/<?= $user['email'] . '/' . $user['cv'] ?>" class="btn">Download my resume</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about-area-end -->

    <!-- services-area -->
    <section class="services">
        <div class="container">
            <div class="services__title__wrap">
                <div class="row align-items-center justify-content-between">
                    <div class="col-xl-5 col-lg-6 col-md-8">
                        <div class="section__title">
                            <span class="sub-title">02 - my Services</span>
                            <h2 class="title">Creates amazing digital experiences</h2>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6 col-md-4">
                        <div class="services__arrow"></div>
                    </div>
                </div>
            </div>
            <div class="row gx-0 services__active">
                <div class="col-xl-3">
                    <div class="services__item">
                        <div class="services__thumb">
                            <a href="services-details.php"><img src="assets/img/images/services_img01.jpg" alt=""></a>
                        </div>
                        <div class="services__content">
                            <div class="services__icon">
                                <img class="light" src="assets/img/icons/services_light_icon01.png" alt="">
                                <img class="dark" src="assets/img/icons/services_icon01.png" alt="">
                            </div>
                            <h3 class="title"><a href="services-details.php">Business Strategy</a></h3>
                            <p>Strategy is a forward-looking plan for your brand’s behavior. Strategy is a forward-looking plan.</p>
                            <ul class="services__list">
                                <li>Research & Data</li>
                                <li>Branding & Positioning</li>
                                <li>Business Consulting</li>
                                <li>Go To Market</li>
                            </ul>
                            <a href="services-details.php" class="btn border-btn">Read more</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="services__item">
                        <div class="services__thumb">
                            <a href="services-details.php"><img src="assets/img/images/services_img02.jpg" alt=""></a>
                        </div>
                        <div class="services__content">
                            <div class="services__icon">
                                <img class="light" src="assets/img/icons/services_light_icon02.png" alt="">
                                <img class="dark" src="assets/img/icons/services_icon02.png" alt="">
                            </div>
                            <h3 class="title"><a href="services-details.php">Brand Strategy</a></h3>
                            <p>Strategy is a forward-looking plan for your brand’s behavior. Strategy is a forward-looking plan.</p>
                            <ul class="services__list">
                                <li>User Research & Testing</li>
                                <li>UX Design</li>
                                <li>Visual Design</li>
                                <li>Information Architecture</li>
                            </ul>
                            <a href="services-details.php" class="btn border-btn">Read more</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="services__item">
                        <div class="services__thumb">
                            <a href="services-details.php"><img src="assets/img/images/services_img03.jpg" alt=""></a>
                        </div>
                        <div class="services__content">
                            <div class="services__icon">
                                <img class="light" src="assets/img/icons/services_light_icon03.png" alt="">
                                <img class="dark" src="assets/img/icons/services_icon03.png" alt="">
                            </div>
                            <h3 class="title"><a href="services-details.php">Product Design</a></h3>
                            <p>Strategy is a forward-looking plan for your brand’s behavior. Strategy is a forward-looking plan.</p>
                            <ul class="services__list">
                                <li>User Research & Testing</li>
                                <li>UX Design</li>
                                <li>Visual Design</li>
                                <li>Information Architecture</li>
                            </ul>
                            <a href="services-details.php" class="btn border-btn">Read more</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="services__item">
                        <div class="services__thumb">
                            <a href="services-details.php"><img src="assets/img/images/services_img04.jpg" alt=""></a>
                        </div>
                        <div class="services__content">
                            <div class="services__icon">
                                <img class="light" src="assets/img/icons/services_light_icon04.png" alt="">
                                <img class="dark" src="assets/img/icons/services_icon04.png" alt="">
                            </div>
                            <h3 class="title"><a href="services-details.php">Visual Design</a></h3>
                            <p>Strategy is a forward-looking plan for your brand’s behavior. Strategy is a forward-looking plan.</p>
                            <ul class="services__list">
                                <li>User Research & Testing</li>
                                <li>UX Design</li>
                                <li>Visual Design</li>
                                <li>Information Architecture</li>
                            </ul>
                            <a href="services-details.php" class="btn border-btn">Read more</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="services__item">
                        <div class="services__thumb">
                            <a href="services-details.php"><img src="assets/img/images/services_img03.jpg" alt=""></a>
                        </div>
                        <div class="services__content">
                            <div class="services__icon">
                                <img class="light" src="assets/img/icons/services_light_icon02.png" alt="">
                                <img class="dark" src="assets/img/icons/services_icon02.png" alt="">
                            </div>
                            <h3 class="title"><a href="services-details.php">Web Development</a></h3>
                            <p>Strategy is a forward-looking plan for your brand’s behavior. Strategy is a forward-looking plan.</p>
                            <ul class="services__list">
                                <li>User Research & Testing</li>
                                <li>UX Design</li>
                                <li>Visual Design</li>
                                <li>Information Architecture</li>
                            </ul>
                            <a href="services-details.php" class="btn border-btn">Read more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- services-area-end -->

    <!-- work-process-area -->
    <section class="work__process">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8">
                    <div class="section__title text-center">
                        <span class="sub-title">03 - Working Process</span>
                        <h2 class="title">A clear product design process is the basis of success</h2>
                    </div>
                </div>
            </div>
            <div class="row work__process__wrap">
                <div class="col">
                    <div class="work__process__item">
                        <span class="work__process_step">Step - 01</span>
                        <div class="work__process__icon">
                            <img class="light" src="assets/img/icons/wp_light_icon01.png" alt="">
                            <img class="dark" src="assets/img/icons/wp_icon01.png" alt="">
                        </div>
                        <div class="work__process__content">
                            <h4 class="title">Discover</h4>
                            <p>Initial ideas or inspiration & Establishment of user needs.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="work__process__item">
                        <span class="work__process_step">Step - 02</span>
                        <div class="work__process__icon">
                            <img class="light" src="assets/img/icons/wp_light_icon02.png" alt="">
                            <img class="dark" src="assets/img/icons/wp_icon02.png" alt="">
                        </div>
                        <div class="work__process__content">
                            <h4 class="title">Define</h4>
                            <p>Interpretation & Alignment of findings to project objectives.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="work__process__item">
                        <span class="work__process_step">Step - 03</span>
                        <div class="work__process__icon">
                            <img class="light" src="assets/img/icons/wp_light_icon03.png" alt="">
                            <img class="dark" src="assets/img/icons/wp_icon03.png" alt="">
                        </div>
                        <div class="work__process__content">
                            <h4 class="title">Develop</h4>
                            <p>Design-Led concept and Proposals hearted & assessed</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="work__process__item">
                        <span class="work__process_step">Step - 04</span>
                        <div class="work__process__icon">
                            <img class="light" src="assets/img/icons/wp_light_icon04.png" alt="">
                            <img class="dark" src="assets/img/icons/wp_icon04.png" alt="">
                        </div>
                        <div class="work__process__content">
                            <h4 class="title">Deliver</h4>
                            <p>Process outcomes finalised & Implemented</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- work-process-area-end -->

    <!-- portfolio-area -->
    <section class="portfolio">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8">
                    <div class="section__title text-center">
                        <span class="sub-title">04 - Portfolio</span>
                        <h2 class="title">All creative work</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-12">
                    <ul class="nav nav-tabs portfolio__nav" id="portfolioTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="true">All</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="website-tab" data-bs-toggle="tab" data-bs-target="#website" type="button" role="tab" aria-controls="website" aria-selected="false">website</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="apps-tab" data-bs-toggle="tab" data-bs-target="#apps" type="button" role="tab" aria-controls="apps" aria-selected="false">mobile apps</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="dashboard-tab" data-bs-toggle="tab" data-bs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Dashboard</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="landing-tab" data-bs-toggle="tab" data-bs-target="#landing" type="button" role="tab" aria-controls="landing" aria-selected="false">landing page</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="branding-tab" data-bs-toggle="tab" data-bs-target="#branding" type="button" role="tab" aria-controls="branding" aria-selected="false">Branding</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="graphic-tab" data-bs-toggle="tab" data-bs-target="#graphic" type="button" role="tab" aria-controls="graphic" aria-selected="false">Graphic Design</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="tab-content" id="portfolioTabContent">
            <div class="tab-pane show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                <div class="container">
                    <div class="row gx-0 justify-content-center">
                        <div class="col">
                            <div class="portfolio__active">
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img01.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>Apps Design</span>
                                        <h4 class="title"><a href="portfolio-details.php">Banking Management System</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img02.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>Web Design</span>
                                        <h4 class="title"><a href="portfolio-details.php">Banking Management System</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img03.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>UX/UI Design</span>
                                        <h4 class="title"><a href="portfolio-details.php">Banking Management System</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img04.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>Web Development</span>
                                        <h4 class="title"><a href="portfolio-details.php">Banking Management System</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img05.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>Web Development</span>
                                        <h4 class="title"><a href="portfolio-details.php">Banking Management System</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img06.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>Web Development</span>
                                        <h4 class="title"><a href="portfolio-details.php">Banking Management System</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img07.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>Web Development</span>
                                        <h4 class="title"><a href="portfolio-details.php">Banking Management System</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="website" role="tabpanel" aria-labelledby="website-tab">
                <div class="container">
                    <div class="row gx-0 justify-content-center">
                        <div class="col">
                            <div class="portfolio__active">
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img07.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>Web Development</span>
                                        <h4 class="title"><a href="portfolio-details.php">Nature of Business Strategy System</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img06.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>Web Development</span>
                                        <h4 class="title"><a href="portfolio-details.php">Banking Management System</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img01.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>Apps Design</span>
                                        <h4 class="title"><a href="portfolio-details.php">Banking Management System</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img02.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>Web Design</span>
                                        <h4 class="title"><a href="portfolio-details.php">Banking Management System</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img03.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>UX/UI Design</span>
                                        <h4 class="title"><a href="portfolio-details.php">Banking Management System</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img04.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>Web Development</span>
                                        <h4 class="title"><a href="portfolio-details.php">Banking Management System</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img05.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>Web Development</span>
                                        <h4 class="title"><a href="portfolio-details.php">Banking Management System</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="apps" role="tabpanel" aria-labelledby="apps-tab">
                <div class="container">
                    <div class="row gx-0 justify-content-center">
                        <div class="col">
                            <div class="portfolio__active">
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img06.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>Web Development</span>
                                        <h4 class="title"><a href="portfolio-details.php">Product Design and Development</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img01.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>Apps Design</span>
                                        <h4 class="title"><a href="portfolio-details.php">Banking Management System</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img02.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>Web Design</span>
                                        <h4 class="title"><a href="portfolio-details.php">Banking Management System</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img03.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>UX/UI Design</span>
                                        <h4 class="title"><a href="portfolio-details.php">Banking Management System</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img04.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>Web Development</span>
                                        <h4 class="title"><a href="portfolio-details.php">Banking Management System</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img05.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>Web Development</span>
                                        <h4 class="title"><a href="portfolio-details.php">Banking Management System</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img07.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>Web Development</span>
                                        <h4 class="title"><a href="portfolio-details.php">Banking Management System</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                <div class="container">
                    <div class="row gx-0 justify-content-center">
                        <div class="col">
                            <div class="portfolio__active">
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img05.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>Web Development</span>
                                        <h4 class="title"><a href="portfolio-details.php">Brand strategy System Management</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img01.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>Apps Design</span>
                                        <h4 class="title"><a href="portfolio-details.php">Banking Management System</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img02.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>Web Design</span>
                                        <h4 class="title"><a href="portfolio-details.php">Banking Management System</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img03.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>UX/UI Design</span>
                                        <h4 class="title"><a href="portfolio-details.php">Banking Management System</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img04.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>Web Development</span>
                                        <h4 class="title"><a href="portfolio-details.php">Banking Management System</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img06.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>Web Development</span>
                                        <h4 class="title"><a href="portfolio-details.php">Banking Management System</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img07.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>Web Development</span>
                                        <h4 class="title"><a href="portfolio-details.php">Banking Management System</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="landing" role="tabpanel" aria-labelledby="landing-tab">
                <div class="container">
                    <div class="row gx-0 justify-content-center">
                        <div class="col">
                            <div class="portfolio__active">
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img04.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>Web Development</span>
                                        <h4 class="title"><a href="portfolio-details.php">Visual Design System Management</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img01.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>Apps Design</span>
                                        <h4 class="title"><a href="portfolio-details.php">Banking Management System</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img02.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>Web Design</span>
                                        <h4 class="title"><a href="portfolio-details.php">Banking Management System</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img03.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>UX/UI Design</span>
                                        <h4 class="title"><a href="portfolio-details.php">Banking Management System</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img05.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>Web Development</span>
                                        <h4 class="title"><a href="portfolio-details.php">Banking Management System</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img06.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>Web Development</span>
                                        <h4 class="title"><a href="portfolio-details.php">Banking Management System</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img07.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>Web Development</span>
                                        <h4 class="title"><a href="portfolio-details.php">Banking Management System</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="branding" role="tabpanel" aria-labelledby="branding-tab">
                <div class="container">
                    <div class="row gx-0 justify-content-center">
                        <div class="col">
                            <div class="portfolio__active">
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img03.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>UX/UI Design</span>
                                        <h4 class="title"><a href="portfolio-details.php">Animation Management System</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img01.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>Apps Design</span>
                                        <h4 class="title"><a href="portfolio-details.php">Banking Management System</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img02.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>Web Design</span>
                                        <h4 class="title"><a href="portfolio-details.php">Banking Management System</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img04.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>Web Development</span>
                                        <h4 class="title"><a href="portfolio-details.php">Banking Management System</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img05.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>Web Development</span>
                                        <h4 class="title"><a href="portfolio-details.php">Banking Management System</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img06.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>Web Development</span>
                                        <h4 class="title"><a href="portfolio-details.php">Banking Management System</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img07.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>Web Development</span>
                                        <h4 class="title"><a href="portfolio-details.php">Banking Management System</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="graphic" role="tabpanel" aria-labelledby="graphic-tab">
                <div class="container">
                    <div class="row gx-0 justify-content-center">
                        <div class="col">
                            <div class="portfolio__active">
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img02.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>Web Design</span>
                                        <h4 class="title"><a href="portfolio-details.php">Graphic Design Management System</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img01.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>Apps Design</span>
                                        <h4 class="title"><a href="portfolio-details.php">Banking Management System</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img03.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>UX/UI Design</span>
                                        <h4 class="title"><a href="portfolio-details.php">Banking Management System</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img04.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>Web Development</span>
                                        <h4 class="title"><a href="portfolio-details.php">Banking Management System</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img05.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>Web Development</span>
                                        <h4 class="title"><a href="portfolio-details.php">Banking Management System</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img06.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>Web Development</span>
                                        <h4 class="title"><a href="portfolio-details.php">Banking Management System</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                                <div class="portfolio__item">
                                    <div class="portfolio__thumb">
                                        <img src="assets/img/portfolio/portfolio_img07.jpg" alt="">
                                    </div>
                                    <div class="portfolio__overlay__content">
                                        <span>Web Development</span>
                                        <h4 class="title"><a href="portfolio-details.php">Banking Management System</a></h4>
                                        <a href="portfolio-details.php" class="link">Case Study</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- portfolio-area-end -->

    <!-- partner-area -->
    <section class="partner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <ul class="partner__logo__wrap">
                        <li>
                            <img class="light" src="assets/img/icons/partner_light01.png" alt="">
                            <img class="dark" src="assets/img/icons/partner_01.png" alt="">
                        </li>
                        <li>
                            <img class="light" src="assets/img/icons/partner_light02.png" alt="">
                            <img class="dark" src="assets/img/icons/partner_02.png" alt="">
                        </li>
                        <li>
                            <img class="light" src="assets/img/icons/partner_light03.png" alt="">
                            <img class="dark" src="assets/img/icons/partner_03.png" alt="">
                        </li>
                        <li>
                            <img class="light" src="assets/img/icons/partner_light04.png" alt="">
                            <img class="dark" src="assets/img/icons/partner_04.png" alt="">
                        </li>
                        <li>
                            <img class="light" src="assets/img/icons/partner_light05.png" alt="">
                            <img class="dark" src="assets/img/icons/partner_05.png" alt="">
                        </li>
                        <li>
                            <img class="light" src="assets/img/icons/partner_light06.png" alt="">
                            <img class="dark" src="assets/img/icons/partner_06.png" alt="">
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <div class="partner__content">
                        <div class="section__title">
                            <span class="sub-title">05 - partners</span>
                            <h2 class="title">I proud to have collaborated with some awesome companies</h2>
                        </div>
                        <p>I'm a bit of a digital product junky. Over the years, I've used hundreds of web and mobile apps in different industries and verticals. Eventually, I decided that it would be a fun challenge to try designing and building my own.</p>
                        <a href="contact.php" class="btn">Start a conversation</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- partner-area-end -->

    <!-- testimonial-area -->
    <section class="testimonial">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-6 order-0 order-lg-2">
                    <ul class="testimonial__avatar__img">
                        <li><img src="assets/img/images/testi_img01.png" alt=""></li>
                        <li><img src="assets/img/images/testi_img02.png" alt=""></li>
                        <li><img src="assets/img/images/testi_img03.png" alt=""></li>
                        <li><img src="assets/img/images/testi_img04.png" alt=""></li>
                        <li><img src="assets/img/images/testi_img05.png" alt=""></li>
                        <li><img src="assets/img/images/testi_img06.png" alt=""></li>
                        <li><img src="assets/img/images/testi_img07.png" alt=""></li>
                    </ul>
                </div>
                <div class="col-xl-5 col-lg-6">
                    <div class="testimonial__wrap">
                        <div class="section__title">
                            <span class="sub-title">06 - Client Feedback</span>
                            <h2 class="title">Happy clients feedback</h2>
                        </div>
                        <div class="testimonial__active">
                            <div class="testimonial__item">
                                <div class="testimonial__icon">
                                    <i class="fas fa-quote-left"></i>
                                </div>
                                <div class="testimonial__content">
                                    <p>We are motivated by the satisfaction of our clients. Put your trust in us &share in our H.Spond Asset Management is made up of a team of expert, committed and experienced people with a passion for financial markets. Our goal is to achieve continuous.</p>
                                    <div class="testimonial__avatar">
                                        <span>Rasalina De Wiliamson</span>
                                    </div>
                                </div>
                            </div>
                            <div class="testimonial__item">
                                <div class="testimonial__icon">
                                    <i class="fas fa-quote-left"></i>
                                </div>
                                <div class="testimonial__content">
                                    <p>We are motivated by the satisfaction of our clients. Put your trust in us &share in our H.Spond Asset Management is made up of a team of expert, committed and experienced people with a passion for financial markets. Our goal is to achieve continuous.</p>
                                    <div class="testimonial__avatar">
                                        <span>Rasalina De Wiliamson</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial__arrow"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- testimonial-area-end -->

    <!-- blog-area -->
    <section class="blog">
        <div class="container">
            <div class="row gx-0 justify-content-center">
                <div class="col-lg-4 col-md-6 col-sm-9">
                    <div class="blog__post__item">
                        <div class="blog__post__thumb">
                            <a href="blog-details.php"><img src="assets/img/blog/blog_post_thumb01.jpg" alt=""></a>
                            <div class="blog__post__tags">
                                <a href="blog.php">Story</a>
                            </div>
                        </div>
                        <div class="blog__post__content">
                            <span class="date">13 january 2021</span>
                            <h3 class="title"><a href="blog-details.php">Facebook design is dedicated to what's new in design</a></h3>
                            <a href="blog-details.php" class="read__more">Read mORe</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-9">
                    <div class="blog__post__item">
                        <div class="blog__post__thumb">
                            <a href="blog-details.php"><img src="assets/img/blog/blog_post_thumb02.jpg" alt=""></a>
                            <div class="blog__post__tags">
                                <a href="blog.php">Social</a>
                            </div>
                        </div>
                        <div class="blog__post__content">
                            <span class="date">13 january 2021</span>
                            <h3 class="title"><a href="blog-details.php">Make communication Fast and Effectively.</a></h3>
                            <a href="blog-details.php" class="read__more">Read mORe</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-9">
                    <div class="blog__post__item">
                        <div class="blog__post__thumb">
                            <a href="blog-details.php"><img src="assets/img/blog/blog_post_thumb03.jpg" alt=""></a>
                            <div class="blog__post__tags">
                                <a href="blog.php">Work</a>
                            </div>
                        </div>
                        <div class="blog__post__content">
                            <span class="date">13 january 2021</span>
                            <h3 class="title"><a href="blog-details.php">How to increase your productivity at work - 2021</a></h3>
                            <a href="blog-details.php" class="read__more">Read mORe</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="blog__button text-center">
                <a href="blog.php" class="btn">more blog</a>
            </div>
        </div>
    </section>
    <!-- blog-area-end -->

    <!-- contact-area -->
    <section class="homeContact">
        <div class="container">
            <div class="homeContact__wrap">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="section__title">
                            <span class="sub-title">07 - Say hello</span>
                            <h2 class="title">Any questions? Feel free <br> to contact</h2>
                        </div>
                        <div class="homeContact__content">
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form</p>
                            <h2 class="mail"><a href="mailto:Info@webmail.com">Info@webmail.com</a></h2>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="homeContact__form">
                            <form id="message_form" method="post">
                                <div id="status_submit"></div>
                                <input id="name_m" name="name" type="text" placeholder="Username*">
                                <div id="name_input_error"></div>
                                <input id="email_m" name="email" type="email" placeholder="E-mail*">
                                <div id="email_input_error"></div>
                                <input id="phone_m" name="phone" type="number" placeholder="Phone number*">
                                <div id="phone_input_error"></div>
                                <textarea id="message_m" name="message" placeholder="Enter Massage*"></textarea>
                                <div id="message_input_error"></div>
                                <button type="submit">Send Message</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact-area-end -->

</main>
<!-- main-area-end -->

<script>
    let message_form = document.getElementById('message_form');

    let status_submit = document.getElementById('status_submit');

    let input_name = document.getElementById('name_m');
    let input_email = document.getElementById('email_m');
    let input_phone = document.getElementById('phone_m');
    let input_message = document.getElementById('message_m');

    let name_input_error = document.getElementById('name_input_error');
    let email_input_error = document.getElementById('email_input_error');
    let phone_input_error = document.getElementById('phone_input_error');
    let message_input_error = document.getElementById('message_input_error');


    message_form.onsubmit = function(e) {
        e.preventDefault();
        status_submit.innerHTML = '';

        let data = new FormData();
        data.append('name', input_name.value);
        data.append('email', input_email.value);
        data.append('phone', input_phone.value);
        data.append('message', input_message.value);

        // let data = {
        //     name: input_name.value,
        //     email: input_email.value,
        //     phone: input_phone.value,
        //     message: input_message.value
        // }

        // data = JSON.stringify(data);

        let xhr = new XMLHttpRequest();

        xhr.open("POST", 'functions/admin/add_message.php');

        xhr.send(data);

        xhr.onload = function() {
            if (xhr.status == 200 && xhr.readyState == 4) {
                data = JSON.parse(xhr.response);
                if (data.input_false) {
                    status_submit.innerHTML = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>input error</strong><br>${data.input_false}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;
                }
                if (data.sql) {
                    status_submit.innerHTML = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>sql error</strong><br>${data.sql}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;
                }
                if (data.success) {
                    input_name.value = '';
                    input_email.value = '';
                    input_phone.value = '';
                    input_message.value = '';

                    status_submit.innerHTML = `<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>success</strong><br>${data.success}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;
                }
                if (data.name) {
                    name_input_error.innerHTML = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>name error</strong><br>${data.name}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;
                }
                if (data.email) {
                    email_input_error.innerHTML = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>email error</strong><br>${data.email}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;
                }
                if (data.phone) {
                    phone_input_error.innerHTML = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>phone error</strong><br>${data.phone}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;
                }
                if (data.message) {
                    message_input_error.innerHTML = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>message error</strong><br>${data.message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;
                }
            } else {
                console.error(xhr.response);
            }
        }
    }
</script>

<?php
include 'includes/footer.php';
?>