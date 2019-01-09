<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js"
            integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl"
            crossorigin="anonymous"></script>

    <style>
        body {
            font-family: Roboto;
            font-weight: 300;
            color: black;
        }

        svg {
            color: black;
        }
    </style>
</head>
<body>
Hi {{$firstName}} {{$lastName}},

<p>Your email has been added to your account.</p>

<p>Please verify that it is your email address by clicking this link:</p>

<p>Email that has been added: <u>{{$emailAdded}}</u></p>


@if(env('APP_URL'))
    <a href="{{env('APP_URL')}}/profile/activate/{{$emailAdded}}/{{$verifyCode}}">
        {{env('APP_URL')}}/profile/activate/{{$emailAdded}}/{{$verifyCode}}</a>
@elseif(env('APP_ENV') == "production")
    <a href="https://internalprojectmanager.com/profile/activate/{{$emailAdded}}/{{$verifyCode}}">
        https://internalprojectmanager.com/profile/activate/{{$emailAdded}}/{{$verifyCode}}</a>
@elseif(env('APP_ENV') == "develop")
    <a href="https://dev.internalprojectmanager.com/profile/activate/{{$emailAdded}}/{{$verifyCode}}">
        https://dev.internalprojectmanager.com/profile/activate/{{$emailAdded}}/{{$verifyCode}}</a>
@else
    <a href="https://dev.internalprojectmanager.com/profile/activate/{{$emailAdded}}/{{$verifyCode}}">
        https://dev.internalprojectmanager.com/profile/activate/{{$emailAdded}}/{{$verifyCode}}</a>
@endif

<br>
<p>
    If this action is not done by you. Please contact us as soon as possible.<br>
    Only trust emails that come from our domain host internalprojectmanager.com and never share your passwords</p>
<br>
<p>Sincerely,</p>

<p><img width="200px" src="https://itsaprojectmanager.com/img/IPM_BLACK.png"/></p>
<p> Project Specification Simplified!</p>
<p><span>Email: hello@internalprojectmanager.com</span></p>
<p>
        <span>
            <a href="https://www.instagram.com/internalprojectmanager/"><img width="20px" src="https://itsaprojectmanager.com/img/icon/instagram-brands.svg"></a>
            <a href="https://www.facebook.com/IPM-610644082649746/"><img width="20px" src="https://itsaprojectmanager.com/img/icon/facebook-brands.svg"></a>
            <a href="https://twitter.com/internalpm"><img width="20px" src="https://itsaprojectmanager.com/img/icon/twitter-square-brands.svg"></a>
            <a href="https://medium.com/@internalproject"><img width="20px" src="https://itsaprojectmanager.com/img/icon/medium-brands.svg"></a>
        </span>
</p>


</body>
</html>

