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
		mysqli_close($db);
	?>

	<div class="container">
		<h3>Enroll Student</h3>
		<form>
			<div class="form-group">
				<label class="control-label col-sm-2">Email:</label>
				<div class="col-sm-10">          
					<input type="email" class="form-control" id="studentemail" placeholder="Enter student's email">
				</div>
			</div>
			<div class="form-group">        
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</div>
		</form>
	</div>
</html>