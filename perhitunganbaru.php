
<link href="css/perhitungan.css" rel="stylesheet">

<div class="container">
<div class="panel panel-primary">
<div class="panel-heading"><strong>PERHITUNGAN</strong></div>
<div class="panel-body" style=" border: 1px solid #e7e7e7;">
<div class="panel panel-default">
  <?php
$query = "select * from pm_aspek";
$sql = mysqli_query($koneksi, $query);
if(mysqli_num_rows($sql) > 0){
  while($row = mysqli_fetch_array($sql)){
?>
<div class="panel-heading"><strong>Perhitungan <?php echo $row['aspek'];?></strong></div>
<div class="table-responsive">
<table class="table  table-striped table-hover" style="border: 0px;">
<tbody> <tr>
        <th>Nama Tanaman Pangan</th> 
              <?php 
              $query = "SELECT * FROM `pm_faktor` where id_aspek =".$row['id_aspek'];
              $sql = mysqli_query($koneksi, $query);
              if(mysqli_num_rows($sql) > 0){
                                  while($row_faktor = mysqli_fetch_array($sql)){
                                     echo "<th>".$row_faktor['faktor']."</th>";
                                    }
                                  }
              ?>
                  </tr>
                  <?php
                  $query_pelamar = "select * from master_pelamar";
                $sql_pelamar = mysqli_query($koneksi, $query_pelamar);
                if(mysqli_num_rows($sql_pelamar) > 0){
                    while($row_pelamar = mysqli_fetch_array($sql_pelamar)){
                       echo "<tr>";
                       echo "<td>".$row_pelamar['nama_pelamar']."</td>";

                       $query_faktor = "select a.* from pm_sample a RIGHT JOIN pm_faktor b on a.id_faktor=b.id_faktor where a.id_pelamar = ".$row_pelamar['id_pelamar']." and b.id_aspek = ".$row['id_aspek']." order by b.id_faktor asc";
                       $sql_faktor = mysqli_query($koneksi, $query_faktor);
                        if(mysqli_num_rows($sql_faktor) > 0){
                      while($row_faktor = mysqli_fetch_array($sql_faktor)){
                        echo "<td>".$row_faktor['value']."</td>";
                        }
                      }
                     }
                   }
                  ?>

</tbody><tfoot><tr>
<th>Nilai Kriteria</th>

<?php 
$query = "SELECT * FROM `pm_faktor` where id_aspek =".$row['id_aspek'];
$sql = mysqli_query($koneksi, $query);
if(mysqli_num_rows($sql) > 0){
                    while($row_faktor = mysqli_fetch_array($sql)){
                       echo "<td class=text-primary'>".cari_nilai("select target as nilai from pm_faktor where id_faktor=".$row_faktor['id_faktor'])."</td>";
                      }
                    }
?>
</tr></tfoot>
</table>
</div>
<div class="panel-body">Perhitungan pemetaan gap <strong></strong>:</div>
<div class="table-responsive">
<table class="table  table-striped table-hover" style="border: 0px;">
<tbody> <tr>
                    <th>Nama Tanaman Pangan</th>
                    <?php 
              $query_faktor = "SELECT * FROM `pm_faktor` where id_aspek =".$row['id_aspek'];
              $sql_faktor = mysqli_query($koneksi, $query_faktor);
              if(mysqli_num_rows($sql_faktor) > 0){
                                  while($row_faktor = mysqli_fetch_array($sql_faktor)){
                                     echo "<th>".$row_faktor['faktor']."</th>";
                                    }
                                  }
              ?>
                  </tr>
                  <?php
                    $query_pelamar = "select * from master_pelamar";
                $sql_pelamar = mysqli_query($koneksi, $query_pelamar);
                if(mysqli_num_rows($sql_pelamar) > 0){
                    while($row_pelamar = mysqli_fetch_array($sql_pelamar)){
                       echo "<tr>";
                       echo "<td>".$row_pelamar['nama_pelamar']."</td>";

                       $query_faktor = "select a.*,b.target from pm_sample a RIGHT JOIN pm_faktor b on a.id_faktor=b.id_faktor where a.id_pelamar = ".$row_pelamar['id_pelamar']." and b.id_aspek = ".$row['id_aspek']." order by b.id_faktor asc";
                       $sql_faktor = mysqli_query($koneksi, $query_faktor);
                        if(mysqli_num_rows($sql_faktor) > 0){
                      while($row_faktor = mysqli_fetch_array($sql_faktor)){
                        echo "<td>".(intval($row_faktor['value'])-intval($row_faktor['target']))."</td>";
                        }
                      }
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
                    <?php
                    $query_faktor = "SELECT * FROM `pm_faktor` where id_aspek =".$row['id_aspek'];
              $sql_faktor = mysqli_query($koneksi, $query_faktor);
              if(mysqli_num_rows($sql_faktor) > 0){
                                  while($row_faktor = mysqli_fetch_array($sql_faktor)){
                                     echo "<th>".$row_faktor['faktor']."</th>";
                                    }
                                  }
              ?>
                  </tr>
              <?php
                  $query_pelamar = "select * from master_pelamar";
                $sql_pelamar = mysqli_query($koneksi, $query_pelamar);
                if(mysqli_num_rows($sql_pelamar) > 0){
                    while($row_pelamar = mysqli_fetch_array($sql_pelamar)){
                       echo "<tr>";
                       echo "<td>".$row_pelamar['nama_pelamar']."</td>";

                      $query_faktor = "select a.*,b.target from pm_sample a RIGHT JOIN pm_faktor b on a.id_faktor=b.id_faktor where a.id_pelamar = ".$row_pelamar['id_pelamar']." and b.id_aspek = ".$row['id_aspek']." order by b.id_faktor asc";
                      $sql_faktor = mysqli_query($koneksi, $query_faktor);
                      if(mysqli_num_rows($sql_faktor) > 0){
                      while($row_faktor = mysqli_fetch_array($sql_faktor)){
                        $bobot= intval($row_faktor['value'])-intval($row_faktor['target']);
                        $query1 ="select * from pm_bobot where selisih = ".$bobot."";
                        $sql1 = mysqli_query($koneksi, $query1);
                        $row1 = mysqli_fetch_array($sql1);
                        echo "<td>".$row1['bobot']."</td>";
                        
                        }
                        
                      }
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
              <?php
                    $query_faktor = "SELECT * FROM `pm_faktor` where id_aspek =".$row['id_aspek'];
              $sql_faktor = mysqli_query($koneksi, $query_faktor);
              if(mysqli_num_rows($sql_faktor) > 0){
                                  while($row_faktor = mysqli_fetch_array($sql_faktor)){
                                     echo "<th>".$row_faktor['faktor']."</th>";
                                    }
                                  }
              ?>
                    <th>NCF</th>
                    <th>NSF</th>
                    <th>Total</th>
                  </tr>
              <?php
                  $query_pelamar = "select * from master_pelamar";
                $sql_pelamar = mysqli_query($koneksi, $query_pelamar);
                if(mysqli_num_rows($sql_pelamar) > 0){
                    while($row_pelamar = mysqli_fetch_array($sql_pelamar)){
                       echo "<tr>";
                       echo "<td>".$row_pelamar['nama_pelamar']."</td>";

                      $query_faktor = "select a.*,b.target from pm_sample a RIGHT JOIN pm_faktor b on a.id_faktor=b.id_faktor where a.id_pelamar = ".$row_pelamar['id_pelamar']." and b.id_aspek = ".$row['id_aspek']." order by b.id_faktor asc";
                      $sql_faktor = mysqli_query($koneksi, $query_faktor);
                      $core_total = 0;
                      $sencodary_total = 0;
                      $core_count = 0;
                      $sencodary_count = 0;
                      if(mysqli_num_rows($sql_faktor) > 0){
                      while($row_faktor = mysqli_fetch_array($sql_faktor)){
                        $bobot= intval($row_faktor['value'])-intval($row_faktor['target']);
                        $query1 ="select * from pm_bobot where selisih = ".$bobot."";
                        $sql1 = mysqli_query($koneksi, $query1);
                        $row1 = mysqli_fetch_array($sql1);
                        echo "<td>".$row1['bobot']."</td>";
                        if($row_faktor['type'] = 'core')
                        {
                          $core_total += $row1['bobot'];
                          $core_count++;
                        }
                        else
                        {
                           $sencodary_total += $row1['bobot'];
                           $sencodary_count++;
                        }
                        
                        }
                        echo "<td>".$core_total."</td>";
                        echo "<td>".$sencodary_total."</td>";
                        $core_persen =cari_nilai("select bobot_core as nilai from pm_aspek where id_aspek=1");
                        $secondary_persen = cari_nilai("select bobot_secondary as nilai from pm_aspek where id_aspek=1");
                        if($core_count != 0)
                          $nilai_core=$core_persen*($core_total/$core_count)/100;
                        else
                          $nilai_core=0;
                        if($sencodary_count != 0)
                          $nilai_secondary=$secondary_persen*($sencodary_total/$sencodary_count)/100;
                        else
                          $nilai_secondary=0;
                        $nilai_total = $nilai_core+$nilai_secondary;
                        echo "<td>".$nilai_total."</td>"; 
                      }
                  }
                }
              ?>    
                  <tr>
                  <td></td>
                  <?php
                  $query_faktor = "SELECT * FROM `pm_faktor` where id_aspek =".$row['id_aspek'];
                       $sql_faktor = mysqli_query($koneksi, $query_faktor);
                        if(mysqli_num_rows($sql_faktor) > 0){
                      while($row_faktor = mysqli_fetch_array($sql_faktor)){
                        echo "<td class='text-primary'>".$row_faktor['type']."</td>";
                        }
                      }
                    ?>
                  <td></td>
                  <td></td>
                  <td></td>
                  </tr>

</tbody>
</table>
</div>
</div>
<?php
echo "test1";
}
echo "test2";
}
?>
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