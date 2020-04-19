<?php

include 'common.php';


$do = mysqli_query($conn, "DELETE FROM `wildtrackai`") or die(mysqli_error($conn));


?>