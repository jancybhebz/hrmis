<?
define('FPDF_FONTPATH','../hrmis/class/font/');
require_once('../hrmis/class/fpdf.php');

class ReportPHPremium extends FPDF
{
	var $agencyName, $agencyAdd, $agencyNum;
	var $strSgntryName, $strSgntryTitle;
	var $curPShareGrandTotal, $curEShareGrandTotal, $curEPTotalsGrandTotal;
	var $curPSharePageTotal, $curESharePageTotal, $curEPTotalsPageTotal;
	var $blnGrandTotal = 0;
	var $strMonthName, $intYear;
	
	
	//Page header
	function Header()
	{	
		$this->SetFont('Arial','B',11);
		$this->Cell(0,5,'REPUBLIC OF THE PHILIPPINES', 0, 1, 'C');
		$this->SetFont('Arial','',10);
		$this->Cell(110,5,'PHILHEALTH REMITTANCE FORM NO. 1', 0, 0, 'L');
		$this->SetFont('Arial','B',11);		
		$this->Cell(0,5,'PHILIPPINE HEALTH INSURANCE CORPORATION', 0, 1, 'L');
		$this->Cell(20,5,'RF-1', 1, 0, 'L');
		$this->Cell(65);
		$this->Cell(0,5,'8/F PHILIPPINE HEART CENTER BLDG. EAST AVENUE DILIMAN, QUEZON CITY', 0, 1, 'L');		
		$this->Cell(0,5,'TEL. NOS. 928-0349 : 928-1301 LOC. 3810 FAX NO. 927-1272', 0, 1, 'C');		
		$this->Ln(5);
		
		$this->intPageNo = $this->PageNo();

		$this->SetFont('Arial','',11);
		$this->Cell(0,2,'Page  '.$this->intPageNo.' of {nb}', 0, 0, 'R');		
		$this->Ln(5);
				
		$this->SetFont('Arial','',11);
		$this->Cell(30,2,'Office Name: ', 0, 0, 'L');
		$this->SetFont('Arial','U',11);
		$this->Cell(150,2,strtoupper($this->agencyName), 0, 0, 'L');
		$this->SetFont('Arial','',11);
		$this->Cell(30,2,'Employer ID No. ', 0, 0, 'L');
		$this->SetFont('Arial','U',11);		
		$this->Cell(0,2,'', 0, 0, 'L');		
		$this->Ln(5);
		
		$this->SetFont('Arial','',11);
		$this->Cell(30,2,'Office Address: ', 0, 0, 'L');
		$this->SetFont('Arial','U',11);
		$this->Cell(150,2,$this->agencyAdd, 0, 0, 'L');
		$this->SetFont('Arial','',11);
		$this->Cell(30,2,'Employer TIN', 0, 0, 'L');
		$this->SetFont('Arial','U',11);		
		$this->Cell(0,2,'350-000-846-91', 0, 0, 'L');		
		$this->Ln(5);

		$this->SetFont('Arial','',11);
		$this->Cell(30,2,'Office Tel. No.: ', 0, 0, 'L');
		$this->SetFont('Arial','U',11);
		$this->Cell(150,2,$this->agencyNum, 0, 0, 'L');
		$this->SetFont('Arial','BI',11);
		$this->Cell(0,5,'For the month of '.$this->strMonthName.' '.$this->intYear, 0, 1, 'R');
		$this->Ln(3);
				
		$this->SetFont('Arial','',10);
		$this->SetFillColor(200,200,200);
		$this->Cell(5,5,'#', 1, 0, 'L',1);
		$this->Cell(65,5,'Employee Name', 1, 0, 'C',1);
		$this->Cell(40,5,'Policy No.', 1, 0, 'C',1);
		$this->Cell(50,5,'Position Title', 1, 0, 'C',1);
		$this->Cell(40,5,'Monthly Compensation', 1, 0, 'C',1);
		$this->Cell(40,5,'Personal Share', 1, 0, 'C',1);
		$this->Cell(40,5,'Employer Share', 1, 0, 'C',1);		
		$this->Cell(35,5,'Totals', 1, 1, 'C',1);
	}
	
	//Page footer
	function Footer()
	{	
		$this->SetY(-60);   // gray total
		$this->SetFillColor(200,200,200);
		$this->SetFont('Arial','B',10);
		$this->Cell(200,5,'Page Total:', 1, 0, 'R',1);
		$this->Cell(40,5,number_format($this->curPSharePageTotal, 2,".",","), 1, 0, 'R',1);
		$this->Cell(40,5,number_format($this->curESharePageTotal, 2,".",","), 1, 0, 'R',1);		
		$this->Cell(35,5,number_format($this->curEPTotalsPageTotal, 2,".",","), 1, 1, 'R',1);

		if ($this->blnGrandTotal)
		{
			$this->SetFillColor(180,180,180);
			$this->SetFont('Arial','B',10);
			$this->Cell(200,5,'Grand Total:', 1, 0, 'R',1);
			$this->Cell(40,5,number_format($this->curPShareGrandTotal, 2,".",","), 1, 0, 'R',1);
			$this->Cell(40,5,number_format($this->curEShareGrandTotal, 2,".",","), 1, 0, 'R',1);		
			$this->Cell(35,5,number_format($this->curEPTotalsGrandTotal, 2,".",","), 1, 1, 'R',1);
		}
		$this->Ln(15);
			
		$this->SetFont('Arial','',11);
		$this->Cell(30);
		$this->Cell(130,5,'Prepared by:', 0, 0, 'L');
		$this->Cell(130,5,'Certified correct:', 0, 0, 'L');
		$this->Ln(10);

		$this->SetFont('Arial','B',11);
		$this->Cell(30);
		$this->setSignatory("Cashier");
		$this->Cell(70, 5,strtoupper($this->strSgntryName), 0, 0, 'C');
		$this->Cell(60);
		$this->setSignatory("Accountant");
		$this->Cell(70, 5,strtoupper($this->strSgntryName), 0, 0, 'C');
		$this->Ln(4);
		
		$this->SetFont('Arial','B',11);
		$this->Cell(30);
		$this->setSignatory("Cashier");
		$this->Cell(70, 5,$this->strSgntryTitle, 0, 0, 'C');
		$this->Cell(60);
		$this->setSignatory("Accountant");
		$this->Cell(70, 5,$this->strSgntryTitle, 0, 0, 'C');
		$this->Ln(4);
	}
	
	
	function setOfficeInfo($t_OfficeName, $t_OfficeAdd, $t_OfficeTelNum)
	{
		$objOfficeInfo = mysql_query("SELECT tblAgency.agencyName, tblAgency.address, tblAgency.telephone
									  FROM tblAgency");
		$arrOfficeInfo = mysql_fetch_array($objOfficeInfo);
		$this->agencyName = $arrOfficeInfo['agencyName'];
		$this->agencyAdd = $arrOfficeInfo['address'];
		$this->agencyNum = $arrOfficeInfo['telephone'];
	}	
	
	function setSignatory($t_strDesignation)
	{
		$objSignatory = mysql_query("SELECT * FROM tblSignatory
										WHERE designation = '$t_strDesignation'");
		$arrSignatory = mysql_fetch_array($objSignatory);
		$this->strSgntryName = $arrSignatory["signatory"];
		$this->strSgntryTitle = $arrSignatory["signatoryTitle"];
	}
	
	function setGrandTotal($t_intPShareGrandTotal, $t_intEShareGrandTotal,  $t_intEPTotalsGrandTotal)
	{
		$this->blnGrandTotal = 1;
		$this->curPShareGrandTotal = $t_intPShareGrandTotal;
		$this->curEShareGrandTotal = $t_intEShareGrandTotal;		
		$this->curEPTotalsGrandTotal = $t_intEPTotalsGrandTotal;
	}
	
	function setMonthYear($t_strMonthName, $t_intYear)
	{
		$this->strMonthName = $t_strMonthName;
		$this->intYear = $t_intYear;
	}
	
	function setPageTotal($t_intPSharePageTotal,$t_intESharePageTotal,$t_intEPTotalsPageTotal)
	{
		$this->curPSharePageTotal = $t_intPSharePageTotal;
		$this->curESharePageTotal = $t_intESharePageTotal;		
		$this->curEPTotalsPageTotal = $t_intEPTotalsPageTotal;
		
	}
	
}
?>