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
  <!--get array(?) of groups to assess-->

  <p> Click the name of the file to start downloading the group's report. When you have finished reading the report, submit an evaluation using the form below for the corresponding group.</p>
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
  <form>
    <div class = "form-group">
      <label for="input_group">Select a group to evaluate</label>
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
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions1" id="inlineRadio1" value="option1"> 1
      </label>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions1" id="inlineRadio2" value="option2"> 2
      </label>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions1" id="inlineRadio3" value="option3"> 3
      </label>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions1" id="inlineRadio4" value="option3"> 4
      </label>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions1" id="inlineRadio5" value="option3"> 5
      </label>

      <b>Focus</b>
      <p>The report has a clear argument and stays on topic.</p>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions2" id="inlineRadio1" value="option1"> 1
      </label>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions2" id="inlineRadio2" value="option2"> 2
      </label>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions2" id="inlineRadio3" value="option3"> 3
      </label>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions2" id="inlineRadio4" value="option3"> 4
      </label>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions2" id="inlineRadio5" value="option3"> 5
      </label>

      <b>Organization</b>
      <p>The report is well structured and organized.</p>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions3" id="inlineRadio1" value="option1"> 1
      </label>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions3" id="inlineRadio2" value="option2"> 2
      </label>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions3" id="inlineRadio3" value="option3"> 3
      </label>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions3" id="inlineRadio4" value="option3"> 4
      </label>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions3" id="inlineRadio5" value="option3"> 5
      </label>

      <b>Analysis</b>
      <p>The report supports its argument with strong valid evidence.</p>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions4" id="inlineRadio1" value="option1"> 1
      </label>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions4" id="inlineRadio2" value="option2"> 2
      </label>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions4" id="inlineRadio3" value="option3"> 3
      </label>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions4" id="inlineRadio4" value="option3"> 4
      </label>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions4" id="inlineRadio5" value="option3"> 5
      </label>

      <b>Detail</b>
      <p>The report shows careful attention to detail.</p>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions5" id="inlineRadio1" value="option1"> 1
      </label>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions5" id="inlineRadio2" value="option2"> 2
      </label>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions5" id="inlineRadio3" value="option3"> 3
      </label>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions5" id="inlineRadio4" value="option3"> 4
      </label>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions5" id="inlineRadio5" value="option3"> 5
      </label>

      <!-- Text area to submit comments -->
      <label for="comments">Please provide constructive criticism elaborating on your evaluation of this report.</label>
      <textarea class="form-control" rows="3" name="comments" placeholder="Comments"></textarea>
    </div>
  </form>

  </html>