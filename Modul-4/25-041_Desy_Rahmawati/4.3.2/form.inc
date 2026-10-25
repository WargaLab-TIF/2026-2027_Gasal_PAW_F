
<h1>Register</h1>
<fieldset style="background-color: #DBEA;">
<form action="processData.php" method="POST">

    <label>Surname:</label>
    <input type="text" name="surname"
        value="<?= htmlspecialchars($_POST['surname'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
    <br><br>

    <label>Email:</label>
    <input type="email" name="email"
        value="<?= htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
    <br><br>

    <label>Password:</label>
    <input type="password" name="passwd">
    <br><br>

    <label>Address:</label>
    <textarea name="address"><?= htmlspecialchars($_POST['address'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
    <br><br>

    <label>State:</label>
    <select name="state">
        <option value="">Select State</option>
        <option value="NSW" <?= (($_POST['state'] ?? '') == 'NSW') ? 'selected' : '' ?>>NSW</option>
        <option value="VIC" <?= (($_POST['state'] ?? '') == 'VIC') ? 'selected' : '' ?>>VIC</option>
        <option value="QLD" <?= (($_POST['state'] ?? '') == 'QLD') ? 'selected' : '' ?>>QLD</option>
    </select>
    <br><br>

    <input type="hidden" name="country" value="Australia">

    <label>Gender:</label>
    <input type="radio" name="gender" value="Male"
        <?= (($_POST['gender'] ?? '') == 'Male') ? 'checked' : '' ?>> Male

    <input type="radio" name="gender" value="Female"
        <?= (($_POST['gender'] ?? '') == 'Female') ? 'checked' : '' ?>> Female
    <br><br>

    <input type="checkbox" name="vegetarian" value="Yes"
        <?= isset($_POST['vegetarian']) ? 'checked' : '' ?>>
    Vegetarian
    <br><br>

    <input type="submit" value="Submit">
    <input type="reset" value="Reset">

</form>
</fieldset>