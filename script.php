<?php

//--------------------------------------------------------------------------
// Gegevens van de database + connectie
//--------------------------------------------------------------------------

$host = "localhost";
$user = "F";
$pass = "R)";
$databaseName = "FamCompas";
$con = mysql_connect($host, $user, $pass);
$dbs = mysql_select_db($databaseName, $con);

//--------------------------------------------------------------------------
// Gegevens ophalen
//--------------------------------------------------------------------------

if (isset($_GET['vraagID'])) {
	$x = $_GET['vraagID'];
	$string = "";
	$result = "SELECT * FROM tbl_vragen2 where vr_id = '" . $x . "'";

	$array = MySQL_Query($result);
	while ($row = MySQL_Fetch_Assoc($array)) {
		$vraag = '<div>' . utf8_encode($row['vr_om']) . '<br></div>';
		$antwoord = "";
		$string2 = '<div>';

		$aa = mysql_query("SELECT vt_om FROM tbl_vraagtypes2 where vt_id = '" . $row['vr_vt_id'] . "'");
		$bb = mysql_fetch_row($aa);
		switch ($bb[0]) {
			case "multipleS" :
				$resulta = "SELECT * FROM tbl_antwoorden2 where aw_vr_id = '" . $x . "'";
				$arraya = MySQL_Query($resulta);
				while ($rowa = MySQL_Fetch_Assoc($arraya)) {
					if (utf8_encode($rowa['aw_om']) == "Andere:") {
						$antwoord .= '<label><input type="radio" id="' . $rowa['aw_nr'] . '" name="' . $rowa['aw_vr_id'] . '" value="' . utf8_encode($rowa['aw_om']) . '">' . utf8_encode($rowa['aw_om']) . '</label>';
						$antwoord .= '<input id="' . $rowa['aw_vr_id'] . '" name="' . $rowa['aw_vr_id'] . '">';
					} else {
						$antwoord .= '<label><input type="radio" id="' . $rowa['aw_nr'] . '" name="' . $rowa['aw_vr_id'] . '" value="' . utf8_encode($rowa['aw_om']) . '">' . utf8_encode($rowa['aw_om']) . '</label>';
					}

				}
				$antwoord .= '</div>';
				break;
			case "multipleM" :
				$resulta = "SELECT * FROM tbl_antwoorden2 where aw_vr_id = '" . $x . "'";
				$arraya = MySQL_Query($resulta);
				while ($rowa = MySQL_Fetch_Assoc($arraya)) {

					$antwoord .= '<label><input type="checkbox" id="' . $rowa['aw_nr'] . '" name="' . $rowa['aw_vr_id'] . '" value="' . utf8_encode($rowa['aw_om']) . '">' . utf8_encode($rowa['aw_om']) . '</label>';
				}
				$antwoord .= '</div>';
				break;
			case "open" :
				$resulta = "SELECT * FROM tbl_antwoorden2 where aw_vr_id = '" . $x . "'";
				$arraya = MySQL_Query($resulta);
				while ($rowa = MySQL_Fetch_Assoc($arraya)) {
					$antwoord .= '' . utf8_encode($rowa['aw_om']) . '<br><input type="text" id="' . $rowa['aw_vr_id'] . '" name="' . $rowa['aw_vr_id'] . '" value=""><br></div>';
				}
				break;
			case "min/max" :
				$resulta = "SELECT * FROM tbl_antwoorden2 where aw_vr_id = '" . $x . "'";
				$arraya = MySQL_Query($resulta);

				$antwoord .= '<div data-role="fieldcontain"><fieldset data-type="horizontal" >';
				//<legend></legend> data-role="controlgroup"

				while ($rowa = MySQL_Fetch_Assoc($arraya)) {
					$min = $rowa['aw_min'];
					$max = $rowa['aw_max'];
					$mintekst = utf8_encode($rowa['minTekst']);
					$maxtekst = utf8_encode($rowa['maxTekst']);
					//$vraag .= '' . utf8_encode($rowa['aw_om']) . '';
					$antwoord .= '<span style="float:right; font-size:90%; color=#555; display:block; max-width:45%; overflow-wrap:break-word;">' . $maxtekst . '</span>';
					$antwoord .= '<span style="float:left; font-size:90%; color=#555; display:block; max-width:45%; overflow-wrap:break-word;">' . $mintekst . '</span>';
					// <label for="slider-step">Input slider:</label>
					$antwoord .= '<div style="clear:both"><input type="range" name="' . $rowa['aw_vr_id'] . '" id="' . $rowa['aw_nr'] . '" value="0" min="' . $min . '" max="' . $max . '" step="1" /></div>';

				}
				$antwoord .= '</fieldset></div></div>';
				break;
		}

		$vraag .= $antwoord;
		// bij de vraag de mogelijke antwoorden steken
		$string .= $vraag;
		echo $string;

	}

	$max = mysql_query("SELECT max(vr_id) FROM tbl_vragen2");
	$einderes = mysql_fetch_row($max);
	if (((int)$x) === ((int)$einderes[0] + 1)) {// einde van enq
		echo '<button type="button">Einde!</button>';
	}
} elseif (isset($_GET['aantal'])) {
	$test = $_GET['aantal'];
	$sql = mysql_query("SELECT COUNT(id) FROM tbl_vragen2");
	$aantalvragen = mysql_fetch_row($sql);
	echo $aantalvragen[0];
} elseif (isset($_GET['token'])) {// ////////////////////////////////////////////////////////////
	$test = $_GET['token'];
	$begin = mysql_query("SELECT tk_van FROM tbl_tokens where tk_om = '" . $test . "'");
	$einde = mysql_query("SELECT tk_tot FROM tbl_tokens where tk_om = '" . $test . "'");
	$van = mysql_fetch_row($begin);
	$tot = mysql_fetch_row($einde);
	$from = strtotime($van[0]);
	$to = strtotime($tot[0]);
	$now = time();
	$login = 0;
	if ($from <= $now && $to >= $now) {
		$login = 1;
	}
	else {
		
	}
	
	echo $login;
} elseif (isset($_GET['nextID'])) {
	$test = $_GET['nextID'];
	$sql = mysql_query("SELECT aw_next_vr_id FROM tbl_antwoorden2 where aw_nr = '" . $test . "'");
	$id = mysql_fetch_row($sql);
	echo $id[0];
} elseif (isset($_GET['tekst'])) {
	$test = $_GET['tekst'];
	$sql = mysql_query("SELECT $test FROM tbl_teksten");
	$id = mysql_fetch_row($sql);
	echo utf8_encode($id[0]);
} elseif (isset($_GET['mediaan'])) {
	$test = $_GET['mediaan'];
	//$test ="V13";
	$sql = mysql_query("SELECT 
  CASE 
  WHEN MOD((select count(*) as count from tbl_gekozenantwoorden),2)=1 THEN
      (select $test from
           (select @row:=@row+1 as row, $test
            from tbl_gekozenantwoorden,(select @row:=0)r
            order by $test)t1
       where t1.row = CEIL((select count(*) as count from tbl_gekozenantwoorden)/2)
      )
  ELSE
       ((select $test from
           (select @row:=@row+1 as row,$test
            from tbl_gekozenantwoorden,(select @row:=0)r
            order by $test)t1
         where t1.row = (select count(*) as count from tbl_gekozenantwoorden)/2)+
        (select $test from
           (select @row:=@row+1 as row,$test
            from tbl_gekozenantwoorden,(select @row:=0)r
            order by $test)t1
         where t1.row = ((select count(*) as count from tbl_gekozenantwoorden)/2)+1))/2 
  END AS median");
	$id = mysql_fetch_row($sql);
	echo $id[0];
} elseif (isset($_POST['abron'], $_POST['ainvuldatum'], $_POST['anaam'], $_POST['abedrijf'], $_POST['apostcode'], $_POST['aemail'], $_POST['aantal'], $_POST['aantal2'], $_POST['aantal3'], $_POST['aantal4'], $_POST['aantal5'], $_POST['aantal6'], $_POST['aantal7'], $_POST['aantal8'], $_POST['aantal9'], $_POST['aantal10'], $_POST['aantal11'], $_POST['aantal12'], $_POST['aantal13'], $_POST['aantal14'], $_POST['aantal15'], $_POST['aantal16'], $_POST['aantal17'], $_POST['aantal18'], $_POST['aantal19'], $_POST['aantal20'], $_POST['aantal21'], $_POST['aantal22'], $_POST['aantal23'], $_POST['aantal24'], $_POST['aantal25'], $_POST['aantal26'], $_POST['aantal27'], $_POST['aantal28'], $_POST['aantal29'], $_POST['aantal30'], $_POST['aantal31'], $_POST['aantal32'], $_POST['aantal33'], $_POST['aantal34'], $_POST['aantal35'], $_POST['aantal36'], $_POST['aantal37'], $_POST['aantal38'], $_POST['aantal39'], $_POST['aantal40'], $_POST['aantal41'], $_POST['aantal42'], $_POST['aantal43'], $_POST['aantal44'], $_POST['aantal45'], $_POST['aantal46'], $_POST['aantal47'], $_POST['aantal48'], $_POST['aantal49'], $_POST['aantal50'], $_POST['aantal51'], $_POST['aantal52'], $_POST['aantal53'], $_POST['aantal54'], $_POST['aantal55'], $_POST['aantal56'], $_POST['aantal57'], $_POST['aantal58'], $_POST['aantal59'], $_POST['aantal60'], $_POST['aantal61'], $_POST['aantal62'], $_POST['aantal63'], $_POST['aantal64'], $_POST['aantal65'], $_POST['aantal66'], $_POST['aantal67'], $_POST['aantal68'], $_POST['aantal69'], $_POST['aantal70'], $_POST['aantal71'], $_POST['aantal72'], $_POST['aantal73'], $_POST['aantal74'], $_POST['aantal75'], $_POST['aantal76'], $_POST['aantal77'], $_POST['aantal78'], $_POST['aantal79'], $_POST['aantal80'], $_POST['aantal81'], $_POST['aantal82'], $_POST['aantal83'], $_POST['aantal84'], $_POST['aantal85'], $_POST['aantal86'], $_POST['aantal87'], $_POST['aantal88'], $_POST['aantal89'], $_POST['aantal90'], $_POST['aantal91'], $_POST['aantal92'], $_POST['aantal93'], $_POST['aantal94'], $_POST['aantal95'], $_POST['aantal96'], $_POST['aantal97'], $_POST['aantal98'], $_POST['aantal99'], $_POST['aantal100'], $_POST['aantal101'], $_POST['aantal102'], $_POST['aantal103'], $_POST['aantal104'], $_POST['aantal105'], $_POST['aantal106'], $_POST['aantal107'], $_POST['aantal108'], $_POST['aantal109'], $_POST['aantal110'], $_POST['aantal111'], $_POST['aantal112'], $_POST['aantal113'], $_POST['aantal114'], $_POST['aantal115'], $_POST['aantal116'], $_POST['aantal117'], $_POST['aantal118'], $_POST['aantal119'], $_POST['aantal120'], $_POST['aantal121'], $_POST['aantal122'], $_POST['aantal123'], $_POST['aantal124'], $_POST['aantal125'], $_POST['aantal126'], $_POST['aantal127'], $_POST['aantal128'], $_POST['aantal129'], $_POST['aantal130'], $_POST['aantal131'], $_POST['aantal132'], $_POST['aantal133'], $_POST['aantal134'], $_POST['aantal135'], $_POST['aantal136'], $_POST['aantal137'], $_POST['aantal138'], $_POST['aantal139'], $_POST['aantal140'], $_POST['aantal141'], $_POST['aantal142'], $_POST['aantal143'], $_POST['aantal144'], $_POST['aantal145'], $_POST['aantal146'], $_POST['aantal147'], $_POST['aantal148'], $_POST['aantal149'], $_POST['aantal150'], $_POST['aantal151'], $_POST['aantal152'], $_POST['aantal153'], $_POST['aantal154'], $_POST['aantal155'], $_POST['aantal156'], $_POST['aantal157'], $_POST['aantal158'], $_POST['aantal159'], $_POST['aantal160'], $_POST['aantal161'], $_POST['aantal162'], $_POST['aantal163'], $_POST['aantal164'], $_POST['aantal165'], $_POST['aantal166'], $_POST['aantal167'], $_POST['aantal168'], $_POST['aantal169'], $_POST['aantal170'], $_POST['aantal171'], $_POST['aantal172'])) {
	$bedrijf = $_POST['abedrijf'];
	$naam = $_POST['anaam'];
	$postcode = $_POST['apostcode'];
	$bron = $_POST['abron'];
	$invuldatum = $_POST['ainvuldatum'];
	$email = $_POST['aemail'];
	$V1 = $_POST['aantal'];
	$V2_1 = $_POST['aantal2'];
	$V2_2 = $_POST['aantal3'];
	$V2_3 = $_POST['aantal4'];
	$V2_4 = $_POST['aantal5'];
	$V2_5 = $_POST['aantal6'];
	$V2_6 = $_POST['aantal7'];
	$V2_7 = $_POST['aantal8'];
	$V2_8 = $_POST['aantal9'];
	$V2_9 = $_POST['aantal10'];
	$V3 = $_POST['aantal11'];
	$V4_1 = $_POST['aantal12'];
	$V4_2 = $_POST['aantal13'];
	$V4_3 = $_POST['aantal14'];
	$V4_4 = $_POST['aantal15'];
	$V4_5 = $_POST['aantal16'];
	$V4_6 = $_POST['aantal17'];
	$V4_7 = $_POST['aantal18'];
	$V4_8 = $_POST['aantal19'];
	$V4_9 = $_POST['aantal20'];
	$V5 = $_POST['aantal21'];
	$V6_1 = $_POST['aantal22'];
	$V6_2 = $_POST['aantal23'];
	$V6_3 = $_POST['aantal24'];
	$V6_4 = $_POST['aantal25'];
	$V6_5 = $_POST['aantal26'];
	$V6_6 = $_POST['aantal27'];
	$V6_7 = $_POST['aantal28'];
	$V6_8 = $_POST['aantal29'];
	$V6_9 = $_POST['aantal30'];
	$V7_1 = $_POST['aantal31'];
	$V7_2 = $_POST['aantal32'];
	$V7_3 = $_POST['aantal33'];
	$V7_4 = $_POST['aantal34'];
	$V7_5 = $_POST['aantal35'];
	$V7_6 = $_POST['aantal36'];
	$V7_7 = $_POST['aantal37'];
	$V7_8 = $_POST['aantal38'];
	$V7_9 = $_POST['aantal39'];
	$V8_1 = $_POST['aantal40'];
	$V8_2 = $_POST['aantal41'];
	$V8_3 = $_POST['aantal42'];
	$V8_4 = $_POST['aantal43'];
	$V9_1 = $_POST['aantal44'];
	$V9_2 = $_POST['aantal45'];
	$V9_3 = $_POST['aantal46'];
	$V9_4 = $_POST['aantal47'];
	$V10 = $_POST['aantal48'];
	$V11 = $_POST['aantal49'];
	$V12_1 = $_POST['aantal50'];
	$V12_2 = $_POST['aantal51'];
	$V13 = $_POST['aantal52'];
	$V14_1 = $_POST['aantal53'];
	$V14_2 = $_POST['aantal54'];
	$V14_3 = $_POST['aantal55'];
	$V14_4 = $_POST['aantal56'];
	$V14_5 = $_POST['aantal57'];
	$V15_1 = $_POST['aantal58'];
	$V15_2 = $_POST['aantal59'];
	$V16_1 = $_POST['aantal60'];
	$V16_2 = $_POST['aantal61'];
	$V16_3 = $_POST['aantal62'];
	$V16_4 = $_POST['aantal63'];
	$V16_5 = $_POST['aantal64'];
	$V16_6 = $_POST['aantal65'];
	$V16_7 = $_POST['aantal66'];
	$V16_8 = $_POST['aantal67'];
	$V16_9 = $_POST['aantal68'];
	$V16_10 = $_POST['aantal69'];
	$V16_11 = $_POST['aantal70'];
	$V16_12 = $_POST['aantal71'];
	$V16_13 = $_POST['aantal72'];
	$V16_14 = $_POST['aantal73'];
	$V16_15 = $_POST['aantal74'];
	$V16_16 = $_POST['aantal75'];
	$V16_17 = $_POST['aantal76'];
	$V16_18 = $_POST['aantal77'];
	$V17_1 = $_POST['aantal78'];
	$V17_2 = $_POST['aantal79'];
	$V17_3 = $_POST['aantal80'];
	$V17_4 = $_POST['aantal81'];
	$V17_5 = $_POST['aantal82'];
	$V17_6 = $_POST['aantal83'];
	$V18_1 = $_POST['aantal84'];
	$V18_2 = $_POST['aantal85'];
	$V18_3 = $_POST['aantal86'];
	$V18_4 = $_POST['aantal87'];
	$V18_5 = $_POST['aantal88'];
	$V18_6 = $_POST['aantal89'];
	$V19_1 = $_POST['aantal90'];
	$V19_2 = $_POST['aantal91'];
	$V19_3 = $_POST['aantal92'];
	$V19_4 = $_POST['aantal93'];
	$V19_5 = $_POST['aantal94'];
	$V20_1 = $_POST['aantal95'];
	$V20_2 = $_POST['aantal96'];
	$V20_3 = $_POST['aantal97'];
	$V20_4 = $_POST['aantal98'];
	$V20_5 = $_POST['aantal99'];
	$V20_6 = $_POST['aantal100'];
	$V21_1 = $_POST['aantal101'];
	$V21_2 = $_POST['aantal102'];
	$V21_3 = $_POST['aantal103'];
	$V21_4 = $_POST['aantal104'];
	$V22_1 = $_POST['aantal105'];
	$V22_2 = $_POST['aantal106'];
	$V22_3 = $_POST['aantal107'];
	$V22_4 = $_POST['aantal108'];
	$V22_5 = $_POST['aantal109'];
	$V22_6 = $_POST['aantal110'];
	$V22_7 = $_POST['aantal111'];
	$V23 = $_POST['aantal112'];
	$V24_1 = $_POST['aantal113'];
	$V24_2 = $_POST['aantal114'];
	$V24_3 = $_POST['aantal115'];
	$V24_4 = $_POST['aantal116'];
	$V24_4t = $_POST['aantal117'];
	$V25_1 = $_POST['aantal118'];
	$V25_2 = $_POST['aantal119'];
	$V25_3 = $_POST['aantal120'];
	$V25_4 = $_POST['aantal121'];
	$V25_5 = $_POST['aantal122'];
	$V25_6 = $_POST['aantal123'];
	$V25_7 = $_POST['aantal124'];
	$V26 = $_POST['aantal125'];
	$V27 = $_POST['aantal126'];
	$V28_1 = $_POST['aantal127'];
	$V28_2 = $_POST['aantal128'];
	$V28_3 = $_POST['aantal129'];
	$V28_4 = $_POST['aantal130'];
	$V28_5 = $_POST['aantal131'];
	$V28_6 = $_POST['aantal132'];
	$V28_6t = $_POST['aantal133'];
	$V28_7 = $_POST['aantal134'];
	$V28_8 = $_POST['aantal135'];
	$V28_9 = $_POST['aantal136'];
	$V28_10 = $_POST['aantal137'];
	$V28_11 = $_POST['aantal138'];
	$V28_11t = $_POST['aantal139'];
	$V28_12 = $_POST['aantal140'];
	$V28_13 = $_POST['aantal141'];
	$V28_14 = $_POST['aantal142'];
	$V28_15 = $_POST['aantal143'];
	$V28_16 = $_POST['aantal144'];
	$V28_16t = $_POST['aantal145'];
	$V28_17 = $_POST['aantal146'];
	$V28_18 = $_POST['aantal147'];
	$V28_19 = $_POST['aantal148'];
	$V28_20 = $_POST['aantal149'];
	$V28_21 = $_POST['aantal150'];
	$V28_21t = $_POST['aantal151'];
	$V28_22 = $_POST['aantal152'];
	$V28_23 = $_POST['aantal153'];
	$V28_24 = $_POST['aantal154'];
	$V29_1 = $_POST['aantal155'];
	$V29_2 = $_POST['aantal156'];
	$V30_1 = $_POST['aantal157'];
	$V30_2 = $_POST['aantal158'];
	$V30_3 = $_POST['aantal159'];
	$V30_4 = $_POST['aantal160'];
	$V30_5 = $_POST['aantal161'];
	$V30_6 = $_POST['aantal162'];
	$V30_7 = $_POST['aantal163'];
	$V30_8 = $_POST['aantal164'];
	$V31_1 = $_POST['aantal165'];
	$V31_2 = $_POST['aantal166'];
	$V31_3 = $_POST['aantal167'];
	$V31_4 = $_POST['aantal168'];
	$V31_5 = $_POST['aantal169'];
	$V31_6 = $_POST['aantal170'];
	$V32_1 = $_POST['aantal171'];
	$V32_2 = $_POST['aantal172'];
	$servername = "localhost";
	$username = "F";
	$password = "R)";
	$dbname = "FamCompas";
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn -> connect_error) {
		die("Connection failed: " . $conn -> connect_error);
	}
	$sql = "INSERT INTO tbl_gekozenantwoorden (ID, bron,invuldatum,naam,bedrijf,postcode,email,V1,V2_1,V2_2,V2_3,V2_4,V2_5,V2_6,V2_7,V2_8,V2_9,V3,V4_1,V4_2,V4_3,V4_4,V4_5,V4_6,V4_7,V4_8,V4_9,V5,V6_1,V6_2,V6_3,V6_4,V6_5,V6_6,V6_7,V6_8,V6_9,V7_1,V7_2,V7_3,V7_4,V7_5,V7_6,V7_7,V7_8,V7_9,V8_1,V8_2,V8_3,V8_4,V9_1,V9_2,V9_3,V9_4,V10,V11,V12_1,V12_2,V13,V14_1,V14_2,V14_3,V14_4,V14_5,V15_1,V15_2,V16_1,V16_2,V16_3,V16_4,V16_5,V16_6,V16_7,V16_8,V16_9,V16_10,V16_11,V16_12,V16_13,V16_14,V16_15,V16_16,V16_17,V16_18,V17_1,V17_2,V17_3,V17_4,V17_5,V17_6,V18_1,V18_2,V18_3,V18_4,V18_5,V18_6,V19_1,V19_2,V19_3,V19_4,V19_5,V20_1,V20_2,V20_3,V20_4,V20_5,V20_6,V21_1,V21_2,V21_3,V21_4,V22_1,V22_2,V22_3,V22_4,V22_5,V22_6,V22_7,V23,V24_1,V24_2,V24_3,V24_4,V24_4t,V25_1,V25_2,V25_3,V25_4,V25_5,V25_6,V25_7,V26,V27,V28_1,V28_2,V28_3,V28_4,V28_5,V28_6,V28_6t,V28_7,V28_8,V28_9,V28_10,V28_11,V28_11t,V28_12,V28_13,V28_14,V28_15,V28_16,V28_16t,V28_17,V28_18,V28_19,V28_20,V28_21,V28_21t,V28_22,V28_23,V28_24,V29_1,V29_2,V30_1,V30_2,V30_3,V30_4,V30_5,V30_6,V30_7,V30_8,V31_1,V31_2,V31_3,V31_4,V31_5,V31_6,V32_1,V32_2) VALUES ('" . $ID . "','" . $bron . "','" . $invuldatum . "','" . $naam . "','" . $bedrijf . "','" . $postcode . "','" . $email . "','" . $V1 . "','" . $V2_1 . "','" . $V2_2 . "','" . $V2_3 . "','" . $V2_4 . "','" . $V2_5 . "','" . $V2_6 . "','" . $V2_7 . "','" . $V2_8 . "','" . $V2_9 . "','" . $V3 . "','" . $V4_1 . "','" . $V4_2 . "','" . $V4_3 . "','" . $V4_4 . "','" . $V4_5 . "','" . $V4_6 . "','" . $V4_7 . "','" . $V4_8 . "','" . $V4_9 . "','" . $V5 . "','" . $V6_1 . "','" . $V6_2 . "','" . $V6_3 . "','" . $V6_4 . "','" . $V6_5 . "','" . $V6_6 . "','" . $V6_7 . "','" . $V6_8 . "','" . $V6_9 . "','" . $V7_1 . "','" . $V7_2 . "','" . $V7_3 . "','" . $V7_4 . "','" . $V7_5 . "','" . $V7_6 . "','" . $V7_7 . "','" . $V7_8 . "','" . $V7_9 . "','" . $V8_1 . "','" . $V8_2 . "','" . $V8_3 . "','" . $V8_4 . "','" . $V9_1 . "','" . $V9_2 . "','" . $V9_3 . "','" . $V9_4 . "','" . $V10 . "','" . $V11 . "','" . $V12_1 . "','" . $V12_2 . "','" . $V13 . "','" . $V14_1 . "','" . $V14_2 . "','" . $V14_3 . "','" . $V14_4 . "','" . $V14_5 . "','" . $V15_1 . "','" . $V15_2 . "','" . $V16_1 . "','" . $V16_2 . "','" . $V16_3 . "','" . $V16_4 . "','" . $V16_5 . "','" . $V16_6 . "','" . $V16_7 . "','" . $V16_8 . "','" . $V16_9 . "','" . $V16_10 . "','" . $V16_11 . "','" . $V16_12 . "','" . $V16_13 . "','" . $V16_14 . "','" . $V16_15 . "','" . $V16_16 . "','" . $V16_17 . "','" . $V16_18 . "','" . $V17_1 . "','" . $V17_2 . "','" . $V17_3 . "','" . $V17_4 . "','" . $V17_5 . "','" . $V17_6 . "','" . $V18_1 . "','" . $V18_2 . "','" . $V18_3 . "','" . $V18_4 . "','" . $V18_5 . "','" . $V18_6 . "','" . $V19_1 . "','" . $V19_2 . "','" . $V19_3 . "','" . $V19_4 . "','" . $V19_5 . "','" . $V20_1 . "','" . $V20_2 . "','" . $V20_3 . "','" . $V20_4 . "','" . $V20_5 . "','" . $V20_6 . "','" . $V21_1 . "','" . $V21_2 . "','" . $V21_3 . "','" . $V21_4 . "','" . $V22_1 . "','" . $V22_2 . "','" . $V22_3 . "','" . $V22_4 . "','" . $V22_5 . "','" . $V22_6 . "','" . $V22_7 . "','" . $V23 . "','" . $V24_1 . "','" . $V24_2 . "','" . $V24_3 . "','" . $V24_4 . "','" . $V24_4t . "','" . $V25_1 . "','" . $V25_2 . "','" . $V25_3 . "','" . $V25_4 . "','" . $V25_5 . "','" . $V25_6 . "','" . $V25_7 . "','" . $V26 . "','" . $V27 . "','" . $V28_1 . "','" . $V28_2 . "','" . $V28_3 . "','" . $V28_4 . "','" . $V28_5 . "','" . $V28_6 . "','" . $V28_6t . "','" . $V28_7 . "','" . $V28_8 . "','" . $V28_9 . "','" . $V28_10 . "','" . $V28_11 . "','" . $V28_11t . "','" . $V28_12 . "','" . $V28_13 . "','" . $V28_14 . "','" . $V28_15 . "','" . $V28_16 . "','" . $V28_16t . "','" . $V28_17 . "','" . $V28_18 . "','" . $V28_19 . "','" . $V28_20 . "','" . $V28_21 . "','" . $V28_21t . "','" . $V28_22 . "','" . $V28_23 . "','" . $V28_24 . "','" . $V29_1 . "','" . $V29_2 . "','" . $V30_1 . "','" . $V30_2 . "','" . $V30_3 . "','" . $V30_4 . "','" . $V30_5 . "','" . $V30_6 . "','" . $V30_7 . "','" . $V30_8 . "','" . $V31_1 . "','" . $V31_2 . "','" . $V31_3 . "','" . $V31_4 . "','" . $V31_5 . "','" . $V31_6 . "','" . $V32_1 . "','" . $V32_2 . "')";
	$conn -> query($sql);
	$conn -> close();
} else {
	echo '';
}
?>
