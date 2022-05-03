<?php
    include("config.php");

    if(isset($_POST['input'])){

        $input = $_POST['input'];

        $query = "UPDATE playlist_files 
        SET playlist = '$input'
        WHERE playlist = ''";

        mysqli_query($conn, $query);

        $sql = "DELETE FROM playlist_files WHERE playlist = ''";

        mysqli_query($conn, $sql);
    }


?>

