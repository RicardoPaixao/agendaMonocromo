<?php
class ContatosDAO {
    private $servername = "localhost";
	private $username = "root";
	private $password = "";
	private $dbname = "agenda";

	function conecta() {
		// Create connection
		$conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

		// Check connection
		if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);}
	
		return $conn;
	}
	
	function desconecta ($conn){
		$conn->close();
	}
	
	function buscaContatos (){
		$conn = $this->conecta();
		
		$sql = "SELECT id, nome, endereco, telefone FROM contatos";

		$result = $conn->query($sql);
		$resultarr = $result->fetch_all();
		$arrlength = count($resultarr);
		$contatos = array();
		for($c=0;$c<$arrlength;$c++){
			$contato = new contato($resultarr[$c][0],$resultarr[$c][1],$resultarr[$c][2],$resultarr[$c][3]);
			$contatos[$c] = $contato; 
		}
		$this->desconecta($conn);
		return $contatos;
	}	
	
	function buscaContato ($id){
		$conn = $this->conecta();
		$sql = "SELECT id, nome, endereco, telefone FROM contatos WHERE id=".$id;
		$result = $conn->query($sql);
		$resultarr = $result->fetch_all();
		$contato = new contato($resultarr[0][0],$resultarr[0][1],$resultarr[0][2],$resultarr[0][3]);
		$this->desconecta($conn);
		return $contato;
	}
	
	function addContato ($contato){
		$conn = $this->conecta();
		
		$sql = "INSERT INTO contatos (nome,endereco,telefone) VALUES ('".$contato->getNome()."','".$contato->getEndereco()."','".$contato->getTelefone()."')";
	
		if ($conn->query($sql) === TRUE) {
			echo "Sucesso";
		} else {
			echo "Erro: " . $conn->error;
		}
		$this->desconecta($conn);
	}	
	
	function updateContato ($contato){
		$conn = $this->conecta();
		
		$sql = "UPDATE contatos SET nome='".$contato->getNome()."', endereco='".$contato->getEndereco()."', telefone='".$contato->getTelefone()."' WHERE id=".$contato->getId();
	
		if ($conn->query($sql) === TRUE) {
			echo "Sucesso";
		} else {
			echo "Erro: " . $conn->error;
		}
		$this->desconecta($conn);
	}
	
	function removeContato ($id){
		$conn = $this->conecta();
		
		$sql = "DELETE FROM contatos WHERE id=".$id;
		if ($conn->query($sql) === TRUE) {
			echo "Sucesso";
		} else {
			echo "Erro: " . $conn->error;
		}
		$this->desconecta($conn);
	}
	
	function setup (){
		$conn = $this->conecta();
		
		$sql = "DROP DATABASE agenda";
		
		if ($conn->query($sql) === TRUE) {
			echo "Database dropped successfully";
		} else {
			echo "Error dropping database: " . $conn->error;
		}

		echo "</br>";
		
		$sql = "CREATE DATABASE agenda";
		
		if ($conn->query($sql) === TRUE) {
			echo "Database created successfully";
		} else {
			echo "Error creating database: " . $conn->error;
		}
		
		echo "</br>";

		$sql = "CREATE TABLE agenda.contatos (
				id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
				nome VARCHAR(50) NOT NULL,
				endereco VARCHAR(255) NOT NULL,
				telefone VARCHAR(50))";

		if ($conn->query($sql) === TRUE) {
			echo "Table contatos created successfully";
		} else {
			echo "Error creating table: " . $conn->error;
		}
		
		echo "</br>";

		$this->desconecta($conn);
	}
}
?>