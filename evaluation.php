<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="3333.png">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/main.css" rel="stylesheet">

    <!-- Latest compiled and minified JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
  </head>
  
  <body>
  <!--get array(?) of groups to assess-->

  <p> Click the name of the file to start downloading the group's report. When you have finished reading the report, submit an evaluation using the form below for the corresponding group.</p>
  <?php
  
  // Connect to the database
  $db = open_connection();
  if(mysqli_connect_errno()) {
      die("MySQL connection failed: ". mysqli_connect_error());
  }

  $class = mysqli_real_escape_string($db, $_SESSION['class']);;
  $email = mysqli_real_escape_string($db, $_SESSION['email']);; 
  
  //Get user's group number
  $query = "SELECT group_id FROM group_list WHERE '$email' IN(member1, member2, member3) AND class = '$class'";
  $result = mysqli_query($db, $query);
  
  if (mysqli_num_rows($result) > 0) {
    $group_entry = mysqli_getresult($result, mysqli_num_rows($result), 0);
    } else {
      echo "You are not in a group.";
    }
  

  // Query for all assigned reports
  $evalgroups = "SELECT id_report_group FROM evaluation WHERE class = '$class' AND id_eval_group = '$group_entry'";
  
  $query = "SELECT group_id, name, type, size, uploadtime from report where (group_id in (SELECT id_report_group FROM evaluation WHERE class = '$class' AND id_eval_group = '$group_entry')) AND class = '$class'";
  $result = mysqli_query($db,$query);

  
  // Check if query was successful
  if($result) {
      // Make sure there are some files in there
      if($result->num_rows == 0) {
          echo '<p>There are no files in the database</p>';
      }
      else {
        // Print the top of a table
        echo '<table width="100%">
                <tr>
                    <td><b>Group</b></td>
                    <td><b>Name</b></td>
                    <td><b>Type</b></td>
                    <td><b>Size (bytes)</b></td>
                    <td><b>Date Submitted</b></td>
                </tr>';
 
        // Print each file
        while($row = $result->fetch_assoc()) {
            echo "
                <tr>
                    <td>{$row['group_id']}</td>
                    <td><a href = 'get_file.php?id={$row['group_id']}'>{$row['name']}</a></td>
                    <td>{$row['type']}</td>
                    <td>{$row['size']}</td>
                    <td>{$row['uploadtime']}</td>
                </tr>";
        }
 
        // Close table
        echo '</table>';
        /*
        $data = array();
        while($row = mysqli_fetch_assoc($result)) {
          $data[] = $row['id_report_group'];
        }
        print_r($data);
        */
      }
   
      // Free the result
      mysqli_free_result($result);
  }
  else
  {
      echo 'Error! SQL query failed:';
      echo "<pre>{$db->error}</pre>";
  }
   
  // Close the mysql connection
  mysql_close($db);
  ?>



  </html>