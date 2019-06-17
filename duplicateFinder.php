<?php
set_time_limit(99999);
ini_set("max_execution_time",99999);
/**
 * Class to find all duplicate files in a directory and its sub-directories by using file_mp5() method
 *@version 1.0
 */
 
class duplicateFinder {
	/**
	 *Function to file all the duplicate files in a directory and its sub-directories
	 *
	 *
	 *
	 *@param string $dirName
	 *
	 *@access public
	 *@return resource
	 */
	public function findDuplicateFile($dirName){
		$dirName=trim($dirName);
		if(empty($dirName)){ die("Fatal Error 0x01: Directory Name can NOT be empty"); }
		if(!is_dir($dirName)){ die("Fatal Error 0x02: $dir is not a valid or readable Directory"); }
		$filesArray=$this->parseDirectory($dirName);		
		$c=count($filesArray);
		for($i=0;$i<$c;$i++){
			$md5FilesArray[$i]=md5_file($filesArray[$i]);
		}
		$duplicateFilesArray=array();		
		$duplicateFiles=array_count_values($md5FilesArray);
		foreach($duplicateFiles as $key=>$value){
			if($value!==1){
				$names=array_keys($md5FilesArray, $key);
				$duplicate=array();
				foreach($names as $name){
					$duplicate[]=$filesArray[$name];
				}
				$duplicateFilesArray[]=$duplicate;
			}
		}
		return $duplicateFilesArray;
	}	
	
	/**
	 *This function return all the files and directories in the source directory
	 *
	 *
	 *
	 *@param string $rootPath
	 *@param boolean $returnOnlyFiles
	 *@param string $seperator
	 *@access public
	 *@return array $fileArray
	 */
	public function parseDirectory($rootPath,$returnOnlyFiles=true, $seperator="/"){
		$fileArray=array();
		if (($handle = opendir($rootPath))!==false) {
			while( ($file = readdir($handle))!==false) {
				if($file !='.' && $file !='..'){
					if (is_dir($rootPath.$seperator.$file)){
						$array=$this->parseDirectory($rootPath.$seperator.$file);
						$fileArray=array_merge($array,$fileArray);
						if($returnOnlyFiles!==true){
							$fileArray[]=$rootPath.$seperator.$file;
						}
					}
					else {
						$fileArray[]=$rootPath.$seperator.$file;
					}
				}
			}
		}
		return $fileArray;
	}
	
	
}
