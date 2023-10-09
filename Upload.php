<html>
<body>
<form name="form1" method="post" action="" enctype="multipart/form-data"> 
<input type="file" name="imagefile"> 
<input type="submit" name="Submit" value="Submit"> 
<? 
if(isset( $Submit )) 
{ 
//If the Submitbutton was pressed do: 

if ($_FILES['imagefile']['type'] == "image/gif"){ 
    copy ($_FILES['imagefile']['tmp_name'], "files/".$_FILES['imagefile']['name']) 
    or die ("Could not copy"); 
        echo ""; 
        echo "Name: ".$_FILES['imagefile']['name'].""; 
        echo "Size: ".$_FILES['imagefile']['size'].""; 
        echo "Type: ".$_FILES['imagefile']['type'].""; 
        echo "Copy Done...."; 
        } 
        else { 
            echo ""; 
            echo "Could Not Copy, Wrong Filetype (".$_FILES['imagefile']['name'].")"; 
        } 
} 
?> 
</form>
</body> 
</html>
