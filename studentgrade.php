<?php
    require_once('connect.php');
    require_once('functions.php');
    $db = open_connection();
    $group = find_group($_SESSION['class'],$_SESSION['email']);
    $query = "CREATE TABLE `temptable` (`group_id` VARCHAR(10) NOT NULL, `class` VARCHAR(10) NOT NULL, `average` FLOAT NOT NULL DEFAULT 0, `rank` INT NULL, PRIMARY KEY (`group_id`, `class`)) ";
    $result = mysqli_query($db, $query);
    $query2 = "SELECT group_id, class, (grade/num_groups)as avg from group_list where class = '$_SESSION[class]' ";
    $result2 = mysqli_query($db, $query2);
    while ($row = mysqli_fetch_assoc($result2)) {
      $query3 = "INSERT INTO temptable (group_id, class, average) VALUES ('$row[group_id]', '$row[class]', $row[avg]) ";
      $result3 = mysqli_query($db, $query3);
    }
    $query4 = "SELECT group_id, class, 1+(SELECT count(*) from temptable a WHERE a.average > b.average) as rank, average FROM temptable b WHERE b.class = '$_SESSION[class]' AND b.group_id = '$group' ";
    $result4 = mysqli_query($db, $query4);
    if (mysqli_num_rows($result4) > 0) {
      print_table($result4);
    } else {
      $reg_none_error = "No grades have been entered yet.";
      echo "<div class=\"alert alert-danger\" role=\"alert\">$reg_none_error</div>";
    }
    $query5 = "DROP TABLE `temptable`";
    mysqli_query($db, $query5);
    mysqli_close($db);
?>