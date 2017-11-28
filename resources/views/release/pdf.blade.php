<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
    <link href="{{asset('css/pdf.css', config('app.secure'))}}" rel="stylesheet" type="text/css">
</head>

<body>

    <main>
        <!-- PAGE 1 -->
        <p id="p1">
            <img class="logo-p1" src="{{asset('img/logo-iav-circles.png')}}">
            <span class="h1-p1">PROJECT SPECIFICATION</span>
            <span class="h2-p1">{{$project->name}} RELEASE {{$release->name}} {{$release->version}}</span>
            <span class="h3-p1"><?php echo date("d - m - Y"); ?></span>

            <span class="project-info-p1">
                <span class="project-info-left">PROJECT NAME</span>
                <span class="project-info-right">{{$project->name}}</span>
                <hr>
                <span class="project-info-left">RELEASE</span>
                <span class="project-info-right">{{$release->version}}</span>
                <hr>
                <span class="project-info-left">DESCRIPTION</span>
                <span class="project-info-right">{{$release->description}}</span>
                <hr>
                <span class="project-info-left">PREPARED BY</span>
                <span class="project-info-right">{{$release->author}}</span>
                <hr>
            </span>
            <footer>
                <img class="logo-footer" src="{{asset('img/logo-iav.png', config('app.secure'))}}">
            </footer>
        </p>
        <!-- END OF PAGE 1 -->

        <!-- PAGE 2 -->
        <p id="p2">
            <br><br><br><br><br>
            <span class="h1">THE FUTURE IS</span>
            <br>
            <span class="h1">SIMPLE</span>
        </p>
        <!-- END OF PAGE 2 -->

        <!-- PAGE 3 -->
        <p id="p3">
            <span class="h1">CONTENTS</span>
            <br><br><br><br><br>
            <span class="content-p3">
                <span class="content-title">PROJECT DESCRIPTION
                    <span class="content-pagenum">04</span>
                </span>
                <hr>
                <span class="content-title">PROJECT ROLES & RESPONSIBILITIES
                    <span class="content-pagenum">05</span>
                </span>
                <hr>
                <span class="content-title">FEATURES
                    <span class="content-pagenum">06</span>
                </span>
                <hr>
                <span class="content-subtitle">1.0 RE-DESIGN WEBSITE
                    <span class="content-pagenum">07</span>
                </span>
                <hr>
                <span class="content-subtitle">FUNCTIONAL REQUIREMENTS
                    <span class="content-pagenum">08</span>
                </span>
                <hr>
            </span>
        </p>
        <!-- END OF PAGE 3 -->

        <!-- PAGE 4 -->
        <p id="p4">
            <span class="h1">PROJECT<br>DESCRIPTION</span>
            <br><br><br>
            <span class="h2">PROJECT DESCRIPTION</span><br><br>
            <span class="project-description">
                {{ $project->description }}
            </span>
            <br><br><br><br>
            <span class="h2">PROJECT ROLES & RESPONSIBILITIES</span><br><br><br>

            <table class="table-p4">
            <thead>
            <tr class="bold-text-p4" align="center">
                <th align="center" width="40%">ROLE</th>
                <th align="left" width="25%">NAMED</th>
                <th align="center" width="45%">RESPONSIBILITY</th>
            </tr>
            </thead>

            <tbody>
            <tr>
                <th><br></th>
                <th><br></th>
                <th><br></th>
            </tr>

            <tr>
                <td align="center" class="bold-text-p4">Project manager(s)</td>
                <td>
                    <span class="bold-text-p4">Nick Vogel</span><br>
                    <span class="company-p4">Itsavirus</span><br><br>
                    <span class="bold-text-p4">Erik Odijk</span><br>
                    <span class="company-p4">Itsavirus</span><br>
                </td>
                <td class="responsibility-p4">
                    Responsible for developing a definition of the
                    project. The Project Manager also ensures that
                    the project is deliveredon time, to budget and
                    to the required quality standard (within agreed
                    specifications).
                </td>
            </tr>

            <tr>
                <td><hr></td>
                <td><hr></td>
                <td><hr></td>
            </tr>

            <tr>
                <td align="center" class="bold-text-p4">Designer(s)</td>
                <td>
                    <span class="bold-text-p4">Nick Vogel</span><br>
                    <span class="company-p4">Itsavirus</span><br><br>
                    <span class="bold-text-p4">Erik Odijk</span><br>
                    <span class="company-p4">Itsavirus</span><br>
                </td>
                <td class="responsibility-p4">
                    Staff who actively work on the design process
                    of the project.
                </td>
            </tr>

            <tr>
                <td><hr></td>
                <td><hr></td>
                <td><hr></td>
            </tr>

            <tr>
                <td align="center" class="bold-text-p4">Developer(s)</td>
                <td>
                    <span class="bold-text-p4">Nick Vogel</span><br>
                    <span class="company-p4">Itsavirus</span><br><br>
                    <span class="bold-text-p4">Erik Odijk</span><br>
                    <span class="company-p4">Itsavirus</span><br>
                </td>
                <td class="responsibility-p4">
                    Staff who actively work on the develop process
                    of the project.
                </td>
            </tr>

            <tr>
                <td><hr></td>
                <td><hr></td>
                <td><hr></td>
            </tr>
            </tbody>
        </table>
        </p>
        <!-- END OF PAGE 4 -->

    </main>

    <footer>
        <img class="logo-footer" src="{{asset('img/logo-iav.png', config('app.secure'))}}">
        <div class="page-nr">
            <span class="pagenum"></span>
        </div>
    </footer>

</body>
</html>