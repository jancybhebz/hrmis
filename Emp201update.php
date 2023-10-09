<?php 
/* 
File Name: Emp201update.php 
----------------------------------------------------------------------
Purpose of this file: 
To welcome user.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco, Brian Jill DG. Sarandi
----------------------------------------------------------------------
Date of Revision: May 21, 2004
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
include("../hrmis/class/Emp201update.php");
$objEmp201Update = new emp201Update;
$arrEmpPersonal = $objEmp201Update->checkGetEmpNmbr("Employee", $strEmpNmbr);


if ($t_strEmpProfile == 'Training') 
{
// Function Training 
$objEmp201Update->addTraining($t_strEmpNumber, $t_strEmpProfile, $t_strTrainingRequestCode, $t_strTrainingCode, $t_dtmTrainingContractMonth, $t_dtmTrainingContractDay, $t_dtmTrainingContractYear, $t_strTrainingConductedBy, $t_strTrainingVenue, $t_dtmTrainingStartMonth, $t_dtmTrainingStartDay, $t_dtmTrainingStartYear, $t_dtmTrainingEndMonth, $t_dtmTrainingEndDay, $t_dtmTrainingEndYear,  $t_intTrainingHours, $t_intTrainingCost, $t_dtmStatusDate, $t_strRequestStatus, $Submit);   //Add employee training/seminar
} elseif ($t_strEmpProfile == 'Reference') {
//	Function Reference
$objEmp201Update->addReference($t_strEmpNumber, $t_strEmpProfile, $t_strRefRequestCode, $t_strRefName, $t_strRefAddress, $t_intRefTelephone, $t_dtmStatusDate, $t_strRequestStatus, $Submit);   //Add employee reference
} elseif ($t_strEmpProfile == 'Children') {
//	Function Children
$objEmp201Update->addChildren($t_strEmpNumber, $t_strEmpProfile, $t_strChildRequestCode, $t_strChildName, $t_strChildBirthMonth, $t_strChildBirthDay, $t_strChildBirthYear, $t_dtmStatusDate, $t_strRequestStatus, $Submit);   //Add employee children information
} elseif ($t_strEmpProfile == 'Tax'){
//	Function Tax
$objEmp201Update->addTax($t_strEmpNumber, $t_strEmpProfile, $t_strTaxRequestCode, $t_strTaxCertNmbr, $t_strIssuedAt, $t_dtmIssuedOnMonth, $t_dtmIssuedOnDay, $t_dtmIssuedOnYear, $t_dtmStatusDate, $t_strRequestStatus, $Submit);   //Add employee community tax certificate
} elseif ($t_strEmpProfile == 'Examination') {
//  Function Examinations
$objEmp201Update->addExaminations($t_strEmpNumber, $t_strEmpProfile, $t_strExamRequestCode, $t_strExamCode, $t_dtmExamMonth, $t_dtmExamDay, $t_dtmExamYear, $t_intExamRating, $t_strExamPlace, $t_strLicenseNumber, $t_dtmDateReleaseMonth, $t_dtmDateReleaseDay, $t_dtmDateReleaseYear, $t_dtmStatusDate, $t_strRequestStatus, $Submit);   //Add employee examination
} elseif ($t_strEmpProfile == 'Voluntary') {
//  Function Voluntary Works
$objEmp201Update->addVoluntaryWorks($t_strEmpNumber, $t_strEmpProfile, $t_strVWRequestCode, $t_strVWName, $t_strVWAddress, $t_dtmVWDateFromMonth, $t_dtmVWDateFromDay, $t_dtmVWDateFromYear, $t_dtmVWDateToMonth, $t_dtmVWDateToDay, $t_dtmVWDateToYear,  $t_intVWHours, $t_strVWPosition, $t_dtmStatusDate, $t_strRequestStatus, $Submit);  //Add employee personal data
} elseif ($t_strEmpProfile == 'Profile') {
//  Function Profile
$objEmp201Update->addProfile($t_strEmpNumber, $t_strEmpProfile, $t_strProfileRequestCode, $t_strSurname, $t_strMiddlename, $t_strCivilStatus, $t_intWeight, $t_strResidentialAddress, $t_intZipCode1, $t_intTelephone1, $t_strPermanentAddress, $t_intZipCode2, $t_intTelephone2, $t_strEmail, $t_intMobile, $t_strSpouse, $t_strSpouseWork, $t_strSpouseBusName, $t_strSpouseBusAddress, $t_intSpouseTelephone, $t_dtmStatusDate, $t_strRequestStatus, $Submit);   //Add employee personal data
} elseif ($t_strEmpProfile == 'Education') {
//  Function Education
$objEmp201Update->addEducation($t_strEmpNumber, $t_strEmpProfile, $t_strEducationRequestCode, $t_strLevelCode, $t_strSchoolName, $t_strCourse, $t_intUnits, $t_dtmSchoolFromMonth, $t_dtmSchoolFromDay, $t_dtmSchoolFromYear, $t_dtmSchoolToMonth, $t_dtmSchoolToDay, $t_dtmSchoolToYear, $t_strHonors, $t_dtmStatusDate, $t_strRequestStatus, $Submit);   //Add employee educational attainment
}
?>

<html><!-- InstanceBegin template="/Templates/Employeerequesttmplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Human Resource Management Information System - HR Section</title>
<?
include("../hrmis/class/JSgeneral.php");
include("../hrmis/javascript/Emp201update.js");
?>
<script language="JavaScript">

function updateRequirement()
{
	var strEmpNmbr = "<? echo $strEmpNmbr ?>";
	var strEmpData = document.frmEmp201.t_strEmpProfile.value;
	
	window.location = "Emp201update.php?strEmpNmbr="+strEmpNmbr+"&t_strEmpProfile="+strEmpData;
}

<!-- Tax Certificate Validation -->
function validateTax(){
var digits=".0123456789"
var temp

if (document.frmEmp201.t_strTaxCertNmbr.value=="") {
alert("Please input community tax certificate!")
return false
} else if (document.frmEmp201.t_strIssuedAt.value=="") {
alert("Please input issued at!")
return false
} 

return true
}

<!-- Reference Validation -->
function validateReference(){
var digits=".0123456789"
var temp

if (document.frmEmp201.t_strRefName.value=="") {
alert("Please input reference name!")
return false
} else if (document.frmEmp201.t_strRefAddress.value=="") {
alert("Please input reference address!")
return false
} else if (document.frmEmp201.t_intRefTelephone.value=="") {
alert("Please input reference telephone!")
return false
} 

for (var i=0;i<document.frmEmp201.t_intRefTelephone.value.length;i++){
temp=document.frmEmp201.t_intRefTelephone.value.substring(i,i+1)
if (digits.indexOf(temp)==-1){
alert(" Invalid telephone number! \n\n Please input numbers only!")
return false
      }
   }
   
return true
}

<!-- Examination Validation -->
function validateExam(){
var digits=".0123456789"
var temp

if (document.frmEmp201.t_strExamPlace.value=="") {
alert("Please input place of exam!")
return false
} else if (document.frmEmp201.t_intExamRating.value=="") {
alert("Please input exam rating!")
return false
}

for (var i=0;i<document.frmEmp201.t_intExamRating.value.length;i++){
temp=document.frmEmp201.t_intExamRating.value.substring(i,i+1)
if (digits.indexOf(temp)==-1){
alert(" Invalid rate of exam! \n\n Please input numbers only!")
return false
      }
   }

return true
}

function validateRate(field) 
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

<!-- School Validation -->
function validateSchool(){
var digits=".0123456789"
var temp

if (document.frmEmp201.t_strSchoolName.value=="") {
alert("Please input school name!")
return false
} else if (document.frmEmp201.t_strCourse.value=="") {
alert("Please input course!")
return false
} else if (document.frmEmp201.t_intUnits.value=="") {
alert("Please input unit!")
return false
}

for (var i=0;i<document.frmEmp201.t_intUnits.value.length;i++){
temp=document.frmEmp201.t_intUnits.value.substring(i,i+1)
if (digits.indexOf(temp)==-1){
alert(" Invalid rate of exam! \n\n Please input numbers only!")
return false
      }
   }

return true
}

function validateUnit(field) 
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

<!-- Children Form Validation -->
function validateChild(){
var digits=".0123456789"
var temp

if (document.frmEmp201.t_strChildName.value=="") {
alert("Please input name of child!")
return false
}

return true
}


<!-- Trainings Form Validation -->
function validateTrainings(){
var digits=".0123456789"
var temp

if (document.frmEmp201.t_intTrainingHours.value=="") {
alert("Please input training hours!")
return false
} else if (document.frmEmp201.t_strTrainingVenue.value=="") {
alert("Please input training venue!")
return false
} else if (document.frmEmp201.t_strTrainingConductedBy.value=="") {
alert("Please input training conducted by!")
return false
} else if (document.frmEmp201.t_intTrainingCost.value=="") {
alert("Please input training cost!")
return false
} 

for (var i=0;i<document.frmEmp201.t_intTrainingHours.value.length;i++){
temp=document.frmEmp201.t_intTrainingHours.value.substring(i,i+1)
if (digits.indexOf(temp)==-1){
alert(" Invalid training hours! \n\n Please input numbers only!")
return false
      }
   }

for (var i=0;i<document.frmEmp201.t_intTrainingCost.value.length;i++){
temp=document.frmEmp201.t_intTrainingCost.value.substring(i,i+1)
if (digits.indexOf(temp)==-1){
alert(" Invalid training cost! \n\n Please input numbers only!")
return false
      }
   }

return true
}

<!-- VoluntaryWorks Form Validation -->
function validateVoluntaryWorks(){
var digits=".0123456789"
var temp
if (document.frmEmp201.t_strVWName.value=="") {
alert("Please input name of organization!")
return false
} else if (document.frmEmp201.t_strVWAddress.value=="") {
alert("Please input address of organization!")
return false
} else if (document.frmEmp201.t_intVWHours.value=="") {
alert("Please input number of hours!")
return false
} else if (document.frmEmp201.t_strVWPosition.value=="") {
alert("Please input position/nature of work!")
return false
}

for (var i=0;i<document.frmEmp201.t_intVWHours.value.length;i++){
temp=document.frmEmp201.t_intVWHours.value.substring(i,i+1)
if (digits.indexOf(temp)==-1){
alert("Invalid number of hours !")
return false
      }
   }

return true
}

function validateHours(field) 
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

<!-- Profile Form Validation -->
function validateProfile(){
var digits=".0123456789"
var temp

if (document.frmEmp201.t_strSurname.value=="") {
alert("Please input surname!")
return false
} else if (document.frmEmp201.t_strFirstname.value=="") {
alert("Please input first name!")
return false
} else if (document.frmEmp201.t_strMiddlename.value=="") {
alert("Please input middle name!")
return false
} else if (document.frmEmp201.t_intWeight.value=="") {
alert("Please input weight in kgs.!")
return false
} else if (document.frmEmp201.t_strResidentialAddress.value=="") {
alert("Please input residential!")
return false
} else if (document.frmEmp201.t_intZipCode1.value=="") {
alert("Please input resident zip code!")
return false
} else if (document.frmEmp201.t_strPermanentAddress.value=="") {
alert("Please input permanent address!")
return false
} else if (document.frmEmp201.t_intZipCode2.value=="") {
alert("Please input permanent zip code!")
return false
} else if (document.frmEmp201.t_strEmail.value=="") {
alert("Please input email!")
return false
}

for (var i=0;i<document.frmEmp201.t_intWeight.value.length;i++){
temp=document.frmEmp201.t_intWeight.value.substring(i,i+1)
if (digits.indexOf(temp)==-1){
alert(" Invalid weight! \n\n Please input numbers only!")
return false
      }
   }

for (var i=0;i<document.frmEmp201.t_intZipCode1.value.length;i++){
temp=document.frmEmp201.t_intZipCode1.value.substring(i,i+1)
if (digits.indexOf(temp)==-1){
alert(" Invalid resident zip code ! \n\n Please input numbers only!")
return false
      }
   }

for (var i=0;i<document.frmEmp201.t_intTelephone1.value.length;i++){
temp=document.frmEmp201.t_intTelephone1.value.substring(i,i+1)
if (digits.indexOf(temp)==-1){
alert(" Invalid resident telephone number! \n\n Please input numbers only!")
return false
      }
   }

for (var i=0;i<document.frmEmp201.t_intZipCode2.value.length;i++){
temp=document.frmEmp201.t_intZipCode2.value.substring(i,i+1)
if (digits.indexOf(temp)==-1){
alert(" Invalid permanent zip code ! \n\n Please input numbers only!")
return false
      }
   }

for (var i=0;i<document.frmEmp201.t_intTelephone2.value.length;i++){
temp=document.frmEmp201.t_intTelephone2.value.substring(i,i+1)
if (digits.indexOf(temp)==-1){
alert(" Invalid permanent telephone number! \n\n Please input numbers only!")
return false
      }
   }

for (var i=0;i<document.frmEmp201.t_intMobile.value.length;i++){
temp=document.frmEmp201.t_intMobile.value.substring(i,i+1)
if (digits.indexOf(temp)==-1){
alert(" Invalid cellphone number ! \n\n Please input numbers only!")
return false
      }
   }

return true
}
</script>
<!-- InstanceEndEditable --> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript" type="text/JavaScript">
<!-- onMouseOver="statusBar(); return true;" onClick="statusBar();" onMouseUp="statusBar()" onFocus="statusBar()"

<!--
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

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('images/notificationover.jpg','images/201over.jpg','images/requestclick.jpg','images/officialbusiness2.jpg','images/reports2-navigation.jpg','images/leaverequest2.jpg','images/logout2.jpg','images/attendanceover.jpg','images/201update2.jpg','images/travelorder2.jpg'); history.forward()" onContextMenu="return false"><div align="center"> 
<table width="778" border="0" cellpadding="0" cellspacing="0" id="OUTERTBL">
  <tr> 
    <td><table width="100%" height="426" border="0" align="center" cellpadding="0" cellspacing="0" id="INNERTBL">
        <tr> 
          <td width="59%" height="44" valign="bottom"><img src="images/empmodule.jpg" width="170" height="23"> 
          </td>
          <td width="41%" valign="top"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
              <tr> 
                <td height="13"><table border="0" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td>&nbsp;</td>
                    </tr>
                  </table>
                  <div align="right"><a href="Employeeinformation.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Empprofile','','images/201over.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/201.jpg" alt="Empprofile" name="Empprofile" width="67" height="29" border="0"></a><a href="EmpDTR.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Empattendance','','images/attendanceover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/attendance.jpg" alt="Empattendance" name="Empattendance" width="88" height="29" border="0"></a><a href="EmpOB.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Emprequest','','images/requestclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/requestclick.jpg" alt="Emprequest" name="Emprequest" width="88" height="31" border="0"></a><a href="Empnotify.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('empNotification','','images/notificationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/notification.jpg" alt="empNotification" name="empNotification" width="96" height="29" border="0"></a> 
                  </div></td>
              </tr>
            </table></td>
        </tr>
        <tr bgcolor="#E9F3FE"> 
          <td height="8" colspan="2"><div align="center">Welcome <strong><? echo $_SESSION['strLoginName']; ?></strong>. 
              You are currently working at the Employee Module.</div></td>
        </tr>
        <tr valign="top" bgcolor="#E9F3FE"> 
          <td height="328" colspan="2"><table width="100%" height="313" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="16%" height="313"><table width="150" height="228" border="0" cellpadding="0" cellspacing="0" bgcolor="#E9F3FE">
                    <tr> 
                      <td height="228" valign="top"><table width="100%" height="313" border="0" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td height="313" valign="top"><table width="90%" height="338" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#C1E2FF" id="NAVTBL">
                                <tr> 
                                  <td height="338" valign="top"><table width="108" height="59" border="0" align="center" cellpadding="0" cellspacing="0" id="NAVTBL">
                                      <tr> 
                                        <td height="13"><a href="EmpOB.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('EmpOB','','images/officialbusiness2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/officialbusiness.jpg" alt="EmpOB" name="EmpOB" width="108" height="20" border="0"></a></td>
                                      </tr>
									  <?
									  if($arrEmpPersonal["leaveEntitled"] == 'Y')
									  { 
									  ?>
                                      <tr> 
                                        <td height="20"><a href="Empleave.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('empLeaveRequest','','images/leaverequest2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/leaverequest.jpg" alt="empLeaveRequest" name="empLeaveRequest" width="108" height="20" border="0"></a></td>
                                      </tr>
									  <?
									  }
									  ?>
									  <tr> 
                                        <td><a href="EmpTO.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('travelorder','','images/travelorder2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/travelorder.jpg" alt="travelorder" name="travelorder" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Emp201update.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('201update','','images/201update2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/201update.jpg" alt="201update" name="201update" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td><a href="Empreport.php?strEmpNmbr=<? echo $arrEmpPersonal['empNumber']; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Empreports','','images/reports2-navigation.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/reports-navigation.jpg" alt="Empreports" name="Empreports" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr>
                                        <td><a href="index.php" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('logout','','images/logout2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/logout.jpg" alt="logout" name="logout" width="108" height="20" border="0"></a></td>
                                      </tr>
                                    </table></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
                <td width="84%" valign="top"><table width="99%" height="338" border="0" cellpadding="0" cellspacing="0" bgcolor="#C1E2FF" id="BODYTBL">
                    <tr> 
                      <td height="338"> <!-- InstanceBeginEditable name="Body" -->
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td height="22" class="header"><p>UPDATE 201</p></td>
                                </tr>
                                <tr> 
                                  <td height="12" class="header">
</td>
                                </tr>
                                <tr> 
                                  <td> 
								  <form action="<? $PHP_SELF; ?>" name="frmEmp201" method="post"> 
                                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr> 
                                          <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="border">
                                              <tr> 
                                                <td width="480" height="73"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#99CCFF">
                                                    <tr> 
                                                      <td width="141" class="paragraph">Employee 
                                                        Number : </td>
                                                      <td width="339"><strong>&nbsp;<? echo $arrEmpPersonal['empNumber']; ?> 
                                                        <input name="txtSearch" type="hidden" value="<? echo $txtSearch; ?>">
                                                        <input name="optField" type="hidden" value="<? echo $optField; ?>">
                                                        <input name="t_strEmpNumber" type="hidden" value="<? echo $arrEmpPersonal["empNumber"]; ?>">
                                                        <input name="p" type="hidden" value="<? echo $p; ?>">
                                                        </strong></td>
                                                    </tr>
                                                    <tr> 
                                                      <td class="paragraph">Employee 
                                                        Name : </td>
                                                      <td><strong>&nbsp;<? echo $arrEmpPersonal['surname']  . ", " . $arrEmpPersonal['firstname'] . "  ". $arrEmpPersonal['middlename']; ?></strong></td>
                                                    </tr>
                                                    <tr> 
                                                      <td class="paragraph">Division 
                                                        : </td>
                                                      <td><strong>&nbsp;<? echo $arrEmpPersonal['divisionCode']; ?></strong></td>
                                                    </tr>
                                                    <tr> 
                                                      <td class="paragraph">Division 
                                                        Head : </td>
                                                      <td><strong>&nbsp;<? echo $arrEmpPersonal['divisionHead'] . " - " . $arrEmpPersonal['divisionHeadTitle'] ; ?></strong></td>
                                                    </tr>
                                                  </table></td>
                                                <td width="72" bgcolor="#99CCFF"> 
                                                  <img src="Getdata.php?t_strEmpNumber=<? echo $arrEmpPersonal["empNumber"]; ?>"  width="70" height="70"></td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                        <tr> 
                                          <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr> 
                                                <td><hr></td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                        <tr> 
                                          <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr> 
                                                <td> 
                                                  <? 
												if ($Submit == 'Submit') 
												{
													echo "Your 201 update request has been submitted.";
												?>
                                                </td>
                                              </tr>
                                              <tr> 
                                                <td>&nbsp;</td>
                                              </tr>
                                              <tr> 
                                                <td> 
                                                  <?
												} else {
												?>
                                                </td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                        <tr> 
                                          <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr> 
                                                <td width="30%" class="paragraph">Type 
                                                  of Profile : </td>
                                                <td width="70%"> <select name="t_strEmpProfile" size="1" onChange="updateRequirement();">
                                                    <option>Select Personal Data 
                                                    ...</option>
                                                    <?
													if($t_strEmpProfile=="Profile")
													{
													?>
                                                    <option value="Profile" selected>Profile</option>
                                                    <?
													}else
													{
													?>
                                                    <option value="Profile">Profile</option>
                                                    <?
													}
													?>
                                                    <? 
													if($t_strEmpProfile=="Education")
													{
													?>
                                                    <option value="Education" selected>Educational 
                                                    Attainment</option>
                                                    <?
													} else 
													{
													?>
                                                    <option value="Education">Educational 
                                                    Attainment</option>
                                                    <?
													}
													?>
                                                    <?
													if($t_strEmpProfile=="Training")
													{
													?>
                                                    <option value="Training" selected>Trainings</option>
                                                    <?
													} else
													{
													?>
                                                    <option value="Training">Trainings</option>
                                                    <?
													}
													?>
                                                    <?
													if ($t_strEmpProfile=="Examination")
													{
													?>
                                                    <option value="Examination" selected>Examinations</option>
                                                    <?
													} else
													{
													?>
                                                    <option value="Examination">Examinations</option>
                                                    <?
													}
													?>
                                                    <?
													if ($t_strEmpProfile=="Children")
													{
													?>
                                                    <option value="Children" selected>Children</option>
                                                    <?
													} else
													{
													?>
                                                    <option value="Children">Children</option>
                                                    <?
													}
													?>
                                                    <?
													if ($t_strEmpProfile=="Tax")
													{
													?>
                                                    <option value="Tax" selected>Community 
                                                    Tax Certificate</option>
                                                    <?
													} else
													{
													?>
                                                    <option value="Tax">Community 
                                                    Tax Certificate</option>
                                                    <?
													}
													?>
                                                    <?
													if ($t_strEmpProfile=="Reference") 
													{
													?>
                                                    <option value="Reference" selected>References</option>
                                                    <?
													} else {
													?>
                                                    <option value="Reference">References</option>
                                                    <?
													}
													?>
                                                    <?
													if ($t_strEmpProfile=="Voluntary") 
													{
													?>
                                                    <option value="Voluntary" selected>Voluntary 
                                                    Works</option>
                                                    <?
													} else {
													?>
                                                    <option value="Voluntary">Voluntary 
                                                    Works</option>
                                                    <?
													}
													?>
                                                  </select> <strong> </strong> 
                                                  <strong> 
                                                  <input name="strEmpNmbr" type="hidden" value="<? echo $strEmpNmbr; ?>">
                                                  </strong> </td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                        <tr> 
                                          <td>&nbsp;</td>
                                        </tr>
                                        <tr> 
                                          <td> 
                                            <? //Trainings/Seminars 
if ($t_strEmpProfile == 'Training') 
{
?>
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr class="title"> 
                                                <td colspan="2"> 
                                                  <!-- Trainings/Seminars -->
                                                </td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2">&nbsp;</td>
                                              </tr>
                                              <tr> 
                                                <td width="30%" class="paragraph" height="25"><strong> 
                                                  </strong> <input name="t_strTrainingRequestCode" type="hidden" value="<? echo $t_strTrainingRequestCode;  ?>">
                                                  Training Title :</td>
                                                <td width="70%"> 
                                                  <?php 
										$result = mysql_query ("SELECT trainingCode, trainingTitle FROM tblTraining");
										echo "<SELECT NAME=\"t_strTrainingCode\">\r";
										if ($row = mysql_fetch_array($result)) {
										do {
											if ($t_strTrainingTitle == $row["trainingCode"])
											{
												print "<OPTION VALUE=\"".strtoupper($row["trainingCode"])."\" selected>".strtoupper($row["trainingTitle"])."\r";
											}
										  print "<OPTION VALUE=\"".strtoupper($row["trainingCode"])."\">".strtoupper($row["trainingTitle"])."\r";
										} while($row = mysql_fetch_array($result));
										} else {print "no results!";}
										echo "</SELECT>\r";
										?>
                                                  <input name="t_strOldTrainingCode" type="hidden" value="<? echo $t_strTrainingCode; ?>"> 
                                                </td>
                                              </tr>
                                              <tr> 
                                                <td class="paragraph" height="25">Number 
                                                  of Hours :</td>
                                                <td><input name="t_intTrainingHours" type="text" size="10" maxlength="4"> 
                                                  <input name="t_strOldEmpNumber" type="hidden" value="<? echo $arrEmpPersonal['empNumber']; ?>"> 
                                                  <span class="required">*</span></td>
                                              </tr>
                                              <tr> 
                                                <td class="paragraph" height="25">Venue 
                                                  :</td>
                                                <td><input name="t_strTrainingVenue" type="text" size="50" maxlength="50"> 
                                                  <span class="required">*</span></td>
                                              </tr>
                                              <tr> 
                                                <td class="paragraph" height="25">Conducted 
                                                  By :</td>
                                                <td><input name="t_strTrainingConductedBy" type="text" size="50" maxlength="50"> 
                                                  <span class="required">*</span></td>
                                              </tr>
                                              <tr> 
                                                <td class="paragraph" height="25">Cost 
                                                  :</td>
                                                <td><input name="t_intTrainingCost" type="text" size="15" maxlength="10"> 
                                                  <span class="required">*</span></td>
                                              </tr>
                                              <tr> 
                                                <td class="paragraph" height="25">Contract 
                                                  Dates :</td>
                                                <td> <select name="t_dtmTrainingContractYear" size="1" onChange="updateList(t_dtmTrainingContractMonth.selectedIndex,this[this.selectedIndex].text,'t_dtmTrainingContractDay')">
                                                    <?
													$objEmp201Update->comboYearOld(date('Y'));
												   	?>
                                                  </select> <select name="t_dtmTrainingContractMonth" size="1" onChange="updateList(this.selectedIndex,t_dtmTrainingContractYear[t_dtmTrainingContractYear.selectedIndex].text,'t_dtmTrainingContractDay')">
                                                    <?
													$objEmp201Update->comboMonth(date('n'));
													?>
                                                  </select> <select name="t_dtmTrainingContractDay" size="1">
                                                    <?
													$objEmp201Update->comboDay(date('j'));
													?>
                                                  </select></td>
                                              </tr>
                                              <tr> 
                                                <td class="paragraph" height="25">Start 
                                                  Date :</td>
                                                <td><select name="t_dtmTrainingStartYear" size="1" onChange="updateList(t_dtmTrainingStartMonth.selectedIndex,this[this.selectedIndex].text,'t_dtmTrainingStartDay')">
                                                    <?
										$objEmp201Update->comboYearOld(date('Y'));
									   ?>
                                                  </select> <select name="t_dtmTrainingStartMonth" size="1" onChange="updateList(this.selectedIndex,t_dtmTrainingStartYear[t_dtmTrainingStartYear.selectedIndex].text,'t_dtmTrainingStartDay')">
                                                    <?
										$objEmp201Update->comboMonth(date('n'));
										?>
                                                  </select> <select name="t_dtmTrainingStartDay" size="1">
                                                    <?
										$objEmp201Update->comboDay(date('j'));
										?>
                                                  </select> </td>
                                              </tr>
                                              <tr> 
                                                <td class="paragraph" height="25">End 
                                                  Date :</td>
                                                <td> <select name="t_dtmTrainingEndYear" size="1" onChange="updateList(t_dtmTrainingEndMonth.selectedIndex,this[this.selectedIndex].text,'t_dtmTrainingEndDay')">
                                                    <?
										$objEmp201Update->comboYearOld(date('Y'));
									   ?>
                                                  </select> <select name="t_dtmTrainingEndMonth" size="1" onChange="updateList(this.selectedIndex,t_dtmTrainingEndYear[t_dtmTrainingEndYear.selectedIndex].text,'t_dtmTrainingEndDay')">
                                                    <?
										$objEmp201Update->comboMonth(date('n'));
										?>
                                                  </select> <select name="t_dtmTrainingEndDay" size="1">
                                                    <?
										$objEmp201Update->comboDay(date('j'));
										?>
                                                  </select>
                                                  <input name="t_strRequestStatus" type="hidden" id="t_strRequestStatus" value="<? echo "Filed Request"; ?>"></td>
                                              </tr>
                                              <tr> 
                                                <td class="paragraph">&nbsp;</td>
                                                <td>&nbsp;</td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2"> <div align="justify"></div></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2"><div align="center"><strong> 
                                                    <input name="t_dtmStatusDate" type="hidden" value="<? echo date("Y-m-d"); ?>">
                                                    </strong> 
                                                    <input name="Submit" type="submit" value="Submit" onClick="trapEntryTraining();return validateTrainings()">
                                                    <input name="Reset" type="reset" value="Clear">
                                                  </div></td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                        <tr> 
                                          <td> 
                                            <? //Examinations  
	} elseif ($t_strEmpProfile == 'Examination') 
	{
?>
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr class="title"> 
                                                <td colspan="2"> 
                                                  <!-- Examinations -->
                                                </td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2">&nbsp;</td>
                                              </tr>
                                              <tr> 
                                                <td width="30%" class="paragraph" height="25"><strong> 
                                                  </strong> <input name="t_strExamRequestCode" type="hidden" value="<? echo $t_strExamRequestCode; ?>">
                                                  Exam Type :</td>
                                                <td width="70%"> 
                                                  <?php 
										$result = mysql_query ("SELECT examCode, examDesc FROM tblExamType");
										echo "<SELECT NAME=\"t_strExamCode\">\r";
										if ($row = mysql_fetch_array($result)) {
										do {
											if ($t_strExamDesc == $row["examCode"])
											{
												print "<OPTION VALUE=\"".strtoupper($row["examCode"])."\" selected>".strtoupper($row["examDesc"])."\r";
											}
										  print "<OPTION VALUE=\"".strtoupper($row["examCode"])."\">".strtoupper($row["examDesc"])."\r";
										} while($row = mysql_fetch_array($result));
										} else {print "no results!";}
										echo "</SELECT>\r";
										?>
                                                  <input name="t_strOldExamCode" type="hidden" value="<? echo $t_strExamCode; ?>"></td>
                                              </tr>
                                              <tr> 
                                                <td class="paragraph" height="25">Place 
                                                  of Exam/Conferment :</td>
                                                <td><input name="t_strExamPlace" type="text" size="25" maxlength="50"> 
                                                  <span class="required">*</span></td>
                                              </tr>
                                              <tr> 
                                                <td class="paragraph" height="25">Ratings 
                                                  :</td>
                                                <td><input name="t_intExamRating" type="text" size="10" maxlength="5" onBlur="validateRate(this)">
                                                  % <span class="required">*</span></td>
                                              </tr>
                                              <tr> 
                                                <td class="paragraph" height="25">Date 
                                                  of Exam/Conferment : </td>
                                                <td><select name="t_dtmExamYear" size="1" onChange="updateList(t_dtmExamMonth.selectedIndex,this[this.selectedIndex].text,'t_dtmExamDay')">
                                                    <?
										$objEmp201Update->comboYearOld(date('Y'));
									   ?>
                                                  </select> <select name="t_dtmExamMonth" size="1" onChange="updateList(this.selectedIndex,t_dtmExamYear[t_dtmExamYear.selectedIndex].text,'t_dtmExamDay')">
                                                    <?
										$objEmp201Update->comboMonth(date('n'));
										?>
                                                  </select> <select name="t_dtmExamDay" size="1">
                                                    <?
										$objEmp201Update->comboDay(date('j'));
										?>
                                                  </select> </td>
                                              </tr>
                                              <tr> 
                                                <td class="paragraph" height="25">License 
                                                  No. (if applicable) : </td>
                                                <td><input name="t_strLicenseNumber" type="text" size="20" maxlength="20"></td>
                                              </tr>
                                              <tr> 
                                                <td class="paragraph" height="25">Date 
                                                  of Release : </td>
                                                <td><select name="t_dtmDateReleaseYear" size="1"  onChange="updateList(t_dtmDateReleaseMonth.selectedIndex,this[this.selectedIndex].text,'t_dtmDateReleaseDay')">
                                                    <option></option>
                                                    <?
										$objEmp201Update->comboYearOld(date('Y'));
									   ?>
                                                  </select> <select name="t_dtmDateReleaseMonth" size="1"  onChange="updateList(this.selectedIndex,t_dtmDateReleaseYear[t_dtmDateReleaseYear.selectedIndex].text,'t_dtmDateReleaseDay')">
                                                    <option></option>
                                                    <?
										$objEmp201Update->comboMonth(date('n'));
										?>
                                                  </select> <span class="paragraph"> 
                                                  </span> <select name="t_dtmDateReleaseDay" size="1">
                                                    <option></option>
                                                    <?
										$objEmp201Update->comboDay(date('j'));
										?>
                                                  </select>
                                                  <input name="t_strRequestStatus" type="hidden" id="t_strRequestStatus" value="<? echo "Filed Request"; ?>"> 
                                                </td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2"> <div align="justify"></div></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2">&nbsp;</td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2"><div align="center"><strong> 
                                                    <input name="t_dtmStatusDate" type="hidden" value="<? echo date("Y-m-d"); ?>">
                                                    </strong> 
                                                    <input name="Submit" type="submit" value="Submit" onClick="trapEntryExamination();return validateExam();">
                                                    <input name="Reset" type="reset" value="Clear">
                                                  </div></td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                        <tr> 
                                          <td> 
                                            <? //Educational Attainment 
   	} elseif ($t_strEmpProfile == 'Education') 
	{
?>
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr class="title"> 
                                                <td colspan="2"> 
                                                  <!-- Educational Attainment -->
                                                </td>
                                              </tr>
                                              <tr class="note"> 
                                                <td colspan="2">&nbsp;</td>
                                              </tr>
                                              <tr> 
                                                <td width="26%" class="paragraph" height="25"><input name="t_strEducationRequestCode" type="hidden" value="<? echo $t_strEducationRequestCode; ?>">
                                                  Level Description :</td>
                                                <td width="74%"> 
                                                  <?php 
										$result = mysql_query ("SELECT levelCode, levelDesc FROM tblEducationalLevel");
										echo "<SELECT NAME=\"t_strLevelCode\">\r";
										if ($row = mysql_fetch_array($result)) {
										do {
											if ($t_strLevelDesc == $row["levelCode"])
											{
												print "<OPTION VALUE=\"".strtoupper($row["levelCode"])."\" selected>".strtoupper($row["levelDesc"])."\r";
											}
										  print "<OPTION VALUE=\"".strtoupper($row["levelCode"])."\">".strtoupper($row["levelDesc"])."\r";
										} while($row = mysql_fetch_array($result));
										} else {print "no results!";}
										echo "</SELECT>\r";
										?>
                                                  <input name="t_strOldLevelCode" type="hidden" value="<? echo $t_strLevelCode; ?>"></td>
                                              </tr>
                                              <tr> 
                                                <td class="paragraph" height="25">School 
                                                  Name : </td>
                                                <td><input name="t_strSchoolName" type="text" size="60" maxlength="80"> 
                                                  <span class="required">*</span></td>
                                              </tr>
                                              <tr> 
                                                <td class="paragraph" height="25">Course 
                                                  : </td>
                                                <td><input name="t_strCourse" type="text" size="50" maxlength="50"> 
                                                  <span class="required">*(write 
                                                  n-a if not-applicable)</span></td>
                                              </tr>
                                              <tr> 
                                                <td class="paragraph" height="25">Units 
                                                  Earned :</td>
                                                <td><input name="t_intUnits" type="text" size="20" maxlength="10" onBlur="validateUnit(this)">
                                                  <span class="required">*(write 
                                                  0 if not-applicable)</span> 
                                                </td>
                                              </tr>
                                              <tr> 
                                                <td class="paragraph" height="25">Honors 
                                                  : </td>
                                                <td><input name="t_strHonors" type="text" size="60" maxlength="80"> 
                                                </td>
                                              </tr>
                                              <tr> 
                                                <td class="paragraph" height="25">Date 
                                                  From :</td>
                                                <td><select name="t_dtmSchoolFromYear" size="1" onChange="updateList(t_dtmSchoolFromMonth.selectedIndex,this[this.selectedIndex].text,'t_dtmSchoolFromDay')">
                                                    <?
										$objEmp201Update->comboYearOld(date('Y'));
									   ?>
                                                  </select> <select name="t_dtmSchoolFromMonth" size="1" onChange="updateList(this.selectedIndex,t_dtmSchoolFromYear[t_dtmSchoolFromYear.selectedIndex].text,'t_dtmSchoolFromDay')">
                                                    <?
										$objEmp201Update->comboMonth(date('n'));
										?>
                                                  </select> <select name="t_dtmSchoolFromDay" size="1">
                                                    <?
										$objEmp201Update->comboDay(date('j'));
										?>
                                                  </select> </td>
                                              </tr>
                                              <tr> 
                                                <td class="paragraph" height="25">Date 
                                                  To :</td>
                                                <td><select name="t_dtmSchoolToYear" size="1" onChange="updateList(t_dtmSchoolToMonth.selectedIndex,this[this.selectedIndex].text,'t_dtmSchoolToDay')">
                                                    <?
										$objEmp201Update->comboYearOld(date('Y'));
									   ?>
                                                  </select> <select name="t_dtmSchoolToMonth" size="1" onChange="updateList(this.selectedIndex,t_dtmSchoolToYear[t_dtmSchoolToYear.selectedIndex].text,'t_dtmSchoolToDay')">
                                                    <?
										$objEmp201Update->comboMonth(date('n'));
										?>
                                                  </select> <select name="t_dtmSchoolToDay" size="1">
                                                    <?
										$objEmp201Update->comboDay(date('j'));
										?>
                                                  </select>
                                                  <input name="t_strRequestStatus" type="hidden" id="t_strRequestStatus3" value="<? echo "Filed Request"; ?>"> 
                                                </td>
                                              </tr>
                                              <tr> 
                                                <td class="paragraph">&nbsp;</td>
                                                <td>&nbsp;</td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2"> <div align="justify"></div>
                                                  <div align="center"> </div></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2"><div align="center"><strong> 
                                                    <input name="t_dtmStatusDate" type="hidden" value="<? echo date("Y-m-d"); ?>">
                                                    </strong> 
                                                    <input name="Submit" type="submit" value="Submit" onClick="trapEntrySchool();return validateSchool();">
                                                    <input name="Reset" type="reset" value="Clear">
                                                  </div></td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                        <tr> 
                                          <td> 
                                            <? //Community Tax Certificate 
	} elseif ($t_strEmpProfile == 'Tax') 
	{ 
?>
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr class="title"> 
                                                <td colspan="2"> 
                                                  <!-- Community Tax Certificate -->
                                                </td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2">&nbsp;</td>
                                              </tr>
                                              <tr> 
                                                <td width="31%" class="paragraph" height="25"><input name="t_strTaxRequestCode" type="hidden" value="<? echo $t_strTaxRequestCode; ?>">
                                                  Tax Certificate Number :</td>
                                                <td width="69%"><input name="t_strTaxCertNmbr" type="text" size="25" maxlength="10"> 
                                                  <span class="required">*</span></td>
                                              </tr>
                                              <tr> 
                                                <td class="paragraph" height="25">Issued 
                                                  At : </td>
                                                <td><input name="t_strIssuedAt" type="text" size="25" maxlength="25"> 
                                                  <span class="required">*</span></td>
                                              </tr>
                                              <tr> 
                                                <td class="paragraph" height="25">Issued 
                                                  On :</td>
                                                <td><select name="t_dtmIssuedOnYear" size="1"onChange="updateList(t_dtmIssuedOnMonth.selectedIndex,this[this.selectedIndex].text,'t_dtmIssuedOnDay')">
                                                    <?
										$objEmp201Update->comboYear(date('Y'));
									   ?>
                                                  </select> <select name="t_dtmIssuedOnMonth" size="1" onChange="updateList(this.selectedIndex,t_dtmIssuedOnYear[t_dtmIssuedOnYear.selectedIndex].text,'t_dtmIssuedOnDay')">
                                                    <?
										$objEmp201Update->comboMonth(date('n'));
										?>
                                                  </select> <select name="t_dtmIssuedOnDay" size="1">
                                                    <?
										$objEmp201Update->comboDay(date('j'));
										?>
                                                  </select>
                                                  <input name="t_strRequestStatus" type="hidden" id="t_strRequestStatus4" value="<? echo "Filed Request"; ?>"> 
                                                </td>
                                              </tr>
                                              <tr> 
                                                <td class="paragraph">&nbsp;</td>
                                                <td>&nbsp;</td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2"> <div align="justify"></div></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2"><div align="center"><strong> 
                                                    <input name="t_dtmStatusDate" type="hidden" value="<? echo date("Y-m-d"); ?>">
                                                    </strong> 
                                                    <input name="Submit" type="submit" value="Submit" onClick="return validateTax()">
                                                    <input name="Reset" type="reset" value="Clear">
                                                  </div></td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                        <tr> 
                                          <td> 
                                            <? //References
	} elseif ($t_strEmpProfile == 'Reference') 
	{ 	
?>
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr class="title"> 
                                                <td colspan="2"> 
                                                  <!-- References -->
                                                </td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2">&nbsp;</td>
                                              </tr>
                                              <tr> 
                                                <td class="paragraph"><strong> 
                                                  </strong> <strong> </strong> 
                                                  <input name="t_strRefRequestCode" type="hidden" value="<? echo $t_strRefRequestCode; ?>">
                                                  Name :</td>
                                                <td width="70%"><input name="t_strRefName" type="text" size="50" maxlength="80"> 
                                                  <span class="note">*</span> 
                                                </td>
                                              </tr>
                                              <tr> 
                                                <td class="paragraph">Address 
                                                  :</td>
                                                <td><textarea name="t_strRefAddress" cols="30"></textarea> 
                                                  <span class="note">*</span></td>
                                              </tr>
                                              <tr> 
                                                <td class="paragraph">Telephone 
                                                  Number : </td>
                                                <td width="70%"><input name="t_intRefTelephone" type="text" size="25" maxlength="12">
                                                  <span class="note">*
                                                  <input name="t_strRequestStatus" type="hidden" id="t_strRequestStatus5" value="<? echo "Filed Request"; ?>">
                                                  </span></td>
                                              </tr>
                                              <tr> 
                                                <td class="paragraph">&nbsp;</td>
                                                <td>&nbsp;</td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2"> <div align="justify"></div></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2"><div align="center"><strong> 
                                                    <input name="t_dtmStatusDate" type="hidden" value="<? echo date("Y-m-d"); ?>">
                                                    </strong> 
                                                    <input name="Submit" type="submit" value="Submit" onClick="return validateReference()">
                                                    <input name="Reset" type="reset" value="Clear">
                                                  </div></td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                        <tr> 
                                          <td> 
                                            <? //Children
	} elseif ($t_strEmpProfile == 'Children') 
	{ 
?>
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr class="title"> 
                                                <td colspan="2"> 
                                                  <!-- Children -->
                                                </td>
                                              </tr>
                                              <tr> 
                                                <td height="15" colspan="2">&nbsp;</td>
                                              </tr>
                                              <tr> 
                                                <td width="30%" class="paragraph" height="25"><input name="t_strChildRequestCode" type="hidden" value="<? echo $t_strChildRequestCode; ?>">
                                                  Name of Children :</td>
                                                <td width="70%"><input name="t_strChildName" type="text" size="30" maxlength="50"> 
                                                  <span class="required">*</span></td>
                                              </tr>
                                              <tr> 
                                                <td class="paragraph" height="25">Date 
                                                  of Birth :</td>
                                                <td><select name="t_strChildBirthYear" size="1" onChange="updateList(t_strChildBirthMonth.selectedIndex,this[this.selectedIndex].text,'t_strChildBirthDay')">
                                                    <?
										$objEmp201Update->comboYearChildren(date('Y'));
									   ?>
                                                  </select> <select name="t_strChildBirthMonth" size="1" onChange="updateList(this.selectedIndex,t_strChildBirthYear[t_strChildBirthYear.selectedIndex].text,'t_strChildBirthDay')">
                                                    <?
										$objEmp201Update->comboMonth(date('n'));
										?>
                                                  </select> <select name="t_strChildBirthDay" size="1">
                                                    <?
										$objEmp201Update->comboDay(date('j'));
										?>
                                                  </select>
                                                  <input name="t_strRequestStatus" type="hidden" id="t_strRequestStatus6" value="<? echo "Filed Request"; ?>"> 
                                                </td>
                                              </tr>
                                              <tr> 
                                                <td class="paragraph">&nbsp;</td>
                                                <td>&nbsp;</td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2"> <div align="justify"></div></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2"><div align="center"><strong> 
                                                    <input name="t_dtmStatusDate" type="hidden" value="<? echo date("Y-m-d"); ?>">
                                                    </strong> 
                                                    <input name="Submit" type="submit" value="Submit" onClick="return validateChild()">
                                                    <input name="Reset" type="reset" value="Clear">
                                                  </div></td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                        <tr> 
                                          <td> 
                                            <? //VoluntaryWorks
	} elseif ($t_strEmpProfile == 'Voluntary') 
	{
?>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr class="title"> 
                                                <td colspan="2"> 
                                                  <!-- Children -->
                                                </td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2">&nbsp;</td>
                                              </tr>
                                              <tr> 
                                                <td class="paragraph">Name of 
                                                  Organization :</td>
                                                <td><input name="t_strVWName" type="text" size="50" maxlength="50"> 
                                                  <span class="required">*</span></td>
                                              </tr>
                                              <tr> 
                                                <td class="paragraph">Address 
                                                  :</td>
                                                <td><textarea name="t_strVWAddress"></textarea> 
                                                  <span class="required">*</span></td>
                                              </tr>
                                              <tr> 
                                                <td class="paragraph">Inclusive 
                                                  Date From :</td>
                                                <td><select name="t_dtmVWDateFromYear" size="1" onChange="updateList(t_dtmVWDateFromMonth.selectedIndex,this[this.selectedIndex].text,'t_dtmVWDateFromDay')">
                                                    <?
											$objEmp201Update->comboYearOld(date('Y'));
									   		?>
                                                  </select> <select name="t_dtmVWDateFromMonth" size="1" onChange="updateList(this.selectedIndex,t_dtmVWDateFromYear[t_dtmVWDateFromYear.selectedIndex].text,'t_dtmVWDateFromDay')">
                                                    <?
											$objEmp201Update->comboMonth(date('n'));
											?>
                                                  </select> <select name="t_dtmVWDateFromDay" size="1">
                                                    <?
											$objEmp201Update->comboDay(date('j'));
											?>
                                                  </select> </td>
                                              </tr>
                                              <tr> 
                                                <td class="paragraph">Inclusive 
                                                  Date To :</td>
                                                <td> <select name="t_dtmVWDateToYear" size="1" onChange="updateList(t_dtmVWDateToMonth.selectedIndex,this[this.selectedIndex].text,'t_dtmVWDateToDay')">
                                                    <?
											$objEmp201Update->comboYearOld(date('Y'));
										   	?>
                                                  </select> <select name="t_dtmVWDateToMonth" size="1" onChange="updateList(this.selectedIndex,t_dtmVWDateToYear[t_dtmVWDateToYear.selectedIndex].text,'t_dtmVWDateToDay')">
                                                    <?
											$objEmp201Update->comboMonth(date('n'));
											?>
                                                  </select> <select name="t_dtmVWDateToDay" size="1">
                                                    <?
											$objEmp201Update->comboDay(date('j'));
											?>
                                                  </select> </td>
                                              </tr>
                                              <tr> 
                                                <td class="paragraph">Number of 
                                                  Hours : </td>
                                                <td><input name="t_intVWHours" type="text" size="20" maxlength="6" onBlur="validateHours(this)"> 
                                                  <span class="required">*</span></td>
                                              </tr>
                                              <tr> 
                                                <td class="paragraph">Position 
                                                  / Nature of Work : </td>
                                                <td><input name="t_strVWPosition" type="text" size="30" maxlength="50">
                                                  <span class="required">*</span> 
                                                  <input name="t_strRequestStatus" type="hidden" id="t_strRequestStatus7" value="<? echo "Filed Request"; ?>"> 
                                                </td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2">&nbsp;</td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2"><div align="center"><strong> 
                                                    <input name="t_dtmStatusDate" type="hidden" id="t_dtmStatusDate"value="<? echo date("Y-m-d"); ?>">
                                                    </strong> 
                                                    <input name="Submit" type="submit" id="Submit" onClick="trapEntryVoluntary();return validateVoluntaryWorks()" value="Submit">
                                                    <input name="Reset" type="reset" id="Reset" value="Clear">
                                                  </div></td>
                                              </tr>
                                              <tr> 
                                                <td colspan="2">&nbsp;</td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                        <tr>
                                          <td>
                                            <? //Profile
	} elseif ($t_strEmpProfile == 'Profile') 
	{
?>
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr> 
                                                <td class="title"> 
                                                  <!-- Personal Data -->
                                                </td>
                                              </tr>
                                              <tr> 
                                                <td>&nbsp;</td>
                                              </tr>
                                              <tr> 
                                                <td> <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                    <tr> 
                                                      <td width="31%" height="25" class="paragraph"><input name="t_strProfileRequestCode" type="hidden" value="<? echo $t_strProfileRequestCode; ?>">
                                                        Surname : </td>
                                                      <td width="69%"><input name="t_strSurname" type="text" value="<? echo $arrEmpPersonal['surname'];  ?>" size="30" maxlength="50"> 
                                                        <span class="required"> 
                                                        *</span></td>
                                                    </tr>
                                                    <tr> 
                                                      <td width="31%" height="25" class="paragraph">First 
                                                        Name : </td>
                                                      <td><input name="t_strFirstname" type="text" disabled value="<? echo $arrEmpPersonal['firstname'];  ?>" size="30" maxlength="50"> 
                                                        <span class="required"> 
                                                        *</span></td>
                                                    </tr>
                                                    <tr> 
                                                      <td height="25" class="paragraph">Middle 
                                                        Name : </td>
                                                      <td><input name="t_strMiddlename" type="text" value="<? echo $arrEmpPersonal['middlename'];  ?>" size="30" maxlength="50"> 
                                                        <span class="required"> 
                                                        *</span></td>
                                                    </tr>
                                                    <tr> 
                                                      <td class="paragraph" height="25">Civil 
                                                        Status :</td>
                                                      <td> 
                                                        <? 
														$result=mysql_query("SELECT * FROM tblEmpPersonal WHERE empNumber = '$strEmpNmbr'");
														$row=mysql_fetch_array($result);
										  	$objEmp201Update->civilStatus("t_strCivilStatus", $row['civilStatus']);   
										  	?>
                                                      </td>
                                                    </tr>
                                                    <tr> 
                                                      <td class="paragraph" height="25">Weight 
                                                        (kg) :</td>
                                                      <td><input name="t_intWeight" type="text" value="<? echo $arrEmpPersonal['weight'];  ?>" size="10" maxlength="4"> 
                                                        <span class="note">*</span></td>
                                                    </tr>
                                                    <tr> 
                                                      <td class="paragraph" height="25">Residential 
                                                        : </td>
                                                      <td><textarea name="t_strResidentialAddress" cols="30"><? echo $arrEmpPersonal['residentialAddress'];  ?></textarea> 
                                                        <span class="note">*</span></td>
                                                    </tr>
                                                    <tr> 
                                                      <td class="paragraph" height="25">Zip 
                                                        Code :</td>
                                                      <td><input name="t_intZipCode1" type="text" value="<? echo $arrEmpPersonal['zipCode1']; ?>" size="10" maxlength="4"> 
                                                        <span class="note">*</span></td>
                                                    </tr>
                                                    <tr> 
                                                      <td class="paragraph" height="25">Telephone 
                                                        No. : </td>
                                                      <td><input name="t_intTelephone1" type="text" value="<? echo $arrEmpPersonal['telephone1']; ?>" size="20" maxlength="7">
                                                      </td>
                                                    </tr>
                                                    <tr> 
                                                      <td class="paragraph" height="25">Permanent 
                                                        Address :</td>
                                                      <td><textarea name="t_strPermanentAddress" cols="30"><? echo $arrEmpPersonal['permanentAddress'];  ?></textarea> 
                                                        <span class="note">*</span></td>
                                                    </tr>
                                                    <tr> 
                                                      <td class="paragraph" height="25">ZipCode 
                                                        : </td>
                                                      <td><input name="t_intZipCode2" type="text" value="<? echo $arrEmpPersonal['zipCode2']; ?>" size="10" maxlength="4"> 
                                                        <span class="note">*</span></td>
                                                    </tr>
                                                    <tr> 
                                                      <td class="paragraph" height="25">Telephone 
                                                        No. :</td>
                                                      <td><input name="t_intTelephone2" type="text" value="<? echo $arrEmpPersonal['telephone2']; ?>" size="20" maxlength="7">
                                                      </td>
                                                    </tr>
                                                    <tr> 
                                                      <td class="paragraph" height="25">Email 
                                                        Address (if any) : </td>
                                                      <td> <input name="t_strEmail" type="text" value="<? echo $arrEmpPersonal['email'];  ?>" size="30" maxlength="30"> 
                                                        <span class="note">*</span></td>
                                                    </tr>
                                                    <tr> 
                                                      <td class="paragraph" height="25">Cellphone 
                                                        No. :</td>
                                                      <td><input name="t_intMobile" type="text" value="<? echo $arrEmpPersonal['mobile'];  ?>" size="20" maxlength="11">
                                                      </td>
                                                    </tr>
                                                    <tr> 
                                                      <td class="paragraph" height="25">Name 
                                                        of Spouse :</td>
                                                      <td><input name="t_strSpouse" type="text" value="<? echo $arrEmpPersonal['spouse'];  ?>" size="30" maxlength="50"> 
                                                      </td>
                                                    </tr>
                                                    <tr> 
                                                      <td class="paragraph" height="25">Occupation 
                                                        : </td>
                                                      <td><input name="t_strSpouseWork" type="text" value="<? echo $arrEmpPersonal['spouseWork'];  ?>" size="30" maxlength="50"> 
                                                      </td>
                                                    </tr>
                                                    <tr> 
                                                      <td class="paragraph" height="25">Employer/Business 
                                                        Name :</td>
                                                      <td><input name="t_strSpouseBusName" type="text" value="<? echo $arrEmpPersonal['spouseBusName'];  ?>" size="30" maxlength="50"> 
                                                      </td>
                                                    </tr>
                                                    <tr> 
                                                      <td class="paragraph" height="25">Business 
                                                        Address :</td>
                                                      <td><input name="t_strSpouseBusAddress" type="text" value="<? echo $arrEmpPersonal['spouseBusAddress'];  ?>" size="30" maxlength="50"> 
                                                      </td>
                                                    </tr>
                                                    <tr> 
                                                      <td class="paragraph" height="25">Telephone 
                                                        No. :</td>
                                                      <td><input name="t_intSpouseTelephone" type="text" value="<? echo $arrEmpPersonal['spouseTelephone']; ?>" size="20" maxlength="7">
                                                        <input name="t_strRequestStatus" type="hidden" id="t_strRequestStatus8" value="<? echo "Filed Request"; ?>"> 
                                                      </td>
                                                    </tr>
                                                    <tr> 
                                                      <td colspan="2" class="paragraph"><div align="center"></div></td>
                                                    </tr>
                                                    <tr> 
                                                      <td colspan="2" class="paragraph"><div align="center"><strong> 
                                                          <input name="t_dtmStatusDate" type="hidden"value="<? echo date("Y-m-d"); ?>">
                                                          </strong> 
                                                          <input name="Submit" type="submit" value="Submit" onClick="return validateProfile()">
                                                          <input name="Reset" type="reset" value="Clear">
                                                        </div></td>
                                                    </tr>
                                                  </table></td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                        <tr> 
                                          <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr> 
                                                <td> 
                                                  <? 
												}   // Endif ($Submit == 'Submit') 
												?>
                                                </td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                        <tr> 
                                          <td> 
                                            <? 
								  }   //End if
								  ?>
                                          </td>
                                        </tr>
                                        <tr> 
                                          <td>&nbsp;</td>
                                        </tr>
                                      </table>
                                    </form> 
									</td>
                                </tr>
                              </table></td>
                          </tr>
                        </table>
                        <!-- InstanceEndEditable --> </td>
                    </tr>
                  </table></td>
              </tr>
            </table> </td>
        </tr>
        <tr bgcolor="#E9F3FE"> 
          <td height="13" colspan="2"><table width="100%" height="12" border="0" cellpadding="0" cellspacing="0" bgcolor="#002E7F" id="OUTERTBL4">
              <tr> 
                <td height="12"><div align="center"> 
                    <p class="login"><font color="#FFFFFF">Copyright &copy; 2003 
                      Department of Science and Technology</font></p>
                  </div></td>
              </tr>
            </table>
          </td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
