<!DOCTYPE html>
<html>
<body>
<?php
session_start();
session_unset();
session_destroy();
?>
<form action = "check_download.php" method="post">
    <p>Current user status:</p>
    <select id="user" name="user">
        <option value="nonmember">Non Member</option>
        <option value="member">Member</option>
    </select>
    <br>
        <input type="submit" name="dlbtn" class="button" value="Download" />
</form>
<br><br>


</body>
</html>