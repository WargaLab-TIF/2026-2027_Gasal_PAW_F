<form name="myForm" action="processData_form.php" method="POST">

    <div class="field">
        <label for="surname">Nama :</label>
        <input type="text" id="surname" name="surname"
               value="<?php if (isset($_POST['surname'])) echo $_POST['surname']; ?>">
    </div>

    <div class="field">
        <label for="email">Email :</label>
        <input type="email" id="email" name="email"
               value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
    </div>

    <div class="field">
        <label for="passwd">Password :</label>
        <input type="password" id="passwd" name="passwd"
               value="<?php if (isset($_POST['passwd'])) echo $_POST['passwd']; ?>">
    </div>

    <div class="field">
        <label for="address">Alamat :</label>
        <textarea id="address" name="address" rows="3" cols="22"><?php if (isset($_POST['address'])) echo $_POST['address']; ?></textarea>
    </div>

    <div class="field">
        <label for="prodi">Program Studi :</label>
        <select id="prodi" name="prodi">
            <option value="-1" <?php if (!isset($_POST['prodi']) || $_POST['prodi'] == '-1') echo 'selected'; ?>>[pilih program studi]</option>
            <option value="1" <?php if (isset($_POST['prodi']) && $_POST['prodi'] == '1') echo 'selected'; ?>>Informatika</option>
            <option value="2" <?php if (isset($_POST['prodi']) && $_POST['prodi'] == '2') echo 'selected'; ?>>Sistem Informasi</option>
            <option value="3" <?php if (isset($_POST['prodi']) && $_POST['prodi'] == '3') echo 'selected'; ?>>Teknik Elektro</option>
            <option value="4" <?php if (isset($_POST['prodi']) && $_POST['prodi'] == '4') echo 'selected'; ?>>Mekatronika</option>
        </select>
    </div>

    <div class="field">
        <input type="hidden" name="kampus" value="UTM">
    </div>

    <div class="field">
        <label>Sesi :</label>
        <input type="radio" id="pagi" name="sesi" value="pagi"
               <?php if (isset($_POST['sesi']) && $_POST['sesi'] == 'pagi') echo 'checked'; ?>>
        <label for="pagi" style="width:auto; text-align:left; margin:0 8px 0 0;">Pagi</label>
        <input type="radio" id="siang" name="sesi" value="siang"
               <?php if (isset($_POST['sesi']) && $_POST['sesi'] == 'siang') echo 'checked'; ?>>
        <label for="siang" style="width:auto; text-align:left; margin:0;">Siang</label>
    </div>

    <div class="field">
        <label for="laptop">Bawa laptop?</label>
        <input type="checkbox" id="laptop" name="laptop"
               <?php if (isset($_POST['laptop'])) echo 'checked'; ?>>
    </div>

    <div class="field buttons">
        <input type="submit" value="Submit" name="submit">
        <input type="reset" value="Reset" name="reset">
    </div>

</form>