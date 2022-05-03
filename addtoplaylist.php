<?php
    include("config.php");

    if(isset($_POST['input'])){

        $input = $_POST['input'];

        $query = "INSERT INTO playlist_files(media) values ('$input')";

        mysqli_query($conn, $query);
    }
?>