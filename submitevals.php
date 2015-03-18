<?php

if (!isset($_POST['input_group']) OR $_POST['input_group'] == '0') {
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
        //Get user's group number
          $query = "SELECT group_id FROM group_list WHERE '$email' IN(member1, member2, member3) AND class = '$class'";
          $result = mysqli_query($db, $query);
          
          if (mysqli_num_rows($result) > 0) {
            $group_entry = mysqli_getresult($result, mysqli_num_rows($result), 0);
            } else {
              echo "You are not in a group.";
            }
        $class = mysqli_real_escape_string($db, $_SESSION['class']);
        echo $class;
        $report_group = mysqli_real_escape_string($db, $_POST['submit']);
        echo $report_group;
        $criteria1 = (int) $_POST['inlineRadioOptions1'];
        echo $criteria1;
        $criteria2 = (int) $_POST['inlineRadioOptions2'];
        echo $criteria2;
        $criteria3 = (int) $_POST['inlineRadioOptions3'];
        echo $criteria3;
        $criteria4 = (int) $_POST['inlineRadioOptions4'];
        echo $criteria4;
        $criteria5 = (int) $_POST['inlineRadioOptions5'];
        echo $criteria5;
        $overall = (int) ($criteria1 + $criteria2 + $criteria3 + $criteria4 + $criteria5);
        echo $overall;
        $comments = mysqli_real_escape_string($db, $_POST['comments']);
        echo $comments;
        
        $query = "UPDATE evaluation SET comment='$comments',criteria1=$criteria1,criteria2=$criteria2,criteria3=$criteria3,criteria4=$criteria4,criteria5=$criteria5,grade=$overall) WHERE (id_report_group='$report_group' AND id_eval_group='$group_entry') AND class='$class'";
        $result = mysqli_query($db, $query);
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                    echo "Your evaluation has been successfully submitted.";
                } else {
                    mysql_close($db);
                    echo "Error: your evaluation was not submitted.";
                }
        } else {
            echo "Could not submit evaluation.";
        }
    }
}
	
?>