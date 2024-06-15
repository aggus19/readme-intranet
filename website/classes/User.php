<?php

include_once 'IP.php';

class User extends Database
{
	public $id;
	public $username;
	public $password;
	public $nombre;
	public $apellido;
	public $correo;
	public $celular;
	public $creditos;
	public $createdAt;
	public $lastLogin;
	public $ip;
	public $grade;
	public $profile_pic;
	public $localidad;
	public $verified;

	public function __construct($id)
	{
		$data = User::GetUserById($id);
		foreach ($data as $user) {
			$this->id = $id;
			$this->username = $user['username'];
			$this->password = $user['password'];
			$this->nombre = $user['nombre'];
			$this->apellido = $user['apellido'];
			$this->correo = $user['correo'];
			$this->celular = $user['celular'];
			$this->creditos = $user['creditos'];
			$this->createdAt = $user['createdAt'];
			$this->lastLogin = $user['lastLogin'];
			$this->ip = $user['ip'];
			$this->perms_level = $user['perms_level'];
			$this->profile_pic = $user['profile_pic'];
			$this->localidad = $user['localidad'];
			$this->verified = $user['verified'];
		}
	}

	public static function GetUserById($id)
	{
		$mbd = new Database();
		$ads = $mbd->prepare("SELECT * FROM users_accounts WHERE id = :id");
		$ads->bindParam(':id', $id, PDO::PARAM_STR);
		$ads->execute();
		$uInfo = $ads->fetchAll();
		return $uInfo;
	}

	public static function GetUserRecoveryPassword($email)
	{
		$mbd = new Database();
		$ads = $mbd->prepare("SELECT * FROM users_passwords_reset WHERE email = :email ORDER BY id DESC LIMIT 1");
		$ads->bindParam(':email', $email, PDO::PARAM_STR);
		$ads->execute();
		$uInfo = $ads->fetchAll();
		return $uInfo[0];
	}

	public static function SetHeaderDisplayRank($id)
	{
		$mbd = new Database();
		$ads = $mbd->prepare("SELECT * FROM users_accounts WHERE id = :id");
		$ads->bindParam(':id', $id, PDO::PARAM_STR);
		$ads->execute();
		$uInfo = $ads->fetchAll();
		if ($uInfo[0]['perms_level'] == "0") {
			echo "<span class='badge badge-secondary text-warning fw-bolder'> Visitante </span>";
		} elseif ($uInfo[0]['perms_level'] == "1") {
			echo "<span class='badge badge-secondary text-warning fw-bolder'> Usuario </span>";
		} elseif ($uInfo[0]['perms_level'] == "2") {
			echo '<span class="badge badge-secondary text-warning fw-bolder"> Administrador </span>';
		} elseif ($uInfo[0]['perms_level'] == "3") {
			echo '<span class="badge badge-secondary text-warning fw-bolder"> Bibliotecologo </span>';
		} elseif ($uInfo[0]['perms_level'] == "4") {
			echo '<span class="badge badge-secondary text-warning fw-bolder"> Developer </span>';
		} else {
			echo "<span class='badge badge-light-danger fw-bolder'> No definido </span>";
		}
	}

	public static function GetRankFromUser($id)
	{
		$mbd = new Database();
		$ads = $mbd->prepare("SELECT * FROM users_accounts WHERE id = :id");
		$ads->bindParam(':id', $id, PDO::PARAM_STR);
		$ads->execute();
		$uInfo = $ads->fetchAll();
		if ($uInfo[0]['perms_level'] == "0") { // Visitante
			return '<span class="text-info fw-bolder fs-7 py-1"> <code> <i class="text-white fs-7 bi bi-person-fill"> </i> Visitante</code> </span>';
		} elseif ($uInfo[0]['perms_level'] == "1") { // Usuario
			return '<span class="text-info fw-bolder fs-7 py-1"> <code> <i class="text-white fs-7 bi bi-shield-lock"> </i> Usuario</code> </span>';
		} elseif ($uInfo[0]['perms_level'] == "2") { // Admin
			return '<span class="text-info fw-bolder fs-7 py-1"> <code> <i class="text-white fs-7 bi bi-hammer"> </i> Administrador</code> </span>';
		} elseif ($uInfo[0]['perms_level'] == "3") { // Bibliotecologo
			return '<span class="text-info fw-bolder fs-7 py-1"> <code> <i class="text-white fs-7 fa-solid fa-book"> </i> Bibliotecologo</code> </span>';
		} elseif ($uInfo[0]['perms_level'] == "4") { // Developer
			return '<span class="text-info fw-bolder fs-7 py-1"> <code> <i class="text-white fs-7 fa fa-terminal"> </i> Developer</code> </span>';
		} else { // No definido
			return '<span class="badge badge-secondary text-secondary fw-bolder fs-8 px-2 py-1 ms-2"> Sin definir </span>';
		}
		return $uInfo;
	}

	public static function GetUserByUsername($name)
	{
		$mbd = new Database();
		$ads = $mbd->prepare("SELECT * FROM users_accounts WHERE username = :un");
		$ads->bindParam(':un', $name, PDO::PARAM_STR);
		$ads->execute();
		$uInfo = $ads->fetchAll();
		return $uInfo;
	}

	public static function DeleteUser($userId)
	{
		$pdo = new Database();
		$query = $pdo->prepare("DELETE FROM users_accounts WHERE id = :id");
		$query->bindParam(':id', $userId, PDO::PARAM_STR);
		$query->execute();
		return true;
	}

	public static function GetUserLevelPerms($staff)
	{
		$pdo = new Database();
		$query = $pdo->prepare("SELECT perms_level FROM users_accounts WHERE id = :staff");
		$query->bindParam(':staff', $staff, PDO::PARAM_STR);
		$query->execute();
		$uInfo = $query->fetchAll();
		return $uInfo[0]['perms_level'];
	}

	public static function GetUserByUsernameAndPassword($username, $password)
	{
		$mbd = new Database();
		$ads = $mbd->prepare("SELECT * from users_accounts WHERE username = :u AND password = :p OR correo = :u");
		$ads->bindParam(':u', $username, PDO::PARAM_STR);
		$ads->bindParam(':p', $password, PDO::PARAM_STR);
		$ads->execute();
		$uInfo = $ads->fetchAll();
		return $uInfo;
	}

	public static function GetUsersCount()
	{
		$mbd = new Database();
		$ads = $mbd->prepare("SELECT * FROM users_accounts");
		$ads->execute();
		return $ads->rowCount();
	}

	public static function GetAdminsCount()
	{
		$mbd = new Database();
		$ads = $mbd->prepare("SELECT * FROM users_accounts WHERE perms_level = '2' OR perms_level = '4'");
		$ads->execute();
		return $ads->rowCount();
	}

	public static function GetAllUsers()
	{
		$mbd = new Database();
		$ads = $mbd->prepare("SELECT * FROM users_accounts ORDER BY id ASC");
		$ads->execute();
		$uInfo = $ads->fetchAll();
		return $uInfo;
	}

	public static function UpdateProfilePic($foto)
	{
		// Cargar la imagen en el servidor y borrar la anterior
		$pdo = new Database();
		$query = $pdo->prepare("UPDATE users_accounts SET profile_pic = :foto WHERE id = :id");
		$query->bindParam(':foto', $foto, PDO::PARAM_STR);
		$query->bindParam(':id', $_SESSION['id'], PDO::PARAM_STR);
		$query->execute();
	}

	public static function UpdatePassword($pass, $correo)
	{
		$pdo = new Database();
		$query = $pdo->prepare("UPDATE users_accounts SET password = :pass WHERE correo = :correo");
		$query->bindParam(':pass', $pass, PDO::PARAM_STR);
		$query->bindParam(':correo', $correo, PDO::PARAM_STR);
		$query->execute();
		return true;
	}

	public static function UpdateProfileDetails($nombre, $apellido, $correo, $celular, $idUsuario, $contrasenia)
	{
		$mbd = new Database();
		$ads = $mbd->prepare("UPDATE users_accounts	SET nombre = :n, apellido = :ap, correo = :co, celular = :ce, password = :pw WHERE id = :idU");
		$ads->bindParam(':n', $nombre, PDO::PARAM_STR);
		$ads->bindParam(':ap', $apellido, PDO::PARAM_STR);
		$ads->bindParam(':co', $correo, PDO::PARAM_STR);
		$ads->bindParam(':ce', $celular, PDO::PARAM_STR);
		$ads->bindParam(':idU', $idUsuario, PDO::PARAM_STR);
		$ads->bindParam(':pw', $contrasenia, PDO::PARAM_STR);
		$ads->execute();
		return true;
	}

	public static function CheckEmail($correo)
	{
		$mbd = new Database();
		$ads = $mbd->prepare("SELECT * FROM users_accounts WHERE correo = :correo");
		$ads->bindParam(':correo', $correo, PDO::PARAM_STR);
		$ads->execute();
		$uInfo = $ads->fetchAll();
		return $uInfo;
	}

	public static function InsertNewRecovery($correo, $stringPass, $encrypted)
	{
		$mbd = new Database();
		$ads = $mbd->prepare("INSERT INTO users_passwords_reset (email, newPass, encrypted, date) VALUES (:correo, :stringPass, :encrypted, NOW())");
		$ads->bindParam(':correo', $correo, PDO::PARAM_STR);
		$ads->bindParam(':stringPass', $stringPass, PDO::PARAM_STR);
		$ads->bindParam(':encrypted', $encrypted, PDO::PARAM_STR);
		$ads->execute();
		return true;
	}

	public static function UpdateAccountDetails($id, $username, $nombre, $apellido, $password, $correo, $celular, $creditos)
	{
		$mbd = new Database();
		$ads = $mbd->prepare("UPDATE users_accounts	SET username=:username, nombre=:nombre, apellido=:apellido, password=:password, correo=:correo, celular=:celular, creditos=:creditos 
		WHERE id = :idUser");
		$ads->bindParam(':idUser', $id, PDO::PARAM_STR);
		$ads->bindParam(':username', $username, PDO::PARAM_STR);
		$ads->bindParam(':nombre', $nombre, PDO::PARAM_STR);
		$ads->bindParam(':apellido', $apellido, PDO::PARAM_STR);
		$ads->bindParam(':password', $password, PDO::PARAM_STR);
		$ads->bindParam(':correo', $correo, PDO::PARAM_STR);
		$ads->bindParam(':celular', $celular, PDO::PARAM_STR);
		$ads->bindParam(':creditos', $creditos, PDO::PARAM_STR);
		$ads->execute();
		$uInfo = $ads->fetchAll();
		return $uInfo;
	}

	// Funcion de registrar nuevo usuario
	public static function RegisterUser($correo, $username, $password, $nombre, $apellido, $celular, $createdAt, $ip, $fechaNacimiento)
	{
		$mbd = new Database();
		$ads = $mbd->prepare("INSERT INTO users_accounts (correo, username, password, nombre, apellido, celular, createdAt, ip, fecha_nacimiento) VALUES (:correo, :username, :password, :nombre, :apellido, :celular, :createdAt, :ip, :fechaNacimiento)");
		$ads->bindParam(':correo', $correo, PDO::PARAM_STR);
		$ads->bindParam(':username', $username, PDO::PARAM_STR);
		$ads->bindParam(':password', $password, PDO::PARAM_STR);
		$ads->bindParam(':nombre', $nombre, PDO::PARAM_STR);
		$ads->bindParam(':apellido', $apellido, PDO::PARAM_STR);
		$ads->bindParam(':celular', $celular, PDO::PARAM_STR);
		$ads->bindParam(':createdAt', $createdAt, PDO::PARAM_STR);
		$ads->bindParam(':ip', $ip, PDO::PARAM_STR);
		$ads->bindParam(':fechaNacimiento', $fechaNacimiento, PDO::PARAM_STR);
		$ads->execute();
		return true;
	}

	public static function CheckDuplicatedUser($username)
	{
		$mbd = new Database();
		$ads = $mbd->prepare("SELECT username FROM users_accounts WHERE username = :username");
		$ads->bindParam(':username', $username, PDO::PARAM_STR);
		$ads->execute();
		$uInfo = $ads->fetchAll();
		return $uInfo;
	}

	public static function CheckDuplicatedEmail($email)
	{
		$mbd = new Database();
		$ads = $mbd->prepare("SELECT correo FROM users_accounts WHERE correo = :correo");
		$ads->bindParam(':correo', $email, PDO::PARAM_STR);
		$ads->execute();
		$uInfo = $ads->fetchAll();
		return $uInfo;
	}



	public static function AddNewUser($nomPersona, $apePersona, $celPersona, $createdAcc, $username, $password, $creditos, $mailPersona, $rangoPersona, $verified)
	{
		$mbd = new Database();
		$mbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query = $mbd->prepare("INSERT INTO users_accounts (nombre, apellido, celular, createdAt, username, password, creditos, correo, perms_level, verified) VALUES (:nP,:aP,:cP,:caP,:u,:p,:coinsP,:mailP,:rP,:verified)");
		$query->bindParam(":nP", $nomPersona);
		$query->bindParam(":aP", $apePersona);
		$query->bindParam(":cP", $celPersona);
		$query->bindParam(":caP", $createdAcc);
		$query->bindParam(":u", $username);
		$query->bindParam(":p", $password);
		$query->bindParam(":coinsP", $creditos);
		$query->bindParam(":mailP", $mailPersona);
		$query->bindParam(":rP", $rangoPersona);
		$query->bindParam(":verified", $verified);
		$query->execute();
	}
}
