<?
/* 
File Name: Taxdetails.php
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
Date of Revision: November 23, 2004
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
class Taxdetails
{


		
	function Taxdetails()
	{
		include("../hrmis/class/Connect.php");   //the dbase connection
	}
	
	function inputTaxDetails($strEmpNmbr, $empNumber, $otherDependent1, $dRelationship1, $dBirthDate1, $pTin1, $pAddress1, $pEmployer1, $pTin21, $pAddress21, $pEmployer21, $pTaxComp1, $pTaxWheld1, $Submit, $p, $txtSearch, $t_strEmpNumber, $optField) //Add additional Income
   {
		
		switch ($Submit) { 
			case "SUBMIT"    :	$searchresults = "SELECT * FROM tblTaxDetails WHERE empNumber='$empNumber'";							   
		    			    	$searchResults = mysql_query($searchresults) or die (mysql_error());
						  		if(!$row = mysql_fetch_array($searchResults)) 
								 {	
										$results = "INSERT INTO tblTaxDetails (empNumber, otherDependent, dRelationship, dBirthDate, pTin, pAddress, pEmployer, pTin1, pAddress1, pEmployer1, pTaxComp, pTaxWheld) 
													VALUES ('$empNumber','$otherDependent1', '$dRelationship1', '$dBirthDate1', '$pTin1', '$pAddress1', '$pEmployer1', '$pTin21', '$pAddress21', '$pEmployer21', '$pTaxComp1', '$pTaxWheld1')";
		 				   				mysql_query($results) or die (mysql_error());
										echo "<meta http-equiv=\"refresh\" content=\"0; url=CTaxdetails.php?strEmpNmbr=$strEmpNmbr&p=$p&txtSearch=$txtSearch&t_strEmpNumber=$t_strEmpNumber&optField=$optField\">";
						   			
									if(!$results) {
	     				   				echo "<b>Tax details not added:</b> ", mysql_error(); 
		    			   				exit; } 
						    		if($results) { return 1; }
						   			break;
								} else { 
									
									$updateResults = "UPDATE tblTaxDetails SET empNumber='$empNumber', otherDependent='$otherDependent1', dRelationship='$dRelationship1', dBirthDate='$dBirthDate1', pTin='$pTin1', pAddress='$pAddress1',
													  pEmployer='$pEmployer1', pTin1='$pTin21', pAddress1='$pAddress21', pEmployer1='$pEmployer21', pTaxComp='$pTaxComp1', pTaxWheld='$pTaxWheld1'
													  WHERE empNumber='$empNumber'";
			 						$modifyResults = mysql_query($updateResults);
									echo "<meta http-equiv=\"refresh\" content=\"0; url=CTaxdetails.php?strEmpNmbr=$strEmpNmbr&p=$p&txtSearch=$txtSearch&t_strEmpNumber=$t_strEmpNumber&optField=$optField\">";
						   						
									if(!$modifyResults) { 
										echo "<b>Income not modify not modify:</b> ", mysql_error(); 
										exit; 			} 
			 						if($modifyResults)  { return 1; }
								}
								break;			
						   
			case "Edit1"   	:	$editresults = "SELECT * FROM tblIncomeDetails WHERE empNumber='$empNumber' and incomeCode='$incomeCode1'";							   
		    			    	$editResults = mysql_query($editresults) or die (mysql_error());
						  		if(!$row = mysql_fetch_array($editResults)) 
								 {
								 echo " ";
								 }
								else { 			
									do {
			   							$incomeAmount1 =$row['incomeAmount'];
										echo $incomeAmount1;
										} 
									while($row=mysql_fetch_array($editResults)); }
							
						   		break;
								
			case "Edit"   :
									if ($incomeCode == $incomeCode1) {
										$incomeAmount1 = '$incomeAmount';
										return $incomeAmount1;
									}
									
						   		break;	
						   								
			case "Submit" :		$updateResults = "UPDATE tblIncomeDetails SET empNumber='$empNumber', incomeCode='$incomeCode1', incomeAmount='$incomeAmount' WHERE empNumber='$empNumber' and incomeCode='$incomeCode1'";
			 					$modifyResults = mysql_query($updateResults);
							
								if(!$modifyResults) { 
									echo "<b>Add Income not modify not modify:</b> ", mysql_error(); 
									exit; 			} 
			 					if($modifyResults)  { return 1; }
								//echo "<meta http-equiv=\"refresh\" content=\"0; url=Taxexemption.php\">";
								break; 
							
			default       : break;				
			}
	}
	
	function viewTaxDetails($empNumber)
	{
		 $viewResults = mysql_query("SELECT * FROM tblTaxDetails WHERE empNumber='$empNumber'");
		 if(!$infoTax = mysql_fetch_array($viewResults))
		 { 
		 echo " ";
		 }
		 else
		 {
			return $infoTax;
		 }	
	}
	
}	//  end class		
?>