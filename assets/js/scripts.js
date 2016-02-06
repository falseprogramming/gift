//Kingitus aplikatsioon
$(function() {
	$('#priceIn').keyup(function() {
		var priceInVal = $("#priceIn").val();
		var content = $('#priceOut').text(priceInVal);

	});
	$('#name').keyup(function() {
		var nameInVal = $("#name").val();
		var name = $('#nameOut').text(nameInVal);
	});
	$('#message').keyup(function() {
		var nameInVal = $("#message").val();
		var name = $('#messageOut').text(nameInVal);

	});
	var max = 30;
$("#message").keyup(function() {
				
		   var t1 = $("#message").val();
		var show = $(".counter");
				if(t1.length > 30) {
					
				t1 = t1.substring(0,30);
				$("#message").val(t1);
					
				} else {
					
					show.text(max - t1.length);
					
				}		
				
		});
		
		
	$('#selectDesign').change(function() {
		
		if($(this).val() === 'birthday') {
			alert('Disaine '+$(this).val() +' pole valmis!');
			console.log('Birthday design');
		}
		if($(this).val() === 'love') {
			alert('Disaine '+$(this).val() +' pole valmis!');
			console.log('Love design');
		}
		if($(this).val() === 'friend') {
			alert('Disaine '+$(this).val() +' pole valmis!');
			console.log('Friend design');
		}
		
	});	
	
	//Valideerimine
	
		$('form').submit(function() {
			var price = $('#priceIn');
			var name = $('#name');
			var message = $('#message');
			if(price.val() ==='') {
				alert('Siseta hind');
				price.focus();
				return false;
				
			}
			if(name.val() ==='') {
				alert('Sisesta nimi');
				name.focus();
				return false;
				}
				if(message.val() === '') {
					alert('Sisesta tekst');
					message.focus();
					return false;
				}
		});
	$('#priceIn').click(function() {
		$(this).select();
		
	});	
	var br = $('#uid').val();
	$('#uids').html(br);	
	
});


