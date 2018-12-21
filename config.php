<?php
$hashfile = 'hash.txt';
if (file_exists($hashfile)) {
    //echo "The file $hashfile exists";
    $hashfile = fopen($hashfile, "r") or die("Unable to open file!");
    $hashed_password = fgets($hashfile);
    fclose($hashfile);
}

//echo password_hash("Sumon1996#$$", PASSWORD_DEFAULT);

?>
