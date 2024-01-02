

        <!-- Footer-area -->
        <footer class="footer">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-lg-4">
                        <div class="footer__widget">
                            <div class="fw-title">
                                <h5 class="sub-title">Contact us</h5>
                                <?php if ($user_bool) : ?>
                                    <h4 class="title"><?= $user['phone'] ?></h4>
                                <?php else: ?>
                                    <h4 class="title">+81383 766 284</h4>
                                <?php endif; ?>
                            </div>
                            <div class="footer__widget__text">
                                <p>There are many variations of passages of lorem ipsum
                                available but the majority have suffered alteration
                                in some form is also here.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="footer__widget">
                            <div class="fw-title">
                                <h5 class="sub-title">my address</h5>
                                <?php if ($user_bool) : ?>
                                    <h4 class="title"><?= $user['country'] ?></h4>
                                <?php else: ?>
                                    <h4 class="title">AUSTRALIA</h4>
                                <?php endif; ?>
                            </div>
                            <div class="footer__widget__address">
                                <p>Level 13, 2 Elizabeth Steereyt set <br> Melbourne, Victoria 3000</p>
                                <?php if ($user_bool) : ?>
                                    <a href="mailto:<?= $user['email'] ?>" class="mail"><?= $user['email'] ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="footer__widget">
                            <div class="fw-title">
                                <h5 class="sub-title">Follow me</h5>
                                <h4 class="title">socially connect</h4>
                            </div>
                            <div class="footer__widget__social">
                                <p>Lorem ipsum dolor sit amet enim. <br> Etiam ullamcorper.</p>
                                <ul class="footer__social__list">
                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fab fa-behance"></i></a></li>
                                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="copyright__wrap">
                    <div class="row">
                        <div class="col-12">
                            <div class="copyright__text text-center">
                                <p>Copyright @ Theme_Pure 2021 All right Reserved</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer-area-end -->




		<!-- JS here -->
        <script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/isotope.pkgd.min.js"></script>
        <script src="assets/js/imagesloaded.pkgd.min.js"></script>
        <script src="assets/js/jquery.magnific-popup.min.js"></script>
        <script src="assets/js/element-in-view.js"></script>
        <script src="assets/js/slick.min.js"></script>
        <script src="assets/js/ajax-form.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/plugins.js"></script>
        <script src="assets/js/main.js"></script>
    </body>
</html>