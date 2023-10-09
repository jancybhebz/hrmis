<?
/* 
File Name: EmployeeAbsent.php
----------------------------------------------------------------------
Purpose of this file: 
Employees absent
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Brian Jill DG. Sarandi
----------------------------------------------------------------------
Date of Revision: July 19, 2004
----------------------------------------------------------------------
Copyright Notice:
Copyright (C) 2003 by the Department of Science and Technology
----------------------------------------------------------------------
LICENSE:
This program is free software; you can redistribute it and/or modify 
it under the terms of the GNU General Public License (GPL) as published 
by the Free Software Foundation; either version 2 of the License, or 
(at your option) any later version. This program is distributed in the 
hope that it will be useful, but WITHOUT ANY WARRANTY; without even the 
implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  
See the GNU General Public License for more details.
To read the license please visit http://www.gnu.org/copyleft/gpl.html
 ----------------------------------------------------------------------
*/

require("../hrmis/class/LoginDTR.php");
$objAbsent = new LoginDTR;
?>
<html>
<head>
<title>Employees Absent</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.background {
	background-color: #6699CC;
	background-image: url(images/bluebg.jpg);
}
-->
</style>
<link href="hrmis.css" rel="stylesheet" type="text/css">
</head>
<body>
<table cellpadding="0" cellspacing="0" width="560" height="360" class="background">
<tr><td height="20" colspan="4"></td></tr>
<tr><td height="30" colspan="4" valign="middle" align="center">EMPLOYEES ABSENT</td></tr>
<tr>
<td width="20%"></td>
<td width="60%" height="20" align="center">Employee Name</td>
<td width="20%"></td>
</tr>
<?
$objAbsent->getEmpAbsForNow(10, $p);
?>
<tr><td height="20" colspan="4" align="center"><? $objAbsent->output();?></td></tr>
</table>
</body>
</html>

