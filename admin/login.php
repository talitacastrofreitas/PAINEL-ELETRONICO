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
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Eletronico</title>

    <!--DIRETORIO CSS-->
    <link rel="stylesheet" href="../dist//css/login.css" />

    <!--BOOTSTRAP-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>

<body>

    <div class="container">
        <div class="row">
            <!--IMAGEM BAHIANA-->
            <div class="col-md-6">
                <img class="mb-0" src="../dist/img/escudo.png" alt="bahiana">
                <h1 class="title-logo mb-0">Bahiana</h1>
                <h6 class="subtitle-logo">Escola de medicina e saúde pública</h6>
            </div>
            <!--CARD-LOGIN-->
            <div class="col-md-6">
                <div class="card" style="width: 34rem; height: 43rem; border-radius: 450px 0px 0px 450px">
                    <div class="card-body">
                        <h5 class="card-title">Painel Eletrônico</h5>
                        <h6 class="card-subtitle mb-5 text-muted">Sistema de exibição</h6>
                        <p>Informe seus dados de acesso.</p>

                        <!-- MENSAGEM DE ERRO -->
                        <?php if (isset($mensagemErro)) { ?>
                            <span style="color: red;"><?php echo $mensagemErro; ?></span>
                        <?php } ?>
                        <!-- Formulário de login -->
                        <form name="" action="./login.php" method="post">
                            <div class="field_box">
                                <input class="form_input my-2" type="email" name="email" id="email" autocomplete="off" required>
                                <label for="email" class="form_label">E-mail</label>
                            </div>

                            <div class="field_box">
                                <input class="form_input my-2 mb-3" type="password" name="senha" id="senha" autocomplete="off" required>
                                <label for="senha" class="form_label">Senha</label>
                            </div>
                            <button type="submit" name="submit" class="button">entrar</button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <footer>&copy 2023. Painel Eletrônico - Todos os direitos reservados.</footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>