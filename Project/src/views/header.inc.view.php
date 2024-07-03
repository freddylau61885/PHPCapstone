<?php

use App\Lib\Utils;

$user_id = isset($_SESSION['user']['id']) ?? '';
$user_name  = isset($_SESSION['user']['name']) ?? '';
$is_admin = isset($_SESSION['user']['isadmin']) ?? '';

?>
<!doctype html>

<html lang="en">

<head>
    <title><?= Utils::esc(MAIN_TITLE) ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include __DIR__ . '/../includes/header_links.inc.php' ?>

    <script 
        src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    >
    </script>



    <style>
        /*class for all red border content*/
        .redBorder {
            border: 2px solid #de717b;
            margin-top: 17px;
            padding: 27px;
            font-weight: 700;
        }
    </style>

</head>

<body>

    <div id="wrapper">

        <header>
            <!-- start of logo div -->
            <div id="logo">
                <a href="home" title="Home Page">

                    <!--icon gradient background-->
                    <div id="iconBackground" class="bark"></div>

                    <!--icon svg only have rotate animation in home page-->
                    <img id='logoIcon' class="bark" src='images/logo.svg'>
                    <!--end of icon svg-->
                    <!--end of icon part-->

                    <!--icon slogin-->
                    <img id='logoSlogin' src='images/slogin.svg'>
                    <!--end of slogin svg-->

                </a>
                <!--end of icon link-->

            </div>
            <!-- end of logo div -->

            <!-- start of right header container -->
            <div id="headerRight">
                <!-- start of call to action container -->
                <div id="ctas">
                    <input type="checkbox" 
                           id="subscribe" 
                           class="disableCheckbox">
                    <label for="subscribe" 
                           class="button subscribe" 
                           title="Subscribe">Subscribe</label>

                    <label for="subscribe" 
                           id="subOverlay" 
                           class="modalBackground"></label>
                    <?php include __DIR__ . '/subscribe_modal.view.php' ?>

                    <input type="checkbox" id="donate" class="disableCheckbox">
                    <label for="donate" 
                           class="button donate" 
                           title="Donate">Donate</label>

                    <?php include __DIR__ . '/donate_modal.view.php' ?>

                </div>
                <!-- end of call to action container -->

                <!-- start of login and search container -->
                <div id="loginAndSearch">
                    <!-- start of the login button -->
                    <?php if (!$user_id) : ?>
                        <label title="Login">
                            <a href="login">
                                <span>login</span>
                                <!-- start of the login icon -->
                                <img src='images/loginicon.svg'>
                                <!-- end of the login icon -->
                            </a>
                        </label>
                        &nbsp; / &nbsp;
                        <label title="Register">
                            <a href="register">
                                <span>Register</span>
                                <img src='images/registericon.svg'>
                            </a>
                        </label>
                    <?php else : ?>
                        <label title="Logout">
                            <a href="logout">
                                <span>logout</span>
                                <img src='images/logouticon.svg'>
                            </a>
                        </label>
                        &nbsp; / &nbsp;
                        <label title="User Profile">
                            <a href="user_profile">
                                <span>profile</span>
                                <img src='images/profileicon.svg'>
                            </a>
                        </label>
                    <?php endif; ?>

                    <!-- end of the login button -->                    

                </div>
                <!-- end of login and search container -->
            </div>
            <!-- end of right header container -->
        </header>
        <?php
        include __DIR__ . '/navigation.view.php';
        include __DIR__ . '/../includes/flash.inc.php';
