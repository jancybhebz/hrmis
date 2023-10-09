<?php 
/* 
File Name: Income.php
----------------------------------------------------------------------
Purpose of this file: 
To add, edit, delete additional income.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: JDG
----------------------------------------------------------------------
Date of Revision:January 13, 2003
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

class Income
{


	function Income() 
   {
      include("Connect.php");   //the dbase connection
   }
   
   function inputIncome($strEmpNmbr, $empNumber, $incomeCode, $incomeAmount, $Submit, $incomeCode1, $incomeAmount1, $i, $p, $txtSearch, $t_strEmpNumber, $optField) //Add additional Income
   {
		
		switch ($Submit) { 
			case "SUBMIT"    :	$searchresults = "SELECT * FROM tblIncomeDetails WHERE empNumber='$empNumber'";							   
		    			    	$searchResults = mysql_query($searchresults) or die (mysql_error());
						  		if(!$row = mysql_fetch_array($searchResults)) 
								 {	
									for ($i=0; $i<12; $i++) {
										$results = "INSERT INTO tblIncomeDetails (empNumber, incomeCode, incomeAmount) VALUES ('$empNumber','$incomeCode1[$i]', '$incomeAmount1[$i]')";
		 				   				mysql_query($results) or die (mysql_error());
										echo "<meta http-equiv=\"refresh\" content=\"0; url=CEmployeeincome.php?strEmpNmbr=$strEmpNmbr&p=$p&txtSearch=$txtSearch&t_strEmpNumber=$t_strEmpNumber&optField=$optField\">";
						   			}
									if(!$results) {
	     				   				echo "<b>Income details not added:</b> ", mysql_error(); 
		    			   				exit; } 
						    		if($results) { return 1; }
						   			break;
								} else { 
									for ($i=0; $i<12; $i++) {
									$updateResults = "UPDATE tblIncomeDetails SET empNumber='$empNumber', incomeCode='$incomeCode1[$i]', incomeAmount='$incomeAmount1[$i]' WHERE empNumber='$empNumber' and incomeCode='$incomeCode1[$i]'";
			 						$modifyResults = mysql_query($updateResults);
									echo "<meta http-equiv=\"refresh\" content=\"0; url=CEmployeeincome.php?strEmpNmbr=$strEmpNmbr&p=$p&txtSearch=$txtSearch&t_strEmpNumber=$t_strEmpNumber&optField=$optField\">";
						   			}			
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
	
	function viewIncome($empNumber, $incomeCode)
	{
		 $viewResults = mysql_query("SELECT incomeAmount FROM tblIncomeDetails WHERE empNumber='$empNumber' and incomeCode='$incomeCode'");
		 if(!$row = mysql_fetch_array($viewResults))
		 { 
		 echo " ";
		 }
		 else
		 {
			$incomeAmount=$row['incomeAmount'];
			echo $incomeAmount;
		 }	
	}
	
}
?> 