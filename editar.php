<html>
<head>
<link rel="stylesheet" type="text/css" href="editar.css">
<title>Agenda Monocromo - Editar</title></head>
<body>

<?php
require("agendaController.php");
$controller = new AgendaController;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$controller->updateContato($_POST["id"],$_POST["nome"],$_POST["endereco"],$_POST["telefone"]);
	header("Location:index.php");
}

if(isset($_GET["id"])) { 
	$contato = $controller->buscaContato($_GET["id"]);
} else header("Location:index.php");

echo "<h2>Editar Contato</h2>
<form action='editar.php' method='post'>
Id:
<input type='text' name='id'  value='".$contato->getId()."' readonly='true'><br>
Nome:
<input type='text' name='nome' value='".$contato->getNome()."'><br>
Endereco:
<input type='text' name='endereco' value='".$contato->getEndereco()."'><br>
Telefone:
<input type='text' name='telefone' value='".$contato->getTelefone()."'>";
?>
<br><br>
<input type="submit" name="salvar" value="salvar"></form>
</form>
</body>
</html>