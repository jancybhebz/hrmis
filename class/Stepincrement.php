<?php 
/* 
File Name: Appointment.php (class folder)
----------------------------------------------------------------------
Purpose of this file: 
To add, edit, delete and view appointment code and description to database.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco
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

require("../hrmis/class/General.php");
require("../hrmis/class/PreviousDay.php");

class StepIncrement extends PreviousDayYr
{

//var $strAppointmentCode;
//var $strAppointmentDesc;
//var $filename;

   function StepIncrement() 
   {
      include("../hrmis/class/Connect.php");   //the dbase connection
   }
	

	function updatePositionDetails($strEmpNmbr, $t_ActualSalary, $t_strPrevDate, $t_strSalaryGrade, $t_strStepNum, $t_StepNumber, $t_strEmpNum, $t_strName, $t_strEffectiveDate, $t_strPositionCode, $t_strActualSalary, $t_strAssignPlace,$t_strAppointmentCode, $Submit) 

   	{
	   if ($Submit == 'Update') 
	   {
	   
	   		 return 1;
	   }
	   elseif ($Submit == 'OK')
	   {
	   	
		  $this->intFlag = 1;
		  $objQuery1 = mysql_query("SELECT tblEmpPersonal.empNumber, tblEmpPosition.tmpStepNumber, tblEmpPosition.tmpActualSalary,
		  								tblEmpPosition.tmpDateIncremented, tblEmpPosition.statusOfAppointment 
								 	FROM tblEmpPersonal
								 		INNER JOIN tblEmpPosition
											ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
								 	WHERE tblEmpPersonal.empNumber = '$t_strEmpNum'");
								 
		  $arrQuery1 = mysql_fetch_array($objQuery1);
		  $strEmpNum = $arrQuery1['empNumber'];
		  $strTmpStepNum = $arrQuery1['tmpStepNumber'];
		  $strTmpActualSalary = $arrQuery1['tmpActualSalary'];
		  $strTmpDateIncremented = $arrQuery1['tmpDateIncremented'];
		  $strStatusOfAppointment = $arrQuery1['statusOfAppointment'];   //Mode of Separation label at Position Details Interface
		  
		  if ($strStatusOfAppointment == 'In-Service')
		  {
		  $objUpdateStep = mysql_query("UPDATE tblEmpPosition SET stepNumber ='$strTmpStepNum', actualSalary ='$strTmpActualSalary', 
		  														 effectiveDate = '$strTmpDateIncremented', dateIncremented = '$strTmpDateIncremented',
																 tmpPositionDate = '$strTmpDateIncremented'												
					  					WHERE empNumber ='$t_strEmpNum'");
		  					  	
		  }
		  
		  $objEmpPosition= mysql_query("SELECT tblEmpPersonal.empNumber, tblEmpPosition.positionCode, tblEmpPosition.appointmentCode,
		  							   		   tblEmpPosition.assignPlace, tblEmpPosition.actualSalary, tblEmpPosition.effectiveDate, 
											   tblEmpPosition.stepNumber,tblEmpPosition.tmpPositionDate
								  	    FROM tblEmpPersonal
											INNER JOIN tblEmpPosition
												ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
											INNER JOIN tblAppointment
												ON tblEmpPosition.appointmentCode = tblAppointment.appointmentCode
											INNER JOIN tblPosition
										    	ON tblEmpPosition.positionCode = tblPosition.positionCode
										WHERE tblEmpPersonal.empNumber ='$t_strEmpNum'");
		  
		  $arrEmpPosition = mysql_fetch_array($objEmpPosition);
		  //$qEmpNum = $arrEmpPosition['empNumber'];
		  $t_strPositionCode = $arrEmpPosition['positionCode']; 
		  $t_strAppointmentCode =$arrEmpPosition['appointmentCode'];
		  $t_strAssignPlace = $arrEmpPosition['assignPlace'];
		  $t_strActualSalary = $arrEmpPosition['actualSalary'];
		  $t_strEffectiveDate = $arrEmpPosition['effectiveDate'];
		  $t_strStepNumber =  $arrEmpPosition['stepNumber'];
		  $t_strTmpPositionDate = $arrEmpPosition['tmpPositionDate'];
		 
		
		  $strEffectiveDateEx = explode('-',$t_strTmpPositionDate);
	   	  $arrPosDateYr = $strEffectiveDateEx[0];
		  $arrPosDateMonth = $strEffectiveDateEx[1];
		  $arrPosDateDay = $strEffectiveDateEx[2];
		   $arrPosDateDay2 = $arrPosDateDay;
		  
		  $objServiceRecLast = mysql_query ("SELECT DISTINCT tblEmpPersonal.empNumber,tblServiceRecord.positionCode,
										  				tblServiceRecord.salary, tblServiceRecord.serviceRecID 
									   		FROM tblServiceRecord
										  	INNER JOIN tblEmpPersonal
												ON tblEmpPersonal.empNumber = tblServiceRecord.empNumber
											INNER JOIN tblPosition
												ON tblServiceRecord.positionCode = tblPosition.positionCode
											WHERE tblEmpPersonal.empNumber ='$t_strEmpNum'
											ORDER BY tblServiceRecord.serviceFromDate desc, serviceToDate asc, tblServiceRecord.serviceRecID asc");
											
		  $arrServiceRecLast = mysql_fetch_array($objServiceRecLast);
		  $strServiceRecID = $arrServiceRecLast['serviceRecID'];
		  $strEmpNum = $arrServiceRecLast['empNumber'];
		  $strPositionCode = $arrServiceRecLast['positionCode'];
		  $strSalary = $arrServiceRecLast['salary'];
		  
		 
		  if($t_strActualSalary !=$strSalary)
		  {
		  	$insertToServiceRec = "INSERT INTO tblServiceRecord(empNumber,serviceFromDate,positionCode, salary ,stationAgency,appointmentCode)
										 VALUES('$t_strEmpNum', ' $t_strEffectiveDate', '$t_strPositionCode', '$t_strActualSalary', '$t_strAssignPlace','$t_strAppointmentCode')";	  
			$insServiceRec = mysql_query($insertToServiceRec);
			
			
			if ($arrPosDateDay == 1)
		    {
			
			 $t_strPrevDate = $this->getPrevDayYr($arrPosDateYr,$arrPosDateMonth,$arrPosDateDay);		
			 $insertServiceToDate = "UPDATE tblServiceRecord SET serviceToDate ='$t_strPrevDate' WHERE empNumber ='$strEmpNum' AND positionCode ='$strPositionCode' AND serviceRecID = '$strServiceRecID'";
			 $insServiceToDate = mysql_query($insertServiceToDate);
		    }
		
		    elseif($arrPosDateDay!= 1)
		    {
					
			 $arrDateDay = $arrPosDateDay - 1;
			 $t_strPrevDate = $this->combineDate($arrPosDateYr,$arrPosDateMonth,$arrDateDay);
			 $insertServiceToDate = "UPDATE tblServiceRecord SET serviceToDate ='$t_strPrevDate' WHERE empNumber ='$strEmpNum' AND positionCode ='$t_strPositionCode' AND serviceRecID = '$strServiceRecID'";
			 $insServiceToDate = mysql_query($insertServiceToDate);
		    }
		
		  }
		}
	}   
	
function viewStepIncrement($strEmpNmbr, $t_strEmpNum, $t_strName, $t_strPositionCode, $t_strSalaryGrade, $t_strStepNum, $t_StepNumber, $t_strActualSalary, $t_strDateInc, $t_ActualSalary)
{
		
	$objQuery = mysql_query("SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, tblEmpPersonal.firstname,
									tblEmpPosition.effectiveDate, tblEmpPosition.stepNumber, tblEmpPosition.actualSalary, 
									tblEmpPosition.salaryGradeNumber, tblEmpPosition.positionCode, tblEmpPosition.assignPlace,
									tblEmpPosition.appointmentCode, tblEmpPosition.dateIncremented, tblEmpPosition.positionDate,
									tblEmpPosition.tmpPositionDate,tblEmpPosition.statusOfAppointment,tblEmpPosition.appointmentCode
	   					  		FROM tblEmpPersonal
						 		 INNER JOIN tblEmpPosition
									ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
								 INNER JOIN tblPosition	
								 	ON tblEmpPosition.positionCode = tblPosition.positionCode");
	
	

	
	echo  "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\"><tr>"; 
            		echo  "<td height=\"33\" class=\"header\"><p>STEP INCREMENT(S)</p></td></tr>";
					echo  "<tr><td><table width=\"99%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
            		echo  "<tr><td width=\"24%\" rowspan=\"2\" class=\"alterrow\">NAME</td>";
            		echo "<td width=\"12%\" rowspan=\"2\" class=\"alterrow\">POSITION CODE</td>";
            		echo "<td width=\"9%\" rowspan=\"2\" class=\"alterrow\">SG #</td>";
            		echo "<td colspan=\"2\" class=\"alterrow\">STEP #</td>";
            		echo "<td colspan=\"2\" class=\"alterrow\">SALARY</td>";
					echo "<td width=\"15%\" rowspan=\"2\" class=\"alterrow\">DATE</td>";
					echo "<td width=\"15%\" rowspan=\"2\" class=\"alterrow\">&nbsp;&nbsp;&nbsp;&nbsp;</td>";
					echo "<td width=\"10%\" rowspan=\"2\" class=\"alterrow\"></td></tr>";
            		echo "<tr><td width=\"9%\" class=\"alterrow\">From</td>";
            		echo "<td width=\"9%\" class=\"alterrow\">To</td>";
            		echo "<td width=\"11%\" class=\"alterrow\">From</td>";
            		echo "<td width=\"11%\" class=\"alterrow\">To</td></tr>";
					echo "<tr><td colspan=\"9\">&nbsp;</td></tr>";
					
	while ($arrQuery=mysql_fetch_array($objQuery))
	 {
	
		$intCurYear = date('Y');
		$strCurMonth = date("m");
  		$t_strEmpNum = $arrQuery['empNumber'];
  		$t_strName = $arrQuery['surname']. ", " .$arrQuery['firstname'];
  		$t_strStepNum = $arrQuery['stepNumber'];
	  	$t_strSalaryGrade = $arrQuery['salaryGradeNumber'];
  		$t_strPositionCode = $arrQuery['positionCode'];
  		$t_strEffectiveDate = $arrQuery['effectiveDate'];
  		$t_strActualSalary = $arrQuery['actualSalary'];
  		$t_strAssignPlace = $arrQuery['assignPlace'];
  		$t_strAppointmentCode = $arrQuery['appointmentCode'];
		$t_strDateIncremented = $arrQuery['dateIncremented'];
  		$t_strTmpPositionDate = $arrQuery['tmpPositionDate'];
		$t_strStatusOfAppointment = $arrQuery['statusOfAppointment'];
		$t_strAppointmentCode = $arrQuery['appointmentCode'];
  
  		$arrDateInc = explode('-',$t_strTmpPositionDate);
  		$arrDateYear =  $arrDateInc[0];
  		$arrDateMonth = $arrDateInc[1];
  		$arrDateDay = $arrDateInc[2];

  		$intDateYear = intval($arrDateYear);
  		$intStepIncrement = $intCurYear - $intDateYear;
	
  		if(($arrDateMonth <= $strCurMonth)&&(($intStepIncrement / 3) == 1)&&($t_strStatusOfAppointment == 'In-Service')&&($t_strAppointmentCode== 'Perm'))
  		{
			$strYearInc = $intCurYear;
			$strMonthInc = $arrDateMonth;
			$strDayInc = $arrDateDay;
			$t_strDateInc = $intCurYear. "-" .$strMonthInc. "-".$strDayInc; 	
			$objSalarySched = mysql_query("SELECT tblSalarySched.salaryGradeNumber, tblSalarySched.stepNumber, tblSalarySched.actualSalary 
											FROM tblSalarySched
											WHERE tblSalarySched.salaryGradeNumber = '$t_strSalaryGrade'");
									
			
			  
			while($arrSalarySched  = mysql_fetch_array($objSalarySched))
	 		{
					$intStepNumber = $arrSalarySched['stepNumber'];
					$intActualSalary = $arrSalarySched['actualSalary'];
				
				if (($intStepNumber == $t_strStepNum + 1)&& ($t_strStepNum < 8))
				{	
					$t_StepNumber = $intStepNumber;
					$t_ActualSalary = $intActualSalary;
					
					
									
					echo "<tr class=\"border\"> 
   			   			<td height=\"24\">$t_strName</td>
	    				<td width=\"12%\">$t_strPositionCode</td>
   			   			<td width=\"9%\">$t_strSalaryGrade</td>
      		   			<td width=\"9%\">$t_strStepNum</td>
 	       		    	<td width=\"9%\">$t_StepNumber</td>
    		   			<td width=\"11%\">$t_strActualSalary</td>
	       		        <td width=\"11%\">$t_ActualSalary</td>
						<td width=\"15%\">$t_strDateInc</td>
			   			<td width=\"15%\">&nbsp;&nbsp;<a href=\"Stepincrement.php?strEmpNmbr=$strEmpNmbr&t_strEmpNum=$t_strEmpNum&t_strName=$t_strName&t_strPositionCode=$t_strPositionCode&t_strSalaryGrade=$t_strSalaryGrade&t_strStepNum=$t_strStepNum&t_StepNumber=$t_StepNumber&t_strActualSalary=$t_strActualSalary&t_ActualSalary=$t_ActualSalary&t_strDateInc=$t_strDateInc&Submit=Update\">Update</a>&nbsp;&nbsp;</td>			
						</tr>
						";
				 	
				     break;
				 }
				}
				$updateStep = "UPDATE tblEmpPosition SET tmpStepNumber ='$t_StepNumber', tmpActualSalary = '$t_ActualSalary', tmpDateIncremented ='$t_strDateInc'
							   WHERE empNumber = '$t_strEmpNum'";
				$updStep = mysql_query($updateStep); 
	 	       }
	         }
			echo "<tr><td colspan=\"9\">&nbsp;</td></tr>";
			echo "</table></table>";
	       }		

	}	
	
		

?> 