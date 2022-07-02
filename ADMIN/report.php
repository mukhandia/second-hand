
<?php
require('fpdf/fpdf.php');
include('server/connect.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Amount_Today = $_POST['Amount_Today'];
    $Sales_Today = $_POST['Sales_Today'];

    class PDF extends FPDF
    {
        // Page header
        function Header()
        {
            // GFG logo image
            $this->Image('logo2.jpg', 12, 10, 40, 40);

            // Break line with given space
            $this->Ln(13);

            // Set font-family and font-size
            $this->SetFont('Arial', 'B', 14);

            // Move to the right
            $this->Cell(205, 5, 'Second Hand Commodity Enterprise', 0, 0, 'C');

            // Break line with given space
            $this->Ln(8);

            // Set font-family and font-size
            $this->SetFont('Times', '', 12);

            // Set the title of pages.
            $this->Cell(220, 10, 'Report', 0, 0, 'C');

            // Break line with given space
            $this->Ln(17);
        }
        // Page footer
        function Footer()
        {
            $this->SetTextColor(0, 0, 0);
            // Position at 7 cm from bottom
            $this->SetY(-70);
            $this->Cell(50, 10, 'Manager\'s Signature: ', 0, 0, 'C');
            $this->Image('logo2.jpg', 60, 225, 28, 17);

            // Set font-family and font-size of footer.
            $this->SetFont('Arial', 'I', 8);
            $this->SetTextColor(0, 0, 0);
            // Position at 1.5 cm from bottom


            $this->SetY(-15);

            // Set font-family and font-size of footer.
            $this->SetFont('Arial', 'I', 8);

            // set page number
            $this->Cell(0, 10, 'Page ' . $this->PageNo() .
                '/{nb}', 0, 0, 'C');
        }

        //view Table
        function headerTable()
        {

            // Break line with given space
            $this->Ln(3);

            // Set font-family and font-size
            $this->SetFont('Arial', 'B', 12);

            // Move to the right
            $this->Cell(160, 5, 'Second Hand Commodity Enterprise Report', 0, 0, 'C');

            // Set font-family and font-size
            $this->SetFont('Arial', 'B', 9);
            $date = date("l, M d, Y");
            $this->Cell(10, 5, $date, 0, 0, 'C');

            $this->Line(10, 56, 210 - 20, 56);

            $this->Ln(10);

            //--------------------------------------//
            $this->SetTextColor(250, 250, 250);
            // Set font-family and font-size
            $this->SetFont('Arial', 'B', 12);

            $this->SetFillColor(150, 150, 150);
            $this->SetDrawColor(0, 0, 0);

            // Move to the right
            $this->Cell(20, 10, 'S/N', 1, 0, 'C', true);
            $this->Cell(45, 10, 'Report', 1, 0, 'C', true);

            $this->Cell(22, 10, 'Amount', 1, 0, 'C', true);
            $this->Ln();
        }


        //         // Set font-family and font-size
        //         $this->SetFont('Arial', 'B', 12);
        //         $this->SetTextColor(0, 0, 255);
        //         $this->Cell(35, 10, 'Customer Name: ', 0, 0, 'C');
        //         $sql = "SELECT * FROM `users` WHERE `Id` = '$userid'";
        //         $stmt = mysqli_query($conn, $sql);
        //         while ($data = mysqli_fetch_assoc($stmt)) {
        //             $file = $data['File'];
        //             $name = $data['Customer Name'];
        //             $this->SetFont('Arial', '', 12);
        //             $this->SetTextColor(255, 99, 71);
        //             $this->Cell(50, 10, $name, 0, 0, 'C');
        //         }

        //         //--------------------------------------//
        //         $this->Ln(7);

        //         // Set font-family and font-size
        //         $this->SetFont('Arial', 'B', 12);
        //         $this->SetTextColor(0, 0, 255);
        //         $this->Cell(35, 10, 'Customer Email: ', 0, 0, 'C');
        //         $sql = "SELECT * FROM `users` WHERE `Id` = '$userid'";
        //         $stmt = mysqli_query($conn, $sql);
        //         while ($data = mysqli_fetch_assoc($stmt)) {
        //             $email = $data['Email'];
        //             $this->SetFont('Arial', '', 12);
        //             $this->SetTextColor(255, 99, 71);
        //             $this->Cell(57, 10, $email, 0, 0, 'C');
        //         }

        //         //--------------------------------------//
        //         $this->Ln(7);

        //         // Set font-family and font-size
        //         $this->SetFont('Arial', 'B', 12);
        //         $this->SetTextColor(0, 0, 255);
        //         $this->Cell(33, 10, 'Phone Number: ', 0, 0, 'C');
        //         $sql = "SELECT * FROM `users` WHERE `Id` = '$userid'";
        //         $stmt = mysqli_query($conn, $sql);
        //         while ($data = mysqli_fetch_assoc($stmt)) {
        //             $phone = $data['Phone Number'];
        //             $this->SetFont('Arial', '', 12);
        //             $this->SetTextColor(255, 99, 71);
        //             $this->Cell(49, 10, $phone, 0, 0, 'C');
        //         }
        //         //--------------------------------------//
        //         $this->Ln(7);

        //         // Set font-family and font-size
        //         $this->SetFont('Arial', 'B', 12);
        //         $this->SetTextColor(0, 0, 255);
        //         $this->Cell(31, 10, 'Voucher Code: ', 0, 0, 'C');
        //         $sql = "SELECT * FROM `tblpayment` WHERE `cart_id` ='$cartid'";
        //         $stmt = mysqli_query($conn, $sql);
        //         while ($data = mysqli_fetch_assoc($stmt)) {
        //             $payment_voucher = $data['payment_voucher'];
        //             $this->SetFont('Arial', '', 12);
        //             $this->SetTextColor(255, 99, 71);
        //             $this->Cell(44, 10, $payment_voucher, 0, 0, 'C');
        //         }

        //     }
        //     //view Table
        function viewTable()
        {
            include('server/connect.php');

            $Sales_Today = $_POST['Sales_Today'];
        }

        //         $num = 1;
        //         $sql = "SELECT * FROM `orderstable` WHERE `cart_id` = $cartid";
        //         $stmt = mysqli_query($conn, $sql);
        //         while ($data = mysqli_fetch_assoc($stmt)) {
        //             $menu_name = $data['menu_name'];
        //             $menu_price = $data['menu_price'];
        //             $Quantity = $data['Quantity'];
        //             $order_status = $data['order_status'];
        //             $Amount = $data['Amount'];

        //             $this->SetTextColor(0, 0, 0);
        //             $this->SetFont('Arial', '', 9);
        //             $this->Cell(20, 10, $num, 1, 0, 'C'); // The Numbering of items
        //             $this->Cell(45, 10, $menu_name, 1, 0, 'C');
        //             $this->Cell(40, 10, $order_status, 1, 0, 'C');
        //             $this->Cell(30, 10, $menu_price, 1, 0, 'C');
        //             $this->Cell(22, 10, $Quantity, 1, 0, 'C');
        //             $this->SetFont('Helvetica', 'B', 12);
        //             $this->Cell(22, 10, $Amount, 1, 0, 'C');
        //             $this->Ln();
        //             $num = $num + 1;
        //         }
        //         $this->Ln(10);
        //         $this->SetTextColor(0, 0, 0);
        //         $this->SetFont('Helvetica', 'B', 12);
        //         $this->Cell(45, 10, "Number of Items: ", 0, 0, 'C');
        //         $sql = "SELECT * FROM  `orderstable` WHERE `cart_id` = $cartid";
        //         if ($result = mysqli_query($conn, $sql)) {
        //             $num = (mysqli_num_rows($result));
        //             $this->SetFont('Arial', '', 12);
        //             $this->SetTextColor(10, 0, 0);
        //             $this->Cell(180, 10, $num, 0, 0, 'C');
        //         }
        //         $this->Ln(10);
        //         $this->SetTextColor(0, 0, 0);
        //         $this->SetFont('Helvetica', 'B', 12);
        //         $this->Cell(45, 10, "Additional Costs: ", 0, 0, 'C');
        //         $this->SetTextColor(225, 99, 70);
        //         $this->SetFont('Arial', '', 12);
        //         $this->SetTextColor(10, 0, 0);
        //         $this->Cell(190, 10, 'NONE', 0, 0, 'C');
        //         $this->Ln(10);
        //         $this->SetFont('Helvetica', 'B', 12);
        //         $this->SetTextColor(10, 0, 0);
        //         $this->Cell(40, 10, "Total Amount: ", 0, 0, 'C');
        //         $sql = "SELECT * FROM `tblpayment` WHERE `cart_id` = '$cartid'";
        //         $result = mysqli_query($conn, $sql);
        //         while ($data = mysqli_fetch_assoc($result)) {
        //             $amount = 'KSH ' . $data['amount'];
        //             $this->SetFont('Arial', 'B', 12);
        //             $this->SetTextColor(10, 0, 0);
        //             $this->Cell(202, 10, $amount, 0, 0, 'C');
        //         }
        //     }
    }

    // Create new object.
    $pdf = new PDF();
    $pdf->AliasNbPages();

    // Add new pages
    $pdf->AddPage();

    $pdf->headerTable();

    //Get contents from the database
    $pdf->viewTable();

    $pdf->Output();
}
?>

