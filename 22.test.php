<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <title>Document</title>
</head>
<body>
<?php
$feedback  = "1 2 3123 21321 3213 213 2132 13213";
$token = strtok($feedback, ' ');
echo "<p>".$token."</p>";
while ($token != "")
{
    $token = strtok(" ");
    echo "<p>".$token."</p>";
}
?>
</body>
</html>