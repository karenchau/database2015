<!-- connect to the db-->
<!-- get the group number and the classid -->
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
    require_once('connect.php');
    $db = open_connection();
    $email = mysqli_real_escape_string($db, $_SESSION['email']);
    $class = mysqli_real_escape_string($db, $_SESSION['class']);
    //get user's group_id (report_group)
    $query1 = "SELECT * FROM group_list "; 
    $query1 .= "WHERE class = '$class' "; 
    $query1 .= "AND (member1 = '$email' OR member2 = '$email' OR member3 = '$email')";
    $result1 = mysqli_query($db, $query);
    if (!$result1){
        echo 'Query1 failed : '.mysqli_error($db);
        $db->close();
        exit(0);
    }
    $row1 = mysqli_fetch_assoc($result);
    $report_group = $row['group_id'];

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="3333.png">
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="css/main.css" rel="stylesheet">
        <!-- Latest compiled and minified JQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    </head>
    
    <body>
        <!--get all of the group's evals (done by others)-->
        <header>
            <h3>Available Evaluation Forms</h3>
        </header>
        <p>These are the evaluation forms received by groups that graded your work.</p>
        <br>
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">Submitted Evaluation Forms</div>
                <div class="panel-body">
                    <p>Your group's report was evaluated based on the following criteria.</p>
                    <p>Marks were given as follows:
                        <ol>
                            <li> Strongly disagree </li>
                            <li> Somewhat disagree </li>
                            <li> Neither agree nor disagree </li>
                            <li> Somewhat agree </li>
                            <li> Strongly agree </li>
                        </ol>
                    </p>
                </div>
        </div>
        <!-- Find all the evals for this group-->
        <?php
            $query2 ="SELECT * FROM evaluation";
            $query2 .=" WHERE (class = '$class') ";
            $query2 .=" AND (id_report_group = '$report_group' )";
            $result2 = mysqli_query($db, $query);
            if (!$result2){
                echo 'Query2 failed : '.mysqli_error($db);
                $db->close();
                exit(0);
            }
            
        ?>
         <!-- start loop for the number of available evals for this groupid in this classid-->
        <?php while($row2 = mysqli_fetch_assoc($result2)) { ?>
        
            <!-- creating the eval criteria listing -->
            <div id="EvalForm" class="mainbox col-lg-12"> 
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <!-- get the groupid of the group who did this eval -->
                        <?php
                            $eval_group =$row2["id_eval_group"];
                        ?>
                        <h3>Group <?php echo $eval_group ?>'s Evaluation</h3>
                    </div>
                    <div class="panel-body">
                        <ul class="list-group">
                            <a href="#clarity" class="list-group-item">
                                <h4 class="list-group-item-heading"><strong>Clarity</strong></h4>
                                <p class="list-group-item-text">
                                        <p>The report is written in a clear and concise manner.</p>
                                        <p>Grade: <?php $row2['criteria1']; ?></p>
                                </p>
                            </a>
                            <a href="#focus" class="list-group-item  ">
                                <h4 class="list-group-item-heading"><strong>Focus</strong></h4>
                                <p class="list-group-item-text">
                                    <p>The report has a clear argument and stays on topic.</p>
                                    <p>Grade: <?php $row2['criteria2']; ?></p>
                                </p>
                            </a>
                            <a href="#organization" class="list-group-item ">
                                <h4 class="list-group-item-heading"><strong>Organization </strong></h4>
                                <p class="list-group-item-text">
                                    <p>The report has a clear argument and stays on topic.</p>
                                    <p>Grade: <?php $row2['criteria3']; ?></p>
                                </p>
                            </a>
                            <a href="#analysis" class="list-group-item ">
                                <h4 class="list-group-item-heading"><strong>Analysis</strong></h4>
                                <p class="list-group-item-text">
                                    <p>The report supports its argument with strong valid evidence.</p>
                                    <p>Grade: <?php $row2['criteria4']; ?></p>
                                </p>
                            </a>
                            <a href="#comment" class="list-group-item ">
                                <h4 class="list-group-item-heading"><strong>Comment</strong></h4>
                                <p class="list-group-item-text">
                                    <p>The report shows careful attention to detail.</p>
                                    <p>Comment:</p>
                                    <p><?php $row2['comment']; ?></p>
                                </p>
                            </a>
                        </ul>
                        <p>View Group <?php echo $eval_group ?>'s Grades</p>
                    </div>
                </div>
            </div>
            <br>
        <?php } ?>
        
        <?php
            mysqli_close($db);
        ?>
  </html>