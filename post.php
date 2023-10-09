<!--post.php 
------------------------------------------- 
<? 
include ("../hrmis/class/Connect.php");  
//include "../comm.inc"; 
//connectdb(); 

$sql = "SELECT imgtype,imgdata FROM tblimage WHERE imgid=". $imgid;  

$result = @mysql_query($sql) or exit("QUERY FAILED!");  
$row=mysql_fetch_object($result); 

$contenttype = @mysql_result($result,0,"imgtype");  
$image = @mysql_result($result,0,"imgdata");  

header("Content-type: $row->imgtype");  
echo $row->imgdata;  
?>  