<?
/* 
File Name: Contribution.php
----------------------------------------------------------------------
Purpose of this file: 
Class Contribution
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: JDG
----------------------------------------------------------------------
Date of Revision: December 20, 2003
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
class Contribution extends General
{


		
	function Contribution()
	{
		include("../hrmis/class/Connect.php");   //the dbase connection
	}
	
	
	function comboContributeCode($strContributeCode)
	{
		$objContributeCode = mysql_query("SELECT deductionCode, deductionDesc FROM tblDeduction WHERE deductionType = 'contribution' ");
		
		while($row= mysql_fetch_array($objContributeCode))
		{
			$strContributeCode = $row["deductionCode"];
			$strContributeDesc = $row["deductionDesc"];
			echo "<option value='$strContributeCode'>$strContributeDesc</option>";
			
		}
		
	}
	
	function addContribution($strEmpNmbr, $empNumber, $deductionCode, $deductMonth, $deductYear, $deductAmount, $orno, $ordate, $Submit2, $deductionCode1, $p) //Add deduction
   {
		
		switch ($Submit2) { 
			case "ADD"    :	$results = "INSERT INTO tblEmpAgencyShare (empNumber, deductionCode,  deductYear, deductMonth, shareAmount, orNumber, orDate) 
										VALUES ('$empNumber', '$deductionCode', '$deductYear',  '$deductMonth', '$deductAmount', '$orno', '$ordate')";
		 				   	mysql_query($results) or die (mysql_error());
							echo "<meta http-equiv=\"refresh\" content=\"0; url=CEmployercontribution.php?p=$p\">";
						   	if(!$results) {
	     				   	echo "<b>Employer Contribution not added:</b> ", mysql_error(); 
		    			   	exit; } 
						   	break;
						   
			case "Edit"   :	$editresults = "SELECT * FROM tblEmpAgencyShare WHERE empNumber='$empNumber' and deductionCode='$deductionCode'";							   
		    			    $editResults = mysql_query($editresults) or die (mysql_error());
						  	if($row = mysql_fetch_array($editResults))     {
		    					do {		
			   						$$deductionCode=$row['deductionCode'];
			   						$deductMonth=$row['deductMonth'];
									$deductYear=$row['deductYear'];
									$deductAmount=$row['shareAmount'];															
									$orno=$row['orNumber'];
									$ordate=$row['orDate'];															
									} 
								while($row=mysql_fetch_array($editResults)); }
						   	break;
						   								
			case "Submit" :	$updateResults = "UPDATE tblEmpAgencyShare SET empNumber='$empNumber', deductionCode='$deductionCode', deductMonth='$deductMonth', 
											  deductYear='$deductYear', shareAmount='$deductAmount', orNumber='$orno', orDate='$ordate'
											  WHERE empNumber='$empNumber' and deductionCode='$deductionCode1'";
			 				$modifyResults = mysql_query($updateResults);
							
							if(!$modifyResults) { 
								echo "<b>Employee Deduction not modify:</b> ", mysql_error(); 
								exit; 			} 
			 				if($modifyResults)  { return 1; }
							break; 
							
			case "Delete":	return 1 ; break;
							
			case "OK" 	:	$delete = "DELETE FROM tblEmpAgencyShare WHERE empNumber='$empNumber' and deductionCode='$deductionCode1'";  
	      					$del = mysql_query($delete);

							break;
			
			default       : break;				
			}
	}
	
	function viewContribution($strEmpNmbr, $empNumber, $p) // view employee deduction list
    {
	     $viewResults = mysql_query("SELECT * FROM tblEmpAgencyShare WHERE empNumber='$empNumber'");
		 if(!$row = mysql_fetch_array($viewResults))
		 { 
		 echo " ";
		 }
		 else
		 {
		 	$empNumber=$row['empNumber'];	
			$deductionCode=$row['deductionCode'];
			$deductYear=$row['deductYear'];
			$deductMonth=$row['deductMonth'];
			$deductAmount=$row['shareAmount'];															
			$orno=$row['orNumber'];
			$ordate=$row['orDate'];															
	   
			 echo "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
			 echo "<tr class=\"title\"><td width=\"22%\" height=\"18\" class=\"border\">Contribution<br>Name</td>";
			 echo "<td width=\"12%\" class=\"border\">Year</td>";
			 echo "<td width=\"12%\" class=\"border\">Month</td>";
			 echo "<td width=\"12%\" class=\"border\">Amount</td>";
			 echo "<td width=\"12%\" class=\"border\">OR Number</td>";
			 echo "<td width=\"20%\" class=\"border\">OR Date</td>";
			// echo "<td width=\"10%\" class=\"border\">&nbsp;</td>";
			 echo "<td width=\"10%\" class=\"border\">&nbsp;</td></tr>";
		 
		 do 
		 {
		 	$deductionCode=$row['deductionCode'];
			$deductYear=$row['deductYear'];
			$deductMonth=$row['deductMonth'];
			$deductAmount=$row['shareAmount'];															
			$orno=$row['orNumber'];
			$ordate=$row['orDate'];
			//echo "<tr><td width=\"35%\" class=\"border\">". $row['deductionCode'] ." ". $row['voucherNmbr'] ." " . $row['voucherDate'] . " " . $row['amountGranted'] . "</td>";
			//echo "<td width=\"40%\" class=\"border\">". $row['dateGranted'] ."  ". $row['amortization'] ." ". $row['actualStartDate'] ." ". $row['actualEndDate'] ."</td>";
			//echo "<td  class=\"border\">";
			//echo "<a href=\"CLoans.php?Submit2=Edit\">Edit</a></td>";
			echo "<tr class=\"border\"><td class=\"border\">" . $row['deductionCode'] . "</td>";
			echo "<td class=\"border\">" . $row['deductYear'] . "</td>";
			echo "<td class=\"border\">" . $row['deductMonth'] . "</td>";
			echo "<td class=\"border\">" . $row['shareAmount'] . "</td>";
			echo "<td class=\"border\">" . $row['orNumber'] . "</td>";
			echo "<td class=\"border\">" . $row['orDate'] . "</td>";
		//	echo "<td class=\"border\">" . $row['actualStartDate'] . "</td>";
		//	echo "<td class=\"border\">" . $row['actualEndDate'] . "</td>";
		//	echo "<td class=\"border\"><a href=\"CEmployercontribution.php?empNumber=$empNumber&deductionCode=$deductionCode&Submit2=Edit\"></a></td></td>";
			echo "<td class=\"border\"><a href=\"CEmployercontribution.php?strEmpNmbr=$strEmpNmbr&empNumber=$empNumber&deductionCode=$deductionCode&Submit2=Delete&p=$p\">Delete</a></td></tr></tr>";
		 }  while ($row = mysql_fetch_array($viewResults)); 
			echo "</tr><tr class=\"border\"><td height=\"18\" class=\"border\">&nbsp;</td>";
			echo "<td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td>";
			echo "<td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td>";
			echo "<td class=\"border\">&nbsp;</td>";
			echo "<td class=\"border\">&nbsp;</td></tr></table>";
		} 
	
	}		

	function viewContribution1($empNumber) // view employee deduction list
    {
	     $viewResults = mysql_query("SELECT * FROM tblEmpAgencyShare WHERE empNumber='$empNumber'");
		 if(!$row = mysql_fetch_array($viewResults))
		 { 
		 echo " ";
		 }
		 else
		 {
		 	$empNumber=$row['empNumber'];	
			$deductionCode=$row['deductionCode'];
			$deductYear=$row['deductYear'];
			$deductMonth=$row['deductMonth'];
			$deductAmount=$row['shareAmount'];															
			$orno=$row['orNumber'];
			$ordate=$row['orDate'];															
	   
			 echo "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
			 echo "<tr class=\"title\"><td width=\"20%\" height=\"22\" class=\"border\">Contribution<br>Name</td>";
			 echo "<td width=\"12%\" class=\"border\">Year</td>";
			 echo "<td width=\"12%\" class=\"border\">Month</td>";
			 echo "<td width=\"20%\" class=\"border\">Amount</td>";
			 echo "<td width=\"15%\" class=\"border\">OR Number</td>";
			 echo "<td width=\"17%\" class=\"border\">OR Date</td></tr>";
			// echo "<td width=\"10%\" class=\"border\">&nbsp;</td>";
			// echo "<td width=\"10%\" class=\"border\">&nbsp;</td></tr>";
		 
		 do 
		 {
		 	$deductionCode=$row['deductionCode'];
			$deductYear=$row['deductYear'];
			$deductMonth=$row['deductMonth'];
			$deductAmount=$row['shareAmount'];															
			$orno=$row['orNumber'];
			$ordate=$row['orDate'];
			//echo "<tr><td width=\"35%\" class=\"border\">". $row['deductionCode'] ." ". $row['voucherNmbr'] ." " . $row['voucherDate'] . " " . $row['amountGranted'] . "</td>";
			//echo "<td width=\"40%\" class=\"border\">". $row['dateGranted'] ."  ". $row['amortization'] ." ". $row['actualStartDate'] ." ". $row['actualEndDate'] ."</td>";
			//echo "<td  class=\"border\">";
			//echo "<a href=\"CLoans.php?Submit2=Edit\">Edit</a></td>";
			echo "<tr class=\"border\"><td class=\"border\">" . $row['deductionCode'] . "</td>";
			echo "<td class=\"border\">" . $row['deductYear'] . "</td>";
			echo "<td class=\"border\">" . $row['deductMonth'] . "</td>";
			echo "<td class=\"border\">" . $row['shareAmount'] . "</td>";
			echo "<td class=\"border\">" . $row['orNumber'] . "</td>";
			echo "<td class=\"border\">" . $row['orDate'] . "</td>";
		  //echo "<td class=\"border\">" . $row['actualStartDate'] . "</td>";
		  //echo "<td class=\"border\">" . $row['actualEndDate'] . "</td>";
		  //echo "<td class=\"border\"><a href=\"CEmployercontribution.php?empNumber=$empNumber&deductionCode=$deductionCode&Submit2=Edit\"></a></td></td>";
		  //echo "<td class=\"border\"><a href=\"CEmployercontribution.php?empNumber=$empNumber&deductionCode=$deductionCode&Submit2=Delete\">Delete</a></td></tr></tr>";
		 }  while ($row = mysql_fetch_array($viewResults)); 
			echo "</tr><tr class=\"border\"><td height=\"18\" class=\"border\">&nbsp;</td>";
			echo "<td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td>";
			echo "<td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td>";
			//echo "<td class=\"border\">&nbsp;</td><td class=\"border\">&nbsp;</td>";
			echo "<td class=\"border\">&nbsp;</td></tr></table>";
		} 
	
	}		

}		
?>