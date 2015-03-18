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

    <script type="text/javascript">
    $(document).ready(function(){
        $("input[type='button']").click(function(){
            var radioValue = $("input[name='gender']:checked").val();
            if(radioValue){
                alert("Your are a - " + radioValue);
            }
        });
        
    });
</script>
  </head>
  
  <body>
  <!--get array(?) of groups to assess-->
  <header>
    <h3>Report Download</h3>
  </header>
  <p> These are the groups whose reports you have been assigned to evaluate. Click the name of the file to start downloading the group's report. When you have finished reading the report, submit an evaluation using the form below for the corresponding group.</p>
  <?php
  
  // Connect to the database
  $db = open_connection();
  if(mysqli_connect_errno()) {
      die("MySQL connection failed: ". mysqli_connect_error());
  }

  $class = mysqli_real_escape_string($db, $_SESSION['class']);;
  $email = mysqli_real_escape_string($db, $_SESSION['email']);; 
  
  //Get user's group number
  $query = "SELECT group_id FROM group_list WHERE '$email' IN(member1, member2, member3) AND class = '$class'";
  $result = mysqli_query($db, $query);
  
  if (mysqli_num_rows($result) > 0) {
    $group_entry = mysqli_getresult($result, mysqli_num_rows($result), 0);
    } else {
      echo "You are not in a group.";
    }
  

  // Query for all assigned reports  
  $query = "SELECT group_id, name, type, size, uploadtime from report where (group_id in (SELECT id_report_group FROM evaluation WHERE class = '$class' AND id_eval_group = '$group_entry')) AND class = '$class'";
  $result = mysqli_query($db,$query);
  mysqli_close($db);

  
  // Check if query was successful
  if($result) {
      // Make sure there are some files in there
      if($result->num_rows == 0) {
          echo '<p>There are no files in the database</p>';
      }
      else {
        // Print the top of a table
        echo '<table width="100%">
                <tr>
                    <td><b>Group</b></td>
                    <td><b>Name</b></td>
                    <td><b>Type</b></td>
                    <td><b>Size (bytes)</b></td>
                    <td><b>Date Submitted</b></td>
                </tr>';
 
        // Print each file
        while($row = $result->fetch_assoc()) {
            echo "
                <tr>
                    <td>{$row['group_id']}</td>
                    <td><a href = 'get_file.php?id={$row['group_id']}'>{$row['name']}</a></td>
                    <td>{$row['type']}</td>
                    <td>{$row['size']}</td>
                    <td>{$row['uploadtime']}</td>
                </tr>";
        }
 
        // Close table
        echo '</table>';
      }
   
      // Free the result
      //mysqli_free_result($result);
  }
  else
  {
      echo 'Error! SQL query failed:';
      echo "<pre>{$db->error}</pre>";
  }
  mysqli_close($db);
  ?>
  <br>
  <br>
  <header>
    <h3>Evaluation Submissions</h3>
  </header>
  <p>Please evaluate each group's report based on the following criteria.</p>
  <p>Marks should be given as follows:
    <ol>
      <li> Strongly disagree </li>
      <li> Somewhat disagree </li>
      <li> Neither agree nor disagree </li>
      <li> Somewhat agree </li>
      <li> Strongly agree </li>
    </ol>
  </p>
  <form action="" method="post">
    <div class = "form-group">
      <label for="input_group">Select a group to evaluate:</label>
        <select class="form-control" name = "input_group">
          <!-- Use $result to get group numbers to populate dropdown -->
          <?php
            $db = open_connection();
            $query = "SELECT group_id from report where (group_id in (SELECT id_report_group FROM evaluation WHERE class = '$class' AND id_eval_group = '$group_entry')) AND class = '$class'";
            $result = mysqli_query($db,$query);

            while(list($category) = mysqli_fetch_row($result)){
              $option = '<option value="'.$category.'">'.$category.'</option>';
              echo ($option);
            }

            mysqli_close($db);
          ?>
        </select>
      <br>


      <b>Clarity</b>
      <p>The report is written in a clear and concise manner.</p>
<!--
      <div class="btn-group" id="clarity" data-toggle="buttons">
        <label class="btn btn-default blue">
          <input type="radio" class="toggle" value="1">1
        </label>
        <label class="btn btn-default blue">
          <input type="radio" class="toggle" value="2"> 2
        </label>
        <label class="btn btn-default blue">
          <input type="radio" class="toggle" value="3"> 3
        </label>
        <label class="btn btn-default blue">
          <input type="radio" class="toggle" value="4"> 4
        </label>
        <label class="btn btn-default blue">
          <input type="radio" class="toggle" value="5"> 5
        </label>
      </div>
      -->

      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions1" id="inlineRadio1" value="1"> 1
      </label>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions1" id="inlineRadio2" value="2"> 2
      </label>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions1" id="inlineRadio3" value="3"> 3
      </label>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions1" id="inlineRadio4" value="4"> 4
      </label>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions1" id="inlineRadio5" value="5"> 5
      </label><br><br>

      <b>Focus</b>
      <p>The report has a clear argument and stays on topic.</p>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions2" id="inlineRadio1" value="1"> 1
      </label>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions2" id="inlineRadio2" value="2"> 2
      </label>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions2" id="inlineRadio3" value="3"> 3
      </label>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions2" id="inlineRadio4" value="4"> 4
      </label>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions2" id="inlineRadio5" value="5"> 5
      </label><br><br>

      <b>Organization</b>
      <p>The report is well structured and organized.</p>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions3" id="inlineRadio1" value="1"> 1
      </label>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions3" id="inlineRadio2" value="2"> 2
      </label>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions3" id="inlineRadio3" value="3"> 3
      </label>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions3" id="inlineRadio4" value="4"> 4
      </label>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions3" id="inlineRadio5" value="5"> 5
      </label><br><br>

      <b>Analysis</b>
      <p>The report supports its argument with strong valid evidence.</p>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions4" id="inlineRadio1" value="1"> 1
      </label>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions4" id="inlineRadio2" value="2"> 2
      </label>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions4" id="inlineRadio3" value="3"> 3
      </label>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions4" id="inlineRadio4" value="4"> 4
      </label>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions4" id="inlineRadio5" value="5"> 5
      </label><br><br>

      <b>Detail</b>
      <p>The report shows careful attention to detail.</p>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions5" id="inlineRadio1" value="1"> 1
      </label>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions5" id="inlineRadio2" value="2"> 2
      </label>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions5" id="inlineRadio3" value="3"> 3
      </label>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions5" id="inlineRadio4" value="4"> 4
      </label>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions5" id="inlineRadio5" value="5"> 5
      </label><br><br>

      <!-- Text area to submit comments -->
      <label for="comments">Please provide constructive criticism elaborating on your evaluation of this report.</label>
      <textarea class="form-control" rows="3" name="comments" placeholder="Comments"></textarea>
    </div>
    <p class="help-block">Please check that all evaluations are accurate, as all submissions are final. No re-submissions are allowed.</p>
    <input type="submit" name="submit" value = "Submit Evaluation" class="btn btn-default">
  </form>

  </html>