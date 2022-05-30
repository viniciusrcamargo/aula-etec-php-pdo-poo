<?php

require 'src/Contato.php';

$contato = new Contato();

if($_SERVER['REQUEST_METHOD']==='POST' && !empty($_POST['nome']) && !empty($_POST['email'])){
    if($contato->insert($_POST)){
        header('location: Index.php');
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/Style.css">
    <title>Cadastro de Contatos</title>
</head>
<body>
<header>
    <h1 class="titulo">Cadastro de Contatos</h1>
</header>
<main>
    <fieldset class="formulario container">
        <form action="Index.php" method="post" class="formulario container">
            <label for="nome" >Nome</label>
            <input type="text" id="nome" class="input-padrao" name="nome">

            <label for="email" >E-mail</label>
            <input type="text" id="email" class="input-padrao" name="email">

            <button type="submit" class="botao-padrao">Salvar</button>
        </form>
    </fieldset>

    <fieldset class="formulario container">
        <form action="" class="formLista" >
            <table>
                <?php foreach ($contato->select() as $lista){?>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                    </tr>
                    <tr>
                        <td class="coluna"><?php echo $lista[1];?></td>
                        <td class="coluna"><?php echo $lista[2];?></td>
                        <td ><a class="botao-editar" href="Edit.php?id=<?php echo $lista[0]; ?>">Editar</a></td>
                        <td ><a class="botao-excluir" href="Delete.php?id=<?php echo $lista[0]; ?>">Excluir</a></td>
                    </tr>
                <?php } ?>
            </table>
        </form>
    </fieldset>
</main>
</body>
</html>