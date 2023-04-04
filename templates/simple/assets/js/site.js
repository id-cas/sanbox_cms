$(document).ready(function(){
	const showDialog = (data) => {
		const dialog = $('#js-dialog');
		const modal = new bootstrap.Modal(dialog, { keyboard: false });
		if(data.title){
			$(dialog.find('.modal-title')[0]).html(data.title);
		}
		if(data.content){
			$(dialog.find('.modal-body')[0]).html(data.content);
		}
		modal.show();
	};

	const makeRequest = (form) => {
		$('#js-preloader').show();

		$.ajax({
			url: form.attr('action'),
			method: form.attr('method'),
			data: form.serialize()
		})
			.done((data) => {
				if(data.error){
					showDialog({title: 'Error', content: data.error});
				}
				showDialog({title: 'Success', content: '<p>New rubric successfully added.</p><p>For renew rubric tree - refresh the page.</p>'});
			})
			.fail((err) => {
				showDialog({title: 'Error', content: '<p>Some network problem occurred.</p>'});
				console.warn(err);
			})
			.always((err) => {
				$('#js-preloader').hide();
			});
	};



	(function () {
		'use strict'

		const forms = document.querySelectorAll('.needs-validation');

		Array.prototype.slice.call(forms)
			.forEach(function (form) {
				form.addEventListener('submit', function (event) {
					if (!form.checkValidity()) {
						event.preventDefault();
						event.stopPropagation();
					}
					else {
						event.preventDefault();
						makeRequest($(form));
					}

					form.classList.add('was-validated')
				}, false)
			})
	})();


});