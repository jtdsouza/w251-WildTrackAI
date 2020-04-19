<?php

include '../common.php';

if(isset($_POST['remove']) && isset($_POST['id']))
{
	// $do = mysqli_query($conn, "DELETE FROM `categories` WHERE `id` = '".$_POST['id']."' ");
	// $do = mysqli_query($conn, "DELETE FROM `categories_options` WHERE `category_id` = '".$_POST['id']."' ");
	// $do = mysqli_query($conn, "UPDATE `products`
	// 							SET `category_id` = NULL
	// 							WHERE `category_id` = '".$_POST['id']."' ");

	// echo json_encode(array('error'=>0));
	// exit();
}

$items = mysqli_query($conn, "SELECT * FROM `wildtrackai` ORDER BY `id` DESC " );


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
<!--FAVICO START-->	
<link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">

<link rel="icon" type="image/png" href="../favicon.ico">

<link rel="manifest" href="manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<!--FAVICO END-->	


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <!-- datatable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

    <!-- Roboto font -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    

	<title>WildTrackAI</title>
	

	<style>
		*       {margin:0;padding:0;}
		html, 
		body    {height:100%;  width:100%; overflow:hidden;}
		table   {height:100%;  width:100%; table-layout:static; border-collapse:collapse;}
		iframe  {float:left; height:100%; width:100%;}
		.header {border-bottom:1px solid #000}
		.content {height:100%;}
	</style>

  </head>
  <body>
  
	<table>
		<tr>
			<td class="header">
				
				<nav class="navbar navbar-expand-lg navbar-light bg-light " >
					
					<img src = "../supervisor/wildtrackai-logo-dark.png" style ="height:40px;" >&nbsp;&nbsp;<a class="navbar-brand" href="javascript:void()"></a>
					<a type="" class="btn btn-dark btn-sm btn-lg" href="../supervisor/">Toggle to Dashboard</a>
				</nav>
			</td>
		</tr>
		<tr>
			<td class="content">
			<iframe src="../web_demo_v2/wildtrack.html" frameborder="0"></iframe>
			</td>
		</tr>
		</table>
 
	<!-- <iframe src="wildtrack.html" style="border: 0; width: 100%; height: 100%"></iframe> -->

	<!-- <iframe src="wildtrack.html" style="position:fixed; top:0; left:0; bottom:0; right:0; width:100%; height:100%; border:none; margin:200; padding:0; overflow:hidden; z-index:999999;"> -->



    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	
	

  </body>
</html>