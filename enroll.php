<html>
<!-- Latest compiled and minified JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

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
<script>
	$(document).ready(function() {
		$("#enroll").click(function() {
			var email = $("#studentemail").val();
			if (email == '') {
				alert("Insertion Failed Some Fields are Blank....!!");
			} else {
			// Returns successful data submission message when the entered information is stored in database.
				$.post("register.php", {
					email1: email
				}, function(data) {
					alert(data);
					$('#enrollform')[0].reset(); // To reset form fields
				});
			}
		});
	});
</script>
	<div class="container">
		<h3>Enroll a student</h3>
		<form name="enrollform" id="enrollform">
			<div class="form-group">
				<label class="control-label col-sm-1">Email:</label>
				<div class="col-sm-5">          
					<input type="email" class="form-control" id="studentemail" placeholder="Enter student's email">
				</div>
				<div class="col-sm-2">
					<span id="error" style="display:none; color:#F00">Some Error!Please Fill form Properly </span> <span id="success" style="display:none; color:#0C0">All the records are submitted!</span>
					<button type="submit" class="btn btn-primary" name="enroll" id="enroll">Submit</button>
				</div>
			</div>
		</form>
	</div>
</html>