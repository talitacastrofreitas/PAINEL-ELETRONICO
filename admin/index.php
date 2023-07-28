<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emailDigitado = $_POST['email'];
    $senhaDigitada = $_POST['senha'];

    // Verificar as informações de login
    $usuarioAutenticado = false;

    //abrir arquivo CSV
    if (($handle = fopen('../files/usuarios.csv', 'r')) !== false) {
        //para ler as linhas do arquivo
        while (($data = fgetcsv($handle)) !== false) {
            $email = $data[0];
            $hashSenhaArmazenada = $data[3];

            //verifica se o email e a senha estão corretos
            if ($email === $emailDigitado && password_verify($senhaDigitada, $hashSenhaArmazenada)) {
                $usuarioAutenticado = true;
                break;
            }
        }
        //fecha o arquivo
        fclose($handle);
    }
    //autentica usuário
    if ($usuarioAutenticado) {
        $_SESSION['usuario_autenticado'] = true;
        header('Location: ../tela_admin.php');
        exit();
    } else {
        $mensagemErro = 'E-mail ou senha inválida.';
    }
}
?>

<!doctype html>
<html lang="pt-br" data-bs-theme="auto">
  <head><script src="/docs/5.3/assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.115.4">
    <title>Painel Eletronico - ADM</title>

    <!-- BOOTSTRAP -->
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
<link href="/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    
    <!-- CSS -->
    <link href="../dist/css/login.css" rel="stylesheet">
  </head>
  <body class="d-flex align-items-center py-4 bg-bodyy">

    
<main class="form-signin w-100 m-auto">
  <form name="" action="./index.php" method="post">
    <img class="mb-4" style="vertical-align: middle;
    border-style: none;" src="https://acesso.bahiana.edu.br/img/bahiana-logo.png" alt="logo-bahiana" width="270" height="60">
    <h1 class="h5 mb-4 fw-normal" style="text-align: center">Informe seus dados de acesso.</h1>

        <!-- MENSAGEM DE ERRO -->
        <?php if (isset($mensagemErro)) { ?>
        <span style="color: red;"><?php echo $mensagemErro; ?></span>
    <?php } ?> 

    <div class="form-floating">
      <input type="email" class="form-control" id="email" name="email" placeholder="setor-name@bahiana.edu.br" required>
      <label for="floatingInput">E-mail</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="senha" name="senha" placeholder="senha"  required>
      <label for="floatingPassword">Senha</label>
    </div>


    <button class="btn btn-success w-100 py-2 mb-4" type="submit">Entrar</button>
    <div class="footer" style="text-align:center"><p class="mt-4 mb-1 text-body-secondary">&copy;2023. Todos os direitos reservados - Painel Eletrônico</p></div>
    
  </form>
</main>
<script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    </body>
</html>
