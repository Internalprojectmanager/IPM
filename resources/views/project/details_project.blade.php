@extends('layout.app')

@section('title')
    Project details
@endsection

@section('breadcrumbs', Breadcrumbs::render('singleproject', $projects, $companys))

@section('content')

    <div class="row center">
        <div class="header-3" id="project-details">
            <span class="project-title" id="project-name">Project Name</span>
            <span class="project-detail" id="name-project">{{$projects->name}}</span>

            <span class="project-title" id="project-description">Project Description</span>
            <span class="project-detail" id="description-project">{{$projects->description}}</span>

            <span class="project-title" id="project-code">Project Code</span>
            <span class="project-detail" id="code-project">-</span>

            <span class="project-title" id="client-name">Client</span>
            <span class="project-detail" id="name-client">{{$companys->name}}</span>

            <span class="project-title" id="contact-person">Contact Person</span>
            <svg id="user-icon" width="15px" height="15px" viewBox="0 0 15 15" version="1.1"
                 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <!-- Generator: Sketch 47.1 (45422) - http://www.bohemiancoding.com/sketch -->
                <title>User icon</title>
                <desc>Created with Sketch.</desc>
                <defs></defs>
                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round"
                   stroke-linejoin="round">
                    <g id="Project-MUSK-Empty" transform="translate(-716.000000, -261.000000)" stroke="#666666">
                        <g id="Project-Leeg" transform="translate(140.000000, 143.000000)">
                            <g id="Contact-Person" transform="translate(562.000000, 90.000000)">
                                <g id="Contact-persoon" transform="translate(15.000000, 26.000000)">
                                    <path d="M6.50005384,8.99538816 C4.84319959,8.99538816 3.50005384,7.65327481 3.50005384,5.99769408 C3.50005384,4.34211336 4.84319959,3 6.50005384,3 C8.15690809,3 9.50005384,4.34211336 9.50005384,5.99769408 C9.50005384,7.65327481 8.15690809,8.99538816 6.50005384,8.99538816 Z M6.50005384,10.9938509 L6.50005384,10.9938509 C8.29761413,11.0463159 10.0579181,11.5185634 11.6400538,12.3727902 C12.4749133,12.8027889 12.9996596,13.6625571 13.0000538,14.6010761 L13.0000538,15.0607225 C13.0027247,15.308911 12.9059232,15.5478535 12.7312241,15.7242954 C12.5565249,15.9007373 12.3184476,16.0000143 12.0700538,16 L0.930053839,16 C0.681660075,16.0000143 0.443582754,15.9007373 0.268883593,15.7242954 C0.094184432,15.5478535 -0.00261706216,15.308911 5.38389466e-05,15.0607225 L5.38389466e-05,14.6010761 C-0.00330366583,13.6589654 0.521991136,12.794439 1.36005384,12.3627978 C2.94304687,11.51205 4.703304,11.0432371 6.50005384,10.9938509 Z"
                                          id="User-icon"></path>
                                </g>
                            </g>
                        </g>
                    </g>
                </g>
            </svg>
            <span class="project-detail" id="contact-name">-</span>

            <svg id="phone-icon" width="15px" height="15px" viewBox="0 0 15 15" version="1.1"
                 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <!-- Generator: Sketch 47.1 (45422) - http://www.bohemiancoding.com/sketch -->
                <title>Telefoon icon</title>
                <desc>Created with Sketch.</desc>
                <defs></defs>
                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round"
                   stroke-linejoin="round">
                    <g id="Project-MUSK-Empty" transform="translate(-716.000000, -285.000000)" stroke="#666666">
                        <g id="Project-Leeg" transform="translate(140.000000, 143.000000)">
                            <g id="Contact-Person" transform="translate(562.000000, 90.000000)">
                                <g id="Telefoon-nummer-Copy" transform="translate(15.000000, 53.000000)">
                                    <path d="M2.88549618,5.78456217 C3.78512417,7.68831517 5.3144534,9.22124044 7.21374046,10.1229838 L8.94656489,8.79926785 C9.14381782,8.59429503 9.44315135,8.52528643 9.70992366,8.62328249 C10.5400692,8.89719084 11.4084772,9.03666946 12.2824427,9.03646551 C12.6690022,9.05909307 12.9774255,9.36824159 13,9.75571001 L13,12.2807173 C12.9774255,12.6681857 12.6690022,12.9773342 12.2824427,12.9999618 C9.02774738,13.0080923 5.90357646,11.7178249 3.59928968,9.41386183 C1.2950029,7.10989876 -1.01076986e-05,3.98160303 0,0.719244503 C0.0225744872,0.331776082 0.33099778,0.0226275684 0.717557252,0 L3.24427481,0 C3.63083428,0.0226275684 3.93925757,0.331776082 3.96183206,0.719244503 C3.96110569,1.59530668 4.10027033,2.46583926 4.3740458,3.29781256 C4.45851975,3.5672094 4.38809328,3.86134304 4.19083969,4.06296629 L2.88549618,5.78456217 Z"
                                          id="Telefoon-icon"></path>
                                </g>
                            </g>
                        </g>
                    </g>
                </g>
            </svg>
            <span class="project-detail" id="contact-phone">-</span>

            <svg id="email-icon" width="13px" height="14px" viewBox="0 0 13 14" version="1.1"
                 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <!-- Generator: Sketch 47.1 (45422) - http://www.bohemiancoding.com/sketch -->
                <title>@ Icon</title>
                <desc>Created with Sketch.</desc>
                <defs></defs>
                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="Project-MUSK-Empty" transform="translate(-717.000000, -309.000000)" fill-rule="nonzero"
                       fill="#666666">
                        <g id="Project-Leeg" transform="translate(140.000000, 143.000000)">
                            <g id="Contact-Person" transform="translate(562.000000, 90.000000)">
                                <g id="Email" transform="translate(15.000000, 74.000000)">
                                    <path d="M9.53116942,15.1276248 C8.44193852,15.707579 7.33182227,15.9285714 6.00393967,15.9285714 C2.75433875,15.9285714 0,13.526672 0,9.68449281 C0,5.56194196 2.83335721,2 7.2335148,2 C10.681327,2 13,4.4416646 13,7.78368882 C13,10.7851563 11.3348921,12.5458416 9.47290328,12.5458416 C8.6789939,12.5458416 7.9464103,12.0056527 8.00627277,10.7852906 L7.92725431,10.7852906 C7.23364782,11.9657531 6.3218759,12.5458416 5.13274119,12.5458416 C3.98391388,12.5458416 2.99325652,11.6054481 2.99325652,10.0250496 C2.99325652,7.54335111 4.93426385,5.28157035 7.6886026,5.28157035 C8.54037903,5.28157035 9.29384798,5.46158854 9.80866522,5.7020606 L9.13581106,9.32432209 C8.83889321,10.8454758 9.07594859,11.5452629 9.72951373,11.5658172 C10.7410564,11.5854311 11.8705947,10.2248161 11.8705947,7.90352183 C11.8705947,5.00146743 10.1460235,2.9207796 7.07361549,2.9207796 C3.84503295,2.9207796 1.12940526,5.50175678 1.12940526,9.56479415 C1.12940526,12.9068184 3.28990831,14.9673549 6.22170603,14.9673549 C7.35124432,14.9673549 8.40163112,14.7278232 9.21469649,14.2674334 L9.53116942,15.1276248 Z M8.44207155,6.48258722 C8.24346118,6.42226769 7.90636896,6.34246858 7.45154721,6.34246858 C5.70728787,6.34246858 4.30025378,8.00374091 4.30025378,9.94444444 C4.30025378,10.8251901 4.73591953,11.4654638 5.60871434,11.4654638 C6.75767468,11.4654638 7.80792845,9.984344 8.02569481,8.74423363 L8.44207155,6.48258722 Z"
                                          id="@-Icon"></path>
                                </g>
                            </g>
                        </g>
                    </g>
                </g>
            </svg>
            <span class="project-detail" id="contact-email">-</span>

            <span class="project-title" id="link">Link</span>
            <svg id="world-icon" width="14px" height="14px" viewBox="0 0 14 14" version="1.1"
                 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <!-- Generator: Sketch 47.1 (45422) - http://www.bohemiancoding.com/sketch -->
                <title>World icon</title>
                <desc>Created with Sketch.</desc>
                <defs></defs>
                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="Project-MUSK-Empty" transform="translate(-982.000000, -202.000000)" fill-rule="nonzero"
                       fill="#666666">
                        <g id="Project-Leeg" transform="translate(140.000000, 143.000000)">
                            <g id="Link" transform="translate(827.000000, 30.000000)">
                                <g id="URL" transform="translate(15.000000, 26.000000)">
                                    <path d="M14,10 C14,6.14004225 10.8586761,3.00013146 7.00023005,3 C7.00006573,3 6.99993427,3 6.99976995,3 C3.13899061,3.00013146 0,6.14244131 0,10 C0,13.8642629 3.14569484,17 7,17 C10.860385,17 14,13.8581502 14,10 Z M0.869544601,10.42723 L3.85992488,10.42723 C3.8966338,11.2820845 4.04350235,12.1169906 4.29349765,12.9158451 L1.59143192,12.9158451 C1.18553052,12.1659906 0.931361502,11.3226714 0.869544601,10.42723 Z M1.59143192,7.08415493 L4.29349765,7.08415493 C4.04350235,7.88300939 3.89666667,8.71791549 3.85992488,9.57276995 L0.869544601,9.57276995 C0.931361502,8.67732864 1.18553052,7.83400939 1.59143192,7.08415493 Z M13.1304554,9.57276995 L10.1400751,9.57276995 C10.1033662,8.71791549 9.95649765,7.88300939 9.70650235,7.08415493 L12.4085681,7.08415493 C12.8144695,7.83400939 13.0686385,8.67732864 13.1304554,9.57276995 Z M9.2850892,9.57276995 L7.42723005,9.57276995 L7.42723005,7.08415493 L8.80646009,7.08415493 C9.08205634,7.87821127 9.2446338,8.71426761 9.2850892,9.57276995 Z M7.42723005,6.22969484 L7.42723005,4.553277 C7.83546479,5.07574648 8.18046948,5.63778404 8.45882629,6.22969484 L7.42723005,6.22969484 Z M6.57276995,6.22969484 L5.54117371,6.22969484 C5.81953052,5.63775117 6.16453521,5.07574648 6.57276995,4.553277 L6.57276995,6.22969484 Z M6.57276995,7.08415493 L6.57276995,9.57276995 L4.7149108,9.57276995 C4.7553662,8.71426761 4.91794366,7.87821127 5.19353991,7.08415493 L6.57276995,7.08415493 Z M4.7149108,10.42723 L6.57276995,10.42723 L6.57276995,12.9158451 L5.19353991,12.9158451 C4.91794366,12.1217887 4.7553662,11.2857324 4.7149108,10.42723 Z M6.57276995,13.7703052 L6.57276995,15.446723 C6.16453521,14.9242535 5.81953052,14.362216 5.54117371,13.7703052 L6.57276995,13.7703052 Z M7.42723005,13.7703052 L8.45882629,13.7703052 C8.18046948,14.3622488 7.83546479,14.9242535 7.42723005,15.446723 L7.42723005,13.7703052 Z M7.42723005,12.9158451 L7.42723005,10.42723 L9.2850892,10.42723 C9.2446338,11.2857324 9.08205634,12.1217887 8.80646009,12.9158451 L7.42723005,12.9158451 Z M10.1400751,10.42723 L13.1304554,10.42723 C13.0686714,11.3226714 12.8144695,12.1659906 12.4086009,12.9158451 L9.70653521,12.9158451 C9.95649765,12.1169906 10.1033333,11.2820845 10.1400751,10.42723 Z M11.8496854,6.22969484 L9.39413146,6.22969484 C9.05070423,5.41306103 8.59386385,4.64398122 8.03205634,3.94158216 C9.57573709,4.20373709 10.9251925,5.04324413 11.8496854,6.22969484 Z M5.9679108,3.94158216 C5.40610329,4.64401408 4.94929577,5.4130939 4.60586854,6.22969484 L2.15034742,6.22969484 C3.07480751,5.04324413 4.42426291,4.20373709 5.9679108,3.94158216 Z M2.15031455,13.7703052 L4.60583568,13.7703052 C4.94926291,14.586939 5.40610329,15.3560188 5.9679108,16.0584178 C4.42426291,15.7962629 3.07480751,14.9567559 2.15031455,13.7703052 Z M8.0320892,16.0584178 C8.59389671,15.3559859 9.05070423,14.5869061 9.39416432,13.7703052 L11.8496854,13.7703052 C10.9251925,14.9567559 9.57573709,15.7962629 8.0320892,16.0584178 Z"
                                          id="World-icon"></path>
                                </g>
                            </g>
                        </g>
                    </g>
                </g>
            </svg>
            <span class="project-detail" id="link-world">-</span>

            <svg id="t-icon" width="12px" height="14px" viewBox="0 0 12 14" version="1.1"
                 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <!-- Generator: Sketch 47.1 (45422) - http://www.bohemiancoding.com/sketch -->
                <title>T Copy</title>
                <desc>Created with Sketch.</desc>
                <defs></defs>
                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="Project-MUSK-Empty" transform="translate(-982.000000, -226.000000)" fill="#666666">
                        <g id="Project-Leeg" transform="translate(140.000000, 143.000000)">
                            <g id="Link" transform="translate(827.000000, 30.000000)">
                                <g id="Url-Text" transform="translate(15.000000, 50.000000)">
                                    <path d="M5.11026616,4.09341501 C4.21292327,4.13629424 3.51711274,4.18274605 3.02281369,4.23277182 C2.52851464,4.2827976 2.15209255,4.39356729 1.89353612,4.56508423 C1.6349797,4.73660116 1.45627426,4.99387271 1.35741445,5.33690658 C1.25855464,5.67994046 1.16349856,6.16589783 1.07224335,6.79479326 L0,6.8805513 C0.0456276046,6.50893127 0.0912545247,6.11587752 0.136882129,5.70137825 C0.167300532,5.3440513 0.201520722,4.94742433 0.239543726,4.51148545 C0.27756673,4.07554657 0.31178692,3.62889458 0.342205323,3.17151608 L0.547528517,3 L2.44106464,3.23583461 L9.51330798,3.23583461 L11.4524715,3 L11.6577947,3.17151608 C11.6730039,3.62889458 11.7034218,4.07197335 11.7490494,4.5007657 C11.794677,4.92955804 11.8326995,5.31546536 11.8631179,5.65849923 C11.9087455,6.05870542 11.9543724,6.43746631 12,6.79479326 L10.9277567,6.8805513 C10.806083,6.23736279 10.695818,5.73711256 10.5969582,5.3797856 C10.4980984,5.02245865 10.3231952,4.75446746 10.0722433,4.57580398 C9.82129152,4.39714051 9.46388065,4.2827976 9,4.23277182 C8.53611935,4.18274605 7.89354023,4.13629424 7.07224335,4.09341501 C7.02661574,4.52220735 6.98098882,5.14394692 6.93536122,5.95865237 C6.88973361,6.77335783 6.85171118,7.67023502 6.82129278,8.64931087 C6.79087437,9.62838672 6.76425867,10.6324604 6.74144487,11.661562 C6.71863106,12.6906636 6.70722433,13.6411391 6.70722433,14.5130168 C6.70722433,15.0418607 6.80608266,15.4170484 7.00380228,15.6385911 C7.2015219,15.8601338 7.53611932,15.9709035 8.00760456,15.9709035 L8.54372624,15.9709035 C8.70342285,15.9709035 8.83650137,15.9637571 8.94296578,15.949464 C9.06463939,15.9351709 9.17110221,15.9208781 9.26235741,15.906585 L9.33079848,15.992343 L9.12547529,16.9785605 C8.68440844,16.9785605 8.25855719,16.9714141 7.84790875,16.957121 C7.49809711,16.9428279 7.12927951,16.9321083 6.74144487,16.9249617 C6.35361023,16.9178152 6.03041954,16.914242 5.77186312,16.914242 C5.48288829,16.914242 5.1596976,16.9178152 4.80228137,16.9249617 C4.44486513,16.9321083 4.10646548,16.9428279 3.78707224,16.957121 L2.64638783,17 L2.82889734,16.0781011 C3.36121939,16.0352218 3.77946616,15.9816236 4.08365019,15.9173047 C4.38783422,15.8529859 4.61596882,15.7314966 4.76806084,15.5528331 C4.92015285,15.3741696 5.01520894,15.1204713 5.05323194,14.7917305 C5.09125494,14.4629897 5.11026616,14.0127645 5.11026616,13.4410413 L5.11026616,4.09341501 Z"
                                          id="T-Copy"></path>
                                </g>
                            </g>
                        </g>
                    </g>
                </g>
            </svg>
            <span class="project-detail" id="link-t">-</span>

            <button href="{{route('showdocument', ['name' => $projects->name, 'company_id' => $projects->company_id,
                    'document_name' => $documents->title, 'document_id' => $documents->id])}}" class="blue-button" id="button-files">
                <svg id="paperclip-icon" width="8px" height="19px" viewBox="0 0 8 19" version="1.1"
                     xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <!-- Generator: Sketch 47.1 (45422) - http://www.bohemiancoding.com/sketch -->
                    <title>Files/paperclip Icon</title>
                    <desc>Created with Sketch.</desc>
                    <defs></defs>
                    <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="BUTTON/Files" transform="translate(-15.000000, -13.000000)" fill-rule="nonzero"
                           fill="#FFFFFF">
                            <path d="M23,27.7777778 C23,30.1105556 21.21,32 19,32 C16.79,32 15,30.1105556 15,27.7777778 L15,16.1666667 C15,14.4144444 16.34,13 18,13 C19.66,13 21,14.4144444 21,16.1666667 L21,25.6666667 C21,26.8277778 20.1,27.7777778 19,27.7777778 C17.9,27.7777778 17,26.8277778 17,25.6666667 L17,17.2222222 L18,17.2222222 L18,25.6666667 C18,26.2472222 18.45,26.7222222 19,26.7222222 C19.55,26.7222222 20,26.2472222 20,25.6666667 L20,16.1666667 C20,15.0055556 19.1,14.0555556 18,14.0555556 C16.9,14.0555556 16,15.0055556 16,16.1666667 L16,27.7777778 C16,29.53 17.34,30.9444444 19,30.9444444 C20.66,30.9444444 22,29.53 22,27.7777778 L22,17.2222222 L23,17.2222222 L23,27.7777778 Z"
                                  id="Files/paperclip-Icon"></path>
                        </g>
                    </g>
                </svg>
                <span class="button-content" id="files-button">Files</span>
            </button>

            <button class="blue-button" id="button-people">
                <svg id="people-icon" width="20px" height="13px" viewBox="0 0 20 13" version="1.1"
                     xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <!-- Generator: Sketch 47.1 (45422) - http://www.bohemiancoding.com/sketch -->
                    <title>Peoples icon</title>
                    <desc>Created with Sketch.</desc>
                    <defs></defs>
                    <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="BUTTON/People" transform="translate(-15.000000, -16.000000)" fill-rule="nonzero"
                           fill="#FFFFFF">
                            <path d="M29.0909091,23.4285714 C27.9954545,23.4285714 26.2954545,23.7396429 25,24.3617857 C23.7045455,23.7396429 22.0045455,23.4285714 20.9090909,23.4285714 C18.9409091,23.4285714 15,24.4360714 15,26.4464286 L15,29 L35,29 L35,26.4464286 C35,24.4360714 31.0590909,23.4285714 29.0909091,23.4285714 Z M25.4545455,27.6071429 L16.3636364,27.6071429 L16.3636364,26.4464286 C16.3636364,25.9496429 18.6909091,24.8214286 20.9090909,24.8214286 C23.1272727,24.8214286 25.4545455,25.9496429 25.4545455,26.4464286 L25.4545455,27.6071429 Z M33.6363636,27.6071429 L26.8181818,27.6071429 L26.8181818,26.4464286 C26.8181818,26.0239286 26.6363636,25.6478571 26.3454545,25.3135714 C27.15,25.035 28.1318182,24.8214286 29.0909091,24.8214286 C31.3090909,24.8214286 33.6363636,25.9496429 33.6363636,26.4464286 L33.6363636,27.6071429 Z M20.9090909,22.5 C22.6681818,22.5 24.0909091,21.0421429 24.0909091,19.25 C24.0909091,17.4578571 22.6681818,16 20.9090909,16 C19.1545455,16 17.7272727,17.4578571 17.7272727,19.25 C17.7272727,21.0421429 19.1545455,22.5 20.9090909,22.5 Z M20.9090909,17.3928571 C21.9136364,17.3928571 22.7272727,18.2239286 22.7272727,19.25 C22.7272727,20.2760714 21.9136364,21.1071429 20.9090909,21.1071429 C19.9045455,21.1071429 19.0909091,20.2760714 19.0909091,19.25 C19.0909091,18.2239286 19.9045455,17.3928571 20.9090909,17.3928571 Z M29.0909091,22.5 C30.85,22.5 32.2727273,21.0421429 32.2727273,19.25 C32.2727273,17.4578571 30.85,16 29.0909091,16 C27.3363636,16 25.9090909,17.4578571 25.9090909,19.25 C25.9090909,21.0421429 27.3363636,22.5 29.0909091,22.5 Z M29.0909091,17.3928571 C30.0954545,17.3928571 30.9090909,18.2239286 30.9090909,19.25 C30.9090909,20.2760714 30.0954545,21.1071429 29.0909091,21.1071429 C28.0863636,21.1071429 27.2727273,20.2760714 27.2727273,19.25 C27.2727273,18.2239286 28.0863636,17.3928571 29.0909091,17.3928571 Z"
                                  id="Peoples-icon"></path>
                        </g>
                    </g>
                </svg>
                <span class="button-content" id="people-button">People</span>
            </button>

            <button class="blue-button" id="button-pdf">
                <svg id="pdf-icon" width="19px" height="19px" viewBox="0 0 19 19" version="1.1"
                     xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <!-- Generator: Sketch 47.1 (45422) - http://www.bohemiancoding.com/sketch -->
                    <title>Pdf icon</title>
                    <desc>Created with Sketch.</desc>
                    <defs></defs>
                    <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="BUTTON/Create-PDF" transform="translate(-15.000000, -13.000000)" fill-rule="nonzero"
                           fill="#FFFFFF">
                            <path d="M32.1,13 L20.7,13 C19.655,13 18.8,13.855 18.8,14.9 L18.8,26.3 C18.8,27.345 19.655,28.2 20.7,28.2 L32.1,28.2 C33.145,28.2 34,27.345 34,26.3 L34,14.9 C34,13.855 33.145,13 32.1,13 Z M24.025,20.125 C24.025,20.9135 23.3885,21.55 22.6,21.55 L21.65,21.55 L21.65,23.45 L20.225,23.45 L20.225,17.75 L22.6,17.75 C23.3885,17.75 24.025,18.3865 24.025,19.175 L24.025,20.125 Z M28.775,22.025 C28.775,22.8135 28.1385,23.45 27.35,23.45 L24.975,23.45 L24.975,17.75 L27.35,17.75 C28.1385,17.75 28.775,18.3865 28.775,19.175 L28.775,22.025 Z M32.575,19.175 L31.15,19.175 L31.15,20.125 L32.575,20.125 L32.575,21.55 L31.15,21.55 L31.15,23.45 L29.725,23.45 L29.725,17.75 L32.575,17.75 L32.575,19.175 Z M21.65,20.125 L22.6,20.125 L22.6,19.175 L21.65,19.175 L21.65,20.125 Z M16.9,16.8 L15,16.8 L15,30.1 C15,31.145 15.855,32 16.9,32 L30.2,32 L30.2,30.1 L16.9,30.1 L16.9,16.8 Z M26.4,22.025 L27.35,22.025 L27.35,19.175 L26.4,19.175 L26.4,22.025 Z"
                                  id="Pdf-icon"></path>
                        </g>
                    </g>
                </svg>
                <span class="button-content" id="pdf-button">Create PDF</span>
            </button>

        </div>

        <a class="btn-primary" id="addrelease"
           href="{{route('addrelease', ['name' => $projects->name, 'company_id' => $projects->company_id])}}">
            <span class="yellow-button" id="release-button">Add Release</span>
            <span class="glyphicon glyphicon-plus" id="release-plus"></span>
        </a>

        <div class="row">
            <table class="table table-hover table-center results" id="release-overview">
                <thead>
                <th>Version+Name</th>
                <th>Description</th>
                <th>Status</th>
                <th>Deadline</th>
                <th>Assigned To</th>
                </thead>
                <div id="release-white">
                    <tbody>
                    @foreach($releases as $release)
                        <tr>
                            <td><span class="tabletitle"><a href="{{route('showrelease', ['name' => $projects->name, 'company_id' => $projects->company_id,
                        'release_name' => $release->name, 'version' => $release->version])}}">{{$release->version}}
                                        - {{$release->name}} </a></span>
                            </td>
                            <td class="table-description">{{implode(' ', array_slice(str_word_count($release->description, 2), 0, 10))}}
                                ...
                            </td>
                            <td></td>
                            <td>{{$release->deadline}}</td>
                            <td></td>
                        </tr>
                    @endforeach
                    </tbody>
                </div>
            </table>
        </div>
    <!--
        <div class="col-md-4">
            <div class="row">
                <a class="btn btn-primary"
                   href="{{route('addletter', ['name' => $projects->name, 'company_id' => $projects->company_id])}}">
                    <span class="glyphicon glyphicon-plus"></span> New letter</a>
            </div>

            @foreach($letters as $letter)
        <div class="row">
            <a href="{{route('showletter', ['name' => $projects->name, 'company_id' => $projects->company_id, 'letter_id' => $letter->id])}}">{{$letter->title}}</a>
                </div>
            @endforeach
            </div>
            <div class="col-md-4">
                <div class="row">
                    <a class="btn btn-primary"
                       href="{{route('adddocument', ['name' => $projects->name, 'company_id' => $projects->company_id])}}">
                    <span class="glyphicon glyphicon-plus"></span> Add document</a>

            </div>
            @foreach($documents as $document)
        <p>
            <a href="{{route('showdocument', ['name' => $projects->name, 'company_id' => $projects->company_id,
                    'document_name' => $document->title, 'document_id' => $document->id])}}">{{$document->title}}</a>
                </p>
            @endforeach
            </div>
-->
    </div>

@endsection