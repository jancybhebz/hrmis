<?php 
/* 
File Name: Salaryschedule.php (class folder)
----------------------------------------------------------------------
Purpose of this file: 
To add, edit, delete and view salary schedule to database.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco
----------------------------------------------------------------------
Date of Revision: October 24, 2003
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
class Salaryschedule
{

var $intSalaryGradeNumber;
var $intStepNumber;
var $intActualSalary;

   function salarySchedule() 
   {
      include("../hrmis/class/Connect.php");   //the dbase connection
   }
	
   function addSalarySchedule($strEmpNmbr, $t_intSalaryGradeNumber, $t_intStepNumber, $t_intActualSalary, $Submit) //Add salary schedule
   {
      if ($Submit == 'ADD')
	  {
	     $results = "INSERT INTO tblSalarySched (salaryGradeNumber, stepNumber, actualSalary) VALUES ('$t_intSalaryGradeNumber', '$t_intStepNumber', '$t_intActualSalary')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Salary schedule not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}
	
	function editSalarySchedule($strEmpNmbr, $t_intSalaryGradeNumber, $t_intStepNumber, $t_intActualSalary, $Submit, $t_intOldSalaryGradeNumber, $t_intOldStepNumber, $t_intOldActualSalary) //edit salary schedule
    {
      if ($Submit == 'Edit')
	  {
	     $results = mysql_query("SELECT * FROM tblSalarySched WHERE stepNumber='$t_intStepNumber' AND actualSalary='$t_intActualSalary'");
		 if($row = mysql_fetch_array($results))
		 {
		    do 
			{
			   $t_intSalaryGradeNumber=$row['salaryGradeNumber'];
			   $t_intStepNumber=$row['stepNumber'];
			   $t_intActualSalary=$row['actualSalary'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == "Submit"){ 
			 $updateResults = "UPDATE tblSalarySched SET salaryGradeNumber='$t_intSalaryGradeNumber', stepNumber='$t_intStepNumber', actualSalary='$t_intActualSalary' WHERE salaryGradeNumber='$t_intSalaryGradeNumber' AND stepNumber='$t_intStepNumber' ";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Salary Schedule not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return 1; 
			 } 
	} 
}

	function deleteSalarySchedule($strEmpNmbr, $t_intSalaryGradeNumber, $t_intStepNumber, $t_intActualSalary, $Submit) //Delete salary schedule
   	{
	   if ($Submit == 'Delete') 
	   {
	   		 return 1;
	   }
	   elseif ($Submit == 'OK')
	   {
	      $delete = "DELETE FROM tblSalarySched WHERE salaryGradeNumber='$t_intSalaryGradeNumber' AND actualSalary='$t_intActualSalary'";   //Delete Record from Database
	      $del = mysql_query($delete);
	   }
	}
	
	function viewSalarySchedule($strEmpNmbr, $t_intSalaryGradeNumber, $t_intStepNumber, $t_intActualSalary) //View list of salary schedule
    {
	     $viewResults = mysql_query("SELECT * FROM tblSalarySched group by stepNumber");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "database is empty";
		 } else {
			 $t_intSalaryGradeNumber=$row['salaryGradeNumber'];
			 $t_intStepNumber=$row['stepNumber'];
			 $t_intActualSalary=$row['actualSalary'];
			 echo "<table width=\"99%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
			 echo "<tr class=\"alterrow\"><td width=\"20%\">SG NUMBER</td>";
			 echo "<td width=\"28%\">STEP NUMBER</td>";
			 echo "<td width=\"32%\">ACTUAL SALARY</td>";
			 echo "<td width=\"10%\">&nbsp;</td>";
			 echo "<td width=\"10%\">&nbsp;</td></tr>";
			 echo "<tr><td colspan=\"5\">&nbsp;</td></tr>";
			 do 
			 {
				$t_intSalaryGradeNumber=$row['salaryGradeNumber'];
			    $t_intStepNumber=$row['stepNumber'];
			    $t_intActualSalary=$row['actualSalary'];
				echo "<tr class=\"border\"><td>" . $row['salaryGradeNumber'] . "</td>";
				echo "<td>" . $row['stepNumber'] . "</td>";
				echo "<td>" . $row['actualSalary'] . "</td>";
				echo "<td><a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">Edit</a></td>"; 
				echo "<td><a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Delete\">Delete</a></td></tr>";
			 }  while ($row = mysql_fetch_array($viewResults)); 
			 	echo "<tr><td colspan=\"5\">&nbsp;</td></tr>";
				echo "</table>";        
			}
	}
	
//  ------------------------------------  Salary Schedule Table  ----------------------------------  //	
	
	
	function viewSalaryGradeOne($strEmpNmbr)
	{
		$viewResults = mysql_query("SELECT * FROM tblSalarySched WHERE salaryGradeNumber = 1");
		if (!$row=mysql_fetch_array($viewResults))
		{
		   echo "1";
		} else {
		   		echo $row['salaryGradeNumber'];
		
		}
	}
	
	function viewSalaryGradeTwo($strEmpNmbr)
	{
		$viewResults = mysql_query("SELECT * FROM tblSalarySched WHERE salaryGradeNumber = 2");
		if (!$row=mysql_fetch_array($viewResults))
		{
		   echo "2";
		} else {
		   		echo $row['salaryGradeNumber'];
		
		}
	}
	
	function viewSalaryGradeThree($strEmpNmbr)
	{
		$viewResults = mysql_query("SELECT * FROM tblSalarySched WHERE salaryGradeNumber = 3");
		if (!$row=mysql_fetch_array($viewResults))
		{
		   echo "3";
		} else {
		   		echo $row['salaryGradeNumber'];
		
		}
	}
	function viewSalaryGradeFour($strEmpNmbr)
	{
		$viewResults = mysql_query("SELECT * FROM tblSalarySched WHERE salaryGradeNumber = 4");
		if (!$row=mysql_fetch_array($viewResults))
		{
		   echo "4";
		} else {
		   		echo $row['salaryGradeNumber'];
		
		}
	}
	function viewSalaryGradeFive($strEmpNmbr)
	{
		$viewResults = mysql_query("SELECT * FROM tblSalarySched WHERE salaryGradeNumber = 5");
		if (!$row=mysql_fetch_array($viewResults))
		{
		   echo "5";
		} else {
		   		echo $row['salaryGradeNumber'];
		
		}
	}
	function viewSalaryGradeSix($strEmpNmbr)
	{
		$viewResults = mysql_query("SELECT * FROM tblSalarySched WHERE salaryGradeNumber = 6");
		if (!$row=mysql_fetch_array($viewResults))
		{
		   echo "6";
		} else {
		   		echo $row['salaryGradeNumber'];
		
		}
	}
	function viewSalaryGradeSeven($strEmpNmbr)
	{
		$viewResults = mysql_query("SELECT * FROM tblSalarySched WHERE salaryGradeNumber = 7");
		if (!$row=mysql_fetch_array($viewResults))
		{
		   echo "7";
		} else {
		   		echo $row['salaryGradeNumber'];
		
		}
	}
	function viewSalaryGradeEight($strEmpNmbr)
	{
		$viewResults = mysql_query("SELECT * FROM tblSalarySched WHERE salaryGradeNumber = 8");
		if (!$row=mysql_fetch_array($viewResults))
		{
		   echo "8";
		} else {
		   		echo $row['salaryGradeNumber'];
		
		}
	}
	function viewSalaryGradeNine($strEmpNmbr)
	{
		$viewResults = mysql_query("SELECT * FROM tblSalarySched WHERE salaryGradeNumber = 9");
		if (!$row=mysql_fetch_array($viewResults))
		{
		   echo "9";
		} else {
		   		echo $row['salaryGradeNumber'];
		
		}
	}
	function viewSalaryGradeTen($strEmpNmbr)
	{
		$viewResults = mysql_query("SELECT * FROM tblSalarySched WHERE salaryGradeNumber = 10");
		if (!$row=mysql_fetch_array($viewResults))
		{
		   echo "10";
		} else {
		   		echo $row['salaryGradeNumber'];
		
		}
	}
	function viewSalaryGradeEleven($strEmpNmbr)
	{
		$viewResults = mysql_query("SELECT * FROM tblSalarySched WHERE salaryGradeNumber = 11");
		if (!$row=mysql_fetch_array($viewResults))
		{
		   echo "11";
		} else {
		   		echo $row['salaryGradeNumber'];
		
		}
	}
	function viewSalaryGradeTwelve($strEmpNmbr)
	{
		$viewResults = mysql_query("SELECT * FROM tblSalarySched WHERE salaryGradeNumber = 12");
		if (!$row=mysql_fetch_array($viewResults))
		{
		   echo "12";
		} else {
		   		echo $row['salaryGradeNumber'];
		
		}
	}
	function viewSalaryGradeThirteen($strEmpNmbr)
	{
		$viewResults = mysql_query("SELECT * FROM tblSalarySched WHERE salaryGradeNumber = 13");
		if (!$row=mysql_fetch_array($viewResults))
		{
		   echo "13";
		} else {
		   		echo $row['salaryGradeNumber'];
		
		}
	}
	function viewSalaryGradeFourteen($strEmpNmbr)
	{
		$viewResults = mysql_query("SELECT * FROM tblSalarySched WHERE salaryGradeNumber = 14");
		if (!$row=mysql_fetch_array($viewResults))
		{
		   echo "14";
		} else {
		   		echo $row['salaryGradeNumber'];
		
		}
	}
	function viewSalaryGradeFifteen($strEmpNmbr)
	{
		$viewResults = mysql_query("SELECT * FROM tblSalarySched WHERE salaryGradeNumber = 15");
		if (!$row=mysql_fetch_array($viewResults))
		{
		   echo "15";
		} else {
		   		echo $row['salaryGradeNumber'];
		
		}
	}
	function viewSalaryGradeSixteen($strEmpNmbr)
	{
		$viewResults = mysql_query("SELECT * FROM tblSalarySched WHERE salaryGradeNumber = 16");
		if (!$row=mysql_fetch_array($viewResults))
		{
		   echo "16";
		} else {
		   		echo $row['salaryGradeNumber'];
		
		}
	}
	function viewSalaryGradeSeventeen($strEmpNmbr)
	{
		$viewResults = mysql_query("SELECT * FROM tblSalarySched WHERE salaryGradeNumber = 17");
		if (!$row=mysql_fetch_array($viewResults))
		{
		   echo "17";
		} else {
		   		echo $row['salaryGradeNumber'];
		
		}
	}
	function viewSalaryGradeEighteen($strEmpNmbr)
	{
		$viewResults = mysql_query("SELECT * FROM tblSalarySched WHERE salaryGradeNumber = 18");
		if (!$row=mysql_fetch_array($viewResults))
		{
		   echo "18";
		} else {
		   		echo $row['salaryGradeNumber'];
		
		}
	}
	function viewSalaryGradeNineteen($strEmpNmbr)
	{
		$viewResults = mysql_query("SELECT * FROM tblSalarySched WHERE salaryGradeNumber = 19");
		if (!$row=mysql_fetch_array($viewResults))
		{
		   echo "19";
		} else {
		   		echo $row['salaryGradeNumber'];
		
		}
	}
	function viewSalaryGradeTwenty($strEmpNmbr)
	{
		$viewResults = mysql_query("SELECT * FROM tblSalarySched WHERE salaryGradeNumber = 20");
		if (!$row=mysql_fetch_array($viewResults))
		{
		   echo "20";
		} else {
		   		echo $row['salaryGradeNumber'];
		
		}
	}
	function viewSalaryGradeTwentyOne($strEmpNmbr)
	{
		$viewResults = mysql_query("SELECT * FROM tblSalarySched WHERE salaryGradeNumber = 21");
		if (!$row=mysql_fetch_array($viewResults))
		{
		   echo "21";
		} else {
		   		echo $row['salaryGradeNumber'];
		
		}
	}
	function viewSalaryGradeTwentyTwo($strEmpNmbr)
	{
		$viewResults = mysql_query("SELECT * FROM tblSalarySched WHERE salaryGradeNumber = 22");
		if (!$row=mysql_fetch_array($viewResults))
		{
		   echo "22";
		} else {
		   		echo $row['salaryGradeNumber'];
		
		}
	}
	function viewSalaryGradeTwentyThree($strEmpNmbr)
	{
		$viewResults = mysql_query("SELECT * FROM tblSalarySched WHERE salaryGradeNumber = 23");
		if (!$row=mysql_fetch_array($viewResults))
		{
		   echo "23";
		} else {
		   		echo $row['salaryGradeNumber'];
		
		}
	}
	function viewSalaryGradeTwentyFour($strEmpNmbr)
	{
		$viewResults = mysql_query("SELECT * FROM tblSalarySched WHERE salaryGradeNumber = 24");
		if (!$row=mysql_fetch_array($viewResults))
		{
		   echo "24";
		} else {
		   		echo $row['salaryGradeNumber'];
		
		}
	}
	function viewSalaryGradeTwentyFive($strEmpNmbr)
	{
		$viewResults = mysql_query("SELECT * FROM tblSalarySched WHERE salaryGradeNumber = 25");
		if (!$row=mysql_fetch_array($viewResults))
		{
		   echo "25";
		} else {
		   		echo $row['salaryGradeNumber'];
		
		}
	}
	function viewSalaryGradeTwentySix($strEmpNmbr)
	{
		$viewResults = mysql_query("SELECT * FROM tblSalarySched WHERE salaryGradeNumber = 26");
		if (!$row=mysql_fetch_array($viewResults))
		{
		   echo "26";
		} else {
		   		echo $row['salaryGradeNumber'];
		
		}
	}
	function viewSalaryGradeTwentySeven($strEmpNmbr)
	{
		$viewResults = mysql_query("SELECT * FROM tblSalarySched WHERE salaryGradeNumber = 27");
		if (!$row=mysql_fetch_array($viewResults))
		{
		   echo "27";
		} else {
		   		echo $row['salaryGradeNumber'];
		
		}
	}
	function viewSalaryGradeTwentyEight($strEmpNmbr)
	{
		$viewResults = mysql_query("SELECT * FROM tblSalarySched WHERE salaryGradeNumber = 28");
		if (!$row=mysql_fetch_array($viewResults))
		{
		   echo "28";
		} else {
		   		echo $row['salaryGradeNumber'];
		
		}
	}
	function viewSalaryGradeTwentyNine($strEmpNmbr)
	{
		$viewResults = mysql_query("SELECT * FROM tblSalarySched WHERE salaryGradeNumber = 29");
		if (!$row=mysql_fetch_array($viewResults))
		{
		   echo "29";
		} else {
		   		echo $row['salaryGradeNumber'];
		
		}
	}
	function viewSalaryGradeThirty($strEmpNmbr)
	{
		$viewResults = mysql_query("SELECT * FROM tblSalarySched WHERE salaryGradeNumber = 30");
		if (!$row=mysql_fetch_array($viewResults))
		{
		   echo "30";
		} else {
		   		echo $row['salaryGradeNumber'];
		
		}
	}
	function viewSalaryGradeThirtyOne($strEmpNmbr)
	{
		$viewResults = mysql_query("SELECT * FROM tblSalarySched WHERE salaryGradeNumber = 31");
		if (!$row=mysql_fetch_array($viewResults))
		{
		   echo "31";
		} else {
		   		echo $row['salaryGradeNumber'];
		
		}
	}
	function viewSalaryGradeThirtyTwo($strEmpNmbr)
	{
		$viewResults = mysql_query("SELECT * FROM tblSalarySched WHERE salaryGradeNumber = 32");
		if (!$row=mysql_fetch_array($viewResults))
		{
		   echo "32";
		} else {
		   		echo $row['salaryGradeNumber'];
		
		}
	}
	function viewSalaryGradeThirtyThree($strEmpNmbr)
	{
		$viewResults = mysql_query("SELECT * FROM tblSalarySched WHERE salaryGradeNumber = 33");
		if (!$row=mysql_fetch_array($viewResults))
		{
		   echo "33";
		} else {
		   		echo $row['salaryGradeNumber'];
		
		}
	}
	
//  --------------------------------------- Salary Grade Number 1  ----------------------------------  //	
	function viewSG1StepNumberOne($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('1') and stepNumber in ('1')") 
			   or die (mysql_error($strEmpNmbr));
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG1StepNumberTwo($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('1') and stepNumber in ('2')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG1StepNumberThree($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('1') and stepNumber in ('3')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}
	
	function viewSG1StepNumberFour($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('1') and stepNumber in ('4')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG1StepNumberFive($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('1') and stepNumber in ('5')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG1StepNumberSix($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('1') and stepNumber in ('6')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG1StepNumberSeven($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('1') and stepNumber in ('7')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG1StepNumberEight($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('1') and stepNumber in ('8')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

//  --------------------------------------- Salary Grade Number 2  ----------------------------------  //	
	function viewSG2StepNumberOne($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('2') and stepNumber in ('1')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG2StepNumberTwo($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('2') and stepNumber in ('2')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG2StepNumberThree($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('2') and stepNumber in ('3')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG2StepNumberFour($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('2') and stepNumber in ('4')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG2StepNumberFive($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('2') and stepNumber in ('5')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG2StepNumberSix($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('2') and stepNumber in ('6')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG2StepNumberSeven($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('2') and stepNumber in ('7')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG2StepNumberEight($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('2') and stepNumber in ('8')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

//  --------------------------------------- Salary Grade Number 3  ----------------------------------  //	
	function viewSG3StepNumberOne($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('3') and stepNumber in ('1')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG3StepNumberTwo($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('3') and stepNumber in ('2')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG3StepNumberThree($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('3') and stepNumber in ('3')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG3StepNumberFour($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('3') and stepNumber in ('4')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG3StepNumberFive($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('3') and stepNumber in ('5')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG3StepNumberSix($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('3') and stepNumber in ('6')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG3StepNumberSeven($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('3') and stepNumber in ('7')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG3StepNumberEight($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('3') and stepNumber in ('8')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

//  --------------------------------------- Salary Grade Number 4  ----------------------------------  //	
	function viewSG4StepNumberOne($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('4') and stepNumber in ('1')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG4StepNumberTwo($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('4') and stepNumber in ('2')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG4StepNumberThree($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('4') and stepNumber in ('3')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG4StepNumberFour($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('4') and stepNumber in ('4')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG4StepNumberFive($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('4') and stepNumber in ('5')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG4StepNumberSix($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('4') and stepNumber in ('6')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG4StepNumberSeven($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('4') and stepNumber in ('7')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG4StepNumberEight($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('4') and stepNumber in ('8')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}
	
//  --------------------------------------- Salary Grade Number 5  ----------------------------------  //	
	function viewSG5StepNumberOne($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('5') and stepNumber in ('1')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG5StepNumberTwo($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('5') and stepNumber in ('2')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG5StepNumberThree($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('5') and stepNumber in ('3')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG5StepNumberFour($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('5') and stepNumber in ('4')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG5StepNumberFive($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('5') and stepNumber in ('5')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG5StepNumberSix($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('5') and stepNumber in ('6')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG5StepNumberSeven($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('5') and stepNumber in ('7')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG5StepNumberEight($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('5') and stepNumber in ('8')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}
//  --------------------------------------- Salary Grade Number 6  ----------------------------------  //	
	function viewSG6StepNumberOne($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('6') and stepNumber in ('1')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG6StepNumberTwo($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('6') and stepNumber in ('2')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG6StepNumberThree($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('6') and stepNumber in ('3')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG6StepNumberFour($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('6') and stepNumber in ('4')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG6StepNumberFive($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('6') and stepNumber in ('5')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG6StepNumberSix($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('6') and stepNumber in ('6')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG6StepNumberSeven($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('6') and stepNumber in ('7')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG6StepNumberEight($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('6') and stepNumber in ('8')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}
//  --------------------------------------- Salary Grade Number 7  ----------------------------------  //	
	function viewSG7StepNumberOne($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('7') and stepNumber in ('1')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG7StepNumberTwo($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('7') and stepNumber in ('2')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG7StepNumberThree($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('7') and stepNumber in ('3')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG7StepNumberFour($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('7') and stepNumber in ('4')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG7StepNumberFive($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('7') and stepNumber in ('5')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG7StepNumberSix($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('7') and stepNumber in ('6')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG7StepNumberSeven($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('7') and stepNumber in ('7')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG7StepNumberEight($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('7') and stepNumber in ('8')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}
//  --------------------------------------- Salary Grade Number 8  ----------------------------------  //	
	function viewSG8StepNumberOne($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('8') and stepNumber in ('1')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG8StepNumberTwo($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('8') and stepNumber in ('2')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG8StepNumberThree($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('8') and stepNumber in ('3')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG8StepNumberFour($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('8') and stepNumber in ('4')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG8StepNumberFive($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('8') and stepNumber in ('5')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG8StepNumberSix($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('8') and stepNumber in ('6')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG8StepNumberSeven($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('8') and stepNumber in ('7')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG8StepNumberEight($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('8') and stepNumber in ('8')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}
//  --------------------------------------- Salary Grade Number 9  ----------------------------------  //	
	function viewSG9StepNumberOne($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('9') and stepNumber in ('1')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG9StepNumberTwo($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('9') and stepNumber in ('2')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG9StepNumberThree($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('9') and stepNumber in ('3')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG9StepNumberFour($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('9') and stepNumber in ('4')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG9StepNumberFive($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('9') and stepNumber in ('5')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG9StepNumberSix($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('9') and stepNumber in ('6')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG9StepNumberSeven($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('9') and stepNumber in ('7')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG9StepNumberEight($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('9') and stepNumber in ('8')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}
//  --------------------------------------- Salary Grade Number 10  --------------------------------  //	
	function viewSG10StepNumberOne($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('10') and stepNumber in ('1')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG10StepNumberTwo($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('10') and stepNumber in ('2')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG10StepNumberThree($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('10') and stepNumber in ('3')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG10StepNumberFour($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('10') and stepNumber in ('4')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG10StepNumberFive($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('10') and stepNumber in ('5')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG10StepNumberSix($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('10') and stepNumber in ('6')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG10StepNumberSeven($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('10') and stepNumber in ('7')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG10StepNumberEight($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('10') and stepNumber in ('8')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}
//  --------------------------------------- Salary Grade Number 11  --------------------------------  //	
	function viewSG11StepNumberOne($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('11') and stepNumber in ('1')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG11StepNumberTwo($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('11') and stepNumber in ('2')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG11StepNumberThree($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('11') and stepNumber in ('3')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG11StepNumberFour($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('11') and stepNumber in ('4')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG11StepNumberFive($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('11') and stepNumber in ('5')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG11StepNumberSix($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('11') and stepNumber in ('6')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG11StepNumberSeven($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('11') and stepNumber in ('7')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG11StepNumberEight($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('11') and stepNumber in ('8')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}
//  --------------------------------------- Salary Grade Number 12  ----------------------------------  //	
	function viewSG12StepNumberOne($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('12') and stepNumber in ('1')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG12StepNumberTwo($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('12') and stepNumber in ('2')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG12StepNumberThree($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('12') and stepNumber in ('3')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG12StepNumberFour($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('12') and stepNumber in ('4')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG12StepNumberFive($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('12') and stepNumber in ('5')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG12StepNumberSix($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('12') and stepNumber in ('6')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG12StepNumberSeven($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('12') and stepNumber in ('7')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG12StepNumberEight($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('12') and stepNumber in ('8')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}
//  --------------------------------------- Salary Grade Number 13  ----------------------------------  //	
	function viewSG13StepNumberOne($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('13') and stepNumber in ('1')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG13StepNumberTwo($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('13') and stepNumber in ('2')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG13StepNumberThree($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('13') and stepNumber in ('3')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG13StepNumberFour($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('13') and stepNumber in ('4')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG13StepNumberFive($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('13') and stepNumber in ('5')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG13StepNumberSix($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('13') and stepNumber in ('6')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG13StepNumberSeven($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('13') and stepNumber in ('7')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG13StepNumberEight($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('13') and stepNumber in ('8')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}
//  --------------------------------------- Salary Grade Number 14  ---------------------------------  //	
	function viewSG14StepNumberOne($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('14') and stepNumber in ('1')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG14StepNumberTwo($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('14') and stepNumber in ('2')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG14StepNumberThree($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('14') and stepNumber in ('3')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG14StepNumberFour($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('14') and stepNumber in ('4')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG14StepNumberFive($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('14') and stepNumber in ('5')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG14StepNumberSix($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('14') and stepNumber in ('6')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG14StepNumberSeven($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('14') and stepNumber in ('7')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG14StepNumberEight($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('14') and stepNumber in ('8')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}
//  --------------------------------------- Salary Grade Number 15  ---------------------------------  //	
	function viewSG15StepNumberOne($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('15') and stepNumber in ('1')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG15StepNumberTwo($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('15') and stepNumber in ('2')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG15StepNumberThree($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('15') and stepNumber in ('3')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG15StepNumberFour($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('15') and stepNumber in ('4')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG15StepNumberFive($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('15') and stepNumber in ('5')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG15StepNumberSix($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('15') and stepNumber in ('6')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG15StepNumberSeven($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('15') and stepNumber in ('7')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG15StepNumberEight($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('15') and stepNumber in ('8')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}
//  --------------------------------------- Salary Grade Number 16  ---------------------------------  //	
	function viewSG16StepNumberOne($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('16') and stepNumber in ('1')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG16StepNumberTwo($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('16') and stepNumber in ('2')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG16StepNumberThree($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('16') and stepNumber in ('3')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG16StepNumberFour($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('16') and stepNumber in ('4')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG16StepNumberFive($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('16') and stepNumber in ('5')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG16StepNumberSix($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('16') and stepNumber in ('6')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG16StepNumberSeven($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('16') and stepNumber in ('7')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG16StepNumberEight($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('16') and stepNumber in ('8')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}
//  --------------------------------------- Salary Grade Number 17  --------------------------------  //	
	function viewSG17StepNumberOne($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('17') and stepNumber in ('1')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG17StepNumberTwo($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('17') and stepNumber in ('2')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG17StepNumberThree($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('17') and stepNumber in ('3')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG17StepNumberFour($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('17') and stepNumber in ('4')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG17StepNumberFive($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('17') and stepNumber in ('5')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG17StepNumberSix($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('17') and stepNumber in ('6')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG17StepNumberSeven($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('17') and stepNumber in ('7')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG17StepNumberEight($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('17') and stepNumber in ('8')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}
//  --------------------------------------- Salary Grade Number 18  --------------------------------  //	
	function viewSG18StepNumberOne($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('18') and stepNumber in ('1')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG18StepNumberTwo($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('18') and stepNumber in ('2')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG18StepNumberThree($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('18') and stepNumber in ('3')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG18StepNumberFour($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('18') and stepNumber in ('4')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG18StepNumberFive($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('18') and stepNumber in ('5')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG18StepNumberSix($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('18') and stepNumber in ('6')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG18StepNumberSeven($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('18') and stepNumber in ('7')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG18StepNumberEight($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('18') and stepNumber in ('8')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}
//  --------------------------------------- Salary Grade Number 19  --------------------------------  //	
	function viewSG19StepNumberOne($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('19') and stepNumber in ('1')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG19StepNumberTwo($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('19') and stepNumber in ('2')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG19StepNumberThree($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('19') and stepNumber in ('3')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG19StepNumberFour($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('19') and stepNumber in ('4')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG19StepNumberFive($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('19') and stepNumber in ('5')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG19StepNumberSix($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('19') and stepNumber in ('6')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG19StepNumberSeven($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('19') and stepNumber in ('7')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG19StepNumberEight($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('19') and stepNumber in ('8')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}
//  --------------------------------------- Salary Grade Number 20  --------------------------------  //	
	function viewSG20StepNumberOne($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('20') and stepNumber in ('1')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG20StepNumberTwo($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('20') and stepNumber in ('2')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG20StepNumberThree($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('20') and stepNumber in ('3')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG20StepNumberFour($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('20') and stepNumber in ('4')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG20StepNumberFive($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('20') and stepNumber in ('5')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG20StepNumberSix($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('20') and stepNumber in ('6')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG20StepNumberSeven($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('20') and stepNumber in ('7')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG20StepNumberEight($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('20') and stepNumber in ('8')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}
//  --------------------------------------- Salary Grade Number 21  --------------------------------  //	
	function viewSG21StepNumberOne($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('21') and stepNumber in ('1')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG21StepNumberTwo($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('21') and stepNumber in ('2')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG21StepNumberThree($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('21') and stepNumber in ('3')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG21StepNumberFour($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('21') and stepNumber in ('4')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG21StepNumberFive($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('21') and stepNumber in ('5')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG21StepNumberSix($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('21') and stepNumber in ('6')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG21StepNumberSeven($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('21') and stepNumber in ('7')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG21StepNumberEight($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('21') and stepNumber in ('8')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}
//  --------------------------------------- Salary Grade Number 22  ----------------------------------  //	
	function viewSG22StepNumberOne($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('22') and stepNumber in ('1')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG22StepNumberTwo($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('22') and stepNumber in ('2')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG22StepNumberThree($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('22') and stepNumber in ('3')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG22StepNumberFour($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('22') and stepNumber in ('4')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG22StepNumberFive($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('22') and stepNumber in ('5')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG22StepNumberSix($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('22') and stepNumber in ('6')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG22StepNumberSeven($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('22') and stepNumber in ('7')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG22StepNumberEight($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('22') and stepNumber in ('8')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}
//  --------------------------------------- Salary Grade Number 23  --------------------------------  //	
	function viewSG23StepNumberOne($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('23') and stepNumber in ('1')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG23StepNumberTwo($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('23') and stepNumber in ('2')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG23StepNumberThree($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('23') and stepNumber in ('3')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG23StepNumberFour($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('23') and stepNumber in ('4')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG23StepNumberFive($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('23') and stepNumber in ('5')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG23StepNumberSix($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('23') and stepNumber in ('6')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG23StepNumberSeven($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('23') and stepNumber in ('7')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG23StepNumberEight($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('23') and stepNumber in ('8')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}
//  --------------------------------------- Salary Grade Number 24  ----------------------------------  //	
	function viewSG24StepNumberOne($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('24') and stepNumber in ('1')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG24StepNumberTwo($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('24') and stepNumber in ('2')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG24StepNumberThree($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('24') and stepNumber in ('3')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG24StepNumberFour($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('24') and stepNumber in ('4')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG24StepNumberFive($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('24') and stepNumber in ('5')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG24StepNumberSix($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('24') and stepNumber in ('6')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG24StepNumberSeven($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('24') and stepNumber in ('7')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG24StepNumberEight($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('24') and stepNumber in ('8')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}
//  --------------------------------------- Salary Grade Number 25 ---------------------------------  //	
	function viewSG25StepNumberOne($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('25') and stepNumber in ('1')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG25StepNumberTwo($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('25') and stepNumber in ('2')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG25StepNumberThree($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('25') and stepNumber in ('3')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG25StepNumberFour($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('25') and stepNumber in ('4')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG25StepNumberFive($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('25') and stepNumber in ('5')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG25StepNumberSix($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('25') and stepNumber in ('6')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG25StepNumberSeven($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('25') and stepNumber in ('7')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG25StepNumberEight($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('25') and stepNumber in ('8')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}
//  --------------------------------------- Salary Grade Number 26  ----------------------------------  //	
	function viewSG26StepNumberOne($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('26') and stepNumber in ('1')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG26StepNumberTwo($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('26') and stepNumber in ('2')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG26StepNumberThree($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('26') and stepNumber in ('3')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG26StepNumberFour($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('26') and stepNumber in ('4')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG26StepNumberFive($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('26') and stepNumber in ('5')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG26StepNumberSix($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('26') and stepNumber in ('6')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG26StepNumberSeven($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('26') and stepNumber in ('7')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG26StepNumberEight($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('26') and stepNumber in ('8')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}
//  --------------------------------------- Salary Grade Number 27  --------------------------------  //	
	function viewSG27StepNumberOne($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('27') and stepNumber in ('1')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG27StepNumberTwo($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('27') and stepNumber in ('2')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG27StepNumberThree($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('27') and stepNumber in ('3')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG27StepNumberFour($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('27') and stepNumber in ('4')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG27StepNumberFive($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('27') and stepNumber in ('5')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG27StepNumberSix($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('27') and stepNumber in ('6')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG27StepNumberSeven($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('27') and stepNumber in ('7')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG27StepNumberEight($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('27') and stepNumber in ('8')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}
//  --------------------------------------- Salary Grade Number 28  --------------------------------  //	
	function viewSG28StepNumberOne($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('28') and stepNumber in ('1')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG28StepNumberTwo($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('28') and stepNumber in ('2')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG28StepNumberThree($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('28') and stepNumber in ('3')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG28StepNumberFour($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('28') and stepNumber in ('4')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG28StepNumberFive($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('28') and stepNumber in ('5')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG28StepNumberSix($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('28') and stepNumber in ('6')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG28StepNumberSeven($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('28') and stepNumber in ('7')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG28StepNumberEight($strEmpNmbr) 
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('28') and stepNumber in ('8')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}
//  --------------------------------------- Salary Grade Number 29  --------------------------------  //	
	function viewSG29StepNumberOne($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('29') and stepNumber in ('1')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG29StepNumberTwo($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('29') and stepNumber in ('2')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG29StepNumberThree($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('29') and stepNumber in ('3')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG29StepNumberFour($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('29') and stepNumber in ('4')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG29StepNumberFive($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('29') and stepNumber in ('5')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG29StepNumberSix($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('29') and stepNumber in ('6')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG29StepNumberSeven($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('29') and stepNumber in ('7')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG29StepNumberEight($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('29') and stepNumber in ('8')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}
//  --------------------------------------- Salary Grade Number 30  --------------------------------  //	
	function viewSG30StepNumberOne($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('30') and stepNumber in ('1')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG30StepNumberTwo($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('30') and stepNumber in ('2')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG30StepNumberThree($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('30') and stepNumber in ('3')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG30StepNumberFour($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('30') and stepNumber in ('4')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG30StepNumberFive($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('30') and stepNumber in ('5')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG30StepNumberSix($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('30') and stepNumber in ('6')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG30StepNumberSeven($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('30') and stepNumber in ('7')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG30StepNumberEight($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('30') and stepNumber in ('8')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}
//  --------------------------------------- Salary Grade Number 31  --------------------------------  //	
	function viewSG31StepNumberOne($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('31') and stepNumber in ('1')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG31StepNumberTwo($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('31') and stepNumber in ('2')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG31StepNumberThree($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('31') and stepNumber in ('3')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG31StepNumberFour($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('31') and stepNumber in ('4')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG31StepNumberFive($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('31') and stepNumber in ('5')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG31StepNumberSix($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('31') and stepNumber in ('6')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG31StepNumberSeven($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('31') and stepNumber in ('7')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG31StepNumberEight($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('31') and stepNumber in ('8')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}
//  --------------------------------------- Salary Grade Number 32  --------------------------------  //	
	function viewSG32StepNumberOne($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('32') and stepNumber in ('1')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG32StepNumberTwo($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('32') and stepNumber in ('2')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG32StepNumberThree($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('32') and stepNumber in ('3')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG32StepNumberFour($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('32') and stepNumber in ('4')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG32StepNumberFive($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('32') and stepNumber in ('5')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG32StepNumberSix($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('32') and stepNumber in ('6')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG32StepNumberSeven($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('32') and stepNumber in ('7')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG32StepNumberEight($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('32') and stepNumber in ('8')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}
//  --------------------------------------- Salary Grade Number 33  --------------------------------  //	
	function viewSG33StepNumberOne($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('33') and stepNumber in ('1')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG33StepNumberTwo($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('33') and stepNumber in ('2')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG33StepNumberThree($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('33') and stepNumber in ('3')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG33StepNumberFour($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('33') and stepNumber in ('4')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG33StepNumberFive($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('33') and stepNumber in ('5')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG33StepNumberSix($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('33') and stepNumber in ('6')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG33StepNumberSeven($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('33') and stepNumber in ('7')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

	function viewSG33StepNumberEight($strEmpNmbr)
	{				
		$result = mysql_query("select * 
			   from tblSalarySched 
			   where salaryGradeNumber in ('33') and stepNumber in ('8')") 
			   or die (mysql_error());
		if (!$row = mysql_fetch_array($result))
		{
			echo "";
		} else {
				$t_intSalaryGradeNumber= $row['salaryGradeNumber'];
				$t_intStepNumber=$row['stepNumber'];
				$t_intActualSalary=$row['actualSalary'];
				echo "<a href=\"Salaryschedule.php?strEmpNmbr=$strEmpNmbr&t_intSalaryGradeNumber=$t_intSalaryGradeNumber&t_intStepNumber=$t_intStepNumber&t_intActualSalary=$t_intActualSalary&Submit=Edit\">" . $row['actualSalary'] . "</a>";
		} 	
	}

}  //  class endif
?> 