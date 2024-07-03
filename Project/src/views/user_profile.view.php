<?php

use App\Lib\Utils;

require __DIR__ . '/header.inc.view.php';

?>

<main id="content">

    <!--[if LTE IE 8]>
      <h1>This website is not supporting IE 8 or lower. </h1>
    <![endif]-->
    <h1><?= Utils::esc($title) ?></h1>
    <p><?= Utils::esc($first_p) ?></p>
    <div id="user_info_container">
        <div>
            <table id="user_profile">
                <!-- show user information -->
                <?php foreach ($user as $key => $value) : ?>
                    <tr>
                        <th>
                            <?= 
                            Utils::esc(ucwords(str_replace('_', ' ', $key))) 
                            ?>:
                        </th>
                        <?php if ($key == 'subscribe_to_newsletter') : ?>
                            <td>
                                <?= Utils::esc($value == 1 ? 'Yes' : 'No') ?>
                            </td>
                        <?php else : ?>
                            <td><?= Utils::esc($value) ?></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <!-- end of user information div -->

        <div id="showComments">
            <h2>Comments</h2>
            <?php foreach ($comments as $comment) : ?>
                <!--start of comment container-->
                <div>
                    <div class="comment_head">
                        <div><?= Utils::esc($comment['created_at']) ?></div>
                    </div>

                    <div class="comment_content">
                        <?= Utils::esc($comment['comments']) ?>
                    </div>

                </div>
                <!--end of comment container-->
            <?php endforeach; ?>
        </div>
        <!-- end of showComments-->
    </div>
    <!-- end of user_info_container -->
    <br>
    <hr>
    <div id="user_adoptions">
        <table id="adoption_records">
            <tr>
                <th>Adoption ID</th>
                <th>Animal ID</th>
                <th>Animal Name</th>
                <th>Approximately Monthly Expense</th>
                <th>Dewormed</th>
                <th>Defleaed</th>
                <th>Requirements</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
            <!-- show user adoption records -->
            <?php foreach ($adoptions as $record) : ?>
                <tr>
                    <td>
                        <?= Utils::esc($record['adoption_id']) ?>
                    </td>
                    <td>
                        <?= Utils::esc($record['ani_id']) ?>
                    </td>
                    <td>
                        <?= Utils::esc($record['name']) ?>
                    </td>
                    <td>
                        <?= Utils::esc($record['apprx_monthly_fee']) ?>
                    </td>
                    <td>
                        <?= Utils::esc($record['dewormed'] ? 'Yes' : 'No') ?>
                    </td>
                    <td>
                        <?= Utils::esc($record['defleaed'] ? 'Yes' : 'No') ?>
                    </td>
                    <td>
                        <?= Utils::esc($record['requirements'] ?? 'N/A') ?>
                    </td>
                    <td>
                        <?= Utils::esc($record['status']) ?>
                    </td>
                    <td>
                        <?= Utils::esc($record['created_at']) ?>
                    </td>
                    <td>
                        <?= Utils::esc($record['updated_at']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>

        </table>
        
    </div>
    <!-- end of user_adoptions -->

</main>

<?php require __DIR__ . '/footer.inc.view.php'; ?>