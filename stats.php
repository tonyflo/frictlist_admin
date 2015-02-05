<!DOCTYPE html>
<html>
<head>
      <meta charset=utf-8 />
      <title>Frictlist Admin Page</title>
      <meta name="viewport" content="width=device-width, user-scalable=yes">
</head>
<body>
<?php
      $validated=false;
      // connect to MySQL
      $db = mysql_connect('mysql.adirolf.com', 'raddfood', '$4y1t41r34dy');
      if(!$db)
      {
        die('Could not connect: ' . mysql_error());
      }
      // select the password database
      $er = mysql_select_db("adirolf_pw");
      if(!$er)
      {
        exit("Error - could not select the database");
      }
      //query for a table
      $query = 'select * from pw_table;';
      $result = mysql_query($query);
      $root;
      while($row = mysql_fetch_row($result))
      {
        $root=$row[1];
      }
      //compare user input to root for access
      if($_POST["pw"] == $root)
      {
         $validated=true;
      }
      if($validated == true)
      {
            include "admin.php";
            include "../frictlist_private/credentials.php";
            echo "<h4>Frictlist Data</h4>";
            $tables=$_POST['tables'];
            $query="select uid, email, username, first_name, last_name, birthdate, gender, creation_datetime from user";
            $result = mysqli_query($db, $query);
            admin_statistics($result, $tables);

            //nav buttons
            echo '<form action="stats.php" method="post">';
            echo '<input type="hidden" name="tables" value=0><br>';
            echo '<input type="hidden" name="pw" value='.$_POST["pw"].'><br>';
            echo '<input type="submit" value="Show No Data">';
            echo '</form>';
            echo '<form action="stats.php" method="post">';
            echo '<input type="hidden" name="tables" value=1><br>';
            echo '<input type="hidden" name="pw" value='.$_POST["pw"].'><br>';
            echo '<input type="submit" value="Show New Data">';
            echo '</form>';
            echo '<form action="stats.php" method="post">';
            echo '<input type="hidden" name="tables" value=2><br>';
            echo '<input type="hidden" name="pw" value='.$_POST["pw"].'><br>';
            echo '<input type="submit" value="Show All Data">';
            echo '</form>';
      }
      else
      {
            echo '<h3>No</h3>';
      }
?>
</body>
</html>
