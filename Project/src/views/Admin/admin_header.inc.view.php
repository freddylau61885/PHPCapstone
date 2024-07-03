<?php

use App\Lib\Utils;

$user_id = isset($_SESSION['user']['id']) ?? '';
$user_name  = isset($_SESSION['user']['name']) ?? '';
$is_admin = isset($_SESSION['user']['isadmin']) ?? '';

?>
<!doctype html>

<html lang="en">

<head>
    <title><?= Utils::esc(ADMIN_MAIN_TITLE) ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include __DIR__ . '/../../includes/admin_header_links.inc.php' ?>

    <script src=
"https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
            integrity=
"sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
            crossorigin="anonymous"></script>
    <script 
        src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js">
    </script>
    <script 
        src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js">
    </script>
    <script 
        src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js">
    </script>
    <script 
        src="https://cdn.jsdelivr.net/npm/echarts@5.4.0/dist/echarts.js">
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
        include __DIR__ . '/admin_navigation.view.php';
        include __DIR__ . '/../../includes/flash.inc.php';
