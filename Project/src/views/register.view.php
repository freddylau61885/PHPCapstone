<?php

use App\Lib\Utils;

require __DIR__ . '/header.inc.view.php';

?>

<main id="content">

    <!--[if LTE IE 8]>
        <h1>This website is not supporting IE 8 or lower. </h1>
      <![endif]-->

    <h1><?= Utils::esc($title) ?></h1>

    <form action="register" method="post" id="register_form" novalidate>
        <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">
        <fieldset id="register_field" class="redBorder">
            <div>

                <!-- start of first name field -->
                <p>
                    <label for="first_name">First Name: </label><br>
                    <input type="text" 
                           id="first_name" 
                           name="first_name" 
                           maxlength="64" 
                           size="25" 
                           placeholder="Please type your first name here" 
                           title="First Name" 
                           value=
                            "<?= Utils::esc($_POST["first_name"] ?? '') ?>"
                            >
                    <span class="req">
                        * <?= $errors['first_name'][0] ?? '' ?>
                    </span>
                </p>
                <!-- end of first name field -->

                <!-- start of last name field -->
                <p>
                    <label for="last_name">Last Name: </label><br>
                    <input type="text" 
                           id="last_name" 
                           name="last_name" 
                           maxlength="64" 
                           size="25" 
                           placeholder="Please type your last name here" 
                           title="Last Name" 
                           value="<?= Utils::esc($_POST["last_name"] ?? '') ?>">
                    <span class="req">
                        * <?= $errors['last_name'][0] ?? '' ?>
                    </span>
                </p>
                <!-- end of last name field -->

                <!-- start of street field -->
                <p>
                    <label for="street">Street: </label><br>
                    <input type="text" 
                           id="street" 
                           name="street" 
                           maxlength="64" 
                           size="25" 
                           placeholder="Street" 
                           title="Street" 
                           value="<?= Utils::esc($_POST["street"] ?? '') ?>">
                    <span class="req">
                        * <?= $errors['street'][0] ?? '' ?>
                    </span>
                </p>
                <!-- end of street field -->

                <!-- start of city field -->
                <p>
                    <label for="city">City: </label><br>
                    <input type="text" 
                           id="city" 
                           name="city" 
                           maxlength="64" 
                           size="25" 
                           placeholder="City" 
                           title="City" 
                           value="<?= Utils::esc($_POST["city"] ?? '') ?>">
                    <span class="req">
                        * <?= $errors['city'][0] ?? '' ?>
                    </span>
                </p>
                <!-- end of city field -->

                <!-- start of postal code field -->
                <p>
                    <label for="postal_code">
                        Postal Code (without whitespace): 
                    </label>
                    <br>
                    <input type="text" 
                           id="postal_code" 
                           name="postal_code" 
                           maxlength="10" 
                           size="25" 
                           placeholder="Postal Code" 
                           title="Postal Code" 
                           value=
                            "<?= Utils::esc($_POST["postal_code"] ?? '') ?>"
                            >
                    <span class="req">
                        * <?= $errors['postal_code'][0] ?? '' ?>
                    </span>
                </p>
                <!-- end of postal code field -->

                <!-- start of province field -->
                <p>
                    <label for="province">Province: </label><br>
                    <input type="text" 
                           id="province" 
                           name="province" 
                           maxlength="64" 
                           size="25" 
                           placeholder="Province" 
                           title="Province" 
                           value="<?= Utils::esc($_POST["province"] ?? '') ?>">
                    <span class="req">
                        * <?= $errors['province'][0] ?? '' ?>
                    </span>
                </p>
                <!-- end of province field -->

                <!-- start of country field -->
                <p>
                    <label for="country">Country: </label><br>
                    <input type="text" 
                           id="country" 
                           name="country" 
                           maxlength="64" 
                           size="25" 
                           placeholder="Country" 
                           title="Country" 
                           value="<?= Utils::esc($_POST["country"] ?? '') ?>">
                    <span class="req">
                        * <?= $errors['country'][0] ?? '' ?>
                    </span>
                </p>
                <!-- end of country field -->

                <!-- start of phone field -->
                <p>
                    <label for="phone">Phone: </label><br>
                    <input type="text" 
                           id="phone" 
                           name="phone" 
                           maxlength="64" 
                           size="25" 
                           placeholder="Phone" 
                           title="Phone" 
                           value="<?= Utils::esc($_POST["phone"] ?? '') ?>">
                    <span class="req">
                        * <?= $errors['phone'][0] ?? '' ?>
                    </span>
                </p>
                <!-- end of phone field -->

                <!-- start of email field -->
                <p>
                    <label for="email">Email: </label><br>
                    <input type="text" 
                           name="email" 
                           id="email" 
                           size="25" 
                           placeholder="Please type your email here" 
                           title="Email" 
                           value="<?= Utils::esc($_POST["email"] ?? '') ?>">
                    <span class="req">
                        * <?= $errors['email'][0] ?? '' ?>
                    </span>
                </p>
                <!-- end of email field -->

                <!-- start of login id field -->
                <p>
                    <label for="login_id">Login Id: </label><br>
                    <input type="text" 
                           name="login_id" 
                           id="login_id" 
                           size="25" 
                           placeholder="Login Id" 
                           title="Login Id" 
                           value="<?= Utils::esc($_POST["login_id"] ?? '') ?>">
                    <span class="req">
                        * <?= $errors['login_id'][0] ?? '' ?>
                    </span>
                </p>
                <!-- end of login id field -->

                <!-- start of password field -->
                <p>
                    <label for="password">
                        Password (At least 8 characters; At least 1 uppercase, 
                        1 lowercase, 1 number, and 1 puncuation):
                    </label><br>
                    <input type="password" 
                           name="password" 
                           id="password" 
                           size="25" 
                           placeholder="Password" 
                           title="Password">
                    <span class="req">
                        * <?= $errors['password'][0] ?? '' ?>
                    </span>
                </p>
                <!-- end of password field -->

                <!-- start of confirm password field -->
                <p>
                    <label for="confirm_password">Confirm Password: </label><br>
                    <input type="password" 
                           name="confirm_password" 
                           id="confirm_password" 
                           size="25" 
                           placeholder="Re-enter Password" 
                           title="Confirm Password">
                    <span class="req">
                        * <?= $errors['confirm_password'][0] ?? '' ?>
                    </span>
                </p>
                <!-- end of password field -->

                <p>
                    <input 
                        <?= isset($_POST['subscribe_to_newsletter']) ? 
                        'checked' : '' 
                        ?> 
                        type="checkbox" 
                        name="subscribe_to_newsletter" 
                        value="true"
                    > &nbsp Subscribe to our newsletter
                </p>

                <p class="note">Note:
                    <em>
                        Fields with ( <span class="req">*</span> ) are REQUIRED
                    </em>
                </p>
                <!-- end of first fieldset div -->
            </div>
        </fieldset>
        <!--end of fieldset-->

        <p>
            <input type="submit" title="Submit Form" value="Submit">
            <input type="reset" title="Reset Form" value="Reset">
        </p>

    </form>
    <!--end of form-->
</main>

<?php require __DIR__ . '/footer.inc.view.php'; ?>