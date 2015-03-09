<?php
$file_name = $_FILES['file']['name'];
$finfo = new finfo(FILEINFO_MIME_TYPE);
$file_type = $finfo->file($_FILES['files']['tmp_name']);

$target_directory = "upload/"; 
$target_file = $target_directory . basename(fileName) ; 
$ok=1;

//This is our size condition
if ($uploaded_size > 1000000)  {  
	echo "File size limit exceeded.<br>";  $ok=0;  
}   

//This is our limit file type condition  
if ($file_type !== 'text/plain')) {
	echo "You may only upload .txt files.<br>"; $ok=0;
}  

//Here we check that $ok was not set to 0 by an error 
if ($ok==0)  {
	echo "Your file was not uploaded.";  
}   
//If everything is ok we try to upload it
else  {
	if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target))  {
		echo "The file ". basename(file_name). " has been uploaded";
	} else { 
		echo "There was an error uploading your file.";
	}  
}
?>