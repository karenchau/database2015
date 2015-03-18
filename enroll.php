<?php
	if(!isset($_SESSION['class'])) {
	    header('Location: index.php');
	    return;
	}
?>
<html>
<!-- Latest compiled and minified JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

	<h3>All students registered for this class <?php echo $_SESSION['class']?></h3>
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
		$(document).ready(function(){
			$('#enrollform').on('submit',function(e) {
				$.ajax({
					url:'register.php',
					data:$(this).serialize(),
					type:'POST',
					success:function(data){
						console.log(data);
						var option = $.parseJSON (data);
						//document.write(option["message"]);
						if(option["success"] == true) {
							$("#success").show().fadeOut(5000); //=== Show Success Message==
						} else {
							$("#error").show().fadeOut(5000); //===Show Error Message====
						}
					},
					error:function(data){
						$("#error").show().fadeOut(5000); //===Show Error Message====
					}
				});
				e.preventDefault(); //=== To Avoid Page Refresh and Fire the Event "Click"===
			});
		});
	</script>
	<br>
	<h3>Enroll a student</h3>
	<div class="alert alert-danger" role="alert" id="error" style="display: none;">Please enter a valid student's email.</div>
	<div class="alert alert-success" role="alert" id="success" style="display: none;">Success!</div>
	<form name="enrollform" id="enrollform">
		<div class="form-group">
			<label class="control-label col-sm-1">Email:</label>
			<div class="col-sm-5">          
				<input type="email" class="form-control" id="studentemail" name="studentemail" placeholder="Enter student's email">
			</div>
			<div class="col-sm-2">
				<button type="submit" class="btn btn-primary" name="enroll" id="enroll">Submit</button>
			</div>
		</div>
	</form>
</html>