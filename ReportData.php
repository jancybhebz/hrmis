<?
/* 
File Name: ReportData.php 
----------------------------------------------------------------------
Purpose of this file: 
pass the variables to PrintReport.php
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Brian Jill DG. Sarandi
----------------------------------------------------------------------
Date of Revision: July 15, 2004
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

session_register('empNmbr');
session_register('report');
session_register('month');
session_register('year');
session_register('FromToLB');
session_register('headFoot');
session_register('dateTrng');
session_register('place');
session_register('trng');
session_register('reason');
session_register("empPerSelect");
session_register("divSecCode");

require("../hrmis/class/General.php");
class ViewReport extends General
{
	function datePrint($t_intMonthFrom, $t_intDayFrom, $t_intYearFrom, $t_intMonthTo, $t_intDayTo, $t_intYearTo)
	{
		if($t_intMonthFrom == $t_intMonthTo && $t_intYearFrom == $t_intYearTo)
		{   //para sa output na August 12-25, 2002
			$strMonthFrom = $this->intToMonthFull($t_intMonthFrom);
			$_SESSION['dateTrng'] = $strMonthFrom." ".$t_intDayFrom." - ".$t_intDayTo.", ".$t_intYearFrom;
		}
		elseif($intYearFrom == $intYearTo)
		{   //para sa output na August 12- September 25, 2002
			$strMonthTo = $this->intToMonthFull($t_intMonthTo);
			$strMonthFrom = $this->intToMonthFull($t_intMonthFrom);
			$_SESSION['dateTrng'] = $strMonthFrom." ".$t_intDayFrom." - "
									.$strMonthTo." ".$t_intDayTo.", ".$t_intYearFrom;
		}
		else
		{   //para sa output na August 12, 2002 - September 12, 2003
			$strMonthTo = $this->intToMonthFull($t_intMonthTo);
			$strMonthFrom = $this->intToMonthFull($t_intMonthFrom);
			$_SESSION['dateTrng'] = $strMonthFrom." ".$t_intDayFrom.", ".$t_intYearFrom." - "
									.$strMonthTo." ".$t_intDayTo.", ".$t_intYearTo;		
		}
	}
}

$objViewRprt = new ViewReport;

$_SESSION["empPerSelect"] = $strEmpSelect;
$_SESSION["divSecCode"] = $strDivSec;
$_SESSION['empNmbr'] = $strEmpNmbr;
$_SESSION['report'] = $strReports;
$_SESSION['month'] = $intMonth;
$_SESSION['year'] = $intYear;
$_SESSION['period'] = $intPeriod;
$_SESSION['day'] = $intDay;

if(strlen($strReason) != 0)
{   //for urgency
	$objViewRprt->datePrint($intMonthFrom, $intDayFrom, $intYearFrom, $intMonthTo, $intDayTo, $intYearTo);	
	$_SESSION['place'] = $strPlace;
	$_SESSION['trng'] = $strTrng;
	$_SESSION['reason'] = $strReason;
}
if(strlen($strSponsor) != 0)
{   //for endorsement
	$objViewRprt->datePrint($intMonthFrom, $intDayFrom, $intYearFrom, $intMonthTo, $intDayTo, $intYearTo);	
	$_SESSION['place'] = $strPlace;
	$_SESSION['trng'] = $strTrng;
	$_SESSION['sponsor'] = $strSponsor;
	$_SESSION['organizer'] = $strOrganizer;
}
$arrFromTo = array("MonthFrom"=>$intMonthFrom, "MonthTo"=>$intMonthTo, 
				"YearFrom"=>$intYearFrom, "YearTo"=>$intYearTo, "Period"=>$intLB);
$_SESSION['FromToLB'] = $arrFromTo;

if(strlen($intMonthTo) != 0 && strlen($intYearTo) != 0)
{   //for leave balance
	$_SESSION['month'] = $arrFromTo["MonthTo"];
	$_SESSION['year'] = $arrFromTo["YearTo"];
}

$_SESSION['sesLtrDate'] = $intLtrDay." ".$objViewRprt->intToMonthFull($intLtrMonth)." ".$intLtrYear;
$_SESSION['sesRcvDate'] = $intRcvDay." ".$objViewRprt->intToMonthFull($intRcvMonth)." ".$intRcvYear;
$_SESSION['sesAcptDate'] = $intAcptDay." ".$objViewRprt->intToMonthFull($intAcptMonth)." ".$intAcptYear;

if($strReports == "DTR" || $strReports == "PS" || $strReports == "AS")
{
	$_SESSION['headFoot'] = 0;
}
elseif($strReports == "LWOP")
{
	$_SESSION['headFoot'] = 2;
}
elseif($strReports == "TR")
{
	$_SESSION['headFoot'] = 3;
}
elseif($strReports == "MA")
{
	$_SESSION['headFoot'] = 4;
}
elseif($strReports == "MCR")
{
	$_SESSION['headFoot'] = 5;
}
elseif($strReports == "HPR")
{
	$_SESSION['headFoot'] = 6;
}
elseif($strReports == "HYA")
{
	$_SESSION['headFoot'] = 7;
}
elseif($strReports == "AAR")
{
	$_SESSION['headFoot'] = 8;
}
elseif($strReports == "EAS")
{
$_SESSION['headFoot'] = 9;
}
elseif($strReports == "AFC")
{
$_SESSION['headFoot'] = 10;
}
else
{
	$_SESSION['headFoot'] = 1;
}

header("Location: PrintReport.php");
?>