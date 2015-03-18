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
    
    // get value of id that sent from address bar 
    $id=$_GET['id'];
    $query="SELECT * FROM thread WHERE id='$id'";
    $result=mysqli_query($db, $query);
    $rows=mysqli_fetch_assoc($result);
?>
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
    <!-- Displays the Thread(Question) currently selected-->
    <table width="400" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
        <tr>
            <td>
                <table width="100%" border="0" cellpadding="3" cellspacing="1" bordercolor="1" bgcolor="#FFFFFF">
                    <tr>
                        <td bgcolor="#F8F7F1"><strong>Title: <p><? echo $rows['title']; ?></p></strong></td>
                    </tr>
                    <tr>
                        <td bgcolor="#F8F7F1">Description: <p><? echo $rows['description']; ?></p></td>
                    </tr>
                    <tr>
                        <td bgcolor="#F8F7F1"><strong>By: </strong><p><? echo $rows['email'];?></p></td>
                    </tr>
                    <tr>
                        <td bgcolor="#F8F7F1"><strong>Date/time : </strong><? echo $rows['datetime']; ?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br>
    <?php
        $query="SELECT * FROM post_table WHERE id_thread='$id'";
        $result =mysqli_query($db, $query);
        while($rows = mysqli_fetch_assoc($result)){
    ?>
    <!-- Displays all posts for this thread-->    
    <table width="400" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
        <tr>
            <td>
                <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
                    <tr>
                        <td bgcolor="#F8F7F1"><strong>Post ID</strong></td>
                        <td bgcolor="#F8F7F1">:</td>
                        <td bgcolor="#F8F7F1"><? echo $rows['id']; ?></td>
                    </tr>
                    <tr>
                        <td width="18%" bgcolor="#F8F7F1"><strong>Title</strong></td>
                        <td width="5%" bgcolor="#F8F7F1">:</td>
                        <td width="77%" bgcolor="#F8F7F1"><? echo $rows['title']; ?></td>
                    </tr>
                    <tr>
                        <td bgcolor="#F8F7F1"><strong>User's Email</strong></td>
                        <td bgcolor="#F8F7F1">:</td>
                        <td bgcolor="#F8F7F1"><? echo $rows['id_user']; ?></td>
                    </tr>
                    <tr>
                        <td bgcolor="#F8F7F1"><strong>Answer</strong></td>
                        <td bgcolor="#F8F7F1">:</td>
                        <td bgcolor="#F8F7F1"><? echo $rows['description']; ?></td>
                    </tr>
                    <tr>
                        <td bgcolor="#F8F7F1"><strong>Date/Time</strong></td>
                        <td bgcolor="#F8F7F1">:</td>
                        <td bgcolor="#F8F7F1"><? echo $rows['datetime']; ?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
  </body>
</html>
    <!--
    <table width="400" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
        <tr>
            <form name="form1" method="post" action="addPost.php">
                <td>
                    <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
                        <tr>
                            <td width="18%"><strong>Title</strong></td>
                            <td width="3%">:</td>
                            <td width="79%"><input name="title" type="text" id="title" size="45"></td>
                        </tr>
                        <tr>
                            <td valign="top"><strong>Answer</strong></td>
                            <td valign="top">:</td>
                            <td><textarea name="description" cols="45" rows="3" id="description"></textarea></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><input name="id" type="hidden" value="<? echo $id; ?>"></td>
                            <td><input type="submit" name="Submit" value="Submit">
                                <input type="reset" name="Submit2" value="Reset">
                            </td>
                        </tr>
                    </table>
                </td>
            </form>
        </tr>
    </table>
    <br>
  </body>
</html>