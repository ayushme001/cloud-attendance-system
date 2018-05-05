 <?php
    
          $date = date('d/m/Y');
          $date1=date('d/m/Y',strtotime("+1 days"));
          mysqli_select_db($db,'registration'); 
          $adddate = "ALTER TABLE `attendance_teacher` ADD `$date` DATE NOT NULL AFTER `$date1`;";
          $add = mysqli_query($db,$adddate);
          
    ?>