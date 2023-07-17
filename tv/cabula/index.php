<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="refresh" content="600">
  <title>Painel Eletrônico</title>
  <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../dist/css/style.css">
</head>

<body>

  <?php
  clearstatcache(); // LIMPAR CACHE
  date_default_timezone_set('America/Sao_Paulo'); //Atualiza a data para hora local do Brasil
  //$currentTime = '07:00';
  $currentTime = date('H:i');

  $arquivo_cabula = '../../files/arquivo_cabula.csv';
  $intervalo = '20000'; // TEMPO DE INTERVALO 
  $cout_row = 12; // LINHAS POR SLIDE
  $dataAtual = date('Y-m-d');
  ?>

  <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
    <div class="carousel-inner">

      <div class="carousel-item active" data-bs-interval="<?= $intervalo ?>">
        <?php include '../includes/header.php'; ?>
        <div class="tabela">
          <?php include '../includes/data_cabula.php'; ?>
          <div class="table-responsive">
            <table class="table table-striped">
               <?php include '../includes/thead.php'; ?>
              <tbody>
                <?php
                $start_row = 0;
                $csv_file = fopen($arquivo_cabula, "r");
                while (($read_data = fgetcsv($csv_file, 0, ";")) !== false) {
                  $rowTime = $read_data[2]; // Assumes the time is in the first column

                  // CONVERTE O FORMATO DA DATA
                  $originalDate = $read_data[0];
                  $originalDate = str_replace("/", "-", $originalDate);
                  $timestamp = strtotime($originalDate);
                  $newDate = date("Y-m-d", $timestamp);

                  if ($rowTime >= $currentTime && $newDate == $dataAtual) {
                    $validRows[] = $read_data;
                ?>
                    <tr valign="middle">
                      <?php
                      $start_row++;
                      if ($start_row >= 0 && $start_row <= $cout_row) {
                        //echo $start_row;
                        for ($c = 0; $c < 1; $c++) {  ?>
                          <td class='border_radiu_row_start'><?= $read_data[1] ?></td>
                          <td><?= $read_data[2] ?></td>
                          <td><?= $read_data[3] ?></td>
                          <td><?= $read_data[4] ?></td>
                          <td>
                            <p><?= $read_data[5] ?></p>
                          </td>
                          <td>
                            <p><?= $read_data[6] ?></p>
                          </td>
                          <td>
                            <p><?= $read_data[7] ?></p>
                          </td>
                          <td class='border_radiu_row_end'>
                            <p><?= $read_data[8] ?></p>
                          </td>
                      <?php }
                      } ?>
                    </tr>
                <?php }
                }
                fclose($csv_file);
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <?php
      $resto = $start_row - $cout_row;
      //echo 'Slide 2: ' . $resto;
      if (!empty($resto) && $resto > 0) {
      ?>

        <div class="carousel-item" data-bs-interval="<?= $intervalo ?>">
          <?php include '../includes/header.php'; ?>
          <div class="tabela">
            <?php include '../includes/data_cabula.php'; ?>
            <div class="table-responsive">
              <table class="table table-striped">
                <?php include '../includes/thead.php'; ?>
                <tbody>
                  <?php
                  $start_row = 0;
                  $csv_file = fopen($arquivo_cabula, "r");
                  while (($read_data = fgetcsv($csv_file, 0, ";")) !== false) {
                    $rowTime = $read_data[2]; // Assumes the time is in the first column

                    // CONVERTE O FORMATO DA DATA
                    $originalDate = $read_data[0];
                    $originalDate = str_replace("/", "-", $originalDate);
                    $timestamp = strtotime($originalDate);
                    $newDate = date("Y-m-d", $timestamp);

                    if ($rowTime >= $currentTime && $newDate == $dataAtual) {
                      $validRows[] = $read_data;
                  ?>
                      <tr valign="middle">
                        <?php $start_row++;
                        if ($start_row >= 13 && $start_row <= ($cout_row * 2)) {
                          for ($c = 0; $c < 1; $c++) {  ?>
                            <td class='border_radiu_row_start'><?= $read_data[1] ?></td>
                            <td><?= $read_data[2] ?></td>
                            <td><?= $read_data[3] ?></td>
                            <td><?= $read_data[4] ?></td>
                            <td>
                              <p><?= $read_data[5] ?></p>
                            </td>
                            <td>
                              <p><?= $read_data[6] ?></p>
                            </td>
                            <td>
                            <p><?= $read_data[7] ?></p>
                          </td>
                            <td class='border_radiu_row_end'>
                              <p><?= $read_data[8] ?></p>
                            </td>
                        <?php   }
                        } ?>
                      </tr>
                  <?php }
                  }
                  fclose($csv_file);
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      <?php } ?>

      <?php
      $resto = $start_row - ($cout_row * 2);
      if (!empty($resto) && $resto > 0) {
      ?>

        <div class="carousel-item" data-bs-interval="<?= $intervalo ?>">
          <?php include '../includes/header.php'; ?>
          <div class="tabela">
            <?php include '../includes/data_cabula.php'; ?>
            <div class="table-responsive">
              <table class="table table-striped">
                <?php include '../includes/thead.php'; ?>
                <tbody>
                  <?php
                  $start_row = 0;
                  $csv_file = fopen($arquivo_cabula, "r");
                  while (($read_data = fgetcsv($csv_file, 0, ";")) !== false) {
                    $rowTime = $read_data[2]; // Assumes the time is in the first column

                    // CONVERTE O FORMATO DA DATA
                    $originalDate = $read_data[0];
                    $originalDate = str_replace("/", "-", $originalDate);
                    $timestamp = strtotime($originalDate);
                    $newDate = date("Y-m-d", $timestamp);

                    if ($rowTime >= $currentTime && $newDate == $dataAtual) {
                      $validRows[] = $read_data;
                  ?>
                      <tr valign="middle">
                        <?php $start_row++;
                        if ($start_row >= 25 && $start_row <= ($cout_row * 3)) {
                          for ($c = 0; $c < 1; $c++) {  ?>
                            <td class='border_radiu_row_start'><?= $read_data[1] ?></td>
                            <td><?= $read_data[2] ?></td>
                            <td><?= $read_data[3] ?></td>
                            <td><?= $read_data[4] ?></td>
                            <td>
                              <p><?= $read_data[5] ?></p>
                            </td>
                            <td>
                              <p><?= $read_data[6] ?></p>
                            </td>
                            <td>
                            <p><?= $read_data[7] ?></p>
                          </td>
                            <td class='border_radiu_row_end'>
                              <p><?= $read_data[8] ?></p>
                            </td>
                        <?php   }
                        } ?>
                      </tr>
                  <?php   }
                  }
                  fclose($csv_file);
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      <?php } ?>


      <?php
      $resto = $start_row - ($cout_row * 3);
      if (!empty($resto) && $resto > 0) {
      ?>

        <div class="carousel-item" data-bs-interval="<?= $intervalo ?>">
          <?php include '../includes/header.php'; ?>
          <div class="tabela">
            <?php include '../includes/data_cabula.php'; ?>
            <div class="table-responsive">
              <table class="table table-striped">
                <?php include '../includes/thead.php'; ?>
                <tbody>
                  <?php
                  $start_row = 0;
                  $csv_file = fopen($arquivo_cabula, "r");
                  while (($read_data = fgetcsv($csv_file, 0, ";")) !== false) {
                    $rowTime = $read_data[2]; // Assumes the time is in the first column

                    // CONVERTE O FORMATO DA DATA
                    $originalDate = $read_data[0];
                    $originalDate = str_replace("/", "-", $originalDate);
                    $timestamp = strtotime($originalDate);
                    $newDate = date("Y-m-d", $timestamp);

                    if ($rowTime >= $currentTime && $newDate == $dataAtual) {
                      $validRows[] = $read_data;
                  ?>
                      <tr valign="middle">
                        <?php $start_row++;
                        if ($start_row >= 37 && $start_row <= ($cout_row * 4)) {
                          for ($c = 0; $c < 1; $c++) {  ?>
                            <td class='border_radiu_row_start'><?= $read_data[1] ?></td>
                            <td><?= $read_data[2] ?></td>
                            <td><?= $read_data[3] ?></td>
                            <td><?= $read_data[4] ?></td>
                            <td>
                              <p><?= $read_data[5] ?></p>
                            </td>
                            <td>
                              <p><?= $read_data[6] ?></p>
                            </td>
                            <td>
                            <p><?= $read_data[7] ?></p>
                          </td>
                            <td class='border_radiu_row_end'>
                              <p><?= $read_data[8] ?></p>
                            </td>
                        <?php   }
                        } ?>
                      </tr>
                  <?php }
                  }
                  fclose($csv_file);
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      <?php } ?>


      <?php
      $resto = $start_row - ($cout_row * 4);
      if (!empty($resto) && $resto > 0) {
      ?>

        <div class="carousel-item" data-bs-interval="<?= $intervalo ?>">
          <?php include '../includes/header.php'; ?>
          <div class="tabela">
            <?php include '../includes/data_cabula.php'; ?>
            <div class="table-responsive">
              <table class="table table-striped">
                <?php include '../includes/thead.php'; ?>
                <tbody>
                  <?php
                  $start_row = 0;
                  $csv_file = fopen($arquivo_cabula, "r");
                  while (($read_data = fgetcsv($csv_file, 0, ";")) !== false) {
                    $rowTime = $read_data[2]; // Assumes the time is in the first column

                    // CONVERTE O FORMATO DA DATA
                    $originalDate = $read_data[0];
                    $originalDate = str_replace("/", "-", $originalDate);
                    $timestamp = strtotime($originalDate);
                    $newDate = date("Y-m-d", $timestamp);

                    if ($rowTime >= $currentTime && $newDate == $dataAtual) {
                      $validRows[] = $read_data;
                  ?>
                      <tr valign="middle">
                        <?php $start_row++;
                        if ($start_row >= 49 && $start_row <= ($cout_row * 5)) {
                          for ($c = 0; $c < 1; $c++) {  ?>
                            <td class='border_radiu_row_start'><?= $read_data[1] ?></td>
                            <td><?= $read_data[2] ?></td>
                            <td><?= $read_data[3] ?></td>
                            <td><?= $read_data[4] ?></td>
                            <td>
                              <p><?= $read_data[5] ?></p>
                            </td>
                            <td>
                              <p><?= $read_data[6] ?></p>
                            </td>
                            <td>
                            <p><?= $read_data[7] ?></p>
                          </td>
                            <td class='border_radiu_row_end'>
                              <p><?= $read_data[8] ?></p>
                            </td>
                        <?php   }
                        } ?>
                      </tr>
                  <?php   }
                  }
                  fclose($csv_file);
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      <?php } ?>


      <?php
      $resto = $start_row - ($cout_row * 5);
      if (!empty($resto) && $resto > 0) {
      ?>

        <div class="carousel-item" data-bs-interval="<?= $intervalo ?>">
          <?php include '../includes/header.php'; ?>
          <div class="tabela">
            <?php include '../includes/data_cabula.php'; ?>
            <div class="table-responsive">
              <table class="table table-striped">
                <?php include '../includes/thead.php'; ?>
                <tbody>
                  <?php
                  $start_row = 0;
                  $csv_file = fopen($arquivo_cabula, "r");
                  while (($read_data = fgetcsv($csv_file, 0, ";")) !== false) {
                    $rowTime = $read_data[2]; // Assumes the time is in the first column

                    // CONVERTE O FORMATO DA DATA
                    $originalDate = $read_data[0];
                    $originalDate = str_replace("/", "-", $originalDate);
                    $timestamp = strtotime($originalDate);
                    $newDate = date("Y-m-d", $timestamp);

                    if ($rowTime >= $currentTime && $newDate == $dataAtual) {
                      $validRows[] = $read_data;
                  ?>
                      <tr valign="middle">
                        <?php $start_row++;
                        if ($start_row >= 61 && $start_row <= ($cout_row * 6)) {
                          for ($c = 0; $c < 1; $c++) {  ?>
                            <td class='border_radiu_row_start'><?= $read_data[1] ?></td>
                            <td><?= $read_data[2] ?></td>
                            <td><?= $read_data[3] ?></td>
                            <td><?= $read_data[4] ?></td>
                            <td>
                              <p><?= $read_data[5] ?></p>
                            </td>
                            <td>
                              <p><?= $read_data[6] ?></p>
                            </td>
                            <td>
                            <p><?= $read_data[7] ?></p>
                          </td>
                            <td class='border_radiu_row_end'>
                              <p><?= $read_data[8] ?></p>
                            </td>
                        <?php   }
                        } ?>
                      </tr>
                  <?php   }
                  }
                  fclose($csv_file);
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      <?php } ?>


      <?php
      $resto = $start_row - ($cout_row * 6);
      if (!empty($resto) && $resto > 0) {
      ?>

        <div class="carousel-item" data-bs-interval="<?= $intervalo ?>">
          <?php include '../includes/header.php'; ?>
          <div class="tabela">
            <?php include '../includes/data_cabula.php'; ?>
            <div class="table-responsive">
              <table class="table table-striped">
                <?php include '../includes/thead.php'; ?>
                <tbody>
                  <?php
                  $start_row = 0;
                  $csv_file = fopen($arquivo_cabula, "r");
                  while (($read_data = fgetcsv($csv_file, 0, ";")) !== false) {
                    $rowTime = $read_data[2]; // Assumes the time is in the first column

                    // CONVERTE O FORMATO DA DATA
                    $originalDate = $read_data[0];
                    $originalDate = str_replace("/", "-", $originalDate);
                    $timestamp = strtotime($originalDate);
                    $newDate = date("Y-m-d", $timestamp);

                    if ($rowTime >= $currentTime && $newDate == $dataAtual) {
                      $validRows[] = $read_data;
                  ?>
                      <tr valign="middle">
                        <?php $start_row++;
                        if ($start_row >= 73 && $start_row <= ($cout_row * 7)) {
                          for ($c = 0; $c < 1; $c++) {  ?>
                            <td class='border_radiu_row_start'><?= $read_data[1] ?></td>
                            <td><?= $read_data[2] ?></td>
                            <td><?= $read_data[3] ?></td>
                            <td><?= $read_data[4] ?></td>
                            <td>
                              <p><?= $read_data[5] ?></p>
                            </td>
                            <td>
                              <p><?= $read_data[6] ?></p>
                            </td>
                            <td>
                            <p><?= $read_data[7] ?></p>
                          </td>
                            <td class='border_radiu_row_end'>
                              <p><?= $read_data[8] ?></p>
                            </td>
                        <?php   }
                        } ?>
                      </tr>
                  <?php  }
                  }
                  fclose($csv_file);
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      <?php } ?>


      <?php
      $resto = $start_row - ($cout_row * 7);
      if (!empty($resto) && $resto > 0) {
      ?>

        <div class="carousel-item" data-bs-interval="<?= $intervalo ?>">
          <?php include '../includes/header.php'; ?>
          <div class="tabela">
            <?php include '../includes/data_cabula.php'; ?>
            <div class="table-responsive">
              <table class="table table-striped">
                <?php include '../includes/thead.php'; ?>
                <tbody>
                  <?php
                  $start_row = 0;
                  $csv_file = fopen($arquivo_cabula, "r");
                  while (($read_data = fgetcsv($csv_file, 0, ";")) !== false) {
                    $rowTime = $read_data[2]; // Assumes the time is in the first column

                    // CONVERTE O FORMATO DA DATA
                    $originalDate = $read_data[0];
                    $originalDate = str_replace("/", "-", $originalDate);
                    $timestamp = strtotime($originalDate);
                    $newDate = date("Y-m-d", $timestamp);

                    if ($rowTime >= $currentTime && $newDate == $dataAtual) {
                      $validRows[] = $read_data;
                  ?>
                      <tr valign="middle">
                        <?php $start_row++;
                        if ($start_row >= 85 && $start_row <= ($cout_row * 8)) {
                          for ($c = 0; $c < 1; $c++) {  ?>
                            <td class='border_radiu_row_start'><?= $read_data[1] ?></td>
                            <td><?= $read_data[2] ?></td>
                            <td><?= $read_data[3] ?></td>
                            <td><?= $read_data[4] ?></td>
                            <td>
                              <p><?= $read_data[5] ?></p>
                            </td>
                            <td>
                              <p><?= $read_data[6] ?></p>
                            </td>
                            <td>
                            <p><?= $read_data[7] ?></p>
                          </td>
                            <td class='border_radiu_row_end'>
                              <p><?= $read_data[8] ?></p>
                            </td>
                        <?php   }
                        } ?>
                      </tr>
                  <?php   }
                  }
                  fclose($csv_file);
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      <?php } ?>


      <?php
      $resto = $start_row - ($cout_row * 8);
      if (!empty($resto) && $resto > 0) {
      ?>

        <div class="carousel-item" data-bs-interval="<?= $intervalo ?>">
          <?php include '../includes/header.php'; ?>
          <div class="tabela">
            <?php include '../includes/data_cabula.php'; ?>
            <div class="table-responsive">
              <table class="table table-striped">
                <?php include '../includes/thead.php'; ?>
                <tbody>
                  <?php
                  $start_row = 0;
                  $csv_file = fopen($arquivo_cabula, "r");
                  while (($read_data = fgetcsv($csv_file, 0, ";")) !== false) {
                    $rowTime = $read_data[2]; // Assumes the time is in the first column

                    // CONVERTE O FORMATO DA DATA
                    $originalDate = $read_data[0];
                    $originalDate = str_replace("/", "-", $originalDate);
                    $timestamp = strtotime($originalDate);
                    $newDate = date("Y-m-d", $timestamp);

                    if ($rowTime >= $currentTime && $newDate == $dataAtual) {
                      $validRows[] = $read_data;
                  ?>
                      <tr valign="middle">
                        <?php $start_row++;
                        if ($start_row >= 97 && $start_row <= ($cout_row * 9)) {
                          for ($c = 0; $c < 1; $c++) {  ?>
                            <td class='border_radiu_row_start'><?= $read_data[1] ?></td>
                            <td><?= $read_data[2] ?></td>
                            <td><?= $read_data[3] ?></td>
                            <td><?= $read_data[4] ?></td>
                            <td>
                              <p><?= $read_data[5] ?></p>
                            </td>
                            <td>
                              <p><?= $read_data[6] ?></p>
                            </td>
                            <td>
                            <p><?= $read_data[7] ?></p>
                          </td>
                            <td class='border_radiu_row_end'>
                              <p><?= $read_data[8] ?></p>
                            </td>
                        <?php   }
                        } ?>
                      </tr>
                  <?php   }
                  }
                  fclose($csv_file);
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      <?php } ?>


      <?php
      $resto = $start_row - ($cout_row * 9);
      if (!empty($resto) && $resto > 0) {
      ?>

        <div class="carousel-item" data-bs-interval="<?= $intervalo ?>">
          <?php include '../includes/header.php'; ?>
          <div class="tabela">
            <?php include '../includes/data_cabula.php'; ?>
            <div class="table-responsive">
              <table class="table table-striped">
                <?php include '../includes/thead.php'; ?>
                <tbody>
                  <?php
                  $start_row = 0;
                  $csv_file = fopen($arquivo_cabula, "r");
                  while (($read_data = fgetcsv($csv_file, 0, ";")) !== false) {
                    $rowTime = $read_data[2]; // Assumes the time is in the first column

                    // CONVERTE O FORMATO DA DATA
                    $originalDate = $read_data[0];
                    $originalDate = str_replace("/", "-", $originalDate);
                    $timestamp = strtotime($originalDate);
                    $newDate = date("Y-m-d", $timestamp);

                    if ($rowTime >= $currentTime && $newDate == $dataAtual) {
                      $validRows[] = $read_data;
                  ?>
                      <tr valign="middle">
                        <?php $start_row++;
                        if ($start_row >= 109 && $start_row <= ($cout_row * 10)) {
                          for ($c = 0; $c < 1; $c++) {  ?>
                            <td class='border_radiu_row_start'><?= $read_data[1] ?></td>
                            <td><?= $read_data[2] ?></td>
                            <td><?= $read_data[3] ?></td>
                            <td><?= $read_data[4] ?></td>
                            <td>
                              <p><?= $read_data[5] ?></p>
                            </td>
                            <td>
                              <p><?= $read_data[6] ?></p>
                            </td>
                            <td>
                            <p><?= $read_data[7] ?></p>
                          </td>
                            <td class='border_radiu_row_end'>
                              <p><?= $read_data[8] ?></p>
                            </td>
                        <?php   }
                        } ?>
                      </tr>
                  <?php   }
                  }
                  fclose($csv_file);
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      <?php } ?>


      <?php
      $resto = $start_row - ($cout_row * 10);
      if (!empty($resto) && $resto > 0) {
      ?>

        <div class="carousel-item" data-bs-interval="<?= $intervalo ?>">
          <?php include '../includes/header.php'; ?>
          <div class="tabela">
            <?php include '../includes/data_cabula.php'; ?>
            <div class="table-responsive">
              <table class="table table-striped">
                <?php include '../includes/thead.php'; ?>
                <tbody>
                  <?php
                  $start_row = 0;
                  $csv_file = fopen($arquivo_cabula, "r");
                  while (($read_data = fgetcsv($csv_file, 0, ";")) !== false) {
                    $rowTime = $read_data[2]; // Assumes the time is in the first column

                    // CONVERTE O FORMATO DA DATA
                    $originalDate = $read_data[0];
                    $originalDate = str_replace("/", "-", $originalDate);
                    $timestamp = strtotime($originalDate);
                    $newDate = date("Y-m-d", $timestamp);

                    if ($rowTime >= $currentTime && $newDate == $dataAtual) {
                      $validRows[] = $read_data;
                  ?>
                      <tr valign="middle">
                        <?php $start_row++;
                        if ($start_row >= 121 && $start_row <= ($cout_row * 11)) {
                          for ($c = 0; $c < 1; $c++) {  ?>
                            <td class='border_radiu_row_start'><?= $read_data[1] ?></td>
                            <td><?= $read_data[2] ?></td>
                            <td><?= $read_data[3] ?></td>
                            <td><?= $read_data[4] ?></td>
                            <td>
                              <p><?= $read_data[5] ?></p>
                            </td>
                            <td>
                              <p><?= $read_data[6] ?></p>
                            </td>
                            <td>
                            <p><?= $read_data[7] ?></p>
                          </td>
                            <td class='border_radiu_row_end'>
                              <p><?= $read_data[8] ?></p>
                            </td>
                        <?php   }
                        } ?>
                      </tr>
                  <?php   }
                  }
                  fclose($csv_file);
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      <?php } ?>


      <?php
      $resto = $start_row - ($cout_row * 11);
      if (!empty($resto) && $resto > 0) {
      ?>

        <div class="carousel-item" data-bs-interval="<?= $intervalo ?>">
          <?php include '../includes/header.php'; ?>
          <div class="tabela">
            <?php include '../includes/data_cabula.php'; ?>
            <div class="table-responsive">
              <table class="table table-striped">
                <?php include '../includes/thead.php'; ?>
                <tbody>
                  <?php
                  $start_row = 0;
                  $csv_file = fopen($arquivo_cabula, "r");
                  while (($read_data = fgetcsv($csv_file, 0, ";")) !== false) {
                    $rowTime = $read_data[2]; // Assumes the time is in the first column

                    // CONVERTE O FORMATO DA DATA
                    $originalDate = $read_data[0];
                    $originalDate = str_replace("/", "-", $originalDate);
                    $timestamp = strtotime($originalDate);
                    $newDate = date("Y-m-d", $timestamp);

                    if ($rowTime >= $currentTime && $newDate == $dataAtual) {
                      $validRows[] = $read_data;
                  ?>
                      <tr valign="middle">
                        <?php $start_row++;
                        if ($start_row >= 133 && $start_row <= ($cout_row * 12)) {
                          for ($c = 0; $c < 1; $c++) {  ?>
                            <td class='border_radiu_row_start'><?= $read_data[1] ?></td>
                            <td><?= $read_data[2] ?></td>
                            <td><?= $read_data[3] ?></td>
                            <td><?= $read_data[4] ?></td>
                            <td>
                              <p><?= $read_data[5] ?></p>
                            </td>
                            <td>
                              <p><?= $read_data[6] ?></p>
                            </td>
                            <td>
                            <p><?= $read_data[7] ?></p>
                          </td>
                            <td class='border_radiu_row_end'>
                              <p><?= $read_data[8] ?></p>
                            </td>
                        <?php   }
                        } ?>
                      </tr>
                  <?php   }
                  }
                  fclose($csv_file);
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      <?php } ?>

      <!---------------------------------------------------------------------------------------------------------------------
        PUBLICIDADE 
        ----------------------------------------------------------------------------------------------------------------------->
      <div class="carousel-item" data-bs-interval="<?= $intervalo ?>">
        <div class="img_public"></div>
      </div>

    </div>
    <button class="carousel-control-prev d-none" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next d-none" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <script src="../../dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>