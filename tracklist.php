<?php
$no = 1;
$dir = __DIR__;
require("duplicateFinder.php");
$obj = new duplicateFinder();
$duplicateFile = $obj->findDuplicateFile($dir);
$c=count($duplicateFile);
if($c === 0){
    echo "no data";
}else{ 
    foreach($duplicateFile as $duplicate){
        $c=count($duplicate);       
        for($i=0;$i<$c;$i++) {
            $pathFinder=$duplicate[$i];
            echo $no++." : ".$pathFinder."<br>";

        }
    }
}