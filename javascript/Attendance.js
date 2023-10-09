<script language="JavaScript">
/* 
File Name: Attendance.js
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


function checkDate()
{
	var intMonth;
	var dtmDateNow = new Date(<?php echo($objAttendance->getDateToday())?>);
	
	intMonth = document.frmAttendance.cboMonth.value;
	var intYear = document.frmAttendance.cboYear.value;	

	if(intYear == dtmDateNow.getYear())
	{
		if(intMonth > dtmDateNow.getMonth() + 3)
		{
			alert("You cannot select month and year that is more than 3 months ahead of the present time!");
			event.returnValue=false;		
		}
	}
	else if(intYear > dtmDateNow.getYear())
	{
		alert("You cannot select month and year that is more than 3 months ahead of the present time!");
		event.returnValue=false;				
	}
	
}
</script>