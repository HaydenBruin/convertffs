<?php
function GenerateCode($length = 8)
{
    // LOAD DATABASE
    require("website-database.php");
    
    // GENERATE CODE
    $code = substr(md5(uniqid(mt_rand(), true)) , 0, $length);
    
    // CHECK CODE 
    $query_code = $DBH->prepare("SELECT * FROM `ffs_pastebin` WHERE `pastebin_id` = :id");
    $query_code->execute(array('id' => $code));
	$check_code = $query_code->fetch(PDO::FETCH_ASSOC);
    
    if(!@$check_code) return GenerateCode($length);
        else return $code;
}
?>