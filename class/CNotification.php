<?php 
/* 
File Name: Notification.php (class folder)
----------------------------------------------------------------------
Purpose of this file: 
To add, edit, delete and view leave code & type to database.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: JDG
----------------------------------------------------------------------
Date of Revision: January 07, 2004
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
require("../hrmis/class/General.php");
class CNotification extends General
{

var $strDivisionCode;
var $strDivisionName;
var $strProjectCode;
var $strDivisionHead;
var $strDivisionHeadTitle;

   function CNotification() 
   {
      include("../hrmis/class/Connect.php");   //the dbase connection
   }
	
	function viewPayrollswitch($t_strempNumber, $t_strSurname, $t_strFirstname, $t_strMiddlename, $t_strpayrollSwitch) //View list of employee birthday
    {
	     $var="-".date("m")."-";
		 $viewResults = mysql_query("SELECT pe.empNumber, pe.surname, pe.firstname, pe.middlename, po.payrollSwitch FROM tblEmpPersonal pe
		 				Inner join tblEmpPosition po On pe.empNumber = po.empNumber WHERE po.payrollSwitch = 'Y' Order by pe.surname") or die (mysql_error());
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "No records found!";
		 } else {
		  
			echo "<table width=\"80%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
			echo "<tr class=\"border\"><td colspan=\"2\">Employee's Name</td>";
			echo "<td width=\"28%\">Employee Number</td></tr>";
			echo "<tr class=\"title\">";
			echo "<td colspan=\"2\">&nbsp;</td>";
			echo "<td>&nbsp;</td></tr>";
			do 
			{
			   $t_strempNumber=$row['empNumber'];
			   $t_strSurname=$row['surname'];
			   $t_strFirstname=$row['firstname'];
			   $t_strMiddlename=$row['middlename'];
			   $t_strpayrollSwitch=$row['payrollSwitch'];
			   echo "<tr class=\"border\"><td colspan=\"2\">" . $row['surname'] . "," . "&nbsp;" . $row['firstname'] ."</td>";
			   echo "<td width=\"28%\">" . $row['empNumber'] . "</td></tr>";
			  // echo "<tr class=\"title\">";
			  // echo "<td colspan=\"2\">&nbsp;</td>";
			  // echo "<td>&nbsp;</td></tr>";
			}  while ($row = mysql_fetch_array($viewResults)); 
                echo "</table>";
        }
	}


	function viewMCswitch($t_strempNumber, $t_strSurname, $t_strFirstname, $t_strMiddlename, $t_strmcSwitch) //View list of employee birthday
    {
	     $var="-".date("m")."-";
		 $viewResults = mysql_query("SELECT pe.empNumber, pe.surname, pe.firstname, pe.middlename, po.mcSwitch FROM tblEmpPersonal pe
		 				Inner join tblEmpPosition po On pe.empNumber = po.empNumber WHERE po.mcSwitch = 'Y' Order by pe.surname") or die (mysql_error());
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "No records found!";
		 } else {
		  
			echo "<table width=\"80%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
			echo "<tr class=\"border\"><td colspan=\"2\">Employee's Name</td>";
			echo "<td width=\"28%\">Employee Number</td></tr>";
			echo "<tr class=\"title\">";
			echo "<td colspan=\"2\">&nbsp;</td>";
			echo "<td>&nbsp;</td></tr>";
			do 
			{
			   $t_strempNumber=$row['empNumber'];
			   $t_strSurname=$row['surname'];
			   $t_strFirstname=$row['firstname'];
			   $t_strMiddlename=$row['middlename'];
			   $t_strmcSwitch=$row['mcSwitch'];
			   echo "<tr class=\"border\"><td colspan=\"2\">" . $row['surname'] . "," . "&nbsp;" . $row['firstname'] ."</td>";
			   echo "<td width=\"28%\">" . $row['empNumber'] . "</td></tr>";
			  // echo "<tr class=\"title\">";
			  // echo "<td colspan=\"2\">&nbsp;</td>";
			  // echo "<td>&nbsp;</td></tr>";
			}  while ($row = mysql_fetch_array($viewResults)); 
                echo "</table>";
        }
	}
	
	function viewLongevityswitch($t_strempNumber, $t_strSurname, $t_strFirstname, $t_strMiddlename, $t_strlongevitySwitch) //View list of employee birthday
    {
	     $var="-".date("m")."-";
		 $viewResults = mysql_query("SELECT pe.empNumber, pe.surname, pe.firstname, pe.middlename, po.longevitySwitch FROM tblEmpPersonal pe
		 				Inner join tblEmpPosition po On pe.empNumber = po.empNumber WHERE po.longevitySwitch = 'Y' Order by pe.surname") or die (mysql_error());
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "No records found!";
		 } else {
		  
			echo "<table width=\"80%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
			echo "<tr class=\"border\"><td colspan=\"2\">Employee's Name</td>";
			echo "<td width=\"28%\">Employee Number</td></tr>";
			echo "<tr class=\"title\">";
			echo "<td colspan=\"2\">&nbsp;</td>";
			echo "<td>&nbsp;</td></tr>";
			do 
			{
			   $t_strempNumber=$row['empNumber'];
			   $t_strSurname=$row['surname'];
			   $t_strFirstname=$row['firstname'];
			   $t_strMiddlename=$row['middlename'];
			   $t_strlongevitySwitch=$row['longevitySwitch'];
			   echo "<tr class=\"border\"><td colspan=\"2\">" . $row['surname'] . "," . "&nbsp;" . $row['firstname'] ."</td>";
			   echo "<td width=\"28%\">" . $row['empNumber'] . "</td></tr>";
			  // echo "<tr class=\"title\">";
			  // echo "<td colspan=\"2\">&nbsp;</td>";
			  // echo "<td>&nbsp;</td></tr>";
			}  while ($row = mysql_fetch_array($viewResults)); 
                echo "</table>";
        }
	}
	
	
	function getQuote($day) 
	{ 
		$date=date('j');
		$result = mysql_query("SELECT * FROM tblDailyQuote WHERE day = '$date' ");
		$row=mysql_fetch_array($result);
		$t_dtmDay = $row['day'];
		$t_strDailyQuote = $row['quote'];
		$quote[1] = "\"When I am surrounded by troubles, you keep me safe, 
					You oppose my angry enemies and save me by your power.\" <br><br>
					Psalm 138:7 <br>"; 
		$quote[2] = "$t_strDailyQuote";
		$quote[3] = "$t_strDailyQuote"; 
		$quote[4] = "$t_strDailyQuote"; 
		$quote[5] = "$t_strDailyQuote"; 
		$quote[6] = "$t_strDailyQuote";
		$quote[7] = "$t_strDailyQuote"; 
		$quote[8] = "$t_strDailyQuote";
		$quote[9] = "$t_strDailyQuote";
		$quote[10] = "$t_strDailyQuote";
		$quote[11] = "$t_strDailyQuote";
		$quote[12] = "$t_strDailyQuote";
		$quote[13] = "$t_strDailyQuote";
		$quote[14] = "$t_strDailyQuote";
		$quote[15] = "$t_strDailyQuote"; 
		$quote[16] =  "$t_strDailyQuote";
		$quote[17] = "$t_strDailyQuote";
		$quote[18] = "$t_strDailyQuote";
		$quote[19] = "$t_strDailyQuote";
		$quote[20] = "$t_strDailyQuote";
		$quote[21] = "$t_strDailyQuote";
		$quote[22] = "$t_strDailyQuote";
		$quote[23] = "$t_strDailyQuote";
		$quote[24] = "$t_strDailyQuote";
		$quote[25] = "$t_strDailyQuote";
		$quote[26] = "$t_strDailyQuote";
		$quote[27] = "$t_strDailyQuote";
		$quote[28] = "$t_strDailyQuote";
		$quote[29] = "$t_strDailyQuote";
		$quote[30] = "$t_strDailyQuote";
		$quote[31] = "$t_strDailyQuote";
		return "$quote[$day] <br><br>"; 
	  } 

	function dailyQuote() { 
	$day = date("j"); 
	echo $this->getQuote($day); 
	} 

}
?> 