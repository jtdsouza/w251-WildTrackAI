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

<link rel="icon" type="image/png" href="favicon.ico">

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

    <style type="text/css">
    	.photo {
    		width: 100%;
    		height: auto;
    		min-width: 100px
    	}
    	body {
    		font-family: 'Roboto', sans-serif !important;
    		background: #f8f9fa;
    		color: #333333;
    	}
    	table.dataTable tbody tr {
    		background: #ffffff;
			text-align: left;
			
			
    	}
		

    	
			table.dataTable tbody td {
    		padding-left: 20px;
			border-bottom: 1px solid #eeeeee
			
			
    	}
	
	
    	table.dataTable.no-footer {
    		border-bottom: 1px solid #f8f9fa;
    	}
		
		
		table.dataTable thead tr {
		padding: 10px 18px;  !important;
		border-bottom: 1px solid #f8f9fa; !important;
		}
		
    </style>

    <title>WildTrackAI</title>
  </head>
  <body>
  
  	<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" >
        
		<img src = "wildtrackai-logo-dark.png" style ="height:40px;" >&nbsp;&nbsp;<a class="navbar-brand" href="javascript:void()"></a>
		<a type="" class="btn btn-dark btn-sm btn-lg" href="../web_demo_v2/index.php">Toggle to Mapview</a>
    </nav>
	
	<hr>
	 
 
  	<!-- <div class="container"> -->
  		<!-- <a href="/z-project/" class="btn btn-dark mb-4 mt-5">Back</a> -->

	  <!--  <h1>Supervisor</h1>-->

	    <table id="table" class="table-sm table-hover" style = "margin-top:40px; border-bottom: 1px solid #000000">
			<thead>
				<tr>
					<th width="1%">ID</th>
					<th width="5%">PHOTO</th>
					<th width="20%">TIME</th>
					<th width="5%">DEVICE</th>
					<th width="5%">SPECIES</th>
					<th width="5%">INDIVIDUAL</th>
					<th width="15%">CONFIDENCE %</th>
					
					<th width="10%">STATUS</th>
					<th width="60%">ACTION</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$badges = array(
						'0'	=>	array(
							'name'	=> 'Not processed',
							'badge'	=>	'secondary'
						),
						'1'	=>	array(
							'name'	=> 'Confirmed',
							'badge'	=>	'success'
						),
						'2'	=>	array(
							'name'	=> 'To check with FIT',
							'badge'	=>	'danger'
						),
						'3'	=>	array(
							'name'	=> 'Checked with FIT',
							'badge'	=>	'info'
						),
						'4'	=>	array(
							'name'	=> 'Partial - Unusable',
							'badge'	=>	'danger'
						)
					);
					foreach ($items as $v) 
					{
						echo '<tr>';				
						echo '<td>'.$v['id'].'</td>';
						echo '<td style="position:relative;"><img class="photo" src="../img/'.$v['name'].'"></td>';
						echo '<td>'.$v['time'].'</td>';
						echo '<td>'.$v['device_id'].'</td>';
						echo '<td>'.substr_replace($v['species'], '', 2, 0).'</td>';
						echo '<td>'.$v['individual'].'</td>';
						echo '<td>'.substr_replace($v['confidence_level'], '%', 5, 0).'</td>';
						
						echo '<td><span class="badge badge-'.$badges[$v['status']]['badge'].'">'.$badges[$v['status']]['name'].'</span></td>';
						echo '<td>';
						echo '<select class="statuses">';
							foreach ($badges as $status_id => $badge) 
							{
								echo '<option data-status="'.$status_id.'" data-id="'.$v['id'].'" '.($status_id == $v['status'] ? 'selected' : '').'><span class="badge badge-'.$badge['badge'].'">'.$badge['name'].'</span></option>';
							}
						echo '</select>';
						echo '</td>';
						echo '</tr>';
					}
				?>
			</tbody>
		</table>
	<!-- </div> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script type="text/javascript">
    	var table = $('#table').DataTable({
    		"searching": false,
			"pageLength": 20,           
			"bLengthChange": false,
			"bInfo" : false,
			"orderCellsTop" : true,
			"fixedHeader" : true,
			"language": {
				"paginate": {
					"previous": "<",
					"next": ">"
				}
			}
		});

		badges = JSON.parse('<?=json_encode($badges);?>');

		// var badges = Object.keys(badges_json).map(function(key) {
			// return [Number(key), badges_json[key]];
		// });

		console.log(badges);

		$('select.statuses').change(function() {
			select = $(this);
			status = $(this).find('option:selected').attr('data-status');
			id = $(this).find('option:selected').attr('data-id');
			$.ajax({
				url : '../security/',
				type: 'POST',
				data: { status:status, id:id },
				success : function(result){
					result = JSON.parse(result);
					if(result.error == 0)
					{
						$(select).closest('tr').find('td:nth-child(8)').html('<span class="badge badge-' + badges[status]['badge'] + '">' + badges[status]['name'] + '</span>');
					}
					else
					{
						alert('Something wrong. Can not be updated.');
					}
				}
			});
		})
    </script>
  </body>
</html>