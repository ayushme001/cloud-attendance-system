<?php
session_start();


$username = "";
$email    = "";
$id    = "";
$name   = "";
$subject   = "";
$errors = array(); 
 


$db = mysqli_connect('localhost', 'root', '', 'registration');


if (isset($_POST['reg_user'])) {
 
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $id = mysqli_real_escape_string($db, $_POST['id']);
  $name = mysqli_real_escape_string($db, $_POST['name']);
  $subject=  mysqli_real_escape_string($db, $_POST['subject']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

 
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($id)) { array_push($errors, "ID is required"); }
  if (empty($name)) { array_push($errors, "Name is required"); }
  if (empty($subject)) { array_push($errors, "Subject is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  
  $user_check_query = "SELECT * FROM teacher_database WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
     
    if ($user['id'] === $id) {
      array_push($errors, "ID number already exists");
    }
  }

  
  if (count($errors) == 0) {
  	$password = md5($password_1);
  	$query = "INSERT INTO teacher_database (id, name, username, email, subject, password) 
  			  VALUES('$id', '$name', '$username', '$email', '$subject', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index1.php');
  }
}


if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM teacher_database WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: index1.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}


?>