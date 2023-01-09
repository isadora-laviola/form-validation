<?php
$erroNome = "";
$erroEmail = "";
$erroSenha = "";
$erroRepeteSenha = "";

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(empty($_POST['nome'])) {
      //VERIFICAR SE ESTÁ VAZIO O POST NOME
      $erroNome = "Por favor, preencha um nome";
    }else {
      //PEGAR O VALOR VINDO DO POST E LIMPAR
      $nome = limpaPost($_POST['nome']);
      //VERIFICAR SE TEM SOMENTE LETRAS
      if (!preg_match("/^[a-zA-Z-' ]*$/", $nome)) {
        $erroNome = "Apenas aceitamos letras e espaços em branco";
    }

    //VERIFICAR SE ESTÁ VAZIO O POST E-MAIL
    if(empty($_POST['email'])) {
      $erroEmail = "Por favor, preencha um e-mail";
    }else {
      $email = limpaPost($_POST['email']);
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $erroEmail = "E-mail inválido";
      }
    }

    //VERIFICAR SE ESTÁ VAZIO O POST SENHA
    if(empty($_POST['senha'])) {
      //VERIFICAR SE ESTÁ VAZIO O POST E-MAIL
      $erroSenha = "Por favor, informe uma senha";
    }else {
      $senha = limpaPost($_POST['senha']);
      if (strlen($senha) < 6) {
        $erroSenha = "A senha precisa ter, no mínimo, 6 dígitos";
      }
    }

    //VERIFICAR SE ESTÁ VAZIO O POST REPETA SENHA
    if(empty($_POST['repete_senha'])) {
      //VERIFICAR SE ESTÁ VAZIO O POST E-MAIL
      $erroRepeteSenha = "Por favor, informe a repetição da senha";
    }else {
      $repete_senha = limpaPost($_POST['repete_senha']);
      if ($repete_senha !==  $senha) {
        $erroRepeteSenha = "A repetição da senha está diferente da senha";
      }
    }
  }

  //SE NÃO TIVER NENHUM ERRO, ENVIAR PARA OBRIGADO
  if (($erroNome == "") && ($erroEmail == "") && ($erroSenha == "") && ($erroRepeteSenha == "")) {
    header('Location: obrigado.php');
  }
}

  function limpaPost($valor) {
    $valor = trim($valor);
    $valor = stripcslashes($valor);
    $valor = htmlspecialchars($valor);
    return $valor;
  }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validação de Formulário</title>
    <link href="css/estilo.css" rel="stylesheet">
</head>
<body>
    <main>
    <h1><span>AULA PHP</span><br>Validação de Formulário</h1>

     <form method="post">

        <!-- NOME COMPLETO -->
        <label> Nome Completo </label>
        <input type="text" name="nome" <?php if (!empty($erroNome)) { echo "class='invalido'";} ?> <?php if (isset($_POST['nome'])) {echo "value='".$_POST['nome']."'"; } ?> placeholder="Digite seu nome" required>
        <br><span class="erro"><?php echo $erroNome; ?></span>

        <!-- EMAIL -->
        <label> E-mail </label>
        <input type="email" <?php if (!empty($erroEmail)) { echo "class='invalido'";} ?> <?php if (isset($_POST['nome'])) {echo "value='".$_POST['email']."'"; } ?> name="email" placeholder="email@provedor.com" required>
        <br><span class="erro"><?php echo $erroEmail; ?></span>

        <!-- SENHA -->
        <label> Senha </label>
        <input type="password" <?php if (!empty($erroSenha)) { echo "class='invalido'";} ?> <?php if (isset($_POST['nome'])) {echo "value='".$_POST['senha']."'"; } ?> name="senha" placeholder="Digite uma senha" required>
        <br><span class="erro"><?php echo $erroSenha; ?></span>

        <!-- REPETE SENHA -->
        <label> Repete Senha </label>
        <input type="password" <?php if (!empty($erroRepeteSenha)) { echo "class='invalido'";} ?>  <?php if (isset($_POST['nome'])) {echo "value='".$_POST['repete_senha']."'"; } ?>name="repete_senha" placeholder="Repita a senha" required>
        <br><span class="erro"><?php echo $erroRepeteSenha; ?></span>

        <button type="submit"> Enviar Formulário </button>

      </form>
    </main>
</body>
</html>