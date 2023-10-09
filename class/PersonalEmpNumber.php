<?php 
/* 
File Name: PersonalEmpNumber.php (class folder)
----------------------------------------------------------------------
Purpose of this file: 
To add employee's personal data.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco
----------------------------------------------------------------------
Date of Revision: November 02, 2004 (Version 2.0.0)
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
class PersonalEmpNumber extends General
{
	function tblEmpAccount($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber)	//  edit empNumber on tblEmpAccount
	{
		if ($Submit == 'Update')
		{
		
			//  tblEmpAccount
			$objUpdateEmpAccount = "UPDATE tblEmpAccount SET tblEmpAccount.empNumber='$t_strOldEmpNumber'
										WHERE tblEmpAccount.empNumber = '$t_strEmpNumber' ";
			$arrEmpAccount = mysql_query($objUpdateEmpAccount);
			
			 if(!$arrEmpAccount) 
			 { 
				echo "<b>Employee number not yet updated on tblEmpAccount:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($arrEmpAccount) 
			 { 
				return 1; 
			 }
		}	//  end if
	}	//  end function tblEmpAddIncome
			
	function tblEmpAddIncome($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber)	//  edit empNumber on tblEmpAddIncome
	{
		if ($Submit == 'Update')
		{
			
			//  tblEmpAddIncome
			$objUpdateEmpAddIncome = "UPDATE tblEmpAddIncome SET tblEmpAddIncome.empNumber='$t_strOldEmpNumber' 
										WHERE tblEmpAddIncome.empNumber = '$t_strEmpNumber' ";
			$arrEmpAddIncome = mysql_query($objUpdateEmpAddIncome);

			 if(!$arrEmpAddIncome) 
			 { 
				echo "<b>Employee number not yet updated on tblEmpAddIncome:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($arrEmpAddIncome) 
			 { 
				return 1; 
			 }
		}	//  end if
	}	//  end function tblEmpAddIncome


	function tblEmpAgencyShare($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber)	//  edit empNumber on tblEmpAgencyShare
	{
		if ($Submit == 'Update')
		{
			
			//  tblEmpAgencyShare
			$objUpdateEmpAgencyShare = "UPDATE tblEmpAgencyShare SET tblEmpAgencyShare.empNumber='$t_strOldEmpNumber'
											WHERE tblEmpAgencyShare.empNumber = '$t_strEmpNumber' ";
			$arrEmpAgencyShare = mysql_query($objUpdateEmpAgencyShare);

			 if(!$arrEmpAgencyShare) 
			 { 
				echo "<b>Employee number not yet updated on tblEmpAgencyShare:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($arrEmpAgencyShare) 
			 { 
				return 1; 
			 }
			 
		}	//  end if
	}	//  end function tblEmpAgencyShare


	function tblEmpChild($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber)	//  edit empNumber on tblEmpChild
	{
		if ($Submit == 'Update')
		{
			
			//  tblEmpChild
			$objUpdateEmpChild = "UPDATE tblEmpChild SET tblEmpChild.empNumber='$t_strOldEmpNumber' 
										WHERE tblEmpChild.empNumber = '$t_strEmpNumber' ";
			$arrEmpChild = mysql_query($objUpdateEmpChild);

			 if(!$arrEmpChild) 
			 { 
				echo "<b>Employee number not yet updated on tblEmpChild:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($arrEmpChild) 
			 { 
				return 1; 
			 }
			 
		}	//  end if update
	}	//  end function tblEmpChild


	function tblEmpDeduction($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber)	//  edit empNumber on tblEmpDeduction
	{
		if ($Submit == 'Update')
		{
			
			//  tblEmpDeduction			
			$objUpdateEmpDeduction = "UPDATE tblEmpDeduction SET tblEmpDeduction.empNumber='$t_strOldEmpNumber'
										WHERE tblEmpDeduction.empNumber = '$t_strEmpNumber' ";
			$arrEmpDeduction = mysql_query($objUpdateEmpDeduction);


			 if(!$arrEmpDeduction) 
			 { 
				echo "<b>Employee number not yet updated on tblEmpDeduction:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($arrEmpDeduction) 
			 { 
				return 1; 
			 }
			 
		}	//  end if update
	}	//  end function tblEmpDeduction


	function tblEmpDeductRemit($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber)	//  edit empNumber on tblEmpDeductRemit
	{
		if ($Submit == 'Update')
		{
			
			//  tblEmpDeductRemit
			$objUpdateEmpDeductRemit = "UPDATE tblEmpDeductRemit SET tblEmpDeductRemit.empNumber='$t_strOldEmpNumber'
											WHERE tblEmpDeductRemit.empNumber = '$t_strEmpNumber' ";
			$arrEmpDeductRemit = mysql_query($objUpdateEmpDeductRemit);
			
			 if(!$arrEmpDeductRemit) 
			 { 
				echo "<b>Employee number not yet updated on tblEmpDeductRemit:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($arrEmpDeductRemit) 
			 { 
				return 1; 
			 }
			 
		}	//  end if update
	}	//  end function tblEmpDeductRemit


	function tblEmpDTR($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber)	//  edit empNumber on tblEmpDTR
	{
		if ($Submit == 'Update')
		{
			
			//  tblEmpDTR					
			$objUpdateEmpDTR = "UPDATE tblEmpDTR SET tblEmpDTR.empNumber='$t_strOldEmpNumber' 
									WHERE tblEmpDTR.empNumber = '$t_strEmpNumber' ";
			$arrEmpDTR = mysql_query($objUpdateEmpDTR);
			
			 if(!$arrEmpDTR) 
			 { 
				echo "<b>Employee number not yet updated on tblEmpDTR:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($arrEmpDTR) 
			 { 
				return 1; 
			 }
			 
		}	//  end if update
	}	//  end function tblEmpDTR


	function tblEmpDuties($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber)	//  edit empNumber on tblEmpDuties
	{
		if ($Submit == 'Update')
		{
			
			//  tblEmpDuties
			$objUpdateEmpDuties = "UPDATE tblEmpDuties SET tblEmpDuties.empNumber='$t_strOldEmpNumber' 
										WHERE tblEmpDuties.empNumber = '$t_strEmpNumber' ";
			$arrEmpDuties = mysql_query($objUpdateEmpDuties);

			 if(!$arrEmpDuties) 
			 { 
				echo "<b>Employee number not yet updated on tblEmpDuties:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($arrEmpDuties) 
			 { 
				return 1; 
			 }
			 
		}	//  end if update
	}	//  end function tblEmpDuties


	function tblEmpExam($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber)	//  edit empNumber on tblEmpExam
	{
		if ($Submit == 'Update')
		{
			
			//  tblEmpExam
			$objUpdateEmpExam = "UPDATE tblEmpExam SET tblEmpExam.empNumber='$t_strOldEmpNumber' 
									WHERE tblEmpExam.empNumber = '$t_strEmpNumber' ";
			$arrEmpExam = mysql_query($objUpdateEmpExam);
			
			
			 if(!$arrEmpExam) 
			 { 
				echo "<b>Employee number not yet updated on tblEmpExam:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($arrEmpExam) 
			 { 
				return 1; 
			 }
			 
		}	//  end if update
	}	//  end function tblEmpExam


	function tblEmpIncome($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber)	//  edit empNumber on tblEmpIncome
	{
		if ($Submit == 'Update')
		{
			
			//  tblEmpIncome
			$objUpdateEmpIncome = "UPDATE tblEmpIncome SET tblEmpIncome.empNumber='$t_strOldEmpNumber' 
									WHERE tblEmpIncome.empNumber = '$t_strEmpNumber' ";
			$arrEmpIncome = mysql_query($objUpdateEmpIncome);

			 if(!$arrEmpIncome) 
			 { 
				echo "<b>Employee number not yet updated on tblEmpIncome:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($arrEmpIncome) 
			 { 
				return 1; 
			 }
			 
		}	//  end if update
	}	//  end function tblEmpIncome


	function tblEmpLeave($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber)		//  edit empNumber on tblEmpLeave
	{
		if ($Submit == 'Update')
		{
			
			//  tblEmpLeave
			$objUpdateEmpLeave = "UPDATE tblEmpLeave SET tblEmpLeave.empNumber='$t_strOldEmpNumber' 
									WHERE tblEmpLeave.empNumber = '$t_strEmpNumber' ";
			$arrEmpLeave = mysql_query($objUpdateEmpLeave);
								
			 if(!$arrEmpLeave) 
			 { 
				echo "<b>Employee number not yet updated on tblEmpLeave:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($arrEmpLeave) 
			 { 
				return 1; 
			 }
			 
		}	//  end if update
	}	//  end function tblEmpLeave


	function tblEmpLeaveBalance($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber)	//  edit empNumber on tblEmpLeaveBalance
	{
		if ($Submit == 'Update')
		{
			
			//  tblEmpLeaveBalance
			$objUpdateEmpLeaveBalance = "UPDATE tblEmpLeaveBalance SET tblEmpLeaveBalance.empNumber='$t_strOldEmpNumber'
											WHERE tblEmpLeaveBalance.empNumber = '$t_strEmpNumber' ";
			$arrEmpLeaveBalance = mysql_query($objUpdateEmpLeaveBalance);
					
			 if(!$arrEmpLeaveBalance) 
			 { 
				echo "<b>Employee number not yet updated on tblEmpLeaveBalance:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($arrEmpLeaveBalance) 
			 { 
				return 1; 
			 }
			 
		}	//  end if update
	}	//  end function tblEmpLeaveBalance


	function tblEmpMeeting($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber)	//  edit empNumber on tblEmpMeeting
	{
		if ($Submit == 'Update')
		{
			
			//  tblEmpMeeting
			$objUpdateEmpMeeting = "UPDATE tblEmpMeeting SET tblEmpMeeting.empNumber='$t_strOldEmpNumber'
										WHERE tblEmpMeeting.empNumber = '$t_strEmpNumber' ";
			$arrEmpMeeting = mysql_query($objUpdateEmpMeeting);

			 if(!$arrEmpMeeting) 
			 { 
				echo "<b>Employee number not yet updated on tblEmpMeeting:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($arrEmpMeeting) 
			 { 
				return 1; 
			 }
			 
		}	//  end if update
	}	//  end function tblEmpMeeting


	function tblEmpMonetization($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber)	//  edit empNumber on tblEmpMonetization
	{
		if ($Submit == 'Update')
		{
			
			//  tblEmpMonetization
			$objUpdateEmpMonetization = "UPDATE tblEmpMonetization SET tblEmpMonetization.empNumber='$t_strOldEmpNumber'
											WHERE tblEmpMonetization.empNumber = '$t_strEmpNumber' ";
			$arrEmpMonetization = mysql_query($objUpdateEmpMonetization);
								
			 if(!$arrEmpMonetization) 
			 { 
				echo "<b>Employee number not yet updated on tblEmpMonetization:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($arrEmpMonetization) 
			 { 
				return 1; 
			 }
			 
		}	//  end if update
	}	//  end function tblEmpMonetization


	function tblEmpOB($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber)	//  edit empNumber on tblEmpOB
	{
		if ($Submit == 'Update')
		{
			
			//  tblEmpOB
			$objUpdateEmpOB = "UPDATE tblEmpOB SET tblEmpOB.empNumber='$t_strOldEmpNumber'
									WHERE tblEmpOB.empNumber = '$t_strEmpNumber' ";
			$arrEmpOB = mysql_query($objUpdateEmpOB);
	
			 if(!$arrEmpOB) 
			 { 
				echo "<b>Employee number not yet updated on tblEmpOB:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($arrEmpOB) 
			 { 
				return 1; 
			 }
			 
		}	//  end if update
	}	//  end function tblEmpOB


	function tblEmpOvertime($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber)	//  edit empNumber on tblEmpOvertime
	{
		if ($Submit == 'Update')
		{
			
			//  tblEmpOvertime  
			$objUpdateEmpOvertime = "UPDATE tblEmpOvertime SET tblEmpOvertime.empNumber='$t_strOldEmpNumber'
										WHERE tblEmpOvertime.empNumber = '$t_strEmpNumber' ";
			$arrEmpOvertime = mysql_query($objUpdateEmpOvertime);

			 if(!$arrEmpOvertime) 
			 { 
				echo "<b>Employee number not yet updated on tblEmpOvertime:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($arrEmpOvertime) 
			 { 
				return 1; 
			 }
			 
		}	//  end if update
	}	//  end function tblEmpOvertime


	function tblEmpPersonal($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber)	//  edit empNumber on tblEmpPersonal
	{
		if ($Submit == 'Update')
		{
			
			//  tblEmpPersonal
			$objUpdateEmpPersonal = "UPDATE tblEmpPersonal SET tblEmpPersonal.empNumber='$t_strOldEmpNumber'
										WHERE tblEmpPersonal.empNumber = '$t_strEmpNumber' ";
			$arrEmpPersonal = mysql_query($objUpdateEmpPersonal);
				
			 if(!$arrEmpPersonal) 
			 { 
				echo "<b>Employee number not yet updated on tblEmpPersonal:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($arrEmpPersonal) 
			 { 
				return 1; 
			 }
			 
		}	//  end if update
	}	//  end function tblEmpPersonal


	function tblEmpPicture($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber)	//  edit empNumber on tblEmpPicture
	{
		if ($Submit == 'Update')
		{
			
			//  tblEmpPicture				
			$objUpdateEmpPicture = "UPDATE tblEmpPicture SET tblEmpPicture.empNumber='$t_strOldEmpNumber'
										WHERE tblEmpPicture.empNumber = '$t_strEmpNumber' ";
			$arrEmpPicture = mysql_query($objUpdateEmpPicture);

			 if(!$arrEmpPicture) 
			 { 
				echo "<b>Employee number not yet updated on tblEmpPicture:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($arrEmpPicture) 
			 { 
				return 1; 
			 }
			 
		}	//  end if update
	}	//  end function tblEmpPicture


	function tblEmpPosition($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber)	//  edit empNumber on tblEmpPosition
	{
		if ($Submit == 'Update')
		{
			
			//  tblEmpPosition
			$objUpdateEmpPosition = "UPDATE tblEmpPosition SET tblEmpPosition.empNumber='$t_strOldEmpNumber'
										WHERE tblEmpPosition.empNumber = '$t_strEmpNumber' ";
			$arrEmpPosition = mysql_query($objUpdateEmpPosition);
			
			
			 if(!$arrEmpPosition) 
			 { 
				echo "<b>Employee number not yet updated on tblEmpPosition:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($arrEmpPosition) 
			 { 
				return 1; 
			 }
			 
		}	//  end if update
	}	//  end function tblEmpPosition


	function tblEmpReference($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber)	//  edit empNumber on tblEmpReference
	{
		if ($Submit == 'Update')
		{
			
			//  tblEmpReference
			$objUpdateEmpReference = "UPDATE tblEmpReference SET tblEmpReference.empNumber='$t_strOldEmpNumber'
										WHERE tblEmpReference.empNumber = '$t_strEmpNumber' ";
			$arrEmpReference = mysql_query($objUpdateEmpReference);


			 if(!$arrEmpReference) 
			 { 
				echo "<b>Employee number not yet updated on tblEmpReference:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($arrEmpReference) 
			 { 
				return 1; 
			 }
			 
		}	//  end if update
	}	//  end function ttblEmpReference


	function tblEmpRequest($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber)	//  edit empNumber on tblEmpRequest
	{
		if ($Submit == 'Update')
		{
			
			//  tblEmpRequest
			$objUpdateEmpRequest = "UPDATE tblEmpRequest SET tblEmpRequest.empNumber='$t_strOldEmpNumber'
										WHERE tblEmpRequest.empNumber = '$t_strEmpNumber' ";
			$arrEmpRequest = mysql_query($objUpdateEmpRequest);

			 if(!$arrEmpRequest) 
			 { 
				echo "<b>Employee number not yet updated on tblEmpRequest:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($arrEmpRequest) 
			 { 
				return 1; 
			 }
			 
		}	//  end if update
	}	//  end function tblEmpRequest


	function tblEmpSchool($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber)	//  edit empNumber on tblEmpSchool
	{
		if ($Submit == 'Update')
		{
			
			//  tblEmpSchool
			$objUpdateEmpSchool = "UPDATE tblEmpSchool SET tblEmpSchool.empNumber='$t_strOldEmpNumber'
										WHERE tblEmpSchool.empNumber = '$t_strEmpNumber' ";
			$arrEmpSchool = mysql_query($objUpdateEmpSchool);

			 if(!$arrEmpSchool) 
			 { 
				echo "<b>Employee number not yet updated on tblEmpSchool:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($arrEmpSchool) 
			 { 
				return 1; 
			 }
			 
		}	//  end if update
	}	//  end function tblEmpSchool


	function tblEmpTraining($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber)	//  edit empNumber on tblEmpTraining
	{
		if ($Submit == 'Update')
		{
			
			//  tblEmpTraining
			$objUpdateEmpTraining = "UPDATE tblEmpTraining SET tblEmpTraining.empNumber='$t_strOldEmpNumber'
										WHERE tblEmpTraining.empNumber = '$t_strEmpNumber' ";
			$arrEmpTraining = mysql_query($objUpdateEmpTraining);
								
			 if(!$arrEmpTraining) 
			 { 
				echo "<b>Employee number not yet updated on tblEmpTraining:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($arrEmpTraining) 
			 { 
				return 1; 
			 }
			 
		}	//  end if update
	}	//  end function tblEmpTraining


	function tblEmpTravelOrder($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber)	//  edit empNumber on tblEmpTravelOrder
	{
		if ($Submit == 'Update')
		{
			
			
			//  tblEmpTravelOrder
			$objUpdateEmpTravelOrder = "UPDATE tblEmpTravelOrder SET tblEmpTravelOrder.empNumber='$t_strOldEmpNumber'
											WHERE tblEmpTravelOrder.empNumber = '$t_strEmpNumber' ";
			$arrEmpTravelOrder = mysql_query($objUpdateEmpTravelOrder);
								
			
			 if(!$arrEmpTravelOrder) 
			 { 
				echo "<b>Employee number not yet updated on tblEmpTravelOrder:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($arrEmpTravelOrder) 
			 { 
				return 1; 
			 }
			 
		}	//  end if update
	}	//  end function tblEmpTravelOrder


	function tblEmpTripTicket($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber)	//  edit empNumber on tblEmpTripTicket
	{
		if ($Submit == 'Update')
		{
			
			//  tblEmpTripTicket
			$objUpdateEmpTripTicket = "UPDATE tblEmpTripTicket SET tblEmpTripTicket.empNumber='$t_strOldEmpNumber'
										WHERE tblEmpTripTicket.empNumber = '$t_strEmpNumber' ";
			$arrEmpTripTicket = mysql_query($objUpdateEmpTripTicket);


			 if(!$arrEmpTripTicket) 
			 { 
				echo "<b>Employee number not yet updated on tblEmpTripTicket:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($arrEmpTripTicket) 
			 { 
				return 1; 
			 }
			 
		}	//  end if update
	}	//  end function tblEmpTripTicket


	function tblEmpVoluntaryWork($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber)	//  edit empNumber on tblEmpVoluntaryWork
	{
		if ($Submit == 'Update')
		{
			
			//  tblEmpVoluntaryWork
			$objUpdateEmpVoluntaryWork = "UPDATE tblEmpVoluntaryWork SET tblEmpVoluntaryWork.empNumber='$t_strOldEmpNumber'
											WHERE tblEmpVoluntaryWork.empNumber = '$t_strEmpNumber' ";
			$arrEmpVoluntaryWork = mysql_query($objUpdateEmpVoluntaryWork);

								
			 if(!$arrEmpVoluntaryWork) 
			 { 
				echo "<b>Employee number not yet updated on tblEmpVoluntaryWork:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($arrEmpVoluntaryWork) 
			 { 
				return 1; 
			 }
			 
		}	//  end if update
	}	//  end function tblEmpVoluntaryWork


	function tblIncomeDetails($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber)	//  edit empNumber on tblIncomeDetails
	{
		if ($Submit == 'Update')
		{
			
			//  tblIncomeDetails
			$objUpdateEmpIncomeDetails = "UPDATE tblIncomeDetails SET tblIncomeDetails.empNumber='$t_strOldEmpNumber'
											WHERE tblIncomeDetails.empNumber = '$t_strEmpNumber' ";
			$arrEmpIncomeDetails = mysql_query($objUpdateEmpIncomeDetails);

			
			 if(!$arrEmpIncomeDetails) 
			 { 
				echo "<b>Employee number not yet updated on tblIncomeDetails:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($arrEmpIncomeDetails) 
			 { 
				return 1; 
			 }
			 
		}	//  end if update
	}	//  end function tblIncomeDetails


	function tblNonTaxable($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber)	//  edit empNumber on tblNonTaxable
	{
		if ($Submit == 'Update')
		{
			
			//  tblNonTaxable
			$objUpdateEmpNonTaxable = "UPDATE tblNonTaxable SET tblNonTaxable.empNumber='$t_strOldEmpNumber'
										WHERE tblNonTaxable.empNumber = '$t_strEmpNumber' ";
			$arrEmpNonTaxable = mysql_query($objUpdateEmpNonTaxable);

			
			 if(!$arrEmpNonTaxable) 
			 { 
				echo "<b>Employee number not yet updated on tblNonTaxable:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($arrEmpNonTaxable) 
			 { 
				return 1; 
			 }
			 
		}	//  end if update
	}	//  end function tblNonTaxable


	function tblSection($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber)	//  edit empNumber on tblSection
	{
		if ($Submit == 'Update')
		{
			
			//  tblSection
			$objUpdateEmpSection = "UPDATE tblSection SET tblSection.empNumber='$t_strOldEmpNumber'
										WHERE tblSection.empNumber = '$t_strEmpNumber' ";
			$arrEmpSection = mysql_query($objUpdateEmpSection);
								
			
			 if(!$arrEmpSection) 
			 { 
				echo "<b>Employee number not yet updated on tblSection:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($arrEmpSection) 
			 { 
				return 1; 
			 }
			 
		}	//  end if update
	}	//  end function tblSection


	function tblServiceRecord($strEmpNmbr, $t_strEmpNumber, $Submit, $t_strOldEmpNumber)	//  edit empNumber on tblServiceRecord
	{
		if ($Submit == 'Update')
		{
			
			//  tblServiceRecord
			$objUpdateEmpServiceRecord = "UPDATE tblServiceRecord SET tblServiceRecord.empNumber='$t_strOldEmpNumber' 
											WHERE tblServiceRecord.empNumber = '$t_strEmpNumber' ";
			$arrEmpServiceRecord = mysql_query($objUpdateEmpServiceRecord);

			 if(!$arrEmpServiceRecord) 
			 { 
				echo "<b>Employee number not yet updated on tblServiceRecord:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($arrEmpServiceRecord) 
			 { 
				return 1; 
			 }
			 
		}	//  end if update
	}	//  end function tblServiceRecord
	
}	//  end class
?>