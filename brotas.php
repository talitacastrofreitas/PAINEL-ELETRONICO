<?php include 'includes/header.php'; ?>

<header>
  <div class="row m-0">
    <div class="col-md-11 text-left d-flex align-items-center">
      <img src="dist/img/logo_header.svg" alt="" class="img-fluid">
      <h1>ENCONTRE SUA SALA OU LABORATÓRIO</h1>
    </div>
    <div class="col-md-4 text-end text-md-start order-md-1 order-2 d-none"></div>
  </div>
</header>

<?php include 'includes/data_brotas.php'; ?>

<div class="table-responsive">
  <table id="tabela" class="table table-striped tabela display">
    <thead>
      <tr valign="middle" class="teste">
        <th colspan="2" scope="col" class="border_radiu_start_1 text-center">HORÁRIOS</th>
        <th scope="col" rowspan="2">CURSO / SETOR</th>
        <th scope="col" rowspan="2">SEMESTRE</th>
        <th scope="col" rowspan="2">COMPONENTE CURRICULAR / ATIVIDADE</th>
        <th scope="col" rowspan="2">PROFESSOR / SOLICITANTE</th>
        <th rowspan="2" scope="col" >SALA / LABORATÓRIO</th>
        <th rowspan="2" scope="col" class="border_radiu_end">MÓDULO</th>
      </tr>
      <tr>
        <th scope="col" class="border_radiu_start_4">INÍCIO</th>
        <th scope="col">FIM</th>
      </tr>
    </thead>
    <tbody>

      <?php
      clearstatcache(); // lIMPAR CACHE
      //$arquivo_cabula = 'http://vrgestaoempresarial.com.br/painel/files/arquivo_brotas.csv';
      $arquivo_cabula = 'files/arquivo_brotas.csv';

      $data = date('Y-m-d');
      $start_row = 0;
      $csv_file = fopen($arquivo_cabula, "r");
      while (($read_data = fgetcsv($csv_file, 0, ";")) !== false) {
        $rowTime = $read_data[1]; // Assumes the time is in the first column

        // CONVERTE O FORMATO DA DATA
        $originalDate = $read_data[0];
        $originalDate = str_replace("/", "-", $originalDate);
        $timestamp = strtotime($originalDate);
        $newDate = date("Y-m-d", $timestamp);

        if ($newDate == $data) {
          $validRows[] = $read_data;
      ?>
          <tr valign="middle">
            <?php
            $start_row++;

            //echo $start_row;
            for ($c = 0; $c < 1; $c++) {  ?>
              <td class='border_radiu_row_start'><?= $read_data[1] ?></td>
              <td><?= $read_data[2] ?></td>
              <td><?= $read_data[3] ?></td>
              <td><?= $read_data[4] ?></td>
              <td><?= $read_data[5] ?></td>
              <td><?= $read_data[6] ?></td>
              <td><?= $read_data[7] ?></td>
              <td class='border_radiu_row_end'><?= $read_data[8] ?></td>
            <?php }
            ?>
          </tr>
      <?php }
      }
      fclose($csv_file); ?>

    </tbody>
  </table>
</div>

<?php include 'includes/footer.php'; ?>