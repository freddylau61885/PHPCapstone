<?php

use App\Lib\Utils;

require __DIR__ . '/header.inc.view.php';

?>

<main id="content">

    <!--[if LTE IE 8]>
        <h1>This website is not supporting IE 8 or lower. </h1>
      <![endif]-->

    <!-- 1st home page content item -->
    <h1><?= Utils::esc($title) ?></h1>
    <h2>Recently images</h2>

    <!--start of slide images-->
    <div id="slideImages">

        <!--slide bullet for slide 1-->
        <input type="radio" 
               name="slide" 
               id="slide1" 
               class="slideBullet" 
               checked="checked" 
               title="Slide 1">

        <div class="slideItem">
            <img src="images/slide1.jpg" 
                 width="597" 
                 height="398" 
                 alt="Recent Images Slide 1">

            <!-- slide arrows for slide 2-->
            <label for="slide2" 
                   class="slideNav slideNavNext" 
                   title="Next Slide"></label>
        </div>
        <!--end of slide item 1-->

        <!--slide bullet for slide 2-->
        <input type="radio" 
               name="slide" 
               id="slide2" 
               class="slideBullet" 
               title="Slide 2">

        <div class="slideItem">
            <img src="images/slide2.jpg" 
                 width="597" 
                 height="399" 
                 alt="Recent Images Slide 2">
            <!-- slide arrow for slide 1 -->
            <label for="slide1" 
                   class="slideNav slideNavPre" 
                   title="Previous 1"></label>

        </div>
        <!--end of slide item 2-->

    </div>
    <!--end of slide images-->

    <!-- 2nd home page content item -->
    <h2>Who we are</h2>

    <!-- start of company info container -->
    <div class="redBorder">
        <p>
            We are an non-profit organization located in the south of Pembina.
            We were established in 2020 and are dedicated to helping abandoned 
            dogs in Winnipeg these years.
        </p>

        <h2 style="margin-top: 25px; margin-bottom: 6px;">Our Missions</h2>

        <ul>
            <li>Spreading the awareness of animal rights</li>
            <li>Helping abandoned dogs to find safe and warm families</li>
            <li>Providing professional training for dogs</li>
        </ul>

    </div>
    <!-- end of company info container -->

    <!-- 3rd home page content item -->
    <h2>Why subcribe Us</h2>
    <!-- start of subscribe box -->
    <div class="redBorder" id="subsBox">
        <p>Do you love dogs? Are you instered in animals rights?</p>
        <p>
            We often conduct some activities about dog adoption and 
            animals rights.
        </p>
        <p>
            If you are insterested in these types of activities, 
            you should subscribe to our page.
        </p>
        <p>
            After subscribed, you can receive our newsletter and the latest news
            every week.
        </p>

        <!-- include CTA button again -->
        <div>
            <label for="subscribe" 
                   class="button subscribe" 
                   title="Subscribe">Subscribe</label>
        </div>

    </div>
    <!-- end of subscribe box -->

</main>

<?php require __DIR__ . '/footer.inc.view.php'; ?>