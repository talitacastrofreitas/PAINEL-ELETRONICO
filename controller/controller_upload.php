<?php
session_start();

if (isset($_FILES["file"])) {


  //echo $_FILES["file"]["name"];

  $nomes = array('arquivo_brotas.csv', 'arquivo_cabula.csv', 'publicidades.png');
  $nome_arquivo = $_FILES["file"]["name"];

  if (!in_array($nome_arquivo, $nomes)) {
    $_SESSION["erro"] = "Nome do arquivo inválido! Verifique a instrução de como gerar o arquivo.";
      header("Location: ../tela_admin.php");
      return die;
  }

  $tempFile = $_FILES["file"]["tmp_name"];
  $targetFile = "../files/" . $_FILES["file"]["name"];

  // verifique a extensão do arquivo
  $allowedExtensions = array("csv", "png");
  $fileExtension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
  if (!in_array($fileExtension, $allowedExtensions)) {
    $_SESSION["erro"] = "Extensão de arquivo inválida. Apenas arquivos CSV ou PNG são permitidos.";
    header("Location: ../tela_admin.php");
    return die;
  }

  // verifique o tamanho do arquivo
  $maxFileSize = 10 * 1024 * 1024; // 10 MB
  if ($_FILES["file"]["size"] > $maxFileSize) {
    $_SESSION["erro"] = "Tamanho do arquivo excedido. O tamanho máximo do arquivo é de 10 MB.";
    header("Location: ../tela_admin.php");
    return die;
  }

  // mova o arquivo para a pasta desejada
  move_uploaded_file($tempFile, $targetFile);

  $_SESSION["msg"] = 'O arquivo <strong>' . $_FILES["file"]["name"] . '</strong> foi enviado com sucesso!';
  header("Location: ../tela_admin.php");
  return die;
}

?>
