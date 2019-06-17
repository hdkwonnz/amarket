<!--아래 $thisUser는 Mail\VerifyEmail에서 넘어왔다-->
<!--아래 $thisUser는 Jobs\RegisterConfirmEmail.php에서 넘어왔다.25/03/2019-->
<div>
    To Verify Email
    <a href="{{ route('sendEmailDone',["email" => $thisUser->email, "verifyToken" => $thisUser->verifyToken]) }}">
        Click Here...
    </a>
</div>
