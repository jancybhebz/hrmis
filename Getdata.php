<?php
// getdata.php3 - by Florian Dittmer <dittmer@gmx.net>
// Example php script to demonstrate the direct passing of binary data
// to the user. More infos at http://www.phpbuilder.com
// Syntax: getdata.php3?id=<id>
//require("../hrmis/class/Employee.php");
//$objEmployee = new employee;
//$strImage = $objEmployee->getPicture($strEmpNumber, $id);
//echo $strImage;
 if($t_strEmpNumber) {

	// you may have to modify login information for your database server:
	//@MYSQL_CONNECT("localhost","root","password");

	//@mysql_select_db("binary_data");
	include("../hrmis/class/Connect.php");
	$query = "select picture,filetype from tblEmpPicture where empNumber='$t_strEmpNumber' ";
	$result = @MYSQL_QUERY($query);

	$data = @MYSQL_RESULT($result,0,"picture");
	$type = @MYSQL_RESULT($result,0,"filetype");

	Header("Content-type: $type");
	echo $data;
}; 
?> 