<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
    <link href="{{asset('css/pdf.css', config('app.secure'))}}" rel="stylesheet" type="text/css">
</head>

<body>

<script type="text/php">
    $GLOBALS['chapters'] = array();
</script>

<main>

    <!-- PAGE 1 -->
    <p id="p1">
        <img class="logo-p1" src="{{asset('img/logo-iav-circles.png')}}">
        <span class="h1-p1">PROJECT SPECIFICATION</span>
        <span class="h2-p1">{{$project->name}} {{$release->name}} {{$release->version}}</span>
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
    <script type="text/php">
    $GLOBALS['backside'] = $pdf->open_object();
    </script>
        <span class="h1">CONTENTS</span>
        <br><br><br><br><br>
        <span class="content-p3">
                <span class="content-title" id="disable-font">
                    <span id="content-title-font">PROJECT DESCRIPTION</span>
                    <span class="content-pagenum" id="disable-font">%%CH1%%</span>
                </span>
                <hr>
                <span class="content-title" id="disable-font">
                    <span id="content-title-font">PROJECT ROLES & RESPONSIBILITIES</span>
                    <span class="content-pagenum" id="disable-font">%%CH2%%</span>
                </span>
                <hr>
                <span class="content-title" id="disable-font">
                    <span id="content-title-font">FEATURES</span>
                    <span class="content-pagenum" id="disable-font">%%CH3%%</span>
                </span>
                <hr>
                <span class="content-subtitle" id="disable-font">
                    <span id="content-title-font">1.0 RE-DESIGN WEBSITE</span>
                    <span class="content-pagenum" id="disable-font"></span>
                </span>
                <hr>
                <span class="content-subtitle" id="disable-font">
                    <span id="content-title-font">FUNCTIONAL REQUIREMENTS</span>
                    <span class="content-pagenum" id="disable-font"></span>
                </span>
                <hr>
            </span>
    </p>
    <script type="text/php">
            $pdf->close_object();
    </script>
    <!-- END OF PAGE 3 -->

    <!-- PAGE 4 -->
    <p id="p4">
        <span class="h1" id="project-description">PROJECT<br>DESCRIPTION</span>
        <script type="text/php">
            $GLOBALS['chapters']['1'] = $pdf->get_page_number();
        </script>
        <br><br><br>
        <span class="h2" style="margin-bottom: 600px;">PROJECT DESCRIPTION</span><br>
        <span class="project-description">
                {{ $project->description }}
            </span>
        <br><br><br><br>
        <span class="h2">PROJECT ROLES & RESPONSIBILITIES</span>
        <script type="text/php">
            $GLOBALS['chapters']['2'] = $pdf->get_page_number();
        </script>
        <br><br><br>

        <span>
            <table class="table-p4">
                <thead>
                <tr class="bold-text-p4" align="center">
                    <th align="center" width="35%">ROLE</th>
                    <th align="left" width="25%">NAMED</th>
                    <th align="center" width="50%">RESPONSIBILITY</th>
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
                        <span class="bold-text-p4">Jochem Verheul</span><br>
                        <span class="company-p4">Itsavirus</span><br><br>
                        <span class="bold-text-p4">Chris Dawe</span><br>
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
                        <span class="bold-text-p4">Laurens Verspeek</span><br>
                        <span class="company-p4">Itsavirus</span><br><br>
                        <span class="bold-text-p4">Noman Jabbar</span><br>
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
        </span>
    </p>
    <!-- END OF PAGE 4 -->

    <!-- PAGE 5 -->
    @foreach($features as $f)
        <p>
            <span class="h2">FEATURE {{ $f->id }}.0</span>
            <script type="text/php">
                $GLOBALS['chapters']['3'] = $pdf->get_page_number();

            </script>
            <span>
                <table class="table-p5">
                    <tbody>
                        <tr class="project-description">
                            <td width="35%">
                                {{ $f->name }}
                            </td>
                            <td width="65%">
                                {{ $f->description }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </span><br><br><br>

            <span class="h2">FUNCTIONAL REQUIREMENTS</span><br><br>
            <span>
                <table class="table-p5">
                    <tbody>
                        <tr class="project-description">
                            <td width="35%">
                                <strong>FR-1.1</strong>
                                Header
                            </td>
                            <td width="65%">
                                Hier moet een introtekst komen met een korte uitleg over Effect Ai plus een button om door te klikken onder de header komen 6 tot 8 blokken deze linken naar updates en nieuws. Er kunnen ook blokken tussen zitten met een creatieve interactie.
                            </td>
                        </tr>

                        <tr>
                            <td><br></td>
                            <td><br></td>
                        </tr>

                        <tr class="project-description">
                            <td width="35%">
                                <strong>FR-1.2</strong>
                                Content blokken
                            </td>
                            <td width="65%">
                                Hier moet een introtekst komen met een korte uitleg over Effect Ai plus een button om door te klikken onder de header komen 6 tot 8 blokken deze linken naar updates en nieuws. Er kunnen ook blokken tussen zitten met een creatieve interactie.
                            </td>
                        </tr>

                        <tr>
                            <td><br></td>
                            <td><br></td>
                        </tr>

                         <tr class="project-description">
                            <td width="35%">
                                <strong>FR-1.3</strong>
                                Footer
                            </td>
                            <td width="65%">
                                Hier moet een introtekst komen met een korte uitleg over Effect Ai plus een button om door te klikken onder de header komen 6 tot 8 blokken deze linken naar updates en nieuws. Er kunnen ook blokken tussen zitten met een creatieve interactie.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </span>
        </p>
@endforeach
<!-- END OF PAGE 5 -->

</main>

<footer>
    <img class="logo-footer" src="{{asset('img/logo-iav.png', config('app.secure'))}}">
    <div class="page-nr">
        <span class="pagenum"></span>
    </div>
</footer>

<script type="text/php">
	foreach ($GLOBALS['chapters'] as $chapter => $page) {
		$pdf->get_cpdf()->objects[$GLOBALS['backside']]['c'] = str_replace( '%%CH'.$chapter.'%%' , $page , $pdf->get_cpdf()->objects[$GLOBALS['backside']]['c'] );
	}
	$pdf->page_script('
		if ($PAGE_NUM==1 ) {
			$pdf->add_object($GLOBALS["backside"],"add");
			$pdf->stop_object($GLOBALS["backside"]);
		}
	');

</script>

</body>
</html>