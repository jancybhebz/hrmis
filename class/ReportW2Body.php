<?
require_once("../hrmis/class/General.php");
require_once("../hrmis/class/Constant.php");
require_once("../hrmis/class/ReportW2TaxWithheld.php");
require_once("../hrmis/class/AttendanceCompensation.php");


class ReportW2Body extends General
{
	var $objRprt;
	var $objRprt1;
	var $intCounter = 0;
	var $taxExemptAll;
	var $taxExempt;
	var $lifeRetshare;
	var $pagIbigshare;
	var $lifeRet;
	var $pagIbig;
	var $philHealth;
	var $itw;
	var $strDeduct;
	var $magnaCarta;
	var $sumDeduction;
	var $annualSal;
	var $WholeNonTax;
	var $healthP;
	var $benefits;
	var $totalBenefits;
	var $totalNontax;
	var $intAbsTotal;
	var $taxIncome;
	var $taxDue;
	var $infoTax;
	var $strChild;
	var $totalAnnualSal;
	var $grossTaxIncome;
	var $taxWheld;
	var $totaltaxWheld;
	

	// Body
	function printBody($t_strEmpNum, $t_strEmpAgency, $t_strEmpAddress, $t_strName, $t_strName1,$t_strTin, $t_strAddress, $t_strAddress1, $t_strBday, $t_strComTaxNumber, $t_strIssuedAt, $t_strAgencyTin)
	{

		$InterLigne = 5;
		$OuterLigne = 3;
		$Ligne = 70;
		$LigneIn = 52.2;
		
		
		
		$this->objRprt->SetFont(Arial,B,7);
		$this->objRprt->Cell(210,$InterLigne,'»   DLN:',0,0,L);
		$this->objRprt->Ln(4);	
		$this->objRprt->Cell($Ligne,$InterLigne,'',LT,0,L);
		$this->objRprt->Cell($Ligne,$InterLigne,'',T,0,C);
		$this->objRprt->Cell(56,$InterLigne,'BIR Form No.',T,0,R);
		$this->objRprt->Cell(14,$InterLigne,'',TR,0,R);
		$this->objRprt->Ln(4);	
		$this->objRprt->Cell(15,$InterLigne,' ',L,0,L);
		$this->objRprt->Cell(55,$InterLigne,'Republika ng Pilipinas',0,0,L);
		$this->objRprt->SetFont(Arial,B,15);
		$this->objRprt->Cell($Ligne,$InterLigne,'Certificate of Compensation',0,0,C);
		$this->objRprt->Cell($Ligne,$InterLigne,'',R,0,C);
		$this->objRprt->Ln(4);	
		$this->objRprt->SetFont(Arial,B,7);
		$this->objRprt->Cell(15,$InterLigne,' ',L,0,L);
		$this->objRprt->Cell(55,$InterLigne,'Kagawaran ng Pananalapi',0,0,L);
		$this->objRprt->SetFont(Arial,B,15);
		$this->objRprt->Cell($Ligne,$InterLigne,'Payment/Tax Withheld',0,0,C);
		$this->objRprt->SetFont(Arial,B,30);
		$this->objRprt->Cell(63,$InterLigne,'2316',0,0,R);
		$this->objRprt->Cell(7,$InterLigne,'',R,0,R);
		$this->objRprt->Ln(4);	
		$this->objRprt->SetFont(Arial,B,7);
		$this->objRprt->Cell(15,$InterLigne,' ',L,0,L);
		$this->objRprt->Cell(55,$InterLigne,'Kawanihan ng Rentas Internas',0,0,L);
		$this->objRprt->Cell($Ligne,$InterLigne,'',0,0,R);
		$this->objRprt->Cell($Ligne,$InterLigne,'',R,0,R);

		$this->objRprt->SetFont(Arial,B,7);
		$this->objRprt->Ln(4);	
		$this->objRprt->Cell(5,$InterLigne,' ',LB,0,L);
		$this->objRprt->Cell(65,$InterLigne,'For Compensation Payment With or Without Tax Withheld',B,0,L);
		$this->objRprt->Cell($Ligne,$InterLigne,'',B,0,C);
		$this->objRprt->Cell(65,$InterLigne,'October 2002 (ENCS)',B,0,R);
		$this->objRprt->Cell(5,$InterLigne,'',BR,0,R);
		$this->objRprt->Ln(6);	

		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(106,$OuterLigne,'',LTR,0);
		$this->objRprt->Cell(104,$OuterLigne,'',LTR,0);
		$this->objRprt->Ln(.50);	
		
		$this->objRprt->Cell(33,$OuterLigne,'1    For the Year                 1',L,0,L);
		$this->objRprt->Cell(19,$OuterLigne,'',LTR,0,R);
		$this->objRprt->Cell(27,$OuterLigne,'',0,0);
		$this->objRprt->Cell(27,$OuterLigne,'',0,0);
		$this->objRprt->Cell(33,$OuterLigne,'2  For the Period',L,0,L);
		$this->objRprt->Cell(7,$OuterLigne,'',LTR,0,R);
		$this->objRprt->Cell(7,$OuterLigne,'',T,0);
		$this->objRprt->Cell(7,$OuterLigne,'',L,0);
		$this->objRprt->Cell(25,$OuterLigne,'',R,0,L);
		$this->objRprt->Cell(7,$OuterLigne,'',LTR,0,R);
		$this->objRprt->Cell(7,$OuterLigne,'',T,0);
		$this->objRprt->Cell(7,$OuterLigne,'',L,0);
		$this->objRprt->Cell(25,$OuterLigne,'',R,0,L);
		$this->objRprt->Cell(8,$OuterLigne,'',R,0,L);
		$this->objRprt->Ln(2.5);
		
		$this->objRprt->Cell(33,$OuterLigne,'      ( Y Y Y Y )                    »',L,0,L);
		$this->objRprt->Cell(19,$OuterLigne, $_SESSION['sesCshrYear'] ,LBR,0,C);
		$this->objRprt->Cell(27,$OuterLigne,'',0,0);
		$this->objRprt->Cell(27,$OuterLigne,'',0,0);
		$this->objRprt->Cell(33,$OuterLigne,'   »  From  (MM/DD)',L,0,L);
		$this->objRprt->Cell(7,$OuterLigne,' !  ',LBR,0,C);
		$this->objRprt->Cell(7,$OuterLigne,' !  ',LBR,0,C);
		$this->objRprt->Cell(7,$OuterLigne,'',0,0);
		$this->objRprt->Cell(25,$OuterLigne,'      To    (MM/DD)',0,0,L);
		$this->objRprt->Cell(7,$OuterLigne,' !  ',LBR,0,C);
		$this->objRprt->Cell(7,$OuterLigne,' !  ',LBR,0,C);
		$this->objRprt->Cell(11,$OuterLigne,'',R,0);
		$this->objRprt->Ln(.50);

		$this->objRprt->Cell(33,$OuterLigne,'',LB,0,L);
		$this->objRprt->Cell(19,$OuterLigne,'',B,0,R);
		$this->objRprt->Cell(27,$OuterLigne,'',B,0);
		$this->objRprt->Cell(27,$OuterLigne,'',B,0);
		$this->objRprt->Cell(33,$OuterLigne,'',LB,0,L);
		$this->objRprt->Cell(7,$OuterLigne,'',B,0,R);
		$this->objRprt->Cell(7,$OuterLigne,'',B,0);
		$this->objRprt->Cell(7,$OuterLigne,'',B,0);
		$this->objRprt->Cell(25,$OuterLigne,'',B,0,L);
		$this->objRprt->Cell(7,$OuterLigne,'',B,0,R);
		$this->objRprt->Cell(7,$OuterLigne,'',B,0);
		$this->objRprt->Cell(7,$OuterLigne,'',B,0);
		$this->objRprt->Cell(4,$OuterLigne,'',BR,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->SetFont(Arial,B,7);
		$this->objRprt->Cell(25,$OuterLigne,'Part I',LT,0,L);
		$this->objRprt->Cell(81,$OuterLigne,'Employee Information',TR,0,L);
		$this->objRprt->Cell(20,$OuterLigne,'Part IV',LT,0,L);
		$this->objRprt->SetFont(Arial,B,6);
		$this->objRprt->Cell(84,$OuterLigne,'Details of Compensation Income and Tax Withheld from Present Employer',TR,0,L);
		$this->objRprt->Ln(3);
		
		$this->objRprt->Cell(106,$OuterLigne,'',LTR,0);
		$this->objRprt->Cell(104,$OuterLigne,'',LTR,0);
		$this->objRprt->Ln(1);	

		$this->objRprt->Cell(33,$OuterLigne,'3    Taxpayer                            3',L,0,L);
		$this->objRprt->Cell(14,$OuterLigne,'',LTR,0,R);
		$this->objRprt->Cell(5,$OuterLigne,'',0,0);
		$this->objRprt->Cell(14,$OuterLigne,'',LTR,0);
		$this->objRprt->Cell(5,$OuterLigne,'',0,0);
		$this->objRprt->Cell(14,$OuterLigne,'',LTR,0);
		$this->objRprt->Cell(5,$OuterLigne,'',0,0);
		$this->objRprt->Cell(14,$OuterLigne,'',LTR,0);
		$this->objRprt->Cell(2,$OuterLigne,'',R,0);
		$this->objRprt->Cell(33,$OuterLigne,'',0,0,L);				//  AMOUNT
		$this->objRprt->Cell(7,$OuterLigne,'',0,0,R);
		$this->objRprt->Cell(7,$OuterLigne,'',0,0);
		$this->objRprt->Cell(15,$OuterLigne,'',0,0);
		$this->objRprt->SetFont(Arial,B,8);
		$this->objRprt->Cell(25,$OuterLigne,'   Amount',0,0,L);
		$this->objRprt->Cell(2,$OuterLigne,'',0,0,R);
		$this->objRprt->Cell(7,$OuterLigne,'',0,0);
		$this->objRprt->Cell(8,$OuterLigne,'',R,0);
		$this->objRprt->Ln(3);

		$this->objRprt->SetFont(Arial,B,7);
		$this->objRprt->Cell(33,$OuterLigne,'      Identification No.        »',L,0,L);
		$this->objRprt->Cell(14,$OuterLigne, substr($t_strTin, 0, 1). ' ! '  .substr($t_strTin, 1, 1).  ' ! ' .substr($t_strTin, 2, 1),LBR,0,C);
		$this->objRprt->Cell(5,$OuterLigne,'',0,0,C);
		$this->objRprt->Cell(14,$OuterLigne, substr($t_strTin, 4, 1).' ! '  .substr($t_strTin, 5, 1).  ' ! ' .substr($t_strTin, 6, 1),LBR,0,C);
		$this->objRprt->Cell(5,$OuterLigne,'',0,0,C);
		$this->objRprt->Cell(14,$OuterLigne, substr($t_strTin, 8, 1).' ! '  .substr($t_strTin, 9, 1).  ' ! ' .substr($t_strTin, 10, 1),LBR,0,C);
		$this->objRprt->Cell(5,$OuterLigne,'',0,0,C);
		$this->objRprt->Cell(14,$OuterLigne, substr($t_strTin, 12, 1).' ! '  .substr($t_strTin, 13, 1).  ' ! ' .substr($t_strTin, 14, 1),LBR,0,C);
		$this->objRprt->Cell(2,$OuterLigne,'',R,0,C);
		
		//  second column
		$this->objRprt->SetFont(Arial,B,8);
		$this->objRprt->Cell(104,$OuterLigne,'A.  None-Taxable/Exempt Compensation Income',R,0,L);
		$this->objRprt->Ln(1);

		$this->objRprt->SetFont(Arial,B,7);
		$this->objRprt->Cell(106,$OuterLigne,'',LBR,0);
		$this->objRprt->Cell(104,$OuterLigne,'',LR,0);
		$this->objRprt->Ln(3);	

		//  4 Employee's Name(Last Name, First Name, Middle Name)
		$this->objRprt->Cell(106,$OuterLigne,'',LTR,0);
		$this->objRprt->Cell(104,$OuterLigne,'',LR,0);
		$this->objRprt->Ln(.50);	

		$this->objRprt->Cell(90,$OuterLigne,'4    Employee' . 's' . " " . 'Name (Last Name, First Name, Middle Name)',L,0,L);
		$this->objRprt->Cell(16,$OuterLigne,'5  RDO Code',R,0,C);
		
		//  second column
		$this->objRprt->Cell(40,$OuterLigne,'25   13th Month Pay and',0,0,L);
		$this->objRprt->Cell(5,$OuterLigne,'25 ',R,0,L);
		$this->objRprt->Cell(57,$OuterLigne,$this->totalBenefits,LTR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->SetFont(Arial,'',9);
		$this->objRprt->Cell(5,$OuterLigne,'» ',L,0,L);
		$this->objRprt->Cell(75,$OuterLigne,$t_strName,1,0,L);
		$this->objRprt->Cell(10,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(14,$OuterLigne,' !     ! ',LTBR,0,C);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);

		//  second column
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(40,$OuterLigne,'       Other Benefits',0,0,L);
		$this->objRprt->Cell(5,$OuterLigne,' ',R,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',LBR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(.595);

		$this->objRprt->Cell(106,$OuterLigne,' ',LBR,0,L);
		$this->objRprt->Cell(104,$OuterLigne,' ',LR,0,L);
		$this->objRprt->Ln(3);

		//  6 Registered Address
		$this->objRprt->Cell(106,$OuterLigne,' ',LR,0,L);
		$this->objRprt->Cell(104,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(1);

		$this->objRprt->Cell(90,$OuterLigne,'6    Registered Address',L,0,L);
		$this->objRprt->Cell(16,$OuterLigne,'6A Zip Code',R,0,C);

		//  second column
		$this->objRprt->Cell(40,$OuterLigne,'26   SSS, GSIS, PHIC, & Pag-ibig',0,0,L);
		$this->objRprt->Cell(5,$OuterLigne,'26 ',R,0,L);
		$this->objRprt->Cell(57,$OuterLigne,$this->WholeNonTax,TR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);

		//  6 Registered Address (2nd line)
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(5,$OuterLigne,'» ',L,0,L);
		$this->objRprt->Cell(75,$OuterLigne,$t_strAddress,1,0,L);
		$this->objRprt->Cell(10,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(14,$OuterLigne,' !     ! ',LTBR,0,C);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);

		//  second column (2nd line)
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(40,$OuterLigne,'       Contribution & Union dues',0,0,L);
		$this->objRprt->Cell(5,$OuterLigne,' ',R,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',LBR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(.57);

		$this->objRprt->Cell(106,$OuterLigne,' ',LR,0,L);
		$this->objRprt->Cell(104,$OuterLigne,' ',LR,0,L);
		$this->objRprt->Ln(3);
		
		//  6B  Local Home Address
		$this->objRprt->Cell(90,$OuterLigne,'6B  Local Home Address',L,0,L);
		$this->objRprt->Cell(16,$OuterLigne,'6C Zip Code',R,0,C);
		
		//  second column
		$this->objRprt->Cell(40,$OuterLigne,'27   Salaries & Other Forms of',0,0,L);
		$this->objRprt->Cell(5,$OuterLigne,'27 ',R,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',TR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(5,$OuterLigne,'» ',L,0,L);
		$this->objRprt->Cell(75,$OuterLigne,$t_strAddress1,1,0,L);
		$this->objRprt->Cell(10,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(14,$OuterLigne,' !     ! ',LTBR,0,C);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);

		//  second column
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(40,$OuterLigne,'         Compensation',0,0,L);
		$this->objRprt->Cell(5,$OuterLigne,' ',R,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',LBR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(.57);

		$this->objRprt->Cell(106,$OuterLigne,' ',LR,0,L);
		$this->objRprt->Cell(104,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);

		//  6D Foreign Address
		
		$this->objRprt->Cell(90,$OuterLigne,'6D  Foreign Address',L,0,L);
		$this->objRprt->Cell(16,$OuterLigne,'6E Zip Code',R,0,C);
		
		//  second column
		$this->objRprt->Cell(40,$OuterLigne,'28   Total Non-Taxable/Exempt',0,0,L);
		$this->objRprt->Cell(5,$OuterLigne,'28 ',R,0,L);
		$this->objRprt->Cell(57,$OuterLigne,$this->totalNontax,TR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);

		//  6D Foreign Address (2nd line)
		$this->objRprt->SetFont(Arial,'',9);
		$this->objRprt->Cell(5,$OuterLigne,'» ',L,0,L);
		$this->objRprt->Cell(75,$OuterLigne,' ',1,0,L);
		$this->objRprt->Cell(10,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(14,$OuterLigne,' !     ! ',LTBR,0,C);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);

		//  second column  (2nd line)
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(40,$OuterLigne,'         Compensation Income',0,0,L);
		$this->objRprt->Cell(5,$OuterLigne,' ',R,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',LBR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(.57);

		$this->objRprt->Cell(106,$OuterLigne,' ',LBR,0,L);
		$this->objRprt->Cell(104,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);

		//  7 Date of Birth	
		$this->objRprt->Cell(106,$OuterLigne,' ',LR,0,L);
		$this->objRprt->Cell(104,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(1);

		$this->objRprt->Cell(80,$OuterLigne,'7   Date of Birth (MM/DD/YYYY)',L,0,L);
		$this->objRprt->Cell(26,$OuterLigne,'8  Telephone Number',R,0,C);
		
		//  second column
		$this->objRprt->SetFont(Arial,B,8);
		$this->objRprt->Cell(104,$OuterLigne,'B.  Taxable Compensation Income',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->SetFont(Arial,'',9);
		$this->objRprt->Cell(5,$OuterLigne,'  ',L,0,L);
		$this->objRprt->Cell(7,$OuterLigne, substr($t_strBday, 5, 1). ' ! ' .substr($t_strBday, 6, 1) ,LTBR,0,C);
		$this->objRprt->Cell(7,$OuterLigne, substr($t_strBday, 8, 1). ' ! ' .substr($t_strBday, 9, 1) ,LTBR,0,C);
		$this->objRprt->Cell(19,$OuterLigne, substr($t_strBday, 0, 1).' ! '  .substr($t_strBday, 1, 1).  ' ! ' .substr($t_strBday, 2, 1). ' ! ' .substr($t_strBday, 3, 1),LTBR,0,C);
		$this->objRprt->Cell(31,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(35,$OuterLigne,' ',1,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);

		//  second column
		$this->objRprt->SetFont(Arial,B,8);
		$this->objRprt->Cell(104,$OuterLigne,'         REGULAR',R,0,L);
		$this->objRprt->Ln(1);

		$this->objRprt->Cell(106,$OuterLigne,' ',LBR,0,L);
		$this->objRprt->Cell(104,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);
		
		//  9 Exemption Status
		$this->objRprt->Cell(106,$OuterLigne,' ',LR,0,L);
		$this->objRprt->Cell(104,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(1);

		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(106,$OuterLigne,'9   Exemption Status',LR,0,L);
		
		//  second column
		$this->objRprt->Cell(40,$OuterLigne,'29   Basic Salary',0,0,L);
		$this->objRprt->Cell(5,$OuterLigne,'29 ',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne,$this->totalAnnualSal,LTR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);
		

		$objEmpTaxStatus = mysql_query("SELECT taxStatCode FROM tblEmpPosition 
								WHERE empNumber = '$t_strEmpNum'");
		$intEmpTaxStatusCounter = 0 ;
		while($arrEmpTaxStatus = mysql_fetch_array($objEmpTaxStatus))
		{
			$intEmpTaxStatusCounter++;
			$strEmpTaxStatus = $arrEmpTaxStatus['taxStatCode'];
			$strEmpTStatus = "x";	
			if ($intEmpTaxStatusCounter != 0) 
			{
				if($strEmpTaxStatus == 'Single' or $strEmpTaxStatus == 'SINGLE') 
				{
			
					$this->objRprt->Cell(5,$OuterLigne,'',L,0,L);
					$this->objRprt->Cell(7,$OuterLigne,$strEmpTStatus,1,0,C);
					$this->objRprt->Cell(10,$OuterLigne,'Single',0,0,L);
					$this->objRprt->Cell(10,$OuterLigne,'',0,0,L);
					$this->objRprt->Cell(7,$OuterLigne,'',1,0,L);
					$this->objRprt->Cell(20,$OuterLigne,'Head of the Family',0,0,L);
					$this->objRprt->Cell(10,$OuterLigne,'',0,0,L);
					$this->objRprt->Cell(7,$OuterLigne,'',1,0,L);
					$this->objRprt->Cell(15,$OuterLigne,'Married',0,0,L);
					$this->objRprt->Cell(15,$OuterLigne,'',R,0,L);
					
					$this->objRprt->Cell(45,$OuterLigne,' ',0,0,L);
					$this->objRprt->Cell(57,$OuterLigne,' ',LBR,0,L);
					$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
					$this->objRprt->Ln(3);

				} elseif ($strEmpTaxStatus == 'Head' or $strEmpTaxStatus == 'HEAD') {
				
					$this->objRprt->Cell(5,$OuterLigne,'',L,0,L);
					$this->objRprt->Cell(7,$OuterLigne,'',1,0,L);
					$this->objRprt->Cell(10,$OuterLigne,'Single',0,0,L);
					$this->objRprt->Cell(10,$OuterLigne,'',0,0,L);
					$this->objRprt->Cell(7,$OuterLigne,$strEmpTStatus,1,0,C);
					$this->objRprt->Cell(20,$OuterLigne,'Head of the Family',0,0,L);
					$this->objRprt->Cell(10,$OuterLigne,'',0,0,L);
					$this->objRprt->Cell(7,$OuterLigne,'',1,0,L);
					$this->objRprt->Cell(15,$OuterLigne,'Married',0,0,L);
					$this->objRprt->Cell(15,$OuterLigne,'',R,0,L);
					
					$this->objRprt->Cell(45,$OuterLigne,' ',0,0,L);
					$this->objRprt->Cell(57,$OuterLigne,' ',LBR,0,L);
					$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
					$this->objRprt->Ln(3);

				
				} elseif  ($strEmpTaxStatus == 'Married' or $strEmpTaxStatus == 'MARRIED'){
				
					$this->objRprt->Cell(5,$OuterLigne,'',L,0,L);
					$this->objRprt->Cell(7,$OuterLigne,'',1,0,L);
					$this->objRprt->Cell(10,$OuterLigne,'Single',0,0,L);
					$this->objRprt->Cell(10,$OuterLigne,'',0,0,L);
					$this->objRprt->Cell(7,$OuterLigne,'',1,0,L);
					$this->objRprt->Cell(20,$OuterLigne,'Head of the Family',0,0,L);
					$this->objRprt->Cell(10,$OuterLigne,'',0,0,L);
					$this->objRprt->Cell(7,$OuterLigne,$strEmpTStatus,1,0,C);
					$this->objRprt->Cell(15,$OuterLigne,'Married',0,0,L);
					$this->objRprt->Cell(15,$OuterLigne,'',R,0,L);
					
					$this->objRprt->Cell(45,$OuterLigne,' ',0,0,L);
					$this->objRprt->Cell(57,$OuterLigne,' ',LBR,0,L);
					$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
					$this->objRprt->Ln(3);
				
				}	//  end if $strEmpTaxStatus
				
				else {
					
					$this->objRprt->Cell(5,$OuterLigne,'',L,0,L);
					$this->objRprt->Cell(7,$OuterLigne,'',1,0,L);
					$this->objRprt->Cell(10,$OuterLigne,'Single',0,0,L);
					$this->objRprt->Cell(10,$OuterLigne,'',0,0,L);
					$this->objRprt->Cell(7,$OuterLigne,'',1,0,L);
					$this->objRprt->Cell(20,$OuterLigne,'Head of the Family',0,0,L);
					$this->objRprt->Cell(10,$OuterLigne,'',0,0,L);
					$this->objRprt->Cell(7,$OuterLigne,'',1,0,L);
					$this->objRprt->Cell(15,$OuterLigne,'Married',0,0,L);
					$this->objRprt->Cell(15,$OuterLigne,'',R,0,L);
					
					$this->objRprt->Cell(45,$OuterLigne,' ',0,0,L);
					$this->objRprt->Cell(57,$OuterLigne,' ',LBR,0,L);
					$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
					$this->objRprt->Ln(3);
				}
			
			}	//  end if $intEmpTaxStatusCounter
		
		}	//  end while

		//  9 Exemption Status (2nd line)

		//  9A Is the wife claiming the additional exemption for qualified dependent children?
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(106,$OuterLigne,'9A  Is the wife claiming the additional exemption for qualified dependent children?',LR,0,L);
		
		//  second column
		$this->objRprt->Cell(40,$OuterLigne,'30   Representation',0,0,L);
		$this->objRprt->Cell(5,$OuterLigne,'30 ',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',LTR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(25,$OuterLigne,'',L,0,L);
		$this->objRprt->Cell(7,$OuterLigne,'',1,0,L);
		$this->objRprt->Cell(15,$OuterLigne,'Yes',0,0,L);
		$this->objRprt->Cell(7,$OuterLigne,'',1,0,L);
		$this->objRprt->Cell(30,$OuterLigne,'No',0,0,L);
		$this->objRprt->Cell(22,$OuterLigne,'',R,0,L);

		$this->objRprt->Cell(45,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',LBR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(1);
		
		$this->objRprt->Cell(106,$OuterLigne,'',LBR,0,L);
		$this->objRprt->Cell(104,$OuterLigne,'',R,0,L);
		$this->objRprt->Ln(3);

		//  10 Name of Qualified Dependent Children
		$this->objRprt->Cell(106,$OuterLigne,' ',LR,0,L);
		$this->objRprt->Cell(104,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(1);
		
		$this->objRprt->Cell(60,$OuterLigne,'10  Name of Qualified Dependent Children',L,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(44,$OuterLigne,'11  Date of Birth (MM/DD/YYYY)',R,0,L);
		//  second column
		$this->objRprt->Cell(40,$OuterLigne,'31   Transportation',0,0,L);
		$this->objRprt->Cell(5,$OuterLigne,'31 ',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',LTR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);
		
		
		//  ********* new line (1st line)
		$objEmpChild = mysql_query("SELECT * FROM tblEmpChild 
									WHERE empNumber = '$t_strEmpNum'
										ORDER BY tblEmpChild.childBirthDate DESC limit 0,12");
		
		$intChildCounter = 0;
		while($arrEmpChild = mysql_fetch_array($objEmpChild)) 
		{
			$intChildCounter++;
			$strEmpNumberInChild = $arrEmpChild['empNumber'];
			$strEmpChildName = $arrEmpChild['childName'];
			$dtmEmpChildBirthDate = $arrEmpChild['childBirthDate'];
			$currentdate = date ("Y m", mktime(0,0,0,date("m") ,date("d") ,date("Y")));
			$age = $currentdate - $dtmEmpChildBirthDate;

			if ($intChildCounter != 0 && $intChildCounter < 5 && $age < 22) 
			{

				$this->objRprt->SetFont(Arial,B,8);
				$this->objRprt->Cell(5,$OuterLigne,'',L,0,L);
				$this->objRprt->Cell(35,$OuterLigne,$strEmpChildName,1,0,L);
				
				$this->objRprt->Cell(25,$OuterLigne,'  ',L,0,L);
				$this->objRprt->Cell(7,$OuterLigne,substr($dtmEmpChildBirthDate, 5, 1). ' ! ' .substr($dtmEmpChildBirthDate, 6, 1),LTBR,0,C);
				$this->objRprt->Cell(7,$OuterLigne,substr($dtmEmpChildBirthDate, 8, 1). ' ! ' .substr($dtmEmpChildBirthDate, 9, 1),LTBR,0,C);
				$this->objRprt->Cell(19,$OuterLigne,substr($dtmEmpChildBirthDate, 0, 1).' ! '  .substr($dtmEmpChildBirthDate, 1, 1).  ' ! ' .substr($dtmEmpChildBirthDate, 2, 1). ' ! ' .substr($dtmEmpChildBirthDate, 3, 1),LTBR,0,C);
				$this->objRprt->Cell(8,$OuterLigne,' ',R,0,L);			
				
				$this->objRprt->Cell(45,$OuterLigne,' ',0,0,L);
				$this->objRprt->Cell(57,$OuterLigne,' ',LBR,0,L);
				$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
				$this->objRprt->Ln(3);
				
																			
			}	//  end if
			//  second column
			
		
		
		else if ($intChildCounter == 0 || $strEmpChildName = '' || $strEmpChildName = NULL) 
		{
		//  new line (1st line)
		$this->objRprt->SetFont(Arial,B,8);
		$this->objRprt->Cell(5,$OuterLigne,'',L,0,L);
		$this->objRprt->Cell(35,$OuterLigne,'',1,0,L);

		$this->objRprt->Cell(25,$OuterLigne,'  ',L,0,L);
		$this->objRprt->Cell(7,$OuterLigne,' !  ',LTBR,0,C);
		$this->objRprt->Cell(7,$OuterLigne,' !  ',LTBR,0,C);
		$this->objRprt->Cell(19,$OuterLigne,' !     !     !',LTBR,0,C);
		$this->objRprt->Cell(8,$OuterLigne,' ',R,0,L);
		
		$this->objRprt->Cell(45,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',LBR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);
		
		//  new line (2nd line)
		$this->objRprt->Cell(5,$OuterLigne,'',L,0,L);
		$this->objRprt->Cell(35,$OuterLigne,'',1,0,L);

		$this->objRprt->Cell(25,$OuterLigne,'  ',L,0,L);
		$this->objRprt->Cell(7,$OuterLigne,' !  ',LTBR,0,C);
		$this->objRprt->Cell(7,$OuterLigne,' !  ',LTBR,0,C);
		$this->objRprt->Cell(19,$OuterLigne,' !     !     !',LTBR,0,C);
		$this->objRprt->Cell(8,$OuterLigne,' ',R,0,L);

		//  second column
		$this->objRprt->SetFont(Arial,B,7);
		$this->objRprt->Cell(40,$OuterLigne,'32   Cost of Living Allowance',0,0,L);
		$this->objRprt->Cell(5,$OuterLigne,'32 ',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',LTR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);
		
		
		//  new line (Dependent)  (3rd line)
		$this->objRprt->SetFont(Arial,B,8);
		$this->objRprt->Cell(5,$OuterLigne,'',L,0,L);
		$this->objRprt->Cell(35,$OuterLigne,'',1,0,L);

		$this->objRprt->Cell(25,$OuterLigne,'  ',L,0,L);
		$this->objRprt->Cell(7,$OuterLigne,' !  ',LTBR,0,C);
		$this->objRprt->Cell(7,$OuterLigne,' !  ',LTBR,0,C);
		$this->objRprt->Cell(19,$OuterLigne,' !     !     !',LTBR,0,C);
		$this->objRprt->Cell(8,$OuterLigne,' ',R,0,L);

		//  second column (2nd line)
		$this->objRprt->Cell(45,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',LBR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);

		//  new line (Dependent)  (4th line)
		$this->objRprt->SetFont(Arial,B,8);
		$this->objRprt->Cell(5,$OuterLigne,'',L,0,L);
		$this->objRprt->Cell(35,$OuterLigne,'',1,0,L);

		$this->objRprt->Cell(25,$OuterLigne,'  ',L,0,L);
		$this->objRprt->Cell(7,$OuterLigne,' !  ',LTBR,0,C);
		$this->objRprt->Cell(7,$OuterLigne,' !  ',LTBR,0,C);
		$this->objRprt->Cell(19,$OuterLigne,' !     !     !',LTBR,0,C);
		$this->objRprt->Cell(8,$OuterLigne,' ',R,0,L);

		}}	//  end while
		/*$this->objRprt->SetFont(Arial,B,7);
		$this->objRprt->Cell(40,$OuterLigne,'32   Cost of Living Allowance',0,0,L);
		$this->objRprt->Cell(5,$OuterLigne,'32 ',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',LTR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3); */
		

		/*//  second column (2nd line)
		$this->objRprt->Cell(45,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',LBR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3); */

		$this->objRprt->Cell(104,$OuterLigne,'',R,0,L);
		$this->objRprt->Ln(1);

		$this->objRprt->SetFont(Arial,B,7);
		$this->objRprt->Cell(106,$OuterLigne,'',LBR,0,L);
		
		//  second column
		$this->objRprt->Cell(40,$OuterLigne,'33   Fixed Housing Allowance',0,0,L);
		$this->objRprt->Cell(5,$OuterLigne,'33 ',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',LTR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(106,$OuterLigne,'',LR,0,L);
		
		//  second column
		$this->objRprt->Cell(45,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',LBR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(1);

		$this->objRprt->SetFont(Arial,B,7);
		$this->objRprt->Cell(106,$OuterLigne,'12  Other Dependent (to be accomplished if taxpayer is head of the family)',LR,0,L);

		//  second column
		$this->objRprt->SetFont(Arial,'',8);
		$this->objRprt->Cell(40,$OuterLigne,'34   Others (Specify)',0,0,L);
		$this->objRprt->Cell(64,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(10,$OuterLigne,' ',L,0,L);
		$this->objRprt->Cell(35,$OuterLigne,'Name of Dependent',0,0,L);
		$this->objRprt->Cell(6,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(22,$OuterLigne,'Relationship',0,0,L);
		$this->objRprt->Cell(33,$OuterLigne,'Date Of Birth',R,0,C);

		//  second column
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(6,$OuterLigne,'34A  ',0,0,L);
		$this->objRprt->Cell(33,$OuterLigne,' ',LTR,0,L);
		$this->objRprt->Cell(6,$OuterLigne,'34A ',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',LTR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(10,$OuterLigne,' ',L,0,L);
		$this->objRprt->Cell(35,$OuterLigne,'',0,0,L);
		$this->objRprt->Cell(6,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(22,$OuterLigne,'',0,0,L);
		$this->objRprt->Cell(33,$OuterLigne,'(MM/DD/YYYY)',R,0,C);

		//  second column
		$this->objRprt->Cell(6,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(33,$OuterLigne,' ',LBR,0,L);
		$this->objRprt->Cell(6,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',LBR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);

		//  First Column (new line)
		$this->objRprt->Cell(5,$OuterLigne,'',L,0,L);
		$this->objRprt->Cell(35,$OuterLigne,$this->infoTax['otherDependent'],1,0,L);			//  Name of Dependent

		$this->objRprt->Cell(5,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(25,$OuterLigne,$this->infoTax['dRelationship'],1,0,L);			//  Relationship

 		$this->objRprt->Cell(9,$OuterLigne,'  ',L,0,L);
		$this->objRprt->Cell(6,$OuterLigne,substr($this->infoTax['dBirthDate'], 5, 1). ' ! ' .substr($this->infoTax['dBirthDate'], 6, 1),LTBR,0,C);
		$this->objRprt->Cell(6,$OuterLigne,substr($this->infoTax['dBirthDate'], 8, 1). ' ! ' .substr($this->infoTax['dBirthDate'], 9, 1),LTBR,0,C);
		$this->objRprt->Cell(12,$OuterLigne,substr($this->infoTax['dBirthDate'], 0, 1).' ! '  .substr($this->infoTax['dBirthDate'], 1, 1).  ' ! ' .substr($this->infoTax['dBirthDate'], 2, 1). ' ! ' .substr($this->infoTax['dBirthDate'], 3, 1),LTBR,0,C);
		$this->objRprt->Cell(3,$OuterLigne,' ',R,0,L);

		//  second column
		$this->objRprt->SetFont(Arial,B,7);
		$this->objRprt->Cell(6,$OuterLigne,'34B  ',0,0,L);
		$this->objRprt->Cell(33,$OuterLigne,' ',LTR,0,L);
		$this->objRprt->Cell(6,$OuterLigne,'34B ',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',LTR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(106,$OuterLigne,'',LR,0,L);

		//  second column
		$this->objRprt->Cell(6,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(33,$OuterLigne,' ',LBR,0,L);
		$this->objRprt->Cell(6,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',LBR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(106,$OuterLigne,' ',LR,0,L);
		$this->objRprt->Cell(104,$OuterLigne,' ',LR,0,L);
		$this->objRprt->Ln(1);

		//  Part II Employer Information (Present)
		$this->objRprt->SetFont(Arial,B,8);
		$this->objRprt->Cell(35,$OuterLigne,'Part II',LTB,0,L);
		$this->objRprt->Cell(6,$OuterLigne,' ',TB,0,L);
		$this->objRprt->Cell(65,$OuterLigne,'Employer Information (Present)',TBR,0,L);

		//  second column
		$this->objRprt->SetFont(Arial,B,8);
		$this->objRprt->Cell(104,$OuterLigne,'       SUPPLEMENTARY',LR,0);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(106,$OuterLigne,'',LR,0,L);
		$this->objRprt->Cell(104,$OuterLigne,'',LR,0);
		$this->objRprt->Ln(1);

		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(33,$OuterLigne,'13  Taxpayer                     13',L,0,L);
		$this->objRprt->Cell(14,$OuterLigne,'',LTR,0,R);
		$this->objRprt->Cell(5,$OuterLigne,'',0,0);
		$this->objRprt->Cell(14,$OuterLigne,'',LTR,0);
		$this->objRprt->Cell(5,$OuterLigne,'',0,0);
		$this->objRprt->Cell(14,$OuterLigne,'',LTR,0);
		$this->objRprt->Cell(5,$OuterLigne,'',0,0);
		$this->objRprt->Cell(14,$OuterLigne,'',LTR,0);
		$this->objRprt->Cell(2,$OuterLigne,'',R,0);

		//  second column
		$this->objRprt->Cell(40,$OuterLigne,'35   Commission',0,0,L);
		$this->objRprt->Cell(5,$OuterLigne,'35 ',R,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',TR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(33,$OuterLigne,'       Identification No.          »',L,0,L);
		$this->objRprt->Cell(14,$OuterLigne,substr($t_strAgencyTin, 0, 1). ' ! '  .substr($t_strAgencyTin, 1, 1).  ' ! ' .substr($t_strAgencyTin, 2, 1),LBR,0,C);
		$this->objRprt->Cell(5,$OuterLigne,'',0,0,C);
		$this->objRprt->Cell(14,$OuterLigne,substr($t_strAgencyTin, 4, 1). ' ! '  .substr($t_strAgencyTin, 5, 1).  ' ! ' .substr($t_strAgencyTin, 6, 1),LBR,0,C);
		$this->objRprt->Cell(5,$OuterLigne,'',0,0,C);
		$this->objRprt->Cell(14,$OuterLigne,substr($t_strAgencyTin, 8, 1). ' ! '  .substr($t_strAgencyTin, 9, 1).  ' ! ' .substr($t_strAgencyTin, 10, 1),LBR,0,C);
		$this->objRprt->Cell(5,$OuterLigne,'',0,0,C);
		$this->objRprt->Cell(14,$OuterLigne,substr($t_strAgencyTin, 12, 1). ' ! '  .substr($t_strAgencyTin, 13, 1).  ' ! ' .substr($t_strAgencyTin, 14, 1),LBR,0,C);
		$this->objRprt->Cell(2,$OuterLigne,'',R,0);

		//  second column
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(40,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(5,$OuterLigne,' ',R,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',LBR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(1);

		$this->objRprt->Cell(106,$OuterLigne,' ',LBR,0,L);
		$this->objRprt->Cell(104,$OuterLigne,' ',LR,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(106,$OuterLigne,'',LR,0,L);
		$this->objRprt->Cell(104,$OuterLigne,'',LR,0);
		$this->objRprt->Ln(1);

		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(106,$OuterLigne,'14  Employer ' . 's' . ' ' .'Name',LR,0,L);

		//  second column
		$this->objRprt->Cell(40,$OuterLigne,'36   Profit Sharing',0,0,L);
		$this->objRprt->Cell(5,$OuterLigne,'36 ',R,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',TR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(5,$OuterLigne,'» ',L,0,L);
		$this->objRprt->Cell(99,$OuterLigne,$t_strEmpAgency,1,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);

		//  second column
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(40,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(5,$OuterLigne,' ',R,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',LBR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(1);

		$this->objRprt->Cell(106,$OuterLigne,' ',LBR,0,L);
		$this->objRprt->Cell(104,$OuterLigne,' ',LR,0,L);
		$this->objRprt->Ln(3);

		//  15 Registered Address
		$this->objRprt->Cell(106,$OuterLigne,' ',LTR,0,L);
		$this->objRprt->Cell(104,$OuterLigne,' ',LR,0,L);
		$this->objRprt->Ln(1);


		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(90,$OuterLigne,'15  Registered Address',L,0,L);
		$this->objRprt->Cell(16,$OuterLigne,'15A Zip Code',R,0,C);


		//  second column
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(40,$OuterLigne,'37   Fees Including Director' . 's' . ' ' . 'Fees',0,0,L);
		$this->objRprt->Cell(5,$OuterLigne,'37 ',R,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',TR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(5,$OuterLigne,'» ',L,0,L);
		$this->objRprt->Cell(75,$OuterLigne, $t_strEmpAddress ,1,0,L);
		$this->objRprt->Cell(10,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(14,$OuterLigne,' !     ! ',LTBR,0,C);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);

		//  second column
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(40,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(5,$OuterLigne,' ',R,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',LBR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(1);

		$this->objRprt->Cell(106,$OuterLigne,' ',LBR,0,L);
		//  second column
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(6,$OuterLigne,'38  Taxable 13th Month Pay',0,0,L);
		$this->objRprt->Cell(34,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(5,$OuterLigne,'38 ',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',LR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(106,$OuterLigne,' ',LR,0,L);
		//  second column
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(40,$OuterLigne,'',0,0,L);
		$this->objRprt->Cell(5,$OuterLigne,' ',R,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',LR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(1);

		$this->objRprt->Cell(15,$OuterLigne,' ',L,0,L);
		$this->objRprt->Cell(5,$OuterLigne,' ',1,0,L);
		$this->objRprt->Cell(20,$OuterLigne,'main employer ',0,0,L);
		$this->objRprt->Cell(10,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(5,$OuterLigne,' ',1,0,L);
		$this->objRprt->Cell(40,$OuterLigne,'secondary employer ',0,0,L);
		$this->objRprt->Cell(11,$OuterLigne,' ',R,0,L);

		//  second column
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(40,$OuterLigne,'      and Other Benefits',0,0,L);
		$this->objRprt->Cell(5,$OuterLigne,' ',R,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',LR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(1);

		$this->objRprt->Cell(106,$OuterLigne,' ',LBR,0,L);
		
		//  second column
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(40,$OuterLigne,'',0,0,L);
		$this->objRprt->Cell(5,$OuterLigne,' ',R,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',LBR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->SetFont(Arial,B,8);
		$this->objRprt->Cell(35,$OuterLigne,'Part III',LTB,0,L);
		$this->objRprt->Cell(6,$OuterLigne,' ',TB,0,L);
		$this->objRprt->Cell(65,$OuterLigne,'Employer Information (Previous)-1',TBR,0,L);

		//  second column
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(6,$OuterLigne,'39  Hazard Pay',0,0,L);
		$this->objRprt->Cell(34,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(5,$OuterLigne,'39 ',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',LTR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(106,$OuterLigne,'',LR,0,L);

		//  second column
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(40,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(5,$OuterLigne,' ',R,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',LR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(1);

		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(33,$OuterLigne,'16  Taxpayer                     16',L,0,L);
		$this->objRprt->Cell(14,$OuterLigne,'',LTR,0,R);
		$this->objRprt->Cell(5,$OuterLigne,'',0,0);
		$this->objRprt->Cell(14,$OuterLigne,'',LTR,0);
		$this->objRprt->Cell(5,$OuterLigne,'',0,0);
		$this->objRprt->Cell(14,$OuterLigne,'',LTR,0);
		$this->objRprt->Cell(5,$OuterLigne,'',0,0);
		$this->objRprt->Cell(14,$OuterLigne,'',LTR,0);
		$this->objRprt->Cell(2,$OuterLigne,'',R,0);

		//  second column
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(40,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(5,$OuterLigne,' ',R,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',LBR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(33,$OuterLigne,'       Identification No.          »',L,0,L);
		$this->objRprt->Cell(14,$OuterLigne,substr($this->infoTax['pTin'], 0, 1). ' ! '  .substr($this->infoTax['pTin'], 1, 1).  ' ! ' .substr($this->infoTax['pTin'], 2, 1),LBR,0,C);
		$this->objRprt->Cell(5,$OuterLigne,'',0,0,C);
		$this->objRprt->Cell(14,$OuterLigne,substr($this->infoTax['pTin'], 4, 1). ' ! '  .substr($this->infoTax['pTin'], 5, 1).  ' ! ' .substr($this->infoTax['pTin'], 6, 1),LBR,0,C);
		$this->objRprt->Cell(5,$OuterLigne,'',0,0,C);
		$this->objRprt->Cell(14,$OuterLigne,substr($this->infoTax['pTin'], 8, 1). ' ! '  .substr($this->infoTax['pTin'], 9, 1).  ' ! ' .substr($this->infoTax['pTin'], 10, 1),LBR,0,C);
		$this->objRprt->Cell(5,$OuterLigne,'',0,0,C);
		$this->objRprt->Cell(14,$OuterLigne,substr($this->infoTax['pTin'], 12, 1). ' ! '  .substr($this->infoTax['pTin'], 13, 1).  ' ! ' .substr($this->infoTax['pTin'], 14, 1),LBR,0,C);
		$this->objRprt->Cell(2,$OuterLigne,'',R,0);

		//  second column
		$this->objRprt->SetFont(Arial,'',8);
		$this->objRprt->Cell(104,$OuterLigne,'40  Others (Specify)',LR,0,L);
		$this->objRprt->Ln(1);

		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(106,$OuterLigne,'',LBR,0,L);
		$this->objRprt->Cell(104,$OuterLigne,'',LR,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(106,$OuterLigne,'',LR,0,L);
		//  second column
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(6,$OuterLigne,'40A  ',0,0,L);
		$this->objRprt->Cell(33,$OuterLigne,' ',LTR,0,L);
		$this->objRprt->Cell(6,$OuterLigne,'40A ',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',LTR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(.5);

		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(106,$OuterLigne,'17  Employer ' . 's' . ' ' .'Name',LR,0,L);

		//  second column
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(6,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(33,$OuterLigne,' ',LR,0,L);
		$this->objRprt->Cell(6,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',LR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(5,$OuterLigne,'» ',L,0,L);
		$this->objRprt->Cell(99,$OuterLigne,$this->infoTax['pEmployer'],1,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);

		//  second column
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(6,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(33,$OuterLigne,' ',LBR,0,L);
		$this->objRprt->Cell(6,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',LBR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(1);

		$this->objRprt->Cell(106,$OuterLigne,'',LBR,0,L);
		$this->objRprt->Cell(104,$OuterLigne,'',LR,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(106,$OuterLigne,' ',LR,0,L);
		//  second column
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(6,$OuterLigne,'40B  ',0,0,L);
		$this->objRprt->Cell(33,$OuterLigne,' ',LTR,0,L);
		$this->objRprt->Cell(6,$OuterLigne,'40B ',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',LTR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(.5);

		//  18 Registered Address
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(90,$OuterLigne,'18  Registered Address',L,0,L);
		$this->objRprt->Cell(16,$OuterLigne,'18A Zip Code',R,0,C);

		//  second column
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(6,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(33,$OuterLigne,' ',LR,0,L);
		$this->objRprt->Cell(6,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',LR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->SetFont(Arial,'',9);
		$this->objRprt->Cell(5,$OuterLigne,'» ',L,0,L);
		$this->objRprt->Cell(75,$OuterLigne,$this->infoTax['pAddress'],1,0,L);
		$this->objRprt->Cell(10,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(14,$OuterLigne,' !     ! ',LTBR,0,C);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);

		//  second column
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(6,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(33,$OuterLigne,' ',LBR,0,L);
		$this->objRprt->Cell(6,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',LBR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(1);

		$this->objRprt->Cell(106,$OuterLigne,' ',LBR,0,L);
		$this->objRprt->Cell(104,$OuterLigne,' ',LR,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->SetFont(Arial,B,8);
		$this->objRprt->Cell(35,$OuterLigne,' ',LTB,0,L);
		$this->objRprt->Cell(6,$OuterLigne,' ',TB,0,L);
		$this->objRprt->Cell(65,$OuterLigne,'Employer Information (Previous)-2',TBR,0,L);

		//  second column
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(6,$OuterLigne,'41  Total Taxable Compensation',0,0,L);
		$this->objRprt->Cell(34,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(5,$OuterLigne,'41 ',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne,$this->totalAnnualSal,LTR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(106,$OuterLigne,' ',LR,0,L);

		//  second column
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(6,$OuterLigne,'       Income',0,0,L);
		$this->objRprt->Cell(34,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(5,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',LBR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(1);

		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(33,$OuterLigne,'19    Taxpayer                   19',L,0,L);
		$this->objRprt->Cell(14,$OuterLigne,'',LTR,0,R);
		$this->objRprt->Cell(5,$OuterLigne,'',0,0);
		$this->objRprt->Cell(14,$OuterLigne,'',LTR,0);
		$this->objRprt->Cell(5,$OuterLigne,'',0,0);
		$this->objRprt->Cell(14,$OuterLigne,'',LTR,0);
		$this->objRprt->Cell(5,$OuterLigne,'',0,0);
		$this->objRprt->Cell(14,$OuterLigne,'',LTR,0);
		$this->objRprt->Cell(2,$OuterLigne,'',R,0);

		//  second column
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(6,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(34,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(5,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',B,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(33,$OuterLigne,'         Identification No.        »',L,0,L);
		$this->objRprt->Cell(14,$OuterLigne,substr($this->infoTax['pTin1'], 0, 1). ' ! '  .substr($this->infoTax['pTin1'], 1, 1).  ' ! ' .substr($this->infoTax['pTin1'], 2, 1),LBR,0,C);
		$this->objRprt->Cell(5,$OuterLigne,'',0,0,C);
		$this->objRprt->Cell(14,$OuterLigne,substr($this->infoTax['pTin1'], 4, 1). ' ! '  .substr($this->infoTax['pTin1'], 5, 1).  ' ! ' .substr($this->infoTax['pTin1'], 6, 1),LBR,0,C);
		$this->objRprt->Cell(5,$OuterLigne,'',0,0,C);
		$this->objRprt->Cell(14,$OuterLigne,substr($this->infoTax['pTin1'], 8, 1). ' ! '  .substr($this->infoTax['pTin1'], 9, 1).  ' ! ' .substr($this->infoTax['pTin1'], 10, 1),LBR,0,C);
		$this->objRprt->Cell(5,$OuterLigne,'',0,0,C);
		$this->objRprt->Cell(14,$OuterLigne,substr($this->infoTax['pTin1'], 12, 1). ' ! '  .substr($this->infoTax['pTin1'], 13, 1).  ' ! ' .substr($this->infoTax['pTin1'], 14, 1),LBR,0,C);
		$this->objRprt->Cell(2,$OuterLigne,'',R,0);


		//  second column
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(104,$OuterLigne,'»  Summary',1,0,C);
		$this->objRprt->Ln(1);

		$this->objRprt->Cell(106,$OuterLigne,' ',LBR,0,L);
		$this->objRprt->Cell(104,$OuterLigne,' ',LR,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(106,$OuterLigne,' ',LR,0,L);
		//  second column
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(6,$OuterLigne,'42  Taxable Compensation Income',0,0,L);
		$this->objRprt->Cell(34,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(5,$OuterLigne,'42 ',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne,$this->totalAnnualSal,LTR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(106,$OuterLigne,'20  Employer ' . 's' . ' ' .'Name',LR,0,L);

		//  second column
		$this->objRprt->Cell(6,$OuterLigne,'       from Present Employer',0,0,L);
		$this->objRprt->Cell(33,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(6,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',LBR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(5,$OuterLigne,'» ',L,0,L);
		$this->objRprt->Cell(99,$OuterLigne,$this->infoTax['pEmployer1'],1,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);

		//  second column
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(6,$OuterLigne,'43  Add:  Taxable Compensation ',0,0,L);
		$this->objRprt->Cell(33,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(6,$OuterLigne,'  43 ',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne,$this->infoTax['pTaxComp'],LTR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(106,$OuterLigne,' ',LBR,0,L);
		//  second column
		$this->objRprt->Cell(6,$OuterLigne,'       from Previous Employer' . '(s)',0,0,L);
		$this->objRprt->Cell(33,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(6,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',LBR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(106,$OuterLigne,'',LR,0,L);
		//  second column
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(6,$OuterLigne,'44  Gross Taxable ',0,0,L);
		$this->objRprt->Cell(33,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(6,$OuterLigne,'  44 ',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne,$this->grossTaxIncome,LTR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);

		//  21 Registered Address
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(90,$OuterLigne,'21  Registered Address',L,0,L);
		$this->objRprt->Cell(16,$OuterLigne,'21A Zip Code',R,0,C);

		//  second column
		$this->objRprt->Cell(6,$OuterLigne,'      Compensation Income',0,0,L);
		$this->objRprt->Cell(33,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(6,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',LBR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(5,$OuterLigne,'» ',L,0,L);
		$this->objRprt->Cell(75,$OuterLigne,$this->infoTax['pAddress1'],1,0,L);
		$this->objRprt->Cell(10,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(14,$OuterLigne,' !     ! ',LTBR,0,C);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);

		//  second column
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(6,$OuterLigne,'45  Less: Total Exemptions',0,0,L);
		$this->objRprt->Cell(33,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(6,$OuterLigne,'  45 ',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne, $this->taxExempt  ,LTR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(106,$OuterLigne,' ',LBR,0,L);
		//  second column
		$this->objRprt->Cell(6,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(33,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(6,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',LBR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->SetFont(Arial,B,8);
		$this->objRprt->Cell(35,$OuterLigne,'',LTB,0,L);
		$this->objRprt->Cell(71,$OuterLigne,'Employer Information (Previous)-3',TBR,0,L);

		//  second column
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(6,$OuterLigne,'46  Less:  Premium Paid on Health',0,0,L);
		$this->objRprt->Cell(33,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(6,$OuterLigne,'  46 ',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne, $this->healthP ,LR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(106,$OuterLigne,' ',LTR,0,L);
		//  second column
		$this->objRprt->Cell(6,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(33,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(6,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',LR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(1);

		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(33,$OuterLigne,'22  Taxpayer                     22',L,0,L);
		$this->objRprt->Cell(14,$OuterLigne,'',LTR,0,R);
		$this->objRprt->Cell(5,$OuterLigne,'',0,0);
		$this->objRprt->Cell(14,$OuterLigne,'',LTR,0);
		$this->objRprt->Cell(5,$OuterLigne,'',0,0);
		$this->objRprt->Cell(14,$OuterLigne,'',LTR,0);
		$this->objRprt->Cell(5,$OuterLigne,'',0,0);
		$this->objRprt->Cell(14,$OuterLigne,'',LTR,0);
		$this->objRprt->Cell(2,$OuterLigne,'',R,0);

		//  second column
		$this->objRprt->Cell(6,$OuterLigne,'and/or Hospital Insurance(if applicable)',0,0,L);
		$this->objRprt->Cell(33,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(6,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',LBR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(33,$OuterLigne,'       Identification No.          »',L,0,L);
		$this->objRprt->Cell(14,$OuterLigne,' !     !',LBR,0,C);
		$this->objRprt->Cell(5,$OuterLigne,'',0,0,C);
		$this->objRprt->Cell(14,$OuterLigne,' !     !',LBR,0,C);
		$this->objRprt->Cell(5,$OuterLigne,'',0,0,C);
		$this->objRprt->Cell(14,$OuterLigne,' !     !',LBR,0,C);
		$this->objRprt->Cell(5,$OuterLigne,'',0,0,C);
		$this->objRprt->Cell(14,$OuterLigne,'!     !',LBR,0,C);
		$this->objRprt->Cell(2,$OuterLigne,'',R,0);

		//  second column
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(6,$OuterLigne,'47  Taxable',0,0,L);
		$this->objRprt->Cell(33,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(6,$OuterLigne,'  47 ',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne,$this->taxIncome,LTR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(106,$OuterLigne,' ',LBR,0,L);
		//  second column
		$this->objRprt->Cell(6,$OuterLigne,'      Compensation Income',0,0,L);
		$this->objRprt->Cell(33,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(6,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',LBR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(106,$OuterLigne,' ',LR,0,L);
		//  second column
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(6,$OuterLigne,'48  Tax Due',0,0,L);
		$this->objRprt->Cell(33,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(6,$OuterLigne,'  48 ',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne,$this->taxDue,LTR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(106,$OuterLigne,'23  Employer ' . 's' . ' ' .'Name',LR,0,L);

		//  second column
		$this->objRprt->Cell(6,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(33,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(6,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',LBR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);


		$this->objRprt->Cell(5,$OuterLigne,'» ',L,0,L);
		$this->objRprt->Cell(99,$OuterLigne,' ',1,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);

		//  second column
		$this->objRprt->Cell(2,$OuterLigne,'49  Amount of Taxes Withheld',0,0,L);
		$this->objRprt->Cell(39,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(4,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',LR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(106,$OuterLigne,' ',LBR,0,L);

		//  second column
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(6,$OuterLigne,'       49A  Present Employer',0,0,L);
		$this->objRprt->Cell(33,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(6,$OuterLigne,'49A ',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne,$this->taxWheld,LBR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(106,$OuterLigne,' ',LR,0,L);
		
		//  second column
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(6,$OuterLigne,'',0,0,L);
		$this->objRprt->Cell(33,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(6,$OuterLigne,'',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',LTR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);

		//  24 Registered Address
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(90,$OuterLigne,'24  Registered Address',L,0,L);
		$this->objRprt->Cell(16,$OuterLigne,'24A Zip Code',R,0,C);

		//  second column
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(6,$OuterLigne,'       49B  Previous Employer(s)',0,0,L);
		$this->objRprt->Cell(33,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(6,$OuterLigne,'49B ',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne,$this->infoTax['pTaxWheld'],LBR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(5,$OuterLigne,'» ',L,0,L);
		$this->objRprt->Cell(75,$OuterLigne,' ',1,0,L);
		$this->objRprt->Cell(10,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(14,$OuterLigne,' !     ! ',LTBR,0,C);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);

		//  second column
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(6,$OuterLigne,'50  Total Amount of Taxes',0,0,L);
		$this->objRprt->Cell(33,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(6,$OuterLigne,'  ',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne,' ',LR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(106,$OuterLigne,'',LR,0,L);

		//  second column
		$this->objRprt->Cell(6,$OuterLigne,'      Withheld',0,0,L);
		$this->objRprt->Cell(33,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(6,$OuterLigne,' 50 ',0,0,L);
		$this->objRprt->Cell(57,$OuterLigne,$this->totaltaxWheld,LBR,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(1);

		$this->objRprt->Cell(106,$OuterLigne,'',LBR,0,L);
		$this->objRprt->Cell(104,$OuterLigne,'',LBR,0,L);
		$this->objRprt->Ln(3);

		$text = 'I declare, under the penalties of perjury, that this certificate has been made in good faith, verified by us, and to the best of our knowledge and belief, is true';
		$text2 = ' and correct pursuant to the provisions of the National Internal Revenue Code, as amended, and the regulations issued under authority thereof.';

		$this->objRprt->SetFont(Arial,'',8);

		$this->objRprt->Cell(10,$OuterLigne,'',L,0,L);
		$this->objRprt->Cell(200,$OuterLigne,$text,R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(5,$OuterLigne,'',L,0,L);
		$this->objRprt->Cell(205,$OuterLigne,$text2,R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(210,$OuterLigne,'',LR,0,L);
		$this->objRprt->Ln(1);

		$this->objRprt->Cell(10,$OuterLigne,'',L,0,L);
		$this->objRprt->Cell(5,$OuterLigne,'51',0,0,L);
		$this->objRprt->Cell(2,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(67,$OuterLigne,'_____________________________________________________',0,0,L);
		$this->objRprt->Cell(27,$OuterLigne,' ',0,0,L);

		$this->objRprt->Cell(13,$OuterLigne,'Date Signed',0,0,L);
		$this->objRprt->Cell(5,$OuterLigne,'  ',0,0,L);
		$this->objRprt->Cell(7,$OuterLigne,' !  ',LTBR,0,C);
		$this->objRprt->Cell(7,$OuterLigne,' !  ',LTBR,0,C);
		$this->objRprt->Cell(19,$OuterLigne,' !     !     !',LTBR,0,C);
		$this->objRprt->Cell(31,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(17,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(17,$OuterLigne,'',L,0,L);
		$this->objRprt->Cell(67,$OuterLigne,'Present Employer/Authorized Agent Signature Over Printed Name',0,0,L);
		$this->objRprt->Cell(126,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(10,$OuterLigne,'',L,0,L);
		$this->objRprt->Cell(200,$OuterLigne,'CONFORME:',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(10,$OuterLigne,'',L,0,L);
		$this->objRprt->Cell(5,$OuterLigne,'52',0,0,L);
		$this->objRprt->Cell(2,$OuterLigne,'                             '.$t_strName1,0,0,L);
		$this->objRprt->Cell(67,$OuterLigne,'_____________________________________________________',0,0,L);
		$this->objRprt->Cell(27,$OuterLigne,' ',0,0,L);

		$this->objRprt->Cell(13,$OuterLigne,'Date Signed',0,0,L);
		$this->objRprt->Cell(5,$OuterLigne,'  ',0,0,L);
		$this->objRprt->Cell(7,$OuterLigne,' !  ',LTBR,0,C);
		$this->objRprt->Cell(7,$OuterLigne,' !  ',LTBR,0,C);
		$this->objRprt->Cell(19,$OuterLigne,' !     !     !',LTBR,0,C);
		$this->objRprt->Cell(31,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(17,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(17,$OuterLigne,'',L,0,L);
		$this->objRprt->Cell(67,$OuterLigne,'                    Employee Signature Over Printed Name',0,0,L);
		$this->objRprt->Cell(100,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(26,$OuterLigne,'Amount Paid',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(10,$OuterLigne,'',L,0,L);
		$this->objRprt->Cell(200,$OuterLigne,'CTC No.',R,0,L);
		$this->objRprt->Ln(3);
		
		
		$this->objRprt->Cell(10,$OuterLigne,'',L,0,L);
		$this->objRprt->Cell(15,$OuterLigne,'of Employee',0,0,L);
		$this->objRprt->Cell(2,$OuterLigne,'',0,0,L);
		$this->objRprt->SetFont(Arial,'',6);
		$this->objRprt->Cell(30,$OuterLigne,$t_strComTaxNumber,1,0,L);
		$this->objRprt->Cell(2,$OuterLigne,'',0,0,L);
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(20,$OuterLigne,'Place of Issue',0,0,L);
		$this->objRprt->SetFont(Arial,'',6);
		$this->objRprt->Cell(30,$OuterLigne,$t_strIssuedAt,1,0,L);
		$this->objRprt->Cell(2,$OuterLigne,'',0,0,L);
		$this->objRprt->SetFont(Arial,'',7);
		$this->objRprt->Cell(13,$OuterLigne,'Date Signed',0,0,L);
		$this->objRprt->Cell(5,$OuterLigne,'  ',0,0,L);
		$this->objRprt->Cell(7,$OuterLigne,' !  ',LTBR,0,C);
		$this->objRprt->Cell(7,$OuterLigne,' !  ',LTBR,0,C);
		$this->objRprt->Cell(19,$OuterLigne,' !     !     !',LTBR,0,C);
		$this->objRprt->Cell(15,$OuterLigne,' ',0,0,L);

		$this->objRprt->Cell(30,$OuterLigne,'',1,0,L);			//  amount paid query here
		$this->objRprt->Cell(3,$OuterLigne,' ',R,0,L);
		$this->objRprt->Ln(2);

		$this->objRprt->Cell(210,$OuterLigne,' ',LBR,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->SetFont(Arial,B,8);
		$this->objRprt->Cell(210,$OuterLigne,'To be accomplished under substituted filing',LTBR,0,C);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(10,$OuterLigne,' ',L,0,L);
		$this->objRprt->Cell(96,$OuterLigne,'I declare, under the penalties of perjury, that the information herein',R,0,L);
		$this->objRprt->Cell(10,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(94,$OuterLigne,'I declare, under the penalties of perjury that I am qualified under',R,0,L);
		$this->objRprt->Ln(3);


		$this->objRprt->Cell(5,$OuterLigne,' ',L,0,L);
		$this->objRprt->Cell(101,$OuterLigne,'stated are reported under BIR Form No. 1604CF  which have been filed',R,0,L);
		$this->objRprt->Cell(5,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(99,$OuterLigne,'substituted filling of Income Tax Returns (BIR Form No. 1700), since',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(5,$OuterLigne,' ',L,0,L);
		$this->objRprt->Cell(101,$OuterLigne,'with the Bureau of Internal Revenue.',R,0,L);
		$this->objRprt->Cell(5,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(99,$OuterLigne,'I received  purely compensation  income from  only one employer in',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(5,$OuterLigne,' ',L,0,L);
		$this->objRprt->Cell(101,$OuterLigne,' ',R,0,L);
		$this->objRprt->Cell(5,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(99,$OuterLigne,'the  Phils.  for  the calendar year;   that  taxes  have  been  correctly',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(5,$OuterLigne,' ',L,0,L);
		$this->objRprt->Cell(5,$OuterLigne,'53',0,0,L);
		$this->objRprt->Cell(1,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(95,$OuterLigne,'________________________________________________________',R,0,L);
		$this->objRprt->Cell(5,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(99,$OuterLigne,' withheld by my employer (tax due equals tax withheld); that the BIR',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(11,$OuterLigne,' ',L,0,L);
		$this->objRprt->Cell(95,$OuterLigne,'Present Employer/Authorized Agent Signature Over Printed Name',R,0,L);
		$this->objRprt->Cell(5,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(99,$OuterLigne,'Form No. 1604CF filed by my employer to the BIR shall constitute as',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(8,$OuterLigne,' ',L,0,L);
		$this->objRprt->Cell(98,$OuterLigne,'(Head of Accounting/Human Resource or Authorized Representative)',R,0,L);
		$this->objRprt->Cell(5,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(99,$OuterLigne,'my income tax return;   and that BIR  Form  No. 2316  shall serve the',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(106,$OuterLigne,' ',LR,0,L);
		$this->objRprt->Cell(5,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(99,$OuterLigne,'same  purpose as if  BIR  Form  No. 1700  had been filed pursuant to',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(106,$OuterLigne,' ',LR,0,L);
		$this->objRprt->Cell(5,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(99,$OuterLigne,'the provisions of RR 3-2002, as amended.',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(106,$OuterLigne,' ',LR,0,L);
		$this->objRprt->Cell(104,$OuterLigne,'',LR,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(106,$OuterLigne,' ',LR,0,L);
		$this->objRprt->Cell(15,$OuterLigne,' ',0,0,L);
		$this->objRprt->Cell(4,$OuterLigne,'54                       '  .$t_strName1,0,0,L);
		$this->objRprt->Cell(85,$OuterLigne,'________________________________________________',R,0,L);
		$this->objRprt->Ln(3);

		$this->objRprt->Cell(106,$OuterLigne,' ',LBR,0,L);
		$this->objRprt->Cell(29,$OuterLigne,' ',B,0,L);
		$this->objRprt->Cell(75,$OuterLigne,'Employee Signature Over Printed Name',BR,0,L);
		$this->objRprt->Ln(3);


	}	//  end function printBody()
	
	function generateReport()
	{
		$this->objRprt = new ReportW2TaxWithheld('L','mm', 'Legal');
		$this->objRprt1 = new AttendanceCompensation;
	
		$this->objRprt->setMonthYear($_SESSION['sesCshrYear'], $_SESSION['sesCshrPeriod']);
		
		$this->objRprt->SetLeftMargin(3);
		$this->objRprt->SetRightMargin(3);
		$this->objRprt->SetTopMargin(10);
		$this->objRprt->SetAutoPageBreak("on",10);
		$this->objRprt->AliasNbPages();
		$this->objRprt->Open();
		
		$objEmp = mysql_query("SELECT tblEmpPersonal.empNumber, tblEmpPersonal.surname, 
										tblEmpPersonal.firstname, tblEmpPersonal.middlename, tblEmpPersonal.tin, tblEmpPersonal.issuedAt,
										tblEmpPersonal.residentialAddress, tblEmpPersonal.permanentAddress, tblEmpPersonal.comTaxNumber,
										tblEmpPersonal.birthday, tblEmpPosition.appointmentCode, tblEmpPosition.actualSalary, tblEmpPosition.itwSwitch,
										tblEmpPosition.pagibigSwitch, tblEmpPosition.lifeRetSwitch, tblEmpPosition.philhealthSwitch,
										tblEmpPosition.dependents, tblEmpPosition.taxStatCode, tblEmpPosition.healthProvider,
										tblAgency.agencyName, tblAgency.address, tblAgency.agencyTin as atin
								FROM tblEmpPersonal, tblAgency
									INNER JOIN tblEmpPosition
										ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber				
								WHERE tblEmpPosition.statusOfAppointment = 'In-Service'
								ORDER BY tblEmpPersonal.surname, tblEmpPersonal.firstname ") or die (mysql_error());

		/* $objLastRcrd = mysql_query("SELECT DISTINCT tblEmpPersonal.empNumber
								FROM tblEmpPersonal 
									INNER JOIN tblEmpAddIncome
										ON tblEmpPersonal.empNumber = tblEmpAddIncome.empNumber
									INNER JOIN tblEmpPosition
										ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
									INNER JOIN tblAddIncome
										ON tblEmpAddIncome.addIncomeCode = tblAddIncome.addIncomeCode
									INNER JOIN tblDivision
										ON tblEmpPosition.divisionCode = tblDivision.divisionCode
									INNER JOIN tblPosition
										ON tblEmpPosition.positionCode = tblPosition.positionCode
								WHERE tblEmpAddIncome.addIncomeCode = 'CG' 
									  AND tblAddIncome.addIncomeCode = 'CG' 
										AND tblEmpAddIncome.addIncomeYear = '".$_SESSION['sesCshrYear']."'
								ORDER BY tblEmpPosition.divisionCode asc, 
										tblEmpPersonal.surname asc, tblEmpPersonal.firstname asc");
		
		$arrLastRcrd = mysql_fetch_array($objLastRcrd);  */
		//$intNumRows = mysql_num_rows($objEmp);
		
		while ($arrEmp = mysql_fetch_array($objEmp))
		{			
			$intCounter++;
			$strEmpNum = $arrEmp['empNumber'];
			$strEmpAgency = $arrEmp['agencyName'];
			$strEmpAddress = $arrEmp['address'];
			$strName = $arrEmp['surname'].", ".$arrEmp['firstname']." " .$arrEmp['middlename'];
			$strName1 = $arrEmp['firstname']." ".$arrEmp['surname'];
			$strTin = $arrEmp['tin'];
			$strAddress = $arrEmp['residentialAddress'];
			$strAddress1 = $arrEmp['permanentAddress'];
			$strBday = $arrEmp['birthday'];		
			$intMonthlySalary = $arrEmp['actualSalary'];
			$taxCode = $arrEmp['taxStatCode'];
			$dependents = $arrEmp['dependents'];
			$itwSwitch = $arrEmp['itwSwitch'];
			$lifeRetSwitch = $arrEmp['lifeRetSwitch'];
			$pagibigSwitch = $arrEmp['pagibigSwitch'];
			$philhealthSwitch = $arrEmp['philhealthSwitch'];
			$healthProvider = $arrEmp['healthProvider'];
			$appointmentCode = $arrEmp['appointmentCode'];
			$strComTaxNumber = $arrEmp['comTaxNumber'];
			$strIssuedAt = $arrEmp['issuedAt'];
			$strAgencyTin = $arrEmp['atin'];
			
			
			$this->computeDeduction($strEmpNum, $intMonthlySalary,"lifeRetshare",$taxCode,$dependents,$lifeRetSwitch, $cboMonth, $healthProvider );
			$this->computeDeduction($strEmpNum, $intMonthlySalary,"pagIbigshare",$taxCode,$dependents,$pagibigSwitch, $cboMonth, $healthProvider );
			$this->computeDeduction($strEmpNum, $intMonthlySalary,"philHealth",$taxCode,$dependents,$philhealthSwitch, $cboMonth, $healthProvider );
			$this->checkProvider($strEmpNum, $healthProvider);
			$this->computeDeduction($strEmpNum, $intMonthlySalary,"itw",$taxCode,$dependents,$itwSwitch, $cboMonth, $healthProvider );
			$this->getLOA($strEmpNum);
			$this->getAbsences($strEmpNum, $appointmentCode, $intMonthlySalary);
			$this->getAnnualSalary ($strEmpNum);
			$this->totalAnnualSal = $this->annualSal - $this->intAbsTotal;
			$this->grossTaxIncome = $this->totalAnnualSal - $this->infoTax['pTaxComp'];
			$this->taxIncome = $this->grossTaxIncome - $this->taxExempt - $this->healthP;
			$this->totalBenefits = $this->benefits + $intMonthlySalary;
			$this->totalNontax = $this->totalBenefits + $this->WholeNonTax;
			$this->infoTax = $this->getPrevTax($strEmpNum);
			$this->getTaxWheld($strEmpNum);
			$this->totaltaxWheld = $this->taxWheld + $this->infoTax['pTaxWheld'];
			$this->objRprt->AddPage();
			//$this->objRprt->taxExempt($strEmpNum, $exempTax);
				
			$this->printBody($strEmpNum, $strEmpAgency, $strEmpAddress, $strName, $strName1, $strTin, $strAddress, $strAddress1, $strBday, $strComTaxNumber, $strIssuedAt, $strAgencyTin);
			
		}
		
				
		$this->objRprt->Output();
	}
	
	function computeDeduction($empNumber, $actualSal, $strDeduct, $taxCode, $dependents, $chkDeduct, $cboMonth, $healthProvider)
	{

	 switch ($strDeduct) { 
	 	
		case "lifeRet"		:	if ($chkDeduct == 'Y') 
								{	
									$this->lifeRet = $actualSal * 0.09; 
						  			return round($this->lifeRet,2);
								}
								else {
									$this->lifeRet = 0; 
						  			return $this->lifeRet;
								}
						  
		case "lifeRetshare"	: 	if ($chkDeduct == 'Y') 
								{		
									$this->lifeRetshare = $actualSal * 0.12;
									return round($this->lifeRetshare,2);
								}
								else {
									$this->lifeRetshare = 0;
									return $this->lifeRetshare;
								}
						  
		case "pagIbig"		:   if ($chkDeduct == 'Y') 
								{	
									if (($actualSal * 0.02) > 100) {
										$this->pagIbig = 100;
										return $this->pagIbig; }
							    	else {
										$this->pagIbig = $actualSal * 0.02;
										return round($this->pagIbig,2);
										}
								}
								else {
									$this->pagIbig = 0;
									return $this->pagIbig;
								}
								
									
		case "pagIbigshare"	:	if ($chkDeduct == 'Y') 
								{ 
									if (($actualSal > 0) && ($actualSal < 5000)) {
										$this->pagIbigshare = $actualSal * 0.02;
										return round($this->pagIbigshare,2); }		
									elseif ($actualSal >= 5000) {
										$this->pagIbigshare = 5000 * 0.02;
										return round($this->pagIbigshare,2); }
								}
								else {
									$this->pagIbigshare = 0;
									return $this->pagIbigshare;
								}
									
		case "philHealth"	:	if ($chkDeduct == 'Y') 
								{ 		
									$result = "SELECT * FROM tblPhilhealthRange";
									$sqlresult = mysql_query($result) or die (mysql_error());
									if($row = mysql_fetch_array($sqlresult))     {
		    						do {
			   							$philhealthFrom=$row['philhealthFrom'];
			   							$philhealthTo=$row['philhealthTo'];
										$philSalaryBase=$row['philSalaryBase'];
									
										if (($actualSal > $philhealthFrom) && ($actualSal < $philhealthTo)) 
										{
											$salBase = $philSalaryBase;
											$monthlyCon = ($salBase / 100) * 2.5;
											$this->philHealth = $monthlyCon / 2;	
											return round($this->philHealth,2);
							    		}
										} 
									while($row=mysql_fetch_array($sqlresult)); }
								}
								else {
									$this->philHealth = 0;	
									return $this->philHealth;
								}
							
		case "itw"		:	if ($chkDeduct == 'Y') 
							{
		
							$nonTax = $this->lifeRetshare + $this->pagIbigshare + $this->philHealth;
							$this->WholeNonTax = $nonTax * 12;
							
							
							
							 		
							$result = "SELECT * FROM tblTaxExempt WHERE taxStatus = '$taxCode'";
							$sqlresult = mysql_query($result) or die (mysql_error());
							if($row = mysql_fetch_array($sqlresult))     {
		    					do {
			   						$taxStatus=$row['taxStatus'];
			   						$exemptionAmount=$row['exemptAmount'];

									if (($taxCode == "Single") or ($taxCode == "SINGLE"))
										{
											$this->taxExempt = $exemptionAmount;								
										} 
										elseif (($taxCode == "Head") or ($taxCode == "HEAD"))
										{ 
											$this->taxExempt = $exemptionAmount + ($dependents * 8000);
										}
										elseif (($taxCode == "Married") or ($taxCode == "MARRIED"))
										{
											$this->taxExempt = $exemptionAmount + ($dependents * 8000);			
										}	
									} 
									
								while($row=mysql_fetch_array($sqlresult)); }
								
							if ($healthProvider == 'Y')
							{	
								$this->taxExemptAll = $this->taxExempt + 2400;
								
							}
							else {	$this->taxExemptAll = $this->taxExempt; }	
									
							$result1 = "SELECT * FROM tblTaxRange";
							$sqlresult1 = mysql_query($result1) or die (mysql_error());
								if($row1 = mysql_fetch_array($sqlresult1))     {
									
									$taxable = (($actualSal - $nonTax)*12) - $this->taxExemptAll;
									
										
		    					do {
			   						$taxBase=$row1['taxBase'];
			   						$taxDeduct=$row1['taxDeduct'];
									$taxFactor=$row1['taxFactor'];
			   						$taxableFrom=$row1['taxableFrom'];
			   						$taxableTo=$row1['taxableTo']; 
									
									 //$taxable = (($actualSal - $nonTax) * 12) - $taxExempt;
									 
									 	if (($taxable > $taxableFrom) && ($taxable <= $taxableTo)) 
										{   	
											
											$this->taxDue = ($taxDeduct + (($taxable - $taxBase) * $taxFactor));
											
											$this->itw = $this->taxDue / 12;
											return round($this->itw,2);
											
																					 
									 	} 
													
									} 	
								while($row1=mysql_fetch_array($sqlresult1)); }
								
							}
							else {
								$this->itw = 0;
								return $this->itw;
								
							}
						  
	 	default			: break;		
	 
	 }
	 
	}
	function checkProvider ($empNumber, $healthProvider)
	{
		$result = "select empNumber, healthProvider, statusOfAppointment from tblEmpPosition WHERE statusOfAppointment = 'In-Service'";
		$sqlresult = mysql_query($result) or die (mysql_error());
		if($row = mysql_fetch_array($sqlresult))     
		{
			do {
			
			if ($healthProvider == 'Y')
			{
				$this->healthP = 2400;
			}
			else { $this->healthP = 0; }
			
			} 	
			while($row=mysql_fetch_array($sqlresult)); }
	
			
			
	}
	
	function getAnnualSalary ($t_empNumber)
	{
		$result = mysql_query("SELECT SUM(incomeAmount) as total FROM tblEmpIncome	WHERE empNumber='$t_empNumber' and incomeCode='MS' and incomeYear='".$_SESSION['sesCshrYear']."'");
		if($row = mysql_fetch_array($result))
		{
			do {
			 		
			   		$this->annualSal=$row['total'];
					
				} 		
				while($row=mysql_fetch_array($result)); }
				
		$result1 = mysql_query("SELECT SUM(shareAmount) as dtotal FROM tblEmpAgencyShare WHERE empNumber='$t_empNumber' and (deductionCode='PAGIBIGP' or deductionCode='PHP' or deductionCode='LR') and deductYear='".$_SESSION['sesCshrYear']."'");
		if($row1 = mysql_fetch_array($result1))
		{
			do {
			 		
			   		$shareAmount=$row1['dtotal'];
					
					
					
				} 		
				while($row1=mysql_fetch_array($result1)); }
				$this->annualSal = $this->annualSal - $shareAmount;
				return $this->annualSal;
			
				
	}
	
	function getLOA ($t_empNumber)
	{
	$result = mysql_query("SELECT SUM(incomeAmount) as total FROM tblEmpIncome	WHERE empNumber='$t_empNumber' and incomeCode='LOA' and incomeYear='".$_SESSION['sesCshrYear']."'");
	if($row = mysql_fetch_array($result))
		{
			do {
			 		
			   		$this->benefits=$row['total'];
					
				} 		
				while($row=mysql_fetch_array($result)); }
				//return $this->annualSal;
		
	
	$result1 = mysql_query("SELECT addIncomeAmount FROM tblEmpAddIncome WHERE empNumber='$t_empNumber' and addIncomeCode='CG'");
	if($row1 = mysql_fetch_array($result1))
		{
			do {
			 		
			   		$addIncomeAmount=$row1['addIncomeAmount'];
					
					
					
				} 		
				while($row1=mysql_fetch_array($result1)); }
				$this->benefits = $this->benefits + $addIncomeAmount;
				return $this->benefits;
				
	
	}
	
	function getAbsences ($strEmpNum, $appointmentCode, $intMonthlySalary)
	{
	$intPaymentBasis = $this->objRprt1->getPaymentBasis($appointmentCode, $t_intMonth, $t_intYear);
	$intAbsYear = $this->objRprt1->getLateUndAbsHlfYear($strEmpNum, $_SESSION['sesCshrYear']);
	$intPerDay = $intMonthlySalary / $intPaymentBasis;
	$this->intAbsTotal = round($intPerDay * $intAbsYear,2);
	
	}
	
	function getPrevTax ($t_empNumber)
	{
		$result = mysql_query("SELECT * FROM tblTaxDetails	WHERE empNumber='$t_empNumber'");
		while ($info = mysql_fetch_array($result)) {
			return $info;
		}
	}
	
	function getTaxWheld ($t_empNumber)
	{
	$result = mysql_query("SELECT SUM(deductAmount) as total FROM tblEmpDeductRemit	WHERE empNumber='$t_empNumber' and deductionCode='ITW' and deductYear='".$_SESSION['sesCshrYear']."'");
	if($row = mysql_fetch_array($result))
		{
			do {
			 		
			   		$this->taxWheld=$row['total'];
					
				} 		
				while($row=mysql_fetch_array($result)); }
				return $this->taxWheld;
	}
	
	
}  // End Class

?>