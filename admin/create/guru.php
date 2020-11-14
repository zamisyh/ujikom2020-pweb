<?php

session_start();
include "../../config.php";
if(!isset($_SESSION['loginAdmin']) === true){
    header("Location: ../");
}

    if(isset($_POST['submitBtn']) === true){
        $namaGuru = htmlspecialchars($_POST['nama_guru']);
        $namaMapel = htmlspecialchars($_POST['nama_mapel']);
        $alamat = htmlspecialchars($_POST['alamat']);

        $queryInsert = mysqli_query($conn, "INSERT INTO guru (nama_guru, alamat, nama_mapel) VALUES ('$namaGuru', '$alamat', '$namaMapel')");

        if(mysqli_affected_rows($conn) > 0){
            $success = true;
            echo '<meta http-equiv="refresh" content="2; url=../index.php">';
        }else{
           $error = true;
           echo '<meta http-equiv="refresh" content="2; url=../index.php">';
        }


    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Guru</title>
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
                    <label for="nama_guru">Nama Guru</label>
                    <input type="text" name="nama_guru" id="nama_guru" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="nama_mapel">Nama Mapel</label>
                    <input type="text" name="nama_mapel" id="nama_mapel" class="form-control" >
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" rows="5" class="form-control"></textarea>
                </div>

                <button class="btn btn-primary" type="submit" name="submitBtn">Submit</button>
            </div>
        </form>
    </div>

</body>
</html>