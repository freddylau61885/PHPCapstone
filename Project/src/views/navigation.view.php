<?php


use App\Lib\Utils;

$current_page = '<li style="background-color: #8d8d8d"> <a href="#"';
?>
<nav>
    <!-- the hanburger menu-->
    <a href="#" id="hamburgerMenu" title="Menu">
        <span id="topbar"></span>
        <span id="middlebar"></span>
        <span id="bottombar"></span>
    </a>

    <!-- main navigation-->
    <ul id="navList">
        <!-- start of home page -->
        <?php if ($title == 'Home') : ?>
            <?= Utils::raw($current_page) ?>
        <?php else : ?>
            <?= '<li> <a href="home"' ?>
        <?php endif; ?> title="Home Page">Home</a>
        </li>
        <!-- end of home page -->

        <!-- start of News page -->
        <?php if ($title == 'News') : ?>
            <?= Utils::raw($current_page) ?>
        <?php else : ?>
            <?= '<li> <a href="news"' ?>
        <?php endif; ?> title="Company News">News</a></li>
        <!-- end of News page -->

        <!-- start of training page -->
        <?php if ($title == 'Professional Trainers') : ?>
            <?= Utils::raw($current_page) ?>
        <?php else : ?>
            <?= '<li> <a href="dogtrain"' ?>
        <?php endif; ?> title="Dog Training Programs">Dog Training</a></li>
        <!-- end of training page -->

        <!-- start of adoption page -->
        <?php if ($title == 'They are waiting for you') : ?>
            <?= Utils::raw($current_page) ?>
        <?php else : ?>
            <?= '<li> <a href="dogadop"' ?>
        <?php endif; ?> title="Dogs for Adoption">Dog Adoption</a></li>
        <!-- end of adoption page -->

        <!-- start of contact page -->
        <?php if ($title == 'Inquiry Form') : ?>
            <?= Utils::raw($current_page) ?>
        <?php else : ?>
            <?= '<li> <a href="contact"' ?>
        <?php endif; ?> title="Contact Us">Contact Us</a></li>
        <!-- end of contact page -->
    </ul>
    <!--end of navigation-->

</nav>