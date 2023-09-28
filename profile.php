<?php // jika submit button diklik
    if(isset( $_REQUEST['Simpan'] ) ){
      $sql_truncate = mysqli_query($koneksi, "DELETE FROM pm_sample where id_faktor in(select id_faktor from pm_faktor where id_aspek = ".$_REQUEST['aspek_id'].")");
      foreach ($_REQUEST as $key => $value) {
      // Check if the key matches the pattern [X-Y] where X and Y are integers
      if (preg_match('/^\d+-\d+$/', $key)) {
          $parts = explode("-", $key);
          mysqli_query($koneksi, "INSERT INTO pm_sample(id_sample, id_pelamar, id_faktor, value) VALUES('', '".$parts[0]."', '".$parts[1]."', '".$value."')");
      }
    }
    // print_r($_REQUEST);die();
    echo "<script>alert('Proses Profile ".$_REQUEST['aspek']."Matching Tersimpan');location='home.php?page=profile';</script>";
    }

?>
    <form class="form-kecerdasan" method="post" action="" role="form">
    <div class="card mb-6 shadow-sm">
      <div class="card-header">
         <div class="col-6">
            <select class="custom-select d-block w-50" id="aspek" name="aspek" required>
              <option value="">Pilih Aspek...</option>
            

            <?php
                    $query = "select * from pm_aspek";
                    $sql = mysqli_query($koneksi, $query);
                    if(mysqli_num_rows($sql) > 0){
                    while($row = mysqli_fetch_array($sql)){
                       $selected = isset($_GET['aspek_id']) && $_GET['aspek_id'] == $row['id_aspek'] ? "selected='selected'" : "";

                        echo '<option  id="'.$row['id_aspek'].'" value="'.$row['aspek'].'" '.$selected.'>'.$row['aspek'].'</option>';
                      }
                    }
                      ?>
                      </select>
         </div>
      </div>
      <div class="card-body">
          <div class="container">
           <div id="spninactive_option" style="display:none;">
            
            <table class="table table-bordered table-striped">
            <?php
                if(isset($_GET['aspek_id']) && $_GET['aspek_id']){

                    $query = "SELECT * FROM `pm_faktor` where id_aspek =".$_GET['aspek_id'];
                    $sql = mysqli_query($koneksi, $query);
                    echo '<table class="table table-bordered table-striped">
                <thead>
                  <tr>
                  <th>Nama Tanaman Pangan</th>';

                    if(mysqli_num_rows($sql) > 0){
                    while($row = mysqli_fetch_array($sql)){
                       echo "<th>".$row['faktor']."</th>";
                      }
                    }
                    echo "</tr>
                          </thead>
                          <tbody>";
                $query_pelamar = "select * from master_pelamar";
                $sql_pelamar = mysqli_query($koneksi, $query_pelamar);
                if(mysqli_num_rows($sql_pelamar) > 0){
                    while($row_pelamar = mysqli_fetch_array($sql_pelamar)){
                       echo "<tr>";
                       echo "<td>".$row_pelamar['nama_pelamar']."</td>";
                       $query_faktor = "select a.* from pm_sample a RIGHT JOIN pm_faktor b on a.id_faktor=b.id_faktor where a.id_pelamar = ".$row_pelamar['id_pelamar']." and b.id_aspek = ".$_GET['aspek_id']." order by b.id_faktor asc";
                       $sql_faktor = mysqli_query($koneksi, $query_faktor);
                        if(mysqli_num_rows($sql_faktor) > 0){
                      while($row_faktor = mysqli_fetch_array($sql_faktor)){
                        echo "<td>
                      <select class='custom-select d-block w-100' name=".$row_pelamar['id_pelamar']."-".$row_faktor['id_faktor'].">";
                             if($row_faktor['value'] == 1)
                              echo "<option value='1'  selected='selected' >1 - Kurang</option>";
                             else
                              echo "<option value='1'   >1 - Kurang</option>";

                            if($row_faktor['value'] == 2)
                              echo "<option value='2'  selected='selected' >2 - Cukup</option>";
                             else
                              echo "<option value='2'   >2 - Cukup</option>";

                            if($row_faktor['value'] == 3)
                              echo "<option value='3'  selected='selected' >3 - Baik</option>";
                             else
                              echo "<option value='3'   >3 - Baik</option>";

                            if($row_faktor['value'] == 4)
                              echo "<option value='4'  selected='selected' >4 - Sangat Baik</option>";
                             else
                              echo "<option value='4'   >4 - Sangat Baik</option>";

                            }                          
                      echo "</select>";

                       echo "<tr>";
                      }
                    }
                  }
                
                echo "
                </tbody>
            </table>
          
             <button class='btn btn-success' type='submit' id='Simpan' name='Simpan'>Simpan</button>
             ";
              }
             ?>
          </div>
      </div>
    </div>
    </form>
  <script src="js/jquery-1.12.4.min.js"></script>
  <script>
   $(document).ready(function() {
    console.log("ayam");
      var ddlTxt = $("#aspek option:selected").attr("id");
      $("#spninactive_option").show();
        console.log(ddlTxt);
      $("#aspek").on("change", function() {
        var ddlTxt = $("#aspek option:selected").attr("id");
        $(".container div").hide();
        $("#spninactive_option").show();
        console.log(ddlTxt);
        var currentURL = window.location.href;
        var cleanURL = currentURL.split('?')[0];
        window.location.href = cleanURL+'?page=profile&aspek_id='+ddlTxt;
      });

  });
  </script>