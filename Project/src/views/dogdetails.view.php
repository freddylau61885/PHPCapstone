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

    <!-- images slide -->
    <div id="DogDetailSlides" class="dogSlidesContent dogSlidesSection">
        <?php foreach($imgs as $img) :?>
            <img class="imgSlides" 
                src="images/dogs/<?=Utils::esc($img['img_path'])?>">              
        <?php endforeach ;?>    
    </div>
    <!-- end of images slide -->

    <form action="/dogdetails?id=<?=Utils::esc($dog_view_array['ID'])?>" 
          method="post">
        
        <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>" >
        
        <fieldset id="dog_detail_field" class="redBorder">
            <div class="dogDetailContainer">
                <ul>
                    <?php foreach($dog_view_array as $key => $value) :?>
                    <!--start of dog container-->
                        <li>
                            <strong><?=Utils::esc($key)?></strong>: <?=$value?>
                        </li>
                    <!--end of dog container-->  
                    <?php endforeach ;?>      
                </ul>
            </div>
            <!-- end of dogDetailContainer -->

            <br><hr>
            <div id="showComments">
                <h2>Users Comments</h2>
                <?php foreach($comments as $comment) :?>
                    <!--start of comment container-->
                        <div>
                            <div class="comment_head">
                                <div>
                                    <?=Utils::esc($comment['login_id'])?>
                                </div>
                                <div>
                                    <?=Utils::esc($comment['created_at'])?>
                                </div>
                            </div>
                            <div class="comment_content">
                                <?=Utils::esc($comment['comments'])?>
                            </div>
                        </div>
                    <!--end of comment container-->  
                <?php endforeach ;?>
            </div>
            <!-- end of showComments -->

            <!-- show comment textarea and button if user logged in -->
            <?php if(isset($_SESSION['user'])) : ?>
                <div id="leaveComment">
                    <h2>Leave Your Comment</h2>
                    <textarea name="comment" 
                             id="comment" 
                             cols="60" 
                             rows="15"></textarea>
                    <p>
                        <input type="submit" 
                               title="Submit Comment" 
                               value="Submit" >
                    </p>
                </div>
            <?php else : ?>
                <p>Please login to leave comments.</p>
            <?php endif ; ?>

        </fieldset>
    </form>
    <!-- end of animal information form -->

    <!-- show adopt button if user logged in -->
    <?php if(isset($_SESSION['user'])) : ?>
        <div id="adopButtonContainer">
            <button id="adopButton" >Adoption</button>
        </div>
    <?php endif ; ?>
    

</main>

<?php require __DIR__ . '/footer.inc.view.php';?>