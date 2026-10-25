<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<style>
    fieldset {
            background-color: #d8dbe9;
            border: 2px solid #8c95c2;
            padding: 15px;
            width: 800px;
        }
</style>
<body>
    <h2>Register</h2>
    <fieldset>
        <legend>Person Details</legend>
        <form name="myform" action="processData_form.php" method="POST">
            <table>
                <tr>
                    <td><label for="surname">Surname</label></td>
                    <td><input type="text" name="surname" id="surname" size="31" /></td>
                </tr>
                <tr>
                    <td><label for="email">Email address</label></td>
                    <td><input type="text" name="email" id="email" size="31" /></td>
                </tr>
                <tr>
                    <td><label for="passwd">Password</label></td>
                    <td><input type="password" name="passwd" id="passwd" size="31" /></td>
                </tr>
                <tr>
                    <td><label for="address">Street Address</label></td>
                    <td><textarea name="address" id="address" rows="3" cols="22"></textarea></td>
                </tr>
                <tr>
                    <td><label for="state">State</label></td>
                    <td>
                        <select name="state" id="state">
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
                    </td>
                </tr>
                <tr>
                    <td><label for="sex">Gender</label></td>
                    <td>
                        <input type="radio" name="sex" value="male" id="male" /><label for="male">Male</label>
                        <input type="radio" name="sex" value="female" id="female" /><label for="female">Female</label>
                    </td>
                </tr>
                <tr>
                    <td><label for="vegetarian">Vegetarian?</label></td>
                    <td><input type="checkbox" name="vegetarian" id="vegetarian" /></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <input type="submit" value="Submit" name="submit" />
                        <input type="reset" value="Reset" name="reset" />
                    </td>
                </tr>
            </table>
            <input type="hidden" name="country" value="Australia" />
        </form>
    </fieldset>
</body>
</html>
