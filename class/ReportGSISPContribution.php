<?
define('FPDF_FONTPATH','../hrmis/class/font/');
require_once('../hrmis/class/fpdf.php');

class ReportGSISPContribution extends FPDF
{
	//Page header
	function Header()
	{	
		$this->SetFont('Arial','B',14);
		$this->Cell(0,0,'REMITTANCE LIST OF PREMIUM CONTRIBUTION', 0, 0, 'C');
		$this->Ln(5);
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
				
		$this->SetFont('Arial','',8);
		$this->SetFillColor(200,200,200);
		$this->Cell(5,5,'', 'LTR', 0, 'L',1);
		$this->Cell(30,5,'', 'LTR', 0, 'C',1);
		$this->Cell(15,5,'', 'LTR', 0, 'C',1);
		$this->Cell(20,5,'', 'LTR', 0, 'C',1);		
		$this->Cell(20,5,'', 'LTR', 0, 'C',1);		
		$this->Cell(90,5,'Compulsary Contribution for Life and Retirement', 1, 0, 'C',1);
		$this->Cell(15,5,'', 'LTR', 0, 'C',1);
		$this->Cell(45,5,'Optional Life', 'LTR', 0, 'C',1);
		$this->Cell(15,5,'', 'LTR', 0, 'C',1);
		$this->Cell(45,5,'Pre-Need Premium Contribution', 'LTR', 0, 'C',1);
		$this->Cell(0,5,'Remarks', 'LTR', 1, 'C',1);		

		$this->Cell(5,3,'', 'LR', 0, 'L',1);
		$this->Cell(30,3,'', 'LR', 0, 'C',1);
		$this->Cell(15,3,'', 'LR', 0, 'C',1);
		$this->Cell(20,3,'', 'LR', 0, 'C',1);		
		$this->Cell(20,3,'', 'LR', 0, 'C',1);		
		$this->Cell(15,3,'Addl', 'LTR', 0, 'C',1);
		$this->Cell(15,3,'', 'LTR', 0, 'C',1);
		$this->Cell(15,3,'', 'LTR', 0, 'C',1);
		$this->Cell(15,3,'Arrears', 'LTR', 0, 'C',1);
		$this->Cell(15,3,'Arrears', 'LTR', 0, 'C',1);
		$this->Cell(15,3,'Arrears', 'LTR', 0, 'C',1);										
		$this->Cell(15,3,'', 'LR', 0, 'C',1);
		$this->Cell(15,3,'', 'LTR', 0, 'C',1);
		$this->Cell(15,3,'', 'LTR', 0, 'C',1);
		$this->Cell(15,3,'', 'LTR', 0, 'C',1);				
		$this->Cell(15,3,'', 'LR', 0, 'C',1);
		$this->Cell(30,3,'Memorila', 1, 0, 'C',1);
		$this->Cell(15,3,'', 'LTR', 0, 'C',1);		
		$this->Cell(0,3,'', 'LR', 1, 'C',1);		

		$this->Cell(5,3,'', 'LR', 0, 'L',1);
		$this->Cell(30,3,'', 'LR', 0, 'C',1);
		$this->Cell(15,3,'', 'LR', 0, 'C',1);
		$this->Cell(20,3,'', 'LR', 0, 'C',1);		
		$this->Cell(20,3,'', 'LR', 0, 'C',1);		
		$this->Cell(15,3,'Premium', 'LR', 0, 'C',1);
		$this->Cell(15,3,'', 'LR', 0, 'C',1);
		$this->Cell(15,3,'', 'LR', 0, 'C',1);
		$this->Cell(15,3,'Extra', 'LR', 0, 'C',1);
		$this->Cell(15,3,'Personal', 'LR', 0, 'C',1);
		$this->Cell(15,3,'Govt', 'LR', 0, 'C',1);										
		$this->Cell(15,3,'Employee', 'LR', 0, 'C',1);
		$this->Cell(15,3,'', 'LR', 0, 'C',1);
		$this->Cell(15,3,'', 'LR', 0, 'C',1);
		$this->Cell(15,3,'', 'LR', 0, 'C',1);				
		$this->Cell(15,3,'', 'LR', 0, 'C',1);
		$this->Cell(15,3,'', 'LTR', 0, 'C',1);
		$this->Cell(15,3,'', 'LTR', 0, 'C',1);		
		$this->Cell(15,3,'CIGNA', 'LR', 0, 'C',1);		
		$this->Cell(0,3,'', 'LR', 1, 'C',1);		

		$this->Cell(5,3,'', 'LR', 0, 'L',1);
		$this->Cell(30,3,'', 'LR', 0, 'C',1);
		$this->Cell(15,3,'Policy', 'LR', 0, 'C',1);
		$this->Cell(20,3,'Basic', 'LR', 0, 'C',1);		
		$this->Cell(20,3,'', 'LR', 0, 'C',1);		
		$this->Cell(15,3,'on Extra', 'LR', 0, 'C',1);
		$this->Cell(15,3,'Personal', 'LR', 0, 'C',1);
		$this->Cell(15,3,'Govt', 'LR', 0, 'C',1);
		$this->Cell(15,3,'Hazard', 'LR', 0, 'C',1);
		$this->Cell(15,3,'Share', 'LR', 0, 'C',1);
		$this->Cell(15,3,'Share', 'LR', 0, 'C',1);										
		$this->Cell(15,3,'Compen', 'LR', 0, 'C',1);
		$this->Cell(15,3,'', 'LR', 0, 'C',1);
		$this->Cell(15,3,'', 'LR', 0, 'C',1);
		$this->Cell(15,3,'', 'LR', 0, 'C',1);				
		$this->Cell(15,3,'EDU', 'LR', 0, 'C',1);
		$this->Cell(15,3,'', 'LR', 0, 'C',1);
		$this->Cell(15,3,'', 'LR', 0, 'C',1);		
		$this->Cell(15,3,'Family', 'LR', 0, 'C',1);		
		$this->Cell(0,3,'', 'LR', 1, 'C',1);

		$this->Cell(5,3,'#', 'LR', 0, 'L',1);
		$this->Cell(30,3,'Employee Name', 'LR', 0, 'C',1);
		$this->Cell(15,3,'Number', 'LR', 0, 'C',1);
		$this->Cell(20,3,'Salary', 'LR', 0, 'C',1);		
		$this->Cell(20,3,'Postion', 'LR', 0, 'C',1);		
		$this->Cell(15,3,'Hazardous', 'LR', 0, 'C',1);
		$this->Cell(15,3,'Share', 'LR', 0, 'C',1);
		$this->Cell(15,3,'Share', 'LR', 0, 'C',1);
		$this->Cell(15,3,'Month', 'LR', 0, 'C',1);
		$this->Cell(15,3,'Month', 'LR', 0, 'C',1);
		$this->Cell(15,3,'Month', 'LR', 0, 'C',1);										
		$this->Cell(15,3,'sation', 'LR', 0, 'C',1);
		$this->Cell(15,3,'UOLI', 'LR', 0, 'C',1);
		$this->Cell(15,3,'CEAP', 'LR', 0, 'C',1);
		$this->Cell(15,3,'HIP', 'LR', 0, 'C',1);				
		$this->Cell(15,3,'CHILD', 'LR', 0, 'C',1);
		$this->Cell(15,3,'Paz', 'LR', 0, 'C',1);
		$this->Cell(15,3,'Prudential', 'LR', 0, 'C',1);		
		$this->Cell(15,3,'Hospitali', 'LR', 0, 'C',1);		
		$this->Cell(0,3,'', 'LR', 1, 'C',1);				

		$this->Cell(5,3,'', 'LBR', 0, 'L',1);
		$this->Cell(30,3,'', 'LBR', 0, 'C',1);
		$this->Cell(15,3,'', 'LBR', 0, 'C',1);
		$this->Cell(20,3,'', 'LBR', 0, 'C',1);		
		$this->Cell(20,3,'', 'LBR', 0, 'C',1);		
		$this->Cell(15,3,'Positions', 'LBR', 0, 'C',1);
		$this->Cell(15,3,'', 'LBR', 0, 'C',1);
		$this->Cell(15,3,'', 'LBR', 0, 'C',1);
		$this->Cell(15,3,'Due', 'LBR', 0, 'C',1);
		$this->Cell(15,3,'Due', 'LBR', 0, 'C',1);
		$this->Cell(15,3,'Due', 'LBR', 0, 'C',1);										
		$this->Cell(15,3,'', 'LBR', 0, 'C',1);
		$this->Cell(15,3,'', 'LBR', 0, 'C',1);
		$this->Cell(15,3,'', 'LBR', 0, 'C',1);
		$this->Cell(15,3,'', 'LBR', 0, 'C',1);				
		$this->Cell(15,3,'', 'LBR', 0, 'C',1);
		$this->Cell(15,3,'', 'LBR', 0, 'C',1);
		$this->Cell(15,3,'', 'LBR', 0, 'C',1);		
		$this->Cell(15,3,'zation', 'LBR', 0, 'C',1);		
		$this->Cell(0,3,'', 'LBR', 1, 'C',1);				
		
	}
	
	//Page footer
	function Footer()
	{	
		$this->SetY(-60);   // gray total
		$this->SetFillColor(200,200,200);
		$this->SetFont('Arial','B',8);
		$this->Cell(90,3,'Page Total:', 1, 0, 'R',1);		
		$this->Cell(15,3,'', 1, 0, 'R',1);
		$this->Cell(15,3,'40,149.00', 1, 0, 'R',1);
		$this->Cell(15,3,'26,766.00', 1, 0, 'R',1);
		$this->Cell(15,3,'', 1, 0, 'R',1);
		$this->Cell(15,3,'', 1, 0, 'R',1);
		$this->Cell(15,3,'', 1, 0, 'R',1);										
		$this->Cell(15,3,'', 1, 0, 'R',1);
		$this->Cell(15,3,'6,229.86', 1, 0, 'R',1);
		$this->Cell(15,3,'0.00', 1, 0, 'R',1);
		$this->Cell(15,3,'0.00', 1, 0, 'R',1);				
		$this->Cell(15,3,'0.00', 1, 0, 'R',1);
		$this->Cell(15,3,'', 1, 0, 'R',1);
		$this->Cell(15,3,'442.00', 1, 0, 'R',1);		
		$this->Cell(15,3,'1,134.00', 1, 0, 'R',1);		
		$this->Cell(0,3,'', 1, 1, 'R',1);

		$this->SetFillColor(150,150,150);
		$this->SetFont('Arial','B',8);
		$this->Cell(90,3,'Grand Total:', 1, 0, 'R',1);		
		$this->Cell(15,3,'', 1, 0, 'R',1);
		$this->Cell(15,3,'40,149.00', 1, 0, 'R',1);
		$this->Cell(15,3,'26,766.00', 1, 0, 'R',1);
		$this->Cell(15,3,'', 1, 0, 'R',1);
		$this->Cell(15,3,'', 1, 0, 'R',1);
		$this->Cell(15,3,'', 1, 0, 'R',1);										
		$this->Cell(15,3,'', 1, 0, 'R',1);
		$this->Cell(15,3,'6,229.86', 1, 0, 'R',1);
		$this->Cell(15,3,'0.00', 1, 0, 'R',1);
		$this->Cell(15,3,'0.00', 1, 0, 'R',1);				
		$this->Cell(15,3,'0.00', 1, 0, 'R',1);
		$this->Cell(15,3,'', 1, 0, 'R',1);
		$this->Cell(15,3,'442.00', 1, 0, 'R',1);		
		$this->Cell(15,3,'1,134.00', 1, 0, 'R',1);		
		$this->Cell(0,3,'', 1, 1, 'R',1);

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