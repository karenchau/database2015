<html>
	<h3>All students</h3>
	<br>
	<?php
		$db = open_connection();
		$query = "SELECT first_name, last_name, email, department, year from user where role = '0' ";
		$result = mysqli_query($db, $query);
		if (mysqli_num_rows($result) > 0) {
			print_table($result);
		} else {
			$no_studentuser_error = "No one is registered as a student user on Platform yet.";
			echo "<div class=\"alert alert-danger\" role=\"alert\">$no_studentuser_error</div>";
		}
		?>
		<input type="text" id="searchbar" placeholder="Type in a student's first name."></input>
		<script> 
			$("#search").on("keyup", function() {
				var value = $(this).val().toLowerCase();

				$("table tr").each(function(index) {
					if (index !== 0) {

						$row = $(this);

						var id = $row.find("td:first").text();
						var id2 = $row.find("td:nth-child(2)").text();
						var id3 = $row.find("td:nth-child(3)").text();
						var id4 = $row.find("td:nth-child(4)").text();
						var id5 = $row.find("td:nth-child(5)").text();

						if (id.toLowerCase().indexOf(value) !== 0 && 
							id2.toLowerCase().indexOf(value) !== 0 && 
							id3.toLowerCase().indexOf(value) !== 0 && 
							id4.toLowerCase().indexOf(value) !== 0 && 
							id5.toLowerCase().indexOf(value) !== 0 &&) {
							$row.hide();
						}
						else {
							$row.show();
						}
					}
				});
			});
		</script>
</html>