
$(document).ready(function () {

    $('#registerForm').on('submit', function (e) {
        let password = $('#password').val();
        if (password.length < 8) {
            alert('Password must be at least 8 characters long.');
            e.preventDefault();
        }
    });

    $('#loginPage').on('click', function () {
        window.location.href = "login";
    });


    $('#loginForm').on('submit', function (e) {
        let email = $('#email').val();
        let password = $('#password').val();

        // Basic validation
        if (email.trim() === '') {
            alert('Email is required.');
            e.preventDefault();
        } else if (password.trim() === '') {
            alert('Password is required.');
            e.preventDefault();
        } else if (password.length < 8) {
            alert('Password must be at least 8 characters long.');
            e.preventDefault();
        }
    });

    $('#registerPage').on('click', function () {
        window.location.href = "register";
    });

    

});

