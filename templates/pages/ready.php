<?php
/*
 *Hindamis klass. Rakenduse põhiloogika asub siin
 *
 */
class Rating {

	//Globaalne IP muutuja. kasutame $this->ip
	public $ip;

	//Konstruktor mis laeb andmebaasi objekti antud faili
	function __construct() {

		$this -> db = new Database();

	}

	//Kas id mida päritakse on õige ja pole tühi
	public function idControl() {

		if (isset($_GET['id']) && !empty($_GET['id'])) {
			return $_GET['id'];

		}

	}
	
	public function ipFunc(){
		
		$this->ip = '1234';//$_SERVER['REMOTE_ADDR']; // Tesitmiseks vaheta $_SERVER['REMOTE_ADDR'] näiteks '12345' vastu , et localhostis testida
			return $this->ip;
		
	}

	//Funktsioon mis kontrollib kas ip on baasis
	public function ipCheck() {
		$id = $this -> idControl();
		$this -> ip = ',' . $this -> ipFunc();
		//Paneme Andmebaasi päringu valmis
		$sth = $this -> db -> prepare("select ip from hinded where id='$id'");
		// $sth->execute tähendab , et käivitame baasi päringu. Peale seda püüame IP rea kinni , et sellega töödata
		$sth -> execute();
		$result = $sth -> fetch(PDO::FETCH_ASSOC);

		//print_r($this->result); Debuger

		$arr = array();
		if (is_array($result)) {
			foreach ($result as $value) {

				$arr[] = $value;
			}
		}
		//Teeme array-st stringi , et saada väärtused
		$str = implode(',', $arr);
		//echo $str; Debuger
		//Teeme stringist array ,et saada väärtustele võtmed
		
		$array = explode(',', $str);
		
		$replace = str_replace(',', '', $this -> ip);
		//Võtame esimese array väärtuse ja võtme ära, sest lisame IP baasi koos komaga, et IP-si üksteisest lahutada
		$array2 = array_shift($array);
		//Kontrollime kas on IP on array-s
		if (in_array($replace, $array)) {

			return false;

		} else {

			return true;
		}

		return $array;
	}

	//Näitame postitusi ja hindamis vormi kasutajatele
	public function index() {
		$ip = $this -> ipFunc();
		$sth = $this -> db -> prepare("select id,ip from hinded");

		$sth -> execute();
		$result = $sth -> fetchAll();
		
		//print_r($result); Debuger
		
		//Antud array-d kasutame templates/forms failides andmete näitamiseks
		$hinded = array(
			'Teenus1' => $this->rates('t1'),
			'Teenus2' => $this->rates('','t2'),
			'Teenus3' => $this->rates('','','t3'),
			'Teenus4' => $this->rates('','','','t4'),
			'Teenus5' => $this->rates('','','','','t5'),
			'Votes' =>   $this->rates('','','','','','v'),
	
		);
		foreach($result as $key => $value) {
				
			$id = $value['id'];
			$ip = $value['ip'];
			
			//Teeme IP-st array 
			 $arr = explode(',', $ip);
			//Juhul , kui IP asub päritud array-s , siis ei luba enam hääletada
            //if (in_array($this->ipFunc(), $arr)) {

				//require 'templates/forms/submited_form.php';
				//echo '<div class="voted">Oled seda postitust hinnanud.</div>';
				
			//} else {
				//Kui IP-d baasis ei ole , siis näitame seda vormi
				require 'templates/forms/form.php';
			//}
		}
		

	
	}
	
	//Funktsioon mis võtab baasist hinded ja mitu korda hääletatud
	public function rates($t1 = false,$t2 = false,$t3 = false,$t4 = false, $t5 = false, $v = false){
		
		$sth = $this->db->prepare('select * from hinded');
		
			$sth->execute();
			
			$result = 	$sth->fetchAll();
				
				//print_r($result); Debuger 
				
				foreach($result as $key => $value) {
					
					$teenus1 = $value['teenus1'];
					$teenus2 = $value['teenus2'];
					$teenus3 = $value['teenus3'];
					$teenus4 = $value['teenus4'];
					$teenus5 = $value['teenus5'];
					$votes = $value['votes'];
					
		      }
			
				//Tehete blokkid
				
				if($t1 == 't1') {
					
				  $hinne =   $teenus1 / $votes;
					return round($hinne, 1); 
					
				}
				if($t2 == 't2') {
					
					$hinne =   $teenus2 / $votes;
					return round($hinne, 1); 
				
				}
				
				if($t3 == 't3') {
				
				$hinne =   $teenus3 / $votes;
					return round($hinne, 1); 
				
				}
				
				if($t4 == 't4') {
					$hinne =   $teenus4 / $votes;
				
					return round($hinne, 1); 
				
					
				}
				
				if($t5 == 't5') {
				if($t5 == 0) {
					return $teenus5;
					} else {
				$hinne =   $teenus5 / $votes;
					
					return round($hinne, 1); 
				}
				}
				if($v == 'v') {
					
				
						return $votes;
				
					
				}
			
	}

	//Postitame hääle baasi ,kui IP veel baasis ei ole

	public function vote() {
		//Paneme ID kontroll funktsiooni $id muutuja sisse, et seda SQL päringus kasutada		
		$id = $this->idControl();

		// Lisame IP-baasi nii,et igasisestuse ees oleks koma , et neid üksteisest lahutada
		//Hiljem tagasiküsides eemaldame koma
		$this -> ip = ',' . $this -> ipFunc();
		
			//Teenuste postitamine. 
			$teenus1 = $_POST['teenus1'];
			$teenus2 = $_POST['teenus2'];
			$teenus3 = $_POST['teenus3'];
			$teenus4 = $_POST['teenus4'];
			$teenus5 = $_POST['teenus5'];
			//Siin on valideerimine. Kommenteeri if blokk välja juhul , kui valideerimist ei vaja.
			//Või kui tahad et valideeriks teatud teenust kustuta muutuja sulgudest ära
				if(!isset($teenus1,$teenus2,$teenus3,$teenus4,$teenus5)) {
					//Antud errori sõnum asub Init.php failis message funktsioonis
					header('location:index.php?url=error');
					echo 'Bad';
					die();
				}
		
	

				//$sth = $this -> db -> prepare("update ratings set rate = rate + $voted,ip=concat(ip,'$this->ip'), votes = votes+1  where id='$id'");
			//	if (!$this -> ipCheck()) {
               //Kui ip eksisteerib siis ei lase mingit moodi postitada baasi. 
                //IP on olemas sõnum on rohkem Debug message. Võib vabalt välja kommenteerida
				//echo 'Bad';
				//return false;
				//} else {
					//Baasi uuendamine peale postitust
					//IP concat SQL funktsioon tähendab , et me jätame vana IP alles lihtsalt lisame lõppu uue IP koos komaga
					//Teenustel teeme nii , et  liidame vastavalt valitud tähele baasis olevat arvu
					//Votes ehk häältele lisame +1 hääle
				$sth = $this -> db -> prepare("update hinded set teenus1 = teenus1 + '$teenus1', 
				teenus2 = teenus2 +  '$teenus2', 
				teenus3 = teenus3 +  '$teenus3',
				teenus4 = teenus5 + '$teenus4',
				teenus5 = teenus5 + '$teenus5', 
				ip = concat(ip,'$this->ip'),
				votes = votes+1 where id='$id'");
				
				$sth -> execute(array($teenus1,$teenus2,$teenus3,$teenus4,$teenus5));
				  //Kui läbib IP ja valideerimis kontrolli ,siis näitame sõnumit. Sõnum asub Init.php failis
				header('location:index.php?url=saved');
				//}


	}

}//Klass
