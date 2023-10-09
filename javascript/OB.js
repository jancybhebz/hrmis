<script language="JavaScript">
/* 
File Name: OB.js
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
Date of Revision: September 10, 2004
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

function trapEntryOB(t_strPlace, t_strErrorMsg, t_strPurpose, t_intMonthFrom, t_intMonthTo, t_intDayFrom, t_intDayTo, t_intYearFrom, t_intYearTo, t_intHourFrom, t_intHourTo, t_intMinFrom, t_intMinTo, t_intSecFrom, t_intSecTo, t_intTimeFrom, t_intTimeTo)
{
	var dtmDateToday = new Date(<?php echo($objEmpOB->getDateToday())?>);
	
	var intMonthFrom = t_intMonthFrom.value;
	var intMonthTo = t_intMonthTo.value;		
	var intDayFrom = t_intDayFrom.value;
	var intDayTo = t_intDayTo.value;		
	var intYearFrom = t_intYearFrom.value;
	var intYearTo = t_intYearTo.value;

	var strPlace = t_strPlace.value;
	var strPurpose = t_strPurpose.value;
	
	var intHourFrom = t_intHourFrom.value;
	var intHourTo = t_intHourTo.value;		
	var intMinFrom = t_intMinFrom.value;
	var intMinTo = t_intMinTo.value;		
	var intSecFrom = t_intSecFrom.value;
	var intSecTo = t_intSecTo.value;
	var intTimeFrom = t_intTimeFrom.value;
	var intTimeTo = t_intTimeTo.value;

	if(strPlace.length == 0)
	{
		alert("Please enter "+t_strErrorMsg+"!");
		t_strPlace.focus();
		event.returnValue=false;
	}
	else if(strPurpose.length == 0)
	{
		alert("Please enter purpose!");
		t_strPurpose.focus();
		event.returnValue=false;
	}
	else if(parseInt(intYearFrom) > parseInt(intYearTo) || parseInt(intYearFrom) < dtmDateToday.getFullYear())
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
				if (intTimeFrom == "PM" && intTimeTo == "AM")
				{
					alert("Please enter correct time from!");
					t_intTimeFrom.focus();
					event.returnValue=false;			
					
				}
				else if(intTimeFrom == intTimeTo)
				{
					if(intHourFrom == "00")
					{
						alert("Please enter correct time from!");
						t_intHourFrom.focus();
						event.returnValue=false;
					}
					else if(intHourTo == "00")
					{
						alert("Please enter correct time to!");
						t_intHourTo.focus();
						event.returnValue=false;
					}
					else if(intHourFrom == intHourTo)
					{
						if(intMinFrom == intMinTo)
						{
							if(parseInt(intSecFrom) >= parseInt(intSecTo))
							{
								alert("Please enter correct time from!");
								t_intSecFrom.focus();
								event.returnValue=false;
							}
							else
							{
								event.returnValue=true;
							}
						}
						else if(parseInt(intMinFrom) > parseInt(intMinTo))
						{
							alert("Please enter correct time from!");
							t_intMinFrom.focus();
							event.returnValue=false;
						}
						else
						{
							event.returnValue=true;
						}
					}
					else if((parseInt(intHourFrom) > parseInt(intHourTo) && intHourFrom != '12') || (parseInt(intHourFrom) < parseInt(intHourTo) && intHourTo == '12'))
					{
						alert("Please enter correct time from!");
						t_intHourFrom.focus();
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
		}
		else if(parseInt(intMonthFrom) > parseInt(intMonthTo) || parseInt(intMonthFrom) < parseInt(dtmDateToday.getMonth()-1))
		{
			alert("Please enter correct month from!");
			document.all.cboMonthFrom.focus();
			event.returnValue=false;
		}
		else
		{		
			if (intTimeFrom == "PM" && intTimeTo == "AM")
			{
				alert("Please enter correct time from!");
				t_strTimeFrom.focus();
				event.returnValue=false;			
				
			}
			else if(intTimeFrom == intTimeTo)
			{
				if(intHourFrom == "00")
				{
					alert("Please enter correct time from!");
					t_intHourFrom.focus();
					event.returnValue=false;
				}
				else if(intHourTo == "00")
				{
					alert("Please enter correct time to!");
					t_intHourTo.focus();
					event.returnValue=false;
				}
				else if(intHourFrom == intHourTo)
				{
					if(intMinFrom == intMinTo)
					{
						if(parseInt(intSecFrom) >= parseInt(intSecTo))
						{
							alert("Please enter correct time from!");
							t_intSecFrom.focus();
							event.returnValue=false;
						}
						else
						{
							event.returnValue=true;
						}
					}
					else if(parseInt(intMinFrom) > parseInt(intMinTo))
					{
						alert("Please enter correct time from!");
						t_intMinFrom.focus();
						event.returnValue=false;
					}
					else
					{
						event.returnValue=true;
					}
				}
				else if((parseInt(intHourFrom) > parseInt(intHourTo) && intHourFrom != '12') || (parseInt(intHourFrom) < parseInt(intHourTo) && intHourTo == '12'))
				{
					alert("Please enter correct time from!");
					t_intHourFrom.focus();
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
	}
	else
	{	
		if (intTimeFrom == "PM" && intTimeTo == "AM")
		{
			alert("Please enter correct time from!");
			t_strTimeFrom.focus();
			event.returnValue=false;			
			
		}
		else if(intTimeFrom == intTimeTo)
		{
			if(intHourFrom == "00")
			{
				alert("Please enter correct time from!");
				t_intHourFrom.focus();
				event.returnValue=false;
			}
			else if(intHourTo == "00")
			{
				alert("Please enter correct time to!");
				t_intHourTo.focus();
				event.returnValue=false;
			}
			else if(intHourFrom == intHourTo)
			{
				if(intMinFrom == intMinTo)
				{
					if(parseInt(intSecFrom) >= parseInt(intSecTo))
					{
						alert("Please enter correct time from!");
						t_intSecFrom.focus();
						event.returnValue=false;
					}
					else
					{
						event.returnValue=true;
					}
				}
				else if(parseInt(intMinFrom) > parseInt(intMinTo))
				{
					alert("Please enter correct time from!");
					t_intMinFrom.focus();
					event.returnValue=false;
				}
				else
				{
					event.returnValue=true;
				}
			}
			else if((parseInt(intHourFrom) > parseInt(intHourTo) && intHourFrom != '12') || (parseInt(intHourFrom) < parseInt(intHourTo) && intHourTo == '12'))
			{
				alert("Please enter correct time from!");
				t_intHourFrom.focus();
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
}

function openPrint(t_intOB, t_strPlace, t_strPurpose, t_intMonthFrom, t_intMonthTo, t_intDayFrom, t_intDayTo, t_intYearFrom, t_intYearTo, t_intHourFrom, t_intHourTo, t_intMinFrom, t_intMinTo, t_intSecFrom, t_intSecTo, t_intTimeFrom, t_intTimeTo)
{
	var strEmpNmbr = "<? echo $arrEmpPersonal['empNumber'];?>";
	var strOB, intOB = t_intOB[0].checked;
	
	var intMonthFrom = t_intMonthFrom.value;
	var intMonthTo = t_intMonthTo.value;		
	var intDayFrom = t_intDayFrom.value;
	var intDayTo = t_intDayTo.value;		
	var intYearFrom = t_intYearFrom.value;
	var intYearTo = t_intYearTo.value;

	var strPlace = t_strPlace.value;
	var strPurpose = t_strPurpose.value;
	
	var intHourFrom = t_intHourFrom.value;
	var intHourTo = t_intHourTo.value;		
	var intMinFrom = t_intMinFrom.value;
	var intMinTo = t_intMinTo.value;		
	var intSecFrom = t_intSecFrom.value;
	var intSecTo = t_intSecTo.value;
	var intTimeFrom = t_intTimeFrom.value;
	var intTimeTo = t_intTimeTo.value;

	var strPage
	
	if(intOB)
	{
		strOB = 'Y';
	}
	else
	{
		strOB = 'N';
	} 
	
	if(event.returnValue)
	{
		strPage = "PrintRequestData.php?strEmpNmbr="+strEmpNmbr+"&strReport=OB&strOB="+strOB+"&intMonthFrom="+intMonthFrom+"&intMonthTo="+intMonthTo+"&intDayFrom="+intDayFrom+"&intDayTo="+intDayTo+"&intYearFrom="+intYearFrom+"&intYearTo="+intYearTo+"&intHourFrom="+intHourFrom+"&intHourTo="+intHourTo+"&intMinFrom="+intMinFrom+"&intMinTo="+intMinTo+"&intSecFrom="+intSecFrom+"&intSecTo="+intSecTo+"&intTimeFrom="+intTimeFrom+"&intTimeTo="+intTimeTo+"&strPlace="+strPlace+"&strPurpose="+strPurpose;
		window.open(strPage, '_blank','toolbar=no,location=no,directories=no,status=0,menubar=0,scrollbars=1,resizable=0,width=780,height=528');
	}
}
</script>
