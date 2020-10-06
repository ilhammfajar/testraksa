<?php 
function curl($url){
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    $output = curl_exec($ch); 
    curl_close($ch);      
    return $output;
}

$send = curl("https://araksa.com/mks/afif/test.php");

// mengubah JSON menjadi array
$data = json_decode($send, TRUE);

// echo "<pre>";
// print_r($data);
// echo "</pre>";
// $kat = array();
// foreach ($data as $key => $value ) {
//     array_push($kat, $value[6]);
// }
// $arrcol = array_column($data, "sample_data");
// $arrjcod = json_encode($arrcol);

// echo $arrjcod;

// foreach ($data as $mdaKey => $mdaData) {
//     echo $mdaKey . ": " . $mdaData["value"];
// }
$smpl_data = $data['sample_data'];

// foreach ($smpl_data as $key) {
//    array_push($kat, $key['KATEGORI']);
//    if (isset($arr[$key['KATEGORI']])) {
//        # code...
//    }
// }
$arr = array();
$kat = array();
$unt = array();
$achly = array();
$tgachly = array();
$achty = array();
$tgachty = array();
foreach ($smpl_data as $key) {
    array_push($kat, $key['KATEGORI']);
    array_push($unt, $key['UNIT']);
    array_push($achly, $key['ACH_LAST_YEAR']);
    array_push($tgachly, $key['TGT_THIS_YEAR']);
    array_push($achty, $key['ACH_THIS_YEAR']);
    array_push($tgachty, $key['PCTG_THIS_YEAR']);

  if (!isset($arr[$key['KATEGORI']])) {
      $arr[$key['KATEGORI']]['rowspan'] = 0;
  }
  $arr[$key['KATEGORI']]['printed'] = 'no';
  $arr[$key['KATEGORI']]['rowspan'] += 1;
}
?>
<table class="table table-hover" border="1">
  <thead>
    <tr>
      <th>Kategori</th>
      <th><center>Unit</center></th>
      <th><center>Ach 2018</center></th>
      <th><center>Tgt 2019</center></th>
      <th><center>Ach 2019</center></th>
      <th><center>% Ach</center></th>
    </tr>
  </thead>
  <tbody>
    <?php
        for($i=0; $i < sizeof($kat); $i++) {
            $kategori = $kat[$i];
            ?>
            <tr>
            <?php
            if ($arr[$kategori]['printed'] == 'no') {
                echo "<td rowspan='".$arr[$kategori]['rowspan']."'>".$kategori."</td>";
                $arr[$kategori]['printed'] = 'yes';
            }
            ?>
            <td><?php echo $unt[$i]; ?></td>
            <td><?php echo $achly[$i]; ?></td>
            <td><?php echo $tgachly[$i]; ?></td>
            <td><?php echo $achty[$i]; ?></td>
            <td><?php echo $tgachty[$i]; ?></td>
            <?php
        }

    ?>

  </tbody>
</table>

<?php

// print_r($data['sample_data']);
// foreach ($data as $key => $story){
//     if(is_array($story)){
//         foreach($story as $subkey => $subvalue){
//             if(is_array($subvalue)){
//                 foreach($subvalue as $key => $subsubvalue){
//                     echo $subsubvalue."<br />";
//                 }
//             } else {
//                 echo $subvalue."<br />";
//             }
//         }
//     } else {
//         echo $story."<br />";
//     }
// }


?>