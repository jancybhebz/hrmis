<script language="JavaScript">
/* 
File Name: JSgeneral.php
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

//-------------------------- logout ----------------------------------
function logoutwindow()
{
	strLink = "http://"+"<? echo $SERVER_NAME?>"+"/hrmis/index.php";
	poppedwin=window.open(strLink,'_blank','fullscreen=no, toolbar=yes');
	mainwindow = window.self; 
	mainwindow.opener = window.self; 
	mainwindow.close(); 
	poppedwin.focus(); 
}	
//-------------------------- month days lenght ----------------------------------

var monthLength = new Array(31,28,31,30,31,30,31,31,30,31,30,31)

function updateList(month,year,target)
{
     var obj = document.getElementById(target)
     monthLength[1] = 28
     if(year % 4 == 0 && year % 100 != 0)
          monthLength[1] = 29
     if(year % 400 == 0)
          monthLength[1] = 29
     obj.length = 0
     for(i = 0; i < monthLength[month]; i++)
     {
          obj.length++
          obj[obj.length - 1].value = i+1
		  obj[obj.length - 1].text = i+1
     }
}

//-------------------------------------status bar security ----------------------------------------
function statusBar()
{
	window.status="Human Resource Management Information System";
}
</script>