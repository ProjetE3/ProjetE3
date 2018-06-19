<html>
<body>
  <div class="gauche" style="float:left; width:50%">
  <?php
  echo "INSERT INTO energie(EnerCons,DateHeureMinute,IdLumiere,IdChauffage,IdElectro) VALUES<br/>";
  for($k=0;$k<1;$k++){
  for($j=0;$j<=35;$j++){
  for($i=0;$i<=59;$i++){
    $i2=rand(0,rand(0,12));
    $i1=rand(0,rand(0,12));
    $i3=rand( 0,rand(0,12));
    echo
    "(".$i1*0.0338*0.00125.",'2018-06-01 0".$k.":0".$j.":0".$i."',NULL,1,NULL),<br/>(".$i2*0.0338*0.00125.",'2018-06-01 0".$k.":0".$j.":0".$i."',NULL,2,NULL),<br/>(".$i3*0.0338*0.00125.",'2018-06-01 0".$k.":0".$j.":0".$i."',NULL,3,NULL),<br/>";
    $i2=rand(0,rand(0,30));
    $i1=rand(0,rand(0,30));
    $i3=rand( 0,rand(0,30));
    echo
    "(".$i1*0.0001*0.001.",'2018-06-01 0".$k.":0".$j.":0".$i."',1,NULL,NULL),<br/>(".$i2*0.0001*0.001.",'2018-06-01 0".$k.":0".$j.":0".$i."',2,NULL,NULL),<br/>(".$i3*0.0001*0.001.",'2018-06-01 0".$k.":0".$j.":0".$i."',3,NULL,NULL),<br/>";
    $i2=rand(0,rand(0,4));
    $i1=rand(0,rand(0,4));
    $i3=rand( 0,rand(0,4));
    echo
    "(".$i1*0.0335*0.001.",'2018-06-01 0".$k.":0".$j.":0".$i."',NULL,NULL,1),<br/>(".$i2*0.0335*0.001.",'2018-06-01 0".$k.":0".$j.":0".$i."',NULL,NULL,2),<br/>(".$i3*0.0335*0.001.",'2018-06-01 0".$k.":0".$j.":0".$i."',NULL,NULL,3),<br/>";
  }}}
  ?>
</div>
<div class="droite" style="float:right; width:50%">
<?php
echo "INSERT INTO scores(Score,DateHeureMinute,IdUtil,IdPiece,IdMaison) VALUES<br/>";
for($k=0;$k<1;$k++){
for($j=0;$j<=35;$j++){
for($i=0;$i<=59;$i++){
  $i2=rand(60,rand(80,100));
  $i1=rand(50,rand(70,100));
  $i3=rand(80,rand(90,100));
  echo
  "
  (".$i1.",'2018-06-01 0".$k.":0".$j.":0".$i."','admin',1,1),<br/>
  (".$i2.",'2018-06-01 0".$k.":0".$j.":0".$i."','admin',2,1),<br/>
  (".$i3.",'2018-06-01 0".$k.":0".$j.":0".$i."','admin',3,1),<br/>";
  }}}
?>
</div>
  </ body>
  </html>
