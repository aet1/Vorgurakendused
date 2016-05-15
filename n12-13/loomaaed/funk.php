<?php


function connect_db(){
	global $connection;
	$host="localhost";
	$user="test";
	$pass="t3st3r123";
	$db="test";
	$connection = mysqli_connect($host, $user, $pass, $db) or die("ei saa ühendust mootoriga- ".mysqli_error());
	mysqli_query($connection, "SET CHARACTER SET UTF8") or die("Ei saanud baasi utf-8-sse - ".mysqli_error($connection));
}

function logi(){
	global $connection;
$errors = array();
	if (isset($_SESSION['user'])) {
		kuva_puurid();
	} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (empty($_POST['user'])) $errors['no_username'] = "Sisesta kasutajanimi!";
		if (empty($_POST['pass'])) $errors['no_password'] = "Sisesta parool!";
			$username = mysqli_real_escape_string($connection, $_POST['user']);
			$password = mysqli_real_escape_string($connection, $_POST['pass']);
			$query_user = "SELECT username FROM audusaar_kylastajad WHERE username = '".$username."' AND passw = SHA1('".$password."')";
			$result = mysqli_query($connection, $query_user);
			if (mysqli_num_rows($result) > 0) {
				$_SESSION['user'] = htmlspecialchars($username);
				header("Location: ?page=loomad");
			} else $errors['vale'] = "Vale kasutajanimi või parool";
		}




	include_once('views/login.html');
}

function logout(){
	$_SESSION=array();
	session_destroy();
	header("Location: ?");
}

function kuva_puurid(){
	// siia on vaja funktsionaalsust
	global $connection;

	if (!isset($_SESSION['user']))
		header("Location: ?page=login"); else {
		$query = "SELECT DISTINCT(puur) FROM audusaar_loomaaed";
		$tulemused = mysqli_query($connection, $query);

		while ($loomarida = mysqli_fetch_assoc($tulemused)) {
			$puurid = $loomarida;
			foreach ($puurid as $puuri_nr) {
				$query_loomad = "SELECT * FROM audusaar_loomaaed WHERE puur = " . $puuri_nr;
				$loomad_tulemus = mysqli_query($connection, $query_loomad);
				while ($loomarida = mysqli_fetch_assoc($loomad_tulemus)) {
					$puurid[$puuri_nr][] = $loomarida;
				}
			}
			include('views/puurid.html');
		}
	}

}

function lisa(){
	global $connection;
	$errors = array();
	if (!isset($_SESSION['user'])) {
		include_once('views/login.html');
	} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (empty($_POST['nimi'])) $errors['no_name'] = "Sisesta nimi!";
		if (empty($_POST['puur'])) $errors['no_cage'] = "Sisesta puuri number!";
		if (empty($_FILES['liik']['name'])) $errors['no_picture'] = "Sisesta pilt!";
		$nimi = mysqli_real_escape_string($connection, $_POST['nimi']);
		$puur = mysqli_real_escape_string($connection, $_POST['puur']);
		$liik = mysqli_real_escape_string($connection, $_FILES['liik']['name']);
		$lisa_loom = "INSERT INTO audusaar_loomaaed (nimi, liik, puur) VALUES ('$nimi', 'pildid/".$liik."', '$puur')";
		echo mysqli_insert_id($connection);
		$result = mysqli_query($connection, $lisa_loom);
		if (!$result) {
			echo "Pildi üleslaadimine ebaõnnestus.";
		} else {
			kuva_puurid();
		}
		include_once('views/loomavorm.html');


	

}
	include_once('views/loomavorm.html');
}

function upload($name){
	$allowedExts = array("jpg", "jpeg", "gif", "png");
	$allowedTypes = array("image/gif", "image/jpeg", "image/png","image/pjpeg");
	$extension = end(explode(".", $_FILES[$name]["name"]));

	if ( in_array($_FILES[$name]["type"], $allowedTypes)
		&& ($_FILES[$name]["size"] < 100000)
		&& in_array($extension, $allowedExts)) {
    // fail õiget tüüpi ja suurusega
		if ($_FILES[$name]["error"] > 0) {
			$_SESSION['notices'][]= "Return Code: " . $_FILES[$name]["error"];
			return "";
		} else {
      // vigu ei ole
			if (file_exists("pildid/" . $_FILES[$name]["name"])) {
        // fail olemas ära uuesti lae, tagasta failinimi
				$_SESSION['notices'][]= $_FILES[$name]["name"] . " juba eksisteerib. ";
				return "pildid/" .$_FILES[$name]["name"];
			} else {
        // kõik ok, aseta pilt
				move_uploaded_file($_FILES[$name]["tmp_name"], "pildid/" . $_FILES[$name]["name"]);
				return "pildid/" .$_FILES[$name]["name"];
			}
		}
	} else {
		return "";
	}
}

?>