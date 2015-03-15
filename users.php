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
		$("#searchbar").on("keyup", function() {
			var value = $(this).val();

			$("table tr").each(function(index) {
				if (index !== 0) {

					$row = $(this);

					var id = $row.find("td:first").text();

					if (id.indexOf(value) !== 0) {
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