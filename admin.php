<?php

function show_summary_table($name, $new_rows, $num_rows)
{
   echo "<p>".$name."</p>";
   echo "<table border=1>";
   echo "<tr><td>New</td><td>".$new_rows."</td></tr>";
   echo "<tr><td>Total</td><td>".$num_rows."</td></tr>";
   echo "</table>";
}

function admin_statistics($result, $show_tables)
{
   if($show_tables > 0)
   {
      echo "<table border='1'>";
      echo "<tr><th>uid</th><th>Email</th><th>Username</th><th>First</th><th>Last</th><th>Birthday</th><th>Gender</th><th>Created</td></tr>";
   }

   $total = 0;
   $new_total = 0;

   $today = new DateTime("now");
   $f_today=$today->format('Y-m-d'); //formated today = '2011-03-09'

   while ($row = mysqli_fetch_array($result))
   {
      $total++;

      //print out all table data
      if($show_tables == 2)
      {
         echo "<tr><td>".$row['uid']."</td><td>".$row['email']."</td><td>".$row['username']."</td><td>".$row['first_name']."</td><td>".$row['last_name']."</td><td>".$row['birthdate']."</td><td>".$row['gender']."</td><td>".$row['creation_datetime']."</td></tr>";
      }

      //detect new accounts
      $sql_date=substr($row['creation_datetime'],0,10); //I get substring '2008-10-17'
      if(strcmp($f_today,$sql_date)==0)
      {
         $new_total++;

         //print out new table data only
         if($show_tables == 1)
         {
         	echo "<tr><td>".$row['uid']."</td><td>".$row['email']."</td><td>".$row['username']."</td><td>".$row['first_name']."</td><td>".$row['last_name']."</td><td>".$row['birthdate']."</td><td>".$row['gender']."</td><td>".$row['creation_datetime']."</td></tr>";
         }
      }
   }

   if($show_tables > 0)
   {
      echo "</table>";
   }

   show_summary_table("Total", $new_total, $total);
}

?>
