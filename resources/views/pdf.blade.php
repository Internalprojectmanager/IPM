<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
    <link href="{{asset('css/pdf.css', config('app.secure'))}}" rel="stylesheet" type="text/css">
</head>

<body>

    <main>
        <!-- FRONT PAGE -->
        <p id="page1">
            <img class="logo-frontpage" src="{{asset('img/logo-iav-circles.png')}}">
            <span class="h1_frontpage">PROJECT SPECIFICATION</span>
            <span class="h2_frontpage">EFFECT.AI RELEASE WEBSITE 2.0</span>
            <span class="h3_frontpage">21-07-2017</span>

            <span class="project-info-frontpage">
                <span class="project-info-left">PROJECT NAME</span>
                <span class="project-info-right">Effect.Ai release website 2.0</span>
                <hr>
                <span class="project-info-left">RELEASE</span>
                <span class="project-info-right">2.0</span>
                <hr>
                <span class="project-info-left">DESCRIPTION</span>
                <span class="project-info-right">Update van de huidige website</span>
                <hr>
                <span class="project-info-left">PREPARED BY</span>
                <span class="project-info-right">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                <hr>
            </span>
        </p>

    </main>

    <footer>
        <img src="{{asset('css/custom.css', config('app.secure'))}}"
    </footer>

</body>
</html>