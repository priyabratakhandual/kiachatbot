$(document).ready(function () {

	var currentURL = window.location.href;
	console.log(currentURL);


	var currentURL = $(location).attr("href");
	console.log(currentURL);


	var currentURL = window.location;
	console.log(currentURL);

	

	$('#change_password_form').submit(function (event) {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		event.preventDefault();
		$('.error').remove();
		let currentSelect = $(this);
		$.ajax({
			url: base_url + "/changePassword",
			method: "POST",
			data: new FormData(this),
			dataType: 'JSON',
			contentType: false,
			cache: false,
			processData: false,
			beforeSend: function () {
				$('#preloader').show();
			},
			success: function (data) {
				$('#message').html("");
				$('#preloader').hide();
				if (data.status == 0) {
					$(currentSelect).find('input[name=confirm_password]').parent().after('<p style="color:red" class="error">' + data.message + '</p>');
				} else if (data.status == 1) {
					$(currentSelect).find('input[name=confirm_password]').parent().after('<p style="color:green" class="error">' + data.message + '</p>');
					currentSelect[0].reset();
				}
			}
		});
	});



	$('#profile_update_form').submit(function (event) {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		event.preventDefault();
		$('.error').remove();
		let currentSelect = $(this);
		$.ajax({
			url: base_url + "/profileUpdate",
			method: "POST",
			data: new FormData(this),
			dataType: 'JSON',
			contentType: false,
			cache: false,
			processData: false,
			beforeSend: function () {
				$('#preloader').show();
			},
			success: function (data) {
				$('#message').html("");
				$('#preloader').hide();
				if (data.status == 0) {
					$.each(data.message, function (i, v) {
						$(currentSelect).find('textarea[name=' + i + ']').after('<p style="color:red" class="error">' + v[0] + '</p>');
						$(currentSelect).find('select[name=' + i + ']').after('<p style="color:red" class="error">' + v[0] + '</p>');
						$(currentSelect).find('input[name=' + i + ']').after('<p style="color:red" class="error">' + v[0] + '</p>');
					});
				} else if (data.status == 1) {
					$(currentSelect).find('input[name=submit]').after('<p style="color:green" class="error">' + data.message + '</p>');
					location.reload(true);
				}
			}
		});
	});


	$('#add_question_form').submit(function (event) {

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		event.preventDefault();

		$('.error').remove();
		let currentSelect = $(this);
		$.ajax({
			url: base_url + "/add_question",
			method: "POST",
			data: new FormData(this),
			dataType: 'JSON',
			contentType: false,
			cache: false,
			processData: false,
			beforeSend: function () {
				$('#preloader').show();
			},
			success: function (data) {
				$('#message').html("");
				$('#preloader').hide();
				if (data.status == 0) {
					$.each(data.message, function (i, v) {
						$(currentSelect).find('textarea[name=' + i + ']').after('<p style="color:red" class="error">' + v[0] + '</p>');
						$(currentSelect).find('select[name=' + i + ']').after('<p style="color:red" class="error">' + v[0] + '</p>');
					});
				} else if (data.status == 1) {
					$(currentSelect).find('input[name=submit]').after('<p style="color:green" class="error">' + data.message + '</p>');
					location.reload(true);
				}
			}
		});


	});


	$('#add_dealer_form').submit(function (event) {

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		event.preventDefault();

		$('.error').remove();
		let currentSelect = $(this);
		$.ajax({
			url: base_url + "/add_dealer",
			method: "POST",
			data: new FormData(this),
			dataType: 'JSON',
			contentType: false,
			cache: false,
			processData: false,
			beforeSend: function () {
				$('#preloader').show();
			},
			success: function (data) {
				$('#message').html("");
				$('#preloader').hide();
				if (data.status == 0) {
					$.each(data.message, function (i, v) {
						$(currentSelect).find('input[name=' + i + ']').after('<p style="color:red" class="error">' + v[0] + '</p>');
						$(currentSelect).find('select[name=' + i + ']').after('<p style="color:red" class="error">' + v[0] + '</p>');
						console.log($())
					});
				} else if (data.status == 1) {
					$('#exampleModal').modal('toggle');
					$('#dealer_code').append($("<option></option>").attr("value", $('#dealer_code_add').val()).text($('#dealer_code_add').val() + ' -- ' + $('#dealer_name').val()));
				}
			}
		});

	});



	$('.fileUploadBtn').on('click', function () {
		var title = $(this).parent().parent().find('label').text();
		$('#modal_Title_File').text(title);

		var map = {
			'Attendance': 'attendance',
			'Site Readiness Documents': 'site_readiness',
			'Speed Test': 'speed_test',
			'Sign Off Documents': 'sign_off_doc',
			'Training Photo': 'training_pics',
			'Other Documents': 'other_doc',
		};

		var main = map[title];

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		var fd = new FormData();
		fd.append("title", main);
		fd.append("activity_id", $('#activity_id').val());

		$.ajax({
			url: base_url + "/fetch_docs",
			method: "POST",
			data: fd,
			dataType: 'JSON',
			contentType: false,
			cache: false,
			processData: false,
			beforeSend: function () {
				$('#preloader').show();
			},
			success: function (data) {

				$("#file-3").fileinput({
					theme: 'fa',
					showUpload: true,
					showCaption: false,
					showZoom: false,
					browseClass: "btn btn-primary",
					fileType: "any",
					previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
					overwriteInitial: false,
					uploadUrl: base_url + '/file-upload-batch',
					uploadExtraData: function () {
						return {
							_token: $("input[name='_token']").val(),
							'title': main,
							'activity_id': $('#activity_id').val()
						}
					},
					initialPreviewAsData: true,
					initialPreview: data.initPrevArr,
					initialPreviewConfig: data.initPrevConfArr,
					removeClass : "btn btn-primary",
					uploadClass : "btn btn-primary",
					previewZoomButtonClasses : {
						prev: 'btn btn-navigate btn-primary btn-outline-secondary',
						next: 'btn btn-navigate btn-primary btn-outline-secondary',
						rotate: 'btn btn-navigate btn-primary btn-outline-secondary',
						toggleheader: 'btn btn-kv btn-primary btn-outline-secondary',
						fullscreen: 'btn btn-kv btn-primary btn-outline-secondary',
						borderless: 'btn btn-kv btn-primary btn-outline-secondary',
						close: 'btn btn-kv btn-primary btn-outline-secondary'
					},
				});
				$.each($('.file-preview-text'), function (index, item) {
					$.ajax({
						url: $(item).text(), success: function (result) {
							$(item).text(result)
						}
					});
				})

				$('.kv-zoom-cache').hide();
			}
		});

	});

	$('#myModal').on('hidden.bs.modal', function () {
		$('#file-3').fileinput('destroy');
	});

});

// visit plan create records fetch


