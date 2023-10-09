<?
/* 
File Name: Report.php 
----------------------------------------------------------------------
Purpose of this file: 
print the reports of HR Officer.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco, Brian Jill DG. Sarandi, Donna Gay C. Reyes
----------------------------------------------------------------------
Date of Revision: July 15, 2004 (Version 2.0.0)
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

include("../hrmis/class/Security.php");
require("../hrmis/class/General.php");
$objReport = new General;
?>
<html><!-- InstanceBegin template="/Templates/Reportstmplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Human Resource Management Information System - HR Section</title>
<!-- InstanceEndEditable --> 
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
<!-- InstanceBeginEditable name="head" -->
<?
include("../hrmis/class/JSgeneral.php");
?>

<script language="JavaScript">
function openPrint()
{
	var strReport = document.all.cboReports.value;
	var intHeadFoot, strPage, intMonth, intYear;
	var intMonthFrom, intMonthTo, intYearFrom, intYearTo;
	var dtmDateToday = new Date();
	var intDateFlag = 0;

	try
	{
		var strEmpNmbr = document.all.cboEmpNmbr.value;
	}
	catch(error)
	{
	
	}
	
	try
	{
		var strEmpSelect = document.all.cboEmpSelected.value;
	}
	catch(error)
	{
	
	}

	try
	{
		var strDivSec = document.all.cboDivision.value;
	}
	catch(error)
	{
		try
		{
			var strDivSec = document.all.cboSection.value;
		}
		catch(error)
		{
			strDivSec = "";
		}
	}

	if(strReport == "DTR" || strReport == "PS" || strReport == "AS" || strReport == "LWOP" || strReport == "TR" || strReport == "MA" || strReport == "MCR" || strReport == "HPR")
	{
		intMonth = document.all.cboMonth.value;	
		intYear = document.all.cboYear.value;
		
		strPage = "ReportData.php?strEmpNmbr="+strEmpNmbr+"&strReports="+strReport+"&strEmpSelect="+strEmpSelect+"&strDivSec="+strDivSec+"&intMonth="+intMonth+"&intYear="+intYear;
		window.open(strPage, '_blank','toolbar=no,location=no,directories=no,status=0,menubar=0,scrollbars=1,resizable=0,width=780,height=528');
	}
	else if(strReport == "HYA" || strReport == "AAR" || strReport == "EAS" || strReport == "AFC")
	{
		intPeriod = document.all.cboPeriod.value;	
		intYear = document.all.cboYear.value;
		
		strPage = "ReportData.php?strEmpNmbr="+strEmpNmbr+"&strReports="+strReport+"&strEmpSelect="+strEmpSelect+"&strDivSec="+strDivSec+"&intPeriod="+intPeriod+"&intYear="+intYear;
		window.open(strPage, '_blank','toolbar=no,location=no,directories=no,status=0,menubar=0,scrollbars=1,resizable=0,width=780,height=528');
	}
	else if(strReport == "RPI" || strReport == "MRS" || strReport == "RMA")
	{
		intMonth = document.all.cboMonth.value;	
		intYear = document.all.cboYear.value;
		
		strPage = "HRMISReportData.php?strEmpNmbr="+strEmpNmbr+"&strReports="+strReport+"&strEmpSelect="+strEmpSelect+"&strDivSec="+strDivSec+"&intMonth="+intMonth+"&intYear="+intYear;
		window.open(strPage, '_blank','toolbar=no,location=no,directories=no,status=0,menubar=0,scrollbars=1,resizable=0,width=780,height=528');
	}
	else if(strReport == "CSCPCA")
	{
		strDivision = document.all.t_strDivision.value;
		strFundsSource = document.all.t_strFundsSource.value;
		strAppointAuthority = document.all.t_strAppointAuthority.value;
		strHeadCSCOfficer = document.all.t_strHeadCSCOfficer.value;
		
		strPage = "HRMISReportData.php?strEmpNmbr="+strEmpNmbr+"&strReports="+strReport+"&t_strDivision="+strDivision+"&t_strFundsSource="+strFundsSource+"&t_strAppointAuthority="+strAppointAuthority+"&t_strHeadCSCOfficer="+strHeadCSCOfficer;
		window.open(strPage, '_blank','toolbar=no,location=no,directories=no,status=0,menubar=0,scrollbars=1,resizable=0,width=780,height=528');
	}
	else if(strReport == "RPA" || strReport == "RCB" || strReport == "RLP")
	{
		intMonth = document.all.cboMonth.value;	
		intYear = document.all.cboYear.value;
		
		strPage = "HRMISReportData.php?strEmpNmbr="+strEmpNmbr+"&strReports="+strReport+"&strEmpSelect="+strEmpSelect+"&strDivSec="+strDivSec+"&intMonth="+intMonth+"&intYear="+intYear;
		window.open(strPage, '_blank','toolbar=no,location=no,directories=no,status=0,menubar=0,scrollbars=1,resizable=0,width=780,height=528');
	}
	else if(strReport == "RPE" || strReport == "RPDH" || strReport == "RPSG" || strReport == "RPBD" || strReport == "RPS" || strReport == "RPAGE" || strReport == "RPR" || strReport == "RPRS" || strReport == "EPD")
	{
		
		strPage = "HRMISReportData.php?strEmpNmbr="+strEmpNmbr+"&strReports="+strReport;
		window.open(strPage, '_blank','toolbar=no,location=no,directories=no,status=0,menubar=0,scrollbars=1,resizable=0,width=780,height=528');
	}
	else if(strReport == "RPP")
	{
		strAreaCode = document.all.t_strAreaCode.value;
		strAreaType = document.all.t_strAreaType.value;
		strAttribution = document.all.t_strAttribution.value;
		
		strPage = "HRMISReportData.php?strEmpNmbr="+strEmpNmbr+"&strReports="+strReport+"&t_strAreaCode="+strAreaCode+"&t_strAreaType="+strAreaType+"&t_strAttribution="+strAttribution;
		window.open(strPage, '_blank','toolbar=no,location=no,directories=no,status=0,menubar=0,scrollbars=1,resizable=0,width=780,height=528');
	}
	else if(strReport == "RPDF")
	{
		strAgencyName = document.all.t_strAgencyName.value;
		strBureau = document.all.t_strBureau.value;
		strWorkPlace = document.all.t_strWorkPlace.value;
		strItemNumber = document.all.t_strItemNumber.value;
		strPrevItemNumber = document.all.t_strPrevItemNumber.value;
		strDivision = document.all.t_strDivision.value;
		intOthers = document.all.t_intOthers.value;
		strWAPCO = document.all.t_strWAPCO.value;
		strSupervisor = document.all.t_strSupervisor.value;
		strNextSupervisor = document.all.t_strNextSupervisor.value;
		strPositionCode = document.all.t_strPositionCode.value;
		intAuthorizeSalary = document.all.t_intAuthorizeSalary.value;
		intAuthorizeSalaryYr = document.all.t_intAuthorizeSalaryYr.value;
		strWorkingTitle = document.all.t_strWorkingTitle.value;
		strWAPCO = document.all.t_strWAPCO.value;
		strNameTitleItem = document.all.t_strNameTitleItem.value;	
		strMachineTools = document.all.t_strMachineTools.value;
		intMonth = document.all.cboMonth.value;	
		intDay = document.all.cboDay.value;	
		intYear = document.all.cboYear.value;
		
		strPage = "HRMISReportData.php?strEmpNmbr="+strEmpNmbr+"&strReports="+strReport+"&strEmpSelect="+strEmpSelect+"&strDivSec="+strDivSec+"&intMonth="+intMonth+"&intDay="+intDay+"&intYear="+intYear+"&t_strAgencyName="+strAgencyName+"&t_strBureau="+strBureau+"&t_strWorkPlace="+strWorkPlace+"&t_strPrevItemNumber="+strPrevItemNumber+"&t_strDivision="+strDivision+"&t_intOthers="+intOthers+"&t_strWAPCO="+strWAPCO+"&t_strSupervisor="+strSupervisor+"&t_strNextSupervisor="+strNextSupervisor+"&t_strItemNumber="+strItemNumber+"&t_strPositionCode="+strPositionCode+"&t_intAuthorizeSalaryYr="+intAuthorizeSalaryYr+"&t_intAuthorizeSalary="+intAuthorizeSalary+"&t_strWorkingTitle="+strWorkingTitle+"&t_strWAPCO="+strWAPCO+"&t_strNameTitleItem="+strNameTitleItem+"&t_strMachineTools="+strMachineTools;
		window.open(strPage, '_blank','toolbar=no,location=no,directories=no,status=0,menubar=0,scrollbars=1,resizable=0,width=780,height=528');
	}
	else if(strReport == "RAF")
	{
		t_strPositionCode = document.all.t_strPositionCode.value;
		t_strAppointmentDesc = document.all.t_strAppointmentDesc.value;
		t_intActualSalary = document.all.t_intAuthorizeSalary.value;
		t_strAppointmentReason = document.all.t_strAppointmentReason.value;
		t_strEmpFullName = document.all.t_strEmpFullName.value;
		t_strSeparationCause = document.all.t_strSeparationCause.value;
		t_strItemNumber = document.all.t_strItemNumber.value;
		t_intPlantillaPageNumber = document.all.t_intPlantillaPageNumber.value;
		t_strCSCMCNumber = document.all.t_strCSCMCNumber.value;
		t_strPublishedWhere = document.all.t_strPublishedWhere.value;
		intMonth = document.all.cboMonth.value;	
		intDay = document.all.cboDay.value;	
		intYear = document.all.cboYear.value;
		strEmpNmbr = document.all.cboEmpNmbr.value;
		
		strPage = "HRMISReportData.php?strEmpNmbr="+strEmpNmbr+"&strReports="+strReport+"&strEmpSelect="+strEmpSelect+"&strDivSec="+strDivSec+"&t_strPositionCode="+t_strPositionCode+"&t_strAppointmentDesc="+t_strAppointmentDesc+"&t_intActualSalary="+t_intActualSalary+"&t_strAppointmentReason="+t_strAppointmentReason+"&t_strEmpFullName="+t_strEmpFullName+"&t_strSeparationCause="+t_strSeparationCause+"&t_strItemNumber="+t_strItemNumber+"&t_intPlantillaPageNumber="+t_intPlantillaPageNumber+"&t_strCSCMCNumber="+t_strCSCMCNumber+"&t_strPublishedWhere="+t_strPublishedWhere+"&intMonth="+intMonth+"&intDay="+intDay+"&intYear="+intYear; 
		
		window.open(strPage, '_blank','toolbar=no,location=no,directories=no,status=0,menubar=0,scrollbars=1,resizable=0,width=780,height=528');
	}
	else if(strReport == "AL" || strReport == "PRO" || strReport == "OB" || strReport == "TO")
	{
		intMonth = document.all.cboMonth.value;
		intDay = document.all.cboDay.value;	
		intYear = document.all.cboYear.value;
		
		strPage = "ReportData.php?strEmpNmbr="+strEmpNmbr+"&strReports="+strReport+"&strEmpSelect="+strEmpSelect+"&strDivSec="+strDivSec+"&intMonth="+intMonth+"&intYear="+intYear+"&intDay="+intDay;
		window.open(strPage, '_blank','toolbar=no,location=no,directories=no,status=0,menubar=0,scrollbars=1,resizable=0,width=780,height=528');
	}
	else if(strReport == "LB")
	{
		intLB = document.all.optLB[0].checked;
		intMonthFrom = document.all.cboMonthFrom.value;
		intMonthTo = document.all.cboMonthTo.value;		
		intYearFrom = document.all.cboYearFrom.value;
		intYearTo = document.all.cboYearTo.value;

		if(intLB)
		{		
			if(intYearFrom > intYearTo)
			{
				alert("Please enter correct year from!");
				document.all.cboYearFrom.focus();
				intDateFlag = 1;
			}
			else if(intYearFrom == intYearTo)
			{
				if(intMonthFrom > intMonthTo)
				{
					alert("Please enter correct month from!");
					document.all.cboMonthFrom.focus();
					intDateFlag = 1;
				}
			}	
			if(intDateFlag == 0)
			{												
				strPage = "ReportData.php?strEmpNmbr="+strEmpNmbr+"&strReports="+strReport+"&strEmpSelect="+strEmpSelect+"&strDivSec="+strDivSec+"&intMonthFrom="+intMonthFrom+"&intMonthTo="+intMonthTo+"&intYearFrom="+intYearFrom+"&intYearTo="+intYearTo+"&intLB=1";
				window.open(strPage, '_blank','toolbar=no,location=no,directories=no,status=0,menubar=0,scrollbars=1,resizable=0,width=780,height=528');
			}
		}
		else
		{
			strPage = "ReportData.php?strEmpNmbr="+strEmpNmbr+"&strReports="+strReport+"&strEmpSelect="+strEmpSelect+"&strDivSec="+strDivSec+"&intMonthFrom="+intMonthFrom+"&intMonthTo="+intMonthTo+"&intYearFrom="+intYearFrom+"&intYearTo="+intYearTo+"&intLB=0";
			window.open(strPage, '_blank','toolbar=no,location=no,directories=no,status=0,menubar=0,scrollbars=1,resizable=0,width=780,height=528');
		}
	}
	else if(strReport == "CU")
	{
		intMonthFrom = document.all.cboMonthFrom.value;
		intMonthTo = document.all.cboMonthTo.value;		
		intDayFrom = document.all.cboDayFrom.value;
		intDayTo = document.all.cboDayTo.value;		
		intYearFrom = document.all.cboYearFrom.value;
		intYearTo = document.all.cboYearTo.value;
		
		strPlace = document.all.txtPlace.value;
		strTrng = document.all.txtTrng.value;
		strReasons = document.all.txtReason.value;
		
		if(strPlace.length == 0)
		{
			alert("Please enter place!");
			document.all.txtPlace.focus();
			intDateFlag = 0;
		}
		
		else if(intYearFrom > intYearTo || intYearFrom < dtmDateToday.getFullYear())
		{
			alert("Please enter correct year from!");
			document.all.cboYearFrom.focus();
			intDateFlag = 1;
			
		}
		else if(strTrng.length == 0)
		{
			alert("Please enter training title!");
			document.all.txtTrng.focus();
			intDateFlag = 0;
		}
		else if(strReasons.length == 0)
		{
			alert("Please enter urgent reason!");
			document.all.txtReason.focus();
			intDateFlag = 0;
		}
		else if(intYearFrom == intYearTo)
		{
			if(intMonthFrom == intMonthTo)
			{	
				if(intDayFrom > intDayTo || intDayFrom < dtmDateToday.getDate())
				{
					alert("Please enter correct day from!");
					document.all.cboDayFrom.focus();
					intDateFlag = 1;
				}				
			}

			else if(intMonthFrom > intMonthTo || intMonthFrom < (dtmDateToday.getMonth()+1))
			{
				alert("Please enter correct month from!");
				document.all.cboMonthFrom.focus();
				intDateFlag = 1;
			}
		}		

		if(strPlace.length != 0 && strTrng.length != 0 && strReasons.length != 0 && intDateFlag == 0)
		{
			strPage = "ReportData.php?strEmpNmbr="+strEmpNmbr+"&strReports="+strReport+"&strEmpSelect="+strEmpSelect+"&strDivSec="+strDivSec+"&intMonthFrom="+intMonthFrom+"&intMonthTo="+intMonthTo+"&intYearFrom="+intYearFrom+"&intYearTo="+intYearTo+"&intDayFrom="+intDayFrom+"&intDayTo="+intDayTo+"&strPlace="+strPlace+"&strTrng="+strTrng+"&strReason="+strReasons;
			window.open(strPage, '_blank','toolbar=no,location=no,directories=no,status=0,menubar=0,scrollbars=1,resizable=0,width=780,height=528');
		}
		
	}
	else if(strReport == "EL")
	{
		intMonthFrom = document.all.cboMonthFrom.value;
		intMonthTo = document.all.cboMonthTo.value;		
		intDayFrom = document.all.cboDayFrom.value;
		intDayTo = document.all.cboDayTo.value;		
		intYearFrom = document.all.cboYearFrom.value;
		intYearTo = document.all.cboYearTo.value;
		
		strPlace = document.all.txtPlace.value;
		strTrng = document.all.txtTrng.value;
		strSponsor = document.all.txtSponsor.value;
		strOrganizer = document.all.txtOrganizer.value;		

		if(strTrng.length == 0)
		{
			alert("Please enter training title!");
			document.all.txtTrng.focus();
			intDateFlag = 0;			
		}
		else if(strSponsor.length == 0)
		{
			alert("Please enter sponsor title!");
			document.all.txtSponsor.focus();
			intDateFlag = 0;			
		}
		else if(strOrganizer.length == 0)
		{
			alert("Please enter organizer title!");
			document.all.txtOrganizer.focus();
			intDateFlag = 0;			
		}
		else if(strPlace.length == 0)
		{
			alert("Please enter place title!");
			document.all.txtPlace.focus();
			intDateFlag = 0;
		}
		
		else if(intYearFrom > intYearTo || intYearFrom < dtmDateToday.getFullYear())
		{
			alert("Please enter correct year from!");
			document.all.cboYearFrom.focus();
			intDateFlag = 1;
			
		}
		else if(intYearFrom == intYearTo)
		{
			if(intMonthFrom == intMonthTo)
			{	
				if(intDayFrom > intDayTo || intDayFrom < dtmDateToday.getDate())
				{
					alert("Please enter correct day from!");
					document.all.cboDayFrom.focus();
					intDateFlag = 1;
				}				
			}

			if(intMonthFrom > intMonthTo || intMonthFrom < dtmDateToday.getMonth())
			{
				alert("Please enter correct month from!");
				document.all.cboMonthFrom.focus();
				intDateFlag = 1;
			}
		}				
		
		if(strTrng.length != 0 && strSponsor.length != 0 && strPlace.length != 0 && strOrganizer.length != 0 && intDateFlag == 0)
		{
			strPage = "ReportData.php?strEmpNmbr="+strEmpNmbr+"&strReports="+strReport+"&strEmpSelect="+strEmpSelect+"&strDivSec="+strDivSec+"&intMonthFrom="+intMonthFrom+"&intMonthTo="+intMonthTo+"&intYearFrom="+intYearFrom+"&intYearTo="+intYearTo+"&intDayFrom="+intDayFrom+"&intDayTo="+intDayTo+"&strPlace="+strPlace+"&strTrng="+strTrng+"&strSponsor="+strSponsor+"&strOrganizer="+strOrganizer;
			window.open(strPage, '_blank','toolbar=no,location=no,directories=no,status=0,menubar=0,scrollbars=1,resizable=0,width=780,height=528');
		}
	}
	else if(strReport == "AR")
	{
		intLtrMonth = document.all.cboLtrMonth.value;
		intRcvMonth = document.all.cboRcvMonth.value;
		intAcptMonth = document.all.cboAcptMonth.value;		
		intLtrDay = document.all.cboLtrDay.value;
		intRcvDay = document.all.cboRcvDay.value;
		intAcptDay = document.all.cboAcptDay.value;		
		intLtrYear = document.all.cboLtrYear.value;
		intRcvYear = document.all.cboRcvYear.value;
		intAcptYear = document.all.cboAcptYear.value;

		strPage = "ReportData.php?strEmpNmbr="+strEmpNmbr+"&strReports="+strReport+"&strEmpSelect="+strEmpSelect+"&strDivSec="+strDivSec+"&intLtrMonth="+intLtrMonth+"&intRcvMonth="+intRcvMonth+"&intAcptMonth="+intAcptMonth+"&intLtrYear="+intLtrYear+"&intRcvYear="+intRcvYear+"&intAcptYear="+intAcptYear+"&intLtrDay="+intLtrDay+"&intRcvDay="+intRcvDay+"&intAcptDay="+intAcptDay;
		window.open(strPage, '_blank','toolbar=no,location=no,directories=no,status=0,menubar=0,scrollbars=1,resizable=0,width=780,height=528');
	}	
	else
	{
		strPage = "ReportData.php?strEmpNmbr="+strEmpNmbr+"&strReports="+strReport+"&strEmpSelect="+strEmpSelect+"&strDivSec="+strDivSec;
		window.open(strPage, '_blank','toolbar=no,location=no,directories=no,status=0,menubar=0,scrollbars=1,resizable=0,width=780,height=528');
	}
}

function reportRequirement()
{
	var strEmpNmbr = "<? echo $strEmpNmbr; ?>";
	var strReport = document.all.cboReports.value;
	
	window.location = "Report.php?strEmpNmbr="+strEmpNmbr+"&cboReports="+strReport;
}

function disableDateCombo()
{
	document.all.cboMonthFrom.disabled = true;
	document.all.cboMonthTo.disabled = true;		
	document.all.cboYearFrom.disabled = true;
	document.all.cboYearTo.disabled = true;
}

function enableDateCombo()
{
	document.all.cboMonthFrom.disabled = false;
	document.all.cboMonthTo.disabled = false;		
	document.all.cboYearFrom.disabled = false;
	document.all.cboYearTo.disabled = false;
}

function showSelectCombo(t_strEmpSelect)
{
	var strEmpNmbr = "<? echo $strEmpNmbr; ?>";
	var strReport = document.all.cboReports.value;
	window.location = "Report.php?strEmpNmbr="+strEmpNmbr+"&cboReports="+strReport+"&cboEmpSelected="+t_strEmpSelect;
}

function showEmpOfDivOfSec()
{
	var strEmpNmbr = "<? echo $strEmpNmbr; ?>";
	var strReport = document.all.cboReports.value;
	var strEmpSelect = document.all.cboEmpSelected.value;

	try
	{
		var strDivSec = document.all.cboDivision.value;
	}
	catch(error)
	{
		var strDivSec = document.all.cboSection.value;
	}
	
	window.location = "Report.php?strEmpNmbr="+strEmpNmbr+"&cboReports="+strReport+"&cboEmpSelected="+strEmpSelect+"&cboDivision="+strDivSec+"&cboSection="+strDivSec;
}

function itemNumberRequirement()	// 	this function is for appointment form onchange
{	
	// for combo item number
	var strEmpNmbr = "<? echo $strEmpNmbr; ?>";
	var strReport = document.all.cboReports.value;
	var strEmpSelect = document.all.cboEmpSelected.value;
	var strEmpNumber = document.all.cboEmpNmbr.value;
	var t_strPositionCode = document.all.t_strPositionCode.value;
	var t_intAuthorizeSalary = document.all.t_intAuthorizeSalary.value;
	var t_strItemNumber = document.all.t_strItemNumber.value;

	try
	{
		var strEmpNmbr2 = document.all.cboEmpNmbr.value;
	}
	catch(error)
	{
	
	}

	try
	{
		var strDivSec = document.all.cboDivision.value;
	}
	catch(error)
	{
		try
		{
			var strDivSec2 = document.all.cboSection.value;
		}
		catch(error)
		{
			strDivSec = "";
		}
	}

	window.location = "Report.php?strEmpNmbr="+strEmpNmbr+"&cboReports="+strReport+"&cboEmpSelected="+strEmpSelect+"&cboEmpNmbr="+strEmpNmbr2+"&cboDivision="+strDivSec+"&cboSection="+strDivSec2+"&cboEmpNmbr="+strEmpNumber+"&t_strPositionCode="+t_strPositionCode+"&t_strItemNumber="+t_strItemNumber+"&t_intAuthorizeSalary="+t_intAuthorizeSalary;
}
function presentItemNumberRequirement() 	// 	this function is for position description form onchange
{	
	// for combo item number
	var strEmpNmbr = "<? echo $strEmpNmbr; ?>";
	var strReport = document.all.cboReports.value;
	var strEmpSelect = document.all.cboEmpSelected.value;
	var strEmpNumber = document.all.cboEmpNmbr.value;
	var strPositionCode = document.all.t_strPositionCode.value;
	var intAuthorizeSalary = document.all.t_intAuthorizeSalary.value;
	var	intAuthorizeSalaryYr = document.all.t_intAuthorizeSalaryYr.value;
	var strItemNumber = document.all.t_strItemNumber.value;

	try
	{
		var strEmpNmbr2 = document.all.cboEmpNmbr.value;
	}
	catch(error)
	{
	
	}

	try
	{
		var strDivSec = document.all.cboDivision.value;
	}
	catch(error)
	{
		try
		{
			var strDivSec2 = document.all.cboSection.value;
		}
		catch(error)
		{
			strDivSec = "";
		}
	}

	window.location = "Report.php?strEmpNmbr="+strEmpNmbr+"&cboReports="+strReport+"&cboEmpSelected="+strEmpSelect+"&cboEmpNmbr="+strEmpNmbr2+"&cboDivision="+strDivSec+"&cboSection="+strDivSec2+"&cboEmpNmbr="+strEmpNumber+"&t_strPositionCode="+strPositionCode+"&t_strItemNumber="+strItemNumber+"&t_intAuthorizeSalary="+intAuthorizeSalary+"&t_intAuthorizeSalaryYr="+intAuthorizeSalaryYr;
}

</script>

<!-- InstanceEndEditable -->
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('images/notificationover.jpg','images/201over.jpg','images/attendanceover.jpg','images/librariesover.jpg','images/compensationover.jpg','images/reportsclick.jpg','images/logout2.jpg');history.forward()" onContextMenu="return false"><div align="center"> 
<table width="778" border="0" cellpadding="0" cellspacing="0" id="OUTERTBL">
  <tr> 
    <td height="620"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" id="INNERTBL">
        <tr> 
            <td width="34%" valign="bottom"><table width="90%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td><img src="images/hrmodule.jpg" width="170" height="23"></td>
                </tr>
              </table></td>
          <td width="66%"><table width="100%" border="0" cellpadding="0" cellspacing="0" id="tblSECTION">
                <tr> 
                  <td valign="bottom"><table border="0" cellpadding="0" cellspacing="0">
                      <tr> 
                        <td>&nbsp;</td>
                      </tr>
                    </table>
                    <?   //  HR module for notification templates 
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount	WHERE empNumber = '$strEmpNmbr' ");
$arrHRResult = mysql_fetch_array($objHRResult); 
$t_strUserLevel=$arrHRResult['userLevel'];
$t_strUserPermission=$arrHRResult['userPermission'];
$t_strAccessPermission=$arrHRResult['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Officer" && $t_strAccessPermission == 123456) 
{
?>
                    <table width="90%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblNOTIFICATION">
                      <tr> 
                        <td><a href="Notification.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('NOTIFICATION','','images/notificationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/notification.jpg" alt="NOTIFICATION" name="NOTIFICATION" width="96" height="29" border="0"></a></td>
                        <td><a href="Personal201default.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('PROFILE','','images/201over.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/201.jpg" alt="PROFILE" name="PROFILE" width="67" height="29" border="0"></a></td>
                        <td><a href="Searchattendance.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('ATTENDANCE','','images/attendanceover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/attendance.jpg" alt="ATTENDANCE" name="ATTENDANCE" width="88" height="29" border="0"></a></td>
                        <td><a href="Report.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('REPORTS','','images/reportsclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/reportsclick.jpg" alt="REPORTS" name="REPORTS" width="60" height="29" border="0"></a></td>
                        <td><a href="Holiday.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('LIBRARIES','','images/librariesover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/libraries.jpg" alt="LIBRARIES" name="LIBRARIES" width="67" height="29" border="0"></a></td>
                        <td><a href="Personnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('COMPENSATION','','images/compensationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/compensation.jpg" alt="COMPENSATION" name="COMPENSATION" width="104" height="29" border="0"></a></td>
                      </tr>
                    </table>
                    <? } ?>
                  </td>
                </tr>
                <tr> 
                  <td valign="bottom"> 
                    <?   //  HR module for notification templates 
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount	WHERE empNumber = '$strEmpNmbr' ");
$arrHRResult = mysql_fetch_array($objHRResult); 
$t_strUserLevel=$arrHRResult['userLevel'];
$t_strUserPermission=$arrHRResult['userPermission'];
$t_strAccessPermission=$arrHRResult['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 14) 
{
?>
                    <table width="20%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblNOTIFICATIONREPORTS">
                      <tr> 
                        <td valign="bottom"><a href="Notification.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('NOTIFICATION2','','images/notificationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/notification.jpg" alt="NOTIFICATION2" name="NOTIFICATION2" width="96" height="29" border="0"></a></td>
                        <td valign="bottom"><a href="Report.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('REPORTS2','','images/reportsclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/reportsclick.jpg" alt="REPORTS2" name="REPORTS2" width="60" height="29" border="0"></a></td>
                      </tr>
                    </table>
                    <? } ?>
                  </td>
                </tr>
                <tr> 
                  <td valign="bottom"> 
                    <?   //  HR module for notification templates 
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount	WHERE empNumber = '$strEmpNmbr' ");
$arrHRResult = mysql_fetch_array($objHRResult); 
$t_strUserLevel=$arrHRResult['userLevel'];
$t_strUserPermission=$arrHRResult['userPermission'];
$t_strAccessPermission=$arrHRResult['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 24) 
{
?>
                    <table width="20%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblPROFILEREPORTS">
                      <tr> 
                        <td><a href="Personal201default.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('PROFILE3','','images/201over.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/201.jpg" alt="PROFILE3" name="PROFILE3" width="67" height="29" border="0"></a></td>
                        <td><a href="Report.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('REPORTS3','','images/reportsclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/reportsclick.jpg" alt="REPORTS3" name="REPORTS3" width="60" height="29" border="0"></a></td>
                      </tr>
                    </table>
                    <? } ?>
                  </td>
                </tr>
                <tr> 
                  <td valign="bottom"> 
                    <?   //  HR module for notification templates 
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount	WHERE empNumber = '$strEmpNmbr' ");
$arrHRResult = mysql_fetch_array($objHRResult); 
$t_strUserLevel=$arrHRResult['userLevel'];
$t_strUserPermission=$arrHRResult['userPermission'];
$t_strAccessPermission=$arrHRResult['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 34) 
{
?>
                    <table width="20%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblATTENDANCEREPORTS">
                      <tr> 
                        <td><a href="Searchattendance.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('ATTENDANCE4','','images/attendanceover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/attendance.jpg" alt="ATTENDANCE4" name="ATTENDANCE4" width="88" height="29" border="0"></a></td>
                        <td><a href="Report.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('REPORTS4','','images/reportsclick.jpg',0); statusBar(); return true;" onClick="statusBar();"><img src="images/reportsclick.jpg" alt="REPORTS4" name="REPORTS4" width="60" height="29" border="0"></a></td>
                      </tr>
                    </table>
                    <? } ?>
                  </td>
                </tr>
                <tr> 
                  <td valign="bottom"> 
                    <?   //  HR module for notification templates 
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount	WHERE empNumber = '$strEmpNmbr' ");
$arrHRResult = mysql_fetch_array($objHRResult); 
$t_strUserLevel=$arrHRResult['userLevel'];
$t_strUserPermission=$arrHRResult['userPermission'];
$t_strAccessPermission=$arrHRResult['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 45) 
{
?>
                    <table width="20%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblREPORTSLIBRARIES">
                      <tr> 
                        <td><a href="Report.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('REPORTS5','','images/reportsclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/reportsclick.jpg" alt="REPORTS5" name="REPORTS5" width="60" height="29" border="0"></a></td>
                        <td><a href="Holiday.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('LIBRARIES5','','images/librariesover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/libraries.jpg" alt="LIBRARIES5" name="LIBRARIES5" width="67" height="29" border="0"></a></td>
                      </tr>
                    </table>
                    <? } ?>
                  </td>
                </tr>
                <tr> 
                  <td valign="bottom"> 
                    <?   //  HR module for notification templates 
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount	WHERE empNumber = '$strEmpNmbr' ");
$arrHRResult = mysql_fetch_array($objHRResult); 
$t_strUserLevel=$arrHRResult['userLevel'];
$t_strUserPermission=$arrHRResult['userPermission'];
$t_strAccessPermission=$arrHRResult['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 46) 
{
?>
                    <table width="20%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblREPORTSCOMPENSATION">
                      <tr> 
                        <td><a href="Report.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('REPORTS6','','images/reportsclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/reportsclick.jpg" alt="REPORTS6" name="REPORTS6" width="60" height="29" border="0"></a></td>
                        <td><a href="Personnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('COMPENSATION6','','images/compensationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/compensation.jpg" alt="COMPENSATION6" name="COMPENSATION6" width="104" height="29" border="0"></a></td>
                      </tr>
                    </table>
                    <? } ?>
                  </td>
                </tr>
                <tr>
                  <td valign="bottom">
                    <?   //  HR module for notification templates 
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount	WHERE empNumber = '$strEmpNmbr' ");
$arrHRResult = mysql_fetch_array($objHRResult); 
$t_strUserLevel=$arrHRResult['userLevel'];
$t_strUserPermission=$arrHRResult['userPermission'];
$t_strAccessPermission=$arrHRResult['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 4) 
{
?>
                    <table width="10%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblREPORTS">
                      <tr> 
                        <td><a href="Report.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('REPORTS61','','images/reportsclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/reportsclick.jpg" alt="REPORTS6" name="REPORTS61" width="60" height="29" border="0" id="REPORTS61"></a></td>
                      </tr>
                    </table>
                    <? } ?>
                  </td>
                </tr>
                <tr>
                  <td valign="bottom">
                    <?   //  HR module for notification templates 
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount	WHERE empNumber = '$strEmpNmbr' ");
$arrHRResult = mysql_fetch_array($objHRResult); 
$t_strUserLevel=$arrHRResult['userLevel'];
$t_strUserPermission=$arrHRResult['userPermission'];
$t_strAccessPermission=$arrHRResult['accessPermission'];
if ($t_strUserLevel == 12 && $t_strUserPermission == "HR&Cashier Officer" && $t_strAccessPermission == 1234567) 
{
?>
                    <table width="90%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblNOTIFICATIONCASHIER">
                      <tr> 
                        <td><a href="Notification.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('NOTIFICATION1','','images/notificationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/notification.jpg" alt="NOTIFICATION" name="NOTIFICATION1" width="96" height="29" border="0" id="NOTIFICATION1"></a></td>
                        <td><a href="Personal201default.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('PROFILE1','','images/201over.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/201.jpg" alt="PROFILE" name="PROFILE1" width="67" height="29" border="0" id="PROFILE1"></a></td>
                        <td><a href="Searchattendance.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('ATTENDANCE1','','images/attendanceover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/attendance.jpg" alt="ATTENDANCE" name="ATTENDANCE1" width="88" height="29" border="0" id="ATTENDANCE1"></a></td>
                        <td><a href="Report.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('REPORTS1','','images/reportsclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/reportsclick.jpg" alt="REPORTS" name="REPORTS1" width="60" height="29" border="0" id="REPORTS1"></a></td>
                        <td><a href="Holiday.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('LIBRARIES1','','images/librariesover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/libraries.jpg" alt="LIBRARIES" name="LIBRARIES1" width="67" height="29" border="0" id="LIBRARIES1"></a></td>
                        <td><a href="CPersonnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('COMPENSATION1','','images/compensationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/compensation.jpg" alt="COMPENSATION" name="COMPENSATION1" width="104" height="29" border="0" id="COMPENSATION1"></a></td>
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
        <tr bgcolor="#E9F3FE"> 
          <td height="294" colspan="2" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td height="286"><table width="100%" height="286" border="0" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td width="84%" height="13"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                              <td width="19%" height="286" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" id="tblLEFTOUTERNAV">
                                  <tr>
                                    <td><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" id="tblLEFTNAVIGATION">
                                        <tr> 
                                          <td height="286" bgcolor="#C1E2FF"><table width="55%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr> 
                                                <td>&nbsp;</td>
                                              </tr>
                                              <tr> 
                                                <td><a href="index.php" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('logout','','images/logout2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/logout.jpg" alt="logout" name="logout" width="108" height="20" border="0"></a></td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                </table></td>
                            <td width="81%"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#C1E2FF">
                                <tr> 
                                    <td height="286"><!-- InstanceBeginEditable name="BODY" -->
						<form name="frmReport">
                        <table width="98%" border="0" align="center" cellspacing="0" cellpadding="0" bgcolor="#C1E2FF">
                          <!--DWLayoutTable-->
                          <tr> 
                            <td height="25" class="header"><p>REPORTS</p></td>
                          </tr>
                          <tr> 
                            <td class="header"></td>
                          </tr>
                          <tr> 
                            <td height="7" class="header">&nbsp;</td>
                          </tr>
                          <tr> 
                            <td> 
							<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                <tr> 
                                                  <td colspan="5" height="20"><font class="note">(*) 
                                                    denotes required field.</font></td>
                                                </tr>
                                                <tr> 
                                                  <td colspan="2" height="25" width="30%" align="right"> 
                                                    <span class="paragraph">Type 
                                                    of Reports :&nbsp;</span>&nbsp; 
                                                  </td>
                                                  <td width="70%" colspan="3" height="25"> 
                                                    <?
									$objReport->comboReportType("cboReports", "1", "", "reportRequirement();", $cboReports);
									?>
                                                  </td>
                                                </tr>
                                                <?
									if ($cboReports != 'MRS' && $cboReports != 'RPBD' && $cboReports != 'RPS' && $cboReports != 'RPSG' && $cboReports != 'RPAGE' && $cboReports != 'RPDH' && $cboReports != 'RPI' && $cboReports != 'RPP' && $cboReports != 'RPE' && $cboReports != 'RPR' && $cboReports != 'RPRS' && $cboReports != 'RMA' && $cboReports != 'CSCPCA' && $cboReports != 'RLP')
									{
									?>
                                                <tr> 
                                                  <td width="30%" height="25" colspan="2" align="right" class="paragraph"> 
                                                    Select Name Per:&nbsp;&nbsp;</td>
                                                  <td height="30" colspan="3"><select name="cboEmpSelected" onChange="showSelectCombo(document.all.cboEmpSelected.value)">
                                                      <?
										  if($cboEmpSelected == "All Employees")
										  {
										  ?>
                                                      <option value="All Employees" selected>All 
                                                      Employees</option>
                                                      <?
										  }
										  else
										  {
										  ?>
                                                      <option value="All Employees">All 
                                                      Employees</option>
                                                      <?
										  }
										  
										  if($cboEmpSelected == "Per Division")
										  {
										  ?>
                                                      <option value="Per Division" selected>Per 
                                                      Division</option>
                                                      <?
										  }
										  else
										  {
										  ?>
                                                      <option value="Per Division">Per 
                                                      Division</option>
                                                      <?
										  }
										  
										  if($cboEmpSelected == "Per Section")
										  {										  
										  ?>
                                                      <option value="Per Section" selected>Per 
                                                      Section</option>
                                                      <?
										  }
										  else
										  {
										  ?>
                                                      <option value="Per Section">Per 
                                                      Section</option>
                                                      <?
										  }
										  ?>
                                                    </select> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                                    <? 	
									if($cboEmpSelected == "Per Division")
									{								
										echo "Select Division: ";
										$objReport->comboDivision("cboDivision", $cboDivision, "showEmpOfDivOfSec()");
									}
									else if($cboEmpSelected == "Per Section")
									{
										echo "Select Section: ";
										$objReport->comboSection("cboSection", $cboSection, "showEmpOfDivOfSec()");	
									}
									?>
                                                  </td>
                                                </tr>
                                                <tr> 
                                                  <td width="30%" height="25" colspan="2" align="right" class="paragraph"> 
                                                    Employees:&nbsp;&nbsp;</td>
                                                  <td width="40%" colspan="2" height="25"> 
                                                    <? 
									if(strlen($cboDivision) != 0 && strlen($cboSection) != 0)
									{
										$objReport->comboEmpReport("cboEmpNmbr", $cboEmpNmbr, $cboReports, $cboEmpSelected, $cboDivision);
									}
									else
									{
										$objReport->comboEmpReport("cboEmpNmbr", $cboEmpNmbr, $cboReports);
									}
									?>
                                                  </td>
                                                  <td width="30%"> <p class="text"> 
                                                      Highlight desired employee. 
                                                      <br>
                                                      If you wish to select all 
                                                      employees,<br>
                                                      just choose "All Employees"<br>
                                                    </p></td>
                                                </tr>
                                                <?
									}
									?>
                                                <tr> 
                                                  <td height="5" colspan="5"> 
                                                    <? if($cboReports == 'DTR' || $cboReports == 'PS' || $cboReports == 'AS' || $cboReports == 'LWOP' || $cboReports == 'TR' || $cboReports == 'MA' || $cboReports == 'MCR' || $cboReports == 'HPR')
{
?>
                                                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                      <tr> 
                                                        <td height="20" colspan="4"></td>
                                                      </tr>
                                                      <tr> 
                                                        <td width="30%" height="25" align="right" class="paragraph">Month 
                                                          :&nbsp;</td>
                                                        <td width="10%"> <select name="cboMonth">
                                                            <?
								  	$objReport->comboMonth($cboMonth);
								  ?>
                                                          </select> </td>
                                                        <td width="10%" align="right" class="paragraph">Year 
                                                          :&nbsp;</td>
                                                        <td width="50%"> <select name="cboYear">
                                                            <?
								  	$objReport->comboYear($cboYear);
								  ?>
                                                          </select> </td>
                                                      </tr>
                                                      <tr> 
                                                        <td height="20" colspan="4"></td>
                                                      </tr>
                                                    </table>
                                                    <? 
}
elseif ($cboReports == 'LB')
{
?>
                                                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                      <tr> 
                                                        <td height="20"></td>
                                                      </tr>
                                                      <tr> 
                                                        <td width="20%" height="25" align="right"></td>
                                                        <td colspan="4" width="80%"><input name="optLB" type="radio" value="Y" checked onClick="enableDateCombo();"> 
                                                          <span class="text">Select 
                                                          Period</span></td>
                                                      </tr>
                                                      <tr> 
                                                        <td width="20%" height="25" align="right"></td>
                                                        <td width="20%" height="25" align="right" class="text"> 
                                                          From:&nbsp;&nbsp; Month</td>
                                                        <td width="10%"> <select name="cboMonthFrom">
                                                            <?
								  	$objReport->comboMonth($cboMonth);
								  ?>
                                                          </select> </td>
                                                        <td width="10%" align="right" class="paragraph">Year</td>
                                                        <td width="40%"> <select name="cboYearFrom">
                                                            <?
								  	$objReport->comboYear($cboYear);
								  ?>
                                                          </select> </td>
                                                      </tr>
                                                      <tr> 
                                                        <td width="20%" height="25" align="right"></td>
                                                        <td width="20%" height="25" align="right" class="text">To:&nbsp;&nbsp; 
                                                          Month</td>
                                                        <td width="10%"> <select name="cboMonthTo">
                                                            <?
								  	$objReport->comboMonth($cboMonth);
								  ?>
                                                          </select> </td>
                                                        <td width="10%" align="right" class="paragraph">Year</td>
                                                        <td width="40%"> <select name="cboYearTo">
                                                            <?
								  	$objReport->comboYear($cboYear);
								  ?>
                                                          </select> </td>
                                                      </tr>
                                                      <tr> 
                                                        <td width="20%" height="25" align="right"></td>
                                                        <td colspan="4" width="80%"><input name="optLB" type="radio" value="N" onClick="disableDateCombo();"> 
                                                          <span class="text">View 
                                                          All Period</span></td>
                                                      </tr>
                                                      <tr> 
                                                        <td height="30"></td>
                                                      </tr>
                                                    </table>
                                                    <?
}
elseif($cboReports == 'CU')
{
?>
                                                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                      <tr> 
                                                        <td height="10"></td>
                                                      </tr>
                                                      <tr> 
                                                        <td width="30%" height="25" align="right" class="paragraph">Place 
                                                          :&nbsp;</td>
                                                        <td width="70%"><input name="txtPlace" type="text" size="30" maxlength="50"> 
                                                          <font class="note">*</font> 
                                                        </td>
                                                      </tr>
                                                      <tr> 
                                                        <td width="30%" height="25" align="right" valign="middle" class="text"> 
                                                          From:&nbsp;&nbsp; </td>
                                                        <td width="70%"><span class="paragraph">Year 
                                                          </span> <select name="cboYearFrom" onChange="updateList(cboMonthFrom.selectedIndex,this[this.selectedIndex].text,'cboDayFrom')">
                                                            <?
								  	$objReport->comboYear($cboYearFrom);
								  ?>
                                                          </select>
                                                          &nbsp;&nbsp;&nbsp; 
                                                          <?
											$intMonthNow = date('n');
										?>
                                                          <span class="paragraph"> 
                                                          Month</span> <select name="cboMonthFrom" onChange="updateList(this.selectedIndex,cboYearFrom[cboYearFrom.selectedIndex].text,'cboDayFrom')">
                                                            <?
								  	$objReport->comboMonth($intMonthNow);
								  ?>
                                                          </select> &nbsp;&nbsp;&nbsp;<span class="paragraph"> 
                                                          Day </span> <select name="cboDayFrom">
                                                            <?
								  	$objReport->comboDay($cboDayFrom);
								  ?>
                                                          </select> </td>
                                                      </tr>
                                                      <tr> 
                                                        <td width="30%" height="25" align="right"  valign="middle" class="text">To:&nbsp;&nbsp; 
                                                        </td>
                                                        <td width="70%"> <span class="paragraph"> 
                                                          Year </span> <select name="cboYearTo" onChange="updateList(cboMonthTo.selectedIndex,this[this.selectedIndex].text,'cboDayTo')">
                                                            <?
								  	$objReport->comboYear($cboYearTo);
								  ?>
                                                          </select>
                                                          &nbsp;&nbsp;&nbsp; 
                                                          <?
											$intMonthNow = date('n');
										?>
                                                          <span class="paragraph"> 
                                                          Month</span> <select name="cboMonthTo" onChange="updateList(this.selectedIndex,cboYearTo[cboYearTo.selectedIndex].text,'cboDayTo')">
                                                            <?
								  	$objReport->comboMonth($intMonthNow);
								  ?>
                                                          </select> &nbsp;&nbsp;&nbsp;<span class="paragraph"> 
                                                          Day </span> <select name="cboDayTo">
                                                            <?
								  	$objReport->comboDay($cboDayTo);
								  ?>
                                                          </select> </td>
                                                      <tr> 
                                                        <td width="30%" height="25" align="right" class="paragraph">Training 
                                                          Title :&nbsp;</td>
                                                        <td width="70%"><input name="txtTrng" type="text" size="30" maxlength="200"> 
                                                          <font class="note">*</font> 
                                                        </td>
                                                      </tr>
                                                      <tr> 
                                                        <td width="30%" height="25" align="right" class="paragraph">Urgent 
                                                          Reasons :&nbsp;</td>
                                                        <td width="70%"><textarea name="txtReason" rows="10" cols="30"></textarea> 
                                                          <font class="note">*</font> 
                                                        </td>
                                                      </tr>
                                                      <tr> 
                                                        <td height="20" colspan="5"></td>
                                                      </tr>
                                                    </table>
                                                    <?
}
elseif($cboReports == 'EL')
{
?>
                                                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                      <tr> 
                                                        <td height="10"></td>
                                                      </tr>
                                                      <tr> 
                                                        <td width="30%" height="25" align="right" class="paragraph">Training 
                                                          Title :&nbsp;</td>
                                                        <td width="70%"><input name="txtTrng" type="text" size="30" maxlength="200"> 
                                                          <font class="note">*</font> 
                                                        </td>
                                                      </tr>
                                                      <tr> 
                                                        <td width="30%" height="25" align="right"><span class="paragraph">Sponsor 
                                                          :</span>&nbsp;</td>
                                                        <td width="70%"><input name="txtSponsor" type="text" size="30" maxlength="200"> 
                                                          <font class="note">*</font> 
                                                        </td>
                                                      </tr>
                                                      <tr> 
                                                        <td width="30%" height="25" align="right" class="paragraph">Organizer 
                                                          :&nbsp;</td>
                                                        <td width="70%"><input name="txtOrganizer" type="text" size="30" maxlength="200"> 
                                                          <font class="note">*</font> 
                                                        </td>
                                                      </tr>
                                                      <tr> 
                                                        <td width="30%" height="25" align="right" valign="middle" class="text"> 
                                                          From:&nbsp;&nbsp; </td>
                                                        <td width="70%"> <span class="paragraph">&nbsp;Year 
                                                          </span> <select name="cboYearFrom" onChange="updateList(cboMonthFrom.selectedIndex,this[this.selectedIndex].text,'cboDayFrom')">
                                                            <?
								  	$objReport->comboYear();
								  ?>
                                                          </select> &nbsp;<span class="paragraph">Month</span> 
                                                          <select name="cboMonthFrom" onChange="updateList(this.selectedIndex,cboYearFrom[cboYearFrom.selectedIndex].text,'cboDayFrom')">
                                                            <?
								  	$objReport->comboMonth();
								  ?>
                                                          </select> &nbsp;<span class="paragraph"> 
                                                          Day </span> <select name="cboDayFrom">
                                                            <?
								  	$objReport->comboDay();
								  ?>
                                                          </select> </td>
                                                      </tr>
                                                      <tr> 
                                                        <td width="30%" height="25" align="right"  valign="middle" class="text">To:&nbsp;&nbsp; 
                                                        </td>
                                                        <td width="70%"> <span class="paragraph">&nbsp;Year</span> 
                                                          <select name="cboYearTo" onChange="updateList(cboMonthTo.selectedIndex,this[this.selectedIndex].text,'cboDayTo')">
                                                            <?
								  	$objReport->comboYear();
								  ?>
                                                          </select>
                                                          &nbsp; <span class="paragraph">Month</span> 
                                                          <select name="cboMonthTo" onChange="updateList(this.selectedIndex,cboYearTo[cboYearTo.selectedIndex].text,'cboDayTo')">
                                                            <?
								  	$objReport->comboMonth();
								  ?>
                                                          </select> &nbsp;<span class="paragraph"> 
                                                          Day </span> <select name="cboDayTo">
                                                            <?
								  	$objReport->comboDay();
								  ?>
                                                          </select> &nbsp; </td>
                                                      </tr>
                                                      <tr> 
                                                        <td width="30%" height="25" align="right" class="paragraph">Place 
                                                          :&nbsp;</td>
                                                        <td width="70%"><input name="txtPlace" type="text" size="30" maxlength="200"> 
                                                          <font class="note">*</font> 
                                                        </td>
                                                      </tr>
                                                      <tr> 
                                                        <td height="20" colspan="5"></td>
                                                      </tr>
                                                    </table>
                                                    <? 
}
elseif($cboReports == 'AL' || $cboReports == 'OB' || $cboReports == 'PRO' || $cboReports == 'TO')
{
?>
                                                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                      <tr> 
                                                        <td height="20"></td>
                                                      </tr>
                                                      <tr> 
                                                        <td width="30%" height="25" align="right" valign="middle" class="paragraph">Date 
                                                          Filed:&nbsp;</td>
                                                        <td width="15%" align="center"> 
                                                          <span class="paragraph">Year 
                                                          :&nbsp;</span> <select name="cboYear" onChange="updateList(cboMonth.selectedIndex,this[this.selectedIndex].text,'cboDay')">
                                                            <?
								  	$objReport->comboYear($cboYear);
								  ?>
                                                          </select> </td>
                                                        <td width="15%" align="center"> 
                                                          <span class="paragraph">Month 
                                                          </span> <select name="cboMonth" onChange="updateList(this.selectedIndex,cboYear[cboYear.selectedIndex].text,'cboDay')">
                                                            <?
								  	$objReport->comboMonth($cboMonth);
								  ?>
                                                          </select> </td>
                                                        <td width="40%"  align="left"> 
                                                          <span class="paragraph">Day 
                                                          </span> <select name="cboDay">
                                                            <?
								  	$objReport->comboDay($cboDay);
								  ?>
                                                          </select> </td>
                                                      </tr>
                                                      <tr> 
                                                        <td height="20"></td>
                                                      </tr>
                                                    </table>
                                                    <?
}
elseif($cboReports == 'AR' || $cboReports == '')
{
?>
                                                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                      <tr> 
                                                        <td height="20"></td>
                                                      </tr>
                                                      <tr> 
                                                        <td width="30%" height="25" align="right" valign="middle" class="paragraph"> 
                                                          Letter Date:&nbsp;</td>
                                                        <td width="15%" align="center"> 
                                                          <span class="paragraph">Year 
                                                          :&nbsp;</span> <select name="cboLtrYear" onChange="updateList(cboLtrMonth.selectedIndex,this[this.selectedIndex].text,'cboLtrDay')">
                                                            <?
								  	$objReport->comboYear($cboYear);
								  ?>
                                                          </select> </td>
                                                        <td width="15%" align="center"> 
                                                          <span class="paragraph">Month 
                                                          </span> <select name="cboLtrMonth" onChange="updateList(this.selectedIndex,cboLtrYear[cboLtrYear.selectedIndex].text,'cboLtrDay')">
                                                            <?
								  	$objReport->comboMonth($cboMonth);
								  ?>
                                                          </select> </td>
                                                        <td width="40%"  align="left"> 
                                                          <span class="paragraph">Day 
                                                          </span> <select name="cboLtrDay">
                                                            <?
								  	$objReport->comboDay($cboDay);
								  ?>
                                                          </select> </td>
                                                      </tr>
                                                      <tr> 
                                                        <td height="5"></td>
                                                      </tr>
                                                      <tr> 
                                                        <td width="30%" height="25" align="right" valign="middle" class="paragraph">Received 
                                                          Date:&nbsp;</td>
                                                        <td width="15%" align="center"> 
                                                          <span class="paragraph">Year 
                                                          :&nbsp;</span> <select name="cboRcvYear" onChange="updateList(cboRcvMonth.selectedIndex,this[this.selectedIndex].text,'cboRcvDay')">
                                                            <?
								  	$objReport->comboYear($cboYear);
								  ?>
                                                          </select> </td>
                                                        <td width="15%" align="center"> 
                                                          <span class="paragraph">Month 
                                                          </span> <select name="cboRcvMonth" onChange="updateList(this.selectedIndex,cboRcvYear[cboRcvYear.selectedIndex].text,'cboRcvDay')">
                                                            <?
								  	$objReport->comboMonth($cboMonth);
								  ?>
                                                          </select> </td>
                                                        <td width="40%"  align="left"> 
                                                          <span class="paragraph">Day 
                                                          </span> <select name="cboRcvDay">
                                                            <?
								  	$objReport->comboDay($cboDay);
								  ?>
                                                          </select></td>
                                                      </tr>
                                                      <tr> 
                                                        <td height="5"></td>
                                                      </tr>
                                                      <tr> 
                                                        <td width="30%" height="25" align="right" valign="middle" class="paragraph">Accepted 
                                                          Date:&nbsp;</td>
                                                        <td width="15%" align="center"> 
                                                          <span class="paragraph">Year 
                                                          :&nbsp;</span> <select name="cboAcptYear" onChange="updateList(cboAcptMonth.selectedIndex,this[this.selectedIndex].text,'cboAcptDay')">
                                                            <?
								  	$objReport->comboYear($cboYear);
								  ?>
                                                          </select> </td>
                                                        <td width="15%" align="center"> 
                                                          <span class="paragraph">Month 
                                                          </span> <select name="cboAcptMonth" onChange="updateList(this.selectedIndex,cboAcptYear[cboAcptYear.selectedIndex].text,'cboAcptDay')">
                                                            <?
								  	$objReport->comboMonth($cboMonth);
								  ?>
                                                          </select> </td>
                                                        <td width="40%"  align="left"> 
                                                          <span class="paragraph">Day 
                                                          </span> <select name="cboAcptDay">
                                                            <?
								  	$objReport->comboDay($cboDay);
								  ?>
                                                          </select> </td>
                                                      </tr>
                                                      <tr> 
                                                        <td height="20"></td>
                                                      </tr>
                                                    </table>
                                                    <?
}
elseif($cboReports == 'HYA' || $cboReports == 'EAS' || $cboReports == 'AFC')
{
?>
                                                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                      <tr> 
                                                        <td height="20"></td>
                                                      </tr>
                                                      <tr> 
                                                        <td width="30%" height="25" align="right" valign="middle" class="paragraph">Date 
                                                          Filed:&nbsp;</td>
                                                        <td width="25%" align="center"> 
                                                          <span class="paragraph">Period 
                                                          &nbsp; </span> <select name="cboPeriod">
                                                            <option value="1">First 
                                                            Half</option>
                                                            <option value="2">Second 
                                                            Half</option>
                                                          </select> </td>
                                                        <td width="45%"> <span class="paragraph">Year 
                                                          </span> &nbsp; <select name="cboYear">
                                                            <?
								  	$objReport->comboYear($cboYear);
								  ?>
                                                          </select> </td>
                                                      </tr>
                                                      <tr> 
                                                        <td height="20"></td>
                                                      </tr>
                                                    </table>
                                                    <?
}
elseif($cboReports == 'AAR')
{
?>
                                                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                      <tr> 
                                                        <td height="20"></td>
                                                      </tr>
                                                      <tr> 
                                                        <td width="30%" height="25" align="right" valign="middle" class="paragraph">Date 
                                                          Filed:&nbsp;</td>
                                                        <td width="25%" align="center"><span class="paragraph">Period</span> 
                                                          &nbsp; <select name="cboPeriod">
                                                            <option value="1">Jan 
                                                            - Mar</option>
                                                            <option value="2">Apr 
                                                            - Jun</option>
                                                            <option value="3">Jul 
                                                            - Sep</option>
                                                            <option value="4">Oct 
                                                            - Dec</option>
                                                          </select> </td>
                                                        <td width="45%"> <span class="paragraph">Year 
                                                          </span> &nbsp; <select name="cboYear">
                                                            <?
								  	$objReport->comboYear($cboYear);
								  ?>
                                                          </select> </td>
                                                      </tr>
                                                      <tr> 
                                                        <td height="20"></td>
                                                      </tr>
                                                    </table></td>
                                                </tr>
                                                <tr> 
                                                  <td height="1" colspan="5"> 
                                                    <?
}
elseif($cboReports == 'MRS' || $cboReports == 'RPA' || $cboReports == 'RCB' || $cboReports == 'RLP' || $cboReports == 'RMA')
{
?>
                                                  </td>
                                                </tr>
                                                <tr> 
                                                  <td height="1" colspan="5"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                      <tr> 
                                                        <td height="20" colspan="4"></td>
                                                      </tr>
                                                      <tr> 
                                                        <td width="30%" height="25" align="right" class="paragraph">Month 
                                                          :&nbsp;</td>
                                                        <td width="10%"> <select name="cboMonth" id="cboMonth">
                                                            <?
								  	$objReport->comboMonth($cboMonth);
								  ?>
                                                          </select> </td>
                                                        <td width="10%" align="right" class="paragraph">Year 
                                                          :&nbsp;</td>
                                                        <td width="50%"> <select name="cboYear" id="cboYear">
                                                            <?
								  	$objReport->comboYear($cboYear);
								  ?>
                                                          </select> </td>
                                                      </tr>
                                                      <tr> 
                                                        <td height="20" colspan="4"></td>
                                                      </tr>
                                                    </table></td>
                                                </tr>
                                                <tr> 
                                                  <td height="3" colspan="5"> 
                                                    <?
}
elseif($cboReports == 'RPI')
{
?>
                                                  </td>
                                                </tr>
                                                <tr> 
                                                  <td height="1" colspan="5"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                      <tr> 
                                                        <td height="20" colspan="2"></td>
                                                      </tr>
                                                      <tr> 
                                                        <td width="30%" height="25" align="right" class="paragraph">Year 
                                                          :&nbsp;</td>
                                                        <td width="70%"> <select name="cboYear">
                                                            <?
								  	$objReport->comboYear($cboYear);
								  ?>
                                                          </select> <input name="cboMonth" type="hidden" id="cboMonth"> 
                                                        </td>
                                                      </tr>
                                                      <tr> 
                                                        <td height="20" colspan="2"></td>
                                                      </tr>
                                                    </table></td>
                                                </tr>
                                                <tr> 
                                                  <td height="0" colspan="5"> 
                                                    <?
}
elseif($cboReports == 'RPP')
{
?>
                                                  </td>
                                                </tr>
                                                <tr> 
                                                  <td height="0" colspan="5"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                      <tr> 
                                                        <td width="25%" class="paragraph">Area 
                                                          Code :</td>
                                                        <td width="25%"><input name="t_strAreaCode" type="text" id="t_strAppointmentReason" size="20" maxlength="50"></td>
                                                        <td width="21%" class="paragraph">P/P/A/ 
                                                          Attribution :</td>
                                                        <td width="29%"><input name="t_strAttribution" type="text" id="t_strAppointmentReason5" size="20" maxlength="50"></td>
                                                      </tr>
                                                      <tr> 
                                                        <td class="paragraph">Area 
                                                          Type :</td>
                                                        <td><input name="t_strAreaType" type="text" id="t_strAppointmentReason4" size="20" maxlength="50"></td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                      </tr>
                                                    </table></td>
                                                </tr>
                                                <tr> 
                                                  <td height="0" colspan="5">
                                                    <?
}
elseif($cboReports == 'CSCPCA')
{
?>
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td height="0" colspan="5"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                      <tr> 
                                                        <td width="25%" class="paragraph">Department/Division:</td>
                                                        <td width="25%"> 
                                                          <? $objReport->comboDivision("t_strDivision", $t_strDivision, $t_strOnChange=''); ?>
                                                        </td>
                                                        <td width="21%" class="paragraph">Source 
                                                          of Funds :</td>
                                                        <td width="29%"><input name="t_strFundsSource" type="text" id="t_strAreaCode3" size="20" maxlength="50"></td>
                                                      </tr>
                                                      <tr> 
                                                        <td class="paragraph">Appointing 
                                                          Authority : </td>
                                                        <td><input name="t_strAppointAuthority" type="text" id="t_strAreaCode2" size="20" maxlength="50"></td>
                                                        <td class="paragraph">Head 
                                                          CSC Field Officer : 
                                                        </td>
                                                        <td><input name="t_strHeadCSCOfficer" type="text" id="t_strAreaCode4" size="25" maxlength="50"></td>
                                                      </tr>
                                                    </table></td>
                                                </tr>
                                                <tr> 
                                                  <td height="0" colspan="5">&nbsp;</td>
                                                </tr>
                                                <tr> 
                                                  <td height="0" colspan="5"> 
                                                    <?
}
elseif($cboReports == 'RAF')
{
?>
                                                  </td>
                                                </tr>
                                                <tr> 
                                                  <td height="0" colspan="5"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                      <tr> 
                                                        <td colspan="4">&nbsp;</td>
                                                      </tr>
                                                      <tr> 
                                                        <td colspan="4"><hr></td>
                                                      </tr>
                                                      <tr> 
                                                        <td class="paragraph">Item 
                                                          Number : </td>
                                                        <td> 
                                                          <?
														$result = mysql_query ("SELECT * FROM tblPlantilla");
														echo "<SELECT NAME=\"t_strItemNumber\" onChange=\"itemNumberRequirement()\">";
														if ($row = mysql_fetch_array($result)) {
														do {
														if ($t_strItemNumber == $row["itemNumber"])
														{
														print "<OPTION VALUE=\"".($row["itemNumber"])."\" selected>".($row["itemNumber"])."\r";
														}
														print "<OPTION VALUE=\"".($row["itemNumber"])."\">".($row["itemNumber"])."\r";
														} while($row = mysql_fetch_array($result));
														} else {print "no results!";}
														echo "</SELECT>";
														?>
                                                        </td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                      </tr>
                                                      <tr> 
                                                        <td class="paragraph"> 
                                                          <? 
											$t_strPosition = $objReport->positionCode($t_strEmpNumber, $t_strItemNumber); 
											?>
                                                          Position Code :</td>
                                                        <td><input name="t_strPositionCode" type="text" id="t_strPositionCode" value="<? echo $t_strPosition; ?>" size="10" maxlength="10" readonly></td>
                                                        <td class="paragraph"> 
                                                          <? 
											$t_intAuthorizeSalary = $objReport->authorizeSalary($t_strEmpNumber, $t_strItemNumber); 
											?>
                                                          Authorize Salary :</td>
                                                        <td><input name="t_intAuthorizeSalary" type="text" id="t_intAuthorizeSalary" value="<? echo $t_intAuthorizeSalary; ?>" size="10" maxlength="15" readonly></td>
                                                      </tr>
                                                      <tr> 
                                                        <td colspan="4"><hr></td>
                                                      </tr>
                                                      <tr> 
                                                        <td width="25%" class="paragraph">Appointment 
                                                          Status :</td>
                                                        <td width="25%"> 
                                                          <?php 
										$result = mysql_query ("SELECT * FROM tblAppointment");
										echo "<SELECT NAME=\"t_strAppointmentDesc\">\r";
										if ($row = mysql_fetch_array($result)) {
										do {
											if ($t_strAppointmentDesc == $row["appointmentDesc"])
											{
												print "<OPTION VALUE=\"".($row["appointmentDesc"])."\" selected>".($row["appointmentDesc"])."\r";
											}
										  print "<OPTION VALUE=\"".($row["appointmentDesc"])."\">".($row["appointmentDesc"])."\r";
										} while($row = mysql_fetch_array($result));
										} else {print "no results!";}
										echo "</SELECT>\r";
										?>
                                                        </td>
                                                        <td width="21%" class="paragraph">Plantilla 
                                                          Page No. :</td>
                                                        <td width="29%"><input name="t_intPlantillaPageNumber" type="text" size="10" maxlength="10"> 
                                                          <span class="required">*</span> 
                                                        </td>
                                                      </tr>
                                                      <tr> 
                                                        <td class="paragraph">Reason 
                                                          for Appointment : </td>
                                                        <td><input name="t_strAppointmentReason" type="text" id="t_strAppointmentReason3" size="20" maxlength="50"> 
                                                          <span class="required">*</span> 
                                                        </td>
                                                        <td class="paragraph">CSC 
                                                          MC Number :</td>
                                                        <td><input name="t_strCSCMCNumber" type="text" id="t_strCSCMCNumber2" size="20" maxlength="20"> 
                                                          <span class="required">*</span> 
                                                        </td>
                                                      </tr>
                                                      <tr> 
                                                        <td width="25%" class="paragraph">In 
                                                          replacement of :</td>
                                                        <td> 
                                                          <?php 
										$result = mysql_query ("SELECT surname, firstname, middlename FROM tblEmpPersonal ORDER BY surname, firstname, middlename ASC");
										$t_strEmpFullName = $row['firstname'] . " " . " " . $row['middlename'] . " " . $row['surname'];
										echo "<SELECT NAME=\"t_strEmpFullName\">\r";
										if ($row = mysql_fetch_array($result)) {
										do {
											if ($t_strEmpFullName == $row['firstname'] . " " . " " . $row['middlename'] . " " . $row['surname'])
											{
												print "<OPTION VALUE=\"".($row['firstname'] . " " . " " . $row['middlename'] . " " . $row['surname'])."\" selected>".($row['surname'] . ',' . " " . $row['firstname'] . " " . $row['middlename'])."\r";
											}
										  print "<OPTION VALUE=\"".($row['firstname'] . " " . " " . $row['middlename'] . " " . $row['surname'])."\">".($row['surname'] . ',' . " " . $row['firstname'] . " " . $row['middlename'])."\r";
										} while($row = mysql_fetch_array($result));
										} else {print "no results!";}
										echo "</SELECT>\r";
										?>
                                                        </td>
                                                        <td width="21%" class="paragraph">Published 
                                                          Where :</td>
                                                        <td width="29%"><input name="t_strPublishedWhere" type="text" id="t_strPublishedWhere2" size="20" maxlength="50"> 
                                                          <span class="required">*</span> 
                                                        </td>
                                                      </tr>
                                                      <tr> 
                                                        <td width="25%" class="paragraph">Reason 
                                                          for replacement : </td>
                                                        <td> 
                                                          <?php 
										$result = mysql_query ("SELECT * FROM tblSeparationCause");
										echo "<SELECT NAME=\"t_strSeparationCause\">\r";
										if ($row = mysql_fetch_array($result)) {
										do {
											if ($t_strSeparationCause == $row["separationCause"])
											{
												print "<OPTION VALUE=\"".($row["separationCause"])."\" selected>".($row["separationCause"])."\r";
											}
										  print "<OPTION VALUE=\"".($row["separationCause"])."\">".($row["separationCause"])."\r";
										} while($row = mysql_fetch_array($result));
										} else {print "no results!";}
										echo "</SELECT>\r";
										?>
                                                        </td>
                                                        <td width="21%" class="paragraph">Published 
                                                          When :</td>
                                                        <td width="29%"><select name="cboYear"  onChange="updateList(cboMonth.selectedIndex,this[this.selectedIndex].text,'cboDay')">
                                                            <?
								  	$objReport->comboYear($cboYear);
								  ?>
                                                          </select> <select name="cboMonth" onChange="updateList(this.selectedIndex,cboYear[cboYear.selectedIndex].text,'cboDay')">
                                                            <?
								  	$objReport->comboMonth($cboMonth);
								  ?>
                                                          </select> <select name="cboDay">
                                                            <?
								  	$objReport->comboDay($cboDay);
								  ?>
                                                          </select> </td>
                                                      </tr>
                                                      <tr> 
                                                        <td colspan="4"><hr> </td>
                                                      </tr>
                                                      <tr> 
                                                        <td colspan="4">&nbsp;</td>
                                                      </tr>
                                                    </table></td>
                                                </tr>
                                                <tr> 
                                                  <td height="0" colspan="5"> 
                                                    <?
}
elseif($cboReports == 'RPDF')
{
?>
                                                  </td>
                                                </tr>
                                                <tr> 
                                                  <td height="0" colspan="5"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                      <tr> 
                                                        <td colspan="4">&nbsp;</td>
                                                      </tr>
                                                      <tr> 
                                                        <td width="50%" colspan="4" align="center"><font class="paragraph">Year</font> 
                                                          :&nbsp; <select name="cboYear" id="cboYear" onChange="updateList(cboMonth.selectedIndex,this[this.selectedIndex].text,'cboDay')">
                                                            <?
								  	$objReport->comboYear($cboYear);
								  ?>
                                                          </select>
                                                          <font class="paragraph">Month 
                                                          </font> :&nbsp; <select name="cboMonth" id="cboMonth" onChange="updateList(this.selectedIndex,cboYear[cboYear.selectedIndex].text,'cboDay')">
                                                            <?
								  	$objReport->comboMonth($cboMonth);
								  ?>
                                                          </select> <font class="paragraph">Day 
                                                          </font> : 
                                                          <select name="cboDay" id="cboDay">
                                                            <?
								  	$objReport->comboDay($cboDay);
								  ?>
                                                          </select> </td>
                                                      </tr>
                                                      <tr> 
                                                        <td colspan="4">&nbsp;</td>
                                                      </tr>
                                                      <tr> 
                                                        <td colspan="4"><hr></td>
                                                      </tr>
                                                      <tr> 
                                                        <td class="paragraph">Present 
                                                          Item Number : </td>
                                                        <td> 
                                                          <?
														$result = mysql_query ("SELECT * FROM tblPlantilla");
														echo "<SELECT NAME=\"t_strItemNumber\" onChange=\"presentItemNumberRequirement()\">";
														if ($row = mysql_fetch_array($result)) {
														do {
														if ($t_strItemNumber == $row["itemNumber"])
														{
														print "<OPTION VALUE=\"".$row["itemNumber"]."\" selected>".$row["itemNumber"]."\r";
														}
														print "<OPTION VALUE=\"".$row["itemNumber"]."\">".$row["itemNumber"]."\r";
														} while($row = mysql_fetch_array($result));
														} else {print "no results!";}
														echo "</SELECT>";
														?>
                                                          <span class="required"> 
                                                          * </span></td>
                                                        <td class="paragraph"> 
                                                          <? 
											$t_intAuthorizeSalary = $objReport->authorizeSalary($t_strEmpNumber, $t_strItemNumber); 
											?>
                                                          Authorize/Actual Salary 
                                                          :</td>
                                                        <td><input name="t_intAuthorizeSalary" type="text" value="<? echo $t_intAuthorizeSalary; ?>" size="10" maxlength="15" readonly> 
                                                        </td>
                                                      </tr>
                                                      <tr> 
                                                        <td class="paragraph"> 
                                                          <? 
											$t_strPosition = $objReport->positionCode($t_strEmpNumber, $t_strItemNumber); 
											?>
                                                          Position Code :</td>
                                                        <td><input name="t_strPositionCode" type="text" value="<? echo $t_strPosition; ?>" size="30" maxlength="50" readonly> 
                                                        </td>
                                                        <td class="paragraph"> 
                                                          <? 
											$t_intAuthorizeSalaryYear = $objReport->authorizeSalaryYear($t_strItemNumber);
											?>
                                                          Authorize Salary per 
                                                          annum : </td>
                                                        <td><input name="t_intAuthorizeSalaryYr" type="text" value="<? echo $t_intAuthorizeSalaryYear; ?>" size="10" maxlength="15" readonly> 
                                                        </td>
                                                      </tr>
                                                      <tr> 
                                                        <td colspan="4"><hr></td>
                                                      </tr>
                                                      <tr> 
                                                        <td width="24%" class="paragraph">Department/Local 
                                                          Gov't :</td>
                                                        <td> 
                                                          <?
														$result = mysql_query("SELECT agencyName, abbreviation FROM tblAgency");
														$row = mysql_fetch_array($result);
														$t_strAgencyName = $row['agencyName'];
														$t_strAgencyAbbreviation = $row['abbreviation'];
														echo "<input name=\"t_strAgencyName\" type=\"text\" value=\"$t_strAgencyAbbreviation\" size=\"20\" maxlength=\"50\" readonly>"; 
														?>
                                                          <span class="required"> 
                                                          * </span> </td>
                                                        <td class="paragraph">Bureau 
                                                          or Office :</td>
                                                        <td><input name="t_strBureau" type="text" size="20" maxlength="30"></td>
                                                      </tr>
                                                      <tr> 
                                                        <td width="24%" class="paragraph">Dept./Branch/Division 
                                                          : </td>
                                                        <td> 
                                                          <? $objReport->comboDivision("t_strDivision", $t_strDivision, $t_strOnChange=''); ?>
                                                          <span class="required">*</span> 
                                                        </td>
                                                        <td class="paragraph">Work 
                                                          Station/Place of Work 
                                                          :</td>
                                                        <td><input name="t_strWorkPlace" type="text" size="20" maxlength="50"> 
                                                        </td>
                                                      </tr>
                                                      <tr> 
                                                        <td height="20" class="paragraph">Previous 
                                                          Item Number :</td>
                                                        <td><select name="t_strPrevItemNumber">
                                                            <? $objReport->comboItemNumber(t_strItemNumber); ?>
                                                          </select></td>
                                                        <td class="paragraph">other 
                                                          Compensation :</td>
                                                        <td><input name="t_intOthers" type="text" size="20" maxlength="20"> 
                                                        </td>
                                                      </tr>
                                                      <tr> 
                                                        <td width="24%" class="paragraph">Position 
                                                          title of supervisor 
                                                          : </td>
                                                        <td><input name="t_strSupervisor" type="text" size="20" maxlength="50"> 
                                                          <span class="required"> 
                                                          * </span></td>
                                                        <td width="30%" class="paragraph">Position 
                                                          of next higher supervisor 
                                                          :</td>
                                                        <td width="21%"><input name="t_strNextSupervisor" type="text" size="20" maxlength="50"> 
                                                        </td>
                                                      </tr>
                                                      <tr> 
                                                        <td width="24%" class="paragraph">Working 
                                                          or Proposed Title :</td>
                                                        <td><input name="t_strWorkingTitle" type="text" size="20" maxlength="50"></td>
                                                        <td class="paragraph">WAPCO 
                                                          classification position:</td>
                                                        <td width="21%"><input name="t_strWAPCO" type="text" size="20" maxlength="50"></td>
                                                      </tr>
                                                      <tr> 
                                                        <td colspan="4"><hr> </td>
                                                      </tr>
                                                      <tr> 
                                                        <td colspan="4"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                            <tr> 
                                                              <td width="61%" class="paragraph">Names, 
                                                                titles, and item 
                                                                nos. of those 
                                                                you directly supervise 
                                                                : </td>
                                                              <td width="39%"><textarea name="t_strNameTitleItem" cols="20"></textarea></td>
                                                            </tr>
                                                          </table></td>
                                                      </tr>
                                                      <tr> 
                                                        <td colspan="4"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                            <tr> 
                                                              <td width="61%" class="paragraph">Machines, 
                                                                equipment, tools, 
                                                                etc. used regularly 
                                                                in performance 
                                                                of work :</td>
                                                              <td width="39%"><textarea name="t_strMachineTools" cols="20"></textarea></td>
                                                            </tr>
                                                          </table></td>
                                                      </tr>
                                                      <tr> 
                                                        <td colspan="4">&nbsp;</td>
                                                      </tr>
                                                    </table></td>
                                                </tr>
                                                <tr> 
                                                  <td height="0" colspan="5">&nbsp;</td>
                                                </tr>
                                                <tr> 
                                                  <td height="0" colspan="5">&nbsp;</td>
                                                </tr>
                                                <tr> 
                                                  <td height="0" colspan="5">&nbsp;</td>
                                                </tr>
                                                <tr> 
                                                  <td height="1" colspan="5"> 
                                                    <?
}
?>
                                                  </td>
                                                </tr>
                                                <tr> 
                                                  <td height="5" colspan="5">&nbsp;</td>
                                                </tr>
                                                <tr> 
                                                  <td height="20" colspan="5" align="center"> 
                                                    <input type="button" name="Submit" value="PRINT/PREVIEW" onClick="openPrint()"> 
                                                  </td>
                                                </tr>
                                              </table></td>
                          </tr>
                        </table>
						</form>								  
								      <!-- InstanceEndEditable --></td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
        <tr bgcolor="#E9F3FE"> 
            <td height="13" colspan="2" valign="bottom"><table width="100%" height="13" border="0" cellpadding="0" cellspacing="0" bgcolor="#002E7F" id="OUTERTBL4">
                <tr> 
                  <td height="13" valign="bottom"><div align="center"> 
                      <p class="login"><font color="#FFFFFF">Copyright &copy; 
                        2003 Department of Science and Technology</font></p>
                    </div></td>
                </tr>
              </table></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</div>
</body>
<!-- InstanceEnd --></html>
