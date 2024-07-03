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
    <ul id="adminNavList">
        <!-- start of dashboard page -->
        <?php if ($title == 'Dashboard') : ?>
            <?= Utils::raw($current_page) ?>
        <?php else : ?>
            <?= '<li> <a href="admin"' ?>
        <?php endif; ?> title="Dashboard">Home</a>
        </li>
        <!-- end of dashboard page -->

        <!-- start of animal information page -->
        <?php if ($title == 'Animal Information') : ?>
            <?= Utils::raw($current_page) ?>
        <?php else : ?>
            <?= '<li> <a href="aniinfo"' ?>
        <?php endif; ?> title="Animal Information">Animal Information</a></li>
        <!-- end of animal information page -->

        <!-- start of adoption page -->
        <?php if ($title == 'Adoptions') : ?>
            <?= Utils::raw($current_page) ?>
        <?php else : ?>
            <?= '<li> <a href="adopt"' ?>
        <?php endif; ?> title="Adoptions">Adoptions</a></li>
        <!-- end of adoption page -->

        <!-- start of users page -->
        <?php if ($title == 'Users') : ?>
            <?= Utils::raw($current_page) ?>
        <?php else : ?>
            <?= '<li> <a href="users"' ?>
        <?php endif; ?> title="Users">Users</a></li>
        <!-- end of users page -->

        <!-- start of animal vaccines page -->
        <?php if ($title == "Animal Vaccines") : ?>
            <?= Utils::raw($current_page) ?>
        <?php else : ?>
            <?= '<li> <a href="anivac"' ?>
        <?php endif; ?> title="Animal Vaccines">Vaccines</a></li>
        <!-- end of animal vaccines page -->

        <!-- start of comments page -->
        <?php if ($title == 'Comments') : ?>
            <?= Utils::raw($current_page) ?>
        <?php else : ?>
            <?= '<li> <a href="comments"' ?>
        <?php endif; ?> title="Comments">Comments</a></li>
        <!-- end of comments page -->

    </ul>
    <!--end of navigation-->

</nav>