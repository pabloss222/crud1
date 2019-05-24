<?php
class ProductoModel
{
	private $pdo;

	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = new PDO('mysql:host=localhost:3306;dbname=acad', 'root', '');
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		        
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

public function Listar()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM producto");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$vo = new Producto();

				$vo->__SET('id', $r->id);
				$vo->__SET('descripcion', $r->descripcion);
				$vo->__SET('precio', $r->precio);
				$vo->__SET('stock', $r->stock);
				$vo->__SET('imagen', $r->imagen);

				$result[] = $vo;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

public function Obtener($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM producto WHERE id = ?");
			          

			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$vo = new Producto();

			$vo->__SET('id', $r->id);
			$vo->__SET('descripcion', $r->descripcion);
			$vo->__SET('precio', $r->precio);
			$vo->__SET('stock', $r->stock);
			$vo->__SET('imagen', $r->imagen);

			return $vo;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

public function Eliminar($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM producto WHERE id = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

public function Actualizar(Producto $data)
	{
		try 
		{
			$sql = "UPDATE producto SET 
						id          = ?, 
						descripcion        = ?,
						precio          = ?, 
						stock        = ?,
						imagen           = ?
				    WHERE id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('id'), 
					$data->__GET('descripcion'), 
					$data->__GET('precio'),
					$data->__GET('stock'), 
					$data->__GET('imagen'),
					$data->__GET('id')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Producto $data)
	{
		try 
		{
		$sql = "INSERT INTO producto (id,descripcion,precio,stock,imagen) 
		        VALUES (?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('id'), 
				$data->__GET('descripcion'), 
				$data->__GET('precio'),
				$data->__GET('stock'), 
				$data->__GET('imagen'),
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}