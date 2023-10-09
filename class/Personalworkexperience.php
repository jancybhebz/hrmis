<?php 
/* 
File Name: Personalworkexperience.php (class folder)
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
require("../hrmis/class/Attendance.php");
class Workexperience extends General
{

	function workexperience() 
   	{
      include("../hrmis/class/Connect.php");   //the dbase connection
   	}
   	
	function addServiceRecords($strEmpNmbr, $t_strEmpNumber, $t_dtmServiceFromMonth, $t_dtmServiceFromDay, $t_dtmServiceFromYear, $t_dtmServiceToMonth, $t_dtmServiceToDay, $t_dtmServiceToYear, $t_strPositionCode, $t_strAppointmentCode, $t_strStationAgency, $t_intSalary, $t_strSeparationCause, $t_dtmSeparationMonth, $t_dtmSeparationDay, $t_dtmSeparationYear, $Submit)   //Load add service records information function
   {
      if ($Submit == 'ADD')
	  {
 		 $t_dtmServiceFromDate = $this->combineDate($t_dtmServiceFromYear, $t_dtmServiceFromMonth, $t_dtmServiceFromDay);
 		 $t_dtmServiceToDate = $this->combineDate($t_dtmServiceToYear, $t_dtmServiceToMonth, $t_dtmServiceToDay);
 		 $t_dtmSeparationDate = $this->combineDate($t_dtmSeparationYear, $t_dtmSeparationMonth, $t_dtmSeparationDay);
	     $results = "INSERT INTO tblServiceRecord (empNumber, serviceFromDate, serviceToDate, positionCode, appointmentCode, stationAgency, salary, separationCause, separationDate) VALUES ('$t_strEmpNumber', '$t_dtmServiceFromDate', '$t_dtmServiceToDate', '$t_strPositionCode', '$t_strAppointmentCode', '$t_strStationAgency', '$t_intSalary', '$t_strSeparationCause', '$t_dtmSeparationDate')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Employee work experience not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}
	
/*function insertToServiceRec($strEmpNmbr,$txtSearch, $optField, $p, $strEPEmpNum,$strEPPostitionDate,$strEPPositionCode,$strEPSalary, $strEPAssignPlace,$strEPAppointmentCode,$prevDate)
	{
	
		$objEmpPosition = mysql_query("SELECT  tblEmpPersonal.empNumber, tblEmpPosition.positionCode, tblEmpPosition.appointmentCode,
											  tblEmpPosition.positionDate, tblEmpPosition.actualSalary, tblEmpPosition.assignPlace,
											  tblEmpPosition.dateIncremented
									   FROM tblEmpPersonal
									  	 INNER JOIN tblEmpPosition
											ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber 
										 INNER JOIN tblAppointment
											ON tblEmpPosition.appointmentCode = tblAppointment.appointmentCode
										 INNER JOIN tblPosition
										    ON tblEmpPosition.positionCode = tblPosition.positionCode
										WHERE tblEmpPersonal.empNumber ='$t_strEmpNumber'");
									   
		
		while ($arrEmpPosition = mysql_fetch_array($objEmpPosition))
		{
			$strEPEmpNum = $arrEmpPosition['empNumber'];
			$strEPPositionCode = $arrEmpPosition['positionCode'];
			$strEPAppointmentCode = $arrEmpPosition['appointmentCode'];
			$strEPPostitionDate = $arrEmpPosition['positionDate'];
			$strEPSalary = $arrEmpPosition['actualSalary'];
			$strEPAssignPlace = $arrEmpPosition['assignPlace'];
			$strEPDateIncremented = $arrEmpPosition['dateIncremented'];
			
			$objServiceRecLast = mysql_query ("SELECT DISTINCT tblEmpPersonal.empNumber,tblServiceRecord.positionCode,
											  				tblServiceRecord.salary
									   		FROM tblServiceRecord
										  	INNER JOIN tblEmpPersonal
												ON tblEmpPersonal.empNumber = tblServiceRecord.empNumber
											INNER JOIN tblPosition
												ON tblServiceRecord.positionCode = tblPosition.positionCode
											WHERE tblEmpPersonal.empNumber ='$strEPEmpNum'
											ORDER BY tblServiceRecord.serviceToDate desc");
											
			while ($arrServiceRecLast = mysql_fetch_array($arrServiceRecLast))
		 	{
				$strEmpNum = $arrServiceRecLast['empNumber'];
				$strPositionCode = $arrServiceRecLast['positionCode'];
				$strSalary = $arrServiceRecLast['salary'];
				
				
				if (($strEPPositionCode != $strPositionCode)&&($strEPSalary!=$strSalary)) //change of position
				  { 
					$updateDteInc = "UPDATE tblEmpPosition set dateIncremented = '0000-00-00' WHERE empNumber ='$strEPEmpNum'"; 
					$updateDteInc2 = mysql_query($updateDteInc);
					
					$insertPosDetails = "INSERT INTO tblServiceRecord(empNumber,serviceFromDate, positionCode, salary ,stationAgency,appointmentCode)
					     				 VALUES('$strEPEmpNum', '$strEPPostitionDate', '$strEPPositionCode','$strEPSalary', '$strEPAssignPlace','$strEPAppointmentCode')";
					$insPosDet = mysql_query($insertPosDetails);
					
					$strEPPostitionDateEx = explode('-',$strEPPostitionDate);
					$arrPosDateYr = $strEPPostitionDateEx[0];
					$arrPosDateMonth = $strEPPostitionDateEx[1];
					$arrPosDateDay = $strEPPostitionDateEx[2];
					
					if ($arrPosDateDay ==1)
					{
						$prevDate = $this->getPrevDayYr($arrPosDateYr, $arrPosDateMonth, $arrPosDateDay);		
						$insertServiceToDate = mysql_query("UPDATE tblServiceRecord SET serviceToDate ='$prevDate' WHERE empNumber ='$strEmpNum' AND positionCode ='$strPositionCode'");
												
					}
					else
					{
						$curDate = date("Y-m-d");
						$curDateEx = explode('-', $curDate);
						$arrDateYr = $curDateEx[0];
						$arrDateMonth = $curDateEx[1];
						$arrDateDay = $curDateEx[2] - 1;
						$prevDate = $this->combineDate($arrDateYr,$arrDateMonth,$arrDateDay);
						$insertServiceToDate2 = mysql_query("UPDATE tblServiceRecord SET serviceToDate ='$prevDate' WHERE empNumber ='$strEmpNum' AND positionCode ='$strPositionCode'");						
					}		
					
				   }
				//if (($strEPPositionCode == $strPositionCode)&&($strEPSalary!=$strSalary))
				
		
		 	}
	
		}
	}*/

	function editServiceRecords($strEmpNmbr, $txtSearch, $optField, $p, $strLetter, $t_serviceRecID, $t_dtmServiceFromMonth, $t_dtmServiceFromDay, $t_dtmServiceFromYear, $t_dtmServiceToMonth, $t_dtmServiceToDay, $t_dtmServiceToYear, $t_strPositionCode, $t_strAppointmentCode, $t_strStationAgency, $t_intSalary, $t_strSeparationCause, $t_dtmSeparationMonth, $t_dtmSeparationDay, $t_dtmSeparationYear, $Submit, $t_strEmpNumber, $t_dtmOldServiceFromMonth, $t_dtmOldServiceFromDay, $t_dtmOldServiceFromYear, $t_dtmOldServiceToMonth, $t_dtmOldServiceToDay, $t_dtmOldServiceToYear, $t_strOldPositionCode) //edit employee service records
    {
      if ($Submit == 'Edit')
	  {
	     $results = mysql_query("SELECT * FROM tblServiceRecord WHERE serviceRecID='$t_serviceRecID'");
		 if($row = mysql_fetch_array($results))
		 {	     
		    do 
			{
			 $t_serviceRecID=$row['serviceRecID'];
		     $t_strEmpNumber=$row['empNumber'];
			 $t_dtmServiceFromDate=$row['serviceFromDate'];
			 $t_dtmServiceToDate=$row['serviceToDate'];
			 $t_strPositionCode=$row['positionCode'];
			 $t_strAppointmentCode=$row['appointmentCode'];
			 $t_strStationAgency=$row['stationAgency'];
			 $t_intSalary=$row['salary'];
			 $t_strSeparationCause=$row['separationCause'];
			 $t_dtmSeparationDate=$row['separationDate'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == "Submit"){
			 $t_dtmServiceFromDate = $this->combineDate($t_dtmServiceFromYear, $t_dtmServiceFromMonth, $t_dtmServiceFromDay);
			 $t_dtmServiceToDate = $this->combineDate($t_dtmServiceToYear, $t_dtmServiceToMonth, $t_dtmServiceToDay);
 		 	 $t_dtmSeparationDate = $this->combineDate($t_dtmSeparationYear, $t_dtmSeparationMonth, $t_dtmSeparationDay);
			 $updateResults = "UPDATE tblServiceRecord SET empNumber='$t_strEmpNumber', serviceFromDate='$t_dtmServiceFromDate', serviceToDate='$t_dtmServiceToDate', positionCode='$t_strPositionCode', appointmentCode='$t_strAppointmentCode', stationAgency='$t_strStationAgency', salary='$t_intSalary', separationCause='$t_strSeparationCause', separationDate='$t_dtmSeparationDate' WHERE serviceRecID = '$t_serviceRecID' AND positionCode='$t_strOldPositionCode'";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Employee work experience not modified:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return 1; 
			 } 
		} 
	}
	
	function deleteServiceRecords($strEmpNmbr, $txtSearch, $optField, $p, $strLetter, $t_serviceRecID,$t_dtmServiceFromDate, $t_dtmServiceToDate, $t_strPositionCode, $t_strAppointmentCode, $t_strStationAgency, $t_intSalary, $t_strSeparationCause, $t_dtmSeparationDate, $t_strEmpNumber, $Submit) //delete of service records from database
   	{
	   if ($Submit == 'Delete') 
	   {
	   		 return 1;
	   }
	   elseif ($Submit == 'OK')
	   {
	      $delete = "DELETE FROM tblServiceRecord WHERE serviceRecID='$t_serviceRecID'";   //Delete Record from Database
	      $del = mysql_query($delete);
	   }
	}
	
	function viewServiceRecords($strEmpNmbr, $txtSearch, $optField, $p, $strLetter, $t_serviceRecID, $t_dtmServiceFromDate, $t_dtmServiceToDate,$t_tmpServiceToDate, $t_strPositionCode, $t_strAppointmentCode, $t_strStationAgency, $t_intSalary, $t_strSeparationCause, $t_dtmSeparationDate, $t_strEmpNumber) //View list of service records
    {
	     $viewResults = mysql_query("SELECT * FROM tblServiceRecord WHERE empNumber='$t_strEmpNumber' ORDER BY serviceFromDate desc,serviceToDate desc");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "  ";
		 } else {
		 	 $t_serviceRecID=$row['serviceRecID']; 
		     $t_strEmpNumber=$row['empNumber'];
			 $t_dtmServiceFromDate=$row['serviceFromDate'];
			 $t_dtmServiceToDate=$row['serviceToDate'];
			 $t_strPositionCode=$row['positionCode'];
			 $t_strAppointmentCode=$row['appointmentCode'];
			 $t_strStationAgency=$row['stationAgency'];
			 $t_intSalary=$row['salary'];
			 $t_strSeparationCause=$row['separationCause'];
			 $t_dtmSeparationDate=$row['separationDate'];
			 $t_tmpServiceToDate =$row['tmpServiceToDate'];
			 
			 echo "<table width=\"100%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
             echo "<tr class=\"alterrow\"><td colspan=\"8\">WORK EXPERIENCE (Include private employment)</td></tr>";
             echo "<tr class=\"alterrow\"><td colspan=\"2\">Inclusive Dates</td>";
             echo "<td rowspan=\"2\">Position Title</td><td rowspan=\"2\">Department / Agency / Office</td>";
             echo "<td rowspan=\"2\">Monthly Salary</td><td width=\"12%\" rowspan=\"2\">Status of Appointment</td>";
             echo "<td colspan=\"2\" rowspan=\"2\">&nbsp;</td></tr>";
             echo "<tr class=\"alterrow\"><td width=\"10%\">From</td>";
             echo "<td width=\"11%\">To </td></tr>";
             echo "<tr><td colspan=\"8\">&nbsp;</td></tr>";
			 do 
			 {
			 	$t_serviceRecID=$row['serviceRecID'];
				$t_strEmpNumber=$row['empNumber'];
				$t_dtmServiceFromDate=$row['serviceFromDate'];
				$t_dtmServiceToDate=$row['serviceToDate'];
				$t_strPositionCode=$row['positionCode'];
				$t_strAppointmentCode=$row['appointmentCode'];
				$t_strStationAgency=$row['stationAgency'];
				$t_intSalary=$row['salary'];
			    $t_strSeparationCause=$row['separationCause'];
			    $t_dtmSeparationDate=$row['separationDate'];
				$t_tmpServiceToDate =$row['tmpServiceToDate'];
				
				
				if($t_dtmServiceToDate == '0000-00-00')
			 	{
					echo "<tr class=\"border\"><td>" . $row['serviceFromDate'] . "</td>";
					echo "<td>" . $row['tmpServiceToDate'] . "</td>";
					echo "<td width=\"11%\">" . $row['positionCode'] . "</td>";
					echo "<td width=\"33%\">" . $row['stationAgency'] . "</td>";
					echo "<td width=\"10%\">" . $row['salary'] . "</td>";
					echo "<td>" . $row['appointmentCode'] . "</td>";
					echo "<td width=\"6%\"><a href=\"Personalworkexperience.php?strEmpNmbr=$strEmpNmbr&txtSearch=$txtSearch&optField=$optField&p=$p&strLetter=$strLetter&t_serviceRecID=$t_serviceRecID&t_dtmServiceFromDate=$t_dtmServiceFromDate&t_dtmServiceToDate=$t_dtmServiceToDate&t_tmpServiceToDate=$t_tmpServiceToDate&t_strPositionCode=$t_strPositionCode&t_strAppointmentCode=$t_strAppointmentCode&t_strStationAgency=$t_strStationAgency&t_intSalary=$t_intSalary&t_strSeparationCause=$t_strSeparationCause&t_dtmSeparationDate=$t_dtmSeparationDate&t_strEmpNumber=$t_strEmpNumber&Submit=Edit\">Edit</a></td>";
					echo "<td width=\"7%\"><a href=\"Personalworkexperience.php?strEmpNmbr=$strEmpNmbr&txtSearch=$txtSearch&optField=$optField&p=$p&strLetter=$strLetter&t_serviceRecID=$t_serviceRecID&t_dtmServiceFromDate=$t_dtmServiceFromDate&t_dtmServiceToDate=$t_dtmServiceToDate&t_tmpServiceToDate=$t_tmpServiceToDate&t_strPositionCode=$t_strPositionCode&t_strAppointmentCode=$t_strAppointmentCode&t_strStationAgency=$t_strStationAgency&t_intSalary=$t_intSalary&t_strSeparationCause=$t_strSeparationCause&t_dtmSeparationDate=$t_dtmSeparationDate&t_strEmpNumber=$t_strEmpNumber&Submit=Delete\">Delete</a></td></tr>";
				}
				else	
				{
					echo "<tr class=\"border\"><td>" . $row['serviceFromDate'] . "</td>";
					echo "<td>" . $row['serviceToDate'] . "</td>";
					echo "<td width=\"11%\">" . $row['positionCode'] . "</td>";
					echo "<td width=\"33%\">" . $row['stationAgency'] . "</td>";
					echo "<td width=\"10%\">" . $row['salary'] . "</td>";
					echo "<td>" . $row['appointmentCode'] . "</td>";
					echo "<td width=\"6%\"><a href=\"Personalworkexperience.php?strEmpNmbr=$strEmpNmbr&txtSearch=$txtSearch&optField=$optField&p=$p&strLetter=$strLetter&t_serviceRecID=$t_serviceRecID&t_dtmServiceFromDate=$t_dtmServiceFromDate&t_dtmServiceToDate=$t_dtmServiceToDate&t_tmpServiceToDate=$t_tmpServiceToDate&t_strPositionCode=$t_strPositionCode&t_strAppointmentCode=$t_strAppointmentCode&t_strStationAgency=$t_strStationAgency&t_intSalary=$t_intSalary&t_strSeparationCause=$t_strSeparationCause&t_dtmSeparationDate=$t_dtmSeparationDate&t_strEmpNumber=$t_strEmpNumber&Submit=Edit\">Edit</a></td>";
					echo "<td width=\"7%\"><a href=\"Personalworkexperience.php?strEmpNmbr=$strEmpNmbr&txtSearch=$txtSearch&optField=$optField&p=$p&strLetter=$strLetter&t_serviceRecID=$t_serviceRecID&t_dtmServiceFromDate=$t_dtmServiceFromDate&t_dtmServiceToDate=$t_dtmServiceToDate&t_tmpServiceToDate=$t_tmpServiceToDate&t_strPositionCode=$t_strPositionCode&t_strAppointmentCode=$t_strAppointmentCode&t_strStationAgency=$t_strStationAgency&t_intSalary=$t_intSalary&t_strSeparationCause=$t_strSeparationCause&t_dtmSeparationDate=$t_dtmSeparationDate&t_strEmpNumber=$t_strEmpNumber&Submit=Delete\">Delete</a></td></tr>";
				}
			
			 }  while ($row = mysql_fetch_array($viewResults)); 
				echo "<tr><td colspan=\"8\">&nbsp;</td></tr></table>";
			}
	} 
		
}
?>