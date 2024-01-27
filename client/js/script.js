$(document).ready({
    function() {
        // Validate from Register
        $("#frmRegForm").validate({
            rules: {
                firstname:{
                    required: false,
                    minlength: 2
                },
                lastname: {
                    required: true,
                    minlength: 2
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                },
                repassword:{
                    required: true,
                    equalTo: '#password',
                }
            }, 
            messages: {
                firstname: {
                    required:'Please enter a valid First Name',
                    minlength:'At least 2 characters long'
                },
                lastname: {
                    required:'Please enter a valid Last Name',
                    minlength:'At least 2 characters long'
                },
                email: {
                    required:'Please enter a valid Email',
                    minlength:'Please enter valid email'
                },
                password: {
                    required: 'Please enter the password'
                },
                repassword: {
                    required: 'Confirm password is required',
                    equalTo: 'Password not matching'
                }
            }
        })
    }
});