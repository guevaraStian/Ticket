<?php
session_start();

if (empty($_POST['name'])) {
	$errors[] = "Nombre vacío";
} else if (
	!empty($_POST['name'])
) {

	include "../../config/config.php"; //Contiene funcion que conecta a la base de datos

	$name = mysqli_real_escape_string($con, (strip_tags($_POST["name"], ENT_QUOTES)));
	$created_at = date("Y-m-d H:i:s");
	$user_id = $_SESSION['user_id'];


	$sqlcon = "SELECT * FROM trabajador WHERE name = '" . $name . "';";
	$query_check_user_name = mysqli_query($con, $sqlcon);
	$query_check_user = mysqli_num_rows($query_check_user_name);
	if ($query_check_user >= 1) {
		$errors[] = "Lo sentimos , el nombre del trabajador ya está en uso.";
	} else {

		$sql = "INSERT INTO trabajador (name) VALUES (\"$name\")";
		$query_new_insert = mysqli_query($con, $sql);
		if ($query_new_insert) {
			$messages[] = "Tu trabajador ha sido ingresado satisfactoriamente.";
		} else {
			$errors[] = "Lo siento algo ha salido mal intenta nuevamente." . mysqli_error($con);
		}
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