<script language="JavaScript">
/* 
File Name: TravelOrder.js
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

function trapFormEntry(t_strDstntn, t_strPurpose, t_intMonthFrom, t_intYearFrom, t_intDayFrom, t_intMonthTo, t_intYearTo, t_intDayTo)
{
	var strDstntn = t_strDstntn.value
	var strPurpose = t_strPurpose.value
	var intMonthFrom = t_intMonthFrom.value
	var intMonthTo = t_intMonthTo.value
	var intYearFrom = t_intYearFrom.value
	var intYearTo = t_intYearTo.value
	var intDayFrom = t_intDayFrom.value
	var intDayTo = t_intDayTo.value
	if(strDstntn.length == 0)
	{
		alert("Please enter destination!");
		t_strDstntn.focus();
		event.returnValue=false;
	}	
	else if(strPurpose.length == 0)
	{
		alert("Please enter purpose!");
		t_strPurpose.focus();
		event.returnValue=false;
	}
	else if(parseInt(intYearFrom) > parseInt(intYearTo))
	{
		alert("Please enter correct year from!");
		t_intYearFrom.focus();
		event.returnValue=false;
	}
	else if(intYearFrom == intYearTo)
	{
		if(intMonthFrom == intMonthTo)
		{	
			if(parseInt(intDayFrom) > parseInt(intDayTo))
			{
				alert("Please enter correct day from!");
				t_intDayFrom.focus();
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
			t_intMonthFrom.focus();
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

function openPrint(t_strPlace, t_strPurpose, t_intMonthFrom, t_intYearFrom, t_intDayFrom, t_intMonthTo, t_intYearTo, t_intDayTo, t_strFund, t_strTranspo, t_intPerdiem)
{
	var strEmpNmbr = "<? echo $arrEmpPersonal['empNumber'];?>";
	var strPerdiem, intPerdiem = t_intPerdiem[0].checked;
	
	var intMonthFrom = t_intMonthFrom.value;
	var intMonthTo = t_intMonthTo.value;		
	var intDayFrom = t_intDayFrom.value;
	var intDayTo = t_intDayTo.value;		
	var intYearFrom = t_intYearFrom.value;
	var intYearTo = t_intYearTo.value;

	var strPlace = t_strPlace.value;
	var strPurpose = t_strPurpose.value;
	var strFund = t_strFund.value;
	var strTranspo = t_strTranspo.value;

	var strPage
	
	if(intPerdiem)
	{
		strPerdiem = 'Y';
	}
	else
	{
		strPerdiem = 'N';
	} 
	
	if(event.returnValue)
	{
		strPage = "PrintRequestData.php?strEmpNmbr="+strEmpNmbr+"&strReport=TO&strPerdiem="+strPerdiem+"&intMonthFrom="+intMonthFrom+"&intMonthTo="+intMonthTo+"&intDayFrom="+intDayFrom+"&intDayTo="+intDayTo+"&intYearFrom="+intYearFrom+"&intYearTo="+intYearTo+"&strPlace="+strPlace+"&strPurpose="+strPurpose+"&strFund="+strFund+"&strTranspo="+strTranspo;
		window.open(strPage, '_blank','toolbar=no,location=no,directories=no,status=0,menubar=0,scrollbars=1,resizable=0,width=780,height=528');
	}
}
</script>
