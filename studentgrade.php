<?php
    require_once('connect.php');
    require_once('functions.php');
    $db = open_connection();
    $query = "SELECT group_id, class, 1+(SELECT count(*) from temp_table_1 a WHERE a.average > b.average AND a.class = 'MATH2001' AND a.group_id = 1 as rank, average FROM temp_table_1 b WHERE b.class = 'MATH2001' ";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) > 0) {
      print_table($result);
    } else {
      $reg_none_error = "No one is registered for this class yet.";
      echo "<div class=\"alert alert-danger\" role=\"alert\">$reg_none_error</div>";
    }
    mysqli_close($db);
?>