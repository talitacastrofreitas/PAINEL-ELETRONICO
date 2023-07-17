<?php
$data = date('D');
$mes = date('M');
$dia = date('d');
$ano = date('Y');

$semana = array(
  'Sun' => 'DOMINGO',
  'Mon' => 'SEGUNDA',
  'Tue' => 'TERÇA',
  'Wed' => 'QUARTA',
  'Thu' => 'QUINTA',
  'Fri' => 'SEXTA',
  'Sat' => 'SÁBADO'
);

$mes_extenso = array(
  'Jan' => 'JANEIRO',
  'Feb' => 'FEVEREIRO',
  'Mar' => 'MARÇO',
  'Apr' => 'ABRIL',
  'May' => 'MAIO',
  'Jun' => 'JUNHO',
  'Jul' => 'JULHO',
  'Aug' => 'AGOSTO',
  'Nov' => 'NOVEMBRO',
  'Sep' => 'SETEMBRO',
  'Oct' => 'OUTUBRO',
  'Dec' => 'DEZEMBRO'
);
?>

<div class="row d-flex align-items-center m-0">
  <div class="col-sm-12 text-center">
    <div class="day">
      <div class="data"><?= $semana["$data"] ?> <span class="data_all"><span class="data_dia"><?= $dia ?></span> <span class="data_dia"><?= $mes_extenso["$mes"] ?></span> <span class="data_dia"><?= $ano ?></span></span>BROTAS</div>
    </div>
  </div>
  <div class="col-sm-4 text-end">
    <?php include 'includes/nav.php'; ?>
  </div>
</div>