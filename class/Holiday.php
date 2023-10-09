<?php 
/* 
File Name: Holiday.php (class folder)
----------------------------------------------------------------------
Purpose of this file: 
To add, edit, delete and view holiday to database.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco
----------------------------------------------------------------------
Date of Revision: October 16, 2003
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
class Holiday extends General
{

var $strHolidayCode;
var $strHolidayName;
var $strHolidayMonth;
var $strHolidayDay;
var $strFixedHoliday;
var $strHolidayYear;

   function holiday() 
   {
      include("../hrmis/class/Connect.php");   //the dbase connection
   }
	
   function addHoliday($strEmpNmbr, $t_strHolidayCode, $t_strHolidayName, $t_strHolidayMonth, $t_strHolidayDay, $t_strFixedHoliday, $t_strHolidayYear, $Submit)   //Add holiday
   {
      if ($Submit == 'ADD')
	  {
	     $results = "INSERT INTO tblHoliday (holidayCode, holidayName, holidayMonth, holidayDay, FixedHoliday) VALUES ('$t_strHolidayCode', '$t_strHolidayName', '$t_strHolidayMonth', '$t_strHolidayDay', '$t_strFixedHoliday')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Holiday not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}
	
	function editHoliday($strEmpNmbr, $t_strHolidayCode, $t_strHolidayName, $t_strHolidayMonth, $t_strHolidayDay, $t_strFixedHoliday, $Submit, $t_strOldHolidayCode) //edit holiday
    {
      if ($Submit == 'Edit')
	  {
	     $results = mysql_query("SELECT * FROM tblHoliday WHERE holidayCode='$t_strHolidayCode' and holidayName='$t_strHolidayName'");
		 if($row = mysql_fetch_array($results))
		 {
		    do 
			{   			  
			   $t_strHolidayCode=$row['holidayCode'];
			   $t_strHolidayName=$row['holidayName'];
			   $t_strHolidayMonth=$row['holidayMonth'];
			   $t_strHolidayDay=$row['holidayDay'];
			   $t_strFixedHoliday=$row['fixedHoliday'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == "Submit"){ 
			 $updateResults = "UPDATE tblHoliday SET holidayCode='$t_strHolidayCode', holidayName='$t_strHolidayName', holidayMonth='$t_strHolidayMonth', holidayDay='$t_strHolidayDay', fixedHoliday='$t_strFixedHoliday' WHERE holidayCode='$t_strOldHolidayCode'";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Holiday not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return 1; 
			 } 
	} 
}

	function deleteHoliday($strEmpNmbr, $t_strHolidayCode, $t_strHolidayName, $t_strHolidayMonth, $t_strHolidayDay, $t_strFixedHoliday, $Submit) //Delete division
   	{
	   if ($Submit == 'Delete') 
	   {
	   		 return 1;
	   }
	   elseif ($Submit == 'OK')
	   {
	      $delete = "DELETE FROM tblHoliday WHERE holidayCode='$t_strHolidayCode'";   //Delete Record from Database
	      $del = mysql_query($delete);
	   }
	}
	
	function viewHoliday($strEmpNmbr, $t_strHolidayCode, $t_strHolidayName, $t_strHolidayMonth, $t_strHolidayDay, $t_strFixedHoliday, $t_strHolidayYear) //View list of holiday
    {
	     $viewResults = mysql_query("SELECT * FROM tblHoliday");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "Database is empty";
		 } else {	
			 $t_strHolidayCode=$row['holidayCode'];
			 $t_strHolidayName=$row['holidayName'];
			 $t_strHolidayMonth=$row['holidayMonth'];
			 $t_strHolidayDay=$row['holidayDay'];
			 $t_strFixedHoliday=$row['fixedHoliday'];
			 echo "<table width=\"99%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
			 echo "<tr class=\"title\"><td width=\"17%\" height=\"18\" class=\"border\">HOLIDAY CODE</td>";
			 echo "<td width=\"18%\" class=\"border\">HOLIDAY NAME</td>";
			 echo "<td width=\"12%\" class=\"border\">MONTH</td>";
			 echo "<td width=\"15%\" class=\"border\">DAY</td>";
			 echo "<td width=\"14%\" class=\"border\">FIXED</td>";
			 //echo "<td width=\"9%\" class=\"border\">&nbsp;</td>";
			 //echo "<td width=\"9%\" class=\"border\">&nbsp;</td>";
			 echo "</tr>";
			 do 
			 {
				$t_strHolidayCode=$row['holidayCode'];
				$t_strHolidayName=$row['holidayName'];
				$t_strHolidayMonth=$row['holidayMonth'];
				$t_strHolidayDay=$row['holidayDay'];
				$t_strFixedHoliday=$row['fixedHoliday'];
				$strMonthName = $this->intToMonthFull($t_strHolidayMonth);
				echo "<tr class=\"border\"><td class=\"border\">" . $row['holidayCode'] . "</td>";
				echo "<td class=\"border\">" . $row['holidayName'] . "</td>";
				echo "<td class=\"border\">" . $strMonthName . "</td>";
				echo "<td class=\"border\">" . $row['holidayDay'] . "</td>";
				echo "<td class=\"border\">" . $row['fixedHoliday'] . "</td>";
				//echo "<td class=\"border\"><a href=\"Holiday.php?strEmpNmbr=$strEmpNmbr& t_strHolidayCode=$t_strHolidayCode&t_strHolidayName=$t_strHolidayName&t_strHolidayMonth=$t_strHolidayMonth&t_strHolidayDay=$t_strHolidayDay&t_strFixedHoliday=$t_strFixedHoliday&Submit=Edit\">Edit</a></td></td>";
				//echo "<td class=\"border\"><a href=\"Holiday.php?strEmpNmbr=$strEmpNmbr& t_strHolidayCode=$t_strHolidayCode&t_strHolidayName=$t_strHolidayName&t_strHolidayMonth=$t_strHolidayMonth&t_strHolidayDay=$t_strHolidayDay&t_strFixedHoliday=$t_strFixedHoliday&Submit=Delete\">Delete</a></td></tr></tr>";
			}  while ($row = mysql_fetch_array($viewResults)); 
			   echo "</tr><tr class=\"border\"><td height=\"16\" class=\"border\">&nbsp;</td>";
			   echo "<td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td>";
			   echo "<td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td>";
			   //echo "<td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td>";
			   echo "</tr></table>";
		 }
	}
	
	function viewHolidayFixed($strEmpNmbr, $t_strHolidayCode, $t_strHolidayName, $t_strHolidayMonth, $t_strHolidayDay,  $t_strHolidayYear) //View list of holiday
    {
	     $viewResults = mysql_query("SELECT * FROM tblHoliday");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "Database is empty";
		 } else {	
			 $t_strHolidayCode=$row['holidayCode'];
			 $t_strHolidayName=$row['holidayName'];
			 $t_strHolidayMonth=$row['holidayMonth'];
			 $t_strHolidayDay=$row['holidayDay'];
			 $t_strFixedHoliday=$row['fixedHoliday'];
			 echo "<table width=\"99%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
			 echo "<tr class=\"alterrow\"><td width=\"17%\" height=\"18\">HOLIDAY CODE</td>";
			 echo "<td width=\"21%\" >HOLIDAY NAME</td>";
			 echo "<td width=\"16%\" >MONTH</td>";
			 echo "<td width=\"12%\" >DAY</td>";
			 echo "<td width=\"10%\" >FIXED</td>";
			 echo "<td width=\"9%\" >&nbsp;</td>";
			 echo "<td width=\"9%\" >&nbsp;</td></tr>";
			 echo "<tr><td colspan=\"7\">&nbsp;</td></tr>";
			 do 
			 {
				$t_strHolidayCode=$row['holidayCode'];
				$t_strHolidayName=$row['holidayName'];
				$t_strHolidayMonth=$row['holidayMonth'];
				$t_strHolidayDay=$row['holidayDay'];
				$t_strFixedHoliday=$row['fixedHoliday'];
				$strMonthName = $this->intToMonthFull($t_strHolidayMonth);
				echo "<tr class=\"border\"><td>" . $row['holidayCode'] . "</td>";
				echo "<td>" . $row['holidayName'] . "</td>";
				echo "<td>" . $strMonthName . "</td>";
				echo "<td>" . $row['holidayDay'] . "</td>";
				echo "<td>" . $row['fixedHoliday'] . "</td>";
				echo "<td><a href=\"Holiday.php?strEmpNmbr=$strEmpNmbr&t_strHolidayCode=$t_strHolidayCode&t_strHolidayName=$t_strHolidayName&t_strHolidayMonth=$t_strHolidayMonth&t_strHolidayDay=$t_strHolidayDay&t_strFixedHoliday=$t_strFixedHoliday&Submit=Edit\">Edit</a></td></td>";
				echo "<td><a href=\"Holiday.php?strEmpNmbr=$strEmpNmbr&t_strHolidayCode=$t_strHolidayCode&t_strHolidayName=$t_strHolidayName&t_strHolidayMonth=$t_strHolidayMonth&t_strHolidayDay=$t_strHolidayDay&t_strFixedHoliday=$t_strFixedHoliday&Submit=Delete\">Delete</a></td></tr></tr>";
			}  while ($row = mysql_fetch_array($viewResults)); 
			   echo "</tr><tr><td colspan=\"7\">&nbsp;</td></tr></table>";
		 }
	}
}
?> 