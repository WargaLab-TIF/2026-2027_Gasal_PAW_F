<!-- <form name="myform" action="prosesData_form.php" method="POST">
			<div class="field">
				<label for="surname">Surname</label>
				<input type="text" name="surname" size="31">
			</div>
			<div class="field">
				<label for="email">Email Address</label>
				<input type="text" name="email" size="31">
			</div>
			<div class="field">
				<label for="password">Password</label>
				<input type="text" name="password" size="31">
			</div>
			<div class="field">
				<label for="address">Street Address</label>
				<textarea type="text" name="address" rows="3" cols="22"></textarea>
			</div>
			<div class="field">
				<label for="state">State</label>
				<select name="state">
					<option value="-1" selected>[choose your state]</option>
					<option value="1">Australian Capital Territory</option>
					<option value="2">Qweersland</option>
					<option value="3">Victoria</option>
					<option value="4">New South Males</option>
					<option value="5">Tesmoris</option>
					<option value="6">South Australias</option>
					<option value="7">Mestarn Australia</option>
					<option value="8">Nothern Territory</option>
				</select>			
			</div>
			<div class="field">
				<input type="hidden" name="country" value="Australia">
			</div>
			<div class="field">
				<label for="sex">Gender</label>
				<input type="radio" name="sex" value="male">Male
				<input type="radio" name="sex" value="Female">Female
			</div>
			<div class="field">
				<label for="vegetarian">Vegetarian?</label>
				<input type="checkbox" name="vegetarian">
			</div>
			<div class="field">
				<label></label>
				<input type="submit" name="submit" value="submit">
				<input type="reset" name="reset">
			</div>
</form> -->

<form name="myform" action="prosesData_form.php" method="POST">
			<div class="field">
				<label for="surname">Surname</label>
				<input type="text" name="surname" size="31" value="<?php echo isset($_POST['surname']) ? htmlspecialchars($_POST['surname']) : ''; ?>">
			</div>
			<div class="field">
				<label for="email">Email Address</label>
				<input type="text" name="email" size="31" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
			</div>
			<div class="field">
				<label for="password">Password</label>
				<input type="text" name="password" size="31">
			</div>
			<div class="field">
				<label for="address">Street Address</label>
				<textarea name="address" rows="3" cols="22"><?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; ?></textarea>
			</div>
			<div class="field">
				<label for="state">State</label>
				<select name="state">
					<option value="-1" <?php echo (!isset($_POST['state']) || $_POST['state'] == '-1') ? 'selected' : ''; ?>>[choose your state]</option>
					<option value="1" <?php echo (isset($_POST['state']) && $_POST['state'] == '1') ? 'selected' : ''; ?>>Australian Capital Territory</option>
					<option value="2" <?php echo (isset($_POST['state']) && $_POST['state'] == '2') ? 'selected' : ''; ?>>Qweersland</option>
					<option value="3" <?php echo (isset($_POST['state']) && $_POST['state'] == '3') ? 'selected' : ''; ?>>Victoria</option>
					<option value="4" <?php echo (isset($_POST['state']) && $_POST['state'] == '4') ? 'selected' : ''; ?>>New South Males</option>
					<option value="5" <?php echo (isset($_POST['state']) && $_POST['state'] == '5') ? 'selected' : ''; ?>>Tesmoris</option>
					<option value="6" <?php echo (isset($_POST['state']) && $_POST['state'] == '6') ? 'selected' : ''; ?>>South Australias</option>
					<option value="7" <?php echo (isset($_POST['state']) && $_POST['state'] == '7') ? 'selected' : ''; ?>>Mestarn Australia</option>
					<option value="8" <?php echo (isset($_POST['state']) && $_POST['state'] == '8') ? 'selected' : ''; ?>>Nothern Territory</option>
				</select>			
			</div>
			<div class="field">
				<input type="hidden" name="country" value="Australia">
			</div>
			<div class="field">
				<label for="sex">Gender</label>
				<input type="radio" name="sex" value="male" <?php echo (isset($_POST['sex']) && $_POST['sex'] == 'male') ? 'checked' : ''; ?>>Male
				<input type="radio" name="sex" value="Female" <?php echo (isset($_POST['sex']) && $_POST['sex'] == 'Female') ? 'checked' : ''; ?>>Female
			</div>
			<div class="field">
				<label for="vegetarian">Vegetarian?</label>
				<input type="checkbox" name="vegetarian" <?php echo (isset($_POST['vegetarian'])) ? 'checked' : ''; ?>>
			</div>
			<div class="field">
				<label></label>
				<input type="submit" name="submit" value="submit">
				<input type="reset" name="reset">
			</div>
</form>