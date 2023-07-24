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
        <meta name="author" content="Talita Castro Freitas">
        <meta name="generator" content="Talita Castro Freitas">
        <title>Administrador</title>
    
        <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">
        <link href="https://getbootstrap.com/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    
    
        
        <!-- Custom styles for this template -->
        <link href="../dist/css/login.css" rel="stylesheet">
      </head>
      <body class="d-flex align-items-center py-4 bg-bodyy">
    
        
    <main class="form-signin w-100 m-auto">
      
    
    
    <form name="" action="./index.php" method="post">
    
        <img class="mb-4" style="align-items:center" src="https://acesso.bahiana.edu.br/img/bahiana-logo.png" alt="logo-bahiana" width="280" height="57">
        <h1 class="h5 mb-4 fw-normal" style="text-align: center">Informe seus dados de acesso.</h1>

           <!-- MENSAGEM DE ERRO -->
       <?php if (isset($mensagemErro)) { ?>
        <span style="color: red;"><?php echo $mensagemErro; ?></span>
    <?php } ?> 
        
        <div class="form-floating mt-4">
          <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com">
          <label for="email">E-mail</label>
        </div>
        <div class="form-floating">
          <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha">
          <label for="senha">Senha</label>
        </div>
    
        <button class="btn btn-success w-100 py-2" style=" color: #fff;"type="submit" name="submit">Entrar</button><br><br>
        <div class="footer" style="text-align:center"><p class="mt-5 mb-3 text-body-secondary">&copy;2023. Todos os direitos reservados - Painel Eletrônico</p></div>
      </form>
    </main>
    <script src="https://getbootstrap.com/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://getbootstrap.com/docs/5.3/assets/js/color-modes.js"></script>
        </body>
    </html>