<?php
class Gift_PDF_Exec {

	function __construct() {

	}

	public function PDF_DO() {
		include  labels();
		$pdf = new Gift_PDF();
		$title = '';
		$uid = $_POST['uid'];
		$toMail = $_POST['to-mail'];
		$fromMail = $_POST['sender-mail'];
		$fromName = $_POST['sender-name'];
		$pdf -> SetTitle($title);
		$pdf -> PrintChapter($labelET['Company name'], 1, "Kupongi kood: $uid");
		$pdf -> ContentHolder();
		$pdf -> Ln(10);

		$name = $_POST['name'] . ' kingitus' . ' ID ' . $uid;

		$file = ($name);
		$file .= '.pdf';

		$pdf -> Output('files/PDF/' . $file);
		//Redirect
		//header('Location: ' . 'FILES/' . $file);
		
		require ("libaries/PHPMailer/class.phpmailer.php");
		$mail = new PHPMailer();
		$mail -> IsMail();
		$path = "files/PDF/" . $file;
		$mail -> SetFrom($fromMail, "Kingituse tegi sulle: $fromName");
		$mail -> AddAddress($toMail);
		$mail -> Subject = "Kingitus Falseprogrammingu poolt";
		$mail -> Body = "Vaata PDF faili. Kingitusi tegi sulle $fromName Emaililt: $fromMail";
		$mail -> AddAttachment($path);
		if (!$mail -> Send()) {
			echo "Error saatmisega: " . $mail -> ErrorInfo;
			;
		} else {
			echo "Kiri saadetud";
		}

	}

}
