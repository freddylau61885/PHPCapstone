<?php
namespace App\Controllers\Admin;

class AdminController
{
    use Traits\DashboardController;
    use Traits\AnimalInformationController;
    use Traits\AdoptionsController;
    use Traits\AniVacInfoController;
    use Traits\CommentsController;
    use Traits\ImagesController;
    use Traits\VaccinesController;
    use Traits\UserController;
    use Traits\AddEditRecordController;
    use Traits\DeleteImageController;
    use Traits\DeleteRecordController;
    use Traits\GetChartDataController;
}