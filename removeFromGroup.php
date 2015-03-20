<?php
    session_start();
    if (!isset($_SESSION['email'])) {
      header('Location: login.php');
      return;
    }
    if (!isset($_SESSION['class'])){
        header('Location: index.php');
        return; 
    }
?>

<?php
    //get the student id
    //get the group id
    // remove from the group
    if (empty($_POST['studentemail2'])) {
	    $group_management_errors = "1"; //Error!: Please enter an email.
    } else {
	require_once('connect.php');
	$db = open_connection();
	$student_email = mysqli_real_escape_string($db, $_POST['studentemail2']);
	$group_id = mysqli_real_escape_string($db, $_POST['groupNum2']);
        $class = mysqli_real_escape_string($db, $_POST['c2']);
        $query = "SELECT * FROM group_list WHERE class ='$class' AND id ='$group_id' ";
        //get other members in the group
        $member1 = $row['member1'];
        $member2 = $row['member2'];
        $member3 = $row['member3'];
        //delete group
        $query2 = "DELETE from group_list where id = '$group_id' and class = '$class' ";
        mysqli_query($db, $query2);
        //reinsert group
        if($member1 == $student_email)
        {
            if ($member1 != NULL || $member2 != NULL) //if both null, we don't need to reinsert
            {
                $query3 = "INSERT INTO group_list (group_id, class, member1, member2, grade, num_groups) VALUES ('$group_id', '$class', '$member1', '$member2', 0, 0 )";
            }
        }
        else{
            if($member2 == $student_email)
            {                
                if ($member1 != NULL || $member3 != NULL) //if both null, we don't need to reinsert
                {
                    $query3 = "INSERT INTO group_list (group_id, class, member1, member2, grade, num_groups) VALUES ('$group_id', '$class', '$member1', '$member3', 0, 0 )";
                }
            }
            else
            {
                if ($member2 != NULL || $member3 != NULL) //if both null, we don't need to reinsert
                {
                    $query3 = "INSERT INTO group_list (group_id, class, member1, member2, grade, num_groups) VALUES ('$group_id', '$class', '$member2', '$member3', 0, 0 )";
                }
            
            }
        }
        
	$result = mysqli_query($db, $query3);
	if (!result) {
	    echo 'group management error ' .mysqli_error($db); //Error!: This user is not on the roster.
	}
	mysqli_close($db);
	}
        
	if ($group_management_errors) {
	    echo json_encode(array('success' => false, 'message_num' => "$group_management_errors")); 
	} else {
	    echo json_encode(array('success' => true)); 
	}
	unset($group_management_errors);
?>