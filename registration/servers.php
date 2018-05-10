<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$id    = "";
$name   = "";
$course   = "";
$section   = "";
$errors = array(); 
 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'registration');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $id = mysqli_real_escape_string($db, $_POST['id']);
  $name = mysqli_real_escape_string($db, $_POST['name']);
  $course=  mysqli_real_escape_string($db, $_POST['course']);
  $section=  mysqli_real_escape_string($db, $_POST['section']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($id)) { array_push($errors, "ID is required"); }
  if (empty($name)) { array_push($errors, "Name is required"); }
  if (empty($section)) { array_push($errors, "section is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM student_database WHERE username='$username' OR email='$email' LIMIT 1";
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
      array_push($errors, "Roll number number already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

        $add1 = "INSERT INTO `cbnst` (`subject`, `id`, `name`, `feedback`, `report`) VALUES ('cbnst', '$id', '$name', '', '');";
        mysqli_query($db, $add1);
        $add2 = "INSERT INTO `automata` (`subject`, `id`, `name`, `feedback`, `report`) VALUES ('automata', '$id', '$name', '', '');";
        mysqli_query($db, $add2);
        $add3 = "INSERT INTO `co` (`subject`, `id`, `name`, `feedback`, `report`) VALUES ('co', '$id', '$name', '', '');";
        mysqli_query($db, $add3);
        $add4 = "INSERT INTO `micro` (`subject`, `id`, `name`, `feedback`, `report`) VALUES ('micro', '$id', '$name', '', '');";
        mysqli_query($db, $add4);
        $add5 = "INSERT INTO `cc` (`subject`, `id`, `name`, `feedback`, `report`) VALUES ('cc', '$id', '$name', '', '');";
        mysqli_query($db, $add5);
        $add6 = "INSERT INTO `java` (`subject`, `id`, `name`, `feedback`, `report`) VALUES ('java', '$id', '$name', '', '');";
        mysqli_query($db, $add6);
        
        
  	$query = "INSERT INTO student_database (id, name, username, email, course, section, password) 
  			  VALUES('$id', '$name', '$username', '$email', '$course', '$section', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index2.php');
  }
}

// LOGIN USER
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
  	$query = "SELECT * FROM student_database WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: index2.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}

?>