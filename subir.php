<?php

	$nombre_imagen = $_FILES['foto']['name'];
	//echo $_FILES['foto']['name'];


	$tipo = $_FILES['foto']['type'];
	//echo $tipo;

	$tamano_imagen = $_FILES['foto']['size'];
	//echo $tamano_imagen;

	$temp = $_FILES['foto']['tmp_name'];

	//echo $temp;


	$carpeta_destino = $_SERVER['DOCUMENT_ROOT'].'/crud1/imagen/';

	//echo $carpeta_destino;

	move_uploaded_file($temp, $carpeta_destino.$nombre_imagen);

	//echo "hecho";
?>