<?
require_once("../hrmis/class/General.php");
require_once("../hrmis/class/Constant.php");
require('../hrmis/class/ReportABonus.php');

class ReportAB extends General
{
	var $objRprt;
	function printBody()
	{
//repeat
		$this->objRprt->SetFont('Arial','',9);				
		$this->objRprt->Cell(15,5,'8801', 0, 0, 'L');
		$this->objRprt->Cell(30,5,'Director', 0, 0, 'L');
		$this->objRprt->Cell(50,5,'GUERRERO, JOSE', 0, 0, 'L');
		$this->objRprt->Cell(30,5,'100.00', 0, 0, 'R');
		$this->objRprt->SetFont('Arial','U',11);
		$this->objRprt->Cell(0,5,'                                         ', 0, 1, 'L');
		$this->objRprt->Ln(5);
//repeat
	}
	
	function generateReport()
	{
		$this->objRprt = new ReportABonus('P','mm', 'Letter');

		$this->objRprt->SetLeftMargin(20);
		$this->objRprt->SetRightMargin(20);
		$this->objRprt->SetTopMargin(15);		
		$this->objRprt->SetAutoPageBreak("on", 90);

		$this->objRprt->Open();
		$this->objRprt->AddPage();
		$this->printBody();	
		$this->objRprt->Output();		
	}
}
?>