<style>
  body {
    font-family: arial;
  }
  legend {
    font-weight: bold;
    padding-left: 20px;
  }
  form {
    background-color: #9999ff;
    padding-top: 15px;
    padding-bottom: 15px;
  }
  .field {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin-bottom: 5px;
  }

  .field label {
    display: inline-block;
    width: 120px;
    text-align: end;
  }
</style>

<h1>Register</h1>
<legend>Person Details</legend>
<form name="myForm" action="index.php" method="POST">
  <div class="field">
    <label for="surname">Surname</label>
    <input
      type="text"
      name="surname"
      size="31"
      value="<?php echo isset($_POST['surname']) ? htmlspecialchars($_POST['surname']) : ''; ?>"
    />
  </div>
  <div class="field">
    <label for="email">Email address</label>
    <input
      type="text"
      name="email"
      size="31"
      value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"
    />
  </div>
  <div class="field">
    <label for="passwd">Password</label>
    <input type="password" name="passwd" size="31" />
  </div>
  <div class="field">
    <label for="address">Street Address</label>
    <textarea name="address" rows="3" cols="22"></textarea>
  </div>
  <div class="field">
    <label for="state">State</label>
    <select name="state">
      <option value="-1" selected>[choose your state]</option>
      <option value="1">Australian Capital Territory</option>
      <option value="2">Queensland</option>
      <option value="3">Victoria</option>
      <option value="4">New South Wales</option>
      <option value="5">Tasmania</option>
      <option value="6">South Australia</option>
      <option value="7">Western Australia</option>
      <option value="8">Northern Territory</option>
    </select>
  </div>
  <div class="field">
    <input type="hidden" name="country" value="Australia" />
  </div>
  <div class="field">
    <label for="sex">Gender</label>
    <input type="radio" name="sex" value="male" />Male
    <input type="radio" name="sex" value="female" />Female
  </div>
  <div class="field">
    <label for="vegetarian">Vegetarian?</label>
    <input type="checkbox" name="vegetarian" />
  </div>
  <div class="field">
    <label>&nbsp;</label>
    <input type="submit" value="Submit" name="submit" /><input
      type="reset"
      value="Reset"
      name="reset"
    />
  </div>
</form>
