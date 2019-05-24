
<?php 

	$usuario=$_POST['usuario'];
	$clave=$_POST['clave'];
	$pdo;

	// coneccion con la base da datos
		try
		{
			$pdo = new PDO('mysql:host=localhost:3306;dbname=acad', 'root', '');
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		        
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
		try 
		{
			$stm = $pdo
			          ->prepare("SELECT * FROM user WHERE usuario = '$usuario' and clave = '$clave'");
			          

			$stm->execute();
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$us = $r->usuario;
			$ca = $r->clave;

			if ($usuario == $us and $clave == $clave){
				header("location:Primera_Ventana.php");
			}

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}


?>
