<?php 

    session_start();
    include "../../config.php";
    if(!isset($_SESSION['loginAdmin']) === true){
        header("Location: ../");
    }

    $idGuru = htmlspecialchars($_GET['id']);
    $selectGuru = mysqli_query($conn, "DELETE FROM guru WHERE id = $idGuru");

    if($selectGuru){
        echo "<script>alert('Successfully Delete!')</script>";
        echo "<script>location='../index.php'</script>";
    }else{
        echo "<script>alert('Error Delete!')</script>";
        echo "<script>location='../index.php'</script>";
    }


?>