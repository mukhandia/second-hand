
$("#namecheck").hide();
let nameIsCorrect = true;
$("#name").keyup(function() {
    validatename();
});

function validatename() {
    $name = $("#name").val();

    if ($name.length == "") {
        $("#namecheck").show();
        $("#namecheck").html('<i class="fa fa-exclamation-circle"></i>You have not entered your name');
        nameIsCorrect = false;
    }
    if ($name.length < 3) {
        $("#namecheck").show();
        $("#namecheck").html('<i class="fa fa-exclamation-circle"></i> Username very short');
        $("#name").css("border", "red solid 2px");
        nameIsCorrect = false;
        return false;
    }
    if ($name.length > 30) {
        $("#namecheck").show();
        $("#namecheck").html('<i class="fa fa-exclamation-circle"></i>Name too long');
        $("#name").css("border", "red solid 2px");
        nameIsCorrect = false;
    } else {
        $("#namecheck").hide();
        $("#name").css("border", "green solid 2px");

    }
}

$("#usernamecheck").hide();
let usernameIsCorrect = true;
$("#username").keyup(function() {
    verifyusername();
});

function verifyusername() {
    $username = $("#username").val();

    if ($username.length == "") {
        $("#usernamecheck").show();
        usernameIsCorrect = false;
        return false;
    }
    if ($username.length < 3) {
        $("#usernamecheck").show();
        $("#usernamecheck").html('<i class="fa fa-exclamation-circle"></i> Username very short');
        $("#username").css("border", "red solid 2px");
        usernameIsCorrect = false;
        return false;
    }
    if ($username.length > 14) {
        $("#usernamecheck").show();
        $("#usernamecheck").html(
            '<i class="fa fa-exclamation-circle"></i> Username should have less than 14 characters');
        $("#username").css("border", "red solid 2px");
        usernameIsCorrect = false;
        return false;
    } else {
        $("#usernamecheck").hide();
        $("#username").css("border", "green solid 2px");
        /* $("#username").append("<i style='float:right' class='fa fa-check'></i>"); */
    }


}

$("#emailcheck").hide();
let emailIsCorrect = true;
$("#Email").keyup(function() {
    IsEmail()
});

function IsEmail() {
    var email = $("#Email").val();

    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!regex.test(email)) {
        $("#emailcheck").show();
        $("#emailcheck").html('<i class="fa fa-exclamation-circle"></i> Invalid Email');
        $("#Email").css("border", "red solid 2px");
        emailIsCorrect = false;
        return false;
    } else {
        $("#emailcheck").hide();
        $("#Email").css("border", "green solid 2px");
    }
}

$('#passcheck').hide();
let nopasswordError = true;
$('#password').keyup(function() {
    validatePassword();
});

function validatePassword() {
    let passwrdValue =
        $('#password').val();
    if (passwrdValue.length == '') {
        $('#passcheck').show();
        nopasswordError = false;
        return false;
    }
    if ((passwrdValue.length < 3) ||
        (passwrdValue.length > 10)) {
        $('#passcheck').show();
        $('#passcheck').html(
            '<i class="fa fa-exclamation-circle"></i> Length of your password must be between 3 and 10');
        $('#passcheck').css("color", "red");
        $("#password").css("border", "red solid 2px");
        nopasswordError = false;
        return false;
    } else {
        $('#passcheck').hide();
        $("#password").css("border", "green solid 2px");
    }
}

// Validate Confirm Password
$('#conpasscheck').hide();
let confirmPasswordError = true;
$('#conpassword').keyup(function() {
    validateConfirmPasswrd();

});

function validateConfirmPasswrd() {
    let confirmPasswordValue =
        $('#conpassword').val();
    let passwrdValue =
        $('#password').val();
    if (passwrdValue != confirmPasswordValue) {
        $('#conpasscheck').show();
        $('#conpasscheck').html(
            '<i class="fa fa-exclamation-circle"></i> Password Not Matching');
        $('#conpasscheck').css(
            "color", "red");
        $('#conpassword').css(
            "border", "red solid 2px");
        confirmPasswordError = false;
        return false;
    } else {
        $('#conpasscheck').hide();
        $('#conpassword').css(
            "border", "2px green solid");
    }
}
