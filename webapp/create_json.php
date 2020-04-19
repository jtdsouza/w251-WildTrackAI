<?php 
include 'common.php';

$items = mysqli_query($conn, "SELECT * FROM `wildtrackai` ORDER BY `id` DESC " );

$trackfile = array();

foreach ($items as $v) 
					{
						$row_array = array();
						$row_array = array(
							"type" => "Feature",
							"properties" => array(
							   "timeStamp" => $v['time'],
							   "deviceID" => $v['device_id'],
							   "species" => $v['species'],
							   "name" => $v['individual'],
							   "confidence" => $v['confidence_level'],
							   "sex" => "NA",
							   "iconUrl" => "../img/".$v['name']
							   
							//    "../img/".$v['name']

							//    str_replace('/mnt/wildtrack-ai/new-files/', '', $file)
							),
							"geometry" => array(
							   "type" => "Point",
							   "coordinates" => array($v['geo2'],$v['geo1'])
							)
							);

						// echo json_encode($row_array, JSON_PRETTY_PRINT);
						array_push($trackfile, $row_array);
					}

// echo json_encode($trackfile, JSON_PRETTY_PRINT);

$trackfile_json = json_encode($trackfile, JSON_PRETTY_PRINT);

$final = "var wildtracks = {
    \"type\": \"FeatureCollection\",
    \"features\": $trackfile_json
};";

// echo $final;

$file = 'web_demo_v2/trackfile.js';
file_put_contents($file, $final);

echo json_encode(array('error'=>0,'name'=>'json created'));

?>