<?php
	require("contato.php");
	require("contatosDAO.php");

class AgendaController {
    private $contatosDAO;
      
	function __construct() {
		$this->contatosDAO = new ContatosDAO;
	}  
	  
    function buscaContatos () {
        return $this->contatosDAO->buscaContatos();
    }
	
	function buscaContato ($id) {
        return $this->contatosDAO->buscaContato($id);
    }
	
    function removeContato ($id) {
        $this->contatosDAO->removeContato($id);
    }
	
	function addContato ($nome,$endereco,$telefone){	
		$contato = new contato(NULL,$nome,$endereco,$telefone);
		$this->contatosDAO->addContato($contato);
	}
	
	function updateContato ($id, $nome,$endereco,$telefone){	
		$contato = new contato($id ,$nome,$endereco,$telefone);
		$this->contatosDAO->updateContato($contato);
	}
	
	function setup() {
		return $this->contatosDAO->setup();
	}
}
?>