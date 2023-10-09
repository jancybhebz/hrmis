<?php 
/* 
File Name: Personalvoluntarywork.php (class folder)
----------------------------------------------------------------------
Purpose of this file: 
To add employee's personal data.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco
----------------------------------------------------------------------
Date of Revision: March 17, 2004 (Version 2.0.0)
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
class Personalvoluntarywork extends General
{

	function personalVoluntaryWork() 
   	{
      include("../hrmis/class/Connect.php");   //the dbase connection
   	}
   	
	function addVoluntaryWork($strEmpNmbr, $t_strEmpNumber, $t_strVWName, $t_strVWAddress, $t_dtmVWDateFromMonth, $t_dtmVWDateFromDay, $t_dtmVWDateFromYear, $t_dtmVWDateToMonth, $t_dtmVWDateToDay, $t_dtmVWDateToYear,  $t_intVWHours, $t_strVWPosition, $Submit)   //Load add voluntary work information function
   {
      if ($Submit == 'ADD')
	  {
 		 $t_dtmVWDateFrom = $this->combineDate($t_dtmVWDateFromYear, $t_dtmVWDateFromMonth, $t_dtmVWDateFromDay);
 		 $t_dtmVWDateTo = $this->combineDate($t_dtmVWDateToYear, $t_dtmVWDateToMonth, $t_dtmVWDateToDay);
	     $results = "INSERT INTO tblEmpVoluntaryWork (empNumber, vwName, vwAddress, vwDateFrom, vwDateTo, vwHours, vwPosition) VALUES ('$t_strEmpNumber', '$t_strVWName', '$t_strVWAddress', '$t_dtmVWDateFrom', '$t_dtmVWDateTo', '$t_intVWHours', '$t_strVWPosition')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Employee voluntary work not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}
	
		function editVoluntaryWork($strEmpNmbr, $txtSearch, $optField, $p, $strLetter, $t_strEmpNumber, $t_strVWName, $t_strVWAddress, $t_dtmVWDateFromMonth, $t_dtmVWDateFromDay, $t_dtmVWDateFromYear, $t_dtmVWDateToMonth, $t_dtmVWDateToDay, $t_dtmVWDateToYear,  $t_intVWHours, $t_strVWPosition, $Submit, $t_strOldEmpNumber, $t_strOldVWName) //edit employee voluntary work
    {
      if ($Submit == 'Edit')
	  {
	     $results = mysql_query("SELECT * FROM tblEmpVoluntaryWork WHERE empNumber='$t_strEmpNumber' AND vwName='$t_strVWName'");
		 if($row = mysql_fetch_array($results))
		 {	     
		    do 
			{
		     $t_strEmpNumber=$row['empNumber'];
			 $t_strVWName=$row['vwName'];
			 $t_strVWAddress=$row['vwAddress'];
			 $t_dtmVWDateFrom=$row['vwDateFrom'];
			 $t_dtmVWDateTo=$row['vwDateTo'];
			 $t_intVWHours=$row['vwHours'];
			 $t_strVWPosition=$row['vwPosition'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == "Submit"){
			 $t_dtmVWDateFrom = $this->combineDate($t_dtmVWDateFromYear, $t_dtmVWDateFromMonth, $t_dtmVWDateFromDay);
			 $t_dtmVWDateTo = $this->combineDate($t_dtmVWDateToYear, $t_dtmVWDateToMonth, $t_dtmVWDateToDay);
			 $updateResults = "UPDATE tblEmpVoluntaryWork SET empNumber='$t_strEmpNumber', vwName='$t_strVWName', vwAddress='$t_strVWAddress', vwDateFrom='$t_dtmVWDateFrom', vwDateTo='$t_dtmVWDateTo', vwHours='$t_intVWHours', vwPosition='$t_strVWPosition' WHERE empNumber = '$t_strEmpNumber' AND vwName='$t_strOldVWName'";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Employee voluntary work not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return 1; 
			 } 
		} 
	}
	
		function deleteVoluntaryWork($strEmpNmbr, $txtSearch, $optField, $p, $t_strEmpNumber, $t_strVWName, $t_strVWAddress, $t_dtmVWDateFromMonth, $t_dtmVWDateFromDay, $t_dtmVWDateFromYear, $t_dtmVWDateToMonth, $t_dtmVWDateToDay, $t_dtmVWDateToYear,  $t_intVWHours, $t_strVWPosition, $Submit) //delete of employee voluntary work from database
   	{
	   if ($Submit == 'Delete') 
	   {
	   		 return 1;
	   }
	   elseif ($Submit == 'OK')
	   {
	      $delete = "DELETE FROM tblEmpVoluntaryWork WHERE vwName='$t_strVWName' and vwPosition='$t_strVWPosition'";
	      $del = mysql_query($delete);
	   }
	}
	
	function viewVoluntaryWork($strEmpNmbr, $txtSearch, $optField, $p, $strLetter, $t_strVWName, $t_strVWAddress, $t_dtmVWDateFromMonth, $t_dtmVWDateFromDay, $t_dtmVWDateFromYear, $t_dtmVWDateToMonth, $t_dtmVWDateToDay, $t_dtmVWDateToYear,  $t_intVWHours, $t_strVWPosition, $Submit, $t_strEmpNumber) //View list of employee voluntary work
    {
	     $viewResults = mysql_query("SELECT * FROM tblEmpVoluntaryWork WHERE empNumber='$t_strEmpNumber'");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "  ";
		 } else {
		     $t_strEmpNumber=$row['empNumber'];
			 $t_strVWName=$row['vwName'];
			 $t_strVWAddress=$row['vwAddress'];
			 $t_dtmVWDateFrom=$row['vwDateFrom'];
			 $t_dtmVWDateTo=$row['vwDateTo'];
			 $t_intVWHours=$row['vwHours'];
			 $t_strVWPosition=$row['vwPosition'];
			 echo "<table width=\"100%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
             echo "<tr class=\"alterrow\">";
			 echo "<td colspan=\"8\">Voluntary Work or Involvement in Civic/Non-Governement/People/Voluntary Organization</td></tr>";
             echo "<tr class=\"alterrow\"><td rowspan=\"2\">Name</td>";
             echo "<td rowspan=\"2\">Address</td>";
			 echo "<td colspan=\"2\">Inclusive Dates</td>";
             echo "<td rowspan=\"2\">Number of Hours</td>";
             echo "<td width=\"15%\" rowspan=\"2\">Position/Nature of work</td>";
             echo "<td colspan=\"2\" rowspan=\"2\">&nbsp;</td></tr>";
             echo "<tr class=\"alterrow\"><td width=\"10%\">From</td>";
			 echo "<td width=\"10%\">To</td></tr>";
             echo "<tr><td colspan=\"8\">&nbsp;</td></tr>";
			 do 
			 {
				$t_strEmpNumber=$row['empNumber'];
				$t_strVWName=$row['vwName'];
				$t_strVWAddress=$row['vwAddress'];
				$t_dtmVWDateFrom=$row['vwDateFrom'];
				$t_dtmVWDateTo=$row['vwDateTo'];
				$t_intVWHours=$row['vwHours'];
				$t_strVWPosition=$row['vwPosition'];
				echo "<tr class=\"border\"><td width=\"22%\">" . $row['vwName'] . "</td>";
				echo "<td width=\"23%\">" . $row['vwAddress'] . "</td>";
				echo "<td>" . $row['vwDateFrom'] . "</td>";
				echo "<td>" . $row['vwDateTo'] . "</td>";
				echo "<td width=\"8%\">" . $row['vwHours'] . "</td>";
				echo "<td>" . $row['vwPosition'] . "</td>";
				echo "<td width=\"6%\"><a href=\"Personalvoluntarywork.php?strEmpNmbr=$strEmpNmbr&txtSearch=$txtSearch&optField=$optField&p=$p&strLetter=$strLetter&t_strVWName=$t_strVWName&t_strVWAddress=$t_strVWAddress&t_dtmVWDateFrom=$t_dtmVWDateFrom&t_dtmVWDateTo=$t_dtmVWDateTo&t_intVWHours=$t_intVWHours&t_strVWPosition=$t_strVWPosition&t_strEmpNumber=$t_strEmpNumber&Submit=Edit\">Edit</a></td>";
				echo "<td width=\"6%\"><a href=\"Personalvoluntarywork.php?strEmpNmbr=$strEmpNmbr&txtSearch=$txtSearch&optField=$optField&p=$p&strLetter=$strLetter&t_strVWName=$t_strVWName&t_strVWAddress=$t_strVWAddress&t_dtmVWDateFrom=$t_dtmVWDateFrom&t_dtmVWDateTo=$t_dtmVWDateTo&t_intVWHours=$t_intVWHours&t_strVWPosition=$t_strVWPosition&t_strEmpNumber=$t_strEmpNumber&Submit=Delete\">Delete</a></td></tr>";
			}  while ($row = mysql_fetch_array($viewResults)); 
				echo "<tr><td colspan=\"8\">&nbsp;</td></tr></table>";
			}
	} 
		
}
?>