<?php

use App\Lib\Utils;

require __DIR__ . '/header.inc.view.php';

?>

<main id="content">

    <!--[if LTE IE 8]>
        <h1>This website is not supporting IE 8 or lower. </h1>
      <![endif]-->

    <h1><?= Utils::esc($title) ?></h1>

    <!--start of the first new-->
    <div class="newsContainer" title="Dog Adoption Activity">
        <div class="newsImgContainer">
            <img src="images/news1.jpg" 
                 alt="Adoption activity" 
                 width="349" 
                 height="252">
        </div>
        <div class="newsTitle">
            <p>
                Save Doggie will have a dog adoption activity on 
                March 25, 2022.
            </p>
        </div>
    </div>
    <!--end of the first new-->

    <!--start of the second new-->
    <div class="newsContainer" title="Stop animal experiment">
        <div class="newsImgContainer">
            <img src="images/news2.jpg" 
                 alt="Animal Experiment" 
                 width="375" 
                 height="252">
        </div>
        <div class="newsTitle">
            <p>
                Every life is precious. Please save animals and stop using 
                animals for experiments.
            </p>
        </div>
    </div>
    <!--end of the second new-->

</main>

<?php require __DIR__ . '/footer.inc.view.php'; ?>