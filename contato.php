<?php
class Contato {
	private $id;
	private $nome;    
	private $endereco;  
	private $telefone;
      
	function __construct($id, $nome, $endereco, $telefone ) {
		$this->id = $id;
		$this->nome = $nome;
		$this->endereco = $endereco;
		$this->telefone = $telefone;
	}
	
	function getId(){
		return $this->id;
	}
	
	function setId($id){
		$this->id = $id;
	}	
	
	function getNome(){
		return $this->nome;
	}
	
	function setNome($nome){
		$this->nome = $nome;
	}	
	
	function getEndereco(){
		return $this->endereco;
	}
	
	function setEndereco($endereco){
		$this->endereco = $endereco;
	}
	
	function getTelefone(){
		return $this->telefone;
	}
	
	function setTelefone($telefone){
		$this->telefone = $telefone;
	}
}
?>