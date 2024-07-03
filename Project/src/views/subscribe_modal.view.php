<!-- start of subscribe button -->
<div id="subModal">
    <div class="modalHeader">
        <!-- close button -->
        <label for="subscribe" title="close">
            <img width="16" 
                 height="16" 
                 alt="close button" 
                 src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAM
                    AAAAoLQ9TAAAAdVBMVEUAAABNTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1
                    NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1
                    NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU1NTU0N3NI
                    OAAAAJnRSTlMAAQIDBAUGBwgRFRYZGiEjQ3l7hYaqtLm8vsDFx87a4uvv8fP
                    1+bbY9ZEAAAB8SURBVBhXXY5LFoJAAMOCIP4VBRXEv5j7H9HFDOizu2TRFlj
                    edgCQHeocWHVaAWStXnKyl2oVWI+kd1XLvFV1D7Ng3qrWKYMZ+MdEhk3gbhw
                    59KvlH0eTnf2mgiRwvQ7NW6aqNmncukKhnvo/zzlQ2PR/HgsAJkncH6XwAcr
                    0FUY5BVeFAAAAAElFTkSuQmCC"
                 >
        </label>
    </div>
    <!-- end of modal header -->

    <!-- start of modal content -->
    <div class="modalContent">
        <form action="http://www.scott-media.com/test/form_display.php" 
              method="post">
            <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">
            <p>
                <label for="firstName">First Name: </label><br>
                <input type="text" 
                       id="firstName" 
                       name="firstName" 
                       maxlength="64" 
                       size="25" 
                       placeholder="First Name" 
                       required 
                       title="First Name">
            </p>
            <p>
                <label for="lastName">Last Name: </label><br>
                <input type="text" 
                       id="lastName" 
                       name="lastName" 
                       maxlength="64" 
                       size="25" 
                       placeholder="Last Name" 
                       required 
                       title="Last Name">
            </p>
            <p>
                <label for="emailAddress">Email: </label><br>
                <input type="email" 
                       name="emailAddress" 
                       id="emailAddress" 
                       placeholder="Email" 
                       size="25" 
                       required 
                       title="Email">
            </p>
            <p>
                <input type="submit" value="Subscribe" title="Subscribe"> &nbsp;
            </p>
        </form>
    </div>
    <!-- end of modal content -->

</div>
<!-- end of subscribe button -->