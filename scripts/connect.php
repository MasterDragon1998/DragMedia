<?php

$connect = new Mysqli("localhost","root","","dragmedia");
if(!$connect){
	echo $connect->error;
}

?>