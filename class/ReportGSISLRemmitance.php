<?
define('FPDF_FONTPATH','../hrmis/class/font/');
require_once('../hrmis/class/fpdf.php');

class ReportGSISLRemmitance extends FPDF
{
	//Page header
	function Header()
	{	
		$this->SetFont('Arial','B',14);
		$this->Cell(0,0,'REMITTANCE OF SERVICE LOAN ACCOUNTS', 0, 0, 'C');
		$this->Ln(7);
		$this->SetFont('Arial','',12);
		$this->Cell(0,2,'For the month of June 2003', 0, 0, 'C');		
		$this->Ln(5);
		
		$this->SetFont('Arial','',11);
		$this->Cell(0,2,'Page 1 of 4', 0, 0, 'R');		
		$this->Ln(5);
				
		$this->SetFont('Arial','',11);
		$this->Cell(30,2,'Office Name: ', 0, 0, 'L');
		$this->SetFont('Arial','U',11);
		$this->Cell(0,2,'SCIENCE AND TECHNOLOGY INFORMATION INSTITUE', 0, 0, 'L');
		$this->Ln(5);
		
		$this->SetFont('Arial','',11);
		$this->Cell(30,2,'Office Address: ', 0, 0, 'L');
		$this->SetFont('Arial','U',11);
		$this->Cell(0,2,'DOST Compound, Gen. Santos Ave., Bicutan, Taguig, Metro Manila', 0, 0, 'L');
		$this->Ln(5);

		$this->SetFont('Arial','',11);
		$this->Cell(30,2,'Office Tel. No.: ', 0, 0, 'L');
		$this->SetFont('Arial','U',11);
		$this->Cell(0,2,'837-21-91', 0, 0, 'L');				
		$this->Ln(10);
				
		$this->SetFont('Arial','',10);
		$this->SetFillColor(200,200,200);
		$this->Cell(5,5,'#', 'LTR', 0, 'L',1);
		$this->Cell(65,5,'Employee Name', 'LTR', 0, 'C',1);
		$this->Cell(40,5,'Policy No.', 'LTR', 0, 'C',1);
		$this->Cell(90,5,'REPAYMENT ON SERVICE LOAN ACCOUNTS', 1, 0, 'C',1);
		$this->Cell(40,5,'Repayments on optional', 'LTR', 0, 'C',1);
		$this->Cell(40,5,'Sub-Totals', 'LTR', 0, 'C',1);
		$this->Cell(35,5,'Remarks', 'LTR', 1, 'C',1);

		$this->Cell(5,5,'', 'LBR', 0, 'L',1);
		$this->Cell(65,5,'', 'LBR', 0, 'L',1);
		$this->Cell(40,5,'', 'LBR', 0, 'L',1);
		$this->Cell(30,5,'Salary', 1, 0, 'C',1);
		$this->Cell(30,5,'Policy', 1, 0, 'C',1);
		$this->Cell(30,5,'Emergency', 1, 0, 'C',1);				
		$this->Cell(40,5,'policy loan accounts', 'LBR', 0, 'C',1);
		$this->Cell(40,5,'', 'LBR', 0, 'L',1);
		$this->Cell(35,5,'', 'LBR', 1, 'L',1);
	}
	
	//Page footer
	function Footer()
	{	
		$this->SetY(-60);   // gray total
		$this->SetFillColor(200,200,200);
		$this->SetFont('Arial','B',10);
		$this->Cell(110,5,'Page Total:', 1, 0, 'R',1);
		$this->Cell(30,5,'118,437.00', 1, 0, 'R',1);
		$this->Cell(30,5,'59,217.00', 1, 0, 'R',1);
		$this->Cell(30,5,'0.00', 1, 0, 'R',1);
		$this->Cell(40,5,'', 1, 0, 'R',1);
		$this->Cell(40,5,'28,072.00', 1, 0, 'R',1);
		$this->Cell(30,5,'', 1, 1, 'R',1);

		$this->SetFillColor(150,150,150);
		$this->SetFont('Arial','B',10);
		$this->Cell(110,5,'Grand Total:', 1, 0, 'R',1);
		$this->Cell(30,5,'118,437.00', 1, 0, 'R',1);
		$this->Cell(30,5,'59,217.00', 1, 0, 'R',1);
		$this->Cell(30,5,'0.00', 1, 0, 'R',1);
		$this->Cell(40,5,'', 1, 0, 'R',1);
		$this->Cell(40,5,'28,072.00', 1, 0, 'R',1);
		$this->Cell(30,5,'', 1, 0, 'R',1);
		$this->Ln(15);
			
		$this->SetFont('Arial','',11);
		$this->Cell(30);
		$this->Cell(130,5,'Prepared by:', 0, 0, 'L');
		$this->Cell(130,5,'Certified correct:', 0, 0, 'L');
		$this->Ln(10);

		$this->SetFont('Arial','B',11);
		$this->Cell(30);
		$this->Cell(70, 5, 'ZENAIDA C. SANTOS', 0, 0, 'C');
		$this->Cell(60);
		$this->Cell(70, 5, 'DIANA A. BUCAO', 0, 0, 'C');
		$this->Ln(4);
		
		$this->SetFont('Arial','B',11);
		$this->Cell(30);
		$this->Cell(70, 5, 'Cashier III', 0, 0, 'C');
		$this->Cell(60);
		$this->Cell(70, 5, 'Accountant III', 0, 0, 'C');
		$this->Ln(4);
	}
}
?>