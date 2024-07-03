<?php
namespace App\Controllers;


class PageController
{
    use Traits\HomeController,
        Traits\NewsController,
        Traits\DogAdopController,
        Traits\DogDetailController,
        Traits\DogTrainController,
        Traits\AdopAnimalController,
        Traits\ContactController,
        Traits\LoginController,
        Traits\LogoutController,
        Traits\RegisterController,
        Traits\UserProfileController;
}