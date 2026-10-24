<style>
    fieldset {
        width: 450px;
        padding: 20px;
    }
    legend {
        font-weight: bold;
        font-size: 1.1em;
    }
    .field {
        margin-bottom: 8px;
    }
    .field label:first-child {
        display: inline-block;
        width: 140px; 
        text-align: right;
        margin-right: 10px;
    }
    .tombol {
        margin-left: 155px; 
        margin-top: 10px;
    }
</style>

<fieldset>
    <legend>Person Details</legend>
    <form name="myform" action="processData.php" method="POST">
        <div class="field">
            <label for="surname">Surname</label>
            <input type="text" name="surname" size="31" value="<?php if(isset($_POST['surname'])) { echo $_POST['surname']; } ?>" />
        </div>
        <div class="field">
            <label for="email">Email address</label>
            <input type="text" name="email" size="31" value="<?php if(isset($_POST['email'])) { echo $_POST['email']; } ?>" />
        </div>
        <div class="field">
            <label for="passwd">Password</label>
            <input type="password" name="passwd" size="31" />
        </div>
        <div class="field">
            <label for="address">Street Address</label>
            <textarea name="address" rows="3" cols="22"><?php if(isset($_POST['address'])) { echo $_POST['address']; } ?></textarea>
        </div>
        <div class="field">
            <label for="state">State</label>
            <select name="state">
                <option value="-1" <?php if(isset($_POST['state']) && $_POST['state'] == '-1') { echo 'selected'; } ?>>[choose your state]</option>
                <option value="1" <?php if(isset($_POST['state']) && $_POST['state'] == '1') { echo 'selected'; } ?>>Australian Capital Territory</option>
                <option value="2" <?php if(isset($_POST['state']) && $_POST['state'] == '2') { echo 'selected'; } ?>>Queensland</option>
                <option value="3" <?php if(isset($_POST['state']) && $_POST['state'] == '3') { echo 'selected'; } ?>>Victoria</option>
            </select>
        </div>
        <div class="field">
            <input type="hidden" name="country" value="Australia">
        </div>
        <div class="field">
            <label>Gender</label>
            <input type="radio" name="sex" value="male" <?php if(isset($_POST['sex']) && $_POST['sex'] == 'male') { echo 'checked'; } ?>> Male
            <input type="radio" name="sex" value="female" <?php if(isset($_POST['sex']) && $_POST['sex'] == 'female') { echo 'checked'; } ?>> Female
        </div>
        <div class="field">
            <label for="vegetarian">Vegetarian?</label>
            <input type="checkbox" name="vegetarian" <?php if(isset($_POST['vegetarian'])) { echo 'checked'; } ?>>
        </div>
        <div class="field tombol">
            <input type="submit" value="Submit" name="submit" />
            <input type="reset" value="Reset" name="reset" />
        </div>
    </form>
</fieldset>