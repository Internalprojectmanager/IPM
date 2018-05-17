<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

<head>
    <title>{{$project->company->name}} {{$project->name}}
        - {{$release->name}} {{number_format(floatval($release->version), 1)}}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
    <link href="{{ public_path('css/pdf.css') }}" rel="stylesheet" type="text/css"/>
</head>

<body>
<script type="text/php">
	$GLOBALS['chapters'] = array();
	$GLOBALS['backside'] = $pdf->open_object();
</script>
<main>

    <!-- PAGE 1 -->
    <p id="p1">
        @if(!empty($project->team->logo))
            <img class="logo-p1" src="{{storage_path('app').$project->team->logo}}">
        @endif
        <span class="h1-p1">PROJECT SPECIFICATION</span>
        <span class="h2-p1">{{$project->company->name}} - {{$project->name}}
            : {{$release->name}} {{number_format(floatval($release->version), 1)}}</span>
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
                <span class="project-info-right">{!! nl2br(implode(' ', array_slice(str_word_count($release->description, 2), 0, 12))) !!}
                    ...</span>
                <hr>
                <span class="project-info-left">PREPARED BY</span>
                <span class="project-info-right prepared">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</span>
                <hr>
            </span>

        <footer>
            @if(!empty($project->team->logo))<img class="logo-footer" src="{{storage_path('app').$project->team->logo}}">@endif
                <span class="footer-name">{{$project->team->name}}</span>
        </footer>
    </p>
    <!-- END OF PAGE 1 -->

    <!-- PAGE 2 -->
    @if($project->team->slogan)
        <p id="p2">
            <br><br><br><br><br>
            <span class="h1">{{$project->team->slogan}}</span>
            <br>
            <span class="h1">Hard</span>
        </p>
    @endif
    <!-- END OF PAGE 2 -->

    <!-- PAGE 3 -->
    <p id="p3">

        <span class="h1">CONTENTS</span>
        <br><br><br><br><br>
        <span class="content-p3">
            <span class="content-title" id="disable-font">
                <span id="content-title-font">PROJECT DESCRIPTION</span>
                <span class="content-pagenum" id="disable-font"></span>
            </span>
            <hr>
            <span class="content-title" id="disable-font">
                <span id="content-title-font">PROJECT ROLES & RESPONSIBILITIES</span>
                <span class="content-pagenum" id="disable-font"></span>
            </span>
            <hr>
            <?php $featureID = 0; $i = 6; $k = 0; $type = null ?>
            @foreach($features as $f)

                @if($type !== $f->type)
                    @php
                        $k= 0;
                        $type = $f->type;
                        $featureID = 0;
                    @endphp
                @endif
                @if($k == 0)
                    @switch($type)
                        @case("NFR")
                        @php $f->typeFull = "Non Functional Requirements"; @endphp
                        @break
                        @case('Scope')
                        @php $f->typeFull = "Out Of Scope"; @endphp
                        @break
                        @case('TS')
                        @php $f->typeFull = "Technical Specifications"; @endphp
                        @break
                        @default
                        @php $f->typeFull = "Features"; @endphp
                        @break
                    @endswitch
                    <span class="content-title" id="disable-font">
                        <span id="content-title-font">{{$f->typeFull}}</span>
                            <span class="content-pagenum" id="disable-font"></span>
                        </span>
                    <hr>
                    @php $k++; @endphp
                @endif
                <span class="content-subtitle" id="disable-font">
                <span id="content-title-font"><?php $featureID++; echo $featureID . '.0'; ?> {{$f->name}}</span>
                <span class="content-pagenum" id="disable-font"></span>
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
        <br><br><br>
        <span class="h2" style="margin-bottom: 600px;">PROJECT DESCRIPTION</span><br>
        <span class="project-description">
                {!! nl2br($project->description) !!}
            </span>
        <br><br><br><br>
        <span class="h2">PROJECT ROLES & RESPONSIBILITIES</span>
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
                                            <i class="non-cursive"><span
                                                        class="bold-text-p4">{{$a->users->first_name}} {{$a->users->last_name}}</span><br>
                                            <span class="company-p4">{{$project->team()->first()->name}}</span></i><br>
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
                                            <i class="non-cursive"><span
                                                        class="bold-text-p4">{{$a->users->first_name}} {{$a->users->last_name}}</span><br>
                                                <span class="company-p4">{{$project->team()->first()->name}}</span></i><br>
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
                                            <i class="non-cursive"><span
                                                        class="bold-text-p4">{{$a->users->first_name}} {{$a->users->last_name}}</span><br>
                                                <span class="company-p4">{{$project->team()->first()->name}}</span></i><br>
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
    <p>
    @php $l = 1; $type1 = null; @endphp
    @foreach($features as $f)
        @if($type1 !== $f->type)
            @php
                $l = 0;
                $type1 = $f->type;
                $featureID = 0;
            @endphp

        @endif
        @if($l == 0)
            @if($f->type !== "Feature")
                </p><p>
            @endif
            <span class="h1" id="project-description">{{$f->typeFull}}</span><br><br>
            @php $l++; @endphp
        @endif

        <span class="no-break row">
                <span class="h2">
                    {{$type1}}
                    <?php
                    $chap++;
                    $featureID++;
                    $i = 0;
                    echo $featureID . '.0';
                    ?>
                </span>
                <br>
                <table class="table-p5">
                        <tbody>
                            <tr class="project-description">
                                <td>
                                    {{$f->name}}
                                </td>
                                <td>
                                    {!! nl2br($f->description) !!}
                                </td>
                            </tr>
                        </tbody>
                </table>
                <br><br>
                @if($f->requirements->count() > 0)
                        @if($type1 == "Feature")
                            <span class="h2">FUNCTIONAL REQUIREMENTS</span>
                        @elseif($type1 == "NFR" || $type1 == 'TS')
                            <span class="h2">REQUIREMENTS</span>
                        @endif

                <br><br>
                    <table class="table-p5">
                        <tbody>
                        <?php $reqnr = 1; ?>
                        @foreach($f->requirements as $r)
                            <tr class="project-description">
                                <td>
                                    <strong>
                                        FR-<?php $FRID = $featureID . "." . $reqnr; echo $FRID; $reqnr++; ?><br>
                                    </strong>
                                    {{ $r->name }}
                                </td>
                                <td>
                                    {!! nl2br($r->description) !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                            <br><br>
            @endif
            </span>
        @endforeach
        </p>
        <!-- END OF PAGE 5 -->

</main>

<footer>
    <div class="row">
        <div class="col-md-12">
            @if(!empty($project->team->logo))
                <img class="logo-footer" src="{{storage_path('app').$project->team->logo}}">
            @endif
            <span class="footer-name">{{$project->team->name}}</span>
            <span class="footer-name pagenum"></span>
        </div>

    </div>

</footer>

</body>
</html>
