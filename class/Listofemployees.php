<?php 
/* 
File Name: Listofemployees.php (class folder)
----------------------------------------------------------------------
Purpose of this file: 
To add employee's personal data.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Donna Gay Reyes
----------------------------------------------------------------------
Date of Revision: April 18, 2004
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
require_once("../hrmis/class/General.php");

class Listofemployees extends General
{

	function Listofemployees() 
   	{
      include("../hrmis/class/Connect.php");   //the dbase connection
   	}
		
	function viewListOfEmployees($strEmpNmbr, $t_intPage, $t_intCurrPage)   //view list of employee
	{
	
		$objEmpList = "SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname,
							 tblEmpPersonal.firstname, tblEmpPosition.statusOfAppointment,
							 tblEmpPosition.positionCode, tblPosition.positionCode,
							 tblEmpPosition.empNumber
							FROM tblEmpPersonal
								INNER JOIN tblEmpPosition
									ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
								INNER JOIN tblPosition
									ON tblEmpPosition.positionCode = tblPosition.positionCode
							WHERE tblEmpPosition.statusOfAppointment = 'In-Service'
							 	ORDER BY tblEmpPersonal.surname asc";
											
		//$numOfEmployees = 0;								 
		$objEmp = mysql_query($objEmpList);
		$intTotalRecord = mysql_num_rows($objEmp);
		$this->set($t_intPage, $intTotalRecord, $t_intCurrPage);
		$objEmpList = "$objEmpList LIMIT ".$this->limit();
		$objEmp = mysql_query($objEmpList);
							
		if(mysql_num_rows($objEmp))
		{
			while($arrEmp = mysql_fetch_array($objEmp))
			{
				$strEmpNmbr = $arrEmp["empNumber"];
				$strEmpNum = $arrEmp['empNumber'];
				$strName = $arrEmp['surname']. ", ".$arrEmp['firstname'];
				$strEmpStatus = $arrEmp['statusOfAppointment'];

	  		    $numOfEmployees = $numOfEmployees + 1;
			   
			   if ($strEmpStatus = 'In-Service') 
			   {
				   //echo "<td width='5%'>&nbsp;&nbsp;" .$numOfEmployees . "</td>";
				   echo "<tr><td width='25%'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $arrEmp['empNumber'] . "</td>"; 
				   echo "<td width='50%'>&nbsp;&nbsp;&nbsp;&nbsp;" . ucwords(strtolower($arrEmp['surname']. ", ".$arrEmp['firstname'])) . "</td></tr>";                     

				}
			
		   }	//  end while		
echo "Total Number of Employees : " . $intTotalRecord;
	   }	//  end if
	   
	}	//	end function

	
}	//	end class
?>