<style>
.error {
    font-family: Outfit;
    font-style: normal;
    font-weight: normal;
    font-size: 18px;
    line-height: 30px;
    position: absolute;
    width: 400px;
    left: 185px;
    top: 260px;
    color: red;
}

.log {
    position: absolute;
    width: 149px;
    height: 60px;
    left: 227px;
    top: 5px;
    
    background: #000000;
    border: 0px;
    border-radius: 40px;

    font-family: Outfit;
    font-style: normal;
    font-weight: normal;
    font-size: 35px;
    line-height: 44px;
    /* identical to box height */
    
    color: #ffffff;  

    border-radius: 40px;
}

.log:hover 
{
    background: #FFFFFF;
    color: #000000;  
}
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="signup.css" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit&display=swap" rel="stylesheet"> 
</head>
<body>
    <header></header>
    <a href="login.php">
        <input type="submit" value="Login" class="log">Login</input></a>
    <rect></rect>
    <logo>MUSICO</logo>
    <img src="img3.svg">
    <t>Sign Up</t>
    <form name="form1" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <t1>Name</t1>
    <div class="i1">
        <input type="text" name="name" placeholder="Your Name">
    </div>    
    <t2>Username</t2>
    <div class="i2">
        <input type="text" name="uname" placeholder="Your Username">
    </div>  
    <t3>Email</t3>
    <div class="i3">
        <input type="text" name="email" placeholder="Your Email">
    </div>  
    <t4>Password</t4>
    <div class="i4">
        <input type="password" name="passw" placeholder="Your Password">
    </div> 
    <input type="submit" name="submit" class="button" onclick="ValidateEmail(document.form1.email),ValidatePassw(document.form1.passw),ValidateName(document.form1.name),ValidateUName(document.form1.uname)">Submit</input> 
    <div class="error">
    <?php
if(isset($_POST["submit"])){  
  
  if(!empty($_POST['email']) && !empty($_POST['passw']) && !empty($_POST['uname']) && !empty($_POST['name'])) { 
      $name = $_POST['name'];
      $uname = $_POST['uname']; 
      $email=$_POST['email'];  
      $password=$_POST['passw'];

      include("config.php"); 

        if(!preg_match ("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $email) ){
            echo "Email format is invalid";
            exit();
            header("Location: signup.php");
            }

    if(!preg_match ("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}$/", $password) ){
            echo "Password format is invalid";
            exit();
            header("Location: signup.php");
            }
    
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
        $q=mysqli_query($conn,"INSERT INTO signup(name, email, uname ,passw) VALUES('" . $name . "', '" . $email . "', '" . $uname . "', '" .$password. "')"); 
        
      }  
    
  } else {  
      echo "All fields are required!";  
  }  
  }  
  ?>
    </div>
    
    
    
 </form>

 <script>
     function ValidateEmail(inputText)
{
var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
if(inputText.value.match(mailformat))
{
document.form1.email.focus();
return true;
}
else
{
alert("You have entered an invalid email address!");
document.form1.email.focus();
return false;
}
}

function ValidatePassw(inputtxt)
{
    var passw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}$/;
if(inputtxt.value.match(passw)) 
{ 
return true;
}
else
{ 
alert('Please have a password with atleast 8 characters and one uppercase letter and one number')
document.form1.passw.focus();
return false;
}
}

function ValidateName(inputt) {
    var str=/^\s*$/;
if (inputt.value.match(str)){  
  alert("Name can't be blank");  
  document.form1.name.focus();
  return false;  
  }
else
{
    return true;
}
}

function ValidateUName(inputtt) {
    var str=/^\s*$/;
if (inputtt.value.match(str)){  
    alert("Username can't be blank")
  document.form1.uname.focus();
  return false;  
  }
else
{
    return true;
}
}

 </script>
</body>
</html>