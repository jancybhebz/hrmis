<?php 
/*________________________________________________________________
lixlpixel PHParadise
*************************************************************************************
category :		databases															*			
																					*	
snippet :		mySQL to excel														*
																					*
downloaded :	10.17.2004 - 23:22													*			
																					*
file URL :		http://www.fundisom.com/phparadise/snip/databases/mySQL_to_excel	*
																					*
description :	export a mySQL database table to an EXCEL file.						*
				database table dump to WORD document possible also.					*
*************************************************************************************
*/
header("Content-Type: application/$vnd.ms-excel");
header("Content-Disposition: inline; filename=\"file.xls\"");
//header("Expires: 0"); 

//session_start();
require_once("../hrmis/class/General.php");
require_once("../hrmis/class/Constant.php");
require('../hrmis/class/ReportDeductionReg.php');

class ReportDR //extends General
{
	var $objRprt;
	
	function generateReport()
	{
		$this->objRprt = new ReportDeductionReg;
		
		$sep = "\t"; 
		$arrDeductCodes = array();
		
				
		$objDeductionCode = mysql_query("SELECT deductionCode FROM tblDeduction ORDER BY  deductionAbb");

		while($arrDeductionCode = mysql_fetch_array($objDeductionCode))
    	{
	    	$strDeductionCode = $arrDeductionCode['deductionCode'];
	
    		//query all deductions with greater than 0 amount		
			$objColumnName = mysql_query("SELECT SUM(tblEmpDeductRemit.deductAmount) as grandTotal 
	      							  	  FROM tblEmpDeductRemit
			    					  		INNER JOIN tblEmpPersonal
								  				ON tblEmpPersonal.empNumber = tblEmpDeductRemit.empNumber
											INNER JOIN tblEmpPosition
												ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
											INNER JOIN tblEmpDeduction
												ON tblEmpPosition.empNumber = tblEmpDeduction.empNumber
								  			INNER JOIN tblDeduction
								  				ON tblEmpDeduction.deductionCode = tblDeduction.deductionCode
								  			WHERE tblEmpDeductRemit.deductionCode = '$strDeductionCode'
								  				AND tblEmpDeduction.deductionCode = '$strDeductionCode'
								  				AND tblDeduction.deductionCode = '$strDeductionCode'
												AND tblEmpPosition.statusOfAppointment = 'In-Service'
												AND tblEmpDeductRemit.deductMonth = '".$_SESSION['sesCshrMonth']."'
												AND tblEmpDeductRemit.deductYear = '".$_SESSION['sesCshrYear']."'");
			
			$arrColumName = mysql_fetch_array($objColumnName);
			
			
			if($arrColumName['grandTotal'] > 0)
			{
				array_push($arrDeductCodes,$strDeductionCode);
				
			}
			

		 } // end of while loop
		  
		 $objEmployees = mysql_query("SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
											 tblEmpPersonal.firstname, tblEmpPersonal.middlename,
											 tblDivision.divisionName, tblDivision.projectCode 
									   FROM tblEmpPersonal
									   INNER JOIN tblEmpPosition
									   		ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
									   INNER JOIN tblDivision
									   		ON tblEmpPosition.divisionCode = tblDivision.divisionCode
									   WHERE tblEmpPosition.statusOfAppointment = 'In-Service'
									   ORDER BY tblEmpPosition.divisionCode asc, tblEmpPersonal.surname asc,
									   		tblEmpPersonal.firstname asc");
		 
		 
		 while($arrEmployees = mysql_fetch_array($objEmployees))
		 {
		 	$strEmpNum = $arrEmployees['empNumber'];
			$strMidInitial = substr($arrEmployees['middlename'], 1,1);
			$strEmpName = $arrEmployees['surname'].", ".$arrEmployees['firstname']." ".$strMidInitial.".";
			$strDivisionName = $arrEmployees['divisionName'];
		 	$strProjectCode = 	$arrEmployees['projectCode'];
			
			foreach ($arrDeductCodes as $key=>$valueDeductCode)
		 	{ 
			  $objEmpDeduction=mysql_query("SELECT tblEmpPersonal.empNumber,tblEmpDeductRemit.deductAmount
										    FROM tblEmpPersonal
											   INNER JOIN tblEmpDeductRemit
											 	  	ON tblEmpPersonal.empNumber = tblEmpDeductRemit.empNumber
											   INNER JOIN tblDeduction
											  		ON tblEmpDeductRemit.deductionCode = tblDeduction.deductionCode
										     WHERE tblEmpDeductRemit.deductionCode = '$valueDeductCode'
								  				AND tblDeduction.deductionCode = '$valueDeductCode'
												AND tblEmpPersonal.empNumber = '$strEmpNum'
												AND tblEmpDeductRemit.deductMonth = '".$_SESSION['sesCshrMonth']."'
												AND tblEmpDeductRemit.deductYear = '".$_SESSION['sesCshrYear']."'");
				
				
			 } //END OF FOREACH					
		 
		 } //END OF WHILE
		 foreach ($arrDeductCodes as $key=>$valueDeductCode)
		 { 
   			print $value.' '.$sep.' '.$sep; 
			$objEmpDeduction=mysql_query("SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
												 tblEmpPersonal.firstname, tblEmpPersonal.middlename,
												 tblDivision.divisionName, tblEmpDeductRemit.deductAmount
										   FROM tblEmpPersonal
											  INNER JOIN tblEmpPosition
												ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
											  INNER JOIN tblEmpDeductRemit
											  	ON tblEmpPosition.empNumber = tblEmpDeductRemit.empNumber
											  INNER JOIN tblDeduction
											  	ON tblEmpDeductRemit.deductionCode = tblDeduction.deductionCode
											  INNER JOIN tblDivision
											  	ON tblEmpPosition.divisionCode = tblDivision.divisionCode
										    WHERE tblEmpDeductRemit.deductionCode = '$valueDeductCode'
								  				AND tblDeduction.deductionCode = '$valueDeductCode'
												AND tblEmpPosition.statusOfAppointment = 'In-Service'
												AND tblEmpDeductRemit.deductMonth = '".$_SESSION['sesCshrMonth']."'
												AND tblEmpDeductRemit.deductYear = '".$_SESSION['sesCshrYear']."'
									   	     ORDER BY tblEmpPosition.divisionCode asc, tblEmpPersonal.surname asc, 
													  tblEmpPersonal.firstname asc");
			
			while ($arrEmpDeduction = mysql_fetch_array($objEmpDeduction))
			{
				
				$strDeductAmount = $arrEmpDeduction['deductAmount'];
			}
		 }	
		 
		 
		 
		 

		
	 } //end of function
} //end of class
	
	
//print("\n");
//end of printing column names

//start while loop to get data
/*while($row = mysql_fetch_row($result))
{
	//set_time_limit(60); // HaRa
	$schema_insert = "";
	for($j=0; $j<mysql_num_fields($result);$j++)
	{
		if(!isset($row[$j]))
			$schema_insert .= "NULL".$sep;
		elseif ($row[$j] != "")
			$schema_insert .= "$row[$j]".$sep;
		else
			$schema_insert .= "".$sep;
	}
	$schema_insert = str_replace($sep."$", "", $schema_insert);
	//following fix suggested by Josue (thanks, Josue!)
	//this corrects output in excel when table fields contain \n or \r
	//these two characters are now replaced with a space
	$schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
	$schema_insert .= "\t";
	print(trim($schema_insert));
	print "\n";
}*/

?>


