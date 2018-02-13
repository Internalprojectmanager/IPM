<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{$project->company->name}} {{$project->name}} - {{$release->name}} {{number_format(floatval($release->version), 1)}}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
    <link href="{{asset('css/pdf.css', config('app.secure'))}}" rel="stylesheet" type="text/css">
</head>

<body>

<main>

    <!-- PAGE 1 -->
    <p id="p1">
        <img class="logo-p1" src="{{asset('img/logo-iav-circles.png')}}">
        <span class="h1-p1">PROJECT SPECIFICATION</span>
        <span class="h2-p1">{{$project->company->name}} {{$project->name}}  {{$release->name}} {{number_format(floatval($release->version), 1)}}</span>
        <span class="h3-p1"><?php echo date("d - m - Y"); ?>
        </span>

        <span class="project-info-p1">
                <span class="project-info-left">PROJECT NAME</span>
                <span class="project-info-right">{{$project->name}}</span>
                <hr>
                <span class="project-info-left">RELEASE</span>
                <span class="project-info-right">{{number_format(floatval($release->version), 1)}}</span>
                <hr>
                <span class="project-info-left">DESCRIPTION</span>
                <span class="project-info-right">{{implode(' ', array_slice(str_word_count($release->description, 2), 0, 12))}}...</span>
                <hr>
                <span class="project-info-left">PREPARED BY</span>
                <span class="project-info-right prepared">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</span>
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
            $GLOBALS['chapters'] = array();
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
            <?php $featureID = 0; $i = 4; ?>
            @foreach($features as $f)
                <span class="content-subtitle" id="disable-font">
                <span id="content-title-font"><?php $featureID++; echo $featureID . '.0'; ?> {{ $f->name }}</span>
                <span class="content-pagenum" id="disable-font">%%CH{{$i}}%%</span>
                <?php $i++; ?>
            </span>
                <hr>
            @endforeach
        </span>
        <script type="text/php">
            $pdf->close_object();

        </script>
    </p>
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
                    <td><hr></td>
                    <td><hr></td>
                    <td><hr></td>
                </tr>
                <tr>
                    <td align="center" class="bold-text-p4">Project manager(s)</td>
                    <td>
                        @php $acounter = 1; @endphp
                        @if($project->assignee->count() > 0)
                            @foreach($project->assignee as $a)
                                @if(!empty($a->users->jobtitles))
                                    @if($a->users->jobtitles->name == "Project Manager")
                                    @if($acounter <= 3)
                                        <i class="non-cursive"><span class="bold-text-p4">{{$a->users->first_name}} {{$a->users->last_name}}</span><br>
                                            <span class="company-p4">Itsavirus</span></i><br>
                                    @endif
                                    @php $acounter++; @endphp
                                    @endif
                                @endif
                            @endforeach
                        @endif
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
                        @php $acounter = 1; @endphp
                        @if($project->assignee->count() > 0)
                            @foreach($project->assignee as $a)
                                @if(!empty($a->users->jobtitles))
                                    @if($a->users->jobtitles->name == "Designer")
                                        @if($acounter <= 3)
                                            <i class="non-cursive"><span class="bold-text-p4">{{$a->users->first_name}} {{$a->users->last_name}}</span><br>
                                                <span class="company-p4">Itsavirus</span></i><br>
                                        @endif
                                        @php $acounter++; @endphp
                                    @endif
                                @endif
                            @endforeach
                        @endif
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
                        @php $acounter = 1; @endphp
                        @if($project->assignee->count() > 0)
                            @foreach($project->assignee as $a)
                                @if(!empty($a->users->jobtitles))
                                    @if($a->users->jobtitles->name == "Developer")
                                        @if($acounter <= 3)
                                            <i class="non-cursive"><span class="bold-text-p4">{{$a->users->first_name}} {{$a->users->last_name}}</span><br>
                                                <span class="company-p4">Itsavirus</span></i><br>
                                        @endif
                                        @php $acounter++; @endphp
                                    @endif
                                @endif
                            @endforeach
                        @endif
                    </td>
                    <td class="responsibility-p4">
                        Staff who actively work on the developing process
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
    <?php $featureID = 0; $chap = 4; ?>
    <script type="text/php">
        $GLOBALS['chapters']['3'] = $pdf->get_page_number();
    </script>
    @foreach($features as $f)
        <p>
            <script type="text/php">
                $GLOBALS['chapters'][{{$chap}}] = $pdf->get_page_number();
            </script>
            <span class="h2">
                FEATURE
                <?php
                $chap++;
                $featureID++;
                $i = 0;
                echo $featureID . '.0';
                ?>
            </span>
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
                        <?php $reqnr = 1; ?>
                        @foreach($f->requirements as $r)
                            <tr class="project-description">
                                <td width="35%">
                                    <strong>
                                        FR-<?php $FRID = $featureID. ".". $reqnr; echo $FRID; $reqnr++; ?><br>
                                    </strong>
                                    {{ $r->name }}
                                </td>
                                <td width="65%">
                                    {{ $r->description }}
                                </td>
                            </tr>

                            <tr>
                                <td><br></td>
                                <td><br></td>
                            </tr>
                        @endforeach

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
		if ($PAGE_NUM==3 ) {
			$pdf->add_object($GLOBALS["backside"],"add");
			$pdf->stop_object($GLOBALS["backside"]);
		}
	');

</script>

</body>
</html>