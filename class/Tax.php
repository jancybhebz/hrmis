<?php 
/* 
File Name: Tax.php
----------------------------------------------------------------------
Purpose of this file: 
To add, edit, delete tax exemption.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: JDG
----------------------------------------------------------------------
Date of Revision: October 08, 2003
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
class TaxExemption
{
include("../hrmis/class/Connect.php"); 

var $taxStatus;
var $exemptionAmount;
//var $results;

   
   function addTaxExempt($taxStatus, $exemptionAmount, $Submit2) //Add tax exemption
   {
      if ($Submit2 == 'ADD')
	  {
	     $results = "INSERT INTO tblTaxExempt (taxStatus, exemptAmount) VALUES ('$taxStatus', '$exemptAmount')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Tax Exemption not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return; 
	     } 
	  }
	}
	
	function editTaxExempt($leaveCode, $leaveType, $Submit, $oldLeaveCode) //Add leave code and type
    {
      if ($Submit == 'Edit')
	  {
	     $results = mysql_query("SELECT * FROM tblLeave WHERE leaveCode='$leaveCode' and leaveType='$leaveType'");
		 if($row = mysql_fetch_array($results))
		 {
		    do 
			{
			   $leaveCode=$row['leaveCode'];
			   $leaveType=$row['leaveType'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == "Submit"){ 
			 $updateResults = "UPDATE tblLeave SET leaveCode='$leaveCode', leaveType='$leaveType' WHERE leaveCode='$oldLeaveCode'";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Leave not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return; 
			 } 
	} 
}

	function deleteLeaveType($leaveCode, $leaveType, $Submit) //Delete leave code and Type
   	{
	   if ($Submit == 'Delete') 
	   { 
	      $delete = "DELETE FROM tblLeave WHERE leaveCode='$leaveCode'";   //Delete Record from Database
	      $del = mysql_query($delete);
		  //return;
	   }
	}
	
	function viewLeaveType($leaveCode, $leaveType) //View list of leave code and type
    {
	     $viewResults = mysql_query("SELECT * FROM tblLeave");
	     if ($row=mysql_fetch_array($viewResults)); 
		 {
		 $leaveCode=$row["leaveCode"];
		 $leaveType=$row["leaveType"];
		 echo "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
		 echo "<tr>";
		 echo "<td colspan=\"4\" class=\"border\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
		 echo "<tr><td width=\"32%\" class=\"title\">LEAVE CODE</td>";
		 echo "<td width=\"37%\" class=\"title\">LEAVE TYPE</td><td width=\"31%\">&nbsp;</td>";
		 echo "</tr></table></td></tr>";
		 do 
		 {
		 	$leaveCode=$row["leaveCode"];
		    $leaveType=$row["leaveType"];
		    echo "<tr><td width=\"32%\" class=\"border\">" . $row['leaveCode'] . "</td>";
			echo "<td width=\"37%\" class=\"border\">" . $row['leaveType'] . "</td>";
			echo "<td width=\"16%\" class=\"border\">";
			echo "<a href=\"Editleave.php?leaveCode=$leaveCode&leaveType=$leaveType&Submit=Edit\">Edit</a></td>";
			echo "<td width=\"15%\" class=\"border\">";
			echo "<a href=\"Leave.php?leaveCode=$leaveCode&leaveType=$leaveType&Submit=Delete\">Delete</a></td></tr>";
		 }  while ($row = mysql_fetch_array($viewResults)); 
			echo "<tr><td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td>";
			echo "<td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td></tr>";
			echo "</table>"; 
        }
	}
}
?> 