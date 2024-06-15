<?php
class Autores extends Database
{
	public $id_autor;
	public $nombre;
	public $apellido;
	public $nacionalidad;
	public $fechaNacimiento;
	public $profilePic;

	public function __construct($id_autor)
	{
		$data = Autores::GetAuthorById($id_autor);
		foreach ($data as $autor) {
			$this->id_autor = $autor['id_autor'];
			$this->nombre = $autor['nombre'];
			$this->apellido = $autor['apellido'];
			$this->nacionalidad = $autor['nacionalidad'];
			$this->fechaNacimiento = $autor['fechaNacimiento'];
			$this->profilePic = $autor['profilePic'];
		}
	}

	public static function GetAllAutores()
	{
		$mbd = new Database();
		$ads = $mbd->prepare("SELECT * FROM autores");
		$ads->execute();
		$uInfo = $ads->fetchAll();
		return $uInfo;
	}

	public static function GetAuthorById($id)
	{
		$mbd = new Database();
		$ads = $mbd->prepare("SELECT * FROM autores WHERE id_autor = :id");
		$ads->bindParam(':id', $id, PDO::PARAM_STR);
		$ads->execute();
		$uInfo = $ads->fetchAll();
		return $uInfo;
	}

	public static function GetIdAutor($id)
	{
		$mbd = new Database();
		$ads = $mbd->prepare("SELECT id_autor FROM tiene_autor WHERE id_multimedia = :id");
		$ads->bindParam(':id', $id, PDO::PARAM_STR);
		$ads->execute();
		$uInfo = $ads->fetchAll();
		return $uInfo;
	}

	public static function DeleteAutor($autorId)
	{
		$pdo = new Database();
		$query = $pdo->prepare("DELETE FROM autores WHERE id_autor = :id");
		$query->bindParam(':id', $autorId, PDO::PARAM_STR);
		$query->execute();
		return true;
		$pdo = new Database();
		$query = $pdo->prepare("DELETE FROM tiene_autor WHERE id_autor = :id");
		$query->bindParam(':id', $autorId, PDO::PARAM_STR);
		$query->execute();
		return true;
	}


	public static function UpdateAutorDetails($id, $nombreAutor, $apeAutor, $nacionAutor, $fechaNAutor, $fotoAutor)
	{
		$mbd = new Database();
		$ads = $mbd->prepare("UPDATE autores SET nombre=:nombre, apellido=:ape, nacionalidad=:nacionalidad, fechaNacimiento=:nac, profilePic=:pf WHERE id_autor = :id");
		$ads->bindParam(':id', $id, PDO::PARAM_STR);
		$ads->bindParam(':nombre', $nombreAutor, PDO::PARAM_STR);
		$ads->bindParam(':ape', $apeAutor, PDO::PARAM_STR);
		$ads->bindParam(':nacionalidad', $nacionAutor, PDO::PARAM_STR);
		$ads->bindParam(':nac', $fechaNAutor, PDO::PARAM_STR);
		$ads->bindParam(':pf', $fotoAutor, PDO::PARAM_STR);
		$ads->execute();
		$uInfo = $ads->fetchAll();
		return $uInfo;
	}

	public static function AddNewAutor($nombreAutor, $apeAutor, $nacionAutor, $fechaNAutor)
	{
		$mbd = new Database();
		$mbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query = $mbd->prepare("INSERT INTO autores (nombre, apellido, nacionalidad, fechaNacimiento) VALUES (:nP,:aP,:cP,:caP)");
		$query->bindParam(":nP", $nombreAutor);
		$query->bindParam(":aP", $apeAutor);
		$query->bindParam(":cP", $nacionAutor);
		$query->bindParam(":caP", $fechaNAutor);
		$query->execute();
		return true;
	}
}
