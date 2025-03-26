
$(document).ready(function () {

    $('#registerForm').on('submit', function (e) {
        // let password = $('#password').val();
        // if (password.length < 8) {
        //     alert('Password must be at least 8 characters long.');
        //     e.preventDefault();
        // }

        $(".text-danger").text(""); // Clear previous error messages
        let isValid = true;

        let username = $("#username").val().trim();
        let email = $("#email").val().trim();
        let password = $("#password").val().trim();
        let file = $("#file").val().trim();

        // Allowed file types
        let allowedExtensions = /(\.jpg|\.jpeg|\.png|\.pdf)$/i;

        // Username validation
        if (username === "") {
            $("#usernameError").text("Username is required.");
            isValid = false;
        }

        // Email validation
        if (email === "") {
            $("#emailError").text("Email is required.");
            isValid = false;
        } else if (!/^\S+@\S+\.\S+$/.test(email)) {
            $("#emailError").text("Invalid email format.");
            isValid = false;
        }

        // Password validation
        if (password === "") {
            $("#passwordError").text("Password is required.");
            isValid = false;
        } else if (password.length < 8) {
            $("#passwordError").text("Password must be at least 8 characters long.");
            isValid = false;
        }

        // File validation
        if (file === "") {
            $("#fileError").text("Please upload a file.");
            isValid = false;
        } else if (!allowedExtensions.exec(file)) {
            $("#fileError").text("Invalid file type. Only JPG, PNG, and PDF allowed.");
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault(); // Prevent form submission if validation fails
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

