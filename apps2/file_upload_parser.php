
<?php 
$name =$_GET["name"];
$location =$_GET["location"];
$fileName = $_FILES["myfile"]["name"]; // The file name
$fileTmpLoc = $_FILES["myfile"]["tmp_name"]; // File in the PHP tmp folder
$fileType = $_FILES["myfile"]["type"]; // The type of file it is
$fileSize = $_FILES["myfile"]["size"]; // File size in bytes
$fileErrorMsg = $_FILES["myfile"]["error"]; // 0 for false... and 1 for true
if (!$fileTmpLoc) { // if file not chosen
echo "ERROR: Please browse for a file before clicking the upload button."; exit(); } 
if(move_uploaded_file($fileTmpLoc, "$location/$name.png"))
{ echo "$fileName upload is complete"; } 
else { echo "move_uploaded_file function failed"; 
} ?>
 