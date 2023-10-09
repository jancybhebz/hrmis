<?php 
/* 
File Name: Personalpositiondetails.php (class folder)
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
//require("../hrmis/class/PreviousDay.php");

//extends PreviousDayYr

class Position extends General
{
	
	function position() 
   	{
      include("../hrmis/class/Connect.php");   //the dbase connection
   	}
   	
	function editPosition($strEmpNmbr, $txtSearch, $optField, $p, $strLetter, $t_strAppointmentCode, $t_strStatusOfAppointment, $t_strServiceCode, $t_strSectionCode, $t_strPositionCode, $t_strDivisionCode, $t_strTaxStatCode, $t_strItemNumber, $t_intAuthorizeSalary, $t_strFirstDayAgencyMonth, $t_strFirstDayAgencyDay, $t_strFirstDayAgencyYear, $t_intStepNumber, $t_strFirstDayGovMonth, $t_strFirstDayGovDay, $t_strFirstDayGovYear, $t_strPlaceOfAssignment, $t_strAttendanceSchemeCode, $t_strPersonnelAction, $t_strEmploymentBasis, $t_strCategoryService, $t_strNatureOfWork, $t_strHPFactor, $t_strPayrollSwitch, $t_strDTRSwitch, $t_intDependents, $t_strHealthProvider, $t_strEffectiveMonth, $t_strEffectiveDay, $t_strEffectiveYear, $t_strPositionMonth, $t_strPositionDay, $t_strPositionYear, $t_strLongevityMonth, $t_strLongevityDay, $t_strLongevityYear, $t_intLongevityGap, $t_intActualSalary, $t_strContractEndMonth, $t_strContractEndDay, $t_strContractEndYear, $t_strOplNumber1, $t_strOplNumber2, $t_strOplNumber3, $t_intSalaryGradeNumber, $t_strEffectiveDateIncMonth, $t_strEffectiveDateIncDay, $t_strEffectiveDateIncYear, $t_strEmpNumber, $Submit, $t_strOldAppointmentCode)   // edit employees position details
 	{
      if ($Submit == 'EDIT')
	  {
	     $results = mysql_query("SELECT * FROM tblEmpPosition WHERE empNumber='$t_strEmpNumber'");
		 if($row = mysql_fetch_array($results))
		 {
		    do 
			{   			  
			 $t_strEmpNumber=$row["empNumber"];
			 $t_strAppointmentCode=$row["appointmentCode"];
			 $t_strStatusOfAppointment=$row['statusOfAppointment'];
			 $t_strServiceCode=$row["serviceCode"];
			 $t_strSectionCode=$row["sectionCode"];
			 $t_strPositionCode=$row["positionCode"];
			 $t_strDivisionCode=$row["divisionCode"];
			 $t_strTaxStatCode=$row["taxStatCode"];
			 $t_strItemNumber=$row["itemNumber"];
			 $t_intAuthorizeSalary= $row["authorizeSalary"];
			 $t_strFirstDayAgency=$row["firstDayAgency"];
			 $t_strPlaceOfAssignment=$row['assignPlace'];
			 $t_strAttendanceSchemeCode=$row['schemeCode'];
			 $t_intStepNumber=$row["stepNumber"];			 
			 $t_strFirstDayGov=$row["firstDayGov"];
			 $t_strPersonnelAction=$row["personnelAction"];
			 $t_strEmploymentBasis=$row["employmentBasis"];
			 $t_strCategoryService=$row["categoryService"];
			 $t_intDependents=$row["dependents"];
			 $t_strHealthProvider=$row["healthProvider"];
			 $t_strNatureOfWork=$row["nature"];
			 $t_strHPFactor=$row["hpFactor"];
			 $t_strPayrollSwitch=$row["payrollSwitch"];
			 $t_strDTRSwitch=$row["dtrSwitch"];
			 $t_strEffectiveDate=$row["effectiveDate"];
			 $t_strPositionDate=$row["positionDate"];
			 $t_strDummyDate=$row["dummyDate"];
			 $t_strLongevityDate=$row["longevityDate"];
			 $t_intLongevityGap = $row['longevityGap'];
			 $t_intActualSalary=$row["actualSalary"];
			 $t_intSalaryGradeNumber=$row['salaryGradeNumber'];
			 $t_strContractEndDate=$row["contractEndDate"];
			 $t_strOplNumber1=$row['oplNo1'];
			 $t_strOplNumber2=$row['oplNo2'];
			 $t_strOplNumber3=$row['oplNo3'];
			 $t_strEffectiveDateIncrement = $row['dateIncremented'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == "Submit"){ 
	 	$t_strFirstDayGov = $this->combineDate($t_strFirstDayGovYear, $t_strFirstDayGovMonth, $t_strFirstDayGovDay);
	 	$t_strFirstDayAgency = $this->combineDate($t_strFirstDayAgencyYear, $t_strFirstDayAgencyMonth, $t_strFirstDayAgencyDay);
		$t_strPositionDate = $this->combineDate($t_strPositionYear, $t_strPositionMonth, $t_strPositionDay);
		$t_strLongevityDate = $this->combineDate($t_strLongevityYear, $t_strLongevityMonth, $t_strLongevityDay);
		$t_strContractEndDate = $this->combineDate($t_strContractEndYear, $t_strContractEndMonth, $t_strContractEndDay);
		$t_strEffectiveDateIncrement = $this->combineDate($t_strEffectiveDateIncYear, $t_strEffectiveDateIncMonth, $t_strEffectiveDateIncDay);
		$t_strTmpPositionDate = $t_strPositionDate;
		$t_strEffectiveDate = $t_strPositionDate;
		$updateResults = "UPDATE tblEmpPosition SET empNumber='$t_strEmpNumber', appointmentCode='$t_strAppointmentCode', statusOfAppointment='$t_strStatusOfAppointment', serviceCode='$t_strServiceCode', sectionCode='$t_strSectionCode', positionCode='$t_strPositionCode', divisionCode='$t_strDivisionCode', taxStatCode='$t_strTaxStatCode', itemNumber='$t_strItemNumber', authorizeSalary='$t_intAuthorizeSalary', firstDayAgency='$t_strFirstDayAgency', stepNumber='$t_intStepNumber', firstDayGov='$t_strFirstDayGov', assignPlace='$t_strPlaceOfAssignment', schemeCode='$t_strAttendanceSchemeCode', personnelAction='$t_strPersonnelAction', employmentBasis='$t_strEmploymentBasis', categoryService='$t_strCategoryService', dependents='$t_intDependents', healthProvider='$t_strHealthProvider', nature='$t_strNatureOfWork', hpFactor='$t_strHPFactor', payrollSwitch='$t_strPayrollSwitch', dtrSwitch='$t_strDTRSwitch', effectiveDate='$t_strPositionDate', positionDate='$t_strPositionDate', longevityDate='$t_strLongevityDate', longevityGap = '$t_intLongevityGap', actualSalary='$t_intActualSalary', tmpPositionDate = '$t_strTmpPositionDate', contractEndDate='$t_strContractEndDate', oplNo1='$t_strOplNumber1', oplNo2='$t_strOplNumber2', oplNo3='$t_strOplNumber3', salaryGradeNumber='$t_intSalaryGradeNumber', dateIncremented='$t_strEffectiveDateIncrement' WHERE empNumber='$t_strEmpNumber'";
		$modifyResults = mysql_query($updateResults);
		
		//inserting to service record for change of position starts here.
		$objEmpPosition = mysql_query("SELECT tblEmpPersonal.empNumber, tblEmpPosition.positionCode, tblEmpPosition.appointmentCode,
											  tblEmpPosition.positionDate, tblEmpPosition.actualSalary, tblEmpPosition.assignPlace,
											  tblEmpPosition.effectiveDate
									   FROM tblEmpPersonal
									  	 INNER JOIN tblEmpPosition
											ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber 
										WHERE tblEmpPersonal.empNumber ='$t_strEmpNumber'");
																	
		$arrEmpPosition = mysql_fetch_array($objEmpPosition);
		$strEPEmpNum = $arrEmpPosition['empNumber'];
		$strEPPositionCode = $arrEmpPosition['positionCode'];
		$strEPAppointmentCode = $arrEmpPosition['appointmentCode'];
		$strEPPostitionDate = $arrEmpPosition['positionDate'];
		$strEPSalary = $arrEmpPosition['actualSalary'];
		$strEPAssignPlace = $arrEmpPosition['assignPlace'];
		$strEPEffectiveDate= $arrEmpPosition['effectiveDate'];
		
		$strEPEffectiveDateEx = explode('-',$strEPEffectiveDate);
		$arrPosDateYr = $strEPEffectiveDateEx[0];
		$arrPosDateMonth = $strEPEffectiveDateEx[1];
		$arrPosDateDay = $strEPEffectiveDateEx[2];
		$strPosDateDay2 = $arrPosDateDay;
			   
			
		$objServiceRecLast = mysql_query("SELECT * FROM tblServiceRecord 
										   WHERE tblServiceRecord.empNumber ='$t_strEmpNumber'
										   ORDER BY tblServiceRecord.serviceRecID desc");	
										   
		$totalNumRows = mysql_num_rows($objServiceRecLast);
		
		$arrServiceRecLast = mysql_fetch_array($objServiceRecLast);
		$strServiceRecID = $arrServiceRecLast['serviceRecID'];
		$strEmpNum = $arrServiceRecLast['empNumber'];
		$strPositionCode = $arrServiceRecLast['positionCode'];
		$strSalary = $arrServiceRecLast['salary'];
									
		/*if($totalNumRows == 0)
		{
			
			 echo "hellow";
			 $objInsertToServiceRec = "INSERT INTO tblServiceRecord(empNumber,serviceFromDate, positionCode, salary ,stationAgency,appointmentCode)
  			     				   VALUES('$strEPEmpNum', '$strEPEffectiveDate', '$strEPPositionCode','$strEPSalary', '$strEPAssignPlace','$strEPAppointmentCode'";		
			 $arrInsertToServiceRec = mysql_query($objInsertToServiceRec);
		}*/
		
		elseif($totalNumRows!= 0) //change of position & across the board salary adjustments				
		{
			echo "hellow2";
			if ($strEPSalary!=$strSalary)
			{ 				
		    	
		   		$insertPosDetails = "INSERT INTO tblServiceRecord(empNumber,serviceFromDate, positionCode, salary ,stationAgency,appointmentCode)
			    	 				 VALUES('$strEPEmpNum', '$strEPEffectiveDate', '$strEPPositionCode','$strEPSalary', '$strEPAssignPlace','$strEPAppointmentCode')";
		   		$insPosDet = mysql_query($insertPosDetails);					
			
		   		if ($arrPosDateDay  == 1)
		   		{
					$prevDate = $this->getPrevDayYr($arrPosDateYr , $arrPosDateMonth,$arrPosDateDay);		
					$insertServiceToDate = mysql_query("UPDATE tblServiceRecord SET serviceToDate ='$prevDate' WHERE empNumber ='$strEmpNum' AND positionCode ='$strPositionCode' AND serviceRecID = '$strServiceRecID'");
		   		}
		
		   		elseif($arrPosDateDay!= 1)
		   		{
		   		
					$arrDateDay = $arrPosDateDay - 1;
					$prevDate = $this->combineDate($arrPosDateYr , $arrPosDateMonth, $arrDateDay);
					$insertServiceToDate = mysql_query("UPDATE tblServiceRecord SET serviceToDate ='$prevDate' WHERE empNumber ='$strEmpNum' AND positionCode ='$strPositionCode ' AND serviceRecID= '$strServiceRecID'");
		   		}
				
		 	}
		  } //inserting to service record for change of position and salary adjustments ends here.
	 } 
}
	
	
	function viewPosition($strEmpNmbr, $txtSearch, $optField, $p, $strLetter, $t_strAppointmentCode, $t_strStatusOfAppointment, $t_strServiceCode, $t_strSectionCode, $t_strPositionCode, $t_strDivisionCode, $t_strTaxStatCode, $t_strItemNumber, $t_intAuthorizeSalary, $t_strFirstDayAgency, $t_intStepNumber, $t_strFirstDayGov, $t_strPlaceOfAssignment, $t_strAttendanceSchemeCode, $t_strPersonnelAction, $t_strEmploymentBasis, $t_strCategoryService, $t_strNatureOfWork, $t_strHPFactor, $t_strPayrollSwitch, $t_strDTRSwitch, $t_intDependents, $t_strHealthProvider, $t_strEffectiveDate, $t_strPositionDate, $t_strLongevityDate, $t_intLongevityGap, $t_intActualSalary, $t_strContractEndDate, $t_strOplNumber1, $t_strOplNumber2, $t_strOplNumber3, $t_intSalaryGradeNumber, $t_strEffectiveDateIncrement, $t_strEmpNumber)   //view employees position details
    { 
	     
		 
		 
		 $viewResults = mysql_query("SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
		 						tblEmpPersonal.firstname, tblEmpPersonal.middlename,
								tblEmpPosition.appointmentCode, tblEmpPosition.positionCode,
								tblEmpPosition.serviceCode, tblEmpPosition.divisionCode,
								tblEmpPosition.sectionCode, tblEmpPosition.taxStatCode,
								tblEmpPosition.itemNumber, tblEmpPosition.firstDayAgency,
								tblEmpPosition.statusOfAppointment, tblEmpPosition.assignPlace,
								tblEmpPosition.firstDayGov, tblEmpPosition.stepNumber,
								tblEmpPosition.personnelAction, tblEmpPosition.employmentBasis,
								tblEmpPosition.categoryService, tblEmpPosition.nature,
								tblEmpPosition.hpFactor, tblEmpPosition.payrollSwitch,
								tblEmpPosition.dtrSwitch, tblEmpPosition.mcSwitch,
								tblEmpPosition.hazardSwitch, tblEmpPosition.longevitySwitch,
								tblEmpPosition.pagibigSwitch, tblEmpPosition.philhealthSwitch,
								tblEmpPosition.itwSwitch, tblEmpPosition.lifeRetSwitch,
								tblEmpPosition.dependents, tblEmpPosition.healthProvider,
								tblEmpPosition.effectiveDate, tblEmpPosition.positionDate,
								tblEmpPosition.longevityDate, tblEmpPosition.actualSalary,
								tblEmpPosition.contractEndDate, tblEmpPosition.oplNo1, 
								tblEmpPosition.oplNo2, tblEmpPosition.oplNo3, tblEmpPosition.dateIncremented,
								tblEmpPosition.salaryGradeNumber, tblEmpPosition.authorizeSalary,
								tblEmpPosition.longevityGap, tblEmpPosition.schemeCode
							FROM tblEmpPosition 
							INNER JOIN tblEmpPersonal ON 
								tblEmpPosition.empNumber = tblEmpPersonal.empNumber
							WHERE tblEmpPosition.empNumber='$t_strEmpNumber'");

	    
		 if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "database is empty";
		 } else {
		 	 $curDate = date("Y-m-d");
			 $t_strEmpNumber=$row["empNumber"];
			 $t_strAppointmentCode=$row["appointmentCode"];
			 $t_strStatusOfAppointment=$row['statusOfAppointment'];
			 $t_strServiceCode=$row["serviceCode"];
			 $t_strSectionCode=$row["sectionCode"];
			 $t_strPositionCode=$row["positionCode"];
			 $t_strDivisionCode=$row["divisionCode"];
			 $t_strTaxStatCode=$row["taxStatCode"];
			 $t_strItemNumber=$row["itemNumber"];
			 $t_strFirstDayAgency=$row["firstDayAgency"];
			 $t_strPlaceOfAssignment=$row['assignPlace'];
			 $t_strAttendanceSchemeCode=$row['schemeCode'];
			 $t_intStepNumber=$row["stepNumber"];			 
			 $t_strFirstDayGov=$row["firstDayGov"];
			 $t_strPersonnelAction=$row["personnelAction"];
			 $t_strEmploymentBasis=$row["employmentBasis"];
			 $t_strCategoryService=$row["categoryService"];
			 $t_intDependents=$row["dependents"];
			 $t_strHealthProvider=$row["healthProvider"];
			 $t_strNatureOfWork=$row["nature"];
			 $t_strHPFactor=$row["hpFactor"];
			 $t_strPayrollSwitch=$row["payrollSwitch"];
			 $t_strDTRSwitch=$row["dtrSwitch"];
			 $t_strEffectiveDate=$row["effectiveDate"];
			 $t_strPositionDate=$row["positionDate"];
			 $t_strLongevityDate=$row["longevityDate"];
			 $t_intLongevityGap=$row['longevityGap'];
			 $t_intActualSalary=$row["actualSalary"];
			 $t_intAuthorizeSalary=$row["authorizeSalary"];
			 $t_strContractEndDate=$row["contractEndDate"];
			 $t_strOplNumber1=$row['oplNo1'];
			 $t_strOplNumber2=$row['oplNo2'];
			 $t_strOplNumber3=$row['oplNo3'];
			 $t_intSalaryGradeNumber=$row['salaryGradeNumber'];
			 $t_strEffectiveDateIncrement = $row['dateIncremented'];
			echo "<table width=\"90%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"border\">";
            echo "<tr><td width=\"480\" height=\"73\"><table width=\"100%\" height=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"#99CCFF\">";
            echo "<tr><td width=\"141\" class=\"paragraph\">Employee Number : </td>";
            echo "<td width=\"339\"><strong>" . $row['empNumber'] . "</strong></td></tr>";  
            echo "<tr><td class=\"paragraph\">Employee Name :</td>";
            echo "<td><strong>" . $row['surname']  . ", " . $row['firstname'] . "  ". $row['middlename'] . "</strong></td></tr>";
            echo "<tr><td class=\"paragraph\">Division :</td><td><strong>" . $row['divisionCode'] . "</strong></td></tr>";
            echo "<tr><td class=\"paragraph\">Position : </td>";
            echo "<td><strong>" . $row['positionCode'] . "</strong></td></tr></table></td>";
            echo "<td width=\"72\" bgcolor=\"#99CCFF\">";
			echo "<img src='Getdata.php?t_strEmpNumber=$t_strEmpNumber'  width=\"70\" height=\"70\"></td></tr></table>";
			echo "<hr>";
			echo "<table width=\"98%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
            echo "<tr class=\"alterrow\"><td colspan=\"4\">Position Details :</td></tr>";
			// Position Details starts here
            echo "<tr><td width=\"21%\" class=\"paragraph\">Service Code : </td>";   		// ServiceCode
			echo "<td width=\"25%\">&nbsp;" . $row['serviceCode'] . "</td>";
			echo "<td width=\"20%\" class=\"paragraph\">Actual Salary :</td>";				//  Actual Salary
			echo "<td width=\"25%\"> &nbsp;" . $row['actualSalary'] . "</td></tr>";
			echo "<tr><td width=\"21%\" class=\"paragraph\">First Day Goverment :</td>";	//  FirstDayGov
           echo "<td>&nbsp;" . $row['firstDayGov'] . "</td>";
		   echo "<td width=\"20%\" class=\"paragraph\">Salary Effectivity Date :</td>";		//  Salary Effectivity Date
		   echo "<td width=\"25%\"> &nbsp;" . $row['effectiveDate'] . "</td></tr>";
		   echo "<tr><td width=\"21%\" class=\"paragraph\">First Day Agency :</td>";		//  FirstDayAgency
           echo "<td> &nbsp;" . $row['firstDayAgency'] . "</td>";
           echo "<td width=\"20%\" class=\"paragraph\">Employment Basis :</td>";			//  Employment Basis
           echo "<td width=\"25%\"> &nbsp;" . $row['employmentBasis'] . "</td></tr>";
           echo "<tr><td class=\"paragraph\">Longevity Date :</td>";						//  LongevityDate
		   echo "<td> &nbsp;" . $row['longevityDate'] . "</td>";
		   echo "<td class=\"paragraph\">HP Factor :</td>";									//  HP Factor
		   echo "<td>&nbsp;" . $row['hpFactor'] . "</td></tr>";
		   echo "<tr><td class=\"paragraph\">Longevity Gap :</td>";							//  LongevityGap
		   echo "<td>&nbsp;" . $row['longevityGap'] . "</td>";	
		   echo "<td class=\"paragraph\">Nature of Work :</td>";							//  Nature Of Work
		   echo "<td>&nbsp;" . $row['nature'] . "</td></tr>";
		   echo "<tr><td class=\"paragraph\">Employed/Separated? :</td>";					//  Employed/Separated
		   echo "<td>&nbsp;" . $row['statusOfAppointment'] . "</td>";
		   echo "<td class=\"paragraph\">Category Service :</td>";							//  Category Service
		   echo "<td>&nbsp;" . $row['categoryService'] . "</td></tr>";
		   echo "<tr><td class=\"paragraph\">Separation Date :</td>";						//  Separation/contract end date
		   echo "<td> &nbsp;" . $row['contractEndDate'] . "</td>";
           echo "<td class=\"paragraph\">Tax Status :</td>";								//  Tax Status
		   echo "<td>&nbsp;" . $row['taxStatCode'] . "</td></tr>";
           echo "<tr><td class=\"paragraph\">Appointment Desc. :</td>";						//  Appointment Code
		   echo "<td> &nbsp;" . $row['appointmentCode'] . "</td>";
           echo "<td class=\"paragraph\">No. Of Dependents :</td>";							//  No. of Dependents
		   echo "<td>&nbsp;" . $row['dependents'] . "</td></tr>";
           echo "<tr><td class=\"paragraph\">Division Code :</td>";							//  Division Code
		   echo "<td> &nbsp;" . $row['divisionCode'] . "</td>";
		   echo "<td class=\"paragraph\">Personnel Action :</td>";							//  Personnel Action
		   echo "<td> &nbsp;" . $row['personnelAction'] . "</td></tr>";
		   echo "<tr><td class=\"paragraph\">Section Code :</td>";							//  Section Code
		   echo "<td>&nbsp;" . $row['sectionCode'] . "</td>";
           echo "<td class=\"paragraph\">Include DTR? :</td>";								//  Include DTR
		   echo "<td>&nbsp;" . $row['dtrSwitch'] . "</td></tr>";
           echo "<tr><td class=\"paragraph\">Place of Assignment :</td>";					//  Place of Assignment
           echo "<td>&nbsp;" . $row['assignPlace'] . "</td>"; 
           echo "<td class=\"paragraph\">Include Payroll? :</td>";			//  Include Payroll
           echo "<td>&nbsp;" . $row['payrollSwitch'] . "</td></tr>"; 
		   echo "<tr><td class=\"paragraph\">&nbsp;</td>";					//  Place of Assignment
           echo "<td>&nbsp;</td>"; 
		   echo "<td class=\"paragraph\">Attendance Scheme :</td>";
           echo "<td>&nbsp;" . $row['schemeCode'] . "</td></td></tr>";
		   echo "<tr><td colspan=\"4\">&nbsp;</td></tr>";
		   //  Optional Policy Loan starts here
		   echo "<tr class=\"alterrow\"><td colspan=\"4\">Optional Policy Loan :</td></tr>";
		   echo "<tr><td class=\"paragraph\">OPL No. 1 :</td><td>&nbsp;" . $row['oplNo1'] . "</td>";
		   echo "<td class=\"paragraph\">OPL No. 2 :</td><td>&nbsp;" . $row['oplNo2'] . "</td></tr>";
		   echo "<tr><td colspan=\"3\" class=\"paragraph\">OPL No. 3 :</td>";
		   echo "<td> &nbsp;" . $row['oplNo3'] . "</td></tr>";
		   echo "<tr><td colspan=\"4\">&nbsp;</td></tr>";
		   echo "<tr class=\"alterrow\"><td colspan=\"4\">Plantilla Position :</td></tr>";
		   echo "<tr><td class=\"paragraph\">ItemNumber :</td><td> &nbsp;" . $row['itemNumber'] . "</td>";
		   echo "<td class=\"paragraph\">Salary Grade : </td><td>&nbsp;" .$row['salaryGradeNumber'] ."</td></tr>";
		   echo "<tr><td class=\"paragraph\">Authorize Salary :</td><td> &nbsp;" . $row['authorizeSalary'] . "</td>";
		   echo "<td class=\"paragraph\">Step Number : </td><td>&nbsp;" .$row['stepNumber'] ."</td></tr>";
		   echo "<tr><td class=\"paragraph\">Position Code :</td><td> &nbsp;" . $row['positionCode'] . "</td>";
		   echo "<td class=\"paragraph\">Date Increment : </td><td>&nbsp;" .$row['dateIncremented'] ."</td></tr>";
		   echo "<tr><td class=\"paragraph\">Position Date : </td><td>&nbsp;" .$row["positionDate"] ."</td>";
		   echo "<td class=\"paragraph\">&nbsp;</td><td>&nbsp;</td></tr>";
           echo "<tr><td colspan=\"4\">&nbsp;</td></tr>";
		   echo "<tr class=\"td\">";
		   echo "<td colspan=\"4\"><a href=\"Personalpositiondetails.php?strEmpNmbr=$strEmpNmbr&txtSearch=$txtSearch&optField=$optField&p=$p&strLetter=$strLetter&t_strAppointmentCode=$t_strAppointmentCode&t_strStatusOfAppointment=$t_strStatusOfAppointment&t_strServiceCode=$t_strServiceCode&t_strSectionCode=$t_strSectionCode&t_strPositionCode=$t_strPositionCode&t_strDivisionCode=$t_strDivisionCode&t_strTaxStatCode=$t_strTaxStatCode&t_strItemNumber=$t_strItemNumber&t_intAuthorizeSalary=$t_intAuthorizeSalary&t_strFirstDayAgency=$t_strFirstDayAgency&t_intStepNumber=$t_intStepNumber&t_strFirstDayGov=$t_strFirstDayGov&t_strPlaceOfAssignment=$t_strPlaceOfAssignment&t_strAttendanceSchemeCode=$t_strAttendanceSchemeCode&t_strPersonnelAction=$t_strPersonnelAction&t_strEmploymentBasis=$t_strEmploymentBasis&t_strCategoryService=$t_strCategoryService&t_strNatureOfWork=$t_strNatureOfWork&t_strHPFactor=$t_strHPFactor&t_strPayrollSwitch=$t_strPayrollSwitch&t_strDTRSwitch=$t_strDTRSwitch&t_intDependents=$t_intDependents&t_strHealthProvider=$t_strHealthProvider&t_strEffectiveDate=$t_strEffectiveDate&t_strPositionDate=$t_strPositionDate&t_strLongevityDate=$t_strLongevityDate&t_intLongevityGap=$t_intLongevityGap&t_strContractEndDate=$t_strContractEndDate&t_intActualSalary=$t_intActualSalary&t_strOplNumber1=$t_strOplNumber1&t_strOplNumber2=$t_strOplNumber2&t_strOplNumber3=$t_strOplNumber3&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_strEffectiveDateIncrement=$t_strEffectiveDateIncrement&t_strEmpNumber=$t_strEmpNumber&Submit=EDIT\">EDIT</a></td></tr></table>";
		   }	
	} 

	function authorizeSalary($t_strEmpNumber, $t_strItemNumber)		//  Authorize Salary
	{

		if (strlen($t_strEmpNumber) == 0)
		{
			$t_strEmpNumber = $this->strEmpNumber;
		}

		if (strlen($t_strItemNumber) == 0)
		{
			$t_strItemNumber = $this->strItemNumber;
		}
				
		$objPositionCode = mysql_query("SELECT authorizeSalary FROM tblPlantilla WHERE itemNumber = '$t_strItemNumber'");
		$row = mysql_fetch_array($objPositionCode);
		return $row["authorizeSalary"];
		
	}

	function positionCode($t_strEmpNumber, $t_strItemNumber)   //  Position Code
	{

		if (strlen($t_strEmpNumber) == 0)
		{
			$t_strEmpNumber = $this->strEmpNumber;
		}

		if (strlen($t_strItemNumber) == 0)
		{
			$t_strItemNumber = $this->strItemNumber;
		}
				
		$objPositionCode = mysql_query("SELECT positionCode FROM tblPlantilla WHERE itemNumber = '$t_strItemNumber'");
		$row = mysql_fetch_array($objPositionCode);
		return $row["positionCode"];
		
	}
	
	function salaryGrade($t_strEmpNumber, $t_strItemNumber)		//  Salary Grade
	{

		if (strlen($t_strEmpNumber) == 0)
		{
			$t_strEmpNumber = $this->strEmpNumber;
		}

		if (strlen($t_strItemNumber) == 0)
		{
			$t_strItemNumber = $this->strItemNumber;
		}
				
		$objPositionCode = mysql_query("SELECT salaryGrade FROM tblPlantilla WHERE itemNumber = '$t_strItemNumber'");
		$row = mysql_fetch_array($objPositionCode);
		return $row["salaryGrade"];
		
	}

	function stepNumber($t_strEmpNumber, $t_strItemNumber)		//  Step Number
	{

		if (strlen($t_strEmpNumber) == 0)
		{
			$t_strEmpNumber = $this->strEmpNumber;
		}

		if (strlen($t_strItemNumber) == 0)
		{
			$t_strItemNumber = $this->strItemNumber;
		}
				
		$objPositionCode = mysql_query("SELECT stepNumber FROM tblPlantilla WHERE itemNumber = '$t_strItemNumber'");
		$row = mysql_fetch_array($objPositionCode);
		return $row["stepNumber"];
		
	}

	function comboItemNumber($t_strItemNumber)					//  Item Number Function
	{
	
		$result = mysql_query ("SELECT * FROM tblPlantilla");
		
		if ($row = mysql_fetch_array($result)) {
		do {
			if ($t_strItemNumber == $row["itemNumber"])
			{
				print "<OPTION VALUE=\"".($row["itemNumber"])."\" selected>".($row["itemNumber"])."\r";
			}
		  print "<OPTION VALUE=\"".($row["itemNumber"])."\">".($row["itemNumber"])."\r";
		} while($row = mysql_fetch_array($result));
		} else {print "no results!";}
	
	}
		
	function comboAppointmentCode($t_strAppointmentCode)			//  Appointment Code Function
	{

		$result = mysql_query ("SELECT * FROM tblAppointment");

		if ($row = mysql_fetch_array($result)) {
		do {
			if ($t_strAppointmentCode == $row["appointmentCode"])
			{
				print "<OPTION VALUE=\"".($row["appointmentCode"])."\" selected>".($row["appointmentDesc"])."\r";
			}
		  print "<OPTION VALUE=\"".($row["appointmentCode"])."\">".($row["appointmentDesc"])."\r";
		} while($row = mysql_fetch_array($result));
		} else {print "no results!";}

	}

	function comboDivisionCode($t_strDivisionCode)				//  Division Code
	{
	
		$result = mysql_query ("SELECT * FROM tblDivision");

		if ($row = mysql_fetch_array($result)) {
		do {
			if ($t_strDivisionCode == $row["divisionCode"])
			{
				print "<OPTION VALUE=\"".strtoupper($row["divisionCode"])."\" selected>".strtoupper($row["divisionCode"])."\r";
			}
		  print "<OPTION VALUE=\"".strtoupper($row["divisionCode"])."\">".strtoupper($row["divisionCode"])."\r";
		} while($row = mysql_fetch_array($result));
		} else {print "no results!";}
	
	}

	function comboSectionCode($t_strSectionCode)				//  Section Code
	{
	
		$result = mysql_query ("SELECT sectionCode FROM tblSection");

		if ($row = mysql_fetch_array($result)) {
		do {
			if ($t_strSectionCode == $row["sectionCode"])
			{
				print "<OPTION VALUE=\"".strtoupper($row["sectionCode"])."\" selected>".strtoupper($row["sectionCode"])."\r";
			}
		  print "<OPTION VALUE=\"".strtoupper($row["sectionCode"])."\">".strtoupper($row["sectionCode"])."\r";
		} while($row = mysql_fetch_array($result));
		} else {print "no results!";}
	
	}
	
	function comboServiceCode($t_strServiceCode)				//  Service Code
	{
	
		$result = mysql_query("SELECT * FROM tblServiceCode ");	

		if ($row = mysql_fetch_array($result)) {
		do {
			if ($t_strServiceCode == $row["serviceCode"])
			{
				print "<OPTION VALUE=\"".($row["serviceCode"])."\" selected>".($row["serviceCode"])."\r";
			}
		  print "<OPTION VALUE=\"".($row["serviceCode"])."\">".($row["serviceCode"])."\r";
		} while($row = mysql_fetch_array($result));
		} else {print "no results!";}
	
	}
	
	function comboSeparationCause($t_strStatusOfAppointment)				//  Employed/Separated
	{
		$result = mysql_query ("SELECT * FROM tblSeparationCause");
		
		if ($row = mysql_fetch_array($result)) {
		do {
			if ($t_strStatusOfAppointment == $row["separationCause"])
			{
				print "<OPTION VALUE=\"".($row["separationCause"])."\" selected>".($row["separationCause"])."\r";
			}
		  print "<OPTION VALUE=\"".($row["separationCause"])."\">".($row["separationCause"])."\r";
		} while($row = mysql_fetch_array($result));
		} else {print "no results!";}
	
	}
	
	function comboAttendanceScheme($t_strAttendanceSchemeCode)			//  Attendance Code Function
	{

		$result = mysql_query ("SELECT * FROM tblAttendanceScheme");

		if ($row = mysql_fetch_array($result)) {
		do {
			if ($t_strAttendanceSchemeCode == $row["schemeCode"])
			{
				print "<OPTION VALUE=\"".($row["schemeCode"])."\" selected>".($row["schemeName"])."\r";
			}
		  print "<OPTION VALUE=\"".($row["schemeCode"])."\">".($row["schemeName"])."\r";
		} while($row = mysql_fetch_array($result));
		} else {print "no results!";}

	}
	
}	//  end class
?>