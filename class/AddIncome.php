<?php 
/* 
File Name: AddIncome.php
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
Date of Revision: November 07, 2003
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

class AddIncome
{
var $strAddIncome;

	function AddIncome() 
   {
      include("Connect.php");   //the dbase connection
   }
   
   function inputAddIncome($strEmpNmbr, $empNumber, $addIncomeCode, $addIncomeAmount, $addIncomeYear, $Submit2, $addIncomeCode1, $p, $txtSearch, $optField) //Add additional Income
   {
		
		switch ($Submit2) { 
			case "ADD"    : $searchresults = "SELECT * FROM tblEmpAddIncome WHERE empNumber='$empNumber' and addIncomeCode='$addIncomeCode'";							   
		    			    $searchResults = mysql_query($searchresults) or die (mysql_error());	
							if($row = mysql_fetch_array($searchResults)) 
								 {
								 //echo "<meta http-equiv=\"refresh\" content=\"0; url=CEmployeeincome.php?p=$p&txtSearch=$txtSearch\">";	
								 echo "<center><span class=\"warning\">Add Income already exist</span></center><br> ";
								 }
							else {
								$results = "INSERT INTO tblEmpAddIncome (empNumber, addIncomeCode, addIncomeAmount, addIncomeYear) VALUES ('$empNumber','$addIncomeCode', '$addIncomeAmount', '$addIncomeYear')";
		 				   		mysql_query($results) or die (mysql_error());
								echo "<meta http-equiv=\"refresh\" content=\"0; url=CEmployeeincome.php?strEmpNmbr=$strEmpNmbr&p=$p&txtSearch=$txtSearch&optField=$optField\">";
						   		if(!$results) {
	     				   			echo "<b>Add Income not added:</b> ", mysql_error(); 
		    			   			exit; } 
						    	if($results) { return 1; }
								}
						   	break;
						   
			case "Edit"   :	$editresults = "SELECT * FROM tblEmpAddIncome WHERE empNumber='$empNumber', addIncomeAmount='$addIncomeAmount' and addIncomeYear='$addIncomeYear'";							   
		    			    $editResults = mysql_query($editresults) or die (mysql_error());
						  	if($row = mysql_fetch_array($editResults))     {
		    					do {
			   						$addIncomeCode=$row['addIncomeCode'];
			   						$strFixedAmount=$row['addIncomeAmount'];
									} 
								while($row=mysql_fetch_array($editResults)); }
						   	break;
						   								
			case "Submit" :	$updateResults = "UPDATE tblEmpAddIncome SET empNumber='$empNumber', addIncomeCode='$addIncomeCode', addIncomeAmount='$addIncomeAmount',  addIncomeYear='$addIncomeYear' WHERE empNumber='$empNumber' and addIncomeCode='$addIncomeCode1'";
			 				$modifyResults = mysql_query($updateResults);
							
							if(!$modifyResults) { 
								echo "<b>Add Income not modify not modify:</b> ", mysql_error(); 
								exit; 			} 
			 				if($modifyResults)  { return 1; }
							//echo "<meta http-equiv=\"refresh\" content=\"0; url=Taxexemption.php\">";
							break; 
							
			case "Delete":	return 1 ; break;
							
			case "OK" 	:	$delete = "DELETE FROM tblEmpAddIncome WHERE empNumber='$empNumber' and addIncomeCode='$addIncomeCode'";  
	      					$del = mysql_query($delete);
							echo "<meta http-equiv=\"refresh\" content=\"0; url=CEmployeeincome.php?strEmpNmbr=$strEmpNmbr&p=$p&txtSearch=$txtSearch&optField=$optField\">";

							break;
			
			default       : break;				
			}
	}					
		

	function viewAddIncome($strEmpNmbr, $empNumber, $p, $txtSearch, $optField) // view additional income for cashier
    {
	     $viewResults = mysql_query("SELECT * FROM tblEmpAddIncome WHERE empNumber='$empNumber'");
		 if(!$row = mysql_fetch_array($viewResults))
		 { 
		 echo " "; 
		 }
		 else
		 {
		 	$empNumber=$row['empNumber'];			
			$addIncomeCode=$row['addIncomeCode'];
			$addIncomeAmount=$row['addIncomeAmount'];
	   
		 echo "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
		 echo "<tr>";
		 echo "<td colspan=\"3\" class=\"border\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
		 echo "<tr><td width=\"32%\" class=\"title\">Add Income Code</td>";
		 echo "<td width=\"37%\" class=\"title\">AMOUNT</td><td width=\"31%\">&nbsp;</td>";
		 echo "</tr></table></td></tr>";
		 do 
		 {
		 	$addIncomeCode=$row['addIncomeCode'];
			$addIncomeAmount=$row['addIncomeAmount'];
		    echo "<tr><td width=\"32%\" class=\"border\">" . $row['addIncomeCode'] . "</td>";
			echo "<td width=\"37%\" class=\"border\">" . $row['addIncomeAmount'] . "</td>";
			//echo "<td width=\"16%\" class=\"border\">";
			//echo "<a href=\"CEmployeeincome.php?empNumber=$empNumber&addIncomeCode=$addIncomeCode&addIncomeAmount=$addIncomeAmount&Submit2=Edit\">Edit</a></td>";
			echo "<td width=\"31%\" class=\"border\">";
			echo "<a href=\"CEmployeeincome.php?strEmpNmbr=$strEmpNmbr&empNumber=$empNumber&addIncomeCode=$addIncomeCode&Submit2=Delete&p=$p&txtSearch=$txtSearch&optField=$optField\">Delete</a></td></tr>";
		 }  while ($row = mysql_fetch_array($viewResults)); 
			echo "<tr><td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td>";
			echo "<td class=\"border\">&nbsp;</td></tr>";
			echo "</table>"; 
		} 
	
	}
	
	function comboAddIncome($addIncomeCode)
	{
		$objAddIncomeCode = mysql_query("SELECT * FROM tblAddIncome ORDER BY addIncomeCode");
		$flag = 0;
		if($row = mysql_fetch_array($objAddIncomeCode))     {
		   do {
		   		$strAddIncomeCode = $row["addIncomeCode"];
				if($flag == 0)
				{
					$this->strAddIncome = $row["addIncomeCode"];
					$flag = 1;
				}
				
				if($addIncomeCode == $strAddIncomeCode)
					echo "<option value='$strAddIncomeCode' selected>$strAddIncomeCode</option>";
				else
					echo "<option value='$strAddIncomeCode'>$strAddIncomeCode</option>";
				//echo "<div align=\"center\">"; 
                //echo "<input name=\"strFixedAmount\" type=\"text\" class=\"tbtext\" value='$strFixedAmount'>";
                //echo "</div>";
				
			  } 
			while($row= mysql_fetch_array($objAddIncomeCode)); 	}
				
	}
	
	function valueAmount($addIncomeCode)
	{
		if(strlen($addIncomeCode) == 0)
		{
			$addIncomeCode = $this->strAddIncome;
		}
		
		$objAddIncomeCode = mysql_query("SELECT fixedAmount FROM tblAddIncome 
											WHERE addIncomeCode='$addIncomeCode'");
		$row = mysql_fetch_array($objAddIncomeCode);
		return $row["fixedAmount"];
		
	}
	
	function viewAddIncome1($strEmpNmbr, $empNumber) // view additional income for hr
    {
	     $viewResults = mysql_query("SELECT * FROM tblEmpAddIncome WHERE empNumber='$empNumber'");
		 if(!$row = mysql_fetch_array($viewResults))
		 { 
		 echo " "; 
		 }
		 else
		 {
		 	$empNumber=$row['empNumber'];			
			$addIncomeCode=$row['addIncomeCode'];
			$addIncomeAmount=$row['addIncomeAmount'];
	   
		 echo "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
		 echo "<tr>";
		 echo "<td colspan=\"3\" class=\"border\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
		 echo "<tr><td width=\"32%\" class=\"title\">Add Income Code</td>";
		 echo "<td width=\"37%\" class=\"title\">AMOUNT</td>";
		 echo "</tr></table></td></tr>";
		 do 
		 {
		 	$addIncomeCode=$row['addIncomeCode'];
			$addIncomeAmount=$row['addIncomeAmount'];
		    echo "<tr><td width=\"32%\" class=\"border\">" . $row['addIncomeCode'] . "</td>";
			echo "<td width=\"37%\" class=\"border\">" . $row['addIncomeAmount'] . "</td>";
			//echo "<td width=\"16%\" class=\"border\">";
			//echo "<a href=\"CEmployeeincome.php?empNumber=$empNumber&addIncomeCode=$addIncomeCode&addIncomeAmount=$addIncomeAmount&Submit2=Edit\">Edit</a></td>";
			//echo "<td width=\"31%\" class=\"border\">";
			//echo "<a href=\"CEmployeeincome.php?empNumber=$empNumber&addIncomeCode=$addIncomeCode&Submit2=Delete\">Delete</a></td></tr>";
		 }  while ($row = mysql_fetch_array($viewResults)); 
			echo "<tr><td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td></tr>";
			//echo "<td class=\"border\">&nbsp;</td></tr>";
			echo "</table>"; 
		} 
	
	}
		
}
?> 