<?php 
/* 
File Name: Emppositiondetails.php (class folder)
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
class Position extends General
{

	function position() 
   	{
      include("../hrmis/class/Connect.php");   //the dbase connection
   	}
   	
	function editPosition($txtSearch, $optField, $p, $t_strEmpNumber, $t_strAppointmentCode, $t_strServiceCode, $t_strSectionCode, $t_strPositionCode, $t_strDivisionCode, $t_strTaxStatCode, $t_strItemNumber, $t_strFirstDayAgency, $t_intStep, $t_strFirstDayGov, $t_strPersonnelAction, $t_strEmploymentBasis, $t_strCategoryService, $t_strNatureOfWork, $t_strHPFactor, $t_strPayrollSwitch, $t_strDTRSwitch, $t_intDependents, $t_strHealthProvider, $t_strEffectiveMonth, $t_strEffectiveDay, $t_strEffectiveYear, $t_strPositionMonth, $t_strPositionDay, $t_strPositionYear, $t_strLongevityMonth, $t_strLongevityDay, $t_strLongevityYear, $t_intActualSalary, $t_strContractEndMonth, $t_strContractEndDay, $t_strContractEndYear, $Submit, $t_strOldEmpNumber, $t_strOldAppointmentCode, $t_strOldServiceCode, $t_strOldSectionCode, $t_strOldPositionCode, $t_strOldDivisionCode, $t_strOldTaxStatus, $t_strOldItemNumber, $t_intOldStep, $t_strOldPersonnelAction, $t_strOldEffectiveMonth, $t_strOldEffectiveDay, $t_strOldEffectiveYear, $t_strOldPositionMonth, $t_strOldPositionDay, $t_strOldPositionYear, $t_strOldLongevityMonth, $t_strOldLongevityDay, $t_strOldLongevityYear, $t_intOldActualSalary, $t_strOldContractEndMonth, $t_strOldContractEndDay, $t_strOldContractEndYear)   //Load editEmployees position
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
			 $t_strServiceCode=$row["serviceCode"];
			 $t_strSectionCode=$row["sectionCode"];
			 $t_strPositionCode=$row["positionCode"];
			 $t_strDivisionCode=$row["divisionCode"];
			 $t_strTaxStatCode=$row["taxStatCode"];
			 $t_strItemNumber=$row["itemNumber"];
			 $t_strFirstDayAgency=$row["firstDayAgency"];
			 $t_intStep=$row["step"];			 
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
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == "Submit"){ 
	 	$t_strEffectiveDate = $this->combineDate($t_strEffectiveYear, $t_strEffectiveMonth, $t_strEffectiveDay);
		$t_strPositionDate = $this->combineDate($t_strPositionYear, $t_strPositionMonth, $t_strPositionDay);
		$t_strLongevityDate = $this->combineDate($t_strLongevityYear, $t_strLongevityMonth, $t_strLongevityDay);
		$t_strContractEndDate = $this->combineDate($t_strContractEndYear, $t_strContractEndMonth, $t_strContractEndDay);			 
			 $updateResults = "UPDATE tblEmpPosition SET empNumber='$t_strEmpNumber', appointmentCode='$t_strAppointmentCode', serviceCode='$t_strServiceCode', sectionCode='$t_strSectionCode', positionCode='$t_strPositionCode', divisionCode='$t_strDivisionCode', taxStatCode='$t_strTaxStatCode', itemNumber='$t_strItemNumber', firstDayAgency='$t_strFirstDayAgency', step='$t_intStep', firstDayGov='$t_strFirstDayGov', personnelAction='$t_strPersonnelAction', employmentBasis='$t_strEmploymentBasis', categoryService='$t_strCategoryService', dependents='$t_intDependents', healthProvider='$t_strHealthProvider', nature='$t_strNatureOfWork', hpFactor='$t_strHPFactor', payrollSwitch='$t_strPayrollSwitch', dtrSwitch='$t_strDTRSwitch', effectiveDate='$t_strEffectiveDate', positionDate='$t_strPositionDate', longevityDate='$t_strLongevityDate', actualSalary='$t_intActualSalary', contractEndDate='$t_strContractEndDate' WHERE empNumber='$t_strOldEmpNumber'";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Employee Personal Data not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return 1; 
			 } 
	} 
}
	
	function viewPosition($txtSearch, $optField, $p, $t_strAppointmentCode, $t_strServiceCode, $t_strSectionCode, $t_strPositionCode, $t_strDivisionCode, $t_strTaxStatCode, $t_strItemNumber, $t_strFirstDayAgency, $t_intStep, $t_strFirstDayGov, $t_strPersonnelAction, $t_strEmploymentBasis, $t_strCategoryService, $t_strNatureOfWork, $t_strHPFactor, $t_strPayrollSwitch, $t_strDTRSwitch, $t_intDependents, $t_strHealthProvider, $t_strEffectiveDate, $t_strPositionDate, $t_strLongevityDate, $t_intActualSalary, $t_strContractEndDate, $t_strEmpNumber)   //view employee position
    {
	     $viewResults = mysql_query("SELECT * FROM tblEmpPosition WHERE empNumber='$t_strEmpNumber'");
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
			 $t_intStep=$row["step"];			 
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
			echo "<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
            echo "<tr><td class=\"header\"><div align=\"justify\"></div></td></tr>";
            echo "<tr><td height=\"132\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
            echo "<tr><td width=\"21%\" class=\"paragraph\">Appointment Code :</td><td width=\"27%\" class=\"row\">" . $row['appointmentCode'] . "</td>";
			echo "<td width=\"22%\" class=\"paragraph\">Service Code :</td><td width=\"30%\" class=\"row\">" . $row['serviceCode'] . "</td></tr>";
            echo "<tr><td class=\"paragraph\">Section Code :</td><td class=\"row\">" . $row['sectionCode'] . "</td><td class=\"paragraph\">Position Code :</td><td class=\"row\">" . $row['positionCode'] . "</td>";
            echo "</tr><tr><td class=\"paragraph\">Division Code :</td><td class=\"row\">" . $row['divisionCode'] . "</td>";
			echo "<td class=\"paragraph\">Tax Status :</td><td class=\"row\">" . $row['taxStatCode'] . "</td></tr>";
			echo "<tr><td class=\"paragraph\">Item Number :</td><td class=\"row\">" . $row['itemNumber'] . "</td>";
			echo "<td class=\"paragraph\">First Day Agency :</td><td class=\"row\">" . $row['firstDayAgency'] . "</td></tr>";
            echo "<tr><td class=\"paragraph\">Step Number :</td><td class=\"row\">" . $row['step'] . "</td>";
			echo "<td class=\"paragraph\">First Day Government :</td><td class=\"row\">" . $row['firstDayGov'] . "</td></tr>";
            echo "<tr><td class=\"paragraph\">Personnel Action :</td><td class=\"row\">" . $row['personnelAction'] . "</td>";
			echo "<td class=\"paragraph\">Employment Basis :</td><td class=\"row\">" . $row['employmentBasis'] . "</td></tr>";
            echo "<tr><td class=\"paragraph\">CategoryService :</td><td class=\"row\">" . $row['categoryService'] . "</td>";
			echo "<td class=\"paragraph\">Nature of Work :</td> <td class=\"row\">" . $row['nature'] . "</td></tr>";
            echo "<tr><td class=\"paragraph\">HP Factor :</td><td class=\"row\">" . $row['hpFactor'] . "</td><td class=\"paragraph\">Payroll Switch :</td><td class=\"row\">" . $row['payrollSwitch'] . "</td></tr>";
            echo "<tr><td class=\"paragraph\">DTR Switch :</td><td class=\"row\">" . $row['dtrSwitch'] . "</td><td class=\"paragraph\">No. of Dependents :</td><td class=\"row\">" . $row['dependents'] . "</td></tr>";
            echo "<tr><td class=\"paragraph\">With Health Provider :</td><td class=\"row\">" . $row['healthProvider'] . "</td><td class=\"paragraph\">Effectivity Date :</td><td class=\"row\">" . $row['effectiveDate'] . "</td></tr>";
            echo "<tr><td class=\"paragraph\">Position Date :</td><td class=\"row\">" . $row['positionDate'] . "</td><td class=\"paragraph\">Longevity Date :</td><td class=\"row\">" . $row['longevityDate'] . "</td></tr>";
            echo "<tr><td class=\"paragraph\">Actual Salary : </td><td class=\"row\">" . $row['actualSalary'] . "</td><td class=\"paragraph\">Contract End Date :</td><td class=\"row\">" . $row['contractEndDate'] . "</td></tr>";
            echo "<tr><td class=\"paragraph\">&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;";
			echo "</td></tr></table>";
            //echo "<div align=\"center\"><a href=\"Positiondetails.php?txtSearch=$txtSearch&optField=$optField&p=$p&t_strAppointmentCode=$t_strAppointmentCode&t_strServiceCode=$t_strServiceCode&t_strSectionCode=$t_strSectionCode&t_strPositionCode=$t_strPositionCode&t_strDivisionCode=$t_strDivisionCode&t_strTaxStatCode=$t_strTaxStatCode&t_strItemNumber=$t_strItemNumber&t_strFirstDayAgency=$t_strFirstDayAgency&t_intStep=$t_intStep&t_strFirstDayGov=$t_strFirstDayGov&t_strPersonnelAction=$t_strPersonnelAction&t_strEmploymentBasis=$t_strEmploymentBasis&t_strCategoryService=$t_strCategoryService&t_strNatureOfWork=$t_strNatureOfWork&t_strHPFactor=$t_strHPFactor&t_strPayrollSwitch=$t_strPayrollSwitch&t_strDTRSwitch=$t_strDTRSwitch&t_intDependents=$t_intDependents&t_strHealthProvider=$t_strHealthProvider&t_strEffectiveDate=$t_strEffectiveDate&t_strPositionDate=$t_strPositionDate&t_strLongevityDate=$t_strLongevityDate&t_strContractEndDate=$t_strContractEndDate&t_intActualSalary=$t_intActualSalary&t_strEmpNumber=$t_strEmpNumber&Submit=EDIT\">EDIT</a>&nbsp;</div>";
           echo "</td></tr></table>";
		 }	
	} 
	
}
?>