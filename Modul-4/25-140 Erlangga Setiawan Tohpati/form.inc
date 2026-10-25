<?php
function setValue($fieldName) {
    return isset($_POST[$fieldName]) ? htmlspecialchars($_POST[$fieldName]) : '';
}
function setChecked($fieldName, $value) {
    return (isset($_POST[$fieldName]) && $_POST[$fieldName] === $value) ? 'checked' : '';
}
function setSelected($fieldName, $value) {
    return (isset($_POST[$fieldName]) && $_POST[$fieldName] == $value) ? 'selected' : '';
}
?>

<fieldset style="width: 400px;">
    <legend>Person Details</legend>
    <form name="myForm" action="index.php" method="POST">
        <div class="field">
            <label for="surname">Surname</label>
            <input type="text" name="surname" id="surname" size="31" value="<?php echo setValue('surname'); ?>" />
        </div>
        <div class="field">
            <label for="email">Email address</label>
            <input type="text" name="email" id="email" size="31" value="<?php echo setValue('email'); ?>" />
        </div>
        <div class="field">
            <label for="passwd">Password</label>
            <input type="password" name="passwd" id="passwd" size="31" />
        </div>
        <div class="field">
            <label for="address">Street Address</label>
            <textarea name="address" id="address" rows="3" cols="22"><?php echo setValue('address'); ?></textarea>
        </div>
        <div class="field">
            <label for="state">State</label>
            <select name="state" id="state">
                <option value="-1" <?php echo setSelected('state', '-1'); ?>>[choose your state]</option>
                <option value="1" <?php echo setSelected('state', '1'); ?>>Australian Capital Territory</option>
                <option value="2" <?php echo setSelected('state', '2'); ?>>Queensland</option>
                <option value="3" <?php echo setSelected('state', '3'); ?>>Victoria</option>
                <option value="4" <?php echo setSelected('state', '4'); ?>>New South Wales</option>
                <option value="5" <?php echo setSelected('state', '5'); ?>>Tasmania</option>
                <option value="6" <?php echo setSelected('state', '6'); ?>>South Australia</option>
                <option value="7" <?php echo setSelected('state', '7'); ?>>Western Australia</option>
                <option value="8" <?php echo setSelected('state', '8'); ?>>Northern Territory</option>
            </select>
        </div>
        <div class="field">
            <input type="hidden" name="country" value="Australia" />
        </div>
        <div class="field">
            <label for="sex">Gender</label>
            <input type="radio" name="sex" value="male" <?php echo setChecked('sex', 'male'); ?> />Male
            <input type="radio" name="sex" value="female" <?php echo setChecked('sex', 'female'); ?> />Female
        </div>
        <div class="field">
            <label for="vegetarian">Vegetarian?</label>
            <input type="checkbox" name="vegetarian" id="vegetarian" value="yes" <?php echo setChecked('vegetarian', 'yes'); ?> />
        </div>
        <div class="field">
            <label>&nbsp;</label>
            <input type="submit" value="Submit" name="submit" />
            <input type="reset" value="Reset" name="reset" />
        </div>
    </form>
</fieldset>