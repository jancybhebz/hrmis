<?php 
/* 
File Name: Employeepositiondetails.php (class folder)
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
class Employeepositiondetails extends General
{

	function employeePositionDetails() 
   	{
      include("../hrmis/class/Connect.php");   //the dbase connection
   	}
   	
	function viewPosition($strEmpNmbr, $txtSearch, $optField, $p, $t_strAppointmentCode, $t_strStatusOfAppointment, $t_strServiceCode, $t_strSectionCode, $t_strPositionCode, $t_strDivisionCode, $t_strTaxStatCode, $t_strItemNumber, $t_intAuthorizeSalary, $t_strFirstDayAgency, $t_intStepNumber, $t_strFirstDayGov, $t_strPlaceOfAssignment, $t_strPersonnelAction, $t_strEmploymentBasis, $t_strCategoryService, $t_strNatureOfWork, $t_strHPFactor, $t_strPayrollSwitch, $t_strDTRSwitch, $t_intDependents, $t_strHealthProvider, $t_strEffectiveDate, $t_strPositionDate, $t_strLongevityDate, $t_intLongevityGap, $t_intActualSalary, $t_strContractEndDate, $t_strOplNumber1, $t_strOplNumber2, $t_strOplNumber3, $t_intSalaryGradeNumber, $t_strEffectiveDateIncrement, $t_strEmpNumber)   //view employees position details
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
								tblEmpPosition.longevityGap
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
		   echo "<td>&nbsp;" . $row['dependents'] . "</td></tr>";
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
		   echo "<tr class=\"td\">&nbsp;</tr></table>";
		   }	
	} 

/*
	function viewPosition($txtSearch, $optField, $p, $t_strAppointmentCode, $t_strServiceCode, $t_strSectionCode, $t_strPositionCode, $t_strDivisionCode, $t_strTaxStatCode, $t_strItemNumber, $t_strFirstDayAgency, $t_intStepNumber, $t_strFirstDayGov, $t_strPersonnelAction, $t_strEmploymentBasis, $t_strCategoryService, $t_strNatureOfWork, $t_strHPFactor, $t_strPayrollSwitch, $t_strDTRSwitch, $t_intDependents, $t_strHealthProvider, $t_strEffectiveDate, $t_strPositionDate, $t_strLongevityDate, $t_intActualSalary, $t_strContractEndDate, $t_strOplNumber1, $t_strOplNumber2, $t_strOplNumber3, $t_strEmpNumber)   //view employee position
    {
	     $viewResults = mysql_query("SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
		 						tblEmpPersonal.firstname, tblEmpPersonal.middlename,
								tblEmpPosition.appointmentCode, tblEmpPosition.positionCode,
								tblEmpPosition.serviceCode, tblEmpPosition.divisionCode,
								tblEmpPosition.sectionCode, tblEmpPosition.taxStatCode,
								tblEmpPosition.itemNumber, tblEmpPosition.firstDayAgency,
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
								tblEmpPosition.oplNo2, tblEmpPosition.oplNo3
							FROM tblEmpPosition 
							INNER JOIN tblEmpPersonal ON 
								tblEmpPosition.empNumber = tblEmpPersonal.empNumber
							WHERE tblEmpPosition.empNumber='$t_strEmpNumber'");

	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "database is empty";
		 } else {
			 $t_strEmpNumber=$row["empNumber"];
			 $t_strAppointmentCode=$row["appointmentCode"];
			 $t_strServiceCode=$row["serviceCode"];
			 $t_strSectionCode=$row["sectionCode"];
			 $t_strPositionCode=$row["positionCode"];
			 $t_strDivisionCode=$row["divisionCode"];
			 $t_strTaxStatCode=$row["taxStatCode"];
			 $t_strItemNumber=$row["itemNumber"];
			 $t_strFirstDayAgency=$row["firstDayAgency"];
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
			 $t_intActualSalary=$row["actualSalary"];
			 $t_strContractEndDate=$row["contractEndDate"];
			 $t_strOplNumber1=$row['oplNo1'];
			 $t_strOplNumber2=$row['oplNo2'];
			 $t_strOplNumber3=$row['oplNo3'];
			echo "<table width=\"98%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
            echo "<tr class=\"alterrow\"><td colspan=\"4\">Position Details :</td></tr>";
            echo "<tr><td width=\"21%\" class=\"paragraph\">Service Code : </td>";
			echo "<td width=\"31%\">&nbsp;" . $row['serviceCode'] . "</td>";
			echo "<td width=\"20%\" class=\"paragraph\">First Day Gov't :</td>";
			echo "<td width=\"28%\"> &nbsp;" . $row['firstDayGov'] . "</td></tr>";
			echo "<tr><td width=\"21%\" class=\"paragraph\"> Appointment Code :</td>";
           echo "<td>&nbsp;" . $row['appointmentCode'] . "</td>";
		   echo "<td width=\"20%\" class=\"paragraph\">First Day Agency : </td>";
		   echo "<td width=\"28%\"> &nbsp;" . $row['firstDayAgency'] . "</td></tr>";
		   echo "<tr><td class=\"paragraph\">Division Code : </td>";
		   echo "<td> &nbsp;" . $row['divisionCode'] . "</td>";
		   echo "<td class=\"paragraph\">Item Number :</td>";
		   echo "<td>&nbsp;" . $row['itemNumber'] . "</td></tr>";
		   echo "<tr><td class=\"paragraph\">Section Code :</td><td>&nbsp;" . $row['sectionCode'] . "</td>";
		   echo "<td class=\"paragraph\">Employment Basis :</td><td>&nbsp;" . $row['employmentBasis'] . "</td></tr>";
		   echo "<tr><td class=\"paragraph\">Position Code :</td><td>&nbsp;" . $row['positionCode'] . "</td>";
		   echo "<td class=\"paragraph\">Personnel Action :</td><td>&nbsp;" . $row['personnelAction'] . "</td></tr>";
		   echo "<tr><td class=\"paragraph\">Position Date :</td><td> &nbsp;" . $row['positionDate'] . "</td>";
           echo "<td class=\"paragraph\">Nature of Work :</td><td>&nbsp;" . $row['nature'] . "</td></tr>";
           echo "<tr><td class=\"paragraph\">Effectivity Date :</td><td> &nbsp;" . $row['effectiveDate'] . "</td>";
           echo "<td class=\"paragraph\">Category Service :</td><td>&nbsp;" . $row['categoryService'] . "</td></tr>";
           echo "<tr><td class=\"paragraph\">Contract End Date :</td>";
		   echo "<td> &nbsp;" . $row['contractEndDate'] . "</td>";
		   echo "<td class=\"paragraph\">Payroll Switch :</td>";
		   echo "<td> &nbsp;" . $row['payrollSwitch'] . "</td></tr>";
		   echo "<tr><td class=\"paragraph\">Longevity Date : </td><td>&nbsp;" . $row['longevityDate'] . "</td>";
           echo "<td class=\"paragraph\">DTR Switch :</td><td>&nbsp;" . $row['dtrSwitch'] . "</td></tr>";
           echo "<tr><td class=\"paragraph\">Actual Salary:</td><td>&nbsp;" . $row['actualSalary'] . "</td>";
           echo "<td class=\"paragraph\">HP Factor :</td><td>&nbsp;" . $row['hpFactor'] . "</td></tr>";
		   echo "<tr><td rowspan=\"2\" class=\"paragraph\">w/ health insurance provider :</td>";
		   echo "<td rowspan=\"2\">&nbsp;" . $row['healthProvider'] . "</td>";
		   echo "<td class=\"paragraph\">Tax Status : </td>";
		   echo "<td>&nbsp;" . $row['taxStatCode'] . "</td></tr>";
           echo "<tr><td class=\"paragraph\">No. of Dependents :</td><td>&nbsp;" . $row['dependents'] . "</td></tr>";
		   echo "<tr><td colspan=\"4\">&nbsp;</td></tr>";
		   echo "<tr class=\"alterrow\"><td colspan=\"4\">Optional Policy Loan :</td></tr>";
		   echo "<tr><td class=\"paragraph\">OPL No. 1 :</td><td>&nbsp;" . $row['oplNo1'] . "</td>";
		   echo "<td class=\"paragraph\">OPL No. 2 :</td><td>&nbsp;" . $row['oplNo2'] . "</td></tr>";
		   echo "<tr><td colspan=\"3\" class=\"paragraph\">OPL No. 3 :</td>";
		   echo "<td> &nbsp;" . $row['oplNo3'] . "</td></tr>";
		   echo "<tr><td colspan=\"4\">&nbsp;</td></tr>";
		   echo "<tr class=\"alterrow\"><td colspan=\"4\">Step Increment :</td></tr>";
		   echo "<tr><td class=\"paragraph\">Step Number :</td><td> &nbsp;" . $row['stepNumber'] . "</td>";
		   echo "<td class=\"paragraph\">Salary Increase : </td><td>&nbsp;" . $row['salaryIncrease'] . "</td></tr>";
		   echo "<tr><td class=\"paragraph\">Date Increment : </td><td>&nbsp;" . $row['dateIncrement'] . "</td>";
		   echo "<td class=\"paragraph\">Position Change : </td><td>&nbsp;" . $row['effectiveStepPosition'] . "</td></tr>";
           echo "<tr><td colspan=\"4\">&nbsp;</td></tr>";
		   echo "<tr class=\"td\">";
		 }	
	} 
*/

}	//  end class
?>