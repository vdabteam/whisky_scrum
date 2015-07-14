<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<form enctype="multipart/form-data" action="formtest.php" method="POST">
    Send this file: <input name="userfile" type="file" />
    <input type="submit" value="Send File" name="btn"/>
</form>
</body>
</html>



<?php

if (isset($_POST['btn']))
{
    echo "<pre>";
    print_r($_FILES);
    echo "</pre>";
}

?>