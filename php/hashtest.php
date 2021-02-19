<?php
$testpass = 'asasdsadasdasd';
$hashpass = password_hash($testpass, PASSWORD_DEFAULT);
echo $hashpass;
?>