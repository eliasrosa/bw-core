$(function () {

	window.Laravel = {
		csrfToken: $('meta[name="csrf-token"]').attr('content'),
	};

    $.ajaxSetup({
        headers: { 
            'X-CSRF-TOKEN': window.Laravel.csrfToken
        },
        beforeSend: function(xhr) {
            xhr.setRequestHeader('X-CSRF-TOKEN', window.Laravel.csrfToken);
        }
    });

});