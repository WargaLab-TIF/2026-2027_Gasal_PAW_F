<?php
// Ambil data isian sebelumnya (jika ada) agar form tidak kosong saat error
$surname = isset($_POST['surname']) ? htmlspecialchars($_POST['surname']) : '';
$email   = isset($_POST['email'])   ? htmlspecialchars($_POST['email'])   : '';
$address = isset($_POST['address']) ? htmlspecialchars($_POST['address']) : '';
$state   = isset($_POST['state'])   ? $_POST['state'] : '-1';
$sex     = isset($_POST['sex'])     ? $_POST['sex']   : '';
$veg     = isset($_POST['vegetarian']);

$states = array(
    '-1' => '[choose your state]',
    '1' => 'Australian Capital Territory',
    '2' => 'Queensland',
    '3' => 'Victoria',
    '4' => 'New South Wales',
    '5' => 'Tasmania',
    '6' => 'South Australia',
    '7' => 'Western Australia',
    '8' => 'Northern Territory'
);
?>
<fieldset>
<legend>Person Details</legend>
<form name="myForm" action="form.php" method="POST">
  <div class="field">
    <label for="surname">Surname</label>
    <input type="text" name="surname" size="31" value="<?php echo $surname; ?>"/>
  </div>
  <div class="field">
    <label for="email">Email address</label>
    <input type="text" name="email" size="31" value="<?php echo $email; ?>"/>
  </div>
  <div class="field">
    <label for="passwd">Password</label>
    <!-- password sengaja tidak diisi ulang demi keamanan -->
    <input type="password" name="passwd" size="31"/>
  </div>
  <div class="field">
    <label for="address">Street Address</label>
    <textarea name="address" rows="3" cols="22"><?php echo $address; ?></textarea>
  </div>
  <div class="field">
    <label for="state">State</label>
    <select name="state">
      <?php foreach ($states as $val => $name): ?>
        <option value="<?php echo $val; ?>" <?php if ((string)$state === (string)$val) echo 'selected'; ?>><?php echo $name; ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="field">
    <input type="hidden" name="country" value="Australia"/>
  </div>
  <div class="field">
    <label for="sex">Gender</label>
    <input type="radio" name="sex" value="male" <?php if ($sex === 'male') echo 'checked'; ?>/>Male
    <input type="radio" name="sex" value="female" <?php if ($sex === 'female') echo 'checked'; ?>/>Female
  </div>
  <div class="field">
    <label for="vegetarian">Vegetarian?</label>
    <input type="checkbox" name="vegetarian" <?php if ($veg) echo 'checked'; ?>/>
  </div>
  <div class="field">
    <label>&nbsp;</label>
    <input type="submit" value="Submit" name="submit"/><input type="reset" value="Reset" name="reset"/>
  </div>
</form>
</fieldset>
