<?php
function hash_password($password, $salt) {
    $hash = hash_hmac("md5", $salt, $password);
    for ($i = 0; $i < 1000; $i++) {
        $hash = hash_hmac("md5", $hash, $password);
    }
	return $hash;
}
$pass=hash_password("9tucuSMu0J", "bLG75BvmZL");
echo $pass;
?>