<?php
$data = date('D');
$mes = date('M');
$dia = date('d');
$ano = date('Y');

$semana = array(
  'Sun' => 'DOMINGO',
  'Mon' => 'SEGUNDA-FEIRA',
  'Tue' => 'TERÇA-FEIRA',
  'Wed' => 'QUARTA-FEIRA',
  'Thu' => 'QUINTA-FEIRA',
  'Fri' => 'SEXTA-FEIRA',
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

<div class="day text-center">
  <div class="data"><?= $semana["$data"] ?> <span class="data_all"><span class="data_dia"><?= $dia ?></span> <span class="data_dia"><?= $mes_extenso["$mes"] ?></span> <span class="data_dia"><?= $ano ?></span></span>BROTAS</div>
</div>