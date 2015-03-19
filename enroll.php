<?php
	if(!isset($_SESSION['class'])) {
	    header('Location: index.php');
	    return;
	}
?>
<html>
<!-- Latest compiled and minified JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<h3>All students registered for this class</h3>
	<br>
	<?php 
		require_once('connect.php');
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
		// Javascript to enable link to tab
var hash = document.location.hash;
var prefix = "tab_";
if (hash) {
    $('.nav-tabs a[href='+hash.replace(prefix,"")+']').tab('show');
} 

// Change hash for page-reload
$('.nav-tabs a').on('shown', function (e) {
    window.location.hash = e.target.hash.replace("#", "#" + prefix);
});
		$(document).ready(function(){
			$('#enrollform').on('submit',function(e) {
				$.ajax({
					url:'register.php',
					data:$(this).serialize(),
					type:'POST',
					success:function(data){
						console.log(data);
						var option = $.parseJSON (data);
						if(option["success"] == true) {
							$("#success").show().fadeOut(5000); // shows success message
						} else {
							if (option["message_num"] == "1") {
								$("#error1").show().fadeOut(5000); // shows error message # 1
							} else {
								if (option["message_num"] == "2") {
									$("#error2").show().fadeOut(5000); // shows error message # 2
								} else {
									if (option["message_num"] == "3") {
										$("#error3").show().fadeOut(5000); // shows error message # 3
									} else {
										if (option["message_num"] == "4") {
											$("#error4").show().fadeOut(5000); // shows error message # 4
										} else {
											$("#error").show().fadeOut(5000); // shows general error message
										}
									}
								}
							}
						}
					},
					error:function(data){
						$("#error").show().fadeOut(5000); // shows general error message
					}
				});
				e.preventDefault(); //=== To Avoid Page Refresh and Fire the Event "Click"===
				<?php header("Location: adminClassPage.php?classid=<?php $_SESSION[class];?>#students"); ?>
			});
		});
	</script>
	<br>
	<h3>Enroll a student</h3>
	<div class="alert alert-danger" role="alert" id="error1" style="display: none;">Error!: Please enter an email.</div>
	<div class="alert alert-danger" role="alert" id="error2" style="display: none;">Error!: This is not a registered user on Platform yet.</div>
	<div class="alert alert-danger" role="alert" id="error3" style="display: none;">Error!: This student is already registered for this class.</div>
	<div class="alert alert-danger" role="alert" id="error4" style="display: none;">Error!: You cannot add another admin to this class.</div>
	<div class="alert alert-danger" role="alert" id="error" style="display: none;">Error!: There is an error with your request.</div>
	<div class="alert alert-success" role="alert" id="success" style="display: none;">Success!</div>
	<form name="enrollform" id="enrollform">
		<div class="form-group">
			<label class="control-label col-sm-1">Email:</label>

			<input type="email" class="form-control" id="studentemail" name="studentemail" placeholder="Enter student's email">
		</div>
		<div class="form-group">
			<label class="control-label col-sm-1">Class:</label>
			<input type="text" id="c" name="c" class="form-control" readonly="readonly" placeholder="<?php echo $_SESSION['class']?>" value="<?php echo $_SESSION['class']?>">
		</div>
		<button type="submit" class="btn btn-primary" name="enroll" id="enroll">Enroll</button>
	</form>
	<form name="removeform" id="removeform">
		<div class="form-group">
			<label class="control-label col-sm-1">Email:</label>

			<input type="email" class="form-control" id="studentemail" name="studentemail" placeholder="Enter student's email">
		</div>
		<div class="form-group">
			<label class="control-label col-sm-1">Class:</label>
			<input type="text" id="c" name="c" class="form-control" readonly="readonly" placeholder="<?php echo $_SESSION['class']?>" value="<?php echo $_SESSION['class']?>">
		</div>
		<button type="submit" class="btn btn-danger" name="remove" id="remove">Remove</button>
	</form>
</html>