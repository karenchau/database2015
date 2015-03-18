<?php
	//If the user submits the form, then this would initiate this if statement
	if (isset($_POST['submit'])) {
	    if (isset($_POST['input_group'])) {
	        if (empty($_POST['input_group'])) {
	            $submit_errors = "You must select a group to evaluate.";
	        } else if (!isset($_POST['inlineRadioOptions1']) || !isset($_POST['inlineRadioOptions2']) || !isset($_POST['inlineRadioOptions3']) || !isset($_POST['inlineRadioOptions4']) || !isset($_POST['inlineRadioOptions5'])) {
	            $submit_errors ="\nYou must submit a score for ALL criteria.";
	        } else if (!isset($_POST(['comments']))) {
	          $submit_errors = "Please provide comments to elaborate on your evaluations.";
	        } else {
	            require_once('connect.php');
	            $db = open_connection();
	            $class = mysqli_real_escape_string($db, $_SESSION['class']);
	            $report_group = mysqli_real_escape_string($db, $_POST['submit']);
	            $criteria1 = (int) $_POST['inlineRadioOptions1'];
	            $criteria2 = (int) $_POST['inlineRadioOptions2'];
	            $criteria3 = (int) $_POST['inlineRadioOptions3'];
	            $criteria4 = (int) $_POST['inlineRadioOptions4'];
	            $criteria5 = (int) $_POST['inlineRadioOptions5'];
	            $overall = (int) ($criteria1 + $criteria2 + $criteria3 + $criteria4 + $criteria5);
	            $comments = mysqli_real_escape_string($db, $_POST['comments']);
	            $query = "UPDATE evaluation SET comment='$comments',criteria1=$criteria1,criteria2=$criteria2,criteria3=criteria3,criteria4=$criteria4,criteria5=$criteria5,grade=$overall) WHERE (id_report_group='$report_group' AND id_eval_group='$group_entry') AND class='$class'";
	            $result = mysqli_query($db, $query);
	            
	            if (mysqli_num_rows($result) > 0) {
	                    echo "Your evaluation has been successfully submitted."
	                } else {
	                    mysql_close($db);
	                    echo "Error: your evaluation was not submitted."
	                }
	            }
	  } else {
	    unset($submit_errors);
	  }
	}
?>