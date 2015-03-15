<html>
	<h3>All students registered for this class</h3>
	<br>
	<?php
		$db = open_connection();
		// This nested query first finds all the students enrolled in the class and then uses those results to find their names.
		$query = "SELECT first_name, last_name, email from user where email in (SELECT student_id from enrolled_list where class = '$_SESSION[class]')";
		$result = mysqli_query($db, $query);
		if (mysqli_num_rows($result) > 0) {
			print_table($result);
		} else {
			$reg_none_error = "No one is registered for this class yet.";
			echo "<div class=\"alert alert-danger\" role=\"alert\">$reg_none_error</div>";
		}
	?>
	<br>
	<h3>Manage Registration</h3>
	<form name="searchForm" id="searchForm" method="POST" />
		<div class="input-append">
			<input class="span2" id="appendedInputButton" name="search_term" type="text">
			<input class="span2" id="search_type" name="search_type" type="hidden">
			<div class="btn-group">
				<button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
					Action
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" role="menu">
					<li onclick="$('#search_type').val('UPDATE'); $('#searchForm').submit()">Enroll a student</li>
					<li onclick="$('#search_type').val('Remove student'); $('#searchForm').submit()">Unenroll a student</li>
					<li onclick="$('#search_type').val('state'); $('#searchForm').submit()">Search State</li>
					<li onclick="$('#search_type').val('zip'); $('#searchForm').submit()">Search Zip Code</li>
				</ul>
			</div>
		</div>
	</form>

	<?php
		echo $_POST['search_type'];
		mysqli_close($db);
	?>
	<br>
</html>