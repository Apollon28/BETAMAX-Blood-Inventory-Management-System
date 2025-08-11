<?php

// Include the main TCPDF library (search for installation path).
require_once('TCPDF-main/tcpdf.php');

// extend TCPDF with custom functions
class MYPDF extends TCPDF {

    // Load data from file
    public function LoadData($userID) {
        include 'connect.php';
        $select = "SELECT * FROM customerdetails WHERE userID = $userID";
        $query = mysqli_query($conn, $select);

        if (!$query) {
            die("Error: " . mysqli_error($conn));
        }

        $data = []; // Initialize $data as an empty array

        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }

        return $data;
    }

    // Print customer details
    public function PrintCustomerDetails($data) {
        $this->SetFont('helvetica', '', 12);
        foreach ($data as $row) {
            $this->Cell(90, 10, 'Name: ' . $row['customerName'], 0, 0, 'L');
            $this->Cell(90, 10, 'Date of Birth: ' . $row['dateofbirth'], 0, 1, 'L');
            $this->Cell(90, 10, 'Gender: ' . $row['gender'], 0, 0, 'L');
            $this->Cell(90, 10, 'Occupation: ' . $row['occupation'], 0, 1, 'L');
            $this->Cell(90, 10, 'Current Address: ' . $row['currentaddress'], 0, 0, 'L');
            $this->Cell(90, 10, 'Permanent Address: ' . $row['permanentaddress'], 0, 1, 'L');
            $this->Cell(90, 10, 'Tel/Mob No.: ' . $row['number'], 0, 0, 'L');
            $this->Cell(90, 10, 'Email Address: ' . $row['email'], 0, 1, 'L');
            $this->Cell(90, 10, 'Donor No.: ' . $row['donorno'], 0, 1, 'L');
            $this->Ln(20);
        }
    }
}

// Get customer ID from session or request
session_start();
$id = isset($_SESSION['userID']) ? $_SESSION['userID'] : 1; // Default to 1 if not set, adjust as needed

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 011');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// add a page
$pdf->AddPage();

// data loading
$data = $pdf->LoadData($id);

// Ensure $data is an array before calling PrintCustomerDetails
if (!is_array($data)) {
    $data = [];
}

// print customer details
$pdf->PrintCustomerDetails($data);

// ---------------------------------------------------------

// close and output PDF document
$pdf->Output('pdf.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>
