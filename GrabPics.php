<?
//GrabPics.php

//get the value of $id from the previous page
$id=$id;

//for updating picture...delete the existing one then insert the new image... 
if ($action=="Edit")
{
        $sql=mysql_query("DELETE FROM tblPictures WHERE ImgID LIKE '$id'");
} //end: if action = Edit

//get the details of the picture
global $fileUpload;
global $fileUpload_name;
global $fileUpload_size;
global $fileUpload_type;

//traps if the file directory is Empty
if($fileUpload == "")
        die ("<font face=\"Arial\" color=\"#FF0000\"><b><p><p>"."You must enter
        file directory...".        "</font></b></p></p><br>"."<a
        href=\"getPics.php?id=$id&action=Edit\">Back</a>");
$fileHandle = fopen($fileUpload, "r");
$fileContent = fread($fileHandle, $fileUpload_size);
$fileContent = addslashes($fileContent);

//insert to DB
$dbQuery = "INSERT INTO tblPictures(ImgID) VALUES('$ImgID')";
mysql_query($dbQuery) or die (mysql_error());
echo "<font face=\"Arial\" color=\"#FF0000\">";
echo "<h1>Picture Uploaded</h1>";
echo "</font>";
echo "The details of the uploaded image are shown below:<br><br>"; 
echo "<b>Image name:</b> $fileUpload_name <br>";
echo "<b>Image type:</b> $fileUpload_type <br>";
echo "<b>Image size:</b> $fileUpload_size <br>";
echo "<b>Uploaded to:</b> $fileUpload <br><br>";
?>
<a href="showprofile.php?id=<? echo $id;?>">View Profile</a>


