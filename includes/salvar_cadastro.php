<?php
session_start();

$email = $_POST['email'];
$senha = $_POST['senha'];
$nome = $_POST['nome'];
$matricula = $_POST['matricula'];
$hashSenha = password_hash($senha, PASSWORD_DEFAULT);

// // // Verifica se a senha tem pelo menos 8 caracteres e atende aos requisitos
if (strlen($senha) < 8 || !preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z\d])/', $senha)) {
    echo "A senha deve conter 8 caracteres, incluindo pelo menos uma letra maiúscula, uma letra minúscula, um número e um caractere especial.";
    exit; // Encerra o script para evitar o cadastro com senha inválida
  }

// Abre o arquivo CSV em modo de escrita (append)
$arquivo = fopen('../files/usuarios.csv', 'a');

// Verifica se o arquivo foi aberto com sucesso
if ($arquivo) {
    // Escreve os dados no arquivo CSV
    fputcsv($arquivo, array($email, $nome, $matricula, $hashSenha));
    
    // Fecha o arquivo CSV
    fclose($arquivo);
    $_SESSION['cadastro_success'] = 'Cadastro realizado com sucesso!';

     // Limpa o buffer de saída
  ob_clean();

  // Redirecionamento com a âncora para a página desejada
  header('Location: ../tela_admin.php#cadastro');
  exit(); // Certifique-se de sair do script após o redirecionamento
}
   
   


