<?
//require_once("../hrmis/class/General.php");
//require_once("../hrmis/class/Constant.php");
require_once('../hrmis/class/ReportLongevityPay.php');

class ReportLP //extends General
{
	var $objRprt;
	var $intCounter = 0;
	
	function printPreview()
	{
		$this->objRprt->SetFont('Arial','',10);
		$this->objRprt->Cell(9,5,"1", 1, 0, 'L');
		$this->objRprt->Cell(65,5,"2", 1, 0, 'L');
		$this->objRprt->Cell(35,5,"3", 1, 0, 'L');
		$this->objRprt->Cell(30,5,"4", 1, 0, 'C');
		$this->objRprt->Cell(30,5,"5", 1, 0, 'C');
		$this->objRprt->Cell(30,5,"6", 1, 0, 'C');
		$this->objRprt->Cell(30,5,"7", 1, 0, 'R');
		$this->objRprt->Cell(30,5,"8", 1, 0, 'R');
		$this->objRprt->Cell(30,5,"9", 1, 0, 'C');
		$this->objRprt->Cell(30,5,"10", 1, 1, 'C');	
	}
	
	function generateReport()
	{
		$this->objRprt = new ReportLongevityPay('L','mm', 'Legal');
		
		$strMonthName = $this->intToMonthFull($_SESSION['sesCshrMonth']);
		$this->objRprt->setMonthYear($strMonthName, $_SESSION['sesCshrYear']);
		$this->objRprt->setOfficeInfo($t_OfficeName, $t_OfficeAdd, $t_OfficeTelNum);
		
		$this->objRprt->SetLeftMargin(20);
		$this->objRprt->SetRightMargin(20);
		$this->objRprt->SetTopMargin(15);
		$this->objRprt->SetAutoPageBreak("on", 50);
		$this->objRprt->Open();
		$this->objRprt->AliasNbPages();
		$this->objRprt->AddPage();
		$this->printBody();
		$this->objRprt->Output();	
	}
}
?>