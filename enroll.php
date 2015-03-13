<p>Hi</p>

<?php
	require('connect.php');
	$db = open_connection();
	$query = "select * from user";
	$result = mysqli_query($db, $query);
	$data = array();
	while($row = mysqli_fetch_assoc($result)) {
		$data[] = $row;
	}
	$colNames = array_keys(reset($data))
	mysqli_close($db);
?>
<table border="1">
 <tr>
    <?php
       //print the header
       foreach($colNames as $colName)
       {
          echo "<th>$colName</th>";
       }
    ?>
 </tr>

    <?php
       //print the rows
       foreach($data as $row)
       {
          echo "<tr>";
          foreach($colNames as $colName)
          {
             echo "<td>".$row[$colName]."</td>";
          }
          echo "</tr>";
       }
    ?>
 </table>
<p>end</p>