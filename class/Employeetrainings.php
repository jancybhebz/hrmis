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
Date of Revision: March 23, 2004 (Version 2.0.0)
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
class Employeetrainings extends General
{

	function employeeTrainings() 
   	{
      include("../hrmis/class/Connect.php");   //the dbase connection
   	}
	
	function viewTrainings($txtSearch, $optField, $p, $t_strTrainingCode, $t_dtmTrainingContractMonth, $t_dtmTrainingContractDay, $t_dtmTrainingContractYear, $t_strTrainingConductedBy, $t_strTrainingVenue, $t_dtmTrainingStartMonth,$t_dtmTrainingStartDay, $t_dtmTrainingStartYear, $t_dtmTrainingTimeStart, $t_dtmTrainingAMPMStart, $t_dtmTrainingEndMonth, $t_dtmTrainingEndDay, $t_dtmTrainingEndYear, $t_dtmTrainingTimeEnd, $t_dtmTrainingAMPMEnd, $t_intTrainingHours, $t_intTrainingCost, $t_strEmpNumber) //View list of employee training/seminar
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
			   $t_dtmTrainingTimeStart=$row['trainingTimeStart'];
			   $t_dtmTrainingEndDate=$row['trainingEndDate'];
			   $t_dtmTrainingTimeEnd=$row['trainingTimeEnd'];
			   $t_intTrainingHours=$row['trainingHours'];
			   $t_intTrainingCost=$row['trainingCost'];
			 echo "<table width=\"100%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
             echo "<tr class=\"alterrow\">";
             echo "<td colspan=\"10\">TRAINING PROGRAMS/STUDY/SCHOLARSHIP GRANTS</td></tr>";
             echo "<tr class=\"alterrow\"><td>Training</td><td>Training</td><td>Training</td><td>Training</td>";
             echo "<td width=\"10%\">Training</td><td width=\"11%\">Contract</td><td colspan=\"2\">Training Date</td></tr>";
             echo "<tr class=\"alterrow\"><td>Code</td><td>Hours</td><td>Venue</td><td>Conducted By</td>";
             echo "<td>Cost</td><td>Date</td><td width=\"11%\">From</td><td width=\"11%\">To</td></tr>";
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
			   $t_dtmTrainingTimeStart=$row['trainingTimeStart'];
			   $t_dtmTrainingEndDate=$row['trainingEndDate'];
			   $t_dtmTrainingTimeEnd=$row['trainingTimeEnd'];
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
			 }  while ($row = mysql_fetch_array($viewResults)); 
             echo "<tr><td colspan=\"10\">&nbsp;</td></tr></table>";
			}
	} 
	
}
?>