<?php

function limpar_texto($str){
    return preg_replace("/[^0-9]/", "", $str);
}

$erro=false;
if(count($_POST) > 0) {
    include('conexao.php');

$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$nascimento = $_POST['nascimento'];


    if(empty('$nome')) {
        $erro="preencha o nome";
    }
    if(empty('$email') || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro="preencha o email";
    }

 if(!empty($telefone)){
    $telefone=limpar_texto($telefone);
    if(strlen($telefone)!=11)
    $erro="O telefone deve ser preenchido no padrão (51)99999-9999";
 }   
 if($erro){
    echo "<p><b>ERRO: $erro</b></p>";
} else {
    $sql_code= "INSERT INTO clientes (nome, email, telefone, nascimento, data) VALUES('$nome', '$email', '$telefone', '$nascimento',NOW())";
    $deu_certo= $mysqli->query($sql_code) or die($mysqli->error);
    if($deu_certo) {
        echo "<p><b>Cliente cadastrado com sucesso!</b></p>";
        unset($_POST);
    }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cadastrar cliente</title>
</head>

<body>
    <a href="/clientes.php"> Voltar para a lista </a>
    <form method="POST" action="">
    <br>

        <label>Nome:</label>
        <input name="nome" value="<?php if(isset($_POST['nome'])) echo $_POST['nome'];?>" type="text">
<br>
    <label>email:</label>
    <input name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>" type="text">
    
<br>
    <label>Data de Nascimento:</label>
    <input name="nascimento" value="<?php if(isset($_POST['nascimento'])) echo $_POST['nascimento'];?>" type="text">
   <br>
    <label>Telefone:</label>
    <input name=" telefone" value="<?php if(isset($_POST['telefone'])) echo $_POST['telefone'];?>" type="text">

    <br>
        <button type="submit">Salvar Cliente</button>

</form>
</body>
</html>