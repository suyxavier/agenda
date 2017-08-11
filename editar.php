    <?php
    require 'controlador_agenda.php';
    $contato = editarContato($_GET['id']);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form method="post" action="controlador_agenda.php?acao=salvar">
    <br>
        <input name="id" readonly  type="text"  value="<?= $contato['id']?>" >  Modificar id 
        <br>
        <input name="nome"     type="text"  value="<?= $contato['nome']?>"> Modificar Nome
        <br>
        <input name="email"    type="email" value="<?= $contato['email']?>"> Modificar Contato  
        <br>
        <input name="telefone" type="text"  value="<?= $contato['telefone']?>"> Modificar Telefone          
        <br>

        <input type="submit" value="salvar">
    </form>

</body>
</html>