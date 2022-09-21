<?php 

class Connection {

	public function conectar()
	{
		$mysqli = new mysqli("localhost", "root", "12345", "prueba_tecnica_dev");
		/* comprobar la conexión */
		if ($mysqli->connect_errno) {
    	printf("Connection Failed: %s\n", $mysqli->connect_error);
    	exit();
		}
		if ($mysqli){
			echo "Successful Connection MYSQL";
		}
	}
}

?>

