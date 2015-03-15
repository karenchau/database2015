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
	<h3>Enroll a student</h3>
	<div class="input-group">
		<input type="text" name="studentemail" class="form-control" placeholder="Enter email address">
		<span class="input-group-btn">
			<button id="btn-enroll" name="enroll" class="btn btn-primary" type="submit">Enroll</button>
		</span>
	</div>
	<?php
		if (isset($_POST['enroll'])) {
			if (isset($_POST['studentemail']) || empty($_POST['studentemail']) {
				$enroll_errors = 'Error!: Please enter an email address';
			}
		}
		mysqli_close($db);
	?>
	<br>
</html>