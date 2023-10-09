<?
/* 
File Name: Remittance.php
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
Date of Revision: January 22, 2003
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
class Remittance extends General
{


		
	function Remittance()
	{
		include("../hrmis/class/Connect.php");   //the dbase connection
	}
	
	
	function comboDeductCode($strDeductCode, $strDeductDesc)
	{
		$objDeductCode = mysql_query("SELECT deductionCode, deductionDesc FROM tblDeduction WHERE deductionType = 'premium' or deductionType = 'loan'");
		
		while($row= mysql_fetch_array($objDeductCode))
		{
			$strDeductCode = $row["deductionCode"];
			$strDeductDesc = $row["deductionDesc"];
			echo "<option value='$strDeductCode'>$strDeductDesc</option>";
			
		}
		
	}
	
	function comboContributeCode($strContributeCode, $strContributeDesc)
	{
		$objDeductCode = mysql_query("SELECT deductionCode, deductionDesc FROM tblDeduction WHERE deductionType = 'others'");
		
		while($row= mysql_fetch_array($objDeductCode))
		{
			$strContributeCode = $row["deductionCode"];
			$strContributeDesc = $row["deductionDesc"];
			echo "<option value='$strContributeCode'>$strContributeDesc</option>";
			
		}
		
	}
	
	function addRemit($empNumber, $deductionCode, $remitMonth, $remitYear, $remitAmount, $orNo, $orDate,$Submit, $sdeductYear, $deductYear, $deductMonth) //Add deduction
   {
		
		switch ($Submit) { 
			case "ADD"    :	$results = "INSERT INTO tblEmpDeductRemit (empNumber, deductionCode, deductMonth, deductYear, deductAmount, orNumber, orDate) 
										VALUES ('$empNumber', '$deductionCode', '$remitMonth', '$remitYear', '$remitAmount', '$orNo', '$orDate')";
		 				   	mysql_query($results) or die (mysql_error());
						   	if(!$results) {
	     				   	echo "<b>Employee Remittance not added:</b> ", mysql_error(); 
		    			   	exit; } 
						    //if($results) { return 1; }
						   	break;
							
			case "Search" : $viewResults = mysql_query("SELECT * FROM tblEmpDeductRemit WHERE empNumber='$empNumber' and  deductionCode='$deductionCode' and (deductYear='$sdeductYear' or deductYear='$deductYear')") or die(mysql_error());
							if(!$row = mysql_fetch_array($viewResults))
		 						{ 
		 						echo "<center><span class=\"warning\">No match found</span></center>";
		 						}
							else
		 						{
		 						$empNumber=$row['empNumber'];	
								$deductionCode=$row['deductionCode'];
								$deductYear=$row['deductYear'];
								$deductMonth=$row['deductMonth'];
								$deductAmount=$row['deductAmount'];															
								$orNumber=$row['orNumber'];
								$orDate=$row['orDate'];															
			
			 					echo "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
			 					echo "<tr class=\"title\"><td width=\"10%\" height=\"18\" class=\"border\">Code</td>";
			 					echo "<td width=\"20%\" class=\"border\">Year</td>";
			 					echo "<td width=\"20%\" class=\"border\">Month</td>";
			 					echo "<td width=\"20%\" class=\"border\">Amount</td>";
			 					echo "<td width=\"20%\" class=\"border\">OR Number</td>";
			 					echo "<td width=\"20%\" class=\"border\">OR Date</td></tr>";
								
								do 
		 							{	
									$empNumber=$row['empNumber'];	
									$deductionCode=$row['deductionCode'];
									$deductYear=$row['deductYear'];
									$deductMonth=$row['deductMonth'];
									$deductAmount=$row['deductAmount'];															
									$orNumber=$row['orNumber'];
									$orDate=$row['orDate'];
									
									echo "<tr class=\"border\"><td class=\"border\">" . $row['deductionCode'] . "</td>";
									echo "<td class=\"border\">" . $row['deductYear'] . "</td>";
									echo "<td class=\"border\">" . $row['deductMonth'] . "</td>";
									echo "<td class=\"border\">" . $row['deductAmount'] . "</td>";
									echo "<td class=\"border\">" . $row['orNumber'] . "</td>";
									echo "<td class=\"border\">" . $row['orDate'] . "</td>";
									}  while ($row = mysql_fetch_array($viewResults)); 
									echo "</tr><tr class=\"border\"><td height=\"18\" class=\"border\">&nbsp;</td>";
			 						echo "<td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td>";
			 						echo "<td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td>";
									echo "<td class=\"border\">&nbsp;</td></tr></table>";
								}								
													
			default       : break;				
			}
	}
	
	function searchContribute($empNumber, $contributeCode, $remitMonth, $remitYear, $remitAmount, $orNo, $orDate,$Submit1, $sdeductYear1, $deductYear1, $deductMonth) //Add deduction
   {
		
		switch ($Submit1) { 
			case "Search" : $viewResults = mysql_query("SELECT * FROM tblEmpAgencyShare WHERE empNumber='$empNumber' and  deductionCode='$contributeCode' and (deductYear='$sdeductYear1' or deductYear='$deductYear1')") or die(mysql_error());
							if(!$row = mysql_fetch_array($viewResults))
		 						{ 
		 						echo "<center><span class=\"warning\">No match found</span></center>";

		 						}
							else
		 						{
		 						$empNumber=$row['empNumber'];	
								$contributeCode=$row['deductionCode'];
								$deductYear=$row['deductYear'];
								$deductMonth=$row['deductMonth'];
								$deductAmount=$row['shareAmount'];															
								$orNumber=$row['orNumber'];
								$orDate=$row['orDate'];															
			
			 					echo "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
			 					echo "<tr class=\"title\"><td width=\"10%\" height=\"18\" class=\"border\">Code</td>";
			 					echo "<td width=\"20%\" class=\"border\">Year</td>";
			 					echo "<td width=\"20%\" class=\"border\">Month</td>";
			 					echo "<td width=\"20%\" class=\"border\">Amount</td>";
			 					echo "<td width=\"20%\" class=\"border\">OR Number</td>";
			 					echo "<td width=\"20%\" class=\"border\">OR Date</td></tr>";
								
								do 
		 							{	
									$empNumber=$row['empNumber'];	
									$contributeCode=$row['deductionCode'];
									$deductYear=$row['deductYear'];
									$deductMonth=$row['deductMonth'];
									$deductAmount=$row['shareAmount'];															
									$orNumber=$row['orNumber'];
									$orDate=$row['orDate'];
									
									echo "<tr class=\"border\"><td class=\"border\">" . $row['deductionCode'] . "</td>";
									echo "<td class=\"border\">" . $row['deductYear'] . "</td>";
									echo "<td class=\"border\">" . $row['deductMonth'] . "</td>";
									echo "<td class=\"border\">" . $row['shareAmount'] . "</td>";
									echo "<td class=\"border\">" . $row['orNumber'] . "</td>";
									echo "<td class=\"border\">" . $row['orDate'] . "</td>";
									}  while ($row = mysql_fetch_array($viewResults)); 
									echo "</tr><tr class=\"border\"><td height=\"18\" class=\"border\">&nbsp;</td>";
			 						echo "<td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td>";
			 						echo "<td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td>";
									echo "<td class=\"border\">&nbsp;</td></tr></table>";
								}								
													
			default       : break;				
			}
	}
			

}		
?>