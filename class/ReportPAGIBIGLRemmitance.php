<?
define('FPDF_FONTPATH','../hrmis/class/font/');
require_once('../hrmis/class/fpdf.php');

class ReportPAGIBIGLRemmitance extends FPDF
{
	var $strMonthName, $intYear;
	var $intPageNo;
	var $curPageTotal, $curGrandTotal;
	var $strSgntryName, $strSgntryTitle;
	var $blnGrandTotal = 0;
	var $agencyName, $agencyAdd, $agencyNum;
	

	//Page header
	function Header()
	{	
		$this->SetFont('Arial','B',14);
		$this->Cell(0,0,'STATEMENT OF PAGIBIG MULTI-PURPOSE LOAN REMITTANCES', 0, 0, 'C');
		$this->Ln(7);
		$this->SetFont('Arial','B',12);
		$this->Cell(0,2,'For the month of '.$this->strMonthName.'  '.$this->intYear, 0, 0, 'C');		
		$this->Ln(5);
		
		$this->intPageNo = $this->PageNo();
		
		$this->SetFont('Arial','',11);
		$this->Cell(0,2,'Page '.$this->intPageNo.' of {nb}', 0, 0, 'R');		
		$this->Ln(5);
				
		$this->SetFont('Arial','',11);
		$this->Cell(30,2,'Office Name: ', 0, 0, 'L');
		$this->SetFont('Arial','B',11);
		$this->Cell(0,2,strtoupper($this->agencyName), 0, 0, 'L');
		$this->Ln(5);
		
		$this->SetFont('Arial','',11);
		$this->Cell(30,2,'Office Address: ', 0, 0, 'L');
		$this->SetFont('Arial','B',11);
		
		$this->Cell(0,2,$this->agencyAdd, 0, 0, 'L');
		$this->Ln(5);

		$this->SetFont('Arial','',11);
		$this->Cell(30,2,'Office Tel. No.: ', 0, 0, 'L');
		$this->SetFont('Arial','B',11);
		$this->Cell(0,2,$this->agencyNum, 0, 0, 'L');				
		$this->Ln(10);
				
		$this->SetFont('Arial','',10);
		$this->SetFillColor(200,200,200);
		$this->Cell(9,5,'#', 'LTR', 0, 'L',1);
		$this->Cell(65,5,'Employee Name', 'LTR', 0, 'C',1);
		$this->Cell(35,5,'Voucher No.', 'LTR', 0, 'C',1);
		$this->Cell(30,5,'Voucher Date', 'LTR', 0, 'C',1);
		$this->Cell(30,5,'Promissory', 'LTR', 0, 'C',1);
		$this->Cell(30,5,'Date of', 'LTR', 0, 'C',1);
		$this->Cell(30,5,'Amount', 'LTR', 0, 'C',1);
		$this->Cell(30,5,'Monthly', 'LTR', 0, 'C',1);		
		$this->Cell(60,5,'Collection Period', 1, 1, 'C',1);

		$this->Cell(9,5,'', 'LBR', 0, 'L',1);
		$this->Cell(65,5,'', 'LBR', 0, 'L',1);
		$this->Cell(35,5,'', 'LBR', 0, 'L',1);
		$this->Cell(30,5,'', 'LBR', 0, 'L',1);
		$this->Cell(30,5,'Note No.', 'LBR', 0, 'C',1);
		$this->Cell(30,5,'Promissory Note', 'LBR', 0, 'C',1);
		$this->Cell(30,5,'Granted', 'LBR', 0, 'C',1);
		$this->Cell(30,5,'Amortization', 'LBR', 0, 'C',1);
		$this->Cell(30,5,'From', 1, 0, 'C',1);
		$this->Cell(30,5,'To', 1, 1, 'C',1);

	}
	
	//Page footer
	function Footer()
	{	
		$this->SetY(-50);   // gray total
		$this->SetFillColor(200,200,200);
		$this->SetFont('Arial','B',10);
		$this->Cell(229,5,'Page Total:', 1, 0, 'R',1);
		$this->Cell(30,5,number_format($this->curPageTotal, 2,".",","), 1, 0, 'R',1);
		$this->Cell(60,5,'', 1, 1, 'L',1);		
		
		if($this->blnGrandTotal)
		{
			$this->SetFillColor(150,150,150);
			$this->SetFont('Arial','B',10);
			$this->Cell(229,5,'Grand Total:', 1, 0, 'R',1);
			$this->Cell(30,5,number_format($this->curGrandTotal, 2,".",","), 1, 0, 'R',1);
			$this->Cell(60,5,'', 1, 1, 'L',1);
		}
		$this->Ln(10);
			
		$this->SetFont('Arial','',11);
		$this->Cell(30);
		$this->Cell(130,5,'Prepared by:', 0, 0, 'L');
		$this->Cell(130,5,'Certified correct:', 0, 0, 'L');
		$this->Ln(10);

		$this->SetFont('Arial','B',11);
		$this->Cell(30);
		$this->setSignatory("Cashier");
		$this->Cell(70, 5, strtoupper($this->strSgntryName), 0, 0, 'C');
		$this->Cell(60);
		$this->setSignatory("Accountant");
		$this->Cell(70, 5, strtoupper($this->strSgntryName), 0, 0, 'C');
		$this->Ln(4);
		
		$this->SetFont('Arial','B',11);
		$this->Cell(30);
		$this->setSignatory("Cashier");
		$this->Cell(70, 5,$this->strSgntryTitle, 0, 0, 'C');
		$this->Cell(60);
		$this->setSignatory("Accountant");
		$this->Cell(70, 5, $this->strSgntryTitle, 0, 0, 'C');
		$this->Ln(4);
	}
	
	function setSignatory($t_strDesignation)
	{
		$objSignatory = mysql_query("SELECT * FROM tblSignatory
										WHERE designation = '$t_strDesignation'");
		$arrSignatory = mysql_fetch_array($objSignatory);
		$this->strSgntryName = $arrSignatory["signatory"];
		$this->strSgntryTitle = $arrSignatory["signatoryTitle"];
	}
	
	function setGrandTotal($t_intGrandTotal)
	{
		$this->blnGrandTotal = 1;
		$this->curGrandTotal = $t_intGrandTotal;
	}
	
	function setMonthYear($t_strMonthName, $t_intYear)
	{
		$this->strMonthName = $t_strMonthName;
		$this->intYear = $t_intYear;
	}
	
	function setPageTotal($t_curPageTotal)
	{
		 $this->curPageTotal = $t_curPageTotal;
		
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
}
?>