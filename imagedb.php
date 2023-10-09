<html>
<body>

<!--CREATE TABLE  tblimage  (  
   imgid  int(3) unsigned NOT NULL auto_increment,  
   imgtype  varchar(16) NOT NULL default '',  
   imgdata  mediumblob,  
  PRIMARY KEY  ( imgid )  
) TYPE=MyISAM;  

comm.inc 
--------------------------------------  -->
<? 
/*function connectdb(){ 
		include ("../hrmis/class/Connect.php");
        //mysql_connect("localhost","root","") or die(mysql_error()); 
        //mysql_select_db("strong") or die(mysql_error()); 
} */
?> 

<!--imagedb.php 
---------------------------------- -->
<?  
if (!isset($submit)) {  
?>  
<form method="POST" action="" enctype=multipart/form-data>  
<table>  
<tr><td>Type</td><td><select name="imgtype"><option value="image/gif">GIF</option><option  
value="image/jpeg">JPEG</option></select></td></tr>  
<tr><td>File</td><td><input type="file" name="imgfile"></td></tr>  
<tr><td></td><td><input type="submit" name="submit" value="upload"><input type="reset" value="reset"></td></tr>  
</table>  
</form>  
<?  
} else {  
        include ("../hrmis/class/Connect.php");  
		//include "../comm.inc"; 
        //connectdb(); 
        $hndl=fopen($imgfile,"rb");  
        $imgdata='';
        while(!feof($hndl)){ 
                $imgdata.=fread($hndl,2048);  
        } 

        $imgdata=addslashes($imgdata);  

        $sql = "INSERT INTO tblimage VALUES(NULL,'". $imgtype ."','". $imgdata ."')";  

        @mysql_query($sql) or die(mysql_error());  

        fclose($hndl);  

        echo "<a href=\"view.php\">view image</a>";  
};  
?> 


</body>
</html>