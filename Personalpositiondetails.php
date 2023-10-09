<?php 
/* 
File Name: Personalpositiondetails.php
----------------------------------------------------------------------
Purpose of this file: 
To add employees information to database.
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
session_start();
include("../hrmis/class/Security.php");
include("../hrmis/class/Personalpositiondetails.php");
$objPosition= new position;
$objPosition->setvar(array('strEmpNmbr'=>$strEmpNmbr, 'txtSearch'=>$txtSearch, 'optField'=>$optField, 'cboMonth'=>date("n"), 'cboYear'=>date("Y"), 'strLetter'=>$strLetter)); //for maintain state
$objPosition->trapButton($txtSearch, $strLetter, "Personalsearch.php", "Personalinformation.php");
$arrEmpPersonal = $objPosition->checkGetEmpNmbr("201", $txtSearch, $optField, date("n"), date("Y"), 1, $p, $strLetter);
$objPosition->editPosition($strEmpNmbr, $txtSearch, $optField, $p, $strLetter, $t_strAppointmentCode, $t_strStatusOfAppointment, $t_strServiceCode, $t_strSectionCode, $t_strPositionCode, $t_strDivisionCode, $t_strTaxStatCode, $t_strItemNumber, $t_intAuthorizeSalary, $t_strFirstDayAgencyMonth, $t_strFirstDayAgencyDay, $t_strFirstDayAgencyYear, $t_intStepNumber, $t_strFirstDayGovMonth, $t_strFirstDayGovDay, $t_strFirstDayGovYear, $t_strPlaceOfAssignment, $t_strAttendanceSchemeCode, $t_strPersonnelAction, $t_strEmploymentBasis, $t_strCategoryService, $t_strNatureOfWork, $t_strHPFactor, $t_strPayrollSwitch, $t_strDTRSwitch, $t_intDependents, $t_strHealthProvider, $t_strEffectiveMonth, $t_strEffectiveDay, $t_strEffectiveYear, $t_strPositionMonth, $t_strPositionDay, $t_strPositionYear, $t_strLongevityMonth, $t_strLongevityDay, $t_strLongevityYear, $t_intLongevityGap, $t_intActualSalary, $t_strContractEndMonth, $t_strContractEndDay, $t_strContractEndYear, $t_strOplNumber1, $t_strOplNumber2, $t_strOplNumber3, $t_intSalaryGradeNumber, $t_strEffectiveDateIncMonth, $t_strEffectiveDateIncDay, $t_strEffectiveDateIncYear, $t_strEmpNumber, $Submit, $t_strOldAppointmentCode);   //Load editEmployees position
?>
<html><!-- InstanceBegin template="/Templates/Personaltmplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Human Resource Management Information System - HR Section</title><?
include("../hrmis/class/JSgeneral.php");
?>
<script language="JavaScript">
function filterNum(str) 
{
	re = /^\$|P|,/g;
	// remove "$" and ","
	return str.replace(re, "");
}

function openPrint()
{
	var strMonth = "<? echo $cboMonth ?>";
	var strYear = "<? echo $cboYear ?>";
	var strEmpNmbr = "<? echo $arrEmpPersonal['empNumber']?>";
	var strPage = "PrintPosition.php?strEmpNmbr="+strEmpNmbr+"&strMonth="+strMonth+"&strYear="+strYear;
	window.open(strPage, '_blank','toolbar=no,location=no,directories=no,status=0,menubar=0,scrollbars=1,resizable=0,width=630,height=500');
}

function validateCharacter(field) 
{
	var valid = "ABCDEFGHIJKLMNOPQRSTUVWXYZ'+ +'abcdefghijklmnopqrstuvwxyz-"
	var ok = "yes";
	var temp;
	for (var i=0; i<field.value.length; i++) {
	temp = "" + field.value.substring(i, i+1);
	if (valid.indexOf(temp) == "-1") ok = "no";
	}
	if (ok == "no") {
	alert("Invalid entry!  Only characters are accepted!");
	field.focus();
	field.select();
    }
}

function validateNumbers(field) 
{
	var valid = "0123456789'+-+'"
	var ok = "yes";
	var temp;
	for (var i=0; i<field.value.length; i++) {
	temp = "" + field.value.substring(i, i+1);
	if (valid.indexOf(temp) == "-1") ok = "no";
	}
	if (ok == "no") {
	alert("Invalid entry!  Only numbers are accepted!");
	field.focus();
	field.select();
    }
}

function validateOplNumber(field) 
{
	var valid = "ABCDEFGHIJKLMNOPQRSTUVWXYZ'+ +'abcdefghijklmnopqrstuvwxyz0123456789'+-+'"
	var ok = "yes";
	var temp;
	for (var i=0; i<field.value.length; i++) {
	temp = "" + field.value.substring(i, i+1);
	if (valid.indexOf(temp) == "-1") ok = "no";
	}
	if (ok == "no") {
	alert("Invalid entry!  Only characters, numbers and dash are accepted!");
	field.focus();
	field.select();
    }
}

function validateNumbersAndDigits(field) 
{
	var valid = "0123456789'+.+'"
	var ok = "yes";
	var temp;
	for (var i=0; i<field.value.length; i++) {
	temp = "" + field.value.substring(i, i+1);
	if (valid.indexOf(temp) == "-1") ok = "no";
	}
	if (ok == "no") {
	alert("Invalid entry!  Only numbers and period/point are accepted!");
	field.focus();
	field.select();
    }
}

function separationCauseRequirement()
{	
	// for combo appointment code
	var strEmpNmbr = "<? echo $strEmpNmbr; ?>";
	var txtSearch = "<? echo $txtSearch; ?>";
	var optField = "<? echo $optField; ?>";
	var t_strAppointmentCode = "<? echo $t_strAppointmentCode ?>";
	var t_strFirstDayGov = "<? echo $t_strFirstDayGov; ?>";
	var t_strServiceCode = "<? echo $t_strServiceCode ?>";
	var t_strSectionCode = "<? echo $t_strSectionCode ?>";
	var t_strPositionCode = "<? echo $t_strPositionCode ?>";
	var t_strDivisionCode = "<? echo $t_strDivisionCode ?>";
	var t_strTaxStatCode = "<? echo $t_strTaxStatCode ?>";
	var t_strItemNumber = "<? echo $t_strItemNumber ?>";
	var t_intAuthorizeSalary = "<? echo $t_intAuthorizeSalary ?>";
	var t_strFirstDayAgency = "<? echo $t_strFirstDayAgency ?>";
	var t_intStepNumber= "<? echo $t_intStepNumber ?>";
	var t_strPlaceOfAssignment = "<? echo $t_strPlaceOfAssignment ?>";
	var t_strPersonnelAction = "<? echo $t_strPersonnelAction ?>";
	var t_strEmploymentBasis = "<? echo $t_strEmploymentBasis ?>";
	var t_strCategoryService = "<? echo $t_strCategoryService ?>";
	var t_strNatureOfWork = "<? echo $t_strNatureOfWork ?>";
	var t_strHPFactor = "<? echo $t_strHPFactor ?>";
	var t_strPayrollSwitch = "<? echo $t_strPayrollSwitch ?>"
	var t_strDTRSwitch = "<? echo $t_strDTRSwitch ?>";
	var t_intDependents = "<? echo $t_intDependents ?>";
	var t_strHealthProvider = "<? echo $t_strHealthProvider ?>";
	var t_strEffectiveDate = "<? echo $t_strEffectiveDate ?>";
	var t_strPositionDate = "<? echo $t_strPositionDate ?>";
	var t_strLongevityDate = "<? echo $t_strLongevityDate ?>";
	var t_intLongevityGap = "<? echo $t_intLongevityGap ?>";
	var t_strStatusOfAppointment = document.frmPositionDetails.t_strStatusOfAppointment.value;
	var t_strContractEndDate = document.frmPositionDetails.t_strContractEndDate.value;
	var t_intActualSalary = "<? echo $t_intActualSalary ?>";
	var t_strOplNumber1 = "<? echo $t_strOplNumber1 ?>";
	var t_strOplNumber2 = "<? echo $t_strOplNumber2 ?>";
	var t_strOplNumber3 = "<? echo $t_strOplNumber3 ?>";
	var t_intSalaryGradeNumber = "<? echo $t_intSalaryGradeNumber ?>";
	var t_strEffectiveDateIncrement = "<? echo $t_strEffectiveDateIncrement ?>";
	var t_strEmpNumber = document.frmPositionDetails.t_strEmpNumber.value;
	var strSubmit = "<? echo $Submit ?>";

	window.location = "Personalpositiondetails.php?strEmpNmbr="+strEmpNmbr+"&txtSearch="+txtSearch+"&optField="+optField+"&t_strAppointmentCode="+t_strAppointmentCode+"&t_strStatusOfAppointment="+t_strStatusOfAppointment+"&t_strServiceCode="+t_strServiceCode+"&t_strSectionCode="+t_strSectionCode+"&t_strPositionCode="+t_strPositionCode+"&t_strDivisionCode="+t_strDivisionCode+"&t_strTaxStatCode="+t_strTaxStatCode+"&t_strItemNumber="+t_strItemNumber+"&t_intAuthorizeSalary="+t_intAuthorizeSalary+"&t_strFirstDayAgency="+t_strFirstDayAgency+"&t_intStepNumber="+t_intStepNumber+"&t_strFirstDayGov="+t_strFirstDayGov+"&t_strPlaceOfAssignment="+t_strPlaceOfAssignment+"&t_strPersonnelAction="+t_strPersonnelAction+"&t_strEmploymentBasis="+t_strEmploymentBasis+"&t_strCategoryService="+t_strCategoryService+"&t_strNatureOfWork="+t_strNatureOfWork+"&t_strHPFactor="+t_strHPFactor+"&t_strPayrollSwitch="+t_strPayrollSwitch+"&t_strDTRSwitch="+t_strDTRSwitch+"&t_intDependents="+t_intDependents+"&t_strHealthProvider="+t_strHealthProvider+"&t_strEffectiveDate="+t_strEffectiveDate+"&t_strPositionDate="+t_strPositionDate+"&t_strLongevityDate="+t_strLongevityDate+"&t_intLongevityGap="+t_intLongevityGap+"&t_strContractEndDate="+t_strContractEndDate+"&t_intActualSalary="+t_intActualSalary+"&t_strOplNumber1="+t_strOplNumber1+"&t_strOplNumber2="+t_strOplNumber2+"&t_strOplNumber3="+t_strOplNumber3+"&t_intSalaryGradeNumber="+t_intSalaryGradeNumber+"&t_strEffectiveDateIncrement="+t_strEffectiveDateIncrement+"&t_strEmpNumber="+t_strEmpNumber+"&Submit="+strSubmit;
	
}

function appointmentCodeRequirement()
{	
	// for combo appointment code
	var strEmpNmbr = "<? echo $strEmpNmbr; ?>";
	var txtSearch = "<? echo $txtSearch; ?>";
	var optField = "<? echo $optField; ?>";
	var t_strAppointmentCode = document.all.t_strAppointmentCode.value;
	var t_strStatusOfAppointment = "<? echo $t_strStatusOfAppointment ?>";
	var t_strServiceCode = "<? echo $t_strServiceCode ?>";
	var t_strSectionCode = "<? echo $t_strSectionCode ?>";
	var t_strPositionCode = document.all.t_strPositionCode.value;
	var t_strDivisionCode = "<? echo $t_strDivisionCode ?>";
	var t_strTaxStatCode = "<? echo $t_strTaxStatCode ?>";
	var t_strItemNumber = "<? echo $t_strItemNumber ?>";
	var t_intAuthorizeSalary = "<? echo $t_intAuthorizeSalary ?>";
	var t_strFirstDayGov = "<? echo $t_strFirstDayGov; ?>";
	var t_strFirstDayAgency = "<? echo $t_strFirstDayAgency ?>";
	var t_intStepNumber= "<? echo $t_intStepNumber ?>";
	var t_strPlaceOfAssignment = "<? echo $t_strPlaceOfAssignment ?>";
	var t_strPersonnelAction = "<? echo $t_strPersonnelAction ?>";
	var t_strEmploymentBasis = "<? echo $t_strEmploymentBasis ?>";
	var t_strCategoryService = "<? echo $t_strCategoryService ?>";
	var t_strNatureOfWork = "<? echo $t_strNatureOfWork ?>";
	var t_strHPFactor = "<? echo $t_strHPFactor ?>";
	var t_strPayrollSwitch = "<? echo $t_strPayrollSwitch ?>"
	var t_strDTRSwitch = "<? echo $t_strDTRSwitch ?>";
	var t_intDependents = "<? echo $t_intDependents ?>";
	var t_strHealthProvider = "<? echo $t_strHealthProvider ?>";
	var t_strEffectiveDate = "<? echo $t_strEffectiveDate ?>";
	var t_strPositionDate = "<? echo $t_strPositionDate ?>";
	var t_strLongevityDate = "<? echo $t_strLongevityDate ?>";
	var t_intLongevityGap = "<? echo $t_intLongevityGap ?>";
	var t_strContractEndDate = "<? echo $t_strContractEndDate ?>";
	var t_intActualSalary = "<? echo $t_intActualSalary ?>";
	var t_strOplNumber1 = "<? echo $t_strOplNumber1 ?>";
	var t_strOplNumber2 = "<? echo $t_strOplNumber2 ?>";
	var t_strOplNumber3 = "<? echo $t_strOplNumber3 ?>";
	var t_intSalaryGradeNumber = "<? echo $t_intSalaryGradeNumber ?>";
	var t_strEffectiveDateIncrement = "<? echo $t_strEffectiveDateIncrement ?>";
	var t_strEmpNumber = document.all.t_strEmpNumber.value;
	var strSubmit = "<? echo $Submit ?>";

	window.location = "Personalpositiondetails.php?strEmpNmbr="+strEmpNmbr+"&txtSearch="+txtSearch+"&optField="+optField+"&t_strAppointmentCode="+t_strAppointmentCode+"&t_strStatusOfAppointment="+t_strStatusOfAppointment+"&t_strServiceCode="+t_strServiceCode+"&t_strSectionCode="+t_strSectionCode+"&t_strPositionCode="+t_strPositionCode+"&t_strDivisionCode="+t_strDivisionCode+"&t_strTaxStatCode="+t_strTaxStatCode+"&t_strItemNumber="+t_strItemNumber+"&t_intAuthorizeSalary="+t_intAuthorizeSalary+"&t_strFirstDayAgency="+t_strFirstDayAgency+"&t_intStepNumber="+t_intStepNumber+"&t_strFirstDayGov="+t_strFirstDayGov+"&t_strPlaceOfAssignment="+t_strPlaceOfAssignment+"&t_strPersonnelAction="+t_strPersonnelAction+"&t_strEmploymentBasis="+t_strEmploymentBasis+"&t_strCategoryService="+t_strCategoryService+"&t_strNatureOfWork="+t_strNatureOfWork+"&t_strHPFactor="+t_strHPFactor+"&t_strPayrollSwitch="+t_strPayrollSwitch+"&t_strDTRSwitch="+t_strDTRSwitch+"&t_intDependents="+t_intDependents+"&t_strHealthProvider="+t_strHealthProvider+"&t_strEffectiveDate="+t_strEffectiveDate+"&t_strPositionDate="+t_strPositionDate+"&t_strLongevityDate="+t_strLongevityDate+"&t_intLongevityGap="+t_intLongevityGap+"&t_strContractEndDate="+t_strContractEndDate+"&t_intActualSalary="+t_intActualSalary+"&t_strOplNumber1="+t_strOplNumber1+"&t_strOplNumber2="+t_strOplNumber2+"&t_strOplNumber3="+t_strOplNumber3+"&t_intSalaryGradeNumber="+t_intSalaryGradeNumber+"&t_strEffectiveDateIncrement="+t_strEffectiveDateIncrement+"&t_strEmpNumber="+t_strEmpNumber+"&Submit="+strSubmit;
	
}

function itemNumberRequirement()
{	
	// for combo item number
	var strEmpNmbr = "<? echo $strEmpNmbr; ?>";
	var txtSearch = "<? echo $txtSearch; ?>";
	var optField = "<? echo $optField; ?>";
	var t_strAppointmentCode = "<? echo $t_strAppointmentCode ?>";
	var t_strStatusOfAppointment = "<? echo $t_strStatusOfAppointment ?>";
	var t_strServiceCode = "<? echo $t_strServiceCode ?>";
	var t_strSectionCode = "<? echo $t_strSectionCode ?>";
	var t_strPositionCode = document.frmPositionDetails.t_strPositionCode.value;
	var t_strDivisionCode = "<? echo $t_strDivisionCode ?>";
	var t_strTaxStatCode = "<? echo $t_strTaxStatCode ?>";
	var t_strItemNumber = "<? echo $t_strItemNumber ?>";
	var t_intAuthorizeSalary = document.frmPositionDetails.t_intAuthorizeSalary.value;
	var t_strFirstDayAgency = "<? echo $t_strFirstDayAgency ?>";
	var t_intStepNumber= document.frmPositionDetails.t_intStepNumber.value;
	var t_strFirstDayGov = "<? echo $t_strFirstDayGov ?>";
	var t_strPlaceOfAssignment = "<? echo $t_strPlaceOfAssignment ?>";
	var t_strPersonnelAction = "<? echo $t_strPersonnelAction ?>";
	var t_strEmploymentBasis = "<? echo $t_strEmploymentBasis ?>";
	var t_strCategoryService = "<? echo $t_strCategoryService ?>";
	var t_strNatureOfWork = "<? echo $t_strNatureOfWork ?>";
	var t_strHPFactor = "<? echo $t_strHPFactor ?>";
	var t_strPayrollSwitch = "<? echo $t_strPayrollSwitch ?>"
	var t_strDTRSwitch = "<? echo $t_strDTRSwitch ?>";
	var t_intDependents = "<? echo $t_intDependents ?>";
	var t_strHealthProvider = "<? echo $t_strHealthProvider ?>";
	var t_strEffectiveDate = "<? echo $t_strEffectiveDate ?>";
	var t_strPositionDate = "<? echo $t_strPositionDate ?>";
	var t_strLongevityDate = "<? echo $t_strLongevityDate ?>";
	var t_intLongevityGap = "<? echo $t_intLongevityGap ?>";
	var t_strContractEndDate = "<? echo $t_strContractEndDate ?>";
	var t_intActualSalary = "<? echo $t_intActualSalary ?>";
	var t_strOplNumber1 = "<? echo $t_strOplNumber1 ?>";
	var t_strOplNumber2 = "<? echo $t_strOplNumber2 ?>";
	var t_strOplNumber3 = "<? echo $t_strOplNumber3 ?>";
	var t_intSalaryGradeNumber = document.frmPositionDetails.t_intSalaryGradeNumber.value;
	var t_strEffectiveDateIncrement = "<? echo $t_strEffectiveDateIncrement ?>";
	var t_strEmpNumber = document.frmPositionDetails.t_strEmpNumber.value;
	var strSubmit = "<? echo $Submit ?>";
	
	var t_strItemNumber = document.frmPositionDetails.t_strItemNumber.value;

	window.location = "Personalpositiondetails.php?strEmpNmbr="+strEmpNmbr+"&txtSearch="+txtSearch+"&optField="+optField+"&t_strAppointmentCode="+t_strAppointmentCode+"&t_strStatusOfAppointment="+t_strStatusOfAppointment+"&t_strServiceCode="+t_strServiceCode+"&t_strSectionCode="+t_strSectionCode+"&t_strPositionCode="+t_strPositionCode+"&t_strDivisionCode="+t_strDivisionCode+"&t_strTaxStatCode="+t_strTaxStatCode+"&t_strItemNumber="+t_strItemNumber+"&t_intAuthorizeSalary="+t_intAuthorizeSalary+"&t_strFirstDayAgency="+t_strFirstDayAgency+"&t_intStepNumber="+t_intStepNumber+"&t_strFirstDayGov="+t_strFirstDayGov+"&t_strPlaceOfAssignment="+t_strPlaceOfAssignment+"&t_strPersonnelAction="+t_strPersonnelAction+"&t_strEmploymentBasis="+t_strEmploymentBasis+"&t_strCategoryService="+t_strCategoryService+"&t_strNatureOfWork="+t_strNatureOfWork+"&t_strHPFactor="+t_strHPFactor+"&t_strPayrollSwitch="+t_strPayrollSwitch+"&t_strDTRSwitch="+t_strDTRSwitch+"&t_intDependents="+t_intDependents+"&t_strHealthProvider="+t_strHealthProvider+"&t_strEffectiveDate="+t_strEffectiveDate+"&t_strPositionDate="+t_strPositionDate+"&t_strLongevityDate="+t_strLongevityDate+"&t_intLongevityGap="+t_intLongevityGap+"&t_strContractEndDate="+t_strContractEndDate+"&t_intActualSalary="+t_intActualSalary+"&t_strOplNumber1="+t_strOplNumber1+"&t_strOplNumber2="+t_strOplNumber2+"&t_strOplNumber3="+t_strOplNumber3+"&t_intSalaryGradeNumber="+t_intSalaryGradeNumber+"&t_strEffectiveDateIncrement="+t_strEffectiveDateIncrement+"&t_strEmpNumber="+t_strEmpNumber+"&Submit="+strSubmit;
	
	function MM_change() 
	{
		var strEmpNmbr = "<? echo $strEmpNmbr ?>";
		var t_strEmpNumber = document.frmPositionDetails.t_strEmpNumber.value
		var t_strItemNumber = document.frmPositionDetails.t_strItemNumber.value
		//var cboYear = document.myDUpdate.cboYear.value
		var t_strPositionCode = "<? $t_strPositionCode ?>";
		//var deductionCode=document.myDUpdate.deductionCode.value;
		
		window.location = "Personalpositiondetails.php?strEmpNmbr="+strEmpNmbr+"&t_strEmpNumber="+t_strEmpNumber+"&t_strItemNumber="+t_strItemNumber;
		
	}

}

</script>

<!-- InstanceEndEditable --> 
<!-- Design/Images Made By : Angelo Campos Evangelista  -->
<!-- Template Made By : Pearliezl Samoy Dy Tioco  -->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript" type="text/JavaScript">
<!-- onMouseOver="statusBar(); return true;" onClick="statusBar();" onMouseUp="statusBar()" onFocus="statusBar()"

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<link href="hrmis.css" rel="stylesheet" type="text/css">
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('images/education2.jpg','images/trainings2.jpg','images/examinations2.jpg','images/position2.jpg','images/logout2.jpg','images/family-background2.jpg','images/work-experience2.jpg','images/voluntary-work2.jpg','images/personal-information2.jpg','images/other-information2.jpg','images/notificationover.jpg','images/201click.jpg','images/attendanceover.jpg','images/reportsover.jpg','images/librariesover.jpg','images/compensationover.jpg','images/dutiesandresponsibilities2.jpg','images/editmodifyemployeenumber2.jpg'); history.forward()" onContextMenu="return false"><div align="center"> 
<table width="778" border="0" cellpadding="0" cellspacing="0" id="OUTERTBL">
  <tr> 
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" id="tblHRMODULE">
        <tr> 
          <td valign="bottom"><table width="100%" border="0" cellpadding="0" cellspacing="0" id="tblModule">
              <tr> 
                <td><img src="images/hrmodule.jpg" width="170" height="23"></td>
              </tr>
            </table></td>
          <td valign="bottom"><table width="100%" border="0" cellpadding="0" cellspacing="0" id="tblSECTION1">
              <tr> 
                <td valign="bottom"><table border="0" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td>&nbsp;</td>
                    </tr>
                  </table>
                  <?   //  HR module for 201 templates
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber = '$strEmpNmbr' ");
$row = mysql_fetch_array($objHRResult); 
$t_strUserLevel = $row['userLevel'];
$t_strUserPermission = $row['userPermission'];
$t_strAccessPermission = $row['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Officer" && $t_strAccessPermission == 123456) 
{
?>
                  <table width="78%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblNOTIFICATION">
                    <tr> 
                      <td><a href="Notification.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('NOTIFICATION1','','images/notificationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/notification.jpg" alt="NOTIFICATION1" name="NOTIFICATION1" width="96" height="29" border="0"></a></td>
                      <td><a href="Personal201default.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('PROFILE1','','images/201click.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/201click.jpg" alt="PROFILE1" name="PROFILE1" width="67" height="29" border="0"></a></td>
                      <td><a href="Searchattendance.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('ATTENDANCE1','','images/attendanceover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/attendance.jpg" alt="ATTENDANCE1" name="ATTENDANCE1" width="88" height="29" border="0"></a></td>
                      <td><a href="Report.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('REPORTS1','','images/reportsover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/reports.jpg" alt="REPORTS1" name="REPORTS1" width="60" height="29" border="0"></a></td>
                      <td><a href="Holiday.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('LIBRARIES1','','images/librariesover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/libraries.jpg" alt="LIBRARIES1" name="LIBRARIES1" width="67" height="29" border="0"></a></td>
                      <td><a href="Personnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('COMPENSATION1','','images/compensationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/compensation.jpg" alt="COMPENSATION1" name="COMPENSATION1" width="104" height="29" border="0"></a></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
              </tr>
              <tr> 
                <td valign="bottom"> 
                  <?   //  HR module for 201 templates
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber = '$strEmpNmbr' ");
$row = mysql_fetch_array($objHRResult); 
$t_strUserLevel = $row['userLevel'];
$t_strUserPermission = $row['userPermission'];
$t_strAccessPermission = $row['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 12) 
{
?>
                  <table width="25%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblNotificationProfile">
                    <tr> 
                      <td><a href="Notification.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>%20" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('NOTIFICATION2','','images/notificationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/notification.jpg" alt="NOTIFICATION2" name="NOTIFICATION2" width="96" height="29" border="0"></a></td>
                      <td width="55%"><a href="Personal201default.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission;?>%20" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('PROFILE2','','images/201click.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/201click.jpg" alt="PROFILE2" name="PROFILE2" width="67" height="29" border="0"></a></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
              </tr>
              <tr> 
                <td valign="bottom"> 
                  <?   //  HR module for 201 templates
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber = '$strEmpNmbr' ");
$row = mysql_fetch_array($objHRResult); 
$t_strUserLevel = $row['userLevel'];
$t_strUserPermission = $row['userPermission'];
$t_strAccessPermission = $row['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 23) 
{
?>
                  <table width="25%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblPROFILEATTENDANCE">
                    <tr> 
                      <td><a href="Personal201default.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('PROFILE3','','images/201click.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/201click.jpg" alt="PROFILE3" name="PROFILE3" width="67" height="29" border="0"></a></td>
                      <td width="73%"><a href="Searchattendance.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('ATTENDANCE3','','images/attendanceover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/attendance.jpg" alt="ATTENDANCE3" name="ATTENDANCE3" width="88" height="29" border="0"></a></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
              </tr>
              <tr> 
                <td valign="bottom"> 
                  <?   //  HR module for 201 templates
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber = '$strEmpNmbr' ");
$row = mysql_fetch_array($objHRResult); 
$t_strUserLevel = $row['userLevel'];
$t_strUserPermission = $row['userPermission'];
$t_strAccessPermission = $row['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 24) 
{
?>
                  <table width="20%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblPROFILEREPORTS">
                    <tr> 
                      <td width="59%"><a href="Personal201default.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('PROFILE4','','images/201click.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/201click.jpg" alt="PROFILE4" name="PROFILE4" width="67" height="29" border="0"></a></td>
                      <td width="41%"><a href="Report.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('REPORTS4','','images/reportsover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/reports.jpg" alt="REPORTS4" name="REPORTS4" width="60" height="29" border="0"></a></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
              </tr>
              <tr> 
                <td valign="bottom"> 
                  <?   //  HR module for 201 templates
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber = '$strEmpNmbr' ");
$row = mysql_fetch_array($objHRResult); 
$t_strUserLevel = $row['userLevel'];
$t_strUserPermission = $row['userPermission'];
$t_strAccessPermission = $row['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 25) 
{
?>
                  <table width="20%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblPROFILELIBRARIES">
                    <tr> 
                      <td width="59%"><a href="Personal201default.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('PROFILE5','','images/201click.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/201click.jpg" alt="PROFILE5" name="PROFILE5" width="67" height="29" border="0"></a></td>
                      <td width="41%"><a href="Holiday.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('LIBRARIES5','','images/librariesover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/libraries.jpg" alt="LIBRARIES5" name="LIBRARIES5" width="67" height="29" border="0"></a></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
              </tr>
              <tr> 
                <td valign="bottom"> 
                  <?   //  HR module for 201 templates
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber = '$strEmpNmbr' ");
$row = mysql_fetch_array($objHRResult); 
$t_strUserLevel = $row['userLevel'];
$t_strUserPermission = $row['userPermission'];
$t_strAccessPermission = $row['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 26) 
{
?>
                  <table width="25%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblPROFILECOMPENSATION">
                    <tr> 
                      <td width="14%"><a href="Personal201default.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('PROFILE6','','images/201click.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/201click.jpg" alt="PROFILE6" name="PROFILE6" width="67" height="29" border="0"></a></td>
                      <td width="86%"><a href="Personnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('COMPENSATION6','','images/compensationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/compensation.jpg" alt="COMPENSATION6" name="COMPENSATION6" width="104" height="29" border="0"></a></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
              </tr>
              <tr>
                <td valign="bottom">
                  <?   //  HR module for 201 templates
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber = '$strEmpNmbr' ");
$row = mysql_fetch_array($objHRResult); 
$t_strUserLevel = $row['userLevel'];
$t_strUserPermission = $row['userPermission'];
$t_strAccessPermission = $row['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 2) 
{
?>
                  <table width="10%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblPROFILECOMPENSATION">
                    <tr> 
                      <td width="14%"><a href="Personal201default.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('PROFILE61','','images/201click.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/201click.jpg" alt="PROFILE6" name="PROFILE61" width="67" height="29" border="0" id="PROFILE61"></a></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
              </tr>
              <tr>
                <td valign="bottom">
                  <?   //  HR module for 201 templates
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber = '$strEmpNmbr' ");
$row = mysql_fetch_array($objHRResult); 
$t_strUserLevel = $row['userLevel'];
$t_strUserPermission = $row['userPermission'];
$t_strAccessPermission = $row['accessPermission'];
if ($t_strUserLevel == 12 && $t_strUserPermission == "HR&Cashier Officer" && $t_strAccessPermission == 1234567) 
{
?>
                  <table width="78%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblNOTIFICATIONCASHIER">
                    <tr> 
                      <td><a href="Notification.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('NOTIFICATION11','','images/notificationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/notification.jpg" alt="NOTIFICATION1" name="NOTIFICATION11" width="96" height="29" border="0" id="NOTIFICATION11"></a></td>
                      <td><a href="Personal201default.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('PROFILE11','','images/201click.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/201click.jpg" alt="PROFILE1" name="PROFILE11" width="67" height="29" border="0" id="PROFILE11"></a></td>
                      <td><a href="Searchattendance.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('ATTENDANCE11','','images/attendanceover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/attendance.jpg" alt="ATTENDANCE1" name="ATTENDANCE11" width="88" height="29" border="0" id="ATTENDANCE11"></a></td>
                      <td><a href="Report.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('REPORTS11','','images/reportsover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/reports.jpg" alt="REPORTS1" name="REPORTS11" width="60" height="29" border="0" id="REPORTS11"></a></td>
                      <td><a href="Holiday.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('LIBRARIES11','','images/librariesover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/libraries.jpg" alt="LIBRARIES1" name="LIBRARIES11" width="67" height="29" border="0" id="LIBRARIES11"></a></td>
                      <td><a href="CPersonnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('COMPENSATION11','','images/compensationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/compensation.jpg" alt="COMPENSATION1" name="COMPENSATION11" width="104" height="29" border="0" id="COMPENSATION11"></a></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
              </tr>
            </table></td>
        </tr>
        <tr bgcolor="#E9F3FE"> 
          <td height="8" colspan="2"><div align="center">Welcome <strong><? echo $_SESSION['strLoginName']; ?></strong>. 
              You are currently working at the HR Module.</div></td>
        </tr>
        <tr valign="top" bgcolor="#E9F3FE"> 
          <td height="8" colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="16%" height="348"><table width="150" height="348" border="0" cellpadding="0" cellspacing="0" bgcolor="#E9F3FE">
                    <tr> 
                      <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td><table width="90%" height="339" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#C1E2FF" id="NAVTBL">
                                <tr> 
                                  <td height="339" valign="top"> <form name="frm201" method="get" action="Personalinformation.php?strEmpNmbr=<? echo $strEmpNmbr;?>">
                                      <input name="txtSearch" type="text" size="15" maxlength="30" value="<? echo $txtSearch;?>">
                                      <a href="Personalinformation.php?strEmpNmbr=<? echo $strEmpNmbr?>" onMouseOut="statusBar()" onFocus="statusBar()" onMouseOver=" statusBar(); return true;" onClick="statusBar();"> 
                                      <input type="image" src="images/go.jpg" alt="Go" name="Go" width="19" height="17" border="0" align="absmiddle">
                                      </a> 
                                      <input name="strEmpNmbr" type="hidden" id="strEmpNmbr" value="<? echo $strEmpNmbr;?>">
                                      <br>
                                      <?
									  if($optField == "empNmbr" || $optField == "")
									  {
									  	echo "<input name='optField' type='radio' value='empNmbr' checked>";
									  }
									  else
									  {
									  	echo "<input name='optField' type='radio' value='empNmbr'>";
									  }
									  ?>
                                      Employee Number<br>
                                      <?
									  if($optField == "empName")
									  {
									  	echo "<input name='optField' type='radio' value='empName' checked>";
									  }
									  else
									  {
									  	echo "<input name='optField' type='radio' value='empName'>";
									  }
									  ?>
                                      Employee Name<br>
                                      <br>
                                      &nbsp;<br>
                                    </form>
                                    <?   //  HR module for 201 templates
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount WHERE empNumber = '$strEmpNmbr' ");
$row = mysql_fetch_array($objHRResult); 
$t_strUserLevel = $row['userLevel'];
$t_strUserPermission = $row['userPermission'];
$t_strAccessPermission = $row['accessPermission'];
if ($t_strUserLevel == 12 && $t_strUserPermission == "HR&Cashier Officer" && $t_strAccessPermission == 1234567) 
{
?>
                                    <table width="108" height="187" border="0" align="center" cellpadding="0" cellspacing="0" id="NAVTBL">
                                      <tr> 
                                        <td><a href="Personalinformation.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('profile','','images/personal-information2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/personal-information.jpg" alt="profile" name="profile" width="108" height="27" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Personalfamily.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('familybackground','','images/family-background2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/family-background.jpg" alt="familybackground" name="familybackground" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Personaleducation.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Education','','images/education2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/education1.jpg" alt="Education" name="Education" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Personalexaminations.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('examinations','','images/examinations2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/examinations1.jpg" alt="examinations" name="examinations" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Personalworkexperience.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('workexperience','','images/work-experience2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/work-experience.jpg" alt="workexperience" name="workexperience" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Personalvoluntarywork.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('voluntarywork','','images/voluntary-work2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/voluntary-work.jpg" alt="voluntarywork" name="voluntarywork" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Personaltrainings.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Trainings','','images/trainings2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/trainings1.jpg" alt="Trainings" name="Trainings" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Personalotherinfo.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('otherinformation','','images/other-information2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/other-information.jpg" alt="otherinformation" name="otherinformation" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="10"><a href="Personalpositiondetails.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('PositionDetails','','images/position2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/position1.jpg" alt="Position Details" name="PositionDetails" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="5"><a href="Personalduties.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('duties&responsibilities','','images/dutiesandresponsibilities2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/dutiesandresponsibilities.jpg" alt="duties&responsibilities" name="duties&responsibilities" width="108" height="27" border="0"></a></td>
                                      </tr>
                                      <tr>
                                        <td height="5"><a href="PersonalEmpNumber.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore();statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('empNumber','','images/editmodifyemployeenumber2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/editmodifyemployeenumber.jpg" alt="empNumber" name="empNumber" width="108" height="27" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="index.php" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('logout','','images/logout2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/logout.jpg" alt="logout" name="logout" width="108" height="20" border="0"></a></td>
                                      </tr>
                                    </table>
<? 
} else { 
?>
                                    <table width="108" height="187" border="0" align="center" cellpadding="0" cellspacing="0" id="NAVTBL">
                                      <tr> 
                                        <td><a href="Personalinformation.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('profile1','','images/personal-information2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/personal-information.jpg" alt="profile" name="profile1" width="108" height="27" border="0" id="profile1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Personalfamily.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('familybackground1','','images/family-background2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/family-background.jpg" alt="familybackground" name="familybackground1" width="108" height="20" border="0" id="familybackground1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Personaleducation.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Education1','','images/education2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/education1.jpg" alt="Education" name="Education1" width="108" height="20" border="0" id="Education1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Personalexaminations.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('examinations1','','images/examinations2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/examinations1.jpg" alt="examinations" name="examinations1" width="108" height="20" border="0" id="examinations1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Personalworkexperience.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('workexperience1','','images/work-experience2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/work-experience.jpg" alt="workexperience" name="workexperience1" width="108" height="20" border="0" id="workexperience1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Personalvoluntarywork.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('voluntarywork1','','images/voluntary-work2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/voluntary-work.jpg" alt="voluntarywork" name="voluntarywork1" width="108" height="20" border="0" id="voluntarywork1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Personaltrainings.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Trainings1','','images/trainings2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/trainings1.jpg" alt="Trainings" name="Trainings1" width="108" height="20" border="0" id="Trainings1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Personalotherinfo.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('otherinformation1','','images/other-information2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/other-information.jpg" alt="otherinformation" name="otherinformation1" width="108" height="20" border="0" id="otherinformation1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="10"><a href="Personalpositiondetails.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('PositionDetails1','','images/position2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/position1.jpg" alt="Position Details" name="PositionDetails1" width="108" height="20" border="0" id="PositionDetails1"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="5"><a href="Personalduties.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('duties','','images/dutiesandresponsibilities2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/dutiesandresponsibilities.jpg" alt="duties" name="duties" width="108" height="27" border="0"></a></td>
                                      </tr>
                                      <tr>
                                        <td height="5"><a href="PersonalEmpNumber.php?strEmpNmbr=<? echo $strEmpNmbr?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo date("n")?>&cboYear=<? echo date("Y")?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('empNumber2','','images/editmodifyemployeenumber2.jpg',1);statusBar(); return true;" onClick="statusBar();"><img src="images/editmodifyemployeenumber.jpg" alt="empNumber2" name="empNumber2" width="108" height="27" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="index.php" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('logout1','','images/logout2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/logout.jpg" alt="logout" name="logout1" width="108" height="20" border="0" id="logout1"></a></td>
                                      </tr>
                                    </table>
                                    <? } ?>
                                  </td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
                <td width="84%" valign="top"><table width="99%" height="369" border="0" cellpadding="0" cellspacing="0" bgcolor="#C1E2FF" id="BODYTBL">
                    <tr> 
                      <td height="339"><!-- InstanceBeginEditable name="BODY" -->
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td height="25" class="header"><p>POSITION DETAILS</p>
                              <table width="40%" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td> 
                                    <?
								  $objPosition->navigateEmployee(date("n"), date("Y"));
								  ?>
                                  </td>
                                </tr>
                                <tr> 
                                  <td>&nbsp;</td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr> 
                            <td> 
                              <? if ($Submit == 'EDIT') { ?>
                              <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" id="TBLPICTURE">
                                <tr> 
                                  <td><table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" class="border">
                                      <tr> 
                                        <td width="480" height="73"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#99CCFF">
                                            <tr> 
                                              <td width="141" class="paragraph">Employee 
                                                Number : </td>
                                              <td width="339"><strong>&nbsp;<? echo $arrEmpPersonal['empNumber']; ?> 
                                                <input name="txtSearch" type="hidden" id="txtSearch" value="<? echo $txtSearch; ?>">
                                                <input name="optField" type="hidden" id="optField" value="<? echo $optField; ?>">
                                                <input name="t_strEmpNumber" type="hidden" id="t_strEmpNumber" value="<? echo $arrEmpPersonal["empNumber"]; ?>">
                                                <input name="p" type="hidden" id="p" value="<? echo $p; ?>">
                                                </strong></td>
                                            </tr>
                                            <tr> 
                                              <td class="paragraph">Employee Name 
                                                : </td>
                                              <td><strong>&nbsp;<? echo $arrEmpPersonal['surname']  . ", " . $arrEmpPersonal['firstname'] . "  ". $arrEmpPersonal['middlename']; ?></strong></td>
                                            </tr>
                                            <tr> 
                                              <td class="paragraph">Division : 
                                              </td>
                                              <td><strong>&nbsp;<? echo $arrEmpPersonal['divisionCode']; ?></strong></td>
                                            </tr>
                                            <tr> 
                                              <td class="paragraph">Position : 
                                              </td>
                                              <td><strong>&nbsp;<? echo $arrEmpPersonal['positionCode'] ; ?></strong></td>
                                            </tr>
                                          </table></td>
                                        <td width="72" bgcolor="#99CCFF"> <img src="Getdata.php?t_strEmpNumber=<? echo $arrEmpPersonal["empNumber"]; ?>"  width="70" height="70"></td>
                                      </tr>
                                    </table></td>
                                </tr>
                              </table>
                              <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td><hr></td>
                                </tr>
                              </table>
                              <table width="98%" border="1" align="center" cellpadding="0" cellspacing="0">
                                <form method=post action="<? $PHP_SELF; ?>" name="frmPositionDetails">
                                  <tr class="alterrow"> 
                                    <td colspan="4">Position Details :</td>
                                  </tr>
                                  <tr> 
                                    <td width="21%" class="paragraph">Service 
                                      Code : </td>
                                    <td width="32%"> <select name="t_strServiceCode">
                                        <?php 
										$objPosition->comboServiceCode($t_strServiceCode);
										?>
                                      </select> <input name="t_strOldServiceCode" type="hidden" value="<? echo $t_strServiceCode; ?>"> 
                                    </td>
                                    <td class="paragraph">Actual Salary :</td>
                                    <td width="28%"><input name="t_intActualSalary" type="text" value="<? echo "$t_intActualSalary"; ?>" size="10" maxlength="10" onBlur="this.form.t_intActualSalary.value=filterNum(this.form.t_intActualSalary.value);"> 
                                      <input name="t_intOldActualSalary" type="hidden" value="<? echo "$t_intActualSalary";  ?>"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">First Day Gov't :</td>
                                    <td> 
                                      <?php 
											$result = mysql_query ("SELECT * FROM tblEmpPosition");
											echo "<SELECT NAME=\"t_strFirstDayGovYear\" onChange=\"updateList(t_strFirstDayGovMonth.selectedIndex,this[this.selectedIndex].text,'t_strFirstDayGovDay')\">\r";
											$yyyymmdd = $t_strFirstDayGov;
											list($t_strFirstDayGovYear) = array(substr($yyyymmdd,0,4));
											$objPosition->comboYearOld($t_strFirstDayGovYear);
											echo "</SELECT>\r";
											?>
                                      <input name="t_strOldFirstDayGovYear" type="hidden" value="<? echo $t_strFirstDayGovYear; ?>"><?php 
										$result = mysql_query ("SELECT * FROM tblEmpPosition");
									    echo "<SELECT NAME=\"t_strFirstDayGovMonth\" onChange=\"updateList(this.selectedIndex,t_strFirstDayGovYear[t_strFirstDayGovYear.selectedIndex].text,'t_strFirstDayGovDay')\">"; 
										$yyyymmdd = $t_strFirstDayGov;
                                        list($t_strFirstDayGovMonth) = array(substr($yyyymmdd,5,2));
										$objPosition->comboMonth($t_strFirstDayGovMonth);
										echo "</SELECT>";
										?>
                                      <input name="t_strOldFirstDayGovMonth" type="hidden" value="<? echo "$t_strFirstDayGovMonth"; ?>"> 
                                      <?php 
											$result = mysql_query ("SELECT * FROM tblEmpPosition");
											echo "<SELECT NAME=\"t_strFirstDayGovDay\">\r";
											$yyyymmdd = $t_strFirstDayGov;
											list($t_strFirstDayGovDay) = array(substr($yyyymmdd,8,2));
											$objPosition->comboDay($t_strFirstDayGovDay);
											echo "</SELECT>\r";
											?>
                                      <input name="t_strOldFirstDayGovDay" type="hidden" value="<? echo $t_strFirstDayGovDay; ?>"> 
                                       
                                      <input name="t_strOldFirstDayGov" type="hidden" value="<? echo $t_strFirstDayGov; ?>"> 
                                    </td>
                                    <td class="paragraph">Salary Effectivity Date 
                                      :</td>
                                    <td> 
                                      <?php 
										$result = mysql_query ("SELECT * FROM tblEmpPosition");
										echo "<SELECT NAME=\"t_strEffectiveYear\" onChange=\"updateList(t_strEffectiveMonth.selectedIndex,this[this.selectedIndex].text,'t_strEffectiveDay')\">\r";
										$yyyymmdd = $t_strEffectiveDate;
                                        list($t_strEffectiveYear) = array(substr($yyyymmdd,0,4));
										$objPosition->comboYearOld($t_strEffectiveYear);
										echo "</SELECT>\r";
										?>
                                      <input name="t_strOldEffectiveYear" type="hidden" value="<? echo $t_strEffectiveYear; ?>"><?php 
											$result = mysql_query ("SELECT * FROM tblEmpPosition");
											echo "<SELECT NAME=\"t_strEffectiveMonth\" onChange=\"updateList(this.selectedIndex,t_strEffectiveYear[t_strEffectiveYear.selectedIndex].text,'t_strEffectiveDay')\">"; 
											$yyyymmdd = $t_strEffectiveDate;
											list($t_strEffectiveMonth) = array(substr($yyyymmdd,5,2));
											$objPosition->comboMonth($t_strEffectiveMonth);
											echo "</SELECT>";
											?>
                                      <input name="t_strOldEffectiveMonth2" type="hidden" value="<? echo $t_strEffectiveMonth; ?>"> 
                                      <?php 
											$result = mysql_query ("SELECT * FROM tblEmpPosition");
											echo "<SELECT NAME=\"t_strEffectiveDay\">\r";
											$yyyymmdd = $t_strEffectiveDate;
											list($t_strEffectiveDay) = array(substr($yyyymmdd,8,2));
											$objPosition->comboDay($t_strEffectiveDay);
											echo "</SELECT>\r";
											?>
                                      <input name="t_strOldEffectiveDay" type="hidden" value="<? echo $t_strEffectiveDay; ?>"> 
                                       
                                      <input name="t_strOldEffectiveDate" type="hidden" value="<? echo $t_strEffectiveDate; ?>"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">First Day Agency : </td>
                                    <td> 
                                      <?php 
											$result = mysql_query ("SELECT * FROM tblEmpPosition");
											echo "<SELECT NAME=\"t_strFirstDayAgencyYear\" onChange=\"updateList(t_strFirstDayAgencyMonth.selectedIndex,this[this.selectedIndex].text,'t_strFirstDayAgencyDay')\">\r";
											$yyyymmdd = $t_strFirstDayAgency;
											list($t_strFirstDayAgencyYear) = array(substr($yyyymmdd,0,4));
											$objPosition->comboYearOld($t_strFirstDayAgencyYear);
											echo "</SELECT>\r";
											?>
                                      <input name="t_strOldFirstDayAgencyYear" type="hidden" value="<? echo $t_strFirstDayAgencyYear; ?>"><?php 
										$result = mysql_query ("SELECT * FROM tblEmpPosition");
									    echo "<SELECT NAME=\"t_strFirstDayAgencyMonth\" onChange=\"updateList(this.selectedIndex,t_strFirstDayAgencyYear[t_strFirstDayAgencyYear.selectedIndex].text,'t_strFirstDayAgencyDay')\">"; 
										$yyyymmdd = $t_strFirstDayAgency;
                                        list($t_strFirstDayAgencyMonth) = array(substr($yyyymmdd,5,2));
										$objPosition->comboMonth($t_strFirstDayAgencyMonth);
										echo "</SELECT>";
										?>
                                      <input name="t_strOldFirstDayAgencyMonth" type="hidden" value="<? echo "$t_strFirstDayAgencyMonth"; ?>"> 
                                      <?php 
											$result = mysql_query ("SELECT * FROM tblEmpPosition");
											echo "<SELECT NAME=\"t_strFirstDayAgencyDay\">\r";
											$yyyymmdd = $t_strFirstDayAgency;
											list($t_strFirstDayAgencyDay) = array(substr($yyyymmdd,8,2));
											$objPosition->comboDay($t_strFirstDayAgencyDay);
											echo "</SELECT>\r";
											?>
                                      <input name="t_strOldFirstDayAgencyDay" type="hidden" value="<? echo $t_strFirstDayAgencyDay; ?>"> 
                                       
                                      <input name="t_strOldFirstDayAgency" type="hidden" value="<? echo $t_strFirstDayAgency; ?>"> 
                                    </td>
                                    <td width="19%" class="paragraph">Employment 
                                      Basis :</td>
                                    <td> 
                                      <?
											 if($t_strEmploymentBasis == "FullTime" || $t_strEmploymentBasis == "")
											  {
												echo "<input name='t_strEmploymentBasis' type='radio' value='FullTime' checked>";
											  }
											  else
											  {
												echo "<input name='t_strEmploymentBasis' type='radio' value='FullTime'>";
											  }
											  ?>
                                      Full Time 
                                      <?
											 if($t_strEmploymentBasis == "PartTime")
											  {
												echo "<input name='t_strEmploymentBasis' type='radio' value='PartTime' checked>";
											  }
											  else
											  {
												echo "<input name='t_strEmploymentBasis' type='radio' value='PartTime'>";
											  } 
											  ?>
                                      Part Time 
                                      <input name="t_strOldEmploymentBasis" type="hidden" value="<? echo $t_strEmploymentBasis; ?>"></td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Longevity Date :</td>
                                    <td> 
                                     <?php 
											$result = mysql_query ("SELECT * FROM tblEmpPosition");
											echo "<SELECT NAME=\"t_strLongevityYear\" onChange=\"updateList(t_strLongevityMonth.selectedIndex,this[this.selectedIndex].text,'t_strLongevityDay')\">\r";
											$yyyymmdd = $t_strLongevityDate;
											list($t_strLongevityYear) = array(substr($yyyymmdd,0,4));
											$objPosition->comboYearOld($t_strLongevityYear);
											echo "</SELECT>\r";
											?>
                                      <input name="t_strOldLongevityYear" type="hidden" value="<? echo $t_strLongevityYear; ?>"> <?php 
										$result = mysql_query ("SELECT * FROM tblEmpPosition");
									    echo "<SELECT NAME=\"t_strLongevityMonth\" onChange=\"updateList(this.selectedIndex,t_strLongevityYear[t_strLongevityYear.selectedIndex].text,'t_strLongevityDay')\">"; 
										$yyyymmdd = $t_strLongevityDate;
                                        list($t_strLongevityMonth) = array(substr($yyyymmdd,5,2));
										$objPosition->comboMonth($t_strLongevityMonth);
										echo "</SELECT>";
										?>
                                      <input name="t_strOldLongevityMonth" type="hidden" value="<? echo "$t_strLongevityMonth"; ?>"> 
                                      <?php 
											$result = mysql_query ("SELECT * FROM tblEmpPosition");
											echo "<SELECT NAME=\"t_strLongevityDay\">\r";
											$yyyymmdd = $t_strLongevityDate;
											list($t_strLongevityDay) = array(substr($yyyymmdd,8,2));
											$objPosition->comboDay($t_strLongevityDay);
											echo "</SELECT>\r";
											?>
                                      <input name="t_strOldLongevityDay" type="hidden" value="<? echo $t_strLongevityDay; ?>"> 
                                       
                                      <input name="t_strOldLongevityDate" type="hidden" value="<? echo $t_strLongevityDate; ?>"> 
                                    </td>
                                    <td width="19%" class="paragraph">HP Factor 
                                      : </td>
                                    <td><input name="t_strHPFactor" type="text" value="<? echo "$t_strHPFactor"; ?>" size="5" maxlength="2" onBlur="validateNumbers(this)"> 
                                      <input name="t_strOldHPFactor" type="hidden" value="<? echo "$t_strHPFactor"; ?>"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Longevity Gap :</td>
                                    <td><input name="t_intLongevityGap" type="text" value="<? echo $t_intLongevityGap; ?>" size="10" maxlength="10" onBlur="validateNumbersAndDigits(this)"> 
                                    </td>
                                    <td class="paragraph">Nature of Work :</td>
                                    <td><input name="t_strNatureOfWork" type="text"  value="<? echo "$t_strNatureOfWork"; ?>" size="20" maxlength="20" onBlur="validateCharacter(this)"></td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Employed/Separated? 
                                      : </td>
                                    <td> <select name="t_strStatusOfAppointment" onChange="separationCauseRequirement()">
                                        <option value="In-Service"></option>
                                        <?php 
										$objPosition->comboSeparationCause($t_strStatusOfAppointment);
										?>
                                      </select> <input name="t_strOldStatusOfAppointment" type="hidden" value="<? echo $t_strStatusOfAppointment; ?>"> 
                                      <span class="note"> (if blank employed)</span> 
                                      <span class="note"> 
                                      <input name="strEmpNmbr" type="hidden" value="<? echo $strEmpNmbr; ?>">
                                      </span> </td>
                                    <td class="paragraph">Category Service :</td>
                                    <td><input name="t_strCategoryService" type="text" value="<? echo "$t_strCategoryService"; ?>" size="20" maxlength="20" onBlur="validateCharacter(this)"> 
                                      <input name="t_strOldCategoryService" type="hidden" value="<? echo "$t_strCategoryService"; ?>"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Separation Date :</td>
                                    <td> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr> 
                                          <td> 
                                            <?
									  if ($t_strStatusOfAppointment == "In-Service")
									  {
									  ?>
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td><input name="t_strContractEndDate" type="text" size=10 value="<? echo "0000-00-00"; ?>"></td>
                                        </tr>
                                        <tr> 
                                          <td> 
                                            <?
									  } else { ?>
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td> <SELECT NAME="t_strContractEndYear" onChange="updateList(t_strContractEndMonth.selectedIndex,this[this.selectedIndex].text,'t_strContractEndDay')">
                                              <?
											$yyyymmdd = $t_strContractEndDate;
											list($t_strContractEndYear) = array(substr($yyyymmdd,0,4));
											$objPosition->comboYearOld($t_strContractEndYear);
											?>
                                              <option value="0000"></option>
                                            </SELECT><SELECT NAME="t_strContractEndMonth" onChange="updateList(this.selectedIndex,t_strContractEndYear[t_strContractEndYear.selectedIndex].text,'t_strContractEndDay')">
                                              <?
											$yyyymmdd = $t_strContractEndDate;
											list($t_strContractEndMonth) = array(substr($yyyymmdd,5,2));
											$objPosition->comboMonth($t_strContractEndMonth);
											?>
                                              <option value="00"></option>
                                            </SELECT> <SELECT NAME="t_strContractEndDay">
                                              <?
											$yyyymmdd = $t_strContractEndDate;
											list($t_strContractEndDay) = array(substr($yyyymmdd,8,2));
											$objPosition->comboDay($t_strContractEndDay);
											?>
                                              <option value="00"></option>
                                            </SELECT>  <span class="required">*</span> 
                                            <input name="t_strOldContractEndMonth" type="hidden" value="<? echo $t_strContractEndMonth; ?>"> 
                                            <input name="t_strOldContractEndDay" type="hidden" value="<? echo $t_strContractEndDay; ?>"> 
                                            <input name="t_strOldContractEndYear" type="hidden" value="<? echo $t_strContractEndYear; ?>"> 
                                            <input name="t_strOldContractEndDate" type="hidden" value="<? echo $t_strContractEndDate; ?>"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td> 
                                            <?
									  } 
									  ?>
                                          </td>
                                        </tr>
                                      </table></td>
                                    <td class="paragraph">Tax Status :</td>
                                    <td> 
                                      <?php 
											$result = mysql_query ("SELECT taxStatus FROM tblTaxExempt");
											echo "<SELECT NAME=\"t_strTaxStatCode\">\r";
											if ($row = mysql_fetch_array($result)) {
											do {
												if ($t_strTaxStatCode == $row["taxStatus"])
												{
													print "<OPTION VALUE=\"".($row["taxStatus"])."\" selected>".($row["taxStatus"])."\r";
												}
											  print "<OPTION VALUE=\"".($row["taxStatus"])."\">".($row["taxStatus"])."\r";
											} while($row = mysql_fetch_array($result));
											} else {print "no results!";}
											echo "</SELECT>\r";
											?>
                                      <input name="t_strOldTaxStatCode" type="hidden" value="<? echo $t_strTaxStatCode; ?>"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph"> Appointment Desc. : 
                                    </td>
                                    <td> <select name="t_strAppointmentCode" size="1" onChange="appointmentCodeRequirement()">
                                        <?php 
										$objPosition->comboAppointmentCode($t_strAppointmentCode);
										?>
                                      </select> <input name="t_strOldAppointmentCode" type="hidden" value="<? echo $t_strAppointmentCode; ?>"> 
                                    </td>
                                    <td class="paragraph">No. of Dependents :</td>
                                    <td>
                                      <?php
								//  Count number of children	   
								$objChildCount = mysql_query("SELECT * FROM tblEmpChild WHERE empNumber = '$t_strEmpNumber'"); 
								$num = mysql_num_rows($objChildCount); 
								
								if ($num >= 0 && $num < 5){ 
								// if number of entries is more than 1
								printf("<input name=\"t_intDependents\" type=\"text\" value=\"$num\" size=\"5\" maxlength=\"2\" onBlur=\"validateNumbers(this)\" readonly>");
								} 
								// if number of entries is less than 1 
								else {
								$num = 4; 
								//printf("<a href=\"Birthday.php\">");
								printf("<input name=\"t_intDependents\" type=\"text\" value=\"$num\" size=\"5\" maxlength=\"2\" onBlur=\"validateNumbers(this)\" readonly>");
								} 
								
								?>
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Division Code :</td>
                                    <td> <select name="t_strDivisionCode" size="1">
                                        <?php 
										$objPosition->comboDivisionCode($t_strDivisionCode);
										?>
                                      </select> <input name="t_strOldDivisionCode" type="hidden" value="<? echo $t_strDivisionCode; ?>"> 
                                    </td>
                                    <td class="paragraph">Personnel Action :</td>
                                    <td><input name="t_strPersonnelAction" type="text" value="<? echo $t_strPersonnelAction; ?>" size="20" maxlength="20" onBlur="validateCharacter(this)"> 
                                      <input name="t_strOldPersonnelAction" type="hidden" value="<? echo $t_strPersonnelAction; ?>"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Section Code :</td>
                                    <td> <select name="t_strSectionCode" size=1>
										<option value="none">none</option>
                                        <?php 
										$objPosition->comboSectionCode($t_strSectionCode);
										?>
                                      </select> <input name="t_strOldSectionCode" type="hidden" value="<? echo $t_strSectionCode; ?>"> 
                                    </td>
                                    <td class="paragraph">Include DTR? :</td>
                                    <td> 
                                      <?
									 if($t_strDTRSwitch == "Y" || $t_strDTRSwitch == "")
									  {
									  	echo "<input name='t_strDTRSwitch' type='radio' value='Y' checked>";
									  }
									  else
									  {
									  	echo "<input name='t_strDTRSwitch' type='radio' value='Y'>";
									  }
									  ?>
                                      Yes 
                                      <?
									 if($t_strDTRSwitch == "N")
									  {
									  	echo "<input name='t_strDTRSwitch' type='radio' value='N' checked>";
									  }
									  else
									  {
									  	echo "<input name='t_strDTRSwitch' type='radio' value='N'>";
									  } 
									  ?>
                                      No 
                                      <input name="t_strOldDTRSwitch" type="hidden" value="<? echo "$t_strDTRSwitch"; ?>"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">Place of Assignment 
                                      :</td>
                                    <td><input name="t_strPlaceOfAssignment" type="text" value="<? echo "$t_strPlaceOfAssignment"; ?>" size="20" maxlength="20" onBlur="validateCharacter(this)"></td>
                                    <td class="paragraph">Include Payroll? :</td>
                                    <td> 
                                      <?
									 if($t_strPayrollSwitch == "Y" || $t_strPayrollSwitch == "")
									  {
									  	echo "<input name='t_strPayrollSwitch' type='radio' value='Y' checked>";
									  }
									  else
									  {
									  	echo "<input name='t_strPayrollSwitch' type='radio' value='Y'>";
									  }
									  ?>
                                      Yes 
                                      <?
									 if($t_strPayrollSwitch == "N")
									  {
									  	echo "<input name='t_strPayrollSwitch' type='radio' value='N' checked>";
									  }
									  else
									  {
									  	echo "<input name='t_strPayrollSwitch' type='radio' value='N'>";
									  } 
									  ?>
                                      No 
                                      <input name="t_strOldPayrollSwitch" type="hidden" value="<? echo "$t_strPayrollSwitch"; ?>"> 
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="paragraph">&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td class="paragraph">Attendance Scheme :</td>
                                    <td><select name="t_strAttendanceSchemeCode" size="1">
                                        <?php 
										$objPosition->comboAttendanceScheme($t_strAttendanceSchemeCode);
										?>
                                      </select> <input name="t_strOldAttendanceSchemeCode" type="hidden" value="<? echo $t_strAttendanceSchemeCode; ?>"></td>
                                  </tr>
                                  <tr class="note"> 
                                    <td colspan="4">&nbsp;</td>
                                  </tr>
                                  <tr class="alterrow"> 
                                    <td colspan="4">Optional Policy Loan :</td>
                                  </tr>
                                  <tr> 
                                    <td class="paragraph">OPL No. 1 :</td>
                                    <td><input name="t_strOplNumber1" type="text" value="<? echo "$t_strOplNumber1"; ?>" size="15" maxlength="10" onBlur="validateOplNumber(this)"></td>
                                    <td class="paragraph">OPL No. 2 :</td>
                                    <td><input name="t_strOplNumber2" type="text" value="<? echo "$t_strOplNumber2"; ?>" size="15" maxlength="10" onBlur="validateOplNumber(this)"></td>
                                  </tr>
                                  <tr> 
                                    <td colspan="3" class="paragraph">OPL No. 
                                      3 :</td>
                                    <td> <input name="t_strOplNumber3" type="text" value="<? echo "$t_strOplNumber3"; ?>" size="15" maxlength="10" onBlur="validateOplNumber(this)"></td>
                                  </tr>
                                  <tr> 
                                    <td colspan="4">&nbsp;</td>
                                  </tr>
                                  <tr> 
                                    <td colspan="4"><table width="100%" border="1" cellspacing="0" cellpadding="0">
                                        <tr> 
                                          <td colspan="4"> 
                                            <?
										   if ($t_strAppointmentCode == "Perm" || $t_strAppointmentCode == "PERM" || $t_strAppointmentCode == "Permanent") 
										   {
										   ?>
                                            <input name="strEmpNmbr" type="hidden" value="<? echo $strEmpNmbr; ?>"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4" class="alterrow">Plantilla 
                                            Position :</td>
                                        </tr>
                                        <tr> 
                                          <td width="20%" class="paragraph"> Item 
                                            Number :</td>
                                          <td width="33%"> <select name="t_strItemNumber" size="1" onChange="itemNumberRequirement()">
                                              <? 
										  $objPosition->comboItemNumber($t_strItemNumber); 
										  ?>
                                            </select> </td>
                                          <td colspan="2">&nbsp; </td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4">&nbsp; </td>
                                        </tr>
                                        <tr> 
                                          <td width="20%" class="paragraph"> 
                                            <? 
											$t_intAuthorizeSalary = $objPosition->authorizeSalary($t_strEmpNumber, $t_strItemNumber); 
											?>
                                            Authorize Salary : </td>
                                          <td> <input name="t_intAuthorizeSalary" type="text" value="<? echo $t_intAuthorizeSalary; ?>" size="10" maxlength="15" readonly></td>
                                          <td width="21%" class="paragraph"> 
                                            <? 
											$t_intSalaryGradeNumber = $objPosition->salaryGrade($t_strEmpNumber, $t_strItemNumber); 
											?>
                                            Salary Grade : </td>
                                          <td width="26%"> <input name="t_intSalaryGradeNumber" type="text" value="<? echo $t_intSalaryGradeNumber; ?>" size="3" maxlength="3" readonly> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td width="20%" class="paragraph"> 
                                            <? 
											$t_strPosition = $objPosition->positionCode($t_strEmpNumber, $t_strItemNumber); 
											?>
                                            Position Code :</td>
                                          <td> <input name="t_strPositionCode" type="text" value="<? echo $t_strPosition; ?>" size="10" maxlength="10" readonly> 
                                            <span class="required"> *</span> </td>
                                          <td width="21%" class="paragraph"> 
                                            <? 
											$t_intStepNumber = $objPosition->stepNumber($t_strEmpNumber, $t_strItemNumber); 
											?>
                                            Step Number :</td>
                                          <td> <input name="t_intStepNumber" type="text" value="<? echo $t_intStepNumber; ?>" size="3" maxlength="3" readonly> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td width="20%" class="paragraph">Position 
                                            Date :</td>
                                          <td> 
                                           <?php 
											$result = mysql_query ("SELECT * FROM tblEmpPosition");
											echo "<SELECT NAME=\"t_strPositionYear\" onChange=\"updateList(t_strPositionMonth.selectedIndex,this[this.selectedIndex].text,'t_strPositionDay')\">\r";
											$yyyymmdd = $t_strPositionDate;
											list($t_strPositionYear) = array(substr($yyyymmdd,0,4));
											$objPosition->comboYearOld($t_strPositionYear);
											echo "</SELECT>\r";
											?>
                                            <input name="t_strOldPositionYear" type="hidden" value="<? echo "$t_strPositionYear"; ?>"> <?php 
											$result = mysql_query ("SELECT * FROM tblEmpPosition");
											echo "<SELECT NAME=\"t_strPositionMonth\" onChange=\"updateList(this.selectedIndex,t_strPositionYear[t_strPositionYear.selectedIndex].text,'t_strPositionDay')\">"; 
											$yyyymmdd = $t_strPositionDate;
											list($t_strPositionMonth) = array(substr($yyyymmdd,5,2));
											$objPosition->comboMonth($t_strPositionMonth);
											echo "</SELECT>";
											?>
                                            <input name="t_strOldPositionMonth" type="hidden" value="<? echo "$t_strPositionMonth"; ?>"> 
                                            <?php 
											$result = mysql_query ("SELECT * FROM tblEmpPosition");
											echo "<SELECT NAME=\"t_strPositionDay\">\r";
											$yyyymmdd = $t_strPositionDate;
											list($t_strPositionDay) = array(substr($yyyymmdd,8,2));
											$objPosition->comboDay($t_strPositionDay);
											echo "</SELECT>\r";
											?>
                                            <input name="t_strOldPositionDay" type="hidden" value="<? echo "$t_strPositionDay"; ?>"> 
                                             
                                            <input name="t_strOldPositionDate" type="hidden" value="<? echo "$t_strPositionDate"; ?>"> 
                                          </td>
                                          <td width="21%" class="paragraph">Date 
                                            Increment : </td>
                                          <td> 
                                            <?php 
										$result = mysql_query ("SELECT * FROM tblEmpPosition");
										echo "<SELECT NAME=\"t_strEffectiveDateIncYear\" onChange=\"updateList(t_strEffectiveDateIncMonth.selectedIndex,this[this.selectedIndex].text,'t_strEffectiveDateIncDay')\">\r";
										$yyyymmdd = $t_strEffectiveDateIncrement;
                                        list($t_strEffectiveDateIncYear) = array(substr($yyyymmdd,0,4));
										$objPosition->comboYearOld($t_strEffectiveDateIncYear);
										echo "</SELECT>\r";
										?>
                                            <input name="t_strOldEffectiveDateIncYear" type="hidden" value="<? echo $t_strEffectiveDateIncYear; ?>"><?php 
											$result = mysql_query ("SELECT * FROM tblEmpPosition");
											echo "<SELECT NAME=\"t_strEffectiveDateIncMonth\" onChange=\"updateList(this.selectedIndex,t_strEffectiveDateIncYear[t_strEffectiveDateIncYear.selectedIndex].text,'t_strEffectiveDateIncDay')\">"; 
											$yyyymmdd = $t_strEffectiveDateIncrement;
											list($t_strEffectiveDateIncMonth) = array(substr($yyyymmdd,5,2));
											$objPosition->comboMonth($t_strEffectiveDateIncMonth);
											echo "</SELECT>";
											?>
                                            <input name="t_strOldEffectiveDateIncMonth" type="hidden" value="<? echo $t_strEffectiveDateIncMonth; ?>"> 
                                            <?php 
											$result = mysql_query ("SELECT * FROM tblEmpPosition");
											echo "<SELECT NAME=\"t_strEffectiveDateIncDay\">\r";
											$yyyymmdd = $t_strEffectiveDateIncrement;
											list($t_strEffectiveDateIncDay) = array(substr($yyyymmdd,8,2));
											$objPosition->comboDay($t_strEffectiveDateIncDay);
											echo "</SELECT>\r";
											?>
                                            <input name="t_strOldEffectiveDateIncDay" type="hidden" value="<? echo $t_strEffectiveDateIncDay; ?>"> 
                                             
                                            <input name="t_strEffectiveDateIncrement" type="hidden" value="<? echo $t_strEffectiveDateIncrement; ?>"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4"> 
                                            <?
									      } else { 		
//										  } elseif ($t_strAppointmentCode == "Cont" || $t_strAppointmentCode == "Temp" || $t_strAppointmentCode == "Prbt" || $t_strAppointmentCode == "CGIA"){
										  ?>
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4" class="alterrow">Contractual/Casual/Temporary/Provisionary 
                                            Position :</td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4"> <input name="t_strItemNumber" type="hidden" id="t_strItemNumber" value="<? echo "NONE"; ?>"> 
                                            <input name="t_intAuthorizeSalary" type="hidden" id="t_intAuthorizeSalary" value="<? echo "0.00"; ?>"> 
                                            <input name="t_intSalaryGradeNumber" type="hidden" id="t_intSalaryGradeNumber" value="<? echo "0"; ?>"> 
                                            <input name="t_intStepNumber" type="hidden" id="t_intStepNumber" value="<? echo "0"; ?>"> 
                                            <input name="t_strEffectiveDateIncrement" type="hidden" id="t_strEffectiveDateIncrement" value="<? echo "0000-00-00"; ?>"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph"> Position Desc. 
                                            :</td>
                                          <td> 
                                            <?php 
										$result = mysql_query ("SELECT * FROM tblPosition");
										echo "<SELECT NAME=\"t_strPositionCode\">\r";
										if ($row = mysql_fetch_array($result)) {
										do {
											if ($t_strPositionCode == $row["positionCode"])
											{
												print "<OPTION VALUE=\"".($row["positionCode"])."\" selected>".($row["positionDesc"])."\r";
											}
										  print "<OPTION VALUE=\"".($row["positionCode"])."\">".($row["positionDesc"])."\r";
										} while($row = mysql_fetch_array($result));
										} else {print "no results!";}
										echo "</SELECT>\r";
										?>
                                            <input name="t_strOldPositionCode" type="hidden" value="<? echo $t_strPositionCode; ?>"> 
                                          </td>
                                          <td class="paragraph">Position Date 
                                            :</td>
                                          <td> 
                                           <?php 
											$result = mysql_query ("SELECT * FROM tblEmpPosition");
											echo "<SELECT NAME=\"t_strPositionYear\" onChange=\"updateList(t_strPositionMonth.selectedIndex,this[this.selectedIndex].text,'t_strPositionDay')\">\r";
											$yyyymmdd = $t_strPositionDate;
											list($t_strPositionYear) = array(substr($yyyymmdd,0,4));
											$objPosition->comboYearOld($t_strPositionYear);
											echo "</SELECT>\r";
											?>
                                            <input name="t_strOldPositionYear" type="hidden" value="<? echo "$t_strPositionYear"; ?>"> <?php 
											$result = mysql_query ("SELECT * FROM tblEmpPosition");
											echo "<SELECT NAME=\"t_strPositionMonth\" onChange=\"updateList(this.selectedIndex,t_strPositionYear[t_strPositionYear.selectedIndex].text,'t_strPositionDay')\">"; 
											$yyyymmdd = $t_strPositionDate;
											list($t_strPositionMonth) = array(substr($yyyymmdd,5,2));
											$objPosition->comboMonth($t_strPositionMonth);
											echo "</SELECT>";
											?>
                                            <input name="t_strOldPositionMonth" type="hidden" value="<? echo "$t_strPositionMonth"; ?>"> 
                                            <?php 
											$result = mysql_query ("SELECT * FROM tblEmpPosition");
											echo "<SELECT NAME=\"t_strPositionDay\">\r";
											$yyyymmdd = $t_strPositionDate;
											list($t_strPositionDay) = array(substr($yyyymmdd,8,2));
											$objPosition->comboDay($t_strPositionDay);
											echo "</SELECT>\r";
											?>
                                            <input name="t_strOldPositionDay" type="hidden" value="<? echo "$t_strPositionDay"; ?>"> 
                                             
                                            <input name="t_strOldPositionDate" type="hidden" value="<? echo "$t_strPositionDate"; ?>"> 
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td colspan="4"> 
                                            <?
											}
											?>
                                          </td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                  <tr> 
                                    <td colspan="4">&nbsp;</td>
                                  </tr>
                                  <tr> 
                                    <td colspan="4"><div align="center"> 
                                        <input name="strEmpNmbr" type="hidden" id="strEmpNmbr" value="<? echo $strEmpNmbr; ?>">
                                        <input name="txtSearch" type="hidden" id="txtSearch" value="<? echo $txtSearch; ?>">
                                        <input name="optField" type="hidden" id="optField" value="<? echo $optField; ?>">
                                        <input name="t_strEmpNumber" type="hidden" id="t_strEmpNumber" value="<? echo $arrEmpPersonal["empNumber"]; ?>">
                                        <input name="p" type="hidden" id="p" value="<? echo $p; ?>">
                                        <input name="Submit" type="submit" value="Submit">
                                      </div></td>
                                  </tr>
                                </form>
                              </table>
                              <? } else {?>
                            </td>
                          </tr>
                          <tr> 
                            <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td> 
                                    <? 
							  $objPosition->viewPosition($strEmpNmbr, $txtSearch, $optField, $p, $strLetter, $t_strAppointmentCode, $t_strStatusOfAppointment, $t_strServiceCode, $t_strSectionCode, $t_strPositionCode, $t_strDivisionCode, $t_strTaxStatCode, $t_strItemNumber, $t_intAuthorizeSalary, $t_strFirstDayAgency, $t_intStepNumber, $t_strFirstDayGov, $t_strPlaceOfAssignment, $t_strAttendanceSchemeCode, $t_strPersonnelAction, $t_strEmploymentBasis, $t_strCategoryService, $t_strNatureOfWork, $t_strHPFactor, $t_strPayrollSwitch, $t_strDTRSwitch, $t_intDependents, $t_strHealthProvider, $t_strEffectiveDate, $t_strPositionDate, $t_strLongevityDate, $t_intLongevityGap, $t_intActualSalary, $t_strContractEndDate, $t_strOplNumber1, $t_strOplNumber2, $t_strOplNumber3, $t_intSalaryGradeNumber, $t_strEffectiveDateIncrement, $arrEmpPersonal["empNumber"]);   //view employee position
							  ?>
                                  </td>
                                </tr> 
                              </table></td>
                          </tr>
                          <tr> 
                            <td> 
                              <? } ?>
                            </td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                          </tr>
                          <tr> 
                            <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td class="paragraph">
                                    <? $objPosition->output(); ?>
                                  </td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr> 
                            <td>&nbsp;</td>
                          </tr>
                        </table>
                        <!-- InstanceEndEditable --></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
        <tr bgcolor="#E9F3FE"> 
          <td height="13" colspan="2"><table width="100%" height="13" border="0" cellpadding="0" cellspacing="0" bgcolor="#002E7F" id="OUTERTBL4">
              <tr> 
                <td height="13"><div align="center"> 
                    <p class="login"><font color="#FFFFFF">Copyright &copy; 2003 
                      Department of Science and Technology</font></p>
                  </div></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
