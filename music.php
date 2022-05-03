<?php
$conn = new mysqli('localhost', 'root', '', 'msc');
    mysqli_select_db( $conn, 'signup');
    
	$query = "SELECT * FROM music";

    $result = mysqli_query($conn, $query);
?>