<?php 
/* 
File Name: Personaltrainings.php (class folder)
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
Date of Revision: March 05, 2004 (Version 2.0.0)
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
class Personaltrainings extends General
{

	function personalTrainings() 
   	{
      include("../hrmis/class/Connect.php");   //the dbase connection
   	}
	
	function addTraining($strEmpNmbr, $t_strEmpNumber, $t_strTrainingCode, $t_dtmTrainingContractMonth, $t_dtmTrainingContractDay, $t_dtmTrainingContractYear, $t_strTrainingConductedBy, $t_strTrainingVenue, $t_dtmTrainingStartMonth, $t_dtmTrainingStartDay, $t_dtmTrainingStartYear, $t_dtmTrainingEndMonth, $t_dtmTrainingEndDay, $t_dtmTrainingEndYear, $t_intTrainingHours, $t_intTrainingCost, $Submit)   //Add employee training/seminar
   {
      if ($Submit == 'ADD')
	  {
 		 $t_dtmTrainingContractDate = $this->combineDate($t_dtmTrainingContractYear, $t_dtmTrainingContractMonth, $t_dtmTrainingContractDay);
 		 $t_dtmTrainingStartDate = $this->combineDate($t_dtmTrainingStartYear, $t_dtmTrainingStartMonth, $t_dtmTrainingStartDay);
 		 $t_dtmTrainingEndDate = $this->combineDate($t_dtmTrainingEndYear, $t_dtmTrainingEndMonth, $t_dtmTrainingEndDay);
	     $results = "INSERT INTO tblEmpTraining (empNumber, trainingCode, trainingContractDate, trainingConductedBy, trainingVenue, trainingStartDate, trainingEndDate, trainingHours, trainingCost) VALUES ('$t_strEmpNumber', '$t_strTrainingCode', '$t_dtmTrainingContractDate', '$t_strTrainingConductedBy', '$t_strTrainingVenue', '$t_dtmTrainingStartDate', '$t_dtmTrainingEndDate', '$t_intTrainingHours', '$t_intTrainingCost')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Employee Personal Data not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}
	
	function editTraining($strEmpNmbr, $txtSearch, $optField, $p, $strLetter, $t_strTrainingCode, $t_dtmTrainingContractMonth, $t_dtmTrainingContractDay, $t_dtmTrainingContractYear, $t_strTrainingConductedBy, $t_strTrainingVenue, $t_dtmTrainingStartMonth,$t_dtmTrainingStartDay, $t_dtmTrainingStartYear, $t_dtmTrainingEndMonth, $t_dtmTrainingEndDay, $t_dtmTrainingEndYear,  $t_intTrainingHours, $t_intTrainingCost, $Submit, $t_strEmpNumber,  $t_strOldTrainingCode) //edit employee training/seminar
    {
      if ($Submit == 'Edit')
	  {
	     $results = mysql_query("SELECT * FROM tblEmpTraining WHERE empNumber='$t_strEmpNumber' ");
		 if($row = mysql_fetch_array($results))
		 {
		    do 
			{
		       $t_strEmpNumber=$row['empNumber'];
			   $t_strTrainingCode=$row['trainingCode'];
			   $t_dtmTrainingContractDate=$row['trainingContractDate'];
			   $t_strTrainingConductedBy=$row['trainingConductedBy'];
			   $t_strTrainingVenue=$row['trainingVenue'];
			   $t_dtmTrainingStartDate=$row['trainingStartDate'];
			   $t_dtmTrainingEndDate=$row['trainingEndDate'];
			   $t_intTrainingHours=$row['trainingHours'];
			   $t_intTrainingCost=$row['trainingCost'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == "Submit"){ 
 		 $t_dtmTrainingContractDate = $this->combineDate($t_dtmTrainingContractYear, $t_dtmTrainingContractMonth, $t_dtmTrainingContractDay);
 		 $t_dtmTrainingStartDate = $this->combineDate($t_dtmTrainingStartYear, $t_dtmTrainingStartMonth, $t_dtmTrainingStartDay);
 		 $t_dtmTrainingEndDate = $this->combineDate($t_dtmTrainingEndYear, $t_dtmTrainingEndMonth, $t_dtmTrainingEndDay);
		 $updateResults = "UPDATE tblEmpTraining SET empNumber='$t_strEmpNumber', trainingCode='$t_strTrainingCode', trainingContractDate='$t_dtmTrainingContractDate', trainingConductedBy='$t_strTrainingConductedBy', trainingVenue='$t_strTrainingVenue', trainingStartDate='$t_dtmTrainingStartDate', trainingEndDate='$t_dtmTrainingEndDate', trainingHours='$t_intTrainingHours', trainingCost='$t_intTrainingCost' WHERE empNumber = '$t_strEmpNumber' AND trainingCode='$t_strOldTrainingCode'";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Employee trainings not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return 1; 
			 } 
		} 
	}
	
		function deleteTrainings($strEmpNmbr, $t_strEmpNumber, $t_strTrainingCode, $t_dtmTrainingContractMonth, $t_dtmTrainingContractDay, $t_dtmTrainingContractYear, $t_strTrainingConductedBy, $t_strTrainingVenue, $t_dtmTrainingStartMonth,$t_dtmTrainingStartDay, $t_dtmTrainingStartYear, $t_dtmTrainingEndMonth, $t_dtmTrainingEndDay, $t_dtmTrainingEndYear, $t_intTrainingHours, $t_intTrainingCost, $Submit)   //Delete employee training/seminar
   	{
	   if ($Submit == 'Delete') 
	   {
	   		 return 1;
	   }
	   elseif ($Submit == 'OK')
	   {
	      $delete = "DELETE FROM tblEmpTraining WHERE trainingCode='$t_strTrainingCode' AND empNumber = '$t_strEmpNumber'";   //Delete Record from Database
	      $del = mysql_query($delete);
	   }
	}
	
	function viewTrainings($strEmpNmbr, $txtSearch, $optField, $p, $strLetter, $t_strTrainingCode, $t_dtmTrainingContractMonth, $t_dtmTrainingContractDay, $t_dtmTrainingContractYear, $t_strTrainingConductedBy, $t_strTrainingVenue, $t_dtmTrainingStartMonth,$t_dtmTrainingStartDay, $t_dtmTrainingStartYear, $t_dtmTrainingEndMonth, $t_dtmTrainingEndDay, $t_dtmTrainingEndYear, $t_intTrainingHours, $t_intTrainingCost, $t_strEmpNumber) //View list of employee training/seminar
    {
	     $viewResults = mysql_query("SELECT * FROM tblEmpTraining WHERE empNumber='$t_strEmpNumber'");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "  ";
		 } else {
		       $t_strEmpNumber=$row['empNumber'];
			   $t_strTrainingCode=$row['trainingCode'];
			   $t_dtmTrainingContractDate=$row['trainingContractDate'];
			   $t_strTrainingConductedBy=$row['trainingConductedBy'];
			   $t_strTrainingVenue=$row['trainingVenue'];
			   $t_dtmTrainingStartDate=$row['trainingStartDate'];
			   $t_dtmTrainingEndDate=$row['trainingEndDate'];
			   $t_intTrainingHours=$row['trainingHours'];
			   $t_intTrainingCost=$row['trainingCost'];
			 echo "<table width=\"100%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
             echo "<tr class=\"alterrow\">";
             echo "<td colspan=\"10\">TRAINING PROGRAMS/STUDY/SCHOLARSHIP GRANTS</td></tr>";
             echo "<tr class=\"alterrow\"><td>Training</td><td>Training</td><td>Training</td><td>Training</td>";
             echo "<td width=\"10%\">Training</td><td width=\"11%\">Contract</td><td colspan=\"2\">Training Date</td>";
             echo "<td colspan=\"2\">&nbsp;</td></tr>";
             echo "<tr class=\"alterrow\"><td>Code</td><td>Hours</td><td>Venue</td><td>Conducted By</td>";
             echo "<td>Cost</td><td>Date</td><td width=\"11%\">From</td><td width=\"11%\">To</td>";
			 echo "<td colspan=\"2\">&nbsp;</td></tr>";
             echo "<tr><td colspan=\"10\">&nbsp;</td></tr>";
			 do 
			 {
		       $t_strEmpNumber=$row['empNumber'];
			   $t_strTrainingCode=$row['trainingCode'];
			   $t_strTrainingTitle=$row['trainingTitle'];
			   $t_dtmTrainingContractDate=$row['trainingContractDate'];
			   $t_strTrainingConductedBy=$row['trainingConductedBy'];
			   $t_strTrainingVenue=$row['trainingVenue'];
			   $t_dtmTrainingStartDate=$row['trainingStartDate'];
			   $t_dtmTrainingEndDate=$row['trainingEndDate'];
			   $t_intTrainingHours=$row['trainingHours'];
			   $t_intTrainingCost=$row['trainingCost'];
             echo "<tr class=\"border\"><td width=\"9%\">" . $row['trainingCode'] . "</td>";
             echo "<td width=\"9%\">" . $row['trainingHours'] . "</td>";
             echo "<td width=\"11%\">" . $row['trainingVenue'] . "</td>";
             echo "<td width=\"14%\">" . $row['trainingConductedBy'] . "</td>";
             echo "<td>" . $row['trainingCost'] . "</td>";
             echo "<td>" . $row['trainingContractDate'] . "</td>";
             echo "<td>" . $row['trainingStartDate'] . "</td>";
             echo "<td>" . $row['trainingEndDate'] . "</td>";
             echo "<td width=\"7%\"><a href=\"Personaltrainings.php?strEmpNmbr=$strEmpNmbr&txtSearch=$txtSearch&optField=$optField&p=$p&strLetter=$strLetter&t_strTrainingCode=$t_strTrainingCode&t_dtmTrainingContractDate=$t_dtmTrainingContractDate&t_strTrainingConductedBy=$t_strTrainingConductedBy&t_strTrainingVenue=$t_strTrainingVenue&t_dtmTrainingStartDate=$t_dtmTrainingStartDate&t_dtmTrainingEndDate=$t_dtmTrainingEndDate&t_intTrainingHours=$t_intTrainingHours&t_intTrainingCost=$t_intTrainingCost&t_strEmpNumber=$t_strEmpNumber&Submit=Edit\">Edit</a></td>";
             echo "<td width=\"7%\"><a href=\"Personaltrainings.php?strEmpNmbr=$strEmpNmbr&txtSearch=$txtSearch&optField=$optField&p=$p&strLetter=$strLetter&t_strTrainingCode=$t_strTrainingCode&t_dtmTrainingContractDate=$t_dtmTrainingContractDate&t_strTrainingConductedBy=$t_strTrainingConductedBy&t_strTrainingVenue=$t_strTrainingVenue&t_dtmTrainingStartDate=$t_dtmTrainingStartDate&&t_dtmTrainingEndDate=$t_dtmTrainingEndDate&t_intTrainingHours=$t_intTrainingHours&t_intTrainingCost=$t_intTrainingCost&t_strEmpNumber=$t_strEmpNumber&Submit=Delete\">Delete</a></td></tr>";
			 }  while ($row = mysql_fetch_array($viewResults)); 
             echo "<tr><td colspan=\"10\">&nbsp;</td></tr></table>";
			}
	} 
	
}
?>