
<?php

class Gift_PDF extends FPDF {

    function ContentHolder() {
        $this->SetDrawColor(15, 15, 15);
        $this->Ln(-66);
        $this->SetLineWidth(0);
        $this->Cell(0, 66, '', 1, 1, 'C');
        // Line break
    }

    function ChapterTitle($compName) {

        // Arial 12
        $this->SetFont('Arial', '', 12);
        // Background color
        $this->SetFillColor(42, 130, 186);
        $this->SetTextColor(255);
        // Title
        $this->SetY((10 - '') / 2);
        $this->Ln(70);
        $this->Cell(0, 10, "$compName", 0, 1, 'L', true);
        // Line break
        $this->Ln(10);
    }

    function ChapterBottom($blah) {
        // Arial 12

        $this->SetFont('Arial', 'B', 15);
        // Calculate width of title and position
        // Colors of frame, background and text
        $this->SetDrawColor(0, 80, 180);
        $this->SetFillColor(42, 130, 186);
        $this->SetTextColor(255);
        // Thickness of frame (1 mm)
        // Title
        $this->Cell(0, 10, $blah, 0, 1, 'L', true);
        $this->Ln(0);
    }

    function ChapterBody() {
        // Read text file
        //$txt = file_get_contents($file);
        // Times 12
        $name = $_POST['name'];
        $message = $_POST['message'];
        $procent = $_POST['price'] . 'Eur';

        $this->SetFont('Arial', 'B', 15);
        $this->SetTextColor(100);

        // Output justified text
        $this->SetX((40 - $name) / 2);
        $this->Cell(0, 5, $name);
        // Line break

        $this->Ln(10);
        // Mention in italics
        $this->SetFont('Arial', 'B', 12);
        $this->SetX((40 - $message) / 2);
        $this->MultiCell(0, 5, $message);

        $this->Cell(1, 2);


        $this->Ln(-4);
        // Mention in italics
        $this->SetFont('', 'B', 45);
        $w = $this->GetStringWidth($procent) + 6;
        $this->SetX((310 - $w) / 2);
        $this->SetTextColor(15, 15, 15);
        $this->Cell(0, 0, $procent, 0, 0);
        $this->Ln(25);
    }

    function PrintChapter($compName, $title, $blah) {
        $this->AddPage();
        $this->ChapterTitle($compName, $title);
        $this->ChapterBody();
        $this->ChapterBottom($blah);
    }

}

//.class



/*
  require("class.phpmailer.php");
  $mail = new PHPMailer();
  $mail->IsMail();
  $path = "FILES/".$file;
  $mail->SetFrom("cmsframe@gmail.com","Martin");
  $mail->AddAddress("jsinfo7@gmail.com");
  $mail->Subject = "Demo";
  $mail->Body = "Demo sisu.";
  $mail->AddAttachment($path);
  if(!$mail->Send()) {
  echo "Error sending: " . $mail->ErrorInfo;;
  } else {
  echo "Letter sent";
  }

 */
?>