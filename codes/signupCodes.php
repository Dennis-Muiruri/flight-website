<?php

if (isset($_POST['submit'])){

  include_once 'coded.php';

  $first = $_POST['first'];
  $last = $_POST['last'];
  $gender = $_POST['gender'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $pwd = $_POST['pwd'];
//error hundlers
//check for empty fields
if (empty($first) || empty($last) || empty($gender) || empty($phone) || empty($email) || empty($pwd))
{
  header("Location: ../signup2.php?signup=empty");
 exit();
}else{
     //check if inputs characters are valid
      if (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)) {
    header("Location: ../signup2.php?signup=invalid");
     exit();
} else {
        //check if email is vaild 
       if(!filter_var($email, FILTER_VALIDATE_EMAIL))
{
   header("Location: ../signup2.php?signup=email");
   exit();
} else {

  //hashing the password
   $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
//insert the user into the database
   $sql = "INSERT INTO flights(user_first, user_last, user_gender, user_phone, user_email, user_pwd) VALUES ('$first', '$last', '$gender', '$phone', '$email', '$hashedPwd')";
   mysqli_query($conn, $sql);
  header("Location: ../signup2.php?signup=success");
 exit();
                                         }
                                 }
                          }
                    }else{
  header("Location: ../signup2.php");
 exit();
}