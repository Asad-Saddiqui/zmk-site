

<footer class="full-row mt-3  p-0" style="background-color:#f36c21">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="divider py-40">
                    <div class="row">

                        <div class="col-md-12 col-lg-12">
                            <div class="row">
                                <div class="col-md-4 col-lg-4">
                                    <div class="footer-widget mb-4">


                                        <div class="footer-logo mb-4"> <a href="index.php"><img class="logo-bottom"
                                                    src="./zmkImages/LOGO FINAL-04.png" alt="image"
                                                    style="height: 80px;" width="100%"></a> </div>

                                        <ul class="text-white">

                                            <li class="hover-text-primary"> <a class="text-white"
                                                    href="tel:<?php echo $myCompanyRow['clandline']; ?>"><i
                                                        class="fas fa-phone-alt text-white mr-2 font-13 mt-1"></i><?php echo $myCompanyRow['clandline']; ?></a>
                                            </li>
                                            <li class="hover-text-primary"> <a class="text-white"
                                                    href="https://api.whatsapp.com/send?phone=<?php echo $myCompanyRow['cphone']; ?>"><i
                                                        class="fab fa-whatsapp text-white  mr-2 font-13 mt-1"
                                                        style="font-size: large;"></i><?php echo $myCompanyRow['cphone']; ?></a>
                                            </li>
                                            <li class="hover-text-primary"><a class="text-white"
                                                    href="mailto:<?php echo $myCompanyRow['compyemail']; ?>"><i
                                                        class="fas fa-envelope text-white mr-2 font-13 mt-1"></i><?php echo $myCompanyRow['compyemail'] ?></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <div class="footer-widget footer-nav mb-4">
                                        <h4 class="widget-title text-white  position-relative">
                                            Support</h4>
                                        <ul class="hover-text-primary">
                                            <li><a href="#" class="text-white">Selling Services</a></li>
                                            <li><a href="#" class="text-white">Installment</a></li>
                                            <li><a href="#" class="text-white">Rental Service</a></li>
                                            <li><a href="contact.php" class="text-white">Contact</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <div class="footer-widget footer-nav mb-4">
                                        <h4 class="widget-title text-white  position-relative">
                                            Quick Links</h4>
                                        <ul class="hover-text-primary">
                                            <li><a href="agent.php" class="text-white">agent</a></li>
                                            <li><a href="property.php" class="text-white">Property</a></li>
                                            <li><a href="index.php" class="text-white">Projects</a></li>
                                            <li><a href="agent.php" class="text-white">Our Agents</a></li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row copyright">
            <div class="col-sm-6"> <span class="text-white">© <?php echo date('Y'); ?> ZMK Marketing Website - Developed
                    By Asad Tariq Saddiqui</span> </div>
            <div class="col-sm-6">
                <ul class="line-menu text-white hover-text-primary float-right">
                    <li><a href="https://wa.me/+923489979762">Click here to open WhatsApp</a></li>
                    <li>|</li>
                    <li><a href="https://wa.me/+923489979762"> 03489979762</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>