<?
require_once("../hrmis/class/General.php");
require_once("../hrmis/class/Constant.php");
require_once('../hrmis/class/ReportGSISPContribution.php');

class ReportGSISPC extends General
{
	var $objRprt;
	
	function printBody()
	{
		$this->objRprt->SetFont('Arial','',8);
		$this->objRprt->Cell(5,5,'1', 1, 0, 'L');
		$this->objRprt->Cell(30,5,'ESGUERRA, JOSEPH', 1, 0, 'L');
		$this->objRprt->Cell(15,5,'CM365184', 1, 0, 'L');
		$this->objRprt->Cell(20,5,'7,022.00', 1, 0, 'R');		
		$this->objRprt->Cell(20,5,'Rep Mach Optr', 1, 0, 'L');		
		$this->objRprt->Cell(15,5,'', 1, 0, 'R');
		$this->objRprt->Cell(15,5,'631.98', 1, 0, 'R');
		$this->objRprt->Cell(15,5,'842.64', 1, 0, 'R');
		$this->objRprt->Cell(15,5,'', 1, 0, 'R');
		$this->objRprt->Cell(15,5,'', 1, 0, 'R');
		$this->objRprt->Cell(15,5,'', 1, 0, 'R');										
		$this->objRprt->Cell(15,5,'', 1, 0, 'R');
		$this->objRprt->Cell(15,5,'1,047.00', 1, 0, 'R');
		$this->objRprt->Cell(15,5,'', 1, 0, 'R');
		$this->objRprt->Cell(15,5,'', 1, 0, 'R');				
		$this->objRprt->Cell(15,5,'', 1, 0, 'R');
		$this->objRprt->Cell(15,5,'', 1, 0, 'R');
		$this->objRprt->Cell(15,5,'221.00', 1, 0, 'R');		
		$this->objRprt->Cell(15,5,'168.46', 1, 0, 'R');		
		$this->objRprt->Cell(0,5,'', 1, 1, 'C');		
	}
	
	function generateReport()
	{
		$this->objRprt = new ReportGSISPContribution('L','mm', 'Legal');

		$this->objRprt->SetLeftMargin(15);
		$this->objRprt->SetRightMargin(15);
		$this->objRprt->SetTopMargin(15);
		$this->objRprt->SetAutoPageBreak("on", 60);
		$this->objRprt->Open();
		$this->objRprt->AddPage();
		$this->printBody();	
		$this->objRprt->Output();	
	}
}
?>