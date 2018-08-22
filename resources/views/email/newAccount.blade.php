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

<p>Welcome to IPM</p>

<p>Please verify your email address by clicking this link to activate your IPM Account:</p>

<a href="{{env('APP_URL')}}/profile/activate/{{$emailAdded}}/{{$verifyCode}}">
    {{env('APP_URL')}}/profile/activate/{{$emailAdded}}/{{$verifyCode}}</a>
<br>
<p>
    If this action is not done by you. Please contact us as soon as possible.<br>
    Only trust emails that come from our domain host Itsaprojectmanager.tk
    & itsaprojectmanager@gmail.com and never share your passwords</p>
<br>
<p>Sincerely,</p>

<p><img width="200px" src="https://itsaprojectmanager.tk/img/IPM_BLACK.png"/></p>
<p> Project Specification Simplified!</p>
<p><span>Email: itsaprojectmanager@gmail.com</span></p>
<p>
        <span>
            <a href="https://www.instagram.com/internalprojectmanager/"><img width="20px" src="https://itsaprojectmanager.tk/img/icon/instagram-brands.svg"></a>
            <a href="https://www.facebook.com/IPM-610644082649746/"><img width="20px" src="https://itsaprojectmanager.tk/img/icon/facebook-brands.svg"></a>
            <a href="https://twitter.com/internalpm"><img width="20px" src="https://itsaprojectmanager.tk/img/icon/twitter-square-brands.svg"></a>
            <a href="https://medium.com/@internalproject"><img width="20px" src="https://itsaprojectmanager.tk/img/icon/medium-brands.svg"></a>
        </span>
</p>


</body>
</html>

