<?php
require_once 'src/Contato.php';

session_start();
$contato = new Contato();


if(!empty($_GET['id'])){
    $listClients = [];
    $listClients = $contato->selectOne($_GET['id']);
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['nome']) && !empty($_POST['email'])){
    if($contato->delete($_POST) === true){
        header("Location: Index.php");
    }
}

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/style.css">
    <title>Exclusão de Contatos</title>
</head>
<body>
<fieldset class="formulario container">
    <form action="Delete.php" method="post">
        <?php  if(!empty($listClients)) { foreach ($listClients as $list){ //var_dump($list);?>
        <input type="hidden" name="id" value="<?php echo $list['ID'] ?>">
        <label for="nome">Nome</label>
        <input type="text" class="input-padrao" id="nome" name="nome" value="<?php echo $list['NOME'] ?>">

        <label for="endereco">E-mail</label>
        <input type="email" class="input-padrao" id="endereco" name="email" value="<?php echo $list['EMAIL'] ?>" >
        <?php } } ?>
        <button type="submit" class="botao-padrao botao-excluir">Excluir</button>

    </form>
</fieldset>
</body>
</html>