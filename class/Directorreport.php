<?php 
/* 
File Name: Empreport.php (class folder)
----------------------------------------------------------------------
Purpose of this file: 
To add employee's official business.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco
----------------------------------------------------------------------
Date of Revision: January 15, 2004
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
class Directorreport extends General
{

	function directorReport() 
   	{
      include("../hrmis/class/Connect.php");   //the dbase connection
   	}
   	
		function addRemittances($strEmpNmbr, $t_strDirectorReport, $t_strReportRequestCode, $t_strRemittanceDesc, $t_dtmRemittanceMonth, $t_dtmRemittanceYear, $t_dtmStatusDate, $t_strRequestStatus, $Submit)  //Add director remittances report request
   {
      if ($Submit == 'Submit')
	  { 
	  	 $t_strReportRequestCode = "Report";	  
 		 $t_dtmRemittanceDate = $this->combineMonthYear($t_dtmRemittanceYear, $t_dtmRemittanceMonth);
		 $t_strRequestDetails = "$t_strDirectorReport;"  . "$t_strRemittanceDesc;" .  "$t_dtmRemittanceDate;";
	     $results = "INSERT INTO tblEmpRequest (empNumber, requestCode, requestDetails, statusDate, requestStatus) VALUES  ('$strEmpNmbr', '$t_strReportRequestCode', '$t_strRequestDetails', '$t_dtmStatusDate', '$t_strRequestStatus')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Director remittance report request not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}	

	function addPayslip($strEmpNmbr, $t_strDirectorReport, $t_strReportRequestCode, $t_dtmPayslipMonth, $t_dtmPayslipYear, $t_dtmStatusDate, $t_strRequestStatus, $Submit)   //Add director payslip request
   {
      if ($Submit == 'Submit')
	  { 
	     $t_strReportRequestCode = "Report";	  
 		 $t_dtmPayslipDate = $this->combineMonthYear($t_dtmPayslipYear, $t_dtmPayslipMonth);
		 $t_strRequestDetails = "$t_strDirectorReport;" . "$t_dtmPayslipDate;";
	     $results = "INSERT INTO tblEmpRequest (empNumber, requestCode, requestDetails, statusDate, requestStatus) VALUES  ('$strEmpNmbr', '$t_strReportRequestCode', '$t_strRequestDetails', '$t_dtmStatusDate', '$t_strRequestStatus')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Director payslip request not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}	

	function addCEC($strEmpNmbr, $t_strDirectorReport, $t_strCECRequestCode, $t_dtmCECMonth, $t_dtmCECYear, $t_dtmStatusDate, $t_strRequestStatus, $Submit)   //Add director certificate of compensation request
   {
      if ($Submit == 'Submit')
	  { 
	     $t_strReportRequestCode = "Report";	  
 		 $t_dtmCECDate = $this->combineMonthYear($t_dtmCECYear, $t_dtmCECMonth);
		 $t_strRequestDetails = "$t_strDirectorReport;" . "$t_dtmCECDate;";
	     $results = "INSERT INTO tblEmpRequest (empNumber, requestCode, requestDetails, statusDate, requestStatus) VALUES  ('$strEmpNmbr', '$t_strReportRequestCode', '$t_strRequestDetails', '$t_dtmStatusDate', '$t_strRequestStatus')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Director certificate of compensation request not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}	

	function comboRemittances($t_strRemittanceDesc)
	{
		$objRemittance = mysql_query("SELECT * 
								FROM tblDeduction 
								WHERE deductionType = 'Loan'
								ORDER BY deductionCode ASC");

		echo "<SELECT NAME=\"t_strRemittanceDesc\">\r";
		echo "<option></option>";
		if ($arrRemit = mysql_fetch_array($objRemittance)) {
		do {
			if ($t_strRemittanceDesc == $arrRemit["deductionDesc"])
			{
				print "<OPTION VALUE=\"".$arrRemit["deductionDesc"]."\" selected>".$arrRemit["deductionDesc"]."\r";
			}
		  print "<OPTION VALUE=\"".$arrRemit["deductionDesc"]."\">".$arrRemit["deductionDesc"]."\r";
		} while($arrRemit = mysql_fetch_array($objRemittance));
		} else {print "no results!";}
		echo "</SELECT>\r";
	}

}	//  end class
?>