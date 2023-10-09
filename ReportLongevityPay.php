<?
session_cache_limiter('private_no_expire'); 
//require('../hrmis/PersonalPDSForm.php');
define('FPDF_FONTPATH','../hrmis/class/font/');
require('../hrmis/class/fpdf.php');
//require('fpdf.php');

class ReportLongevityPay extends FPDF
{
	
	//Page header
	function Header()
	{	
		$this->SetFont('Arial','',9);
		$this->Cell(0,0,'SCIENCE AND TECHNOLOGY INFORMATION INSTITUTE', 0, 0, 'C');
		$this->Ln(4);
		$this->SetFont('Arial','B',12);
		$this->Cell(0,2,'LONGEVITY PAY FOR THE MONTH OF May 2004', 0, 0, 'C');		
		$this->SetFont('Arial','',9);
		$this->Ln(5);
		$this->Cell(0,2,'PER R.A. 8439(MAGNA CARTA FOR S&T PERSONNEL)', 0, 0, 'C');
		$this->Ln(5);
		$this->Cell(0,2,'(BASED ON NEW SALARY SCHEDULE PURSUANT TO NBC 474 IMPLEMENTING RA 9137)', 0, 0, 'C');
		$this->Ln(5);
		
		$this->SetFont(Arial,'',10);
		$this->Cell(50,10," ",'LTR',0,C);
		$this->Cell(30,10," ",'LTR',0,C);
		$this->Cell(10,10," ",'LTR',0,C);
		$this->Cell(25,10,"PRESENT",'LTR',0,C);
		$this->Cell(45,10," ",'LTR',0,C);
		$this->Cell(10,10,"No.",'LTR',0,C);
		$this->Cell(140,10,"CONTINOUS & MERITORIOUS GOVERNMENT SERVICE",'LTR',0,C);
		$this->Cell(25,10,"MONTHLY",'LTR',0,C);
		$this->Ln(5);
		$this->SetFont(Arial,'',10);
		$this->Cell(50,10,"",0,0,C);
		$this->Cell(30,10," ",0,0,C);
		$this->Cell(10,10," ",0,0,C);
		$this->Cell(25,10,"MONTHLY",0,0,C);
		$this->Cell(45,10,"PERIOD ",0,0,C);
		$this->Cell(10,10,"OF",0,0,C);
		$this->Cell(140,10,"(5% OF MONTHLY SALARY FOR EVERY 5 YEARS) W/ VERY SATISFACTORY PERFORMANCE RATING",0,0,C);
		$this->Cell(25,10,"LONGEVITY",0,0,C);
		
	}
	
		
	//Page footer
	/*function Footer()
	{	
		$this->SetY(-50);   // gray total
		$this->SetFillColor(200,200,200);
		$this->SetFont('Arial','B',10);
		$this->Cell(229,5,'Page Total:', 1, 0, 'R',1);
		$this->Cell(30,5,'', 1, 0, 'R',1);
		$this->Cell(60,5,'', 1, 1, 'L',1);		
		
		
		/*$this->Ln(10);
			
		$this->SetFont('Arial','',11);
		$this->Cell(30);
		$this->Cell(130,5,'Prepared by:', 0, 0, 'L');
		$this->Cell(130,5,'Certified correct:', 0, 0, 'L');
		$this->Ln(10);

		$this->SetFont('Arial','B',11);
		$this->Cell(30);
		
		$this->Cell(70, 5, '', 0, 0, 'C');
		$this->Cell(60);
		
		$this->Cell(70, 5,'', 0, 0, 'C');
		$this->Ln(4);
		
		$this->SetFont('Arial','B',11);
		$this->Cell(30);
		
		//$this->Cell(70, 5,$this->strSgntryTitle, 0, 0, 'C');
		$this->Cell(60);
		
		//$this->Cell(70, 5, $this->strSgntryTitle, 0, 0, 'C');
		$this->Ln(4);
	}*/
} //end of class

$objLP = new ReportLongevityPay('L','mm','Legal');	
$objLP->Open();
$objLP->AddPage();
//$objLP->Header();
//$objLP->Footer();
$objLP->Output();
	
	
?>