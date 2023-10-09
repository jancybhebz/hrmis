<?php 
/* 
File Name: Holidayyear.php (class folder)
----------------------------------------------------------------------
Purpose of this file: 
To add, edit, delete and view holidayyear to database.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco
----------------------------------------------------------------------
Date of Revision: October 28, 2003
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
class Holidayyear extends General
{

var $strHolidayCode;
var $strHolidayDate;

   function holidayYear() 
   {
      include("../hrmis/class/Connect.php");   //the dbase connection
   }
	
   function addHolidayYear($strEmpNmbr, $t_strHolidayCode, $t_dtmHolidayMonth, $t_dtmHolidayDay, $t_dtmHolidayYear, $Submit)   //Add holiday year
   {
      if ($Submit == 'ADD')
	  {
 		 $t_dtmHolidayDate = $this->combineDate(date("Y"), $t_dtmHolidayMonth, $t_dtmHolidayDay);
	     $results = "INSERT INTO tblHolidayYear (holidayCode, holidayDate) VALUES ('$t_strHolidayCode',  '$t_dtmHolidayDate')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Holiday Year not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}
	
	function editHolidayYear($strEmpNmbr, $t_strHolidayCode, $t_dtmHolidayMonth, $t_dtmHolidayDay, $t_dtmHolidayYear, $Submit, $t_strOldHolidayCode, $t_strOldHolidayMonth, $t_strOldHolidayDay, $t_strOldHolidayYear) //edit  holiday information
    {
      if ($Submit == 'Edit')
	  {
	     $results = mysql_query("SELECT * FROM tblHolidayYear WHERE holidayCode='$t_strHolidayCode'");
		 if($row = mysql_fetch_array($results))
		 {	     
		    do 
			{

		       $t_strHolidayCode=$row['holidayCode'];
			   $t_dtmHolidayDate=$row['holidayDate'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == "Submit"){
			$t_dtmHolidayDate = $this->combineDate($t_dtmHolidayYear, $t_dtmHolidayMonth, $t_dtmHolidayDay);
			 $updateResults = "UPDATE tblHolidayYear SET holidayCode='$t_strHolidayCode', holidayDate='$t_dtmHolidayDate' WHERE holidayCode='$t_strOldHolidayCode'";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Holiday year not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return 1; 
			 } 
		} 
	}

	function deleteHolidayYear($strEmpNmbr, $t_strHolidayCode, $t_dtmHolidayDate, $Submit) //Delete division
   	{
	   if ($Submit == 'Delete') 
	   {
	   		 return 1;
	   }
	   elseif ($Submit == 'OK')
	   {
	      $delete = "DELETE FROM tblHolidayYear WHERE holidayCode='$t_strHolidayCode' AND holidayDate='$t_dtmHolidayDate'";   //Delete Record from Database
	      $del = mysql_query($delete);
	   }
	} 
	
	function viewHolidayYear($strEmpNmbr, $t_strHolidayCode, $t_dtmHolidayDate) //View list of holiday year
    {
	     $viewResults = mysql_query("SELECT * FROM tblHolidayYear");
	     if (!$row=mysql_fetch_array($viewResults))
		 {	     
		   echo "Database is empty";
		 } else {
			 $t_strHolidayCode=$row['holidayCode'];
			 $t_dtmHolidayDate=$row['holidayDate'];
			 echo "<table width=\"99%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
			 echo "<tr class=\"alterrow\"><td width=\"17%\" height=\"18\">HOLIDAY CODE</td>";
			 echo "<td width=\"18%\">HOLIDAY DATE</td>";
			 echo "<td width=\"9%\">&nbsp;</td>";
			 echo "<td width=\"9%\">&nbsp;</td></tr>";
			 echo "<tr><td colspan=\"4\">&nbsp;</td></tr>";
			 do 
			 {
				$t_strHolidayCode=$row['holidayCode'];
				$t_dtmHolidayDate=$row['holidayDate'];
				echo "<tr class=\"border\"><td>" . $row['holidayCode'] . "</td>";
				echo "<td>" . $row['holidayDate'] . "</td>";
				echo "<td><a href=\"Holidayyear.php?strEmpNmbr=$strEmpNmbr&t_strHolidayCode=$t_strHolidayCode&t_dtmHolidayDate=$t_dtmHolidayDate&Submit=Edit\">Edit</a></td></td>";
				echo "<td><a href=\"Holidayyear.php?strEmpNmbr=$strEmpNmbr&t_strHolidayCode=$t_strHolidayCode&t_dtmHolidayDate=$t_dtmHolidayDate&Submit=Delete\">Delete</a></td></tr></tr>";
			}  while ($row = mysql_fetch_array($viewResults)); 
			   echo "</tr><tr><td colspan=\"4\">&nbsp;</td></tr></table>";
		 }
	} 
} 
?> 