<?
/* 
File Name: Override.php
----------------------------------------------------------------------
Purpose of this file: 
Class Deduction
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: JDG
----------------------------------------------------------------------
Date of Revision: February 10, 2003
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
require("../hrmis/class/General.php");
class Override extends General
{
var $strDeductionCode;
var $strngEmpNumber;

		
	function Override()
	{
		include("../hrmis/class/Connect.php");   //the dbase connection
	}
	
	function comboDeductCode($deductionCode)
	{
		$objDeductCode = mysql_query("SELECT deductionCode, deductionDesc FROM tblDeduction WHERE deductionType = 'premium' or deductionType = 'loan'");
		$flag = 0;
		if($row = mysql_fetch_array($objDeductCode))     {
		   do {
		   		$strAddDeductionCode = $row["deductionCode"];
				$strAddDeductionDesc = $row["deductionDesc"];
				if($flag == 0)
				{
					$this->strDeductionCode = $row["deductionCode"];
					$flag = 1;
				}
				
				if($deductionCode == $strAddDeductionCode)
					echo "<option value='$strAddDeductionCode' selected>$strAddDeductionDesc</option>";
				else
					echo "<option value='$strAddDeductionCode'>$strAddDeductionDesc</option>";
				//echo "<div align=\"center\">"; 
                //echo "<input name=\"strFixedAmount\" type=\"text\" class=\"tbtext\" value='$strFixedAmount'>";
                //echo "</div>";
				
			  } 
			while($row= mysql_fetch_array($objDeductCode)); 	}
				
	}
	
	function comboEmpList($empNumber)
	{
		$objEmpList = mysql_query("SELECT concat(pe.surname,' , ',pe.firstname) as fullname, pe.empNumber, po.statusOfAppointment 
				  From tblEmpPersonal pe
				  LEFT JOIN tblEmpPosition po
				  ON pe.empNumber = po.empNumber
				  Where po.statusOfAppointment = 'In-Service'
				  ORDER BY pe.surname");
				  
		$flag = 0;
		if($row = mysql_fetch_array($objEmpList))     {
		   do {
		   		$strAddEmpNumber = $row["empNumber"];
				$strAddEmpList = $row["fullname"];
				if($flag == 0)
				{
					$this->strngEmpNumber = $row["empNumber"];
					$flag = 1;
				}
				
				if($empNumber == $strAddEmpNumber)
					echo "<option value='$strAddEmpNumber' selected>$strAddEmpList</option>";
				else
					echo "<option value='$strAddEmpNumber'>$strAddEmpList</option>";
				//echo "<div align=\"center\">"; 
                //echo "<input name=\"strFixedAmount\" type=\"text\" class=\"tbtext\" value='$strFixedAmount'>";
                //echo "</div>";
				
			  } 
			while($row= mysql_fetch_array($objEmpList)); 	}
				
	}
		
	function valueAmount($deductionCode, $empNumber, $cboMonth, $cboYear)
	{
		if (strlen($deductionCode) == 0)
		{
			$deductionCode = $this->strDeductionCode;
		}
		
		if (strlen($empNumber) == 0)
		{
			$empNumber = $this->strngEmpNumber;
		}
		
		$objDeductionCode = mysql_query("SELECT deductAmount FROM tblEmpDeductRemit
											WHERE empNumber='$empNumber' and deductionCode='$deductionCode' and deductMonth='$cboMonth' and deductYear='$cboYear'");
		$row = mysql_fetch_array($objDeductionCode);
		return $row["deductAmount"];
		
	}
	
	function overrideDeduct($strEmpNmbr, $empNumber, $deductionCode, $deductAmount, $cboMonth, $cboYear, $Submit) //Add deduction
   {
		
		switch ($Submit) { 
			case "ADD"    :	$results = "INSERT INTO tblEmpDeductRemit (empNumber, deductionCode, deductAmount, deductMonth, deductYear) 
										VALUES ('$empNumber', '$deductionCode', '$deductAmount', '$cboMonth', '$cboYear')";
		 				   	mysql_query($results) or die (mysql_error());
							echo "<meta http-equiv=\"refresh\" content=\"0; url=CDeductionupdate.php?strEmpNmbr=$strEmpNmbr\">";
						   	if(!$results) {
	     				   	echo "<b>Employee Deduction not added:</b> ", mysql_error(); 
		    			   	exit; } 
						    //if($results) { return 1; }
						   	break;
						   								
			case "UPDATE" :	$updateResults = "UPDATE tblEmpDeductRemit SET empNumber='$empNumber', deductionCode='$deductionCode', deductMonth='$cboMonth', 
											  deductYear='$cboYear', deductAmount='$deductAmount' 
											  WHERE empNumber='$empNumber' and deductionCode='$deductionCode' and deductMonth='$cboMonth' and 
											  deductYear='$cboYear'";
			 				$modifyResults = mysql_query($updateResults);
							echo "<meta http-equiv=\"refresh\" content=\"0; url=CDeductionupdate.php?strEmpNmbr=$strEmpNmbr\">";
							if(!$modifyResults) { 
								echo "<b>Employee Deduction not modify:</b> ", mysql_error(); 
								exit; 			} 
			 				if($modifyResults)  { return 1; }
							break; 
							
			//case "Delete":	return 1 ; break;
							
			case "DELETE" 	:	$delete = "DELETE FROM tblEmpDeductRemit WHERE empNumber='$empNumber' and deductionCode='$deductionCode' and deductMonth='$cboMonth' and 
											  deductYear='$cboYear'";  
	      						$del = mysql_query($delete);
								echo "<meta http-equiv=\"refresh\" content=\"0; url=CDeductionupdate.php?strEmpNmbr=$strEmpNmbr\">";
							break;
			
			default       : break;				
			}
	}

}		
?>