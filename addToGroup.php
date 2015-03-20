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
    if (empty($_POST['studentemail'])) {
	    $group_management_errors = "1"; //Error!: Please enter an email.
    } else {
	require_once('connect.php');
	$db = open_connection();
	$student_email = mysqli_real_escape_string($db, $_POST['studentemail']);
	$group_id = mysqli_real_escape_string($db, $_POST['groupNum']);
        $class = mysqli_real_escape_string($db, $_POST['c']);
        $query = "SELECT * FROM group_list WHERE class ='$class' AND id ='$group_id' ";
        $result = mysqli_query($db, $query);
        if(!result)
        {
            echo 'Error, we could not fetch the infromation from the Database ' .mysqli_error($db);
        }
        //get other members in the group, member1 is never null (if the group exists)
        $member1 = $row['member1'];
        $member2 = $row['member2'];
        $member3 = $row['member3'];
        if(($student_email != $member1) && (($student_email != $member2) && ($student_email != $member3)))
        {
            //the student is not in the group
            if ($member2 != NULL && $member3 != NULL)
            {
                //table is full
                $group_management_errors = "2";
            }
            else
            {
                if ($member2 != NULL)
                {
                    $query2 = " UPDATE group_list SET member3 ='$student_email' WHERE (group_id='$group_id' AND class = '$class' )";  
                }
                else
                {
                    $query2 = " UPDATE group_list SET member2 ='$student_email' WHERE (group_id='$group_id' AND class = '$class' )";  
                    
                }
                
            }
        }
        else
        {
            $group_management_errors = "3";
            mysqli_close($db);
        }

        
?>