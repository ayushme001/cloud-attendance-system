 
<?php

$db = mysqli_connect('localhost', 'root', '');
mysqli_select_db($db,'registration'); 
$date = date('d/m/Y');
  $sql = "SELECT name FROM student_database ";
        $retval = mysqli_query($db , $sql );
        if(! $retval )
        {
            die('Could not get data: ' . mysqli_error());
         }
         $c=1;
         
         
      while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {   
         
        if(isset($_POST['$c'])){
                $attn=$_POST[$c];
                $fill="INSERT INTO `attendance_teacher` (`id`, `name`, `$date`) VALUES ('$c', '{$row['name']}', '$attn');";
                mysqli_query($db,$fill);
          } 
      }
        
?>