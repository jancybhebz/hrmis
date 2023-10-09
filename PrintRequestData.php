<?
/* 
File Name: PrintRequestData.php 
----------------------------------------------------------------------
Purpose of this file: 
pass the data to PrintRequest.php
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

if ($strReport == 'OB')
{
	session_register('sesEmpNmbr');
	session_register('sesRprt');	
	session_register('sesOB');
	session_register('sesMnFr');
	session_register('sesMnTo');
	session_register('sesDyFr');
	session_register('sesDyTo');
	session_register('sesYrFr');
	session_register('sesYrTo');
	session_register('sesHrFr');
	session_register('sesHrTo');
	session_register('sesMntFr');
	session_register('sesMntTo');
	session_register('sesScFr');
	session_register('sesScTo');
	session_register('sesTmFr');
	session_register('sesTmTo');
	session_register('sesPlc');
	session_register("sesPrps");

	$sesEmpNmbr = $strEmpNmbr;
	$sesRprt = $strReport;
	$sesOB = $strOB;
	$sesMnFr = $intMonthFrom;
	$sesMnTo = $intMonthTo;
	$sesDyFr = $intDayFrom;
	$sesDyTo = $intDayTo;
	$sesYrFr = $intYearFrom;
	$sesYrTo = $intYearTo;
	$sesHrFr = $intHourFrom;
	$sesHrTo = $intHourTo;
	$sesMntFr = $intMinFrom;
	$sesMntTo = $intMinTo;
	$sesScFr = $intSecFrom;
	$sesScTo = $intSecTo;
	$sesTmFr = $intTimeFrom;
	$sesTmTo = $intTimeTo;
	$sesPlc = $strPlace;
	$sesPrps = $strPurpose;
}
elseif ($strReport == 'LV')
{
	session_register('sesEmpNmbr');
	session_register('sesRprt');
	session_register('sesMnFr');
	session_register('sesMnTo');
	session_register('sesDyFr');
	session_register('sesDyTo');
	session_register('sesYrFr');
	session_register('sesYrTo');
	session_register('sesRsn');
	session_register('sesLvTyp');
	session_register('sesSpcfyLv');
	session_register('sesLvDy');

	$sesEmpNmbr = $strEmpNmbr;
	$sesRprt = $strReport;
	$sesMnFr = $intMonthFrom;
	$sesMnTo = $intMonthTo;
	$sesDyFr = $intDayFrom;
	$sesDyTo = $intDayTo;
	$sesYrFr = $intYearFrom;
	$sesYrTo = $intYearTo;
	$sesRsn = $strReason;
	$sesLvTyp = $strLeave;
	$sesSpcfyLv = $strSpecifyLeave;
	$sesLvDy = $intLeaveDay;
}
elseif($strReport == 'TO')
{
	session_register('sesEmpNmbr');
	session_register('sesRprt');
	session_register('sesMnFr');
	session_register('sesMnTo');
	session_register('sesDyFr');
	session_register('sesDyTo');
	session_register('sesYrFr');
	session_register('sesYrTo');
	session_register('sesPrdm');
	session_register('sesPlc');
	session_register('sesPrps');
	session_register('sesFnd');
	session_register('sesTrnsp');

	$sesEmpNmbr = $strEmpNmbr;
	$sesRprt = $strReport;
	$sesMnFr = $intMonthFrom;
	$sesMnTo = $intMonthTo;
	$sesDyFr = $intDayFrom;
	$sesDyTo = $intDayTo;
	$sesYrFr = $intYearFrom;
	$sesYrTo = $intYearTo;	
	$sesPrdm = $strPerdiem;
	$sesPlc = $strPlace;
	$sesPrps = $strPurpose;
	$sesFnd = $strFund;
	$sesTrnsp = $strTranspo;
}

elseif($strReport == 'MTU')
{
	session_register('sesEmpNmbr');
	session_register('sesRprt');
	session_register('sesMnthNm');
	session_register('sesYr');

	$sesEmpNmbr = $strEmpNmbr;
	$sesRprt = $strReport;
	$sesMnthNm = $strMonth;
	$sesYr = $strYear;
}

header("Location: PrintRequest.php");
?>