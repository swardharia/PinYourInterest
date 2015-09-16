<?php
	
	function fileWrite($key, $value)
	{
		$myFile= fopen("debug.txt","w+");
		fwrite($myFile,$key.":".$value."\n");
		fclose($myFile);
	}
?>