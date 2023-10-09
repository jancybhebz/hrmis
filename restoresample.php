<?
include("../hrmis/dump/backupsample.php");
?>
<html>
<head>
<title>phpMyBackup v.<? echo $version;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">
<!--
function restore(what) {
   if (confirm("Are you sure you want to overwrite the database with the file " + what +  "?")) {
         window.location = "restore.php?file=" + what;
   }
}
//-->
</script>
</head>
<body bgcolor="#FFFFFF" text="#000000">
<table width="100%" border="0" cellpadding="3">
  <tr>
    <td bgcolor="#DDDDDD" align="center"> <b><font face="Verdana, Arial, Helvetica, sans-serif">phpMyBackup 
      v.<? echo $version;?></font></b></td>
  </tr>
</table>
<p align="center"><?
if ($file!="") {
	$filename = $file;
	set_time_limit(180);
	if ($compression ==1) $file=gzread(gzopen($path.$file, "r"), 10485760);
	else $file=fread(fopen($path.$file, "r"), 10485760);
	$query=explode(";#%%\n",$file);
	for ($i=0;$i < count($query)-1;$i++) {
		mysql_db_query($dbname,$query[$i],$conn) or die(mysql_error());
	}
	echo "<b>$filename successfully restored!</b>";
}
?></p>
<div align="center">
  <table border="0" cellpadding="5">
    <tr align="center"> 
      <td><u><i>File</i></u></td>
      <td><u><i>Size</i></u></td>
      <td><u><i>Date</i></u></td>
    </tr>
    <?
	$dir=opendir($path); 
	while ($file = readdir ($dir)) { 
	    if ($file != "." && $file != ".." && eregi("\.sql",$file)) { 
	        echo "<tr><td>$file&nbsp;</td>
	        	<td align=\"right\">&nbsp;" . bcdiv(filesize($path.$file),1024,1) . " kB&nbsp;</td>
	        	<td>&nbsp;" . date("Y-m-d H:i",filemtime($path.$file)) . "</td>
	        	<td>&nbsp;<a href=\"javascript:restore('$file')\"><b>Restore</b></a>&nbsp;</td>
	        	<td>&nbsp;<a href=\"dump/$file\">View/Download</a></td>&nbsp;</tr>"; 
	    } 
	}
	closedir($dir);
?>
  </table>
</div>
</body>
</html>
