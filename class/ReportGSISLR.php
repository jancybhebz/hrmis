<?
require_once("../hrmis/class/General.php");
require_once("../hrmis/class/Constant.php");
require_once('../hrmis/class/ReportGSISLRemmitance.php');

class ReportGSISLR extends General
{
	var $objRprt;
	
	function printBody()
	{
		$this->objRprt->SetFont('Arial','',10);
		$this->objRprt->Cell(5,5,'1', 1, 0, 'L');
		$this->objRprt->Cell(65,5,'ABDON, BOB', 1, 0, 'L');
		$this->objRprt->Cell(40,5,'CM 365184', 1, 0, 'L');
		$this->objRprt->Cell(30,5,'1,350.84', 1, 0, 'R');
		$this->objRprt->Cell(30,5,'50.00', 1, 0, 'R');
		$this->objRprt->Cell(30,5,'', 1, 0, 'C');
		$this->objRprt->Cell(40,5,'', 1, 0, 'C');
		$this->objRprt->Cell(40,5,'1,400.84', 1, 0, 'L');
		$this->objRprt->Cell(35,5,'', 1, 1, 'L');	

//----------------------------------------------------------------------------------
		$this->objRprt->Cell(5,5,'1', 1, 0, 'L');
		$this->objRprt->Cell(65,5,'ABDON, BOB', 1, 0, 'L');
		$this->objRprt->Cell(40,5,'CM 365184', 1, 0, 'L');
		$this->objRprt->Cell(30,5,'1,350.84', 1, 0, 'R');
		$this->objRprt->Cell(30,5,'50.00', 1, 0, 'R');
		$this->objRprt->Cell(30,5,'', 1, 0, 'C');
		$this->objRprt->Cell(40,5,'', 1, 0, 'C');
		$this->objRprt->Cell(40,5,'1,400.84', 1, 0, 'L');
		$this->objRprt->Cell(35,5,'', 1, 1, 'L');	
		$this->objRprt->Cell(5,5,'1', 1, 0, 'L');
		$this->objRprt->Cell(65,5,'ABDON, BOB', 1, 0, 'L');
		$this->objRprt->Cell(40,5,'CM 365184', 1, 0, 'L');
		$this->objRprt->Cell(30,5,'1,350.84', 1, 0, 'R');
		$this->objRprt->Cell(30,5,'50.00', 1, 0, 'R');
		$this->objRprt->Cell(30,5,'', 1, 0, 'C');
		$this->objRprt->Cell(40,5,'', 1, 0, 'C');
		$this->objRprt->Cell(40,5,'1,400.84', 1, 0, 'L');
		$this->objRprt->Cell(35,5,'', 1, 1, 'L');	
		$this->objRprt->Cell(5,5,'1', 1, 0, 'L');
		$this->objRprt->Cell(65,5,'ABDON, BOB', 1, 0, 'L');
		$this->objRprt->Cell(40,5,'CM 365184', 1, 0, 'L');
		$this->objRprt->Cell(30,5,'1,350.84', 1, 0, 'R');
		$this->objRprt->Cell(30,5,'50.00', 1, 0, 'R');
		$this->objRprt->Cell(30,5,'', 1, 0, 'C');
		$this->objRprt->Cell(40,5,'', 1, 0, 'C');
		$this->objRprt->Cell(40,5,'1,400.84', 1, 0, 'L');
		$this->objRprt->Cell(35,5,'', 1, 1, 'L');	
		$this->objRprt->Cell(5,5,'1', 1, 0, 'L');
		$this->objRprt->Cell(65,5,'ABDON, BOB', 1, 0, 'L');
		$this->objRprt->Cell(40,5,'CM 365184', 1, 0, 'L');
		$this->objRprt->Cell(30,5,'1,350.84', 1, 0, 'R');
		$this->objRprt->Cell(30,5,'50.00', 1, 0, 'R');
		$this->objRprt->Cell(30,5,'', 1, 0, 'C');
		$this->objRprt->Cell(40,5,'', 1, 0, 'C');
		$this->objRprt->Cell(40,5,'1,400.84', 1, 0, 'L');
		$this->objRprt->Cell(35,5,'', 1, 1, 'L');	
		$this->objRprt->Cell(5,5,'1', 1, 0, 'L');
		$this->objRprt->Cell(65,5,'ABDON, BOB', 1, 0, 'L');
		$this->objRprt->Cell(40,5,'CM 365184', 1, 0, 'L');
		$this->objRprt->Cell(30,5,'1,350.84', 1, 0, 'R');
		$this->objRprt->Cell(30,5,'50.00', 1, 0, 'R');
		$this->objRprt->Cell(30,5,'', 1, 0, 'C');
		$this->objRprt->Cell(40,5,'', 1, 0, 'C');
		$this->objRprt->Cell(40,5,'1,400.84', 1, 0, 'L');
		$this->objRprt->Cell(35,5,'', 1, 1, 'L');	
		$this->objRprt->Cell(5,5,'1', 1, 0, 'L');
		$this->objRprt->Cell(65,5,'ABDON, BOB', 1, 0, 'L');
		$this->objRprt->Cell(40,5,'CM 365184', 1, 0, 'L');
		$this->objRprt->Cell(30,5,'1,350.84', 1, 0, 'R');
		$this->objRprt->Cell(30,5,'50.00', 1, 0, 'R');
		$this->objRprt->Cell(30,5,'', 1, 0, 'C');
		$this->objRprt->Cell(40,5,'', 1, 0, 'C');
		$this->objRprt->Cell(40,5,'1,400.84', 1, 0, 'L');
		$this->objRprt->Cell(35,5,'', 1, 1, 'L');	
		$this->objRprt->Cell(5,5,'1', 1, 0, 'L');
		$this->objRprt->Cell(65,5,'ABDON, BOB', 1, 0, 'L');
		$this->objRprt->Cell(40,5,'CM 365184', 1, 0, 'L');
		$this->objRprt->Cell(30,5,'1,350.84', 1, 0, 'R');
		$this->objRprt->Cell(30,5,'50.00', 1, 0, 'R');
		$this->objRprt->Cell(30,5,'', 1, 0, 'C');
		$this->objRprt->Cell(40,5,'', 1, 0, 'C');
		$this->objRprt->Cell(40,5,'1,400.84', 1, 0, 'L');
		$this->objRprt->Cell(35,5,'', 1, 1, 'L');	
		$this->objRprt->Cell(5,5,'1', 1, 0, 'L');
		$this->objRprt->Cell(65,5,'ABDON, BOB', 1, 0, 'L');
		$this->objRprt->Cell(40,5,'CM 365184', 1, 0, 'L');
		$this->objRprt->Cell(30,5,'1,350.84', 1, 0, 'R');
		$this->objRprt->Cell(30,5,'50.00', 1, 0, 'R');
		$this->objRprt->Cell(30,5,'', 1, 0, 'C');
		$this->objRprt->Cell(40,5,'', 1, 0, 'C');
		$this->objRprt->Cell(40,5,'1,400.84', 1, 0, 'L');
		$this->objRprt->Cell(35,5,'', 1, 1, 'L');	
		$this->objRprt->Cell(5,5,'1', 1, 0, 'L');
		$this->objRprt->Cell(65,5,'ABDON, BOB', 1, 0, 'L');
		$this->objRprt->Cell(40,5,'CM 365184', 1, 0, 'L');
		$this->objRprt->Cell(30,5,'1,350.84', 1, 0, 'R');
		$this->objRprt->Cell(30,5,'50.00', 1, 0, 'R');
		$this->objRprt->Cell(30,5,'', 1, 0, 'C');
		$this->objRprt->Cell(40,5,'', 1, 0, 'C');
		$this->objRprt->Cell(40,5,'1,400.84', 1, 0, 'L');
		$this->objRprt->Cell(35,5,'', 1, 1, 'L');	
		$this->objRprt->Cell(5,5,'1', 1, 0, 'L');
		$this->objRprt->Cell(65,5,'ABDON, BOB', 1, 0, 'L');
		$this->objRprt->Cell(40,5,'CM 365184', 1, 0, 'L');
		$this->objRprt->Cell(30,5,'1,350.84', 1, 0, 'R');
		$this->objRprt->Cell(30,5,'50.00', 1, 0, 'R');
		$this->objRprt->Cell(30,5,'', 1, 0, 'C');
		$this->objRprt->Cell(40,5,'', 1, 0, 'C');
		$this->objRprt->Cell(40,5,'1,400.84', 1, 0, 'L');
		$this->objRprt->Cell(35,5,'', 1, 1, 'L');	
//----------------------------------------------------------------------------------				
	}
	
	function generateReport()
	{
		$this->objRprt = new ReportGSISLRemmitance('L','mm', 'Legal');

		$this->objRprt->SetLeftMargin(20);
		$this->objRprt->SetRightMargin(20);
		$this->objRprt->SetTopMargin(15);
		$this->objRprt->SetAutoPageBreak("on", 60);
		$this->objRprt->Open();
		$this->objRprt->AddPage();
		$this->printBody();	
		$this->objRprt->Output();	
	}
}
?>