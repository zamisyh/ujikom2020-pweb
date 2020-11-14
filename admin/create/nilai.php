<?php

session_start();
include "../../config.php";
if(!isset($_SESSION['loginAdmin']) === true){
    header("Location: ../");
}

    if(isset($_POST['submitBtn']) === true){
        
        $nis = htmlspecialchars($_POST['nis']);
        $indonesia = htmlspecialchars($_POST['indonesia']);
        $inggris = htmlspecialchars($_POST['inggris']);
        $mtk = htmlspecialchars($_POST['mtk']);
        $kejuruan = htmlspecialchars($_POST['kejuruan']);

        $nilai = $indonesia + $inggris + $mtk + $kejuruan;
        $rata = $nilai / 4;

        $save = mysqli_query($conn, "INSERT INTO nilai (nis, indonesia, inggris, mtk, kejuruan, rata_rata)
                            VALUES ('$nis', '$indonesia', '$inggris', '$mtk', '$kejuruan', '$rata')");


        
        if(mysqli_affected_rows($conn) > 0){
            $success = true;
            echo '<meta http-equiv="refresh" content="2; url=../index.php">';
        }else{
           $error = true;
        
        }


    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Nilai</title>
    <link rel="stylesheet" href="../../assets/plugins/bootstrap/css/bootstrap.min.css">
</head>
<body>
    
    <div class="container mt-5">
        <form action="" method="post">
            <div class="form-group">

                <div class="form-group">
                    <?php if (isset($success)): ?>
                        <div class="alert alert-success">Data berhasil di tambahkan</div>
                    <?php endif ?>

                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger">Error <?= mysqli_error($conn); ?></div>
                    <?php endif ?>
                </div>

                <div class="form-group">
                    <label for="nis">Nama Siswa</label>
                    <select name="nis" id="nis" class="form-control">
                        <?php 

                            $data = mysqli_query($conn, "SELECT * FROM siswa");
                            while ($rowData = mysqli_fetch_array($data)) {
                               
                            
                        ?>
                            
                            <option value="<?= $rowData['nis'] ?>"><?= $rowData['nama_siswa'] ?></option>

                        <?php }?>
                    </select>
                    
                </div>
                <div class="form-group">
                    <label for="indonesia">Indonesia</label>
                    <input type="number" class="form-control" name="indonesia" id="indonesia" maxlength="2" required>
                </div>
                <div class="form-group">
                    <label for="inggris">Inggris</label>
                    <input type="number" class="form-control" name="inggris" id="inggris" maxlength="2" required>
                </div>
                <div class="form-group">
                    <label for="mtk">MTK</label>
                    <input type="number" class="form-control" name="mtk" id="mtk" maxlength="2" required>
                </div>
                <div class="form-group">
                    <label for="kejuruan">Kejuruan</label>
                    <input type="number" class="form-control" name="kejuruan" id="kejuruan" maxlength="2" required>
                </div>
              
                <button class="btn btn-primary" type="submit" name="submitBtn" id="submitBtn">Submit</button>
            </div>
        </form>
    </div>

    <script src="../../assets/plugins/jquery/jquery-v3.2.1.min.js"></script>

  

</body>
</html>