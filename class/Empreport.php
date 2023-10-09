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
class Empreport extends General
{

	function empReport() 
   	{
      include("../hrmis/class/Connect.php");   //the dbase connection
   	}
   
	function addDTR($t_strEmpNumber, $t_strEmpReport, $t_strReportRequestCode, $t_dtmDTRMonth, $t_dtmDTRYear, $t_dtmStatusDate, $t_strRequestStatus, $Submit)   //Add employee daily time record on table employee request
   {
      if ($Submit == 'Submit')
	  { 	  
	  	 $t_strReportRequestCode = "Report";
		 $t_strRequestStatus = "Filed Request";	  
 		 $t_dtmDTRDate = $this->combineMonthYear($t_dtmDTRYear, $t_dtmDTRMonth);
		 $t_strRequestDetails = " $t_strEmpReport;" . "  $t_dtmDTRDate;";
	     $results = "INSERT INTO tblEmpRequest (empNumber, requestCode, requestDetails, statusDate, requestStatus) VALUES  ('$t_strEmpNumber', '$t_strReportRequestCode', '$t_strRequestDetails', '$t_dtmStatusDate', '$t_strRequestStatus')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Employee daily time record request not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}	
	
		function addRemittances($t_strEmpNumber, $t_strEmpReport, $t_strReportRequestCode, $t_strRemittanceDesc, $t_dtmRemittanceMonth, $t_dtmRemittanceYear, $t_dtmStatusDate, $t_strRequestStatus, $Submit)  //Add employee remittances report request
   {
      if ($Submit == 'Submit')
	  { 
	  	 $t_strReportRequestCode = "Report";	  
		 $t_strRequestStatus = "Filed Request";	  
 		 $t_dtmRemittanceDate = $this->combineMonthYear($t_dtmRemittanceYear, $t_dtmRemittanceMonth);
		 $t_strRequestDetails = "$t_strEmpReport;" . "$t_strRemittanceDesc;" . "$t_dtmRemittanceDate;";
	     $results = "INSERT INTO tblEmpRequest (empNumber, requestCode, requestDetails, statusDate, requestStatus) VALUES  ('$t_strEmpNumber', '$t_strReportRequestCode', '$t_strRequestDetails', '$t_dtmStatusDate', '$t_strRequestStatus')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Employee remittance report request not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}	

	function addPayslip($t_strEmpNumber, $t_strEmpReport, $t_strReportRequestCode, $t_dtmPayslipMonth, $t_dtmPayslipYear, $t_dtmStatusDate, $t_strRequestStatus, $Submit)   //Add employee payslip request
   {
      if ($Submit == 'Submit')
	  { 
	     $t_strReportRequestCode = "Report";	  
		 $t_strRequestStatus = "Filed Request";	  
 		 $t_dtmPayslipDate = $this->combineMonthYear($t_dtmPayslipYear, $t_dtmPayslipMonth);
		 $t_strRequestDetails = " $t_strEmpReport;" . " $t_dtmPayslipDate;";
	     $results = "INSERT INTO tblEmpRequest (empNumber, requestCode, requestDetails, statusDate, requestStatus) VALUES  ('$t_strEmpNumber', '$t_strReportRequestCode', '$t_strRequestDetails', '$t_dtmStatusDate', '$t_strRequestStatus')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Employee payslip request not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}	

	function addCEC($t_strEmpNumber, $t_strEmpReport, $t_strCECRequestCode, $t_dtmCECMonth, $t_dtmCECYear, $t_dtmStatusDate, $t_strRequestStatus, $Submit)   //Add employee certificate of compensation request
   {
      if ($Submit == 'Submit')
	  { 
	     $t_strReportRequestCode = "Report";	  
		 $t_strRequestStatus = "Filed Request";	  
		 $t_strRequestDetails = " $t_strEmpReport;" . " $t_dtmCECDate;";
 		 $t_dtmCECDate = $this->combineMonthYear($t_dtmCECYear, $t_dtmCECMonth);
		 $t_strRequestDetails = " $t_strEmpReport;" . " $t_dtmCECDate;";
	     $results = "INSERT INTO tblEmpRequest (empNumber, requestCode, requestDetails, statusDate, requestStatus) VALUES  ('$t_strEmpNumber', '$t_strReportRequestCode', '$t_strRequestDetails', '$t_dtmStatusDate', '$t_strRequestStatus')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Employee certificate of compensation request not added:</b> ", mysql_error(); 
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
  function addServiceRecord($t_strEmpNumber, $t_strEmpReport, $t_strCECRequestCode, $t_dtmStatusDate, $t_strRequestStatus, $Submit)   //Add employee certificate of compensation request
   {
      if ($Submit == 'Submit')
	  { 
	     $t_strReportRequestCode = "Report";	  
		 $t_strRequestStatus = "Filed Request";	
		 //$t_dtmCECDate = $this->combineMonthYear($t_dtmCECYear, $t_dtmCECMonth);
		 //$t_strRequestDetails = " $t_strEmpReport;" . " $t_dtmCECDate;";
	     $results = "INSERT INTO tblEmpRequest (empNumber, requestCode, statusDate, requestStatus) VALUES  ('$t_strEmpNumber', '$t_strReportRequestCode', '$t_dtmStatusDate', '$t_strRequestStatus')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Employee Service Record request not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}  
}	//  end class
?>