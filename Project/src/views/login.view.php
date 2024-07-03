<?php

use App\Lib\Utils;

require __DIR__ . '/header.inc.view.php';
?>

<main id="content">
    <form action="login" method="post">

        <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">

        <fieldset id="register_field" class="redBorder">

            <div class="loginPage">
                <p>
                    <label for="email">Email: </label><br>
                    <input type="text" 
                           name="email" 
                           id="email" 
                           placeholder="Email" 
                           title="Email" 
                           size="25" 
                           value="<?= Utils::esc($_POST["email"] ?? '') ?>">
                </p>
                <p>
                    <label for="password">Password: </label><br>
                    <input type="password" 
                           name="password" 
                           id="password" 
                           placeholder="Password" 
                           title="Password" 
                           size="25">
                </p>
                <p>
                    <input type="submit" value="Login" title="Login"> &nbsp;
                    
                </p>
            </div>
            <!-- end of loginPage -->
            
        </fieldset>

    </form>

</main>

<?php require __DIR__ . '/footer.inc.view.php'; ?>