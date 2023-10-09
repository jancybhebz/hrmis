<?
require_once("../hrmis/class/General.php");
require_once("../hrmis/class/Constant.php");
require("../hrmis/class/ReportGnralPayrollRegister.php");

class ReportGPBody extends General
{
	var $objRprt;
	var $intCounter = 0;

	// Body
	function printBody()
	{

		$InterLigne = 7;
		
		$this->objRprt->SetFont(Arial,'',9);
		$this->objRprt->Cell(45,$interLigne,"1. (671)",0,0,C);
		$this->objRprt->Cell(60,$interLigne,"Abad, Josefina P.",R,0,L);
		$this->objRprt->Cell(35,$interLigne,"10,971.00",L,0,C);
		$this->objRprt->Cell(30,$interLigne,"2,227.00",R,0,C);
		$this->objRprt->Cell(25,$interLigne,"987.39",L,0,C);
		$this->objRprt->Cell(25,$interLigne,"100.00",0,0,C);
		$this->objRprt->Cell(25,$interLigne,"10.00(UD)",R,0,C);
		$this->objRprt->Cell(35,$interLigne,"2,727.00",0,0,C);
		$this->objRprt->Cell(40,$interLigne,"_____________________",R,0,C);
		$this->objRprt->Ln(25);			

	}
	
	function generateReport()
	{
		$this->objRprt = new ReportGnralPayrollRegister;
		$this->objRprt->setOfficeInfo($t_OfficeName, $t_OfficeAdd, $t_OfficeTelNum);
		
		$this->objRprt->SetLeftMargin(18);
		$this->objRprt->SetRightMargin(15);
		$this->objRprt->SetTopMargin(15);
		$this->objRprt->SetAutoPageBreak("on",25);
		$this->objRprt->AliasNbPages();
		$this->objRprt->Open();
		$this->objRprt->AddPage();
		
		$this->printBody();		
		$this->objRprt->Output();
	}
				

}  // End Class

?>