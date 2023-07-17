<?php
session_start();

// Verifica se o usuário está autenticado
if (!isset($_SESSION['usuario_autenticado']) || ($_SESSION['usuario_autenticado']) !== true) {
    header('Location: ./admin/login.php');
    exit();
}

if (isset($_SESSION['cadastro_success'])) {
    $msgSuccess = $_SESSION['cadastro_success'];
    unset($_SESSION['cadastro_success']); // Limpar a variável de sessão
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>

    <!--BOOTSTRAP-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- DATA TABLE -->
    <link rel="stylesheet" href="./dist/css/jquery.dataTables.min.css">

    <!-- ALERTA -->
    <link rel="stylesheet" href="sweetalert2.min.css">

    <!-- FONT AWESOME -->
    <script src="https://kit.fontawesome.com/0de36d37a3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <!-- CSS -->
    <link href="./dist/css/tela_admin.css" rel="stylesheet">
</head>

<body>
    <!-- FOOTER -->
    <footer style="background-image: url(./dist/img/bg_header.svg);">&copy2023. Todos os direitos reservados - Painel Eletrônico</footer>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light" id="nav" style="background-image: url(./dist/img/bg_header.svg);">
        <a class="navbar-brand" href="tela_admin.php" style="font-weight: 600; color: #fff; font-size: 26px;">
            <img src="./dist/img/logo_header.svg" style="margin-left: 20px; width: 200px; height: 50px" alt="logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="./tela_admin.php" data-target="upload">Upload</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="./admin/cadastro_usuario.php" data-target="cadastro">Cadastrar admin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./tela_admin.php#lista" data-target="lista">Lista de usuários</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="./upload.php">Upload</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="./index.php">Painel</a>
                </li>
            </ul>
        </div>
        <a class="btn-sair" href="./admin/logout.php"><i class="fa-solid fa-right-from-bracket fa-xl" style="margin-right: 2vw;"></i></a>
    </nav>


    <!-- SEÇÕES (CONTEUDO DOS LINKS DA NAVBAR) -->
    <div class="content">

        <!-- Conteúdo para a seção "Upload" -->
        <div id="upload" class="info" style="display: none;">
            <div class="container">
                <div class="row m-0">
                    <div class="col-md-12">

                        <!-- ALERTAS DE PAGINA -->
                        <?php if (isset($_SESSION["erro"])) { ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?= $_SESSION["erro"]; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php unset($_SESSION["erro"]);
                        } ?>

                        <?php if (isset($_SESSION["msg"])) { ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?= $_SESSION["msg"]; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php unset($_SESSION["msg"]);
                        } ?>

                        <div class="desc mb-1 mt-4">
                            <h3>COMO GERAR O ARQUIVO</h3>

                            <ol>
                                <li>Dois arquivos devem ser criados: um para a unidade de Brotas, outra para o Cabula. </li>
                                <li> O arquivo de Brotas deve ser renomeado de “<strong>arquivo_brotas.csv</strong>” e o arquivo do Cabula deve ser renomeado de “<strong>arquivo_cabula.csv</strong>”.</li>
                                <li>O cabeçalho da tabela <strong>não</strong> deve ser excluído.</li>
                                <li>A primeira coluna deve conter a data da realização da atividade. O formato deve ser padrão: <strong>dia-mês-ano (15/07/2023)</strong>.</li>
                                <li>O arquivo deve ser salvo no formato <strong>CSV UTF-8 (Delimitado por vírgulas)</strong>.</li>
                                <li>O arquivo não pode ultrapassar o tamanho de <strong>10mb</strong>.</li>
                                <li>O arquivo da publicidade deve ser do formato <strong>PNG</strong> e deve ser renomeado de “<strong>publicidades.png</strong>”.</li>
                            </ol>

                            <p class="mb-0">Para baixar o arquivo modelo, clique <a style="text-decoration: none;" href="dist/img/modelo.csv">aqui</a></p>
                        </div>

                        <form action="./controller/controller_upload.php" method="POST" enctype="multipart/form-data">
                            <div class="row m-0">
                                <div class="mb-3 p-0">
                                    <label for="formFileLg" class="form-label">Arquivo</label>
                                    <input class="form-control form-control-lg" id="file-input" type="file" name="file" accept=".csv,.png" required>
                                </div>
                            </div>
                            <input class="botao border-0 m-0 float-end" type="submit" value="ENVIAR">
                        </form>
                    </div>
                </div>
            </div>

            <script src="dist/js/sweetalert.js"></script>
            <script>
                const fileInput = document.getElementById('file-input');

                fileInput.addEventListener('change', function() {
                    const file = this.files[0]; // Obtenha o primeiro arquivo selecionado (você também pode iterar sobre vários arquivos, se necessário)

                    if (file && file.size > 10 * 1024 * 1024) {
                        // Verifica se o tamanho do arquivo excede 10 MB (em bytes)

                        Swal.fire({
                            icon: 'error',
                            title: 'Erro encontrado!',
                            text: 'O arquivo selecionado ultrapassa o tamanho permitido de 10mb.',
                            confirmButtonText: 'Cancelar'
                        })

                        //alert('O tamanho do arquivo excede o limite de 10 MB.');
                        this.value = ''; // Limpa o valor do input de arquivo selecionado
                    }
                });
            </script>

        </div>

        <!-- Conteúdo para a seção "CADASTRAR USUÁRIO" -->
        <div id="cadastro" class="info" style="display: none;">

            <div class="box">
                <h3 class="card-title">CADASTRAR USUÁRIO</h3>
                <p>Informe os dados a serem cadastrados.</p><br>
                <!-- MENSAGEM DE SUCESSO -->
                <?php if (isset($msgSuccess)) : ?>
                    <p class="success-message" style="color: green;"><?php echo $msgSuccess; ?></p>
                <?php endif; ?>

                <!-- <div class="container"> -->
                <form class="row" onsubmit="return validarSenha()" action="./includes/salvar_cadastro.php" method="post">

                    <div class="col-6">
                        <div class="field_box ">
                            <input class="form_input mb-2" type="email" name="email" id="email" autocomplete="off" required>
                            <label for="email" class="form_label">E-mail</label>
                        </div>
                    </div>


                    <div class="col-6">
                        <div class="field_box">
                            <input class="form_input mb-2" type="text" name="nome" id="nome" autocomplete="off" required>
                            <label for="nome" class="form_label">Nome completo</label>
                        </div>
                    </div>


                    <div class="col-6">
                        <div class="field_box">
                            <input class="form_input mb-2" type="text" name="matricula" id="matricula" autocomplete="off" required>
                            <label for="nome" class="form_label">Matrícula</label>
                        </div>
                    </div>


                    <!-- DEFINIR QUANTIDADE DE CARACTERES E ACEITE DE APENAS NUMEROS NO CAMPO MATRICULA -->
                    <script>
                        const campo = document.getElementById("matricula");

                        campo.addEventListener("input", function() {
                            campo.value = campo.value.replace(/\D/g, "");
                            campo.value = campo.value.slice(0, 5);
                        });
                    </script>


                    <div class="col-6">
                        <div class="field_box">
                            <input class="form_input" type="password" name="senha" id="senha" autocomplete="off" required>
                            <label for="senha" class="form_label">Senha</label>
                            <small class="form-text" style="font-size:12px; color:red;" id="senha-error"></small>
                        </div>

                        <script>
                            function validarSenha() {
                                const senhaInput = document.getElementById('senha');
                                const senhaError = document.getElementById('senha-error');
                                const senha = senhaInput.value;

                                // Verifica se a senha é inválida
                                if (senha.length < 8 || !/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z\d])/.test(senha)) {
                                    senhaError.textContent = "A senha deve conter 8 caracteres, incluindo pelo menos uma letra maiúscula, uma letra minúscula, um número e um caractere especial.";
                                    return false; // Impede o envio do formulário
                                } else {
                                    senhaError.textContent = "";
                                    return true; // Permite o envio do formulário
                                }
                            }
                        </script>
                    </div>
                    <div class="col">
                        <button type="submit" name="submit" class="saved mx-3 mt-4"><a class="bt-saved" style="text-decoration:none;">cadastrar</a></button>

                        <button class="back mt-4"><a class="bt-close" style="text-decoration:none;" href="tela_admin.php">cancelar</a></button>
                    </div>
            </div>
            </form>
        </div>

    </div>
    </div>
    </div>
    <div id="lista" class="info" style="display: none;">
        <!-- Conteúdo para a seção "LISTA DE USUÁRIOS" -->

        <?php
        // Função para excluir um usuário
        function excluirUsuario($id)
        {
            $file = './files/usuarios.csv';
            $data = file($file);

            // Encontra o usuário pelo ID
            foreach ($data as $line => $user) {
                $userData = explode(',', $user);
                if ($userData[0] == $id) {
                    // Remove o usuário do array
                    unset($data[$line]);
                    break;
                }
            }

            // Reescreve o arquivo CSV
            file_put_contents($file, implode('', $data));
        }

        // Verifica se o formulário foi enviado
        if (isset($_POST['excluir'])) {
            $id = $_POST['excluir'];
            excluirUsuario($id);
        }

        // Lê o arquivo CSV
        $file = './files/usuarios.csv';
        $data = file($file);

        if (count($data) == 0) {
            echo "<p>Nenhum usuário cadastrado.</p>";
        } else {
            echo "<div class='table-responsive'>";
            echo "<table id='tabela' class='table table-striped tabela display'>";
            echo "<thead>
                <th rowspan='3'>E-MAIL</th>
                <th rowspan='3'>NOME</th>
                <th rowspan='3'>MATRICULA</th>
                <th rowspan='3'>EXCLUIR</th>
            </thead>";

            foreach ($data as $user) {
                $userData = explode(',', $user);
                $id = $userData[0];
                $nome = $userData[1];
                $matricula = $userData[2];

                $nome = str_replace('"', '', $nome);
                echo "<tr style='top: 20px;'>";
                echo "<td>$id</td>";
                echo "<td>$nome</td>";
                echo "<td>$matricula</td>";
                echo "<td><form method='post' action='./tela_admin.php#lista'>";
                echo "<button onclick='Excluir()' class= 'excluir' type='submit' name='excluir' id='excluir' value='$id'><i class='fa-regular fa-trash-can fa-lg'></i></button>";
                echo "</form></td>";
                echo "</tr>";
            }
            echo "</div>";
            echo "</table>";
        }
        ?>

        <script>
            function Excluir() {
                window.location.href = "#excluir";
            }
        </script>
    </div>

    <script>
        // Captura todos os elementos <a> com o atributo data-target
        var links = document.querySelectorAll('a[data-target]');

        // Adiciona um evento de clique a cada link
        links.forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault();

                // Obtém o valor do atributo data-target
                var target = link.getAttribute('data-target');

                // Oculta todas as informações
                var infos = document.getElementsByClassName('info');
                for (var i = 0; i < infos.length; i++) {
                    infos[i].style.display = 'none';
                }

                // Exibe a informação correspondente ao target
                document.getElementById(target).style.display = 'block';
            });
        });
    </script>


    <!-- SCRIPTS JS -->
    <script src="dist/js/bootstrap.bundle.min.js"></script>

    <!-- DATA TABLES -->
    <script src="dist/js/jquery-3.5.1.js"></script>
    <script src="dist/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>

</html>