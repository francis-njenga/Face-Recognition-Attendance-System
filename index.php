<?php 
include 'Includes/dbcon.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="admin/img/logo/attnlg.png" rel="icon">
    <title>AMS Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="css/loginStyle.css">
   
</head>
<div class="container" id="signin">
    <h1>LOGIN</h1>
    <div id="messageDiv" class="messageDiv" style="display:none;"></div>

    <form method="post" action="">
         <select required name="userType">
            <option value="">--Select User Roles--</option>
            <option value="Administrator">Administrator</option>
            <option value="Lecture">Lecture</option>
      </select>
        <input type="email" name="email"placeholder="example@gmail.com">
        <input type="password"name="password" placeholder="password">
        <p class="recover">
            <a href="#">Recover Password</a>
        </p>
        <input type="submit" class="btn-login" value="Login" name="login" />
    </form>
     <p class="or">
        --------or--------
     </p>
     <div class="icons">
        <i class="fab fa-google"></i>
        <i class="fab fa-facebook"></i>
     </div>
   </div> 
   <script>
  function showMessage(message) {
  var messageDiv = document.getElementById('messageDiv');
  messageDiv.style.display="block";
  messageDiv.innerHTML = message;
  messageDiv.style.opacity = 1;
  setTimeout(function() {
    messageDiv.style.opacity = 0;
  }, 5000);
}



   </script> 
<?php
  if(isset($_POST['login'])){

    $userType = $_POST['userType'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = md5($password);

if($userType == "Administrator"){
    
      $query = "SELECT * FROM tbladmin WHERE emailAddress = '$email' and password='$password'  ";
      $rs = $conn->query($query);
      $num = $rs->num_rows;
      $rows = $rs->fetch_assoc();

      if($num > 0){

        $_SESSION['userId'] = $rows['Id'];
        $_SESSION['firstName'] = $rows['firstName'];
        $_SESSION['emailAddress'] = $rows['emailAddress'];

        echo "<script type = \"text/javascript\">
        window.location = (\"Admin/index.php\")
        </script>";
      }

      else{

        $message = " Invalid Username/Password!";
        echo "<script>showMessage('" . $message . "');</script>";

      }
    }
    else if($userType == "Lecture"){

      $query = "SELECT * FROM tbllecture WHERE emailAddress = '$email' and password='$password' "; 
       
      $rs = $conn->query($query);
      $num = $rs->num_rows;
      $rows = $rs->fetch_assoc();

      if($num > 0){

        $_SESSION['userId'] = $rows['Id'];
       
        echo "<script type = \"text/javascript\">
        window.location = (\"lecture/takeAttendance.php\")
        </script>";
       
     
      
      }

      else{

        $message = " Invalid Username/Password!";
        echo "<script>showMessage('" . $message . "');</script>";

      }
    }
    else{

    
    

    }
}
?>

                                  
</body>

</html>