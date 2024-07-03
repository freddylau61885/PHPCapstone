<?php

use App\Lib\Utils;

require __DIR__ . '/header.inc.view.php';

?>

<main id="content">

    <!--[if LTE IE 8]>
        <h1>This website is not supporting IE 8 or lower. </h1>
      <![endif]-->

    <h1><?= Utils::esc($title) ?></h1>

    <!-- use post method to submit form data -->
    <form action="http://www.scott-media.com/test/form_display.php" 
          method="post" 
          id="contact_form" 
          autocomplete="on">
        <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">
        <fieldset id="firstField" class="redBorder">
            <div>

                <!-- start of first name field -->
                <p>
                    <label for="inqFirstName">First Name: </label><br>
                    <input type="text" 
                           id="inqFirstName" 
                           name="inqFirstName" 
                           maxlength="64" 
                           size="25" 
                           placeholder="Please type your first name here" 
                           title="First Name" 
                           required>
                    <span class="req">*</span>
                </p>
                <!-- end of first name field -->

                <!-- start of last name field -->
                <p>
                    <label for="inqLastName">Last Name: </label><br>
                    <input type="text" 
                           id="inqLastName" 
                           name="inqLastName" 
                           maxlength="64" 
                           size="25" 
                           placeholder="Please type your last name here" 
                           title="Last Name" 
                           required>
                    <span class="req">*</span>
                </p>
                <!-- end of last name field -->

                <p>Gender: </p>

                <!-- start of radio options -->
                <input type="radio" 
                       name="gender" 
                       id="female" 
                       value="Female" 
                       title="Female">
                <label for="female">Female</label>

                <input type="radio" 
                       name="gender" 
                       id="male" 
                       value="Male" 
                       title="Male">
                <label for="male">Male</label>

                <input type="radio" 
                       name="gender" 
                       id="other" 
                       value="Other" 
                       title="Other">
                <label for="other">Other</label>

                <!-- start of email field -->
                <p>
                    <label for="email_address">Email: </label><br>
                    <input type="email" 
                           name="email_address" 
                           id="email_address" 
                           placeholder="Please type your email here" 
                           size="25" 
                           required>
                    <span class="req">*</span>
                </p>
                <!-- end of email field -->

                <!-- start of subtitle field -->
                <p>
                    <label for="subtitle">Subtitle: </label><br>
                    <input type="text" 
                           id="subtitle" 
                           name="subtitle" 
                           size="25" 
                           placeholder="Subtitle" 
                           title="Subtitle" 
                           required>
                    <span class="req">*</span>
                </p>
                <!-- end of subtitle field -->

                <p class="note">Note:
                    <em>
                        Fields with ( <span class="req">*</span> ) are REQUIRED
                    </em>
                </p>

                <p>
                    <label for="inquiry" class="textaLabel">
                        Inquiry: 
                    </label><br>
                    <textarea id="inquiry" 
                              name="inquiry" 
                              placeholder=
                              " Please type your inquiry here."></textarea>
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