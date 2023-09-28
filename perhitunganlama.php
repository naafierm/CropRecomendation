
<link href="css/perhitungan.css" rel="stylesheet">

<div class="container">
<div class="panel panel-primary">
<div class="panel-heading"><strong>PERHITUNGAN</strong></div>
<div class="panel-body" style=" border: 1px solid #e7e7e7;">
<div class="panel panel-default">
<div class="panel-heading"><strong>Aspek Kecerdasan</strong></div>
<div class="table-responsive">
<table class="table  table-striped table-hover" style="border: 0px;">
<tbody> <tr>
                    <th>Nama Tanaman Pangan</th>
                    <th>A1</th>
                    <th>A2</th>
                    <th>A3</th>
                  </tr>
                  <?php
                    $query = "SELECT mp.id_pelamar,mp.nama_pelamar,pm.A1,pm.A2,pm.A3 FROM master_pelamar mp left JOIN (SELECT * FROM( select id_pelamar,sum( if(id_faktor=1,value,0) ) as 'A1',sum( if(id_faktor=2,value,0) ) as 'A2',sum( if(id_faktor=3,value,0) ) as 'A3' from pm_sample group by id_pelamar)tbl) pm on mp.id_pelamar =pm.id_pelamar";
                    //$query ="select * from master_pelamar";
                    $sql = mysqli_query($koneksi, $query);
                    if(mysqli_num_rows($sql) > 0){
                    while($row = mysqli_fetch_array($sql)){
                  ?>
                  <tr>
                    <td><?php echo $row['nama_pelamar'];?></td>
                    <td>
                      <?php echo $row['A1'];?>

                    </td>
                    <td>
                      <?php echo $row['A2'];?>
                    </td>
                    <td>
                        <?php echo $row['A3'];?>
                    </td>
                  </tr>
                  <?php
                    }
                  }
                  ?>

</tbody><tfoot><tr>
<th>Nilai Kriteria</th>
<td class="text-primary"><?php echo cari_nilai("select target as nilai from pm_faktor where id_faktor=1");?></td>
<td class="text-primary"><?php echo cari_nilai("select target as nilai from pm_faktor where id_faktor=2");?></td>
<td class="text-primary"><?php echo cari_nilai("select target as nilai from pm_faktor where id_faktor=3");?></td>
</tr></tfoot>
</table>
</div>
<div class="panel-body">Perhitungan pemetaan gap <strong></strong>:</div>
<div class="table-responsive">
<table class="table  table-striped table-hover" style="border: 0px;">
<tbody> <tr>
                    <th>Nama Tanaman Pangan</th>
                    <th>A1</th>
                    <th>A2</th>
                    <th>A3</th>
                  </tr>
                  <?php
                    $query = "SELECT mp.id_pelamar,mp.nama_pelamar,pm.A1,pm.A2,pm.A3 FROM master_pelamar mp left JOIN (SELECT * FROM( select id_pelamar,sum( if(id_faktor=1,value,0) ) as 'A1',sum( if(id_faktor=2,value,0) ) as 'A2',sum( if(id_faktor=3,value,0) ) as 'A3' from pm_sample group by id_pelamar)tbl) pm on mp.id_pelamar =pm.id_pelamar";
                    //$query ="select * from master_pelamar";
                    $sql = mysqli_query($koneksi, $query);
                    $value1 =cari_nilai("select target as nilai from pm_faktor where id_faktor=1");
                    $value2 =cari_nilai("select target as nilai from pm_faktor where id_faktor=2");
                    $value3 =cari_nilai("select target as nilai from pm_faktor where id_faktor=3");
                    if(mysqli_num_rows($sql) > 0){
                    while($row = mysqli_fetch_array($sql)){
                      $gap=array();

                  ?>
                  <tr>
                    <td><?php echo $row['nama_pelamar'];?></td>
                    <td>
                      <?php echo $gap[$row['id_pelamar']] = $row['A1']-$value1;?>

                    </td>
                    <td>
                      <?php echo $gap[$row['id_pelamar']] = $row['A2']-$value2;?>
                    </td>
                    <td>
                        <?php echo $gap[$row['id_pelamar']] = $row['A3']-$value3;?>
                    </td>
                  </tr>
                  <?php
                    }
                  }
                  ?>

</tbody>
</table>
</div>
<div class="panel-body">Pembobotan nilai gap <strong></strong>:</div>
<div class="table-responsive">
<table class="table  table-striped table-hover" style="border: 0px;">
<tbody> <tr>
                    <th>Nama Tanaman Pangan</th>
                    <th>A1</th>
                    <th>A2</th>
                    <th>A3</th>
                  </tr>
                  <?php
                    $query = "SELECT mp.id_pelamar,mp.nama_pelamar,pm.A1,pm.A2,pm.A3 FROM master_pelamar mp left JOIN (SELECT * FROM( select id_pelamar,sum( if(id_faktor=1,value,0) ) as 'A1',sum( if(id_faktor=2,value,0) ) as 'A2',sum( if(id_faktor=3,value,0) ) as 'A3' from pm_sample group by id_pelamar)tbl) pm on mp.id_pelamar =pm.id_pelamar";
                    //$query ="select * from master_pelamar";
                    $sql = mysqli_query($koneksi, $query);
                    $value1 =cari_nilai("select target as nilai from pm_faktor where id_faktor=1");
                    $value2 =cari_nilai("select target as nilai from pm_faktor where id_faktor=2");
                    $value3 =cari_nilai("select target as nilai from pm_faktor where id_faktor=3");
                    if(mysqli_num_rows($sql) > 0){
                    while($row = mysqli_fetch_array($sql)){
                      $terbobot=array();

                      $bobot1 = $row['A1']-$value1;
                      $query1 ="select * from pm_bobot where selisih = ".$bobot1."";
                      $sql1 = mysqli_query($koneksi, $query1);
                      $row1 = mysqli_fetch_array($sql1);

                      $bobot2 = $row['A2']-$value2;
                      $query2 ="select * from pm_bobot where selisih = ".$bobot2."";
                      $sql2 = mysqli_query($koneksi, $query2);
                      $row2 = mysqli_fetch_array($sql2);

                      $bobot3 = $row['A3']-$value3;
                      $query3 ="select * from pm_bobot where selisih = ".$bobot3."";
                      $sql3 = mysqli_query($koneksi, $query3);
                      $row3 = mysqli_fetch_array($sql3);

                  ?>
                  <tr>
                    <td><?php echo $row['nama_pelamar'];?></td>
                    <td>

                      <?php echo $terbobot[$row['id_pelamar']] = $row1['bobot']?>

                    </td>
                    <td>
                      <?php echo $terbobot[$row['id_pelamar']] = $row2['bobot']?>
                    </td>
                    <td>
                        <?php echo $terbobot[$row['id_pelamar']] = $row3['bobot']?>
                    </td>
                  </tr>
                  <?php
                    }
                  }
                  ?>

</tbody>
</table>
</div>
<div class="panel-body">Perhitungan factor <strong></strong>:</div>
<div class="table-responsive">
<table class="table  table-striped table-hover" style="border: 0px;">
<tbody> <tr>
                    <th>Nama Tanaman Pangan</th>
                    <th>A1</th>
                    <th>A2</th>
                    <th>A3</th>
                    <th>NCF</th>
                    <th>NSF</th>
                    <th>Total</th>
                  </tr>
                  <?php
                    $query = "SELECT mp.id_pelamar,mp.nama_pelamar,pm.A1,pm.A2,pm.A3 FROM master_pelamar mp left JOIN (SELECT * FROM( select id_pelamar,sum( if(id_faktor=1,value,0) ) as 'A1',sum( if(id_faktor=2,value,0) ) as 'A2',sum( if(id_faktor=3,value,0) ) as 'A3' from pm_sample group by id_pelamar)tbl) pm on mp.id_pelamar =pm.id_pelamar";
                    //$query ="select * from master_pelamar";
                    $sql = mysqli_query($koneksi, $query);
                    $value1 =cari_nilai("select target as nilai from pm_faktor where id_faktor=1");
                    $value2 =cari_nilai("select target as nilai from pm_faktor where id_faktor=2");
                    $value3 =cari_nilai("select target as nilai from pm_faktor where id_faktor=3");
                    if(mysqli_num_rows($sql) > 0){
                    while($row = mysqli_fetch_array($sql)){
                      $terbobot=array();

                      $bobot1 = $row['A1']-$value1;
                      $query1 ="select * from pm_bobot where selisih = ".$bobot1."";
                      $sql1 = mysqli_query($koneksi, $query1);
                      $row1 = mysqli_fetch_array($sql1);

                      $bobot2 = $row['A2']-$value2;
                      $query2 ="select * from pm_bobot where selisih = ".$bobot2."";
                      $sql2 = mysqli_query($koneksi, $query2);
                      $row2 = mysqli_fetch_array($sql2);

                      $bobot3 = $row['A3']-$value3;
                      $query3 ="select * from pm_bobot where selisih = ".$bobot3."";
                      $sql3 = mysqli_query($koneksi, $query3);
                      $row3 = mysqli_fetch_array($sql3);

                      $core_persen =cari_nilai("select bobot_core as nilai from pm_aspek where id_aspek=1");
                      $secondary_persen = cari_nilai("select bobot_secondary as nilai from pm_aspek where id_aspek=1");

                  ?>
                  <tr>
                    <td><?php echo $row['nama_pelamar'];?></td>
                    <td>

                      <?php echo $terbobot[$row['id_pelamar']] = $row1['bobot']?>

                    </td>
                    <td>
                      <?php echo $terbobot[$row['id_pelamar']] = $row2['bobot']?>
                    </td>
                    <td>
                        <?php echo $terbobot[$row['id_pelamar']] = $row3['bobot']?>
                    </td>
                    <td>
                       <?php echo $terbobot[$row['id_pelamar']] = ($row1['bobot']+$row2['bobot']+$row3['bobot'])/2?>
                    </td>
                    <td>
                       <?php echo $terbobot[$row['id_pelamar']] = 0//($row2['bobot']+$row4['bobot'])/2?>
                    </td>
                    <td class="text-primary">
                       <?php //echo $terbobot[$row['id_pelamar']] = ($core_persen*(($row1['bobot']+$row3['bobot'])/2)/100)+($secondary_persen*(($row2['bobot']+$row4['bobot'])/2)/100)?>
                       <?php echo $terbobot[$row['id_pelamar']] = ($core_persen*(($row1['bobot']+$row2['bobot']+$row3['bobot'])/3)/100)?>
                    </td>

                  </tr>
                  <?php
                    }
                  }
                  ?>
                  <tr>
                  <td></td>
                  <td class="text-primary"><?php echo cari_nilai("select type as nilai from pm_faktor where id_faktor=1");?></td>
                  <td class="text-primary"><?php echo cari_nilai("select type as nilai from pm_faktor where id_faktor=2");?></td>
                  <td class="text-primary"><?php echo cari_nilai("select type as nilai from pm_faktor where id_faktor=3");?></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  </tr>

</tbody>
</table>
</div>
</div>
<div class="panel panel-default">
<div class="panel-heading"><strong>Aspek Wawancara</strong></div>
<div class="table-responsive">
<table class="table  table-striped table-hover" style="border: 0px;">
<tbody> <tr>
                    <th>Nama Tanaman Pangan</th>
                    <th>A4</th>
                    <th>A5</th>
                    <th>A6</th>
                    <th>A7</th>
                    
                  </tr>
                  <?php
                    $query = "SELECT mp.id_pelamar,mp.nama_pelamar,pm.A4,pm.A5,pm.A6,pm.A7 FROM master_pelamar mp left JOIN (SELECT * FROM( select id_pelamar,sum( if(id_faktor=4,value,0) ) as 'A4',sum( if(id_faktor=5,value,0) ) as 'A5',sum( if(id_faktor=6,value,0) ) as 'A6',sum( if(id_faktor=7,value,0) ) as 'A7' from pm_sample group by id_pelamar)tbl) pm on mp.id_pelamar =pm.id_pelamar";
                    //$query ="select * from master_pelamar";
                    $sql = mysqli_query($koneksi, $query);
                    if(mysqli_num_rows($sql) > 0){
                    while($row = mysqli_fetch_array($sql)){
                  ?>
                  <tr>
                    <td><?php echo $row['nama_pelamar'];?></td>
                    <td>
                      <?php echo $row['A4'];?>
                    </td>
                    <td>
                      <?php echo $row['A5'];?>
                    </td>
                    <td>
                      <?php echo $row['A6'];?>
                    </td>
                    <td>
                        <?php echo $row['A7'];?>
                    </td>
                    
                  </tr>
                  <?php
                    }
                  }
                  ?>

</tbody><tfoot><tr>
<th>Nilai Kriteria</th>
<td class="text-primary"><?php echo cari_nilai("select target as nilai from pm_faktor where id_faktor=4");?></td>
<td class="text-primary"><?php echo cari_nilai("select target as nilai from pm_faktor where id_faktor=5");?></td>
<td class="text-primary"><?php echo cari_nilai("select target as nilai from pm_faktor where id_faktor=6");?></td>
<td class="text-primary"><?php echo cari_nilai("select target as nilai from pm_faktor where id_faktor=7");?></td>
</tr></tfoot>
</table>
</div>
<div class="panel-body">Perhitungan pemetaan gap <strong></strong>:</div>
<div class="table-responsive">
<table class="table  table-striped table-hover" style="border: 0px;">
<tbody> <tr>
                    <th>Nama Tanaman Pangan</th>
                    <th>A4</th>
                    <th>A5</th>
                    <th>A6</th>
                    <th>A7</th>
                  </tr>
                  <?php
                    $query = "SELECT mp.id_pelamar,mp.nama_pelamar,pm.A4,pm.A5,pm.A6,pm.A7 FROM master_pelamar mp left JOIN (SELECT * FROM( select id_pelamar,sum( if(id_faktor=4,value,0) ) as 'A4',sum( if(id_faktor=5,value,0) ) as 'A5',sum( if(id_faktor=6,value,0) ) as 'A6',sum( if(id_faktor=7,value,0) ) as 'A7' from pm_sample group by id_pelamar)tbl) pm on mp.id_pelamar =pm.id_pelamar";
                    //$query ="select * from master_pelamar";
                    $sql = mysqli_query($koneksi, $query);
                    $value4 =cari_nilai("select target as nilai from pm_faktor where id_faktor=4");
                    $value5 =cari_nilai("select target as nilai from pm_faktor where id_faktor=5");
                    $value6 =cari_nilai("select target as nilai from pm_faktor where id_faktor=6");
                    $value7 =cari_nilai("select target as nilai from pm_faktor where id_faktor=7");
                    if(mysqli_num_rows($sql) > 0){
                    while($row = mysqli_fetch_array($sql)){
                      $gap=array();

                  ?>
                  <tr>
                    <td><?php echo $row['nama_pelamar'];?></td>
                    <td>
                       <?php echo $gap[$row['id_pelamar']] = $row['A4']-$value4;?>
                    </td>
                    <td>
                      <?php echo $gap[$row['id_pelamar']] = $row['A5']-$value5;?>

                    </td>
                    <td>
                      <?php echo $gap[$row['id_pelamar']] = $row['A6']-$value6;?>
                    </td>
                    <td>
                        <?php echo $gap[$row['id_pelamar']] = $row['A7']-$value7;?>
                    </td>
                  </tr>
                  <?php
                    }
                  }
                  ?>

</tbody>
</table>
</div>
<div class="panel-body">Pembobotan nilai gap <strong></strong>:</div>
<div class="table-responsive">
<table class="table  table-striped table-hover" style="border: 0px;">
<tbody> <tr>
                    <th>Nama Tanaman Pangan</th>
                    <th>A4</th>
                    <th>A5</th>
                    <th>A6</th>
                    <th>A7</th>
                  </tr>
                  <?php
                    $query = "SELECT mp.id_pelamar,mp.nama_pelamar,pm.A4,pm.A5,pm.A6,pm.A7 FROM master_pelamar mp left JOIN (SELECT * FROM( select id_pelamar,sum( if(id_faktor=4,value,0) ) as 'A4',sum( if(id_faktor=5,value,0) ) as 'A5',sum( if(id_faktor=6,value,0) ) as 'A6',sum( if(id_faktor=7,value,0) ) as 'A7' from pm_sample group by id_pelamar)tbl) pm on mp.id_pelamar =pm.id_pelamar";
                    //$query ="select * from master_pelamar";
                    $sql = mysqli_query($koneksi, $query);
                    
                    $value4 =cari_nilai("select target as nilai from pm_faktor where id_faktor=4");
                    $value5 =cari_nilai("select target as nilai from pm_faktor where id_faktor=5");
                    $value6 =cari_nilai("select target as nilai from pm_faktor where id_faktor=6");
                    $value7 =cari_nilai("select target as nilai from pm_faktor where id_faktor=7");
                    if(mysqli_num_rows($sql) > 0){
                    while($row = mysqli_fetch_array($sql)){
                      $terbobot=array();

                      $bobot4 = $row['A4']-$value4;
                      $query4 ="select * from pm_bobot where selisih = ".$bobot4."";
                      $sql4 = mysqli_query($koneksi, $query4);
                      $row4 = mysqli_fetch_array($sql4);

                      $bobot5 = $row['A5']-$value5;
                      $query5 ="select * from pm_bobot where selisih = ".$bobot5."";
                      $sql5 = mysqli_query($koneksi, $query5);
                      $row5 = mysqli_fetch_array($sql5);

                      $bobot6 = $row['A6']-$value6;
                      $query6 ="select * from pm_bobot where selisih = ".$bobot6."";
                      $sql6 = mysqli_query($koneksi, $query6);
                      $row6 = mysqli_fetch_array($sql6);

                      $bobot7 = $row['A7']-$value7;
                      $query7 ="select * from pm_bobot where selisih = ".$bobot7."";
                      $sql7 = mysqli_query($koneksi, $query7);
                      $row7 = mysqli_fetch_array($sql7);

                      


                  ?>
                  <tr>
                    <td><?php echo $row['nama_pelamar'];?></td>
                    
                    <td>
                       <?php echo $terbobot[$row['id_pelamar']] = $row4['bobot']?>
                    </td>
                    <td>
                      <?php echo $terbobot[$row['id_pelamar']] = $row5['bobot']?>
                    </td>
                    <td>
                      <?php echo $terbobot[$row['id_pelamar']] = $row6['bobot']?>
                    </td>
                    <td>
                        <?php echo $terbobot[$row['id_pelamar']] = $row7['bobot']?>
                    </td>
                  </tr>
                  <?php
                    }
                  }
                  ?>

</tbody>
</table>
</div>
<div class="panel-body">Perhitungan factor <strong></strong>:</div>
<div class="table-responsive">
<table class="table  table-striped table-hover" style="border: 0px;">
<tbody> <tr>
                    <th>Nama Tanaman Pangan</th>
                    
                    <th>A4</th>
                    <th>A5</th>
                    <th>A6</th>
                    <th>A7</th>
                    <th>NCF</th>
                    <th>NSF</th>
                    <th>Total</th>
                  </tr>
                  <?php
                    $query = "SELECT mp.id_pelamar,mp.nama_pelamar,pm.A4,pm.A5,pm.A6,pm.A7 FROM master_pelamar mp left JOIN (SELECT * FROM( select id_pelamar,sum( if(id_faktor=4,value,0) ) as 'A4',sum( if(id_faktor=5,value,0) ) as 'A5',sum( if(id_faktor=6,value,0) ) as 'A6',sum( if(id_faktor=7,value,0) ) as 'A7' from pm_sample group by id_pelamar)tbl) pm on mp.id_pelamar =pm.id_pelamar";
                    //$query ="select * from master_pelamar";
                    $sql = mysqli_query($koneksi, $query);
                    $value4 =cari_nilai("select target as nilai from pm_faktor where id_faktor=4");
                    $value5 =cari_nilai("select target as nilai from pm_faktor where id_faktor=5");
                    $value6 =cari_nilai("select target as nilai from pm_faktor where id_faktor=6");
                    $value7 =cari_nilai("select target as nilai from pm_faktor where id_faktor=7");
                    if(mysqli_num_rows($sql) > 0){
                    while($row = mysqli_fetch_array($sql)){
                      $terbobot=array();

                      $bobot4 = $row['A4']-$value4;
                      $query4 ="select * from pm_bobot where selisih = ".$bobot4."";
                      $sql8 = mysqli_query($koneksi, $query4);
                      $row8 = mysqli_fetch_array($sql4);

                      $bobot5 = $row['A5']-$value5;
                      $query5 ="select * from pm_bobot where selisih = ".$bobot5."";
                      $sql5 = mysqli_query($koneksi, $query5);
                      $row5 = mysqli_fetch_array($sql5);

                      $bobot6 = $row['A6']-$value6;
                      $query6 ="select * from pm_bobot where selisih = ".$bobot6."";
                      $sql6 = mysqli_query($koneksi, $query6);
                      $row6 = mysqli_fetch_array($sql6);

                      $bobot7 = $row['A7']-$value7;
                      $query7 ="select * from pm_bobot where selisih = ".$bobot7."";
                      $sql7 = mysqli_query($koneksi, $query7);
                      $row7 = mysqli_fetch_array($sql7);

                      $core_persen =cari_nilai("select bobot_core as nilai from pm_aspek where id_aspek=2");
                      $secondary_persen = cari_nilai("select bobot_secondary as nilai from pm_aspek where id_aspek=2");  


                  ?>
                  <tr>
                    <td><?php echo $row['nama_pelamar'];?></td>
                     <td>
                       <?php echo $terbobot[$row['id_pelamar']] = $row4['bobot']?>
                    </td><td>

                      <?php echo $terbobot[$row['id_pelamar']] = $row5['bobot']?>

                    </td>
                    <td>
                      <?php echo $terbobot[$row['id_pelamar']] = $row6['bobot']?>
                    </td>
                    <td>
                        <?php echo $terbobot[$row['id_pelamar']] = $row7['bobot']?>
                    </td>

                    <td>
                       <?php echo 0;//$terbobot[$row['id_pelamar']] = ($row5['bobot']+$row7['bobot'])/2?>
                    </td>
                    <td>
                       <?php echo $terbobot[$row['id_pelamar']] = ($row4['bobot']+$row5['bobot']+$row6['bobot']+$row7['bobot'])/4?>
                    </td>
                    <td class="text-primary">
                       <?php echo $terbobot[$row['id_pelamar']] = (($secondary_persen*(($row4['bobot']+$row5['bobot']+$row6['bobot']+$row7['bobot'])/4)/100));?>
                    </td>

                  </tr>
                  <?php
                    }
                  }
                  ?>
                  <tr>
                  <td></td>
                  <td class="text-primary"><?php echo cari_nilai("select type as nilai from pm_faktor where id_faktor=4");?></td>
                  <td class="text-primary"><?php echo cari_nilai("select type as nilai from pm_faktor where id_faktor=5");?></td>
                  <td class="text-primary"><?php echo cari_nilai("select type as nilai from pm_faktor where id_faktor=6");?></td>
                  <td class="text-primary"><?php echo cari_nilai("select type as nilai from pm_faktor where id_faktor=7");?></td>
                  
                  <td></td>
                  <td></td>
                  <td></td>
                  </tr>

</tbody>
</table>
</div>
</div>
</div>
</div>
<div id ="cetak">
<div class="panel panel-primary">
<div class="panel-heading"><strong>Hasil Akhir</strong></div>
<div class="panel-body" style=" border: 1px solid #e7e7e7;">
<div class="panel panel-default">
<div class="panel-body">
</div>
<div class="table-responsive">
<table class="table  table-striped table-hover">
<tbody><tr>
<th>Nama Tanaman Pangan</th>
<th>Aspek Kecerdasan</th>
 <th>Aspek Wawancara</th>
<th>Total</th>
<th>Rank</th>
</tr>
<tr>
<td>Persentase</td>
<td><?php echo cari_nilai("select Prosentase as nilai from pm_aspek where id_aspek=1");?>%</td>
<td><?php echo cari_nilai("select Prosentase as nilai from pm_aspek where id_aspek=2");?>%</td>
<td></td>
<td></td>
</tr>
<?php
                    $query = "SELECT mp.id_pelamar,mp.nama_pelamar,pm.A1,pm.A2,pm.A3,pm.A4,pm.A5,pm.A6,pm.A7 FROM master_pelamar mp left JOIN (SELECT * FROM( select id_pelamar,sum( if(id_faktor=1,value,0) ) as 'A1',sum( if(id_faktor=2,value,0) ) as 'A2',sum( if(id_faktor=3,value,0) ) as 'A3',sum( if(id_faktor=4,value,0) ) as 'A4',sum( if(id_faktor=5,value,0) ) as 'A5',sum( if(id_faktor=6,value,0) ) as 'A6',sum( if(id_faktor=7,value,0) ) as 'A7' from pm_sample group by id_pelamar)tbl) pm on mp.id_pelamar =pm.id_pelamar";
                    //$query ="select * from master_pelamar";
                    $sql = mysqli_query($koneksi, $query);
                    $value1 =cari_nilai("select target as nilai from pm_faktor where id_faktor=1");
                    $value2 =cari_nilai("select target as nilai from pm_faktor where id_faktor=2");
                    $value3 =cari_nilai("select target as nilai from pm_faktor where id_faktor=3");
                    $value4 =cari_nilai("select target as nilai from pm_faktor where id_faktor=4");
                    $value5 =cari_nilai("select target as nilai from pm_faktor where id_faktor=5");
                    $value6 =cari_nilai("select target as nilai from pm_faktor where id_faktor=6");
                    $value7 =cari_nilai("select target as nilai from pm_faktor where id_faktor=7");
                    $persen_1 = cari_nilai("select Prosentase as nilai from pm_aspek where id_aspek=1");
                    $persen_2 = cari_nilai("select Prosentase as nilai from pm_aspek where id_aspek=2");
                    if(mysqli_num_rows($sql) > 0){
                    while($row = mysqli_fetch_array($sql)){
					  
                      $terbobot1=array();
                      $terbobot2=array();
                      $terbobot_total=array();
					  
                      $bobot1 = $row['A1']-$value1;
                      $query1 ="select * from pm_bobot where selisih = ".$bobot1."";
                      $sql1 = mysqli_query($koneksi, $query1);
                      $row1 = mysqli_fetch_array($sql1);

                      $bobot2 = $row['A2']-$value2;
                      $query2 ="select * from pm_bobot where selisih = ".$bobot2."";
                      $sql2 = mysqli_query($koneksi, $query2);
                      $row2 = mysqli_fetch_array($sql2);

                      $bobot3 = $row['A3']-$value3;
                      $query3 ="select * from pm_bobot where selisih = ".$bobot3."";
                      $sql3 = mysqli_query($koneksi, $query3);
                      $row3 = mysqli_fetch_array($sql3);

                      $bobot4 = $row['A4']-$value4;
                      $query4 ="select * from pm_bobot where selisih = ".$bobot4."";
                      $sql4 = mysqli_query($koneksi, $query4);
                      $row4 = mysqli_fetch_array($sql4);

                      $bobot5 = $row['A5']-$value5;
                      $query5 ="select * from pm_bobot where selisih = ".$bobot5."";
                      $sql5 = mysqli_query($koneksi, $query5);
                      $row5 = mysqli_fetch_array($sql5);

                      $bobot6 = $row['A6']-$value6;
                      $query6 ="select * from pm_bobot where selisih = ".$bobot6."";
                      $sql6 = mysqli_query($koneksi, $query6);
                      $row6 = mysqli_fetch_array($sql6);

                      $bobot7 = $row['A7']-$value7;
                      $query7 ="select * from pm_bobot where selisih = ".$bobot7."";
                      $sql7 = mysqli_query($koneksi, $query7);
                      $row7 = mysqli_fetch_array($sql7);
                      
                      $core_persen_1 =cari_nilai("select bobot_core as nilai from pm_aspek where id_aspek=1");
                      $secondary_persen_1 = cari_nilai("select bobot_secondary as nilai from pm_aspek where id_aspek=1");  
                      $core_persen_2 =cari_nilai("select bobot_core as nilai from pm_aspek where id_aspek=2");
                      $secondary_persen_2 = cari_nilai("select bobot_secondary as nilai from pm_aspek where id_aspek=2"); 


                  ?>
                  <tr>
                    <td><?php echo $row['nama_pelamar'];?></td>
                    <td>
                       <?php echo $terbobot1[$row['id_pelamar']] = ($core_persen_1*(($row1['bobot']+$row2['bobot']+$row3['bobot'])/3)/100)+0?>
                    </td>
                   <td>
                       <?php echo $terbobot2[$row['id_pelamar']] = 0+($secondary_persen_2*(($row4['bobot']+$row5['bobot']+$row6['bobot']+$row7['bobot'])/4)/100)?>
                    </td>
                    <td>
                      <?php echo $terbobot_total[$row['id_pelamar']] = ($persen_1*(($core_persen_1*(($row1['bobot']+$row2['bobot']+$row3['bobot'])/3)/100)+0)/100)+($persen_2*(0+($secondary_persen_2*(($row4['bobot']+$row5['bobot']+$row6['bobot']+$row7['bobot'])/4)/100))/100)?>
                    </td>
                    <td class="text-primary">
                        <?php
						echo cari_nilai("select rank as nilai from(SELECT id_pelamar, nilai_akhir, @curRank := @curRank + 1 AS rank FROM pm_ranking p, (SELECT @curRank := 0) r ORDER BY nilai_akhir desc) tbl where id_pelamar =".$row['id_pelamar']."");
                        ?>
                    </td>

                  </tr>
                  <?php
					mysqli_query($koneksi, "DELETE FROM pm_ranking where id_pelamar = ".$row['id_pelamar']."");
					
					mysqli_query($koneksi, "INSERT INTO pm_ranking(id_pelamar, nilai_akhir) VALUES('".$row['id_pelamar']."', '".$terbobot_total[$row['id_pelamar']]."')");
                    }
                   

                  }
                  ?>


</tbody></table>
</div>
</div>
<input type="button" value="Cetak" id="btnPrint" />
</div>
</div>
</div>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script>
<script type="text/javascript">
       $("#btnPrint").click(function() {

       //var doc = new jsPDF();
       var divContents = $("#cetak").html();
            var printWindow = window.open('', '', 'height=400,width=800');
            printWindow.document.write('<html><head><title>DIV Contents</title>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();

    });
    </script>