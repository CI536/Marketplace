<?php
$testpass = '!Tim-123456';
$hashpass = password_hash($testpass, PASSWORD_DEFAULT);
echo $hashpass;
?>