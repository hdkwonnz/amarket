//ajax를 사용하려고 24시간 동안 노력하다 실패.31/03/2019
//Admin-register는 가능한데 여기서는 왜 안되는지 알 수 없음...
function validate() {
    if (grecaptcha.getResponse().length === 0) { //for reCAPTCHA check box
        alert("Please check reCaptch Box...");
        return false;
    }
    var password = document.getElementById("password");
    var confirmPassword = document.getElementById("password-confirm");

    var checkValue = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;

    if (!password.value.match(checkValue)) {
        alert('To check a password between 8 to 15 characters which contain at least one lowercase letter, one uppercase letter, one numeric digit, and one special character');
        password.focus();
        return false;
    }

    if (!confirmPassword.value.match(checkValue)) {
        alert('To check a password between 8 to 15 characters which contain at least one lowercase letter, one uppercase letter, one numeric digit, and one special character');
        confirmPassword.focus();
        return false;
    }

    if (password.value != confirmPassword.value) {
        window.alert("Password and ConfrimPassword Mismatched!!!");
        confirmPassword.focus();
        return false;
    }

    //return true; //이렇게 쓰면 않됨.31/03/2019

    return (true);
}