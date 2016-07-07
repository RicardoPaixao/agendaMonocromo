<?php
class AgendaDAO {
    $servername = "localhost";
	$username = "root";
	$password = "";

	function conecta () {
		// Create connection
		$conn = new mysqli($servername, $username, $password);

		// Check connection
		if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	
		return $conn;
	}
	
	function desconecta ($conn){
		$conn->close();
	}
	
	function buscaContatos (){
		$conn = conecta();
		
		$sql = "SELECT id, firstname, lastname FROM contatos";
		$result = $conn->query($sql);
		$resultarr = $result->fetch_all();
		$arrlength = count($resultarr);
		$contatos - array();
		for($c=0;$c<$arrlength;$c++){
			$contato = new contato($resultarr[$c]["id"],$resultarr[$c]["nome"],$resultarr[$c]["endereco"],$resultarr[$c]["telefone"]);
			$contatos[$c] = $contato; 
		}
		desconecta($conn);
		return $contatos;
	}
	
	function removeContato ($id){
		$conn = conecta();
		
		$sql = "DELETE FROM contatos WHERE id=".$id;
		if ($conn->query($sql) === TRUE) {
			echo "Sucesso";
		} else {
			echo "Erro: " . $conn->error;
		}
	}
	
	
	function setup (){
		$conn = conecta();
		
		$sql = "CREATE DATABASE agenda";
		
		if ($conn->query($sql) === TRUE) {
			echo "Database created successfully";
		} else {
			echo "Error creating database: " . $conn->error;
		}

		$sql = "CREATE TABLE contatos (
				id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
				nome VARCHAR(50) NOT NULL,
				endereco VARCHAR(255) NOT NULL,
				telefone VARCHAR(50))";

		if ($conn->query($sql) === TRUE) {
			echo "Table contatos created successfully";
		} else {
			echo "Error creating table: " . $conn->error;
		}

		desconecta($conn);
	}
}
?>