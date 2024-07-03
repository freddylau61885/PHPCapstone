<?php

use App\Lib\Utils;

require __DIR__ . '/header.inc.view.php';
?>
<!-- Every dog image is from 
https://www.petfinder.com/search/dogs-for-adoption/ca/manitoba/winnipeg/ -->
<main id="content">

    <!--[if LTE IE 8]>
        <h1>This website is not supporting IE 8 or lower. </h1>
      <![endif]-->

    <h1><?= Utils::esc($title) ?></h1>
    <div id="dogFilterAndSearch">

        <!-- breed filter selectbox -->
        <div>
            <label for="breeds"><strong>Breeds</strong>:</label>
            <select name="breeds" id="breeds">
                <option value="" label="breeds"></option>
                <?php foreach ($breeds as $breed) : ?>
                    <option value=
                            "<?= Utils::esc($breed['breed']) ?>" 
                            <?= //sticky value
                            $get['b'] == $breed['breed'] ? 
                            'selected' : '' ?> 
                            label="<?= Utils::esc($breed['breed']) ?>">
                        <?= Utils::esc($breed['breed']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <!-- end of breed filter selectbox -->

        <!-- age filter selectbox -->
        <div>
            <label for="ages"><strong>Age</strong>:</label>
            <select name="ages" id="ages">
                <option value="" label="age"></option>
                <?php foreach ($ages as $age) : ?>
                    <option value=
                            "<?= Utils::esc(strval($age['age'])) ?>" 
                            <?= //sticky value
                            $get['a'] == $age['age'] ? 'selected' : '' ?> 
                            label="<?= Utils::esc(strval($age['age'])) ?>">
                        <?= Utils::esc($age['age']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <!-- end of age filter selectbox -->

        <!-- gender filter selectbox -->
        <div>
            <label for="gender"><strong>Gender</strong>:</label>
            <select name="gender" id="gender">
                <option value="" label="gender"></option>
                <option value="M" 
                        <?= //sticky value
                        $get['g'] == 'M' ? 'selected' : '' ?> 
                        label="M">M</option>
                <option value="F" 
                        <?= //sticky value
                        $get['g'] == 'F' ? 'selected' : '' ?> 
                        label="F">F</option>
            </select>
        </div>
        <!-- end of gender filter selectbox -->

        <!-- Start of search box -->
        <form action="/dogadop">
            <input type="text" name="s">
            <button id="searchdogs">
                <img width="16" 
                     height="15" 
                     src="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAPC
                        AYAAADtc08vAAAA3ElEQVQokZ2TMQrCQBBFnwGxUUzhEbxCajsrvYOdI
                        F7DK3gBjxAVVOy09CYGRCsRVEZmYRgSV/ww7GT/5yc7+YtDH9gAV1Mb3
                        Y8iB15fKi8zqOkq5ED7CzAHHkAdmACpcktg6E0y89aVEQfI89poMm9wU
                        qKInHGrOtE3LBGcZxGDqdG2w2YC3LQ/Rwxauor+aQ0C0YkYNI1RYolfZ
                        1Co7uhn4P+CR6r7wt+BruXLcrAHDtr7HMjZF8Co7BNjSZRYh15yUYqqu
                        9DT4dlAVZqESYfysCYy0L+w++QBxm9llFALpxShFwAAAABJRU5ErkJgg
                        g==" 
                    alt="Search icon">
            </button>
        </form>
        <!-- End of search box -->
    </div>

    <div class="dogsContainer">
        <?php foreach ($dogs as $dog) : ?>
            <!--start of dog container-->
            <div class="dogAdopContainer">
                <!-- animal block  -->
                <a href=
                "/dogdetails?id=<?= Utils::esc($dog['ani_id']) ?>" 
                   title="Detail" 
                   rel="nooperner">
                    <!--start of thumbnail-->
                    <div class="dogAdopImgContainer">
                        <img src=
                            "images/dogs/<?= Utils::esc($dog['thumbnail_path']) 
                                            ?? '' ?>" 
                             alt="<?= Utils::esc($dog['name']) ?>" 
                             width="245" 
                             height="202">
                    </div>
                    <!--end of thumbnail-->

                    <!--start of information-->
                    <div class="dogAdopInfo">
                        <p>
                            <strong>Name</strong>: 
                                <?= Utils::esc($dog['name']) ?>
                        </p>
                        <p>
                            <strong>Age</strong>: 
                                <?= Utils::esc($dog['age']) ?> year-old
                        </p>
                        <p>
                            <strong>Gender</strong>: 
                                <?= ucfirst(Utils::esc($dog['gender'])) ?>
                        </p>
                        <p>
                            <strong>Breed</strong>: 
                                <?= ucfirst(Utils::esc($dog['breed'])) ?>
                        </p>
                        <p>
                            <strong>DOB (Approx)</strong>: <br>
                                <?= Utils::esc($dog['dob']) ?>
                        </p>
                    </div>
                    <!--end of information-->
                </a>
            </div>
            <!--end of dog container-->
        <?php endforeach; ?>
    </div>


</main>

<?php require __DIR__ . '/footer.inc.view.php'; ?>