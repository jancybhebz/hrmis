<?php 
/* 
File Name: Chieftrainings.php (class folder)
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
Date of Revision: December 19, 2003
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
class Trainings extends General
{

	function trainings() 
   	{
      include("../hrmis/class/Connect.php");   //the dbase connection
   	}
	
	function addTraining($t_strEmpNumber, $t_strTrainingCode, $t_strTrainingContractMonth, $t_strTrainingContractDay, $t_strTrainingContractYear, $t_strTrainingConductedBy, $t_strTrainingVenue, $t_strTrainingStartMonth, $t_strTrainingStartDay, $t_strTrainingStartYear, $t_dtmTrainingStartTimeHrs, $t_dtmTrainingStartTimeMin, $t_dtmTrainingStartTimeSec, $t_dtmTrainingAMPMStart, $t_strTrainingEndMonth, $t_strTrainingEndDay, $t_strTrainingEndYear, $t_dtmTrainingEndTimeHrs, $t_dtmTrainingEndTimeMin, $t_dtmTrainingEndTimeSec, $t_dtmTrainingAMPMEnd, $t_intTrainingHours, $t_intTrainingCost, $Submit)   //Add employee training/seminar
   {
      if ($Submit == 'ADD')
	  {
 		 $t_strTrainingContractDate = $this->combineDate($t_strTrainingContractYear, $t_strTrainingContractMonth, $t_strTrainingContractDay);
 		 $t_strTrainingStartDate = $this->combineDate($t_strTrainingStartYear, $t_strTrainingStartMonth, $t_strTrainingStartDay);
 		 $t_strTrainingEndDate = $this->combineDate($t_strTrainingEndYear, $t_strTrainingEndMonth, $t_strTrainingEndDay);
       	 $t_dtmTrainingStart = $this->combineHrMnSc($t_dtmTrainingStartTimeHrs, $t_dtmTrainingStartTimeMin, $t_dtmTrainingStartTimeSec);
 	  	 $t_dtmTrainingEnd = $this->combineHrMnSc($t_dtmTrainingEndTimeHrs, $t_dtmTrainingEndTimeMin, $t_dtmTrainingEndTimeSec);
		 $t_dtmTrainingTimeStart = $this->combineTime($t_dtmTrainingStart, $t_dtmTrainingAMPMStart);
 		 $t_dtmTrainingTimeEnd = $this->combineTime($t_dtmTrainingEnd, $t_dtmTrainingAMPMEnd);
	     $results = "INSERT INTO tblEmpTraining (empNumber, trainingCode, trainingContractDate, trainingConductedBy, trainingVenue, trainingStartDate, trainingTimeStart, trainingEndDate, trainingTimeEnd, trainingHours, trainingCost) VALUES ('$t_strEmpNumber', '$t_strTrainingCode', '$t_strTrainingContractDate', '$t_strTrainingConductedBy', '$t_strTrainingVenue', '$t_strTrainingStartDate', '$t_dtmTrainingTimeStart', '$t_strTrainingEndDate', '$t_dtmTrainingTimeEnd', '$t_intTrainingHours', '$t_intTrainingCost')";
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
	
	function editTraining($t_strTrainingCode, $t_strTrainingContractMonth, $t_strTrainingContractDay, $t_strTrainingContractYear, $t_strTrainingConductedBy, $t_strTrainingVenue, $t_strTrainingStartMonth,$t_strTrainingStartDay, $t_strTrainingStartYear, $t_dtmTrainingStartTimeHrs, $t_dtmTrainingStartTimeMin, $t_dtmTrainingStartTimeSec, $t_dtmTrainingAMPMStart, $t_strTrainingEndMonth, $t_strTrainingEndDay, $t_strTrainingEndYear, $t_dtmTrainingEndTimeHrs, $t_dtmTrainingEndTimeMin, $t_dtmTrainingEndTimeSec, $t_dtmTrainingAMPMEnd, $t_intTrainingHours, $t_intTrainingCost, $Submit, $t_strEmpNumber,  $t_strOldTrainingCode, $t_dtmOldTrainingStartTimeHrs, $t_dtmOldTrainingStartTimeMin, $t_dtmOldTrainingStartTimeSec) //edit employee training/seminar
    {
      if ($Submit == 'Edit')
	  {
	     $results = mysql_query("SELECT trainingCode FROM tblEmpTraining WHERE empNumber='$t_strEmpNumber' AND trainingCode='$t_strTrainingCode' ");
		 if($row = mysql_fetch_array($results))
		 {
		    do 
			{
		       $t_strEmpNumber=$row['empNumber'];
			   $t_strTrainingCode=$row['trainingCode'];
			   $t_strTrainingContractDate=$row['trainingContractDate'];
			   $t_strTrainingConductedBy=$row['trainingConductedBy'];
			   $t_strTrainingVenue=$row['trainingVenue'];
			   $t_strTrainingStartDate=$row['trainingStartDate'];
			   $t_dtmTrainingTimeStart=$row['trainingTimeStart'];
			   $t_strTrainingEndDate=$row['trainingEndDate'];
			   $t_dtmTrainingTimeEnd=$row['trainingTimeEnd'];
			   $t_intTrainingHours=$row['trainingHours'];
			   $t_intTrainingCost=$row['trainingCost'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == "Submit"){ 
 		 $t_strTrainingContractDate = $this->combineDate($t_strTrainingContractYear, $t_strTrainingContractMonth, $t_strTrainingContractDay);
 		 $t_strTrainingStartDate = $this->combineDate($t_strTrainingStartYear, $t_strTrainingStartMonth, $t_strTrainingStartDay);
 		 $t_strTrainingEndDate = $this->combineDate($t_strTrainingEndYear, $t_strTrainingEndMonth, $t_strTrainingEndDay);
       	 $t_dtmTrainingStart = $this->combineHrMnSc($t_dtmTrainingStartTimeHrs, $t_dtmTrainingStartTimeMin, $t_dtmTrainingStartTimeSec);
 	  	 $t_dtmTrainingEnd = $this->combineHrMnSc($t_dtmTrainingEndTimeHrs, $t_dtmTrainingEndTimeMin, $t_dtmTrainingEndTimeSec);
		 $t_dtmTrainingTimeStart = $this->combineTime($t_dtmTrainingStart, $t_dtmTrainingAMPMStart);
 		 $t_dtmTrainingTimeEnd = $this->combineTime($t_dtmTrainingEnd, $t_dtmTrainingAMPMEnd);
	     $t_strTrainingContractDate = $this->combineDate($t_strTrainingContractYear, $t_strTrainingContractMonth, $t_strTrainingContractDay);
		 $updateResults = "UPDATE tblEmpTraining SET empNumber='$t_strEmpNumber', trainingCode='$t_strTrainingCode', trainingContractDate='$t_strTrainingContractDate', trainingConductedBy='$t_strTrainingConductedBy', trainingVenue='$t_strTrainingVenue', trainingStartDate='$t_strTrainingStartDate', trainingTimeStart='$t_dtmTrainingTimeStart', trainingEndDate='$t_strTrainingEndDate', trainingTimeEnd='$t_dtmTrainingTimeEnd', trainingHours='$t_intTrainingHours', trainingCost='$t_intTrainingCost' WHERE  trainingCode='$t_strOldTrainingCode'";
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
	
		function deleteTrainings($t_strEmpNumber, $t_strTrainingCode, $t_strTrainingContractMonth, $t_strTrainingContractDay, $t_strTrainingContractYear, $t_strTrainingConductedBy, $t_strTrainingVenue, $t_strTrainingStartMonth,$t_strTrainingStartDay, $t_strTrainingStartYear, $t_dtmTrainingTimeStart, $t_strTrainingEndMonth, $t_strTrainingEndDay, $t_strTrainingEndYear, $t_dtmTrainingTimeEnd, $t_intTrainingHours, $t_intTrainingCost, $Submit)   //Delete employee training/seminar
   	{
	   if ($Submit == 'Delete') 
	   {
	   		 return 1;
	   }
	   elseif ($Submit == 'OK')
	   {
	      $delete = "DELETE FROM tblEmpTraining WHERE trainingCode='$t_strTrainingCode'";   //Delete Record from Database
	      $del = mysql_query($delete);
	   }
	}
	
	function viewTrainings($txtSearch, $optField, $p, $t_strTrainingTitle, $t_strTrainingContractMonth, $t_strTrainingContractDay, $t_strTrainingContractYear, $t_strTrainingConductedBy, $t_strTrainingVenue, $t_strTrainingStartMonth,$t_strTrainingStartDay, $t_strTrainingStartYear, $t_dtmTrainingTimeStart, $t_dtmTrainingAMPMStart, $t_strTrainingEndMonth, $t_strTrainingEndDay, $t_strTrainingEndYear, $t_dtmTrainingTimeEnd, $t_dtmTrainingAMPMEnd, $t_intTrainingHours, $t_intTrainingCost, $t_strEmpNumber) //View list of employee training/seminar
    {
	     $viewResults = mysql_query("SELECT tblEmpTraining.trainingCode, tblEmpTraining.trainingContractDate, tblEmpTraining.trainingConductedBy, tblEmpTraining.trainingVenue, tblEmpTraining.trainingStartDate, tblEmpTraining.trainingTimeStart, tblEmpTraining.trainingEndDate, tblEmpTraining.trainingTimeEnd, tblEmpTraining.trainingHours, tblEmpTraining.trainingCost, tblTraining.trainingTitle FROM tblEmpTraining INNER JOIN tblTraining ON tblEmpTraining.trainingCode=tblTraining.trainingCode WHERE empNumber='$t_strEmpNumber'");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "database is empty";
		 } else {
		       $t_strEmpNumber=$row['empNumber'];
			   $t_strTrainingCode=$row['trainingCode'];
			   $t_strTrainingContractDate=$row['trainingContractDate'];
			   $t_strTrainingConductedBy=$row['trainingConductedBy'];
			   $t_strTrainingVenue=$row['trainingVenue'];
			   $t_strTrainingStartDate=$row['trainingStartDate'];
			   $t_dtmTrainingTimeStart=$row['trainingTimeStart'];
			   $t_strTrainingEndDate=$row['trainingEndDate'];
			   $t_dtmTrainingTimeEnd=$row['trainingTimeEnd'];
			   $t_intTrainingHours=$row['trainingHours'];
			   $t_intTrainingCost=$row['trainingCost'];
			 echo "<table width=\"99%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
			 echo "<tr class=\"title\"><td width=\"33%\" class=\"border\">Training Title</td>";
			 echo "<td width=\"10%\" class=\"border\">Hours</td>";
			 echo "<td width=\"25%\" class=\"border\">Venue</td>";
			 echo "<td width=\"20%\" class=\"border\">Conducted By</td>";
			 echo "<td width=\"22%\" class=\"border\">Cost</td></tr>";
			 do 
			 {
		       $t_strEmpNumber=$row['empNumber'];
			   $t_strTrainingCode=$row['trainingCode'];
			   $t_strTrainingContractDate=$row['trainingContractDate'];
			   $t_strTrainingConductedBy=$row['trainingConductedBy'];
			   $t_strTrainingVenue=$row['trainingVenue'];
			   $t_strTrainingStartDate=$row['trainingStartDate'];
			   $t_dtmTrainingTimeStart=$row['trainingTimeStart'];
			   $t_strTrainingEndDate=$row['trainingEndDate'];
			   $t_dtmTrainingTimeEnd=$row['trainingTimeEnd'];
			   $t_intTrainingHours=$row['trainingHours'];
			   $t_intTrainingCost=$row['trainingCost'];
				echo "<tr class=\"border\"><td class=\"border\">" . $row['trainingTitle'] . "</td>";
				echo "<td class=\"border\">" . $row['trainingHours'] . "</td>";
				echo "<td class=\"border\">" . $row['trainingVenue'] . "</td>";
				echo "<td class=\"border\">" . $row['trainingConductedBy'] . "</td>";
				//echo "<td class=\"border\"><a href=\"Trainings.php?txtSearch=$txtSearch&optField=$optField&p=$p&t_strTrainingCode=$t_strTrainingCode&t_strTrainingContractDate=$t_strTrainingContractDate&t_strTrainingConductedBy=$t_strTrainingConductedBy&t_strTrainingVenue=$t_strTrainingVenue&t_strTrainingStartDate=$t_strTrainingStartDate&t_dtmTrainingTimeStart=$t_dtmTrainingTimeStart&t_strTrainingEndDate=$t_strTrainingEndDate&t_dtmTrainingTimeEnd=$t_dtmTrainingTimeEnd&t_intTrainingHours=$t_intTrainingHours&t_intTrainingCost=$t_intTrainingCost&t_strEmpNumber=$t_strEmpNumber&Submit=Edit\">Edit</a></td>"; 
				echo "<td class=\"border\">" . $row['trainingCost'] . "</td>";
				//echo "<td class=\"border\"><a href=\"Trainings.php?txtSearch=$txtSearch&optField=$optField&p=$p&t_strTrainingCode=$t_strTrainingCode&t_strTrainingContractDate=$t_strTrainingContractDate&t_strTrainingConductedBy=$t_strTrainingConductedBy&t_strTrainingVenue=$t_strTrainingVenue&t_strTrainingStartDate=$t_strTrainingStartDate&t_dtmTrainingTimeStart=$t_dtmTrainingTimeStart&t_strTrainingEndDate=$t_strTrainingEndDate&t_dtmTrainingTimeEnd=$t_dtmTrainingTimeEnd&t_intTrainingHours=$t_intTrainingHours&t_intTrainingCost=$t_intTrainingCost&t_strEmpNumber=$t_strEmpNumber&Submit=Delete\">Delete</a></td></tr>";
			 }  while ($row = mysql_fetch_array($viewResults)); 
				echo "<tr class=\"border\"><td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td>";
				echo "<td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td>";
				echo "<td class=\"border\">&nbsp;</td></tr></table>";        
			}
	} 
	
}
?>