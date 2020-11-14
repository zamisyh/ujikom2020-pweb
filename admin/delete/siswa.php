<?php 

    session_start();
    include "../../config.php";
    if(!isset($_SESSION['loginAdmin']) === true){
        header("Location: ../");
    }

    $nis = htmlspecialchars($_GET['nis']);
    $selectGuru = mysqli_query($conn, "DELETE FROM siswa WHERE nis = $nis");

    if($selectGuru){
        echo "<script>alert('Successfully Delete!')</script>";
        echo "<script>location='../index.php'</script>";
    }else{
        echo "<script>alert('Error Delete!')</script>";
        echo "<script>location='../index.php'</script>";
    }


?>