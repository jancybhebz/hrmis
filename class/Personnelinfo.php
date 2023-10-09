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
Date of Revision:May 26, 2004
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

class Personnel
{


	function Personnel() 
   {
      include("Connect.php");   //the dbase connection
   }
   
   function inputInfo($strEmpNmbr, $empNumber, $payrollSwitch1, $mcSwitch1, $longevitySwitch1, $hazardSwitch1 , $healthProvider1, $payrollSwitch, $mcSwitch, $longevitySwitch, $hazardSwitch, $healthProvider, $Submit, $p, $txtSearch, $optField) //Add additional Income
   {
		
		switch ($Submit) { 
			case "SUBMIT"    :	$updateResults = "UPDATE tblEmpPosition SET payrollSwitch='$payrollSwitch', longevitySwitch='$longevitySwitch', mcSwitch='$mcSwitch', hazardSwitch='$hazardSwitch', healthProvider='$healthProvider' WHERE empNumber='$empNumber'";
			 					$modifyResults = mysql_query($updateResults);
								//echo "<meta http-equiv=\"refresh\" content=\"0; url=CPersonnelinfo.php?strEmpNmbr=$strEmpNmbr&p=$p&txtSearch=$txtSearch\">";
								echo "<meta http-equiv=\"refresh\" content=\"0; url=CPersonnelinfo.php?strEmpNmbr=$strEmpNmbr&p=$p&txtSearch=$txtSearch&t_strEmpNumber=$t_strEmpNumber&optField=$optField\">";
						   						
									if(!$modifyResults) { 
										echo "<b>Personnel Info not modify not modify:</b> ", mysql_error(); 
										exit; 			} 
			 						if($modifyResults)  { return 1; }
								
								break;			
						   
			case "Edit"   :		$editresults = "SELECT * FROM tblEmpPosition WHERE empNumber='$empNumber'";							   
		    			    	$editResults = mysql_query($editresults) or die (mysql_error());
						  		if(!$row = mysql_fetch_array($editResults)) 
								 {
								 echo " ";
								 }
								else { 			
									do {
			   							$payrollSwitch =$row['payrollSwitch'];
										$mcSwitch =$row['mcSwitch'];
										$longevitySwitch =$row['longevitySwitch'];
										$hazardSwitch =$row['hazardSwitch'];
										$healthProvider =$row['healthProvider'];
										} 
									while($row=mysql_fetch_array($editResults)); }
							
						   		break;
								
			default       : break;				
			}
	}
	
}
?> 