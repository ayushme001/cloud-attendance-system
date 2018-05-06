<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: logins.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: index.html");
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
 	<link rel="stylesheet" type="text/css" href="style.css"> 
</head>
<body>

<div class="header">
	<h2>Home Page</h2>
</div>
<div class="content">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
          
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : 
        $username=$_SESSION['username'];?>
    	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
        <p> <a href="index2.php?logout='1'" style="color: red;">logout</a> </p>
    	
    <?php endif ?>
        <?php
        $date = date('d/m/Y');
        $db = mysqli_connect('localhost', 'root', '');
        mysqli_select_db($db,'registration'); 
        $sql = "SELECT name FROM student_database WHERE (username = '$username')";
        $retval = mysqli_query($db , $sql );
        if(! $retval )
        {
            die('Could not get data: ' . mysqli_error());
         }
         
                        
        while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
            $name=$row['name'];
        //echo "name :$name<br> " ;
   }
        ?>
        </div>
        
                    <table width='100%' border='0' cellpadding='0' cellspacing='0' class="data-table">
                        <tbody>
                            <tr>
                                <th   class='data-table'> Subjects/Date </th>
                                <th   class='data-table'>CBNST </th>
                                <th  class='data-table'>Automata</th>
                                <th  class='data-table'>Microprocessors</th>
                                <th  class='data-table'>Computer Organization</th>
                                <th  class='data-table'>Java</th>
                                <th  class='data-table'>Cloud Computing</th>
                            </tr>
                        
                        <tbody>
                 
         
        <?php
        
        $db = mysqli_connect('localhost', 'root', '');
        mysqli_select_db($db,'registration'); 
        
         // Start date
	//$date = '2009-12-06';
	// End date
	$end_date = '07/05/2018';
        $date1 = date('d/m/Y'); 
        $i=0;
        for($i=1;$i<=$end_date;$i++)
	 {  
            /*
            if($i=1)
            {$subject="cbnst";}
            if($i=2)
            {$subject="automata";}
            if($i=3)
            {  $subject="micro";}
            if($i=4)
            { $subject="co";}
            if($i=5)
            { $subject="java";}
            if($i=6)
            { $subject="cc";}
             * 
            
             */
                if($date1!=$end_date+1)
                {
                
                echo"<tr>";
                echo"<td>";
                echo "$date1\n";
                echo"<td>";
                $sql = "SELECT `$date1` FROM `cbnst` WHERE (name = '$name')" ;
                $retval = mysqli_query($db , $sql );
                if(! $retval )
                {
                    die('Could not get data: ' . mysqli_error());
                }
         
                        
                 while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) 
                 {
                    $attn=$row[$date1];
                    echo "$attn " ;
                 }

                echo"</td>";
                echo"<td>";
                $sql = "SELECT `$date1` FROM `automata` WHERE (name = '$name')" ;
                $retval = mysqli_query($db , $sql );
                if(! $retval )
                {
                    die('Could not get data: ' . mysqli_error());
                }
         
                        
                 while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) 
                 {
                    $attn=$row[$date1];
                    echo "$attn " ;
                 }

                
                echo"</td>";
                echo"<td>";
                $sql = "SELECT `$date1` FROM `micro` WHERE (name = '$name')" ;
                $retval = mysqli_query($db , $sql );
                if(! $retval )
                {
                    die('Could not get data: ' . mysqli_error());
                }
         
                        
                 while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) 
                 {
                    $attn=$row[$date1];
                    echo "$attn " ;
                 }

                echo"</td>";
                echo"<td>";
                
                $sql = "SELECT `$date1` FROM `co` WHERE (name = '$name')" ;
                $retval = mysqli_query($db , $sql );
                if(! $retval )
                {
                    die('Could not get data: ' . mysqli_error());
                }
         
                        
                 while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) 
                 {
                    $attn=$row[$date1];
                    echo "$attn " ;
                 }

                echo"</td>";
                echo"<td>";
                $sql = "SELECT `$date1` FROM `java` WHERE (name = '$name')" ;
                $retval = mysqli_query($db , $sql );
                if(! $retval )
                {
                    die('Could not get data: ' . mysqli_error());
                }
         
                        
                 while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) 
                 {
                    $attn=$row[$date1];
                    echo "$attn " ;
                 }

                echo"</td>";
                echo"<td>";
                $sql = "SELECT `$date1` FROM `cc` WHERE (name = '$name')" ;
                $retval = mysqli_query($db , $sql );
                if(! $retval )
                {
                    die('Could not get data: ' . mysqli_error());
                }
         
                        
                 while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) 
                 {
                    $attn=$row[$date1];
                    echo "$attn " ;
                 }

                echo"</td>";
                
                echo"</td>";
                echo"</tr>";

                
                }
                $date1=date('d/m/Y',strtotime("+$i days"));
                
	}
        
      

       
        ?>

        </table>
    
    
	
</body>
</html>