<?
define('FPDF_FONTPATH','../hrmis/class/font/');
require('../hrmis/class/fpdf.php');

class Profile 
{

	function PersonalDataSheet()
	{
		$objPDS = new FPDF;	
		$objPDS->Open();
		$objPDS->AliasNbPages();
		$objPDS->addPage();
		$objPDS->SetFont('Arial','',7);
		$objPDS->Cell(0,10,"CS Form 212 (Revised 2003)",0,0,'L');
		$objPDS->Ln(3);
		$objPDS->SetFont('Arial','B',20);
		$objPDS->Cell(0,25,"PERSONAL DATA SHEET",1,0,'C');
		$objPDS->Ln(5);
		$objPDS->SetFont('Arial','',7);
		$objPDS->Cell(0,35,"Print legibly. Mark approriate boxed",0,0,'L');
		$objPDS->Ln(20);
		//Colors of frame, background and text
		$objPDS->SetDrawColor(170);
		$objPDS->SetFillColor(110);
		$objPDS->SetTextColor(150);
		$objPDS->SetLineWidth(1);
		$objPDS->SetFont('Arial','I',10);
		$objPDS->Cell(0,6,"I. PERSONAL INFORMATION",1,0,'L',1);
		$objPDS->Ln(5);
		//Text color in gray
		$objPDS->SetDrawColor(0);		
		$objPDS->SetFillColor(5);
		$objPDS->SetTextColor(75);
		$objPDS->SetLineWidth(1);
		$objPDS->SetFont('Arial','B',8);
		$objPDS->Cell(0,6,"1.     SURNAME ",0,0,'L');
		$objPDS->Ln(5);
		//Text color in gray
		$objPDS->SetFont('Arial','B',8);
		$objPDS->Cell(0,6,"        FIRST NAME ",0,0,'L');
		$objPDS->Ln(5);
		//Text color in gray
		$objPDS->SetFont('Arial','B',8);
		$objPDS->Cell(0,6,"        MIDDLE NAME ",0,0,'L');
		$objPDS->Ln(5);
		//Text color in gray
		$objPDS->SetFont('Arial','B',8);
		$objPDS->Cell(0,6,"2.     DATE OF BIRTH ",0,0,'L');
		$objPDS->Ln(5);
		//Text color in gray
		$objPDS->SetFont('Arial','B',8);
		$objPDS->Cell(0,6,"3.     PLACE OF BIRTH ",0,0,'L');
		$objPDS->Ln(5);                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
		//Text color in gray
		$objPDS->SetFont('Arial','B',8);
		$objPDS->Cell(0,6,"4.     SEX ",0,0,'L');
		$objPDS->Ln(5);
		//Text color in gray
		$objPDS->SetFont('Arial','B',8);
		$objPDS->Cell(0,6,"5.     CIVIL STATUS ",0,0,'L');
		$objPDS->Ln(5);
		//Text color in gray
		$objPDS->SetFont('Arial','B',8);
		$objPDS->Cell(0,6,"6.     CITIZENSHIP ",0,0,'L');
		$objPDS->Ln(5);
		//Text color in gray
		$objPDS->SetFont('Arial','B',8);
		$objPDS->Cell(0,6,"7.     HEIGHT (m) ",0,0,'L');
		$objPDS->Ln(5);
		//Text color in gray
		$objPDS->SetFont('Arial','B',8);
		$objPDS->Cell(0,6,"8.     WEIGHT (kg) ",0,0,'L');
		$objPDS->Ln(5);
		//Text color in gray
		$objPDS->SetFont('Arial','B',8);
		$objPDS->Cell(0,6,"9.     BLOOD TYPE ",0,0,'L');
		$objPDS->Ln(5);
		//Text color in gray
		$objPDS->SetFont('Arial','B',8);
		$objPDS->Cell(0,6,"10.   GSIS POLICY NO. ",0,0,'L');
		$objPDS->Ln(5);
		//Text color in gray
		$objPDS->SetFont('Arial','B',8);
		$objPDS->Cell(0,6,"11.   PAG-IBIG ID NO. ",0,0,'L');
		$objPDS->Ln(5);
		//Text color in gray
		$objPDS->SetFont('Arial','B',8);
		$objPDS->Cell(0,6,"12.   PHILHEALTH NO. ",0,0,'L');
		$objPDS->Ln(5);
		//Colors of frame, background and text
		$objPDS->SetDrawColor(170);
		$objPDS->SetFillColor(110);
		$objPDS->SetTextColor(150);
		$objPDS->SetLineWidth(1);
		$objPDS->SetFont('Arial','I',10);
		$objPDS->Cell(0,5,"II. FAMILY BACKGROUND",0,0,'L',1);
		$objPDS->Ln(5);
		//Text color in gray
		$objPDS->SetFont('Arial','B',8);
		$objPDS->Cell(0,6,"21.   NAME OF SPOUSE. ",0,0,'L');
		$objPDS->Ln(5);
		//Text color in gray
		$objPDS->SetFont('Arial','B',8);
		$objPDS->Cell(0,6,"        OCCUPATION ",0,0,'L');
		$objPDS->Ln(5);
		//Text color in gray
		$objPDS->SetFont('Arial','B',8);
		$objPDS->Cell(0,6,"        EMPLOYER/BUS. NAME ",0,0,'L');
		$objPDS->Ln(5);
		//Text color in gray
		$objPDS->SetFont('Arial','B',8);
		$objPDS->Cell(0,6,"        BUSINESS ADDRESS ",0,0,'L');
		$objPDS->Ln(5);
		//Text color in gray
		$objPDS->SetFont('Arial','B',8);
		$objPDS->Cell(0,6,"        TELEPHONE NO. ",0,0,'L');
		$objPDS->Ln(5);
		//Text color in gray
		$objPDS->SetFont('Arial','B',8);
		$objPDS->Cell(0,6,"22.   NAME OF CHILDREN",0,0,'L');
		$objPDS->Ln(5);
		//Text color in gray
		$objPDS->SetFont('Arial','B',8);
		$objPDS->Cell(0,6,"23.   NAME OF FATHER ",0,0,'L');
		$objPDS->Ln(5);
		//Text color in gray
		$objPDS->SetFont('Arial','B',8);
		$objPDS->Cell(0,6,"25.   PARENT ADDRESS ",0,0,'L');
		$objPDS->Ln(5);
		//Colors of frame, background and text
		$objPDS->SetDrawColor(170);
		$objPDS->SetFillColor(110);
		$objPDS->SetTextColor(150);
		$objPDS->SetLineWidth(1);
		$objPDS->SetFont('Arial','I',10);
		$objPDS->Cell(0,5,"III. EDUCATIONAL BACKGROUND",0,0,'L',1);
		$objPDS->Ln(5);
		//Text color in gray
		$objPDS->SetFont('Arial','B',8);
		$objPDS->Cell(0,6,"26.   ",0,0,'L');
		$objPDS->Ln(10);
		//Colors of frame, background and text
		$objPDS->SetDrawColor(170);
		$objPDS->SetFillColor(110);
		$objPDS->SetTextColor(150);
		$objPDS->SetLineWidth(1);
		$objPDS->SetFont('Arial','I',10);
		$objPDS->Cell(0,5,"IV. CIVIL SERVICE ELIGIBILITY",0,0,'L',1);
		$objPDS->Ln(30);
		//Colors of frame, background and text
		$objPDS->SetDrawColor(170);
		$objPDS->SetFillColor(110);
		$objPDS->SetTextColor(150);
		$objPDS->SetLineWidth(1);
		$objPDS->SetFont('Arial','I',10);
		$objPDS->Cell(0,5,"V. WORK EXPERIENCE (include private employment start from most recent work experience.)",0,0,'L',1);
		$objPDS->Ln(30);
		//Colors of frame, background and text
		$objPDS->SetDrawColor(170);
		$objPDS->SetFillColor(110);
		$objPDS->SetTextColor(150);
		$objPDS->SetLineWidth(1);
		$objPDS->SetFont('Arial','I',10);
		$objPDS->Cell(0,5,"VI. VOLUNTARY WORK OR INVOLVEMENT IN CIVIC / NON-GOVERNMENT / PEOPLE / ORGANIZATIONS",0,0,'L',1);
		$objPDS->Ln(30);
		//Colors of frame, background and text
		$objPDS->SetDrawColor(170);
		$objPDS->SetFillColor(110);
		$objPDS->SetTextColor(150);
		$objPDS->SetLineWidth(1);
		$objPDS->SetFont('Arial','I',10);
		$objPDS->Cell(0,5,"VII. TRAINING PROGRAMS / STUDY / SCHOLARSHIP GRANTS (starts from the most recent training)",0,0,'L',1);
		$objPDS->Ln(30);
		//Colors of frame, background and text
		$objPDS->SetDrawColor(170);
		$objPDS->SetFillColor(110);
		$objPDS->SetTextColor(150);
		$objPDS->SetLineWidth(1);
		$objPDS->SetFont('Arial','I',10);
		$objPDS->Cell(0,5,"VII. OTHER INFORMATION",0,0,'L',1);
		$objPDS->Ln(30);
		$objPDS->Output();
	}

}
?>