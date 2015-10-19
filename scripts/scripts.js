if ($('.register__form').length) {
	var f = document.getElementsByClassName('register__form')[0],
		v = document.getElementsByClassName('validation')[0],
		inp = f.getElementsByTagName('input'),
		u = document.getElementById('username'),
		p = document.getElementById('password'),
		p2 = document.getElementById('password2'),
		em = document.getElementById('email');

	for (var i = 0; i < inp.length; i++) {
		inp[i].onkeyup = function() {

			$.post('register', {
				username: u.value, 
				password: p.value, 
				password2: p2.value, 
				email: em.value
			}, function(response, textStatus, xhr) {
				//finds the validation class of current page
				//adds html to said class by finding specific validation class from html response
				$('.validation').html($(response).find('.validation').html());
			});	
		}
	};
}

if ($('textarea[name=message]').length) {
	var message = document.getElementsByTagName('textarea');
	for (var i = 0; i < message.length; i++) {
		if (message[i].getAttribute('name') === 'message') {

			message[i].onkeyup = function() {
				
			}

		};
	};
}
 
if ($('input[name=subject]').length) {
	console.log('hi');
}