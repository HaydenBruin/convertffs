<?php
require("website-database.php");
    
    //echo "<pre>"; print_r($_REQUEST); echo "</pre>";
    //die();
if(@$_REQUEST['paste'])
{
    $code = GenerateCode();
    $check_code = $DBH->prepare("INSERT INTO `ffs_pastebin` (`pastebin_id`,`pastebin_code`,`pastebin_time`,`pastebin_text`) VALUES (null,:code,:time,:text)");
    $check_code->execute(array(
        'code' => $code,
        'time' => time(),
        'text' => $_REQUEST['paste']
    ));
    
    header("location: /p/".$code."/");
}
else header("location: /?no_data");
?>