$().ready(function() {
	$("#demoForm").validate({
		onfocusout: false,
		onkeyup: false,
		onclick: false,
		rules: {
			"user": {
				required: true,
				maxlength: 15
			},
			"password": {
				required: true,
				minlength: 8
			},
			"re-password": {
				equalTo: "#password",
				minlength: 8
				
			}
		},
		messages: {
			"user": {
				required: "Bắt buộc nhập username",
				maxlength: "Hãy nhập tối đa 15 ký tự"
			},
			"password": {
				required: "Bắt buộc nhập password",
				minlength: "Hãy nhập ít nhất 8 ký tự"
			},
			"re-password": {
				equalTo: "Hai password phải giống nhau",
				minlength: "Hãy nhập ít nhất 8 ký tự"
			}
		}
	});
});
