<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    return;
}
if(!isset($_SESSION['class'])) {
    header('Location: index.php');
    return;
}
?>

<?php
if (!isset($_POST['input_group']) OR $_POST['input_group'] == 'default') {
    echo "Error. Select a group to evaluate.";
} else{
    echo "else statement";
    if (!isset($_POST['inlineRadioOptions1']) OR !isset($_POST['inlineRadioOptions2']) OR !isset($_POST['inlineRadioOptions3']) OR !isset($_POST['inlineRadioOptions4']) OR !isset($_POST['inlineRadioOptions5'])) {
    $submit_errors ="You must submit a score for ALL criteria.";
    echo $submit_errors;
    } else if (!isset($_POST['comments']) OR empty($_POST['comments'])) {
      $submit_errors = "Please provide comments to elaborate on your evaluations.";
      echo $submit_errors;
    } else {
        require_once('connect.php');
        $db = open_connection();

        $class = mysqli_real_escape_string($db, $_SESSION['class']);
        $email = mysqli_real_escape_string($db, $_SESSION['email']);
        require_once('functions.php');
        //Get assessing and assessed groups and check that an evaluation has not already been submitted.
        $group_entry = find_group($class,$email);
        $report_group = mysqli_real_escape_string($db, $_POST['input_group']);

        //Check if you are eligible to submit an evaluation (no duplicate evaluation submissions and evaluation assignments).
        $query = "SELECT criteria1 FROM evaluation WHERE id_report_group='$report_group' AND id_eval_group='$group_entry' AND class = '$class'";
        $result = mysqli_query($db,$query);
        if (!$result OR mysqli_num_rows($result) == 0) {
            echo "You do not have the permissions to submit an evaluation for this group's report."; 
        } else {
            $row = mysqli_fetch_row($result);
            $check = $row['criteria1'];
            if is_null($check) {
                $criteria1 = (int) $_POST['inlineRadioOptions1'];
                $criteria2 = (int) $_POST['inlineRadioOptions2'];
                $criteria3 = (int) $_POST['inlineRadioOptions3'];
                $criteria4 = (int) $_POST['inlineRadioOptions4'];
                $criteria5 = (int) $_POST['inlineRadioOptions5'];
                $overall = (int) ($criteria1 + $criteria2 + $criteria3 + $criteria4 + $criteria5);
                $comments = mysqli_real_escape_string($db, $_POST['comments']);
                
                $query1 = "UPDATE evaluation SET comment='$comments', criteria1=$criteria1, criteria2=$criteria2, criteria3=$criteria3, criteria4=$criteria4, criteria5=$criteria5, WHERE id_report_group='$report_group' AND id_eval_group='$group_entry' AND class='$class'";
                $result1 = mysqli_query($db, $query1);
                //$query2 = "UPDATE group_list SET grade = 10, num_groups = 5 WHERE group_id='$report_group' AND class='$class'";
                //$result2 = mysqli_query($db,$query2);
                if ($result1) {
                    echo "Your evaluation has been successfully submitted.";
                } else {
                    echo "Error: could not submit evaluation.";
                }
            } else {
                echo "You have already submitted an evaluation for this group's report.";
            }
        }
    mysqli_close($db);
    }
}
	
?>