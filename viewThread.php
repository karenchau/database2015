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
    require_once('functions.php');
    //get group id
    $group_id = find_group($class, $email);
?>
<?php
    // get value of id that sent from address bar 
    $id=$_GET['id'];
    $query="SELECT * FROM thread_table WHERE (id = '$id' AND class = '$class') ";
    $result= mysqli_query($db, $query);
    if(!result){
        echo 'Error! We could not find this thread, it either has been deleted or is temporarily unavailable '.mysqli_error($db);
        mysqli_close($db);
        exit(0);
    }
    $row= mysqli_fetch_assoc($result);
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
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php"><img alt="Virtual Learning Environment" src="3333.png">latform</a>
        </div>        
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><p class="navbar-btn"><a href="logout.php" class="btn btn-danger">Sign out</a></p></li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container">   
        <div class="page-header">
            <!-- Welcome the user-->
            <div class="page-header">
                <h1> Group <?php echo $group_id ?> Forum</h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Main Page</a></li>
                    <li><a href="\studentClassPage.php?classid=".$class."\"> <?php echo $class ?></a></li>
                    <li><a href="mainForum.php">Forum</a></li>
                    <li><a class="active"><?php echo $row['title']; ?> </a></li>
                </ol>
            </div>
        </div>
        <!-- The current Thread Question -->
        <div id="read_thread" class="mainbox col-sm-12">
            <div class="panel panel-primary">
                    <div class="panel-heading">
                            <div class="panel-title"> <?php echo $row['title']; ?> </div>
                    </div>  
                    <div class="panel-body">
                        <?php echo $row['description']; ?>
                    </div>
            </div>
        </div>
        <br>
        <!-- Loop to display all posts for this thread -->
        <?php
            $query ="SELECT * FROM post_table";
            $query .=" WHERE id_thread = '$id' ";
            $result = mysqli_query($db, $query);
            if (!$result){
                echo 'Error! Posts were not found: '.mysqli_error($db);
                mysqli_close($db);
                exit(0);
            }  
        ?>
        <?php if (mysqli_num_rows($result) == 0) { ?>
		<p>There are not available posts for this question yet.</p>
	<?php } else { ?>
         <!-- start loop for the number of available posts for this thread-->
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <!-- creating the eval criteria listing -->
                <div id="posted_answers" class="mainbox col-lg-12"> 
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <!-- get all of the post's information -->
                            <?php
                                $title= $row['title'];
                                $description= $row['description'];
                                $datetime= $row['datetime'];
                                $id_user= $row['id_user'];
                            ?>
                            <div class="panel-title"> <?php echo $title; ?> </div>
                        </div>
                        <div class="panel-body">
                            <?php echo $row['description']; ?>
                            <p>Date Posted: <?php echo $datetime; ?></p>
                            <p>Posted By: <?php echo $id_user; ?></p> 
                        </div>
                    </div>
                </div>
                <br>
            <?php } ?>
        <?php } ?>
        <!--New Post Panel -->
        <div id="create_post" class="mainbox col-md-9">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">Post</div>
                </div>
                <div class="panel-body">
                    <form id="post_form" class="form-horizontal" role="form" method="post" action="addPost.php/">
                        <div class="form-group">
                            <label for="post_title" class="col-md-1 control-label">Post Title</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="post_title" placeholder="Please Enter a Title">
                            </div>
                        </div>
                        <div class="form-group">
                            <!-- Text area to use for desc -->
                            <label for="post_description">Please provide a description of your answer</label>
                            <textarea class="form-control" rows="5" name="post_description" placeholder="Description"></textarea>
                        </div>
                        <input type="hidden" name="thread_id" value="<?PHP echo $id ?>">
                        <div class="form-group">
                            
                            <!-- Button -->                                        
                            <div class="col-md-offset-1 col-md-3">
                                <button id="btn-creating_post" name="creating_post" type="submit" class="btn btn-danger"><i class="icon-hand-right"></i> Submit Post</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
            mysqli_close($db);
        ?> 
    </div>
  </body>
</html>
