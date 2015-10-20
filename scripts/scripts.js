//unifinished form validation
if ($('textarea[name=message]').length) {
	var message = document.getElementsByTagName('textarea');
	for (var i = 0; i < message.length; i++) {
		if (message[i].getAttribute('name') === 'message') {

			message[i].onkeyup = function() {
				
			}

		};
	};
}

//unifinished form validation
if ($('input[name=subject]').length) {
	console.log('hi');
}