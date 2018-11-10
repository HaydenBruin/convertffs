<?php
require("website-database.php");
    
if(@$_REQUEST['id'])
{   
    $paste_query = $DBH->prepare("SELECT * FROM `ffs_pastebin` WHERE `pastebin_code` = :id LIMIT 1");
    $paste_query->execute(array('id' => $_REQUEST['id']));
	$paste = $paste_query->fetch(PDO::FETCH_ASSOC);
    
    if(@$paste)
    {
        echo "Viewing Paste: ".$paste['pastebin_code']."<br>";
        echo "<textarea style='height: 500px; width: 100%;' readonly>".$paste['pastebin_text']."</textarea>";
    }
    else header("location: /?exists=false");
}
else header("location: /?exists=false");
?>