<?php
$surname = $_POST['surname'] ?? '';
$email   = $_POST['email']   ?? '';
$password   = $_POST['password']   ?? '';
$address = $_POST['alamat_jalan'] ?? '';
$state   = $_POST['state']   ?? '-1';
$gender  = $_POST['gender']  ?? '';
$veg     = isset($_POST['sayur']);

function showError($errors, $name)
{
    if (isset($errors[$name]))
        echo '<span style="color:red; margin-left:6px;">' . htmlspecialchars($errors[$name]) . '</span>';
}
?>

<fieldset>
    <legend>Data Diri</legend>    
    <form name="form" action="prosesData_form.php" method="POST">
        <div class="field">
            <label for="surname">Surname :</label>
            <input type="text" name="surname" size="40" value = "">
        </div>
        
        <div class="field">
            <label for="email">Email Address :</label>
            <input type="email" name="email" size="40">
        </div>
        
        <div class="field">
            <label for="password">Password :</label>
            <input type="password" name="password" size="8">
        </div>

        <div class="field">
            <label for="alamat_jalan">Street Address :</label>
            <textarea name="alamat_jalan" rows="3" cols="22"></textarea>
        </div>

        <div class="field">
            <label for="state">State :</label>
            <select name="state">
                <option value="-1" selected>[Choose your state]</option>
                <option value="1" >Lamongan</option>
                <option value="2" >Gresik</option>
                <option value="3" >Mojokerto</option>
                <option value="4" >Surabaya</option>
                <option value="5" >Malang</option>
                <option value="6" >Yogyakarta</option>
                <option value="7" >Madiun</option>
                <option value="8" >Nganjuk</option>
            </select>
        </div>

        <div class="field">
            <input type="hidden" name="country" value="Australia">
        </div>

        <div class="field">
            <label for="gender">Gender :</label>
            <input type="radio" name="gender" value="Male" />Male
            <input type="radio" name="gender" value="Female"/>Female
        </div>
        
        <div class="field">
            <label for="sayur">Vegetarian?</label>
            <input type="checkbox" name="sayur">
        </div>

        <div class="field">
            <label>&nbsp;</label>
            <input type="submit" value="Submit" name="submit">
            <input type="reset" name="reset" value="Reset">
        </div>

    </fieldset>
    </form>
