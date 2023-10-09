<script language="JavaScript">
/* 
File Name: Leave.js
----------------------------------------------------------------------
Purpose of this file: 
Traps inputs, dates, call to print report
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

function daysApplied(t_intDayFrom, t_intDayTo, t_strLeaveDay)
{
	var intDaysApp = t_intDayTo - t_intDayFrom + 1;
	
	if(t_strLeaveDay)
	{
		intDaysApp = intDaysApp * 0.5;
	}
	
	document.all.txtDaysApp.value = intDaysApp
}


function changeSpecific(t_strModule)
{
	var strEmpNmbr = "<? echo $strEmpNmbr ?>";
	var strLeave = document.all.cboLeaveType.value;
	try
	{
		var strSpecify = document.all.cboSpecifyLeave.value;
	}
	catch(error)
	{
		var strSpecify = "";
	}
	
	if(t_strModule == "employee")
	{
		window.location = "Empleave.php?cboLeaveType="+strLeave+"&cboSpecifyLeave="+strSpecify+"&strEmpNmbr="+strEmpNmbr;
	}
	else
	{
		window.location = "Chiefleave.php?cboLeaveType="+strLeave+"&cboSpecifyLeave="+strSpecify+"&strEmpNmbr="+strEmpNmbr;
	}
}

function trapEntryLeave()
{
	var intMonthFrom, intMonthTo, intDayFrom, intDayTo, intYearFrom, intYearTo
	var dtmDateToday = new Date(<?php echo($objEmpLeave->getDateToday())?>);
	var strReason = document.all.txtReason.value 

	intMonthFrom = document.all.cboMonthFrom.value;
	try
	{
		intMonthTo = document.all.cboMonthTo.value;
	}
	catch(error)
	{
		intMonthTo = document.all.cboMonthFrom.value;
	}
	
	intDayFrom = document.all.cboDayFrom.value;	
	try
	{		
		intDayTo = document.all.cboDayTo.value;
	}
	catch(error)
	{
		intDayTo = document.all.cboDayFrom.value;
	}
	
	intYearFrom = document.all.cboYearFrom.value;
	try
	{
		intYearTo = document.all.cboYearTo.value;
	}
	catch(error)
	{
		intYearTo = document.all.cboYearFrom.value;
	}
	
	if(strReason.length == 0)
	{
		alert("Please enter a reason!");
		document.all.txtReason.focus();
		event.returnValue=false;
	}
	else if(parseInt(intYearFrom) > parseInt(intYearTo))
	{
		alert("Please enter correct year from!");
		document.all.cboYearFrom.focus();
		event.returnValue=false;
	}
	else if(intYearFrom == intYearTo)
	{
		if(intMonthFrom == intMonthTo)
		{	
			if(parseInt(intDayFrom) > parseInt(intDayTo))
			{
				alert("Please enter correct day from!");
				document.all.cboDayFrom.focus();
				event.returnValue=false;
			}
			else
			{
				event.returnValue=true;
			}				
		}
		else if(parseInt(intMonthFrom) > parseInt(intMonthTo))
		{
			alert("Please enter correct month from!");
			document.all.cboMonthFrom.focus();
			event.returnValue=false;
		}
		else
		{
			event.returnValue=true;
		}
	}
	else
	{
		event.returnValue=true;
	}			
}

function openPrint()
{
	
	var intMonthFrom, intMonthTo, intDayFrom, intDayTo, intYearFrom, intYearTo
	var intLeaveDay = document.all.txtDaysApp.value;
	var strLeave = document.all.cboLeaveType.value
	var strReason = document.all.txtReason.value 
	var strEmpNmbr = "<? echo $arrEmpPersonal['empNumber'];?>";
	var strPage, strSpecifyLeave	
	
	try
	{
		strSpecifyLeave = document.all.cboSpecifyLeave.value
	}
	catch(error)
	{
		strSpecifyLeave = "";
	}
	
	intMonthFrom = document.all.cboMonthFrom.value;
	try
	{
		intMonthTo = document.all.cboMonthTo.value;
	}
	catch(error)
	{
		intMonthTo = document.all.cboMonthFrom.value;
	}
	
	intDayFrom = document.all.cboDayFrom.value;	
	try
	{		
		intDayTo = document.all.cboDayTo.value;
	}
	catch(error)
	{
		intDayTo = document.all.cboDayFrom.value;
	}
	
	intYearFrom = document.all.cboYearFrom.value;
	try
	{
		intYearTo = document.all.cboYearTo.value;
	}
	catch(error)
	{
		intYearTo = document.all.cboYearFrom.value;
	}

	if(event.returnValue)
	{
		strPage = "PrintRequestData.php?strEmpNmbr="+strEmpNmbr+"&strReport=LV&intMonthFrom="+intMonthFrom+"&intMonthTo="+intMonthTo+"&intDayFrom="+intDayFrom+"&intDayTo="+intDayTo+"&intYearFrom="+intYearFrom+"&intYearTo="+intYearTo+"&strReason="+strReason+"&strLeave="+strLeave+"&strSpecifyLeave="+strSpecifyLeave+"&intLeaveDay="+intLeaveDay;
		window.open(strPage, '_blank','toolbar=no,location=no,directories=no,status=0,menubar=0,scrollbars=1,resizable=0,width=780,height=528');	
	}
}
</script>
