<?php 
include 'common.php';

// foreach (glob('P:/new/*') as $file) 
foreach (glob('/mnt/wildtrack-ai/new-files/*') as $file) 
{
	$img_string = str_replace('/mnt/wildtrack-ai/new-files/', '', $file);
		
		$img_string = substr($img_string, 0, -4);
	
		// $img_string = substr("2020-04-04_20-55-33_0001_Leopard_Shakira_90_26.206336_-14.658966.png",0,-4);

		$dash_01 = strpos($img_string,"_",0);
		$dash_02 = strpos($img_string,"_",$dash_01+1);
		$dash_03 = strpos($img_string,"_",$dash_02+1);
		$dash_04 = strpos($img_string,"_",$dash_03+1);
		$dash_05 = strpos($img_string,"_",$dash_04+1);
		$dash_06 = strpos($img_string,"_",$dash_05+1);
		$dash_07 = strpos($img_string,"_",$dash_06+1);
		$datetime = DateTime::createFromFormat('Y-m-d_H-i-s', substr($img_string, 0, $dash_02));
		$datetime = $datetime->format('Y-m-d H:i:s');
		$device_id = substr($img_string, $dash_02+1, $dash_03-$dash_02-1);
		$species = substr($img_string, $dash_03+1, $dash_04-$dash_03-1);
		$individual = substr($img_string, $dash_04+1, $dash_05-$dash_04-1);
		$confidence_level = substr($img_string, $dash_05+1, $dash_06-$dash_05-1);
		$geo1 = substr($img_string, $dash_06+1, $dash_07-$dash_06-1);
		$geo2 = substr($img_string, $dash_07+1);

		// chmod($file, 0777);
		if(copy($file, 'img/'.str_replace('/mnt/wildtrack-ai/new-files/', '', $file)))
		{
			$do = mysqli_query($conn, "INSERT INTO `wildtrackai` (`name`, `device_id`, `species`, `individual`, `confidence_level`, `geo1`, `geo2`, `time`)
								VALUES ('".str_replace('/mnt/wildtrack-ai/new-files/', '', $file)."', '".$device_id."', '".$species."', '".$individual."', '".$confidence_level."','".$geo1."','".$geo2."', '".$datetime."')") or die(mysqli_error($conn));

			//rename ($file, $file.'done');
			unlink($file);
		}
		else
		{
		echo json_encode(array('error'=>1,'name'=>'file not copied'));
		}
	

}

echo json_encode(array('error'=>0,'name'=>'photo processed'));


?>