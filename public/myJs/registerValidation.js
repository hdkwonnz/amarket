//아래 코드는 일반적인 ajax와는 조금 다르니 controller의 코드를 먼저 check 해 보고
//copy해서 사용 할 시에는 주의 요망.31/03/2019
$(function () {
    $('#submit').click(function (e) {

        //e.preventDefault(); //본 function 에서는 사용하면 run이 안된다. 왜냐면 cotroller의
        //루틴이 일반 적인 코드와 틀리니까...31/03/2019
        var result = checkFields();

        if (result == false) {
            return false;
        }

        token = $('input[name=_token]').val().trim(); //1.이렇게 하면 아래 2번을 사용
       
        $.ajax({
            method: 'post',
            url: "/admin/register",
            //headers: { 'X-CSRF-TOKEN': token }, //2.이렇게 하면 위에 1번을 사용
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            data: {
                name: $('#name').val().trim(),
                lastname: $('#lastname').val().trim(),
                email: $('#email').val().trim(),
                password: $('#password').val().trim(),
                role: $('#role').val().trim()
            },
            //cache: false, //본 function 에서는 사용하면 run이 안된다. 왜냐면 cotroller의
            //async: false, //루틴이 일반 적인 코드와 다르니까...31/03/2019
            success: function (data) {
                if (data == 1) {
                    //본 function 에서는 사용하면 run이 안된다. 왜냐면 cotroller의
                }    //루틴이 일반 적인 코드와 다르니까...31/03/2019
                else {
                    //본 function 에서는 사용하면 run이 안된다. 왜냐면 cotroller의
                }   //루틴이 일반 적인 코드와 다르니까...31/03/2019
            },
            error: function (data) {
                //본 function 에서는 사용하면 run이 안된다. 왜냐면 cotroller의 
            }   //루틴이 일반 적인 코드와 다르니까...31/03/2019
        });
        //return false; //본 function 에서는 사용하면 run이 안된다. 왜냐면 cotroller의
    });                 //루틴이 일반 적인 코드와 다르니까...31/03/2019
});

function checkFields() {
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

    return true;
}