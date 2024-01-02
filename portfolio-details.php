<?php
ob_start();
include 'includes/header.php';

if (!$user_bool || !isset($_GET['work_id']) || $_GET['work_id'] == '') {
    header('location: index.php');
    exit;
} else {
    $query = "SELECT * FROM work WHERE id = '{$_GET['work_id']}'";
    $query = mysqli_query($conn, $query);
    if (mysqli_num_rows($query) != 1) {
        header('location: index.php');
        exit;
    } else {
        $work = mysqli_fetch_assoc($query);
    }
}

?>
<!-- main-area -->
<main>

    <!-- breadcrumb-area -->
    <section class="breadcrumb__wrap">
        <div class="container custom-container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8 col-md-10">
                    <div class="breadcrumb__wrap__content">
                        <h2 class="title">Case Details</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Details</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumb__wrap__icon">
            <ul>
                <li><img src="assets/img/icons/breadcrumb_icon01.png" alt=""></li>
                <li><img src="assets/img/icons/breadcrumb_icon02.png" alt=""></li>
                <li><img src="assets/img/icons/breadcrumb_icon03.png" alt=""></li>
                <li><img src="assets/img/icons/breadcrumb_icon04.png" alt=""></li>
                <li><img src="assets/img/icons/breadcrumb_icon05.png" alt=""></li>
                <li><img src="assets/img/icons/breadcrumb_icon06.png" alt=""></li>
            </ul>
        </div>
    </section>
    <!-- breadcrumb-area-end -->
<?php

?>
    <!-- portfolio-details-area -->
    <section class="services__details">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="services__details__thumb">
                        <img src="files_users/<?= $user['email'] ?>/work/<?= $work['image'] ?>" alt="">
                    </div>
                    <div class="services__details__content">
                        <h2 class="title"><?= $work['title'] ?></h2>
                        <p><?= $work['description'] ?></p>
<!--                        <ul class="services__details__list">-->
<!--                            <li>Achieving effectiveness,</li>-->
<!--                            <li>Perceiving and utilizing opportunities,</li>-->
<!--                            <li>Mobilising resources,</li>-->
<!--                            <li>Securing an advantageous position,</li>-->
<!--                            <li>Meeting challenges and threats,</li>-->
<!--                            <li>Directing efforts and behaviour and</li>-->
<!--                            <li>Gaining command over the situation.</li>-->
<!--                        </ul>-->
<!--                        <div class="services__details__img">-->
<!--                            <div class="row">-->
<!--                                <div class="col-sm-6">-->
<!--                                    <img src="assets/img/images/services_details02.jpg" alt="">-->
<!--                                </div>-->
<!--                                <div class="col-sm-6">-->
<!--                                    <img src="assets/img/images/services_details03.jpg" alt="">-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <h2 class="small-title">Nature of Business Strategy</h2>-->
<!--                        <p>A business strategy is a combination of proactive actions on the part of management, for the purpose of enhancing the company’s market position and overall performance and reactions to unexpected developments and new market.</p>-->
<!--                        <p>The maximum part of the company’s present strategy is a result of formerly initiated actions and business approaches, but when market conditions take an unanticipated turn, the company requires a strategic reaction to cope with contingencies. Hence, for unforeseen development, a part of the business strategy is formulated as a reasoned response nature of business strategy.</p>-->
                    </div>
                </div>
                <div class="col-lg-4">
                    <aside class="services__sidebar">
                        <div class="widget">
                            <h5 class="title">Get in Touch</h5>
                            <form action="#" class="sidebar__contact">
                                <input type="text" placeholder="Enter name*">
                                <input type="email" placeholder="Enter your mail*">
                                <textarea name="message" id="message" placeholder="Massage*"></textarea>
                                <button type="submit" class="btn">send massage</button>
                            </form>
                        </div>
                        <div class="widget">
                            <h5 class="title">Project Information</h5>
                            <ul class="sidebar__contact__info">
                                <li><span>Date :</span> <?= $work['date'] ?></li>
                                <li><span>Location :</span> <?= $work['location'] ?></li>
                                <li><span>Client :</span> <?= $work['client_name'] ?></li>
                                <li class="cagegory"><span>Category :</span>
                                    <a href="portfolio.php">Photo,</a>
                                    <a href="portfolio.php">UI/UX</a>
                                </li>
                                <li><span>Project Link :</span> <a href="<?= $work['project_link'] ?>"><?= $work['project_link'] ?></a></li>
                            </ul>
                        </div>
                        <div class="widget">
                            <h5 class="title">Contact Information</h5>
                            <ul class="sidebar__contact__info">
                                <li><span>City :</span> <?= $user['city'] ?> </li>
                                <li><span>Address :</span> <?= $user['address_1'] ?> </li>
                                <?= $user['address_2'] == '' ?: '<li><span>Address 2 :</span> ' . $user['address_2'] . '</li>' ?>
                                <li><span>Mail :</span> <?= $user['email'] ?></li>
                                <li><span>Phone :</span> <?= $user['phone'] ?></li>
                            </ul>
<!--                            <ul class="sidebar__contact__social">-->
<!--                                <li><a href="#"><i class="fab fa-dribbble"></i></a></li>-->
<!--                                <li><a href="#"><i class="fab fa-behance"></i></a></li>-->
<!--                                <li><a href="#"><i class="fab fa-linkedin"></i></a></li>-->
<!--                                <li><a href="#"><i class="fab fa-pinterest"></i></a></li>-->
<!--                                <li><a href="#"><i class="fab fa-facebook"></i></a></li>-->
<!--                                <li><a href="#"><i class="fab fa-youtube"></i></a></li>-->
<!--                            </ul>-->
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>
    <!-- portfolio-details-area-end -->


    <!-- contact-area -->
    <section class="homeContact homeContact__style__two">
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
                            <form action="#">
                                <input type="text" placeholder="Enter name*">
                                <input type="email" placeholder="Enter mail*">
                                <input type="number" placeholder="Enter number*">
                                <textarea name="message" placeholder="Enter Massage*"></textarea>
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


<?php
include 'includes/footer.php';
ob_end_flush();
