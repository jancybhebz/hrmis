<?php 
/* 
File Name: TaxPhilhealth.php
----------------------------------------------------------------------
Purpose of this file: 
To add, edit, delete tax and philhealth.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: JDG
----------------------------------------------------------------------
Date of Revision: October 08, 2003
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

class TaxPhilhealth
{


	function TaxPhilhealth() 
   {
      include("Connect.php");   //the dbase connection
   }
   
   function addTaxExempt($strEmpNmbr, $taxStatus, $exemptionAmount, $Submit2, $taxStatus1) //Add tax exemption
   {
		
		switch ($Submit2) { 
			case "ADD"    :	$results = "INSERT INTO tblTaxExempt (taxStatus, exemptAmount) VALUES ('$taxStatus', '$exemptionAmount')";
		 				   	mysql_query($results) or die (mysql_error());
							//echo "<meta http-equiv=\"refresh\" content=\"0; url=Taxexemption.php\">";
						   	if(!$results) {
	     				   	echo "<b>Tax Exemption not added:</b> ", mysql_error(); 
		    			   	exit; } 
						    if($results) { return 1; }
						   	break;
						   
			case "Edit"   :	$editresults = "SELECT * FROM tblTaxExempt WHERE taxStatus='$taxStatus' and exemptAmount='$exemptionAmount'";							   
		    			    $editResults = mysql_query($editresults) or die (mysql_error());
						  	if($row = mysql_fetch_array($editResults))     {
		    					do {
			   						$taxStatus=$row['taxStatus'];
			   						$exemptionAmount=$row['exemptAmount'];
									} 
								while($row=mysql_fetch_array($editResults)); }
						   	break;
						   								
			case "Submit" :	$updateResults = "UPDATE tblTaxExempt SET taxStatus='$taxStatus', exemptAmount='$exemptionAmount' WHERE taxStatus='$taxStatus1'";
			 				$modifyResults = mysql_query($updateResults);
							
							if(!$modifyResults) { 
								echo "<b>Tax exemption not modify not modify:</b> ", mysql_error(); 
								exit; 			} 
			 				if($modifyResults)  { return 1; }
							echo "<meta http-equiv=\"refresh\" content=\"0; url=Taxexemption.php\">";
							break; 
							
			case "Delete":	return 1 ; break;
							
			case "OK" 	:	$delete = "DELETE FROM tblTaxExempt WHERE taxStatus='$taxStatus'";  
	      					$del = mysql_query($delete);

							break;
			
			default       : break;				
			}
	}					
		

	function viewTaxExempt($strEmpNmbr, $taxStatus, $exemptionAmount, $Submit2) // view tax exemption list
    {
	     $viewResults = mysql_query("SELECT * FROM tblTaxExempt");
		 if(!$row = mysql_fetch_array($viewResults))
		 { 
		 echo "Empty"; 
		 }
		 else
		 {
			$taxStatus=$row['taxStatus'];
			$exemptionAmount=$row['exemptAmount'];
	   
		 echo "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
		 echo "<tr>";
		 echo "<td colspan=\"4\" class=\"border\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
		 echo "<tr><td width=\"32%\" class=\"title\">TAX STATUS</td>";
		 echo "<td width=\"37%\" class=\"title\">EXEMPTION AMOUNT</td><td width=\"31%\">&nbsp;</td>";
		 echo "</tr></table></td></tr>";
		 do 
		 {
		 	$taxStatus=$row['taxStatus'];
			$exemptionAmount=$row['exemptAmount'];
		    echo "<tr><td width=\"32%\" class=\"border\">" . $row['taxStatus'] . "</td>";
			echo "<td width=\"37%\" class=\"border\">" . $row['exemptAmount'] . "</td>";
			echo "<td width=\"16%\" class=\"border\">";
			echo "<a href=\"Taxexemption.php?strEmpNmbr=$strEmpNmbr&taxStatus=$taxStatus&exemptionAmount=$exemptionAmount&Submit2=Edit\">Edit</a></td>";
			echo "<td width=\"15%\" class=\"border\">";
			echo "<a href=\"Taxexemption.php?strEmpNmbr=$strEmpNmbr&taxStatus=$taxStatus&exemptionAmount=$exemptionAmount&Submit2=Delete\">Delete</a></td></tr>";
		 }  while ($row = mysql_fetch_array($viewResults)); 
			echo "<tr><td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td>";
			echo "<td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td></tr>";
			echo "</table>"; 
		} 
	
	}
	
	function addTaxRange($strEmpNmbr, $taxBase, $taxDeduction, $taxFactor, $taxableFrom, $taxableTo, $Submit2, $taxBase2) //Add tax range
   	{
		
		switch ($Submit2) { 
			case "ADD"    :	$results = "INSERT INTO tblTaxRange (taxBase, taxDeduct, taxFactor, taxableFrom, taxableTo) VALUES ('$taxBase', '$taxDeduction', '$taxFactor', '$taxableFrom', '$taxableTo')";
		 				   	mysql_query($results) or die (mysql_error());
							//echo "<meta http-equiv=\"refresh\" content=\"0; url=Taxrange.php\">"; 
						   	if(!$results) {
	     				   	echo "<b>Tax Range not added:</b> ", mysql_error(); 
		    			   	exit; } 
						    elseif($results) { return 1;}
						   	break;
						   
			case "Edit"   :	$editresults = "SELECT * FROM tblTaxRange WHERE taxBase='$taxBase'";							   
		    			    $editResults = mysql_query($editresults) or die (mysql_error());
						  	if($row = mysql_fetch_array($editResults))     {
		    					do {
			   						$taxBase=$row['taxBase'];
			   						$taxDeduction=$row['taxDeduct'];
									$taxFactor=$row['taxFactor'];
			   						$taxableFrom=$row['taxableFrom'];
			   						$taxableTo=$row['taxableTo'];
									} 
								while($row=mysql_fetch_array($editResults)); }
						   	break;
						   								
			case "Submit" :	$updateResults = "UPDATE tblTaxRange SET taxBase='$taxBase', taxDeduct='$taxDeduction', taxFactor='$taxFactor', taxableFrom='$taxableFrom', taxableTo='$taxableTo' WHERE taxBase='$taxBase2'";
			 				$modifyResults = mysql_query($updateResults);
							//echo "<meta http-equiv=\"refresh\" content=\"0; url=Taxrange.php\">";
							if(!$modifyResults) { 
								echo "<b>Tax Range not modify:</b> ", mysql_error(); 
								exit; 			} 
			 				if($modifyResults)  { return 1;}
							break; 
							
			case "Delete":	return 1 ; break;
							
			case "OK" 	:	$delete = "DELETE FROM tblTaxRange WHERE taxBase='$taxBase'";  
	      					$del = mysql_query($delete);
							break;
			
			default       : break;				
			}
	}					
		
	function viewTaxRange($strEmpNmbr) // view tax range list
    {
	     $viewResults = mysql_query("SELECT * FROM tblTaxRange");
		 if(!$row = mysql_fetch_array($viewResults))
		 { 
		 echo "Empty"; 
		 }
		 else
		 {
			$taxBase=$row['taxBase'];
			$taxDeduction=$row['taxDeduct'];
			$taxFactor=$row['taxFactor'];
			$taxableFrom=$row['taxableFrom'];
			$taxableTo=$row['taxableTo'];
	   
		 echo "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
		 echo "<tr>";
		 echo "<td colspan=\"4\" class=\"border\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
		 echo "<tr><td width=\"33%\" class=\"title\">If Taxable Income is</td>";
		 echo "<td width=\"37%\" class=\"title\">Tax Due is</td><td width=\"31%\">&nbsp;</td>";
		 echo "</tr></table></td></tr>";
		 
		 do 
		 {
		 	$taxBase=$row['taxBase'];
			$taxDeduction=$row['taxDeduct'];
			$taxFactor=$row['taxFactor'];
			$taxableFrom=$row['taxableFrom'];
			$taxableTo=$row['taxableTo'];
			echo "<tr><td width=\"35%\" class=\"border\">Over ". $row['taxableFrom'] ." but not over" . $row['taxableTo'] . "</td>";
			echo "<td width=\"40%\" class=\"border\">". $row['taxDeduct'] ." + ". $row['taxFactor'] ." of the excess over ". $row['taxBase'] ."</td>";
			echo "<td  class=\"border\">";
			echo "<a href=\"Taxrange.php?strEmpNmbr=$strEmpNmbr&taxBase=$taxBase&taxDeduct=$taxDeduction&taxFactor=$taxFactor&taxableFrom=$taxableFrom&taxableTo=$taxableTo&Submit2=Edit\">Edit</a></td>";
			echo "<td class=\"border\">";
			echo "<a href=\"Taxrange.php?strEmpNmbr=$strEmpNmbr&taxBase=$taxBase&Submit2=Delete\">Delete</a></td></tr>";
		 }  while ($row = mysql_fetch_array($viewResults)); 
			echo "<tr><td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td>";
			echo "<td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td></tr>";
			echo "</table>"; 
		} 
	
	}

  function addPhilhealth($strEmpNmbr, $philhealthFrom, $philhealthTo, $philSalaryBase, $Submit2, $philSalaryBase1) //Add tax exemption
   {
		
		switch ($Submit2) { 
			case "ADD"    :	$results = "INSERT INTO tblPhilhealthRange (philhealthFrom, philhealthTo, philSalaryBase) VALUES ('$philhealthFrom', '$philhealthTo', '$philSalaryBase')";
		 				   	mysql_query($results) or die (mysql_error());
							//echo "<meta http-equiv=\"refresh\" content=\"0; url=Philhealthrange.php\">";
						   	if(!$results) {
	     				   	echo "<b>PhilHealth Range not added:</b> ", mysql_error(); 
		    			   	exit; } 
						    if($results) { return 1; }
						   	break;
						   
			case "Edit"   :	$editresults = "SELECT * FROM tblPhilhealthRange WHERE philSalaryBase='$philSalaryBase'";							   
		    			    $editResults = mysql_query($editresults) or die (mysql_error());
						  	if($row = mysql_fetch_array($editResults))     {
		    					do {
			   						$philhealthFrom=$row['philhealthFrom'];
			   						$philhealthTo=$row['philhealthTo'];
									$philSalaryBase=$row['philSalaryBase'];
									} 
								while($row=mysql_fetch_array($editResults)); }
						   	break;
						   								
			case "Submit" :	$updateResults = "UPDATE tblPhilhealthRange SET philhealthFrom='$philhealthFrom', philhealthTo='$philhealthTo', philSalaryBase='$philSalaryBase' WHERE philSalaryBase='$philSalaryBase1'";
			 				$modifyResults = mysql_query($updateResults);
							//echo "<meta http-equiv=\"refresh\" content=\"0; url=Philhealthrange.php\">";
							if(!$modifyResults) { 
								echo "<b>PhilHealth Range not modify:</b> ", mysql_error(); 
								exit; 			} 
			 				if($modifyResults)  { return 1; }
							
							break; 
							
			case "Delete":	return 1 ; break;
							
			case "OK" 	:	$delete = "DELETE FROM tblPhilhealthRange WHERE philSalaryBase='$philSalaryBase'";  
	      					$del = mysql_query($delete);

							break;
			
			default       : break;				
			}
	}					
	
	function viewPhilhealth($strEmpNmbr) // view philhealth range list
    {
	     $viewResults = mysql_query("SELECT * FROM tblPhilhealthRange");
		 if(!$row = mysql_fetch_array($viewResults))
		 { 
		 echo "Empty"; 
		 }
		 else
		 {
			$philhealthFrom=$row['philhealthFrom'];
			$philhealthTo=$row['philhealthTo'];
			$philSalaryBase=$row['philSalaryBase'];
	   
		 echo "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
		 echo "<tr>";
		 echo "<td colspan=\"4\" class=\"border\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
		 echo "<tr><td width=\"33%\" class=\"title\">PhilHealth Range</td>";
		 echo "<td width=\"37%\" class=\"title\">Salary Base</td><td width=\"31%\">&nbsp;</td>";
		 echo "</tr></table></td></tr>";
		 
		 do 
		 {
		 	$philhealthFrom=$row['philhealthFrom'];
			$philhealthTo=$row['philhealthTo'];
			$philSalaryBase=$row['philSalaryBase'];
			
			echo "<tr><td width=\"35%\" class=\"border\">". $row['philhealthFrom'] ."&nbsp; to &nbsp;" . $row['philhealthTo'] . "</td>";
			echo "<td width=\"40%\" class=\"border\">". $row['philSalaryBase'] ." </td>";
			echo "<td  class=\"border\">";
			echo "<a href=\"Philhealthrange.php?strEmpNmbr=$strEmpNmbr&philhealthFrom=$philhealthFrom&philhealthTo=$philhealthTo&philSalaryBase=$philSalaryBase&Submit2=Edit\">Edit</a></td>";
			echo "<td class=\"border\">";
			echo "<a href=\"Philhealthrange.php?strEmpNmbr=$strEmpNmbr&philSalaryBase=$philSalaryBase&Submit2=Delete\">Delete</a></td></tr>";
		 }  while ($row = mysql_fetch_array($viewResults)); 
			echo "<tr><td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td>";
			echo "<td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td></tr>";
			echo "</table>"; 
		} 
	
	}
		
}
?> 