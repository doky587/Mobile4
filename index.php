<!DOCTYPE html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">

	<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
	<script>
        
		$( document ).on( "mobileinit", function() {
			$.mobile.defaultPageTransition  = 'slide';
		});
	</script>
	<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
	<script type="text/javascript" src="./fusioncharts.js"></script>
	<script type="text/javascript" src="./fusioncharts.powercharts.js"></script>
	<script type="text/javascript" src="./fusioncharts.theme.fint.js"></script>
	<script type="text/javascript">
		window.onload = function() {

			getAantalVragen();

		};
		var IDvraag = 0;
		var IDvraag2 = 0;
		var aantal2 = 0;
		var aantalVragen = 0;

		function getID(id) {
			$.ajax({
				type : "GET",
				url : 'script.php',
				data : {
					nextID : id
				},
				success : function(data) {
					window.location.href = "#vraagPagina" + data + "";

				}
			});

		}

		function tokenOpvragen() {
			var token = prompt("Gelieve een token in te vullen:", "");

			$.ajax({
				type : "GET",
				url : 'script.php',
				data : {
					token : token
				},
				success : function(data) {
					if (data == 1) {
						window.location.href = "#vraagPagina" + data + "";

					} else {
						alert("Dit is een ongeldig of verlopen token.");
					}

				}
			});

		};

		function kijkVraagNa() {
			var value = window.location.href.substring(window.location.href.lastIndexOf('/') + 1);
			value = value.match(/\d+$/)[0];

			if (value == 1) {
				if (!$("input[name='1']:checked").val()) {
					alert('Gelieve een optie te kiezen. Deze keuze heeft invloed op het verloop van de vragen.');
					return;
				} else {
					var kolom = $("input:radio[name='" + value + "']:checked").attr('id');
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V1=0');
					});
					if (kolom == "V1_1") {
						db.transaction(function(tx) {tx.executeSql('UPDATE tbl_antwoorden SET V1=1');});
					} else {
						db.transaction(function(tx) {tx.executeSql('UPDATE tbl_antwoorden SET V1=0');});
					}
					var id = $("input:radio[name='" + value + "']:checked").attr('id');
					getID(id);
				}

			}
			if (value == 2) {
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V2_1="0",V2_2="0",V2_3="0",V2_4="0",V2_5="0",V2_6="0",V2_7="0",V2_8="0",V2_9="0"');
				});
				
				if ($('#V2_1').prop('checked')) {
					db.transaction(function(tx) {tx.executeSql('UPDATE tbl_antwoorden SET V2_1=1');});
				}
				
				if ($('#V2_2').prop('checked')) {
					db.transaction(function(tx) {tx.executeSql('UPDATE tbl_antwoorden SET V2_2=1');});
				}
				// @FIXME : die var declaraties zijn hier niet nodig : zie de 2 if statements hierboven
				var aangeduid = $('#V2_3').prop('checked');
				if (aangeduid == true) {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V2_3=1');
					});
				}
				var aangeduid = $('#V2_4').prop('checked');
				if (aangeduid == true) {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V2_4=1');
					});
				}
				var aangeduid = $('#V2_5').prop('checked');
				if (aangeduid == true) {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V2_5=1');
					});
				}
				var aangeduid = $('#V2_6').prop('checked');
				if (aangeduid == true) {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V2_6=1');
					});
				}
				var aangeduid = $('#V2_7').prop('checked');
				if (aangeduid == true) {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V2_7=1');
					});
				}
				var aangeduid = $('#V2_8').prop('checked');
				if (aangeduid == true) {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V2_8=1');
					});
				}
				var aangeduid = $('#V2_9').prop('checked');
				if (aangeduid == true) {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V2_9=1');
					});
				}

				var id = "V2_1";

				getID(id);
			}
			if (value == 3) {

				if (!$("input[name='3']:checked").val()) {
					alert('Gelieve een optie te kiezen. Deze keuze heeft invloed op het verloop van de vragen.');
					return;
				} else {
					var kolom = $("input:radio[name='" + value + "']:checked").attr('id');
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V3="0"');
					});
					if (kolom == "V3_1") {
						db.transaction(function(tx) {
							tx.executeSql('UPDATE tbl_antwoorden SET V3=1');
						});
					} else {
						db.transaction(function(tx) {
							tx.executeSql('UPDATE tbl_antwoorden SET V3=0');
						});
					}

					var id = $("input:radio[name='" + value + "']:checked").attr('id');
					getID(id);
				}
			}
			if (value == 4) {

				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V4_1="0",V4_2="0",V4_3="0",V4_4="0",V4_5="0",V4_6="0",V4_7="0",V2_8="0",V2_9="0"');
				});

				var aangeduid = $('#V4_1').prop('checked');
				if (aangeduid == true) {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V4_1=1');
					});
				}

				var aangeduid = $('#V4_2').prop('checked');
				if (aangeduid == true) {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V4_2=1');
					});
				}
				var aangeduid = $('#V4_3').prop('checked');
				if (aangeduid == true) {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V4_3=1');
					});
				}
				var aangeduid = $('#V4_4').prop('checked');
				if (aangeduid == true) {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V4_4=1');
					});
				}
				var aangeduid = $('#V4_5').prop('checked');
				if (aangeduid == true) {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V4_5=1');
					});
				}
				var aangeduid = $('#V4_6').prop('checked');
				if (aangeduid == true) {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V4_6=1');
					});
				}
				var aangeduid = $('#V4_7').prop('checked');
				if (aangeduid == true) {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V4_7=1');
					});
				}
				var aangeduid = $('#V4_8').prop('checked');
				if (aangeduid == true) {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V4_8=1');
					});
				}
				var aangeduid = $('#V4_9').prop('checked');
				if (aangeduid == true) {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V4_9=1');
					});
				}

				var id = "V4_1";

				getID(id);
			}
			if (value == 5) {
				if (!$("input[name='5']:checked").val()) {
					alert('Gelieve een optie te kiezen. Deze keuze heeft invloed op het verloop van de vragen.');
					return;
				} else {
					var kolom = $("input:radio[name='" + value + "']:checked").attr('id');

					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V5="0"');
					});
					var id = $("input:radio[name='" + value + "']:checked").attr('id');
					if (kolom == "V5_1") {
						db.transaction(function(tx) {
							tx.executeSql('UPDATE tbl_antwoorden SET V5=1');
						});
						getID(id);
					} else {
						db.transaction(function(tx) {
							tx.executeSql('UPDATE tbl_antwoorden SET V5=0');
						});
						window.location.href = "#einde";
					}
				}
			}
			if (value == 6) {
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V6_1="0",V6_2="0",V6_3="0",V6_4="0",V6_5="0",V6_6="0",V6_7="0",V6_8="0",V6_9="0"');
				});

				var aangeduid = $('#V6_1').prop('checked');
				if (aangeduid == true) {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V6_1=1');
					});
				}

				var aangeduid = $('#V6_2').prop('checked');
				if (aangeduid == true) {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V6_2=1');
					});
				}
				var aangeduid = $('#V6_3').prop('checked');
				if (aangeduid == true) {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V6_3=1');
					});
				}
				var aangeduid = $('#V6_4').prop('checked');
				if (aangeduid == true) {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V6_4=1');
					});
				}
				var aangeduid = $('#V6_5').prop('checked');
				if (aangeduid == true) {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V6_5=1');
					});
				}
				var aangeduid = $('#V6_6').prop('checked');
				if (aangeduid == true) {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V6_6=1');
					});
				}
				var aangeduid = $('#V6_7').prop('checked');
				if (aangeduid == true) {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V6_7=1');
					});
				}
				var aangeduid = $('#V6_8').prop('checked');
				if (aangeduid == true) {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V6_8=1');
					});
				}
				var aangeduid = $('#V6_9').prop('checked');
				if (aangeduid == true) {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V6_9=1');
					});
				}

				var id = "V6_1";
				getID(id);
			}
			if (value == 7) {
				var kolom = $("input:radio[name='" + value + "']:checked").attr('id');

				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V7_1=0, V7_2=0, V7_3=0, V7_4=0, V7_5=0, V7_6=0, V7_7=0, V7_8=0, V7_9=0');

				});
				if (kolom == "V7_1") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V7_1=1');
					});
				} else if (kolom == "V7_2") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V7_2=1');
					});
				} else if (kolom == "V7_3") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V7_3=1');
					});
				} else if (kolom == "V7_4") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V7_4=1');
					});
				} else if (kolom == "V7_5") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V7_5=1');
					});
				} else if (kolom == "V7_6") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V7_6=1');
					});
				} else if (kolom == "V7_7") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V7_7=1');
					});
				} else if (kolom == "V7_8") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V7_8=1');
					});
				} else {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V7_9=1');
					});
				}

				var id = $("input:radio[name='" + value + "']:checked").attr('id');

				if (id == undefined) {
					var id = "V7_1";
				}

				getID(id);
			}
			if (value == 8) {
				var kolom = $("input:radio[name='" + value + "']:checked").attr('id');
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V8_1=0, V8_2=0, V8_3=0, V8_4=0');
				});
				if (kolom == "V8_1") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V8_1=1');
					});
				} else if (kolom == "V8_2") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V8_2=1');
					});
				} else if (kolom == "V8_3") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V8_3=1');
					});
				} else if (kolom == "V8_4") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V8_4=1');
					});
				}

				var id = $("input:radio[name='" + value + "']:checked").attr('id');
				if (id == undefined) {
					var id = "V8_1";
				}
				getID(id);
			}
			if (value == 9) {
				var kolom = $("input:radio[name='" + value + "']:checked").attr('id');
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V9_1=0, V9_2=0, V9_3=0, V9_4=0');
				});
				if (kolom == "V9_1") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V9_1=1');
					});
				} else if (kolom == "V9_2") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V9_2=1');
					});
				} else if (kolom == "V9_3") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V9_3=1');
					});
				} else if (kolom == "V9_4") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V9_4=1');
					});
				}

				var id = $("input:radio[name='" + value + "']:checked").attr('id');
				if (id == undefined) {
					var id = "V9_1";
				}
				getID(id);
			}
			if (value == 10) {

				var id = "V10";
				var val = $('#V10').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V10=' + val + '');
				});
				getID(id);
			}
			if (value == 11) {

				var id = "V11";
				var val = $('#V11').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V11=' + val + '');
				});
				getID(id);
			}

			if (value == 12) {
				var id = "V12_1";

				var val = $('#12').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V12_1=' + val + '');
				});
				getID(id);
			}
			if (value == 13) {
				var id = "V12_2";

				var val = $('#13').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V12_2=' + val + '');
				});
				getID(id);
			}
			if (value == 14) {
				var id = "V13_1";
				var val = $('#V13_1').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V13=' + val + '');
				});
				getID(id);
			}
			if (value == 15) {
				var id = "V14_1";
				var val = $('#V14_1').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V14_1=' + val + '');
				});
				getID(id);
			}
			if (value == 16) {
				var id = "V14_2";
				var val = $('#V14_2').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V14_2=' + val + '');
				});
				getID(id);
			}
			if (value == 17) {
				var id = "V14_3";
				var val = $('#V14_3').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V14_3=' + val + '');
				});
				getID(id);
			}
			if (value == 18) {
				var id = "V14_4";
				var val = $('#V14_4').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V14_4=' + val + '');
				});
				getID(id);
			}
			if (value == 19) {
				var id = "V14_5";
				var val = $('#V14_5').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V14_5=' + val + '');
				});
				getID(id);
			}
			if (value == 20) {
				var id = "V15_1";
				var val = $('#V15_1').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V15_1=' + val + '');
				});
				getID(id);
			}
			if (value == 21) {
				var id = "V15_2";
				var val = $('#V15_2').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V15_2=' + val + '');
				});
				getID(id);
			}
			if (value == 22) {
				var id = "V16_1";
				var val = $('#V16_1').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V16_1=' + val + '');
				});
				getID(id);
			}
			if (value == 23) {
				var id = "V16_2";
				var val = $('#V16_2').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V16_2=' + val + '');
				});
				getID(id);
			}
			if (value == 24) {
				var id = "V16_3";
				var val = $('#V16_3').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V16_3=' + val + '');
				});
				getID(id);
			}
			if (value == 25) {
				var id = "V16_4";
				var val = $('#V16_4').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V16_4=' + val + '');
				});
				getID(id);
			}
			if (value == 26) {
				var id = "V16_5";
				var val = $('#V16_5').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V16_5=' + val + '');
				});
				getID(id);
			}
			if (value == 27) {
				var id = "V16_6";
				var val = $('#V16_6').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V16_6=' + val + '');
				});
				getID(id);
			}
			if (value == 28) {
				var id = "V16_7";
				var val = $('#V16_7').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V16_7=' + val + '');
				});
				getID(id);
			}
			if (value == 29) {
				var id = "V16_8";
				var val = $('#V16_8').val();
				if (val == "0") {
					val = 7;
				}
				if (val == "1") {
					val = 6;
				}
				if (val == "2") {
					val = 5;
				}
				if (val == "3") {
					val = 4;
				}
				if (val == "4") {
					val = 3;
				}
				if (val == "5") {
					val = 2;
				}
				if (val == "6") {
					val = 1;
				}
				if (val == "7") {
					val = 0;
				}
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V16_8=' + val + '');
				});
				getID(id);
			}
			if (value == 30) {
				var id = "V16_9";
				var val = $('#V16_9').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V16_9=' + val + '');
				});
				getID(id);
			}
			if (value == 31) {
				var id = "V16_10";
				var val = $('#V16_10').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V16_10=' + val + '');
				});
				getID(id);
			}
			if (value == 32) {
				var id = "V16_11";
				var val = $('#V16_11').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V16_11=' + val + '');
				});
				getID(id);
			}
			if (value == 33) {
				var id = "V16_12";
				var val = $('#V16_12').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V16_12=' + val + '');
				});
				getID(id);
			}
			if (value == 34) {
				var id = "V16_13";
				var val = $('#V16_13').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V16_13=' + val + '');
				});
				getID(id);
			}
			if (value == 35) {
				var id = "V16_14";
				var val = $('#V16_14').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V16_14=' + val + '');
				});
				getID(id);
			}
			if (value == 36) {
				var id = "V16_15";
				var val = $('#V16_15').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V16_15=' + val + '');
				});
				getID(id);
			}
			if (value == 37) {
				var id = "V16_16";
				var val = $('#V16_16').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V16_16=' + val + '');
				});
				getID(id);
			}
			if (value == 38) {
				var id = "V16_17";
				var val = $('#V16_17').val();
				if (val == "0") {
					val = 7;
				}
				if (val == "1") {
					val = 6;
				}
				if (val == "2") {
					val = 5;
				}
				if (val == "3") {
					val = 4;
				}
				if (val == "4") {
					val = 3;
				}
				if (val == "5") {
					val = 2;
				}
				if (val == "6") {
					val = 1;
				}
				if (val == "7") {
					val = 0;
				}
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V16_17=' + val + '');
				});
				getID(id);
			}
			if (value == 39) {
				var id = "V16_18";
				var val = $('#V16_18').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V16_18=' + val + '');
				});
				getID(id);
			}
			if (value == 40) {
				var id = "V17_1";
				var val = $('#V17_1').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V17_1=' + val + '');
				});
				getID(id);
			}
			if (value == 41) {
				var id = "V17_2";
				var val = $('#V17_2').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V17_2=' + val + '');
				});
				getID(id);
			}
			if (value == 42) {
				var id = "V17_3";
				var val = $('#V17_3').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V17_3=' + val + '');
				});
				getID(id);
			}
			if (value == 43) {
				var id = "V17_4";
				var val = $('#V17_4').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V17_4=' + val + '');
				});
				getID(id);
			}
			if (value == 44) {
				var id = "V17_5";
				var val = $('#V17_5').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V17_5=' + val + '');
				});
				getID(id);
			}
			if (value == 45) {
				var id = "V17_6";
				var val = $('#V17_6').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V17_6=' + val + '');
				});
				getID(id);
			}
			if (value == 46) {
				var id = "V18_1";
				var val = $('#V18_1').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V18_1=' + val + '');
				});
				getID(id);
			}
			if (value == 47) {
				var id = "V18_2";
				var val = $('#V18_2').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V18_2=' + val + '');
				});
				getID(id);
			}
			if (value == 48) {
				var id = "V18_3";
				var val = $('#V18_3').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V18_3=' + val + '');
				});
				getID(id);
			}
			if (value == 49) {
				var id = "V18_4";
				var val = $('#V18_4').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V18_4=' + val + '');
				});
				getID(id);
			}
			if (value == 50) {
				var id = "V18_5";
				var val = $('#V18_5').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V18_5=' + val + '');
				});
				getID(id);
			}
			if (value == 51) {
				var id = "V18_6";
				var val = $('#V18_6').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V18_6=' + val + '');
				});
				getID(id);
			}
			if (value == 52) {
				var id = "V19_1";
				var val = $('#V19_1').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V19_1=' + val + '');
				});
				getID(id);
			}
			if (value == 53) {
				var id = "V19_2";
				var val = $('#V19_2').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V19_2=' + val + '');
				});
				getID(id);
			}
			if (value == 54) {
				var id = "V19_3";
				var val = $('#V19_3').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V19_3=' + val + '');
				});
				getID(id);
			}
			if (value == 55) {
				var id = "V19_4";
				var val = $('#V19_4').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V19_4=' + val + '');
				});
				getID(id);
			}
			if (value == 56) {
				var id = "V19_5";
				var val = $('#V19_5').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V19_5=' + val + '');
				});
				getID(id);
			}
			if (value == 57) {
				var id = "V20_1";
				var val = $('#V20_1').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V20_1=' + val + '');
				});
				getID(id);
			}
			if (value == 58) {
				var id = "V20_2";
				var val = $('#V20_2').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V20_2=' + val + '');
				});
				getID(id);
			}
			if (value == 59) {
				var id = "V20_3";
				var val = $('#V20_3').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V20_3=' + val + '');
				});
				getID(id);
			}
			if (value == 60) {
				var id = "V20_4";
				var val = $('#V20_4').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V20_4=' + val + '');
				});
				getID(id);
			}
			if (value == 61) {
				var id = "V20_5";
				var val = $('#V20_5').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V20_5=' + val + '');
				});
				getID(id);
			}
			if (value == 62) {
				var id = "V20_6";
				var val = $('#V20_6').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V20_6=' + val + '');
				});
				getID(id);
			}
			if (value == 63) {
				var id = "V21_1";
				var val = $('#V21_1').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V21_1=' + val + '');
				});
				getID(id);
			}
			if (value == 64) {
				var id = "V21_2";
				var val = $('#V21_2').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V21_2=' + val + '');
				});
				getID(id);
			}
			if (value == 65) {
				var id = "V21_3";
				var val = $('#V21_3').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V21_3=' + val + '');
				});
				getID(id);
			}
			if (value == 66) {
				var id = "V21_4";
				var val = $('#V21_4').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V21_4=' + val + '');
				});
				getID(id);
			}
			if (value == 67) {
				var id = "V22_1";
				var val = $('#V22_1').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V22_1=' + val + '');
				});
				getID(id);
			}
			if (value == 68) {
				var id = "V22_2";
				var val = $('#V22_2').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V22_2=' + val + '');
				});
				getID(id);
			}
			if (value == 69) {
				var id = "V22_3";
				var val = $('#V23_3').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V22_3=' + val + '');
				});
				getID(id);
			}
			if (value == 70) {
				var id = "V22_4";
				var val = $('#V22_4').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V22_4=' + val + '');
				});
				getID(id);
			}
			if (value == 71) {
				var id = "V22_5";
				var val = $('#V22_5').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V22_5=' + val + '');
				});
				getID(id);
			}
			if (value == 72) {
				var id = "V22_6";
				var val = $('#V22_6').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V22_6=' + val + '');
				});
				getID(id);
			}
			if (value == 73) {
				var id = "V22_7";
				var val = $('#V22_7').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V22_7=' + val + '');
				});
				getID(id);
			}
			if (value == 74) {
				var id = "V23";
				var val = $('#74').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V23=' + val + '');
				});
				getID(id);
			}
			if (value == 75) {
				var kolom = $("input:radio[name='" + value + "']:checked").attr('id');

				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V24_1="0",V24_2="0",V24_3="0",V24_4="0",V24_4t="0"');
				});

				if (kolom == "V24_1") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V24_1=1');
					});
				} else if (kolom == "V24_2") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V24_2=1');
					});
				} else if (kolom == "V24_3") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V24_3=1');
					});
				} else if (kolom == "V24_4") {
					var val = $('#75').val();

					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V24_4="1",V24_4t="' + val + '"');
					});
				}
				var id = $("input:radio[name='" + value + "']:checked").attr('id');
				if (id == undefined) {
					id = "V24_1";
				}
				getID(id);
			}
			if (value == 76) {
				var id = "V25_1";
				var val = $('#76').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V25_1=' + val + '');
				});
				getID(id);
			}
			if (value == 77) {
				var kolom = $("input:radio[name='" + value + "']:checked").attr('id');
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V25_2=0');
				});
				if (kolom == "V25_2") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V25_2=1');
					});
				} else {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V25_2=0');
					});
				}
				var id = $("input:radio[name='" + value + "']:checked").attr('id');
				if (id == undefined) {
					id = "V25_2";
				}
				getID(id);
			}
			if (value == 78) {
				var kolom = $("input:radio[name='" + value + "']:checked").attr('id');
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V25_3=0');
				});
				if (kolom == "V25_4") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V25_3=1');
					});
				} else {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V25_3=0');
					});
				}
				var id = $("input:radio[name='" + value + "']:checked").attr('id');
				if (id == undefined) {
					id = "V25_4";
				}
				getID(id);
			}
			if (value == 79) {
				var kolom = $("input:radio[name='" + value + "']:checked").attr('id');
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V25_4=0,V25_5=0,V25_6=0');
				});
				if (kolom == "V25_6") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V25_4=1');
					});
				} else if (kolom == "V25_7") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V25_5=1');
					});
				} else {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V25_6=1');
					});
				}
				var id = $("input:radio[name='" + value + "']:checked").attr('id');
				if (id == undefined) {
					id = "V25_6";
				}
				getID(id);
			}
			if (value == 80) {
				var id = "V25_9";
				var val = $('#80').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V25_7=' + val + '');
				});
				getID(id);
			}
			if (value == 81) {
				var kolom = $("input:radio[name='" + value + "']:checked").attr('id');
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V26=0');
				});
				if (kolom == "V26_1") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V26=1');
					});
				} else {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V26=0');
					});
				}
				var id = $("input:radio[name='" + value + "']:checked").attr('id');
				if (id == undefined) {
					id = "V26_1";
				}
				getID(id);
			}
			if (value == 82) {
				var kolom = $("input:radio[name='" + value + "']:checked").attr('id');
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V27=0');
				});
				if (kolom == "V27_1") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V27=1');
					});
				} else {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V27=0');
					});
				}
				var id = $("input:radio[name='" + value + "']:checked").attr('id');
				if (id == undefined) {
					id = "V27_1";
				}
				getID(id);
			}
			if (value == 83) {
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V28_1=0');
				});
				var kolom = $("input:radio[name='" + value + "']:checked").attr('id');
				if (kolom == "V28_1") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V28_1=1');
					});
				} else {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V28_1=0');
					});
				}
				var id = $("input:radio[name='" + value + "']:checked").attr('id');
				if (id == undefined) {
					id = "V28_1";
				}
				getID(id);
			}
			if (value == 84) {
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V28_2=0');
				});
				var id = "V28_3";
				var val = $('#84').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V28_2=' + val + '');
				});
				getID(id);
			}

			if (value == 85) {
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V28_3="0",V28_4="0",V28_5="0",V28_6="0",V28_6t="0",V28_7="0"');
				});
				var kolom = $("input:radio[name='" + value + "']:checked").attr('id');
				if (kolom == "V28_4") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET v28_3="1"');
					});
				}
				if (kolom == "V28_5") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET v28_4="1"');
					});
				}
				if (kolom == "V28_6") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET v28_5="1"');
					});
				}
				if (kolom == "V28_7") {
					var val = $('#85').val();
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET v28_6="1",V28_6t="' + val + '"');
					});
				}
				if (kolom == "V28_8") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET v28_7="1"');
					});
				}
				var id = $("input:radio[name='" + value + "']:checked").attr('id');
				if (id == undefined) {
					id = "V28_4";
				}
				getID(id);
			}

			if (value == 86) {
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V28_8="0",V28_9="0",V28_10="0",V28_11="0",V28_11t="0",V28_12="0"');
				});
				var kolom = $("input:radio[name='" + value + "']:checked").attr('id');
				if (kolom == "V28_9") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET v28_8="1"');
					});
				}
				if (kolom == "V28_10") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET v28_9="1"');
					});
				}
				if (kolom == "V28_11") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET v28_10="1"');
					});
				}
				if (kolom == "V28_12") {
					var val = $('#86').val();
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET v28_11="1",V28_11t="' + val + '"');
					});
				}
				if (kolom == "V28_13") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET v28_12="1"');
					});
				}
				if (id == undefined) {
					id = "V28_9";
				}
				var id = $("input:radio[name='" + value + "']:checked").attr('id');

				getID(id);
			}
			if (value == 87) {
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V28_13="0",V28_14="0",V28_15="0",V28_16="0",V28_16t="0",V28_17="0"');
				});
				var kolom = $("input:radio[name='" + value + "']:checked").attr('id');
				if (kolom == "V28_14") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET v28_13="1"');
					});
				}
				if (kolom == "V28_15") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET v28_14="1"');
					});
				}
				if (kolom == "V28_16") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET v28_15="1"');
					});
				}
				if (kolom == "V28_17") {
					var val = $('#87').val();
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET v28_16="1",V28_16t="' + val + '"');
					});
				}
				if (kolom == "V28_18") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET v28_17="1"');
					});
				}
				var id = $("input:radio[name='" + value + "']:checked").attr('id');
				if (id == undefined) {
					id = "V28_14";
				}
				getID(id);
			}
			if (value == 88) {
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V28_18="0",V28_19="0",V28_20="0",V28_21="0",V28_21t="0",V28_22="0"');
				});
				var kolom = $("input:radio[name='" + value + "']:checked").attr('id');
				if (kolom == "V28_19") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET v28_18="1"');
					});
				}
				if (kolom == "V28_20") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET v28_19="1"');
					});
				}
				if (kolom == "V28_21") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET v28_20="1"');
					});
				}
				if (kolom == "V28_22") {
					var val = $('#88').val();
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET v28_21="1",V28_21t="' + val + '"');
					});
				}
				if (kolom == "V28_23") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET v28_22="1"');
					});
				}
				var id = $("input:radio[name='" + value + "']:checked").attr('id');
				if (id == undefined) {
					id = "V28_19";
				}
				getID(id);
			}
			if (value == 89) {
				var kolom = $("input:radio[name='" + value + "']:checked").attr('id');
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V28_23=0');
				});
				if (kolom == "V28_24") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V28_23=1');
					});
				} else {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V28_23=0');
					});
				}
				var id = $("input:radio[name='" + value + "']:checked").attr('id');
				if (id == undefined) {
					id = "V28_24";
				}
				getID(id);
			}
			if (value == 90) {
				var kolom = $("input:radio[name='" + value + "']:checked").attr('id');
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V28_24=0');
				});
				if (kolom == "V28_24") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V28_24=1');
					});
				} else {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V28_24=0');
					});
				}
				var id = $("input:radio[name='" + value + "']:checked").attr('id');
				if (id == undefined) {
					id = "V28_24";
				}
				getID(id);
			}
			if (value == 91) {
				var id = "V29_1";
				var val = $('#91').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V29_1=' + val + '');
				});
				getID(id);
			}
			if (value == 92) {
				var id = "V29_2";
				var val = $('#91').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V29_2=' + val + '');
				});
				getID(id);
			}
			if (value == 93) {
				var id = "V30_1";
				var val = $('#V30_1').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V30_1=' + val + '');
				});
				getID(id);
			}
			if (value == 94) {
				var id = "V30_2";
				var val = $('#V30_2').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V30_2=' + val + '');
				});
				getID(id);
			}
			if (value == 95) {
				var id = "V30_3";
				var val = $('#V30_3').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V30_3=' + val + '');
				});
				getID(id);
			}
			if (value == 96) {
				var id = "V30_4";
				var val = $('#V30_4').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V30_4=' + val + '');
				});
				getID(id);
			}
			if (value == 97) {
				var id = "V30_5";
				var val = $('#V30_5').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V30_5=' + val + '');
				});
				getID(id);
			}
			if (value == 98) {
				var id = "V30_6";
				var val = $('#V30_6').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V30_63=' + val + '');
				});
				getID(id);
			}
			if (value == 99) {
				var id = "V30_7";
				var val = $('#V30_7').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V30_7=' + val + '');
				});
				getID(id);
			}
			if (value == 100) {
				var id = "V30_8";
				var val = $('#V30_8').val();
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V30_8=' + val + '');
				});
				getID(id);
			}
			if (value == 101) {
				var kolom = $("input:radio[name='" + value + "']:checked").attr('id');
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V31_1="0",V31_2="0",V31_3="0",V31_4="0",V31_5="0",V31_6="0"');
				});
				if (kolom == "V31_1") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V31_1=1');
					});
				} else if (kolom == "V31_2") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V31_2=1');
					});
				} else if (kolom == "V31_3") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V31_3=1');
					});
				} else if (kolom == "V31_4") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V31_4=1');
					});
				} else if (kolom == "V31_5") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V31_5=1');
					});
				} else if (kolom == "V31_6") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V31_6=1');
					});
				}

				var id = $("input:radio[name='" + value + "']:checked").attr('id');
				if (id == undefined) {
					id = "V31_1";
				}
				getID(id);
			}
			if (value == 102) {
				var kolom = $("input:radio[name='" + value + "']:checked").attr('id');
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V32_1="0"');
				});
				if (kolom == "V32_3") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V32_1=1');
					});
				} else {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V32_1=0');
					});
				}

				var id = $("input:radio[name='" + value + "']:checked").attr('id');
				if (id == undefined) {
					id = "V32_2";
				}
				getID(id);
			}
			if (value == 103) {
				var kolom = $("input:radio[name='" + value + "']:checked").attr('id');
				db.transaction(function(tx) {
					tx.executeSql('UPDATE tbl_antwoorden SET V32_2="0"');
				});
				if (kolom == "V32_2") {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V32_2=1');
					});
				} else {
					db.transaction(function(tx) {
						tx.executeSql('UPDATE tbl_antwoorden SET V32_2=0');
					});
				}

				var id = $("input:radio[name='" + value + "']:checked").attr('id');
				$.ajax({
					type : "GET",
					url : 'script.php',
					data : {
						nextID : id
					},
					success : function(data) {
						window.location.href = "#einde";

					}
				});
			}
		}

		function VulVraag(IDvraag) {
			//IDvraag = IDvraag + 1;
			console.log("IDvraag: " + IDvraag);

			$.ajax({
				type : "GET",
				url : 'script.php',
				data : {
					vraagID : IDvraag
				},
				success : function(data) {
					document.getElementById("#vraag" + IDvraag).innerHTML = data;
				}
			});

		}

		function getAantalVragen() {
			$.ajax({
				type : "GET",
				url : 'script.php',
				data : {
					aantal : aantal2
				},
				success : function(data) {
					aantalVragen = parseInt(data);
					MaakDivs();
				}
			});
		}

		var V14_4 = 0, V14_5 = 0, V16_1 = 0, V16_2 = 0, V16_3 = 0,V16_4 = 0, V16_5 = 0, V16_6 = 0, V16_7 = 0, V16_8 = 0, V16_8b = 0;

		var V16_9 = 0, V16_10 = 0, V16_11 = 0, V16_12 = 0, V16_13 = 0, V16_14 = 0, V16_15 = 0, V16_16 = 0, V16_17 = 0, V16_17b = 0, V16_18 = 0;

		var V16_resultaat_h = "";
		var V16_resultaat_l = "";

		var CPO_f = 0;
		var CPO_fm = null;
		var IPO_fm = null;
		var IPO_cm = null;
		var CPO_cm = null;
		var IPO_f = 0;
		var fam_infm = null;
		var commm = null;
		var planningm = null;

		var IPO_c = 0;

		var CPO_c = 0;
		var V17 = 0;
		var V17_1 = 0;
		var V17_2 = 0;
		var V17_3 = 0;
		var V17_4 = 0;
		var V17_5 = 0;
		var V17_6 = 0;

		var fam_inf = 0;
		var V22 = 0;
		var V22_1 = 0;
		var V22_2 = 0;
		var V22_3 = 0;
		var V22_4 = 0;
		var V22_5 = 0;
		var V22_6 = 0;
		var V22_7 = 0;

		var comm = 0;

		var V14 = 0;

		var V14_1 = 0;
		var V14_2 = 0;
		var V14_3 = 0;

		var planning = 0;

		var V10 = 0;
		var V19 = 0;

		var V13 = 0;

		var V15_1 = 0;
		var V15_2 = 0;

		var V2_1 = 0;
		var V2_2 = 0;
		var V2_3 = 0;
		var V2_4 = 0;
		var V2_5 = 0;
		var V2_6 = 0;
		var V2_7 = 0;

		var V16_1m = null, V16_2m = null, V16_3m = null, V16_4m = null, V16_5m = null, V16_6m = null, V16_7m = null, V16_8m = null, V16_9m = null, V16_10m = null, V16_11m = null, V16_12m = null, V16_13m = null, V16_14m = null, V16_15m = null, V16_16m = null, V16_17m = null, V16_18m = null;
		var V17_1m = null, V17_2m = null, V17_3m = null, V17_4m = null, V17_5m = null, V17_6m = null;
		var V22_1m = null, V22_2m = null, V22_3m = null, V22_4m = null, V22_5m = null, V22_6m = null, V22_7m = null;
		var V14_1m = null, V14_2m = null, V14_3m = null;

		var V10m = null, V19m = null, V22_6m = null, V13m = null, V15_1m = null, V15_2m = null;
		var V2_1m = null, V2_2m = null, V2_3m = null, V2_4m = null, V2_5m = null, V2_6m = null, V2_7m = null;



		function gegevensPosten() {

			// V14_4 is nu asynchroon : beter voor de eindgebruiker!
			// En ook duidelijker voor jezelf : alles ivm 14_4 zit hier nu bij elkaar
			// declareer de V14_4m zodat die binnen en buiten de ajax call beschikbaar is
			// maar die variabelen worden hier verder op deze pagina precies niet meer gebruikt, die zijn niet echt meer nodig.
			// deze codeblokken kunnen ook nog eenvoudiger geschreven worden, want als ik me niet vergis, moeten bij al deze blokken dezelfde soort testen en teksten getoond worden (enkel de variabele delen in de namen zijn anders)

			//var V14_4m;
			var vragenArr=["V14_4","V14_5", "V10", "V19", "V22_5", "V22_6", "V13", "V15_1", "V15_2"], i = 0;

			// met een for lus door alle elementen van vragenArr lopen en zo alle vragen opvragen/opvangen
			// zijn er vragen die afwijken van dit systeem?
			for(i = 0; i< vragenArr.length; i++){

				$.ajax({
					type : "GET",
					url : 'script.php',
					data : {
						tekst : vragenArr[i]+"alg",
						teller : i
					},
					success : function(data, status, settings) {
						
						var posArr = this.url.split("=");
						var i = parseInt(posArr[posArr.length - 1]); 
						// teller is normaal achteraan de url toegevoegd
						// we moeten i terug uit de url halen, want op het moment dat we hier komen, is i niet meer de waarde die we in data hebben gestopt
						$("#Tekst" + vragenArr[i] + "alg").html(data);
					}
				});

				$.ajax({
					type : "GET",
					url : 'script.php',
					global : false, // de async false is verwijderd !
					data : {
						mediaan : vragenArr[i],
						teller : i
					},
					success : function(data, status, settings) {
						//V14_4m = parseInt(data); // in data (responseText) zit je mediaan, we zetten die om naar een int


						var posArr = this.url.split("=");
						var i = parseInt(posArr[posArr.length - 1]); 
						// teller is normaal achteraan de url toegevoegd
						// we moeten i terug uit de url halen, want op het moment dat we hier komen, is i niet meer de waarde die we in data hebben gestopt

						db.transaction(function(tx) {
							tx.executeSql('SELECT '+ vragenArr[i] + ' FROM tbl_antwoorden', [], function(tx, results) {
								//V14_4 += results.rows.item(0)[vragenArr[0]];//results.rows.item(0).V14_4
								var waarde = results.rows.item(0)[vragenArr[i]];//results.rows.item(0).V14_4
								var res = vragenArr[i]; // WAAROM hier 14 en niet 14_4!!!???
								var doIt = false;
								if (waarde > parseInt(data)) {// in data (responseText) zit je mediaan, we zetten die om naar een int
									res += "pos";
									doIt = true;
								}else{
									res += "neg";
									doIt = true;
								}

								if(doIt){
									// niet wanneer gelijk aan de mediaan!
									$.ajax({
										type : "GET",
										url : 'script.php',
										data : {
											tekst : res,
											teller : i
										},
										success : function(data) {
											var posArr = this.url.split("=");
											var i = parseInt(posArr[posArr.length - 1]); 
											// teller is normaal achteraan de url toegevoegd
											// we moeten i terug uit de url halen, want op het moment dat we hier komen, is i niet meer de waarde die we in data hebben gestopt
					
											document.getElementById("Tekst"+vragenArr[i]).innerHTML = data;
										}
									});

								}
						
								
	
							}, null);
						});
					}
				});

			}

			

			/*var V14_5m = $.ajax({
				type : "GET",
				url : 'script.php',
				global : false,
				async : false,
				data : {
					mediaan : "V14_5"
				},
				success : function(data) {
					return data;
				}
			}).responseText;
			*/

			$.ajax({
				type : "GET",
				url : 'script.php',
				data : {
					mediaan : "V16_1"
				},
				success : function(data) {
					V16_1m = parseInt(data);
				}
			});

			$.ajax({
				type : "GET",
				url : 'script.php',
				data : {
					mediaan : "V16_2"
				},
				success : function(data) {
					V16_2m = parseInt(data);
				}
			});

			$.ajax({
				type : "GET",
				url : 'script.php',
				data : {
					mediaan : "V16_3"
				},
				success : function(data) {
					V16_3m = parseInt(data);
				}
			});

			$.ajax({
				type : "GET",
				url : 'script.php',
				data : {
					mediaan : "V16_4"
				},
				success : function(data) {
					V16_4m = parseInt(data);
				}
			});

			$.ajax({
				type : "GET",
				url : 'script.php',
				data : {
					mediaan : "V16_5"
				},
				success : function(data) {
					V16_5m = parseInt(data);
				}
			});

			$.ajax({
				type : "GET",
				url : 'script.php',
				data : {
					mediaan : "V16_6"
				},
				success : function(data) {
					V16_6m = parseInt(data);
				}
			});

			$.ajax({
				type : "GET",
				url : 'script.php',
				data : {
					mediaan : "V16_7"
				},
				success : function(data) {
					V16_7m = parseInt(data);
				}
			});

			$.ajax({
				type : "GET",
				url : 'script.php',
				data : {
					mediaan : "V16_8"
				},
				success : function(data) {
					V16_8m = parseInt(data);
				}
			});

			$.ajax({
				type : "GET",
				url : 'script.php',
				data : {
					mediaan : "V16_9"
				},
				success : function(data) {
					V16_9m = parseInt(data);
				}
			});

			$.ajax({
				type : "GET",
				url : 'script.php',
				data : {
					mediaan : "V16_10"
				},
				success : function(data) {
					V16_10m = parseInt(data);
				}
			});

			$.ajax({
				type : "GET",
				url : 'script.php',
				data : {
					mediaan : "V16_11"
				},
				success : function(data) {
					V16_11m = parseInt(data);
				}
			});

			$.ajax({
				type : "GET",
				url : 'script.php',
				data : {
					mediaan : "V16_12"
				},
				success : function(data) {
					V16_12m = parseInt(data);
				}
			});

			$.ajax({
				type : "GET",
				url : 'script.php',
				data : {
					mediaan : "V16_13"
				},
				success : function(data) {
					V16_13m = parseInt(data);
				}
			});

			$.ajax({
				type : "GET",
				url : 'script.php',
				data : {
					mediaan : "V16_14"
				},
				success : function(data) {
					V16_14m = parseInt(data);
				}
			});

			$.ajax({
				type : "GET",
				url : 'script.php',
				data : {
					mediaan : "V16_15"
				},
				success : function(data) {
					V16_15m = parseInt(data);
				}
			});

			$.ajax({
				type : "GET",
				url : 'script.php',
				data : {
					mediaan : "V16_16"
				},
				success : function(data) {
					V16_16m = parseInt(data);
				}
			});

			$.ajax({
				type : "GET",
				url : 'script.php',
				data : {
					mediaan : "V16_17"
				},
				success : function(data) {
					V16_17m = parseInt(data);
				}
			});

			$.ajax({
				type : "GET",
				url : 'script.php',
				data : {
					mediaan : "V16_18"
				},
				success : function(data) {
					V16_18m = parseInt(data);
				}
			});

			
			//var IPO_firm_all = V16_4 + V16_1 + V16_9 + V16_8b + V16_3;
			//	var IPO_change_all = V16_13 + V16_10 + V16_12 + V16_18 + V16_17b;

			$.ajax({
				type : "GET",
				url : 'script.php',
				global : false,
				data : {
					mediaan : "V17_1"
				},
				success : function(data) {
					V17_1m = parseInt(data);
				}
			});

			$.ajax({
				type : "GET",
				url : 'script.php',
				global : false,
				data : {
					mediaan : "V17_2"
				},
				success : function(data) {
					V17_2m = parseInt(data);
				}
			});

			$.ajax({
				type : "GET",
				url : 'script.php',
				global : false,
				data : {
					mediaan : "V17_3"
				},
				success : function(data) {
					V17_3m = parseInt(data);
				}
			});

			$.ajax({
				type : "GET",
				url : 'script.php',
				global : false,
				data : {
					mediaan : "V17_4"
				},
				success : function(data) {
					V17_4m = parseInt(data);
				}
			});

			$.ajax({
				type : "GET",
				url : 'script.php',
				global : false,
				data : {
					mediaan : "V17_5"
				},
				success : function(data) {
					V17_5m = parseInt(data);
				}
			});

			$.ajax({
				type : "GET",
				url : 'script.php',
				global : false,
				data : {
					mediaan : "V17_6"
				},
				success : function(data) {
					V17_6m = parseInt(data);
				}
			});

			
			$.ajax({
				type : "GET",
				url : 'script.php',
				global : false,
				data : {
					mediaan : "V22_1"
				},
				success : function(data) {
					V22_1m = parseInt(data);
				}
			});

			$.ajax({
				type : "GET",
				url : 'script.php',
				global : false,
				data : {
					mediaan : "V22_2"
				},
				success : function(data) {
					V22_2m = parseInt(data);
				}
			});

			$.ajax({
				type : "GET",
				url : 'script.php',
				global : false,
				data : {
					mediaan : "V22_3"
				},
				success : function(data) {
					V22_3m = parseInt(data);
				}
			});

			$.ajax({
				type : "GET",
				url : 'script.php',
				global : false,
				data : {
					mediaan : "V22_4"
				},
				success : function(data) {
					V22_4m = parseInt(data);
				}
			});

			$.ajax({
				type : "GET",
				url : 'script.php',
				global : false,
				data : {
					mediaan : "V22_5"
				},
				success : function(data) {
					V22_5m = parseInt(data);
				}
			});

			$.ajax({
				type : "GET",
				url : 'script.php',
				global : false,
				data : {
					mediaan : "V22_6"
				},
				success : function(data) {
					V22_6m = parseInt(data);
				}
			});
			
			$.ajax({
				type : "GET",
				url : 'script.php',
				global : false,
				data : {
					mediaan : "V22_7"
				},
				success : function(data) {
					V22_7m = parseInt(data);
				}
			});

			

			$.ajax({
				type : "GET",
				url : 'script.php',
				global : false,
				data : {
					mediaan : "V14_1"
				},
				success : function(data) {
					V14_1m = parseInt(data);
				}
			});

			$.ajax({
				type : "GET",
				url : 'script.php',
				global : false,
				data : {
					mediaan : "V14_2"
				},
				success : function(data) {
					V14_2m = parseInt(data);
				}
			});

			$.ajax({
				type : "GET", url : 'script.php', global : false, 
				data : {mediaan : "V14_3"},
				success : function(data) {V14_3m = parseInt(data);}
			});

			

			$.ajax({
				type : "GET", url : 'script.php', global : false,
				data : {mediaan : "V10"},
				success : function(data) {V10m = parseInt(data);}
			});

			$.ajax({
				type : "GET", url : 'script.php', global : false, 
				data : {mediaan : "V19"},
				success : function(data) {V19m = parseInt(data);}
			});


			$.ajax({
				type : "GET", url : 'script.php', global : false,
				data : {mediaan : "V22_6"},
				success : function(data) {V22_6m = parseInt(data);}
			});

			$.ajax({
				type : "GET", url : 'script.php', global : false, 
				data : {mediaan : "V13"},
				success : function(data) {V13m = parseInt(data);}
			});

			$.ajax({
				type : "GET", url : 'script.php', global : false, 
				data : {mediaan : "V15_1"},
				success : function(data) {V15_1m = parseInt(data);}
			});

			$.ajax({
				type : "GET", url : 'script.php', global : false, 
				data : {mediaan : "V15_2"},
				success : function(data) {V15_2m = parseInt(data);}
			});

			$.ajax({
				type : "GET", url : 'script.php', global : false, 
				data : {mediaan : "V2_1"},
				success : function(data) {V2_1m = parseInt(data);}
			});

			$.ajax({
				type : "GET", url : 'script.php', global : false, 
				data : {mediaan : "V2_2"},
				success : function(data) {V2_2m = parseInt(data);}
			});

			$.ajax({
				type : "GET", url : 'script.php', global : false, 
				data : {mediaan : "V2_3"},
				success : function(data) {V2_3m = parseInt(data);}
			});

			$.ajax({
				type : "GET", url : 'script.php', global : false, 
				data : {mediaan : "V2_4"},
				success : function(data) {V2_4m = parseInt(data);}
			});

			$.ajax({
				type : "GET", url : 'script.php', global : false, 
				data : {mediaan : "V2_5"},
				success : function(data) {V2_5m = parseInt(data);}
			});

			$.ajax({
				type : "GET", url : 'script.php', global : false, 
				data : {mediaan : "V2_6"},
				success : function(data) {V2_6m = parseInt(data);}
			});

			$.ajax({
				type : "GET", url : 'script.php', global : false, 
				data : {mediaan : "V2_7"},
				success : function(data) {V2_7m = parseInt(data);}
			});

			var timerTest = setInterval(function(){
				
				// we testen dit om de 250 ms
				// we weten immers niet of deze data binnen is.
				// een VEEL beter alternatief zou 1 query geweest zijn waarin alle medianen tegelijk opgehaald kon worden.

				//CPO_fm = parseInt(V16_6m) + parseInt(V16_5m) + parseInt(V16_2m) + parseInt(V16_7m);
				if(V16_6m !== null && V16_5m !== null && V16_2m !== null && V16_7m !== null){
					CPO_fm = V16_6m + V16_5m + V16_2m + V16_7m;
				}
				
				//IPO_fm = parseInt(V16_4m) + parseInt(V16_1m) + parseInt(V16_9m) + parseInt(V16_8m);
				if(V16_4m !== null && V16_1m !== null && V16_9m !== null && V16_8m !== null){
					IPO_fm = V16_4m + V16_1m + V16_9m + V16_8m;
				}

				//IPO_cm = parseInt(V16_13m) + parseInt(V16_10m) + parseInt(V16_12m) + parseInt(V16_18m);
				if(V16_13m !== null && V16_10m !== null && V16_12m !== null && V16_18m !== null){
					IPO_cm = V16_13m + V16_10m + V16_12m + V16_18m;
				}

				//CPO_cm = parseInt(V16_14m) + parseInt(V16_15m) + parseInt(V16_11m) + parseInt(V16_16m);
				if(V16_14m !== null && V16_15m !== null && V16_11m !== null && V16_16m !== null){
					CPO_cm = V16_14m + V16_15m + V16_11m + V16_16m;
				}

				//fam_infm = parseInt(V17_1m) + parseInt(V17_2m) + parseInt(V17_3m) + parseInt(V17_5m);
				if(V17_1m !== null && V17_2m !== null && V17_3m !== null && V17_5m !== null){
					fam_infm = V17_1m + V17_2m + V17_3m + V17_5m;
				}

				//commm = parseInt(V22_1m) + parseInt(V22_2m) + parseInt(V22_3m) + parseInt(V22_4m) + parseInt(V22_5m) + parseInt(V22_6m) + parseInt(V22_7m);
				if(V22_1m !== null && V22_2m !== null && V22_3m !== null && V22_4m !== null && V22_5m !== null && V22_6m !== null){
					commm = V22_1m + V22_2m + V22_3m + V22_4m + V22_5m + V22_6m;
				}

				//planningm = parseInt(V14_1m) + parseInt(V14_2m) + parseInt(V14_3m);
				if(V14_1m !== null && V14_2m !== null && V14_3m !== null){
					planningm = V14_1m + V14_2m + V14_3m;
				}

				if(CPO_fm !== null && IPO_fm != null && IPO_cm != null && CPO_cm != null && fam_infm != null && commm != null && planningm != null ){
					// ok, we hebben alle mediane data !
					// nu de rest van de teksten ophalen en de grafiek tekenen...
					// de functie bewaarOnline gaat de data lokaal ophalen, en doorsturen naar het online script.
					// on success (dus goed online opgeladen), zal ook de grafiek functie opgeroepen worden.
					bewaarOnline();


					if (CPO_f < CPO_fm) {
						V16_resultaat_l += "CPO_f ";
						document.getElementById("TekstV16l").innerHTML = "In vergelijking met de andere ondernemingen in onze database scoort u relatief laag voor wat betreft: " + V16_resultaat_l;
					}

					if (CPO_f > CPO_fm) {
						V16_resultaat_h += "CPO_f ";
						document.getElementById("TekstV16h").innerHTML = "In vergelijking met de andere ondernemingen in onze database scoort u relatief hoog voor wat betreft: " + V16_resultaat_h;
					}

					////////////////////////////////////
					if (IPO_f < IPO_fm) {
						V16_resultaat_l += "IPO_f ";
						document.getElementById("TekstV16l").innerHTML = "In vergelijking met de andere ondernemingen in onze database scoort u relatief laag voor wat betreft: " + V16_resultaat_l;
					}

					if (IPO_f > IPO_fm) {
						V16_resultaat_h += "IPO_f ";
						document.getElementById("TekstV16h").innerHTML = "In vergelijking met de andere ondernemingen in onze database scoort u relatief hoog voor wat betreft: " + V16_resultaat_h;
					}
					///////////////////////////////////
					if (IPO_c < IPO_cm) {
						V16_resultaat_l += "IPO_c ";
						document.getElementById("TekstV16l").innerHTML = "In vergelijking met de andere ondernemingen in onze database scoort u relatief laag voor wat betreft: " + V16_resultaat_l;
					}

					if (IPO_c > IPO_cm) {
						V16_resultaat_h += "IPO_c ";
						document.getElementById("TekstV16h").innerHTML = "In vergelijking met de andere ondernemingen in onze database scoort u relatief hoog voor wat betreft: " + V16_resultaat_h;
					}

					if (CPO_c < CPO_cm) {
						V16_resultaat_l += "CPO_c ";
						document.getElementById("TekstV16l").innerHTML = "In vergelijking met de andere ondernemingen in onze database scoort u relatief laag voor wat betreft: " + V16_resultaat_l;
					}

					if (CPO_c > CPO_cm) {
						V16_resultaat_h += "CPO_c ";
						document.getElementById("TekstV16h").innerHTML = "In vergelijking met de andere ondernemingen in onze database scoort u relatief hoog voor wat betreft: " + V16_resultaat_h;
					}

					var v22Way = null;
					if (comm < commm) {	v22Way = "neg";	}
					if (comm > commm) {	v22Way = "pos";	}
					if(v22Way !==null){
						$.ajax({
							type : "GET", url : 'script.php',
							data : { tekst : "V22"+v22Way },
							success : function(data) {document.getElementById("TekstV22").innerHTML += data;}
						});
					}
						
					var v14Way = null;
					if (planning < planningm) {	v14Way = "neg";	}
					if (planning > planningm) {	v14Way = "pos";	}
					if (v14Way !== null) {
						$.ajax({
							type : "GET", url : 'script.php',
							data : { tekst : "V14"+ v14Way},
							success : function(data) { document.getElementById("TekstV14").innerHTML = data;}
						});
					}

					//	if (fam_inf < fam_infm) {
					//		document.getElementById("TekstV17").innerHTML = "negatieve tekst";
					//	}

					//	if (fam_inf > fam_infm) {
					//		document.getElementById("TekstV17").innerHTML = "positieve tekst";
					//	}
                    
                   
                    // v17 alg
                    $.ajax({
                        type : "GET",
                        url : 'script.php',
                        data : {
                            tekst : "V17alg"
                        },
                        success : function(data) {
                            document.getElementById("TekstV17alg").innerHTML = data;
                        }
                    });
                    

					var v17Way = null;
					if (fam_inf < fam_infm) {	v17Way = "neg";	}
					if (fam_inf > fam_infm) {	v17Way = "pos";	}
					if (v17Way !== null) {
						$.ajax({
							type : "GET", url : 'script.php',
							data : {tekst : "V17" + v17Way },
							success : function(data) {
								//@FIXME : moet hier ook deze tekst niet anders ingevuld worden?
								document.getElementById("TekstV17").innerHTML = data;//TekstVraag17 + 
							}
						});

					}

					// en nu de interval stoppen!
					clearInterval(timerTest);
					timerTest = null;
				
				}
			}, 250);

			
			db.transaction(function(tx) {
				tx.executeSql('SELECT * FROM tbl_antwoorden', [], function(tx, results) {
					// in plaats van al die queries 1 voor 1 opnieuw te doen, alles in 1 query en
					// de data er uit halen die er in zit!
					V14_5 = results.rows.item(0).V14_5;
					V16_1 = results.rows.item(0).V16_1;
					V16_2 = results.rows.item(0).V16_2;
					V16_3 = results.rows.item(0).V16_3;
					V16_4 = results.rows.item(0).V16_4;
					V16_5 = results.rows.item(0).V16_5;
					V16_6 = results.rows.item(0).V16_6;
					V16_7 = results.rows.item(0).V16_7;
					V16_8 = results.rows.item(0).V16_8;
					V16_8b = results.rows.item(0).V16_8b; // deze kolom zit niet in de DB!!!
					V16_9 = results.rows.item(0).V16_9;
					V16_10 = results.rows.item(0).V16_10;
					V16_11 = results.rows.item(0).V16_11;
					V16_12 = results.rows.item(0).V16_12;
					V16_13 = results.rows.item(0).V16_13;
					V16_14 = results.rows.item(0).V16_14;
					V16_15 = results.rows.item(0).V16_15;
					V16_16 = results.rows.item(0).V16_16;
					V16_17 = results.rows.item(0).V16_17;
					V16_17b = results.rows.item(0).V16_17b; // deze kolom zit niet in deDB!!!
					V16_18 = results.rows.item(0).V16_18;

					CPO_f = V16_6 + V16_5 + V16_2 + V16_7;
					IPO_f = V16_4 + V16_1 + V16_9 + V16_8; // niet V16_8b --> die zit niet in de DB!!!
					IPO_c = V16_13 + V16_10 + V16_12 + V16_18;
					CPO_c = V16_14 + V16_15 + V16_11 + V16_16;

					V17_1 = results.rows.item(0).V17_1;
					V17_2 = results.rows.item(0).V17_2;
					V17_3 = results.rows.item(0).V17_3;
					V17_4 = results.rows.item(0).V17_4;
					V17_5 = results.rows.item(0).V17_5;
					V17_6 = results.rows.item(0).V17_6;

					fam_inf = V17_1 + V17_2 + V17_3 + V17_5;
					
					V22_1 = results.rows.item(0).V22_1;
					V22_2 = results.rows.item(0).V22_2;
					V22_3 = results.rows.item(0).V22_3;
					V22_4 = results.rows.item(0).V22_4;
					V22_5 = results.rows.item(0).V22_5;
					V22_6 = results.rows.item(0).V22_6;
					V22_7 = results.rows.item(0).V22_7;

					comm = V22_1 + V22_2 + V22_3 + V22_4 + V22_5 + V22_6 + V22_7;

					V14_1 = results.rows.item(0).V14_1;
					V14_2 = results.rows.item(0).V14_2;
					V14_3 = results.rows.item(0).V14_3;

					planning = V14_1 + V14_2 + V14_3;

					V10 = results.rows.item(0).V10;
					V19 = results.rows.item(0).V19;
					V22_5 = results.rows.item(0).V22_5;
					V22_6 = results.rows.item(0).V22_6;
					V13 = results.rows.item(0).V13;
					V15_1 = results.rows.item(0).V15_1;
					V15_2 = results.rows.item(0).V15_2;

					V2_1 = results.rows.item(0).V2_1;
					V2_2 = results.rows.item(0).V2_2;
					V2_3 = results.rows.item(0).V2_3;
					V2_4 = results.rows.item(0).V2_4;
					V2_5 = results.rows.item(0).V2_5;
					V2_6 = results.rows.item(0).V2_6;
					V2_7 = results.rows.item(0).V2_7;


					if (V2_1 > 0) {
						$.ajax({
							type : "GET", url : 'script.php', data : { tekst : "V2_1alg"},
							success : function(data) {document.getElementById("TekstV2_1").innerHTML = "<h3>" + data + "</h3>";}
						});
					}
					if (V2_2 > 0) {
						$.ajax({
							type : "GET", url : 'script.php', data : { tekst : "V2_2alg"},
							success : function(data) {document.getElementById("TekstV2_2").innerHTML = "<h3>" + data + "</h3>";}
						});
					}
					if (V2_3 > 0) {
						$.ajax({
							type : "GET", url : 'script.php', data : { tekst : "V2_3alg"},
							success : function(data) {document.getElementById("TekstV2_3").innerHTML = "<h3>" + data + "</h3>";}
						});
					}
					if (V2_4 > 0) {
						$.ajax({
							type : "GET", url : 'script.php', data : { tekst : "V2_4alg"},
							success : function(data) {document.getElementById("TekstV2_4").innerHTML = "<h3>" + data + "</h3>";}
						});
					}
					if (V2_5 > 0) {
						$.ajax({
							type : "GET", url : 'script.php', data : { tekst : "V2_5alg"},
							success : function(data) {document.getElementById("TekstV2_5").innerHTML = "<h3>" + data + "</h3>";}
						});
					}
					if (V2_6 > 0) {
						$.ajax({
							type : "GET", url : 'script.php', data : { tekst : "V2_6alg"},
							success : function(data) {document.getElementById("TekstV2_6").innerHTML = "<h3>" + data + "</h3>";}
						});
					}
					if (V2_7 > 0) {
						$.ajax({
							type : "GET", url : 'script.php', data : { tekst : "V2_7alg"},
							success : function(data) {document.getElementById("TekstV2_7").innerHTML = "<h3>" + data + "</h3>";}
						});
					}


				}, null);
			});

			

            
			var V16_resultaat_alg = "";
			$.ajax({
				type : "GET",
				url : 'script.php',
				data : {
					tekst : "V16alg"
				},
				success : function(data) {
					document.getElementById("TekstV16alg").innerHTML = V16_resultaat_alg + data;
				}
			});

			

			var TekstV22 = "";
			$.ajax({
				type : "GET",
				url : 'script.php',
				data : {
					tekst : "V22alg"
				},
				success : function(data) {
					document.getElementById("TekstV22").innerHTML = TekstV22 + data + '<br>';
				}
			});

		
			//@FIXME : de volgende  ajax calls hebben geen zichtbaar resultaat : er wordt niets in de DOM gestopt !
			// waarom werd dit gedaan?
			var TekstVraag16 = "<h1>Algemene tekst vraag 16:</h1>";
			$.ajax({
				type : "GET",
				url : 'script.php',
				data : {
					tekst : "V16alg"
				},
				success : function(data) {
					TekstVraag16 += data;
				}
			});

			var TekstVraag17 = "<h1>Algemene tekst vraag 17:</h1>";
			$.ajax({
				type : "GET",
				url : 'script.php',
				data : {
					tekst : "V17alg"
				},
				success : function(data) {
					TekstVraag17 += data + '<Br>';
				}
			});

			

			var TekstVraag22 = "<h1>Algemene tekst vraag 22:</h1>";
			$.ajax({
				type : "GET",
				url : 'script.php',
				data : {
					tekst : "V22alg"
				},
				success : function(data) {
					TekstVraag22 += data + '<Br>';
				}
			});

			

			var TekstVraag14 = "<h1>Algemene tekst vraag 14:</h1>";
			$.ajax({
				type : "GET",
				url : 'script.php',
				data : {
					tekst : "V14alg"
				},
				success : function(data) {
					TekstVraag14 += data + '<br>';
				}
			});

					

		}

		function bewaarOnline(){
			var d = new Date();
			var n = d.toLocaleDateString();

			db.transaction(function(tx) {
				tx.executeSql('UPDATE tbl_antwoorden SET invuldatum="' + n + '",naam="' + $('#Naam').val() + '",bedrijf="' + $('#Bedrijfsnaam').val() + '",email="' + $('#Email').val() + '",postcode="' + $('#PostcodeBedrijf').val() + '"');
			});

			var dbV1 = 0, dbV2_1 = 0, dbV2_2 = 0, dbV2_3 = 0, dbV2_4 = 0, dbV2_5 = 0, dbV2_6 = 0, dbV2_7 = 0, dbV2_8 = 0, dbV2_9 = 0, dbV3 = 0, dbV4_1 = 0, dbV4_2 = 0, dbV4_3 = 0, dbV4_4 = 0, dbV4_5 = 0, dbV4_6 = 0, dbV4_7 = 0, dbV4_8 = 0, dbV4_9 = 0, dbV5 = 0, dbV6_1 = 0, dbV6_2 = 0, dbV6_3 = 0, dbV6_4 = 0, dbV6_5 = 0, dbV6_6 = 0, dbV6_7 = 0, dbV6_8 = 0, dbV6_9 = 0, dbV7_1 = 0, dbV7_2 = 0, dbV7_3 = 0, dbV7_4 = 0, dbV7_5 = 0, dbV7_6 = 0, dbV7_7 = 0, dbV7_8 = 0, dbV7_9 = 0, dbV8_1 = 0, dbV8_2 = 0, dbV8_3 = 0, dbV8_4 = 0, dbV9_1 = 0, dbV9_2 = 0, dbV9_3 = 0, dbV9_4 = 0, dbV10 = 0, dbV11 = 0, dbV12_1 = 0, dbV12_2 = 0, dbV13 = 0, dbV14_1 = 0, dbV14_2 = 0, dbV14_3 = 0, dbV14_4 = 0, dbV14_5 = 0, dbV15_1 = 0, dbV15_2 = 0, dbV16_1 = 0, dbV16_2 = 0, dbV16_3 = 0, dbV16_4 = 0, dbV16_5 = 0, dbV16_6 = 0, dbV16_7 = 0, dbV16_8 = 0, dbV16_9 = 0, dbV16_10 = 0, dbV16_11 = 0, dbV16_12 = 0, dbV16_13 = 0, dbV16_14 = 0, dbV16_15 = 0, dbV16_16 = 0, dbV16_17 = 0, dbV16_18 = 0, dbV17_1 = 0, dbV17_2 = 0, dbV17_3 = 0, dbV17_4 = 0, dbV17_5 = 0, dbV17_6 = 0, dbV18_1 = 0, dbV18_2 = 0, dbV18_3 = 0, dbV18_4 = 0, dbV18_5 = 0, dbV18_6 = 0, dbV19_1 = 0, dbV19_2 = 0, dbV19_3 = 0, dbV19_4 = 0, dbV19_5 = 0, dbV20_1 = 0, dbV20_2 = 0, dbV20_3 = 0, dbV20_4 = 0, dbV20_5 = 0, dbV20_6 = 0, dbV21_1 = 0, dbV21_2 = 0, dbV21_3 = 0, dbV21_4 = 0, dbV22_1 = 0, dbV22_2 = 0, dbV22_3 = 0, dbV22_4 = 0, dbV22_5 = 0, dbV22_6 = 0, dbV22_7 = 0, dbV23 = 0, dbV24_1 = 0, dbV24_2 = 0, dbV24_3 = 0, dbV24_4 = 0, dbV24_4t = 0, dbV25_1 = 0, dbV25_2 = 0, dbV25_3 = 0, dbV25_4 = 0, dbV25_5 = 0, dbV25_6 = 0, dbV25_7 = 0, dbV26 = 0, dbV27 = 0, dbV28_1 = 0, dbV28_2 = 0, dbV28_3 = 0, dbV28_4 = 0, dbV28_5 = 0, dbV28_6 = 0, dbV28_6t = 0, dbV28_7 = 0, dbV28_8 = 0, dbV28_9 = 0, dbV28_10 = 0, dbV28_11 = 0, dbV28_11t = 0, dbV28_12 = 0, dbV28_13 = 0, dbV28_14 = 0, dbV28_15 = 0, dbV28_16 = 0, dbV28_16t = 0, dbV28_17 = 0, dbV28_18 = 0, dbV28_19 = 0, dbV28_20 = 0, dbV28_21 = 0, dbV28_21t = 0, dbV28_22 = 0, dbV28_23 = 0, dbV28_24 = 0, dbV29_1 = 0, dbV29_2 = 0, dbV30_1 = 0, dbV30_2 = 0, dbV30_3 = 0, dbV30_4 = 0, dbV30_5 = 0, dbV30_6 = 0, dbV30_7 = 0, dbV30_8 = 0, dbV31_1 = 0, dbV31_2 = 0, dbV31_3 = 0, dbV31_4 = 0, dbV31_5 = 0, dbV31_6 = 0, dbV32_1 = 0, dbV32_2 = 0, bedrijf = 0, invuldatum = 0, bron = 0, naam = 0, email = 0, postcode = 0;

			db.transaction(function(tx) {
				tx.executeSql('SELECT * FROM tbl_antwoorden', [], function(tx, results) {

					var len = results.rows.length, i;
					for ( i = 0; i < len; i++) {
						bedrijf = results.rows.item(i).bedrijf;
						invuldatum = results.rows.item(i).invuldatum;
						bron = results.rows.item(i).bron;
						naam = results.rows.item(i).naam;
						email = results.rows.item(i).email;
						postcode = results.rows.item(i).postcode;
						dbV1 = results.rows.item(i).V1;
						dbV2_1 = results.rows.item(i).V2_1;
						dbV2_2 = results.rows.item(i).V2_2;
						dbV2_3 = results.rows.item(i).V2_3;
						dbV2_4 = results.rows.item(i).V2_4;
						dbV2_5 = results.rows.item(i).V2_5;
						dbV2_6 = results.rows.item(i).V2_6;
						dbV2_7 = results.rows.item(i).V2_7;
						dbV2_8 = results.rows.item(i).V2_8;
						dbV2_9 = results.rows.item(i).V2_9;
						dbV3 = results.rows.item(i).V3;
						dbV4_1 = results.rows.item(i).V4_1;
						dbV4_2 = results.rows.item(i).V4_2;
						dbV4_3 = results.rows.item(i).V4_3;
						dbV4_4 = results.rows.item(i).V4_4;
						dbV4_5 = results.rows.item(i).V4_5;
						dbV4_6 = results.rows.item(i).V4_6;
						dbV4_7 = results.rows.item(i).V4_7;
						dbV4_8 = results.rows.item(i).V4_8;
						dbV4_9 = results.rows.item(i).V4_9;
						dbV5 = results.rows.item(i).V5;
						dbV6_1 = results.rows.item(i).V6_1;
						dbV6_2 = results.rows.item(i).V6_2;
						dbV6_3 = results.rows.item(i).V6_3;
						dbV6_4 = results.rows.item(i).V6_4;
						dbV6_5 = results.rows.item(i).V6_5;
						dbV6_6 = results.rows.item(i).V6_6;
						dbV6_7 = results.rows.item(i).V6_7;
						dbV6_8 = results.rows.item(i).V6_8;
						dbV6_9 = results.rows.item(i).V6_9;
						dbV7_1 = results.rows.item(i).V7_1;
						dbV7_2 = results.rows.item(i).V7_2;
						dbV7_3 = results.rows.item(i).V7_3;
						dbV7_4 = results.rows.item(i).V7_4;
						dbV7_5 = results.rows.item(i).V7_5;
						dbV7_6 = results.rows.item(i).V7_6;
						dbV7_7 = results.rows.item(i).V7_7;
						dbV7_8 = results.rows.item(i).V7_8;
						dbV7_9 = results.rows.item(i).V7_9;
						dbV8_1 = results.rows.item(i).V8_1;
						dbV8_2 = results.rows.item(i).V8_2;
						dbV8_3 = results.rows.item(i).V8_3;
						dbV8_4 = results.rows.item(i).V8_4;
						dbV9_1 = results.rows.item(i).V9_1;
						dbV9_2 = results.rows.item(i).V9_2;
						dbV9_3 = results.rows.item(i).V9_3;
						dbV9_4 = results.rows.item(i).V9_4;
						dbV10 = results.rows.item(i).V10;
						dbV11 = results.rows.item(i).V11;
						dbV12_1 = results.rows.item(i).V12_1;
						dbV12_2 = results.rows.item(i).V12_2;
						dbV13 = results.rows.item(i).V13;
						dbV14_1 = results.rows.item(i).V14_1;
						dbV14_2 = results.rows.item(i).V14_2;
						dbV14_3 = results.rows.item(i).V14_3;
						dbV14_4 = results.rows.item(i).V14_4;
						dbV14_5 = results.rows.item(i).V14_5;
						dbV15_1 = results.rows.item(i).V15_1;
						dbV15_2 = results.rows.item(i).V15_2;
						dbV16_1 = results.rows.item(i).V16_1;
						dbV16_2 = results.rows.item(i).V16_2;
						dbV16_3 = results.rows.item(i).V16_3;
						dbV16_4 = results.rows.item(i).V16_4;
						dbV16_5 = results.rows.item(i).V16_5;
						dbV16_6 = results.rows.item(i).V16_6;
						dbV16_7 = results.rows.item(i).V16_7;
						dbV16_8 = results.rows.item(i).V16_8;
						dbV16_9 = results.rows.item(i).V16_9;
						dbV16_10 = results.rows.item(i).V16_10;
						dbV16_11 = results.rows.item(i).V16_11;
						dbV16_12 = results.rows.item(i).V16_12;
						dbV16_13 = results.rows.item(i).V16_13;
						dbV16_14 = results.rows.item(i).V16_14;
						dbV16_15 = results.rows.item(i).V16_15;
						dbV16_16 = results.rows.item(i).V16_16;
						dbV16_17 = results.rows.item(i).V16_17;
						dbV16_18 = results.rows.item(i).V16_18;
						dbV17_1 = results.rows.item(i).V17_1;
						dbV17_2 = results.rows.item(i).V17_2;
						dbV17_3 = results.rows.item(i).V17_3;
						dbV17_4 = results.rows.item(i).V17_4;
						dbV17_5 = results.rows.item(i).V17_5;
						dbV17_6 = results.rows.item(i).V17_6;
						dbV18_1 = results.rows.item(i).V18_1;
						dbV18_2 = results.rows.item(i).V18_2;
						dbV18_3 = results.rows.item(i).V18_3;
						dbV18_4 = results.rows.item(i).V18_4;
						dbV18_5 = results.rows.item(i).V18_5;
						dbV18_6 = results.rows.item(i).V18_6;
						dbV19_1 = results.rows.item(i).V19_1;
						dbV19_2 = results.rows.item(i).V19_2;
						dbV19_3 = results.rows.item(i).V19_3;
						dbV19_4 = results.rows.item(i).V19_4;
						dbV19_5 = results.rows.item(i).V19_5;
						dbV20_1 = results.rows.item(i).V20_1;
						dbV20_2 = results.rows.item(i).V20_2;
						dbV20_3 = results.rows.item(i).V20_3;
						dbV20_4 = results.rows.item(i).V20_4;
						dbV20_5 = results.rows.item(i).V20_5;
						dbV20_6 = results.rows.item(i).V20_6;
						dbV21_1 = results.rows.item(i).V21_1;
						dbV21_2 = results.rows.item(i).V21_2;
						dbV21_3 = results.rows.item(i).V21_3;
						dbV21_4 = results.rows.item(i).V21_4;
						dbV22_1 = results.rows.item(i).V22_1;
						dbV22_2 = results.rows.item(i).V22_2;
						dbV22_3 = results.rows.item(i).V22_3;
						dbV22_4 = results.rows.item(i).V22_4;
						dbV22_5 = results.rows.item(i).V22_5;
						dbV22_6 = results.rows.item(i).V22_6;
						dbV22_7 = results.rows.item(i).V22_7;
						dbV23 = results.rows.item(i).V23;
						dbV24_1 = results.rows.item(i).V24_1;
						dbV24_2 = results.rows.item(i).V24_2;
						dbV24_3 = results.rows.item(i).V24_3;
						dbV24_4 = results.rows.item(i).V24_4;
						dbV24_4t = results.rows.item(i).V24_4t;
						dbV25_1 = results.rows.item(i).V25_1;
						dbV25_2 = results.rows.item(i).V25_2;
						dbV25_3 = results.rows.item(i).V25_3;
						dbV25_4 = results.rows.item(i).V25_4;
						dbV25_5 = results.rows.item(i).V25_5;
						dbV25_6 = results.rows.item(i).V25_6;
						dbV25_7 = results.rows.item(i).V25_7;
						dbV26 = results.rows.item(i).V26;
						dbV27 = results.rows.item(i).V27;
						dbV28_1 = results.rows.item(i).V28_1;
						dbV28_2 = results.rows.item(i).V28_2;
						dbV28_3 = results.rows.item(i).V28_3;
						dbV28_4 = results.rows.item(i).V28_4;
						dbV28_5 = results.rows.item(i).V28_5;
						dbV28_6 = results.rows.item(i).V28_6;
						dbV28_6t = results.rows.item(i).V28_6t;
						dbV28_7 = results.rows.item(i).V28_7;
						dbV28_8 = results.rows.item(i).V28_8;
						dbV28_9 = results.rows.item(i).V28_9;
						dbV28_10 = results.rows.item(i).V28_10;
						dbV28_11 = results.rows.item(i).V28_11;
						dbV28_11t = results.rows.item(i).V28_11t;
						dbV28_12 = results.rows.item(i).V28_12;
						dbV28_13 = results.rows.item(i).V28_13;
						dbV28_14 = results.rows.item(i).V28_14;
						dbV28_15 = results.rows.item(i).V28_15;
						dbV28_16 = results.rows.item(i).V28_16;
						dbV28_16t = results.rows.item(i).V28_16t;
						dbV28_17 = results.rows.item(i).V28_17;
						dbV28_18 = results.rows.item(i).V28_18;
						dbV28_19 = results.rows.item(i).V28_19;
						dbV28_20 = results.rows.item(i).V28_20;
						dbV28_21 = results.rows.item(i).V28_21;
						dbV28_21t = results.rows.item(i).V28_21t;
						dbV28_22 = results.rows.item(i).V28_22;
						dbV28_23 = results.rows.item(i).V28_23;
						dbV28_24 = results.rows.item(i).V28_24;
						dbV29_1 = results.rows.item(i).V29_1;
						dbV29_2 = results.rows.item(i).V29_2;
						dbV30_1 = results.rows.item(i).V30_1;
						dbV30_2 = results.rows.item(i).V30_2;
						dbV30_3 = results.rows.item(i).V30_3;
						dbV30_4 = results.rows.item(i).V30_4;
						dbV30_5 = results.rows.item(i).V30_5;
						dbV30_6 = results.rows.item(i).V30_6;
						dbV30_7 = results.rows.item(i).V30_7;
						dbV30_8 = results.rows.item(i).V30_8;
						dbV31_1 = results.rows.item(i).V31_1;
						dbV31_2 = results.rows.item(i).V31_2;
						dbV31_3 = results.rows.item(i).V31_3;
						dbV31_4 = results.rows.item(i).V31_4;
						dbV31_5 = results.rows.item(i).V31_5;
						dbV31_6 = results.rows.item(i).V31_6;
						dbV32_1 = results.rows.item(i).V32_1;
						dbV32_2 = results.rows.item(i).V32_2;
						$.ajax({
							type : "POST",
							url : 'script.php',
							data : {
								abron : bron,
								ainvuldatum : invuldatum,
								anaam : naam,
								abedrijf : bedrijf,
								apostcode : postcode,
								aemail : email,
								aantal : dbV1,
								aantal2 : dbV2_1,
								aantal3 : dbV2_2,
								aantal4 : dbV2_3,
								aantal5 : dbV2_4,
								aantal6 : dbV2_5,
								aantal7 : dbV2_6,
								aantal8 : dbV2_7,
								aantal9 : dbV2_8,
								aantal10 : dbV2_9,
								aantal11 : dbV3,
								aantal12 : dbV4_1,
								aantal13 : dbV4_2,
								aantal14 : dbV4_3,
								aantal15 : dbV4_4,
								aantal16 : dbV4_5,
								aantal17 : dbV4_6,
								aantal18 : dbV4_7,
								aantal19 : dbV4_8,
								aantal20 : dbV4_9,
								aantal21 : dbV5,
								aantal22 : dbV6_1,
								aantal23 : dbV6_2,
								aantal24 : dbV6_3,
								aantal25 : dbV6_4,
								aantal26 : dbV6_5,
								aantal27 : dbV6_6,
								aantal28 : dbV6_7,
								aantal29 : dbV6_8,
								aantal30 : dbV6_9,
								aantal31 : dbV7_1,
								aantal32 : dbV7_2,
								aantal33 : dbV7_3,
								aantal34 : dbV7_4,
								aantal35 : dbV7_5,
								aantal36 : dbV7_6,
								aantal37 : dbV7_7,
								aantal38 : dbV7_8,
								aantal39 : dbV7_9,
								aantal40 : dbV8_1,
								aantal41 : dbV8_2,
								aantal42 : dbV8_3,
								aantal43 : dbV8_4,
								aantal44 : dbV9_1,
								aantal45 : dbV9_2,
								aantal46 : dbV9_3,
								aantal47 : dbV9_4,
								aantal48 : dbV10,
								aantal49 : dbV11,
								aantal50 : dbV12_1,
								aantal51 : dbV12_2,
								aantal52 : dbV13,
								aantal53 : dbV14_1,
								aantal54 : dbV14_2,
								aantal55 : dbV14_3,
								aantal56 : dbV14_4,
								aantal57 : dbV14_5,
								aantal58 : dbV15_1,
								aantal59 : dbV15_2,
								aantal60 : dbV16_1,
								aantal61 : dbV16_2,
								aantal62 : dbV16_3,
								aantal63 : dbV16_4,
								aantal64 : dbV16_5,
								aantal65 : dbV16_6,
								aantal66 : dbV16_7,
								aantal67 : dbV16_8,
								aantal68 : dbV16_9,
								aantal69 : dbV16_10,
								aantal70 : dbV16_11,
								aantal71 : dbV16_12,
								aantal72 : dbV16_13,
								aantal73 : dbV16_14,
								aantal74 : dbV16_15,
								aantal75 : dbV16_16,
								aantal76 : dbV16_17,
								aantal77 : dbV16_18,
								aantal78 : dbV17_1,
								aantal79 : dbV17_2,
								aantal80 : dbV17_3,
								aantal81 : dbV17_4,
								aantal82 : dbV17_5,
								aantal83 : dbV17_6,
								aantal84 : dbV18_1,
								aantal85 : dbV18_2,
								aantal86 : dbV18_3,
								aantal87 : dbV18_4,
								aantal88 : dbV18_5,
								aantal89 : dbV18_6,
								aantal90 : dbV19_1,
								aantal91 : dbV19_2,
								aantal92 : dbV19_3,
								aantal93 : dbV19_4,
								aantal94 : dbV19_5,
								aantal95 : dbV20_1,
								aantal96 : dbV20_2,
								aantal97 : dbV20_3,
								aantal98 : dbV20_4,
								aantal99 : dbV20_5,
								aantal100 : dbV20_6,
								aantal101 : dbV21_1,
								aantal102 : dbV21_2,
								aantal103 : dbV21_3,
								aantal104 : dbV21_4,
								aantal105 : dbV22_1,
								aantal106 : dbV22_2,
								aantal107 : dbV22_3,
								aantal108 : dbV22_4,
								aantal109 : dbV22_5,
								aantal110 : dbV22_6,
								aantal111 : dbV22_7,
								aantal112 : dbV23,
								aantal113 : dbV24_1,
								aantal114 : dbV24_2,
								aantal115 : dbV24_3,
								aantal116 : dbV24_4,
								aantal117 : dbV24_4t,
								aantal118 : dbV25_1,
								aantal119 : dbV25_2,
								aantal120 : dbV25_3,
								aantal121 : dbV25_4,
								aantal122 : dbV25_5,
								aantal123 : dbV25_6,
								aantal124 : dbV25_7,
								aantal125 : dbV26,
								aantal126 : dbV27,
								aantal127 : dbV28_1,
								aantal128 : dbV28_2,
								aantal129 : dbV28_3,
								aantal130 : dbV28_4,
								aantal131 : dbV28_5,
								aantal132 : dbV28_6,
								aantal133 : dbV28_6t,
								aantal134 : dbV28_7,
								aantal135 : dbV28_8,
								aantal136 : dbV28_9,
								aantal137 : dbV28_10,
								aantal138 : dbV28_11,
								aantal139 : dbV28_11t,
								aantal140 : dbV28_12,
								aantal141 : dbV28_13,
								aantal142 : dbV28_14,
								aantal143 : dbV28_15,
								aantal144 : dbV28_16,
								aantal145 : dbV28_16t,
								aantal146 : dbV28_17,
								aantal147 : dbV28_18,
								aantal148 : dbV28_19,
								aantal149 : dbV28_20,
								aantal150 : dbV28_21,
								aantal151 : dbV28_21t,
								aantal152 : dbV28_22,
								aantal153 : dbV28_23,
								aantal154 : dbV28_24,
								aantal155 : dbV29_1,
								aantal156 : dbV29_2,
								aantal157 : dbV30_1,
								aantal158 : dbV30_2,
								aantal159 : dbV30_3,
								aantal160 : dbV30_4,
								aantal161 : dbV30_5,
								aantal162 : dbV30_6,
								aantal163 : dbV30_7,
								aantal164 : dbV30_8,
								aantal165 : dbV31_1,
								aantal166 : dbV31_2,
								aantal167 : dbV31_3,
								aantal168 : dbV31_4,
								aantal169 : dbV31_5,
								aantal170 : dbV31_6,
								aantal171 : dbV32_1,
								aantal172 : dbV32_2
							},
							success : function(data) {
								maakGrafiek();
								db.transaction(function(tx) {
									tx.executeSql('DROP TABLE IF EXISTS tbl_antwoorden');
									tx.executeSql('CREATE TABLE IF NOT EXISTS tbl_antwoorden (id unique, bron, invuldatum, naam, bedrijf, postcode, email,V1,V2_1,V2_2,V2_3,V2_4,V2_5,V2_6,V2_7,V2_8,V2_9,V3,V4_1,V4_2,V4_3,V4_4,V4_5,V4_6,V4_7,V4_8,V4_9,V5,V6_1,V6_2,V6_3,V6_4,V6_5,V6_6,V6_7,V6_8,V6_9,V7_1,V7_2,V7_3,V7_4,V7_5,V7_6,V7_7,V7_8,V7_9,V8_1,V8_2,V8_3,V8_4,V9_1,V9_2,V9_3,V9_4,V10,V11,V12_1,V12_2,V13,V14_1,V14_2,V14_3,V14_4,V14_5,V15_1,V15_2,V16_1,V16_2,V16_3,V16_4,V16_5,V16_6,V16_7,V16_8,V16_9,V16_10,V16_11,V16_12,V16_13,V16_14,V16_15,V16_16,V16_17,V16_18,V17_1,V17_2,V17_3,V17_4,V17_5,V17_6,V18_1,V18_2,V18_3,V18_4,V18_5,V18_6,V19_1,V19_2,V19_3,V19_4,V19_5,V20_1,V20_2,V20_3,V20_4,V20_5,V20_6,V21_1,V21_2,V21_3,V21_4,V22_1,V22_2,V22_3,V22_4,V22_5,V22_6,V22_7,V23,V24_1,V24_2,V24_3,V24_4,V24_4t,V25_1,V25_2,V25_3,V25_4,V25_5,V25_6,V25_7,V26,V27,V28_1,V28_2,V28_3,V28_4,V28_5,V28_6,V28_6t,V28_7,V28_8,V28_9,V28_10,V28_11,V28_11t,V28_12,V28_13,V28_14,V28_15,V28_16,V28_16t,V28_17,V28_18,V28_19,V28_20,V28_21,V28_21t,V28_22,V28_23,V28_24,V29_1,V29_2,V30_1,V30_2,V30_3,V30_4,V30_5,V30_6,V30_7,V30_8,V31_1,V31_2,V31_3,V31_4,V31_5,V31_6,V32_1,V32_2)');
									tx.executeSql('INSERT INTO tbl_antwoorden (id, bron, invuldatum, naam, bedrijf, postcode, email,V1,V2_1,V2_2,V2_3,V2_4,V2_5,V2_6,V2_7,V2_8,V2_9,V3,V4_1,V4_2,V4_3,V4_4,V4_5,V4_6,V4_7,V4_8,V4_9,V5,V6_1,V6_2,V6_3,V6_4,V6_5,V6_6,V6_7,V6_8,V6_9,V7_1,V7_2,V7_3,V7_4,V7_5,V7_6,V7_7,V7_8,V7_9,V8_1,V8_2,V8_3,V8_4,V9_1,V9_2,V9_3,V9_4,V10,V11,V12_1,V12_2,V13,V14_1,V14_2,V14_3,V14_4,V14_5,V15_1,V15_2,V16_1,V16_2,V16_3,V16_4,V16_5,V16_6,V16_7,V16_8,V16_9,V16_10,V16_11,V16_12,V16_13,V16_14,V16_15,V16_16,V16_17,V16_18,V17_1,V17_2,V17_3,V17_4,V17_5,V17_6,V18_1,V18_2,V18_3,V18_4,V18_5,V18_6,V19_1,V19_2,V19_3,V19_4,V19_5,V20_1,V20_2,V20_3,V20_4,V20_5,V20_6,V21_1,V21_2,V21_3,V21_4,V22_1,V22_2,V22_3,V22_4,V22_5,V22_6,V22_7,V23,V24_1,V24_2,V24_3,V24_4,V24_4t,V25_1,V25_2,V25_3,V25_4,V25_5,V25_6,V25_7,V26,V27,V28_1,V28_2,V28_3,V28_4,V28_5,V28_6,V28_6t,V28_7,V28_8,V28_9,V28_10,V28_11,V28_11t,V28_12,V28_13,V28_14,V28_15,V28_16,V28_16t,V28_17,V28_18,V28_19,V28_20,V28_21,V28_21t,V28_22,V28_23,V28_24,V29_1,V29_2,V30_1,V30_2,V30_3,V30_4,V30_5,V30_6,V30_7,V30_8,V31_1,V31_2,V31_3,V31_4,V31_5,V31_6,V32_1,V32_2) VALUES (1,"goforchange","invuldatum","naam","bedrijf","postcode","email",0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0)');

								});
							}
						});
					}

				});
			});
		}

		function maakGrafiek() {
			FusionCharts.ready(function() {
				var breedte = window.innerHeight > window.innerWidth ? window.innerWidth : window.innerHeight;
				var budgetChart = new FusionCharts({
					type : 'radar',
					renderAt : 'chart-container',
					width : '100%',
					height : breedte,
					dataFormat : 'json',
					dataSource : {
						"chart" : {
							"caption" : "Antwoorden",
							"subCaption" : "Resultaat",
							"captionFontSize" : "14",
							"subcaptionFontSize" : "14",
							"numberPrefix" : "",
							"baseFontColor" : "#333333",
							"baseFont" : "Helvetica Neue,Arial",
							"subcaptionFontBold" : "0",
							"paletteColors" : "#FF0000,#6baa01",
							"bgColor" : "#ffffff",
							"radarfillcolor" : "#ffffff",
							"showBorder" : "0",
							"showShadow" : "0",
							"showCanvasBorder" : "0",
							"legendBorderAlpha" : "0",
							"legendShadow" : "0",
							"divLineAlpha" : "10",
							"usePlotGradientColor" : "0",
							"numberPreffix" : "",
							"legendBorderAlpha" : "0",
							"legendShadow" : "0"
						},
						"categories" : [{
							"category" : [{
								"label" : "IPO_f"
							}, {
								"label" : "IPO_c"
							}, {
								"label" : "CPO_f"
							}, {
								"label" : "CPO_c"
							}, {
								"label" : "Fam_inf"
							}, {
								"label" : "Comm"
							}, {
								"label" : "Planning"
							}]
						}],
						"dataset" : [{
							"seriesname" : "Persoonlijk antwoord",
							"data" : [{
								"value" : IPO_f
							}, {
								"value" : IPO_c
							}, {
								"value" : CPO_f
							}, {
								"value" : CPO_c
							}, {
								"value" : fam_inf
							}, {
								"value" : comm
							}, {
								"value" : planning
							}]
						}, {
							"seriesname" : "Resultaten van andere",
							"data" : [{
								"value" : IPO_fm
							}, {
								"value" : IPO_cm
							}, {
								"value" : CPO_fm
							}, {
								"value" : CPO_cm
							}, {
								"value" : fam_infm
							}, {
								"value" : commm
							}, {
								"value" : planningm
							}]
						}]
					}
				}).render();
			});

		}


		console.log("DB Aanmaken:");
		var db = openDatabase('mydb', '1.0', 'my first database', 2 * 1024 * 1024);
		console.log("functie aanroepen:");
		db.transaction(function(tx) {

			tx.executeSql('CREATE TABLE IF NOT EXISTS tbl_antwoorden (id unique, bron, invuldatum, naam, bedrijf, postcode, email,V1,V2_1,V2_2,V2_3,V2_4,V2_5,V2_6,V2_7,V2_8,V2_9,V3,V4_1,V4_2,V4_3,V4_4,V4_5,V4_6,V4_7,V4_8,V4_9,V5,V6_1,V6_2,V6_3,V6_4,V6_5,V6_6,V6_7,V6_8,V6_9,V7_1,V7_2,V7_3,V7_4,V7_5,V7_6,V7_7,V7_8,V7_9,V8_1,V8_2,V8_3,V8_4,V9_1,V9_2,V9_3,V9_4,V10,V11,V12_1,V12_2,V13,V14_1,V14_2,V14_3,V14_4,V14_5,V15_1,V15_2,V16_1,V16_2,V16_3,V16_4,V16_5,V16_6,V16_7,V16_8,V16_9,V16_10,V16_11,V16_12,V16_13,V16_14,V16_15,V16_16,V16_17,V16_18,V17_1,V17_2,V17_3,V17_4,V17_5,V17_6,V18_1,V18_2,V18_3,V18_4,V18_5,V18_6,V19_1,V19_2,V19_3,V19_4,V19_5,V20_1,V20_2,V20_3,V20_4,V20_5,V20_6,V21_1,V21_2,V21_3,V21_4,V22_1,V22_2,V22_3,V22_4,V22_5,V22_6,V22_7,V23,V24_1,V24_2,V24_3,V24_4,V24_4t,V25_1,V25_2,V25_3,V25_4,V25_5,V25_6,V25_7,V26,V27,V28_1,V28_2,V28_3,V28_4,V28_5,V28_6,V28_6t,V28_7,V28_8,V28_9,V28_10,V28_11,V28_11t,V28_12,V28_13,V28_14,V28_15,V28_16,V28_16t,V28_17,V28_18,V28_19,V28_20,V28_21,V28_21t,V28_22,V28_23,V28_24,V29_1,V29_2,V30_1,V30_2,V30_3,V30_4,V30_5,V30_6,V30_7,V30_8,V31_1,V31_2,V31_3,V31_4,V31_5,V31_6,V32_1,V32_2)');
			tx.executeSql('INSERT INTO tbl_antwoorden (id, bron, invuldatum, naam, bedrijf, postcode, email,V1,V2_1,V2_2,V2_3,V2_4,V2_5,V2_6,V2_7,V2_8,V2_9,V3,V4_1,V4_2,V4_3,V4_4,V4_5,V4_6,V4_7,V4_8,V4_9,V5,V6_1,V6_2,V6_3,V6_4,V6_5,V6_6,V6_7,V6_8,V6_9,V7_1,V7_2,V7_3,V7_4,V7_5,V7_6,V7_7,V7_8,V7_9,V8_1,V8_2,V8_3,V8_4,V9_1,V9_2,V9_3,V9_4,V10,V11,V12_1,V12_2,V13,V14_1,V14_2,V14_3,V14_4,V14_5,V15_1,V15_2,V16_1,V16_2,V16_3,V16_4,V16_5,V16_6,V16_7,V16_8,V16_9,V16_10,V16_11,V16_12,V16_13,V16_14,V16_15,V16_16,V16_17,V16_18,V17_1,V17_2,V17_3,V17_4,V17_5,V17_6,V18_1,V18_2,V18_3,V18_4,V18_5,V18_6,V19_1,V19_2,V19_3,V19_4,V19_5,V20_1,V20_2,V20_3,V20_4,V20_5,V20_6,V21_1,V21_2,V21_3,V21_4,V22_1,V22_2,V22_3,V22_4,V22_5,V22_6,V22_7,V23,V24_1,V24_2,V24_3,V24_4,V24_4t,V25_1,V25_2,V25_3,V25_4,V25_5,V25_6,V25_7,V26,V27,V28_1,V28_2,V28_3,V28_4,V28_5,V28_6,V28_6t,V28_7,V28_8,V28_9,V28_10,V28_11,V28_11t,V28_12,V28_13,V28_14,V28_15,V28_16,V28_16t,V28_17,V28_18,V28_19,V28_20,V28_21,V28_21t,V28_22,V28_23,V28_24,V29_1,V29_2,V30_1,V30_2,V30_3,V30_4,V30_5,V30_6,V30_7,V30_8,V31_1,V31_2,V31_3,V31_4,V31_5,V31_6,V32_1,V32_2) VALUES (1,"goforchange","invuldatum","naam","bedrijf","postcode","email",0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0)');

		});

		function MaakDivs() {
			

			var len = aantalVragen, i, j;

			for ( i = 0; i < len; i++) {

				var ID = i + 1;
				var vorigevraagID = ID - 1;
				var volgendevraagID = ID + 1;
				var perc = Math.floor((ID * 100) / aantalVragen ); // voortgang
				var titel = "";


				// dirty hack (zonder db !) om de titels bovenaan te kunnen plaatsen!
				// minVr is de eerste vraag met die titel
				// maxVr is de laatste vraag met die titel
				// titel is de te tonen titel

				var titels =[
				{minVr: 1, maxVr: 14, titel: "I.	Veranderingsprocessen: Situering"},
				{minVr: 15, maxVr: 19, titel: "II.	Veranderingsprocessen: Doelstellingen"},
				{minVr: 20, maxVr: 21, titel: "III.	Veranderingsprocessen: Financiële achtergrond"},
				{minVr: 22, maxVr: 39, titel: "IV.	Eigenaarschap"},
				{minVr: 40, maxVr: 45, titel: "V.	Familiale invloed"},
				{minVr: 46, maxVr: 51, titel: "VI.	Familiale identificatie met het bedrijf"},
				{minVr: 52, maxVr: 56, titel: "VII.	Sociaal netwerk"},
				{minVr: 57, maxVr: 62, titel: "VIII.	Familiale verbondenheid"},
				{minVr: 63, maxVr: 73, titel: "IX.	Familiale opvolging"},
				{minVr: 74, maxVr: 103, titel: "XI.	Algemene informatie"}
				]

				for(j = 0; j < titels.length; j++){
					if(titels[j].minVr <=ID && titels[j].maxVr >= ID){
						titel = titels[j].titel;
					}
				}
				


				if (i == 0) {
					var buttons = '<div style="clear:both"><a href="#home" data-role="button" data-inline="true" style="width:35%;float:left;" data-transition="slide" data-direction="reverse">Vorige vraag</a><a data-role="button" data-inline="true" onclick="kijkVraagNa()" style="width:35%;float:right;" data-transition="slide">Volgende vraag</a></div></div></div>';
					var makePage = $('<div data-role="page" id="vraagPagina' + ID + '"><div data-role="header"><h1>' + titel + '</h1><span class="ui-btn-right">Voortgang: '+perc+'%</span></div><div data-role="main" class="ui-content"><div id="#vraag' + ID + '">This is Page.</div>' + buttons + '');

					makePage.appendTo("#pagina");

				} else if (i == (len - 1)) {
					var makePage = $('<div data-role="page" id="vraagPagina' + ID + '"><div data-role="header"><h1>' + titel + '</h1><span class="ui-btn-right">Voortgang: '+perc+'%</span></div><div data-role="main" class="ui-content"><div id="#vraag' + ID + '">This is Page.</div>' + buttons + '');
					makePage.appendTo("#pagina");
				} else {
					var buttons = '<div style="clear:both"><a href="#vraagPagina' + vorigevraagID + '" data-role="button" data-inline="true" style="width:35%;float:left;" data-transition="slide" data-direction="reverse">Vorige vraag</a><a data-role="button" data-inline="true" style="width:35%;float:right;" onclick="kijkVraagNa()" data-transition="slide">Volgende vraag</a></div></div></div>';
					var makePage = $('<div data-role="page" id="vraagPagina' + ID + '"><div data-role="header"><h1>' + titel + '</h1><span class="ui-btn-right">Voortgang: '+perc+'%</span></div><div data-role="main" class="ui-content"><div id="#vraag' + ID + '">This is Page.</div>' + buttons + '');
					//var vraagID = i + 1
					makePage.appendTo("#pagina");

				}
				VulVraag(ID);
				console.log("VulVraag opgeroepen");
			}

		}

	</script>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Enquete</title>
</head>
<body>
	<div id="pagina">
		<div data-role="page" id="home">
			<div data-role="header">
				<h1>Enquete</h1>
			</div>

			<div data-role="main" class="ui-content">
				<a onclick="tokenOpvragen()" data-role="button">Start de enquete</a>
				<div></div>
				<!--	<button onclick="PostTest()">
				posttest
				</button> -->
			</div>
			<div data-role="footer">
				<h1>Go for change!</h1>
			</div>
		</div>
		<div data-role="page" id="grafiek">
			<div data-role="header">
				<h1>Grafiek</h1>
			</div>
			<div data-role="main" class="ui-content">
				<div id="chart-container">
					FusionCharts will render here
				</div>

				<div id="TekstV14_4alg"></div>
				<br>
				<div id="TekstV14_4"></div>
				<br>
				<span id="TekstV14_5alg"></span>
				<br>
				<span id="TekstV14_5"></span>
				<br>
				<span id="TekstV16alg"></span>
				<br>
				<span id="TekstV16h"></span>
				<br>
				<span id="TekstV16l"></span>
				<br>
                <span id="TekstV17alg"></span>
                <br>
				<span id="TekstV17"></span>
				<br>
				<span id="TekstV22"></span>
				<br>
				<span id="TekstV14"></span>
				<br>
				<span id="TekstV10alg"></span>
				<br>
				<span id="TekstV10"></span>
				<br>
				<span id="TekstV19alg"></span>
				<br>
				<span id="TekstV19"></span>
				<br>
				<span id="TekstV22_5alg"></span>
				<br>
				<span id="TekstV22_5"></span>
				<br>
				<span id="TekstV22_6alg"></span>
				<br>
				<span id="TekstV22_6"></span>
				<br>
				<span id="TekstV13alg"></span>
				<br>
				<span id="TekstV13"></span>
				<br>
				<span id="TekstV15_1alg"></span>
				<br>
				<span id="TekstV15_1"></span>
				<br>
				<span id="TekstV15_2alg"></span>
				<br>
				<span id="TekstV15_2"></span>
				<br>
				<span id="TekstV2_1"></span>
				<br>
				<span id="TekstV2_2"></span>
				<br>
				<span id="TekstV2_3"></span>
				<br>
				<span id="TekstV2_4"></span>
				<br>
				<span id="TekstV2_5"></span>
				<br>
				<span id="TekstV2_6"></span>
				<br>
				<span id="TekstV2_7"></span>
				<br>

			</div>

			<!--<div data-role="footer">
			<h1>Footer Text</h1>
			</div> -->
		</div>
		<div data-role="page" id="einde">
			<div data-role="header">
				<h1>Be&#235indigen</h1>

			</div>

			<div data-role="main" class="ui-content">
				<div>
					Indien u dat wenst of indien u hiervoor heeft aangegeven bereid te zijn tot verdere samenwerking, kan u hierna uw contactinformatie invullen. Dat is optioneel maar stelt ons in staat u op de hoogte te houden van de resultaten van het onderzoek. Uw contactgegevens worden in geen geval openbaar gemaakt en alle antwoorden op deze vragenlijst worden anoniem verwerkt.
				</div>
				<br>
				<div>
					Bedrijfsnaam:
					<br>
					<input type="text" id="Bedrijfsnaam" name="Bedrijfsnaam">
					<br>
					Postcode bedrijf:
					<br>
					<input type="text" id="PostcodeBedrijf" name="PostcodeBedrijf">
					<br>
					Naam respondent:
					<br>
					<input type="text" id="Naam" name="Naam">
					<br>
					E-mail respondent:
					<br>
					<input type="text" id="Email" name="Email">
					<br>
					<a href="#grafiek" onclick="gegevensPosten()" data-role="button">Enqu&#234te be&#235indigen.</a>
				</div>

			</div>
		</div>
	</div>
</body>
</html>