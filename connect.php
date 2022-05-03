<?php

    session_start();

    $conn = new mysqli('localhost', 'root', '', 'msc');
    mysqli_select_db( $conn, 'signup');

    $name = $_POST['name'];
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $password = $_POST['passw'];

    $s = "SELECT * FROM signup WHERE email = '$email'";

    $result = mysqli_query($conn, $s);

    $num = mysqli_num_rows($result);

    if($num == 1){
        echo'<script>alert("Username or Email already taken")</script>';
        header("Location: signup.php");
    }else{
        $reg = "INSERT INTO signup(name, uname, email, passw) values ('$name', '$uname', '$email', '$password')";
    mysqli_query($conn, $reg);
    echo"Succesfully registered";
    header("Location: login.php");
    }

?>




<?php
if(isset($_POST["submit"])){  
  
  if(!empty($_POST['email']) && !empty($_POST['passw']) && !empty($_POST['uname']) && !empty($_POST['name'])) { 
      $name = $_POST['name'];
      $uname = $_POST['uname']; 
      $email=$_POST['email'];  
      $password=$_POST['passw'];  
    
      include("config.php"); 
    
      $query=mysqli_query($conn,"SELECT * FROM signup WHERE email='".$email."'");  
      $numrows=mysqli_num_rows($query);  
      if($numrows!=0)  
      {  
      while($row=mysqli_fetch_assoc($query))  
      {  
      $dbemail=$row['email'];  
      }  
    
      if($email == $dbemail)  
      {
        echo "Email already registered";  
      }  
      } else {
          
        echo "REGISTERED"; 
        $q=mysqli_query($conn,"INSERT INTO signup(name, email, uname ,passw) VALUES('" . $name . "', '" . $email . "', '" . $username . "', '" . md5($password) . "')"); 
        
      }  
    
  } else {  
      echo "All fields are required!";  
  }  
  }  
  ?>
