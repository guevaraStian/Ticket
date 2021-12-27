<?php
session_start();
/*Inicia validacion del lado del servidor*/
if (empty($_POST['title'])) {
	$errors[] = "Titulo vacío";
} else if (empty($_POST['description'])) {
	$errors[] = "Description vacío";
} else if (
	!empty($_POST['title']) &&
	!empty($_POST['description'])
) {


	include "../../config/config.php"; //Contiene funcion que conecta a la base de datos

	$title = $_POST["title"];
	$description = $_POST["description"];
	// $trabajador_id = $_POST["trabajador_id"];
	$priority_id = $_POST["priority_id"];
	$user_id = $_SESSION["user_id"];
	$status_id = $_POST["status_id"];
	$pedido_id = $_POST["pedido_id"];

	$agenciadestino_id = $_POST["agenciadestino_id"];
	
	$created_at = "NOW()";

	$au = $_POST["agenciauser"];

	$arr = mysqli_query($con, "select * from agenciaarea where name = '$au'");
	while ($row = mysqli_fetch_array($arr)) {
		$agenciaarea_id = $row['id'];
	}
		$sql = "insert into ticket (title,description,agenciaarea_id,agenciadestino_id,priority_id,user_id,status_id,pedido_id,created_at) value (\"$title\",\"$description\",\"$agenciaarea_id\",\"$agenciadestino_id\", $priority_id,$user_id,$status_id,$pedido_id,$created_at)";
	$query_new_insert = mysqli_query($con, $sql);

	/**********************************************/
	// CODIGO PARA SUBIR ARCHIVOS
	/**********************************************/

	$id = mysqli_insert_id($con);

	//Database Connection
	$conn2 = mysqli_connect('localhost', 'root', '', 'ticket');
	//Check for connection error
	if ($conn2->connect_error) {
		die("Error in DB connection: " . $conn2->connect_errno . " : " . $conn2->connect_error);
	}


	//if (isset($_POST['submit'])) {
	// Count total uploaded files
	$totalfiles = count($_FILES['file']['name']);

	// Looping over all files
	for ($i = 0; $i < $totalfiles; $i++) {
		$filename2 = $_FILES['file']['name'][$i];
		date_default_timezone_set('America/Bogota');
		$fecha = date('Ymd_His_');
		$filename =$fecha.$filename2 ;
		// Upload files and store in database
		if (move_uploaded_file($_FILES["file"]["tmp_name"][$i], '../../archivos/upload/' . $filename)) {
			// Image db insert sql
			$insert = "INSERT into files(file_name,uploaded_on,idticket) values('$filename',now(),'$id')";
			if (mysqli_query($conn2, $insert)) {
				// echo 'Data inserted successfully';
			} else {
				echo 'Error: ' . mysqli_error($conn2);
			}
		} else {
			echo 'No se subio algun archivo - ' . $_FILES['file']['name'][$i] . '<br/>';
		}
	}
	//}






	/**********************************************/


	if ($query_new_insert) {
		$messages[] = "Tu ticket ha sido ingresado satisfactoriamente.";
	} else {
		$errors[] = "Lo siento algo ha salido mal intenta nuevamente." . mysqli_error($con);
	}
} else {
	$errors[] = "Error desconocido.";
}

if (isset($errors)) {

?>
	<div class="alert alert-danger" role="alert">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>Error!</strong>
		<?php
		foreach ($errors as $error) {
			echo $error;
		}
		?>
	</div>
<?php
}
if (isset($messages)) {

?>
	<div class="alert alert-success" role="alert">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>¡Bien hecho!</strong>
		<?php
		foreach ($messages as $message) {
			echo $message;
		}
		?>
	</div>
<?php
}

?>