<?php

use App\Lib\Utils;

require __DIR__ . '/header.inc.view.php';

?>

<main id="content">

    <!--[if LTE IE 8]>
        <h1>This website is not supporting IE 8 or lower. </h1>
      <![endif]-->

    <h1><?= Utils::esc($title) ?></h1>

    <table id="trainer_table">

        <!-- Start of table header -->
        <tr>
            <th>Name</th>
            <th>Qualifications</th>
        </tr>
        <!-- End of table header -->

        <!-- Start of first trainer -->
        <tr>

            <td>Brad McMillan</td>
            <!-- Start of qualification column -->
            <td>

                <!-- Start of qualifications list -->
                <ul>
                    <li>Certified Professional Dog Trainer (CTDI-KA)</li>
                    <li>Certified Fear-Free Trainer</li>
                    <li>Certified in Pet First aid</li>
                    <li>15 years dog training experience</li>
                    <li>NVQ Level 5 Diploma in Applied Animal Behaviour</li>
                </ul>
                <!-- End of qualifications list -->

            </td>
            <!-- End of qualification column -->
        </tr>
        <!-- End of first trainer -->

        <!-- Start of second trainer -->
        <tr>

            <td>Joanna Perez</td>
            <!-- Start of qualification column -->
            <td>

                <!-- Start of qualifications list -->
                <ul>
                    <li>Certified Professional Dog Trainer (CPDT-KA)</li>
                    <li>Certified in Pet First aid</li>
                    <li>6 years dog training experience</li>
                    <li>NVQ Level 4 Diploma in Applied Animal Behaviour</li>
                </ul>
                <!-- End of qualifications list -->

            </td>
            <!-- End of qualification column -->
        </tr>
        <!-- End of second trainer -->

        <!-- Start of third trainer -->
        <tr>

            <td>Sally Wilson</td>
            <!-- Start of qualification column -->
            <td>

                <!-- Start of qualifications list -->
                <ul>
                    <li>Certified Professional Dog Trainer (CTDI-KA)</li>
                    <li>Certified Fear-Free Trainer</li>
                    <li>10 years dog training experience</li>
                    <li>Certified in Pet First aid</li>
                </ul>
                <!-- End of qualifications list -->

            </td>
            <!-- End of qualification column -->
        </tr>
        <!-- End of third trainer -->

    </table>
    <!-- end of trainers' table -->

    <h2>What will they learn</h2>

    <div class="redBorder">
        <p>
            Your puppy will have the chance to play with other dogs and 
            establish relationship with each other. Some dogs may be resistant 
            to playing with others. They may feel uncomfortable when other dogs 
            approach them. In this course, trainers will help your puppy to 
            create the right concept to socialize with other dogs. Also, 
            trainers will help your dog to establish a basic manner in the 
            class.
        </p>
        <div id="trainImgContainer">

            <img src="images/dog_train1.jpg" 
                 width="100" 
                 height="100" 
                 alt="A sitting dog">

            <img src="images/dog_train2.jpg" 
                 width="100" 
                 height="100" 
                 alt="Dog try to jump through circle">

            <img src="images/dog_train3.jpg" 
                 width="100" 
                 height="100" 
                 alt="Dogs playing">

        </div>
    </div>

    <h2>How to apply</h2>
    <div class="redBorder">
        <p>
            We apologize that the website does not support online booking 
            currently. Please visit our office to book the training course.
        </p>
    </div>

</main>

<?php require __DIR__ . '/footer.inc.view.php'; ?>