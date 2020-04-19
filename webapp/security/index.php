<?php 
include '../common.php';

	
if(isset($_POST) && !empty($_POST))
{
	# разбираем ajax запросы
	if(isset($_POST['test']))
	{
		$do = mysqli_query($conn, "UPDATE `wildtrackai` SET `status` = 0");
		echo json_encode(array('error'=>0,'name'=>'status changed'));
		exit();
	}
	if(isset($_POST['status']))
	{
		$do = mysqli_query($conn, "UPDATE `wildtrackai` SET `status` = '".$_POST['status']."' WHERE `id` = '".$_POST['id']."' ");
		echo json_encode(array('error'=>0,'name'=>'status changed'));
		exit();
	}
	if(isset($_POST['items']))
	{
		$items = mysqli_query($conn, "SELECT * FROM `wildtrackai` WHERE `id` NOT IN (".(!empty($_POST['ids']) ? $_POST['ids'] : '0').") and `status` = 0 ");

		$items_html = '';

		if($items->num_rows > 0)
			foreach ($items as $item)
			{
				$temperature = substr_replace($item['temperature'], ',', 2, 0);

				$items_html .= '<div class="item col-6" data-id="'.$item['id'].'" data-temperature="<?=$temperature;?>" data-name="'.$item['name'].'"><div class="photo"><img src="../img/'.$item['name'].'"></div><div class="temperature '.($item['temperature'] > 385 ? 'danger' : '').'">'.$temperature.'</div></div>';
			}

		echo json_encode(array('error'=>0,'name'=>'items fetched','items'=>$items_html));
		exit();
	}
}

# прорисовка итемов
	$items = mysqli_query($conn, "SELECT * FROM `wildtrackai` WHERE `status` = 0 ");

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

        <title>Security page</title>

        <style type="text/css">
        	body {
        		background: #434343;
        		color: white;
                font-family: 'Roboto', sans-serif !important;
        	}
        	.items-wrapper {
        		max-width: 100vw;
        	}
        	.item {
        		height: 250px;
        		overflow: hidden;
        		margin-bottom: 15px;
        		text-align: center;
        		position: relative;
        	}
        	@media screen and (max-width: 360px)
        	{
        		.item {
        			height: 200px;
        		}
        	}
        	@media screen and (min-width: 768px)
        	{
        		.item {
        			height: 400px;
        		}
        	}
            @media screen and (min-width: 1024px)
            {
                .item {
                    height: 650px;
                }
            }
        	.item .photo {
        		width: 100%;
        		height: 100%;
        		position: relative;
        	}

        	.item img {
        		object-fit: cover;
        		width: 100%;
        		height: 100%;
        		object-position: 50% 0%;
        		position: absolute;
        		left: 0;
        		right: 0;
        		top: 0;
        		bottom: 0;
        		margin: auto;
        	}

        	.col-6:nth-child(2n) {
        		padding-left: 0;
        	}
        	.temperature {
        		position: absolute;
        		bottom: 0;
        		right: 15px;
        		background-color: white;
        		padding: 5px;
        		border: 1px solid #dedede;
        		color: black;
        		font-weight: 500;
        	}
        	.temperature.danger {
        		color: red;
        		font-weight: 700;
        	}
        	#modal {
        		color: black;
        	}
        	#modal .photo {
        		width: 100%;
        		height: auto;
        	}

        	#modal .temperature {
        		bottom: 15px;
        	}
        	#modal .modal-footer {
        		display: block;
        	}
        </style>
    </head>
    <body>
	
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
		
        <a class="navbar-brand" href="javascript:void()">Preventeev Guard</a>
    </nav>

  	<div class="container pb-3">
  		<div class="items-wrapper row mt-5 pt-5">
  			<?php foreach ($items as $item) { $temperature = substr_replace($item['temperature'], ',', 2, 0); ?>
  				<div class="item col-6" data-id="<?=$item['id'];?>" data-temperature="<?=$temperature;?>" data-name="<?=$item['name'];?>">
  					<div class="photo"><img src="../img/<?=$item['name'];?>"></div>
  					<div class="temperature <?=($item['temperature'] > 385 ? 'danger' : '');?>"><?=$temperature;?></div>
  				</div>
  			<?php } ?>
  		</div>

        <button type="button" class="btn btn-light test mt-2">Reset statuses</button>
    </div>


    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    	<div class="modal-dialog modal-dialog-centered" role="document">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h5 class="modal-title" id="exampleModalLongTitle">Editing status</h5>
    				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    					<span aria-hidden="true">&times;</span>
    				</button>
    			</div>
    			<div class="modal-body">
    				<img src="" class="photo">
    				<div class="temperature"></div>
    			</div>
    			<div class="modal-footer">
    				<input type="hidden" name="id" value="">
    				<button type="button" class="btn btn-light btn-block status-update" status="1">Passed</button>
    				<button type="button" class="btn btn-light btn-block status-update" status="2">Not found</button>
    				<button type="button" class="btn btn-light btn-block status-update" status="3">Gave mask</button>
    				<button type="button" class="btn btn-light btn-block status-update" status="4">Asked to leave</button>
    				<button type="button" class="btn btn-dark btn-block" data-dismiss="modal">Close</button>
    			</div>
    		</div>
    	</div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript">
		$(document).on('click', '.item', function(){
			$('#modal input[name=id]').val($(this).attr('data-id'));
			$('#modal img.photo').attr('src', '../img/'+$(this).attr('data-name'));
			$('#modal .temperature').html($(this).attr('data-temperature'));
			$('#modal .temperature').removeClass('danger');

			if($(this).find('.temperature').hasClass('danger'))
			{
				$('#modal .temperature').addClass('danger');
			}

			$('#modal').modal('show');
		});

    	// ajax change status
    		$(document).on('click', 'button.status-update', function(){
    			if(confirm('Set status "'+$(this).html()+'"? ')) 
    			{	
    				id = $(this).closest('.modal-footer').find('input[name=id]').val();
	    			$.ajax({
						url : '',
						type: 'POST',
						data: { status:$(this).attr('status'), id:id },
						success : function(result){
							result = JSON.parse(result);
							if(result.error == 0)
							{
								$('.item[data-id='+id+']').remove();
								$('#modal').modal('hide');
							}
							else
							{
								alert('Something wrong. Can not be updated.');
							}
						}
					});
	    		}
    		});
    	// ajax upload new in timer
	    	setInterval(function() {

                $.ajax({
                    url : '../proceed_images.php',
                    type: 'POST',
                    data: { },
                    success : function(result){
                        result = JSON.parse(result);
                        if(result.error == 0)
                        {
                            console.log(result.name);
                        }
                        else
                        {
                            alert('Something wrong. Can not be updated.');
                        }
                    }
                });
				
				items_array = [];

				$('.item').each(function(){
					items_array.push($(this).attr('data-id'));
				});

				ids = items_array.toString()

	    		$.ajax({
					url : '',
					type: 'POST',
					data: { items:true, ids:ids },
					success : function(result){
						result = JSON.parse(result);
						if(result.error == 0)
						{
							$('.items-wrapper').append(result.items);
						}
						else
						{
							alert('Something wrong. Can not be updated.');
						}
					}
				});
	    	}, 5000);
	    // ajax update all statuses to 0
	    	$(document).on('click', '.test', function(){
		    	$.ajax({
		    		url : '',
		    		type: 'POST',
		    		data: { test:true },
		    		success : function(result){
		    			result = JSON.parse(result);
		    			if(result.error == 0)
		    			{
		    				alert('Statuses are 0 now');
		    			}
		    			else
		    			{
		    				alert('Something wrong. Can not be updated.');
		    			}
		    		}
		    	});
		    });
    </script>

  </body>
</html>