<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">

<title>Agenda Monocromo</title></head>
<body>
<?php
require("agendaController.php");
$controller = new AgendaController;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['adicionar'])) { 
		$controller->addContato($_POST["nome"],$_POST["endereco"],$_POST["telefone"]);
	}
	if(isset($_POST['remover'])) {
		$controller->removeContato($_POST["remover"]);
	}
}
?>

<h2>Agenda Telefonica</h2>

<form action="index.php" method="post">
<table>
<tr><th>ID</th><th>Nome</th><th>Endereço</th><th>Telefone</th><th>Ações</th></tr>

<?php
	$contatos = $controller->buscaContatos();
	$arrlength = count($contatos);
    for($c=0;$c<$arrlength;$c++){
		echo "<tr><th>".$contatos[$c]->getId()."</th>
		<th>".$contatos[$c]->getNome()."</th>
		<th>".$contatos[$c]->getEndereco()."</th>
		<th>".$contatos[$c]->getTelefone()."</th>
		<th><button type ='submit' value='".$contatos[$c]->getId()."' name='remover' >Remover</button>
		<button type ='button' onclick='window.location.href=&#039;editar.php?id=".$contatos[$c]->getId()."&#039;' name='editar' >Editar</button>
		</th>
		</tr>";
	}
?>

<tr>
<td>Novo</td>
<td><input type="text" name="nome"></td>
<td><input type="text" name="endereco"></td>
<td><input type="text" name="telefone"></td></tr> 

</table>
<input type="submit" name="adicionar" value="Adicionar"></form>

</body>
</html>