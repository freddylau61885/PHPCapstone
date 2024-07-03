<?php

use App\Lib\Utils;

require __DIR__ . '/admin_header.inc.view.php';
?>

<main id="content">

    <!--[if LTE IE 8]>
        <h1>This website is not supporting IE 8 or lower. </h1>
      <![endif]-->

    <h1><?= Utils::esc($title) ?></h1>
    <div class="add_search_container">
        <?php if($page == 'aniinfo') :?>
            <a href="/add_edit"
            class="add_new">           
                Add New                    
            </a>
        <?php endif ;?>
        <!-- Start of search box -->
        <form>
            <input type="text" name="s">
            <button id="searchdogs">
                <img width="16" height="15"
                alt="Search icon"  
                src="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAPCAYAAAD
                    tc08vAAAA3ElEQVQokZ2TMQrCQBBFnwGxUUzhEbxCajsrvYOdIF7DK3gBjxA
                    VVOy09CYGRCsRVEZmYRgSV/ww7GT/5yc7+YtDH9gAV1Mb3Y8iB15fKi8zqOk
                    q5ED7CzAHHkAdmACpcktg6E0y89aVEQfI89poMm9wUqKInHGrOtE3LBGcZxG
                    DqdG2w2YC3LQ/Rwxauor+aQ0C0YkYNI1RYolfZ1Co7uhn4P+CR6r7wt+BruX
                    LcrAHDtr7HMjZF8Co7BNjSZRYh15yUYqqu9DT4dlAVZqESYfysCYy0L+w++Q
                    Bxm9llFALpxShFwAAAABJRU5ErkJggg=="
                >
            </button>
        </form>
    </div>
    <!-- End of search box -->
    <table id="admin_table" class="table table-striped">
        <!-- Start of table header -->
        <thead>
            <tr>
                <?php if ($data) : ?>
                    <!-- loop all $key as table header -->
                    <?php foreach ($data[0] as $key => $value) : ?>
                        <!-- ignore following keys -->
                        <?php if (
                            $key == 'is_active' ||
                            $key == 'description'                             
                        ) continue; ?>
                        <th><?= 
                            Utils::esc(ucfirst(str_replace("_", " ", $key))) 
                            ?>
                        </th>
                    <?php endforeach; ?>
                    
                    <!-- show action column for primary table -->
                    <?php if($page == 'aniinfo') :?>
                        <th>Actions</th>
                    <?php endif ;?>

                <?php else : ?>
                    <!-- if no data show no record -->
                    <th>No Record Found</th>
                <?php endif; ?>
            </tr>
        </thead>
        <!-- End of table header -->
        <tbody>
            <?php foreach ($data as $record) : ?>
                <tr>
                    <!-- show all records -->
                    <?php foreach ($record as $key => $value) : ?>
                        <!-- ignore following keys -->
                        <?php if (
                            $key == 'is_active' ||
                            $key == 'description'                             
                        ) continue; ?>
                        <!-- Change value from tinyint to string -->
                        <?php if (
                            $key == 'dewormed' ||
                            $key == 'defleaed' ||
                            $key == 'has_chip' ||
                            $key == 'neutered' ||
                            $key == 'subscribe_to_newsletter' ||
                            $key == 'is_admin'
                        ) {
                            $value = $value ? "Yes" : "No";
                        }  ?>
                        <td><?= Utils::esc($value ?? '') ?></td>
                    <?php endforeach; ?>

                    <?php if($page == 'aniinfo') :?>
                    <td>
                        <?php
                        if (isset($record['id'])) {
                            $id = $record['id'];
                        } elseif (isset($record['ani_id']) && 
                                  isset($record['vac_id'])) {
                            $id = "{$record['ani_id']}, {$record['vac_id']}";
                        } elseif (isset($record['adoption_id'])) {
                            $id = $record['adoption_id'];
                        } elseif (isset($record['img_id'])) {
                            $id = $record['img_id'];
                        } elseif (isset($record['ani_id'])) {
                            $id = $record['ani_id'];
                        } elseif (isset($record['vac_id'])) {
                            $id = $record['vac_id'];
                        }
                        ?>                            
                            <a href="/add_edit?id=<?= Utils::esc($id ?? '') ?>"
                               class="edit">
                            Edit                              
                            </a>
                            <form action="/delete_rec" method="post">
                                <input type="hidden" 
                                       name="csrf" 
                                       value="<?= $_SESSION['csrf'] ?>" >
                                <input type="hidden" 
                                       name ="id" 
                                       value="<?= Utils::esc($id ?? '') ?>">
                                <button class="delete">Delete</button>
                            </form>
                        </td>
                    <?php endif ;?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <!-- end of animal info table -->

</main>

<?php require __DIR__ . '/admin_footer.inc.view.php'; ?>