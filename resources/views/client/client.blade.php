@extends('layout.app')

@section('title')
    Client
@endsection

@section('breadcrumbs', Breadcrumbs::render('client'))
@section('content')
    <div class="row">
        <button class="btn-primary black" id="myBtn">
            Add Client <span class="icon-right glyphicon glyphicon-plus"></span>
        </button>
    </div>

    <div class="row block-white">
        <span class="block-white-title">All clients</span>
        <span class="block-white-subtitle">
            <span id="count_projects_bar">|</span>
            <span class="counter">{{$clientcount}}</span>
            <span class="contenttype">Clients</span>
        </span>

        @if(config('app.secure') == TRUE)
            <form action="{{secure_url('/client/overview')}}" class="pull-right searchform">
        @else
            <form action="{{url('/client/overview')}}" class="pull-right searchform">
        @endif
            {{ csrf_field() }}
            <div class="form-group pull-right">
                <input type="text" name="search" id="searchfield" class="search searchfield" placeholder="Search">
            </div>

            <div class="form-group pull-right">
                <select name="status" id="status" class="search dropdown-search">
                    <option value="" selected>Status</option>
                    @foreach($status as $s)
                        <option value="{{$s->id}}">{{$s->name}}</option>
                    @endforeach
                </select>
            </div>
                <input type="hidden" id="sort" value="">
                <input type="hidden" id="page" value="">
                <input type="hidden" id="order" value="">
        </form>
    </div>

    <!-- ADD CLIENT MODAL -->
    <div id="addClientModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <label>Add Client</label>
                <span class="modal-close">
                    <svg width="10px" height="10px" viewBox="0 0 10 10" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <!-- Generator: Sketch 47.1 (45422) - http://www.bohemiancoding.com/sketch -->
                        <title>Tabs cross icon</title>
                        <desc>Created with Sketch.</desc>
                        <defs></defs>
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="Style-Guide" transform="translate(-205.000000, -3353.000000)" fill-rule="nonzero" fill="#ffffff">
                                <g id="Group-3" transform="translate(170.000000, 3318.000000)">
                                    <path d="M40.8839201,39.9999609 L44.8169503,36.0668052 C45.0610166,35.8227408 45.0610166,35.4269565 44.8169503,35.1830483 C44.572884,34.9389839 44.1772528,34.9389839 43.9331865,35.1830483 L40,39.1160478 L36.0669698,35.1830483 C35.8229035,34.9389839 35.427116,34.9389839 35.1830497,35.1830483 C34.9389834,35.4271127 34.9389834,35.8228971 35.1830497,36.0668052 L39.1162362,39.9999609 L35.1830497,43.9331167 C34.9389834,44.1771811 34.9389834,44.5729654 35.1830497,44.8168736 C35.3050829,44.9389058 35.4650854,45 35.6249316,45 C35.7847779,45 35.9449366,44.9389058 36.0669698,44.8168736 L40,40.8838741 L43.9331865,44.8168736 C44.0552196,44.9389058 44.2152221,45 44.3750684,45 C44.5349146,45 44.6950734,44.9389058 44.8169503,44.8168736 C45.0610166,44.5728092 45.0610166,44.1770248 44.8169503,43.9331167 L40.8839201,39.9999609 Z" id="Tabs-cross-icon"></path>
                                </g>
                            </g>
                        </g>
                    </svg>
                </span>
            </div>
            <div class="modal-body">
                <form action="{{route('storeclient')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="form-label-modal">Client Name<span class="required">*</span></label>
                        <input type="text" class="form-control input-text-modal" name="client_name" id="client_name">
                    </div>
                    <div class="form-group">
                        <label class="form-label-modal">Client Description</label>
                        <textarea rows="4" cols="50" name="description" class="form-control input-text-modal"
                                  id="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label-modal">Status</label><br>
                        <select name="status" class="modal-dropdown-search" style="position: absolute; left: 0px;">
                            <option value="" selected>Status</option>
                            @foreach($status as $s)
                                <option value="{{$s->name}}">{{$s->name}}</option>
                            @endforeach
                        </select><br><br><br>
                    </div>
                    <div class="form-group" align="center">
                        <label class="add-more-info">Add more info</label>
                    </div>

                    <div class="tabset">
                        <!-- Tab 1 -->
                        <input type="radio" name="tabset" id="tab1" aria-controls="Links" checked>
                        <label for="tab1">
                            <svg width="13px" height="14px" viewBox="0 0 13 14" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <!-- Generator: Sketch 47.1 (45422) - http://www.bohemiancoding.com/sketch -->
                                <title>@ Icon</title>
                                <desc>Created with Sketch.</desc>
                                <defs></defs>
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="Style-Guide" transform="translate(-965.000000, -3242.000000)" fill-rule="nonzero" fill="#000000">
                                        <g id="Group-8" transform="translate(931.000000, 3209.000000)">
                                            <path d="M43.5311694,46.1276248 C42.4419385,46.707579 41.3318223,46.9285714 40.0039397,46.9285714 C36.7543387,46.9285714 34,44.526672 34,40.6844928 C34,36.561942 36.8333572,33 41.2335148,33 C44.681327,33 47,35.4416646 47,38.7836888 C47,41.7851562 45.3348921,43.5458416 43.4729033,43.5458416 C42.6789939,43.5458416 41.9464103,43.0056527 42.0062728,41.7852906 L41.9272543,41.7852906 C41.2336478,42.9657531 40.3218759,43.5458416 39.1327412,43.5458416 C37.9839139,43.5458416 36.9932565,42.6054481 36.9932565,41.0250496 C36.9932565,38.5433511 38.9342638,36.2815704 41.6886026,36.2815704 C42.540379,36.2815704 43.293848,36.4615885 43.8086652,36.7020606 L43.1358111,40.3243221 C42.8388932,41.8454758 43.0759486,42.5452629 43.7295137,42.5658172 C44.7410564,42.5854311 45.8705947,41.2248161 45.8705947,38.9035218 C45.8705947,36.0014674 44.1460235,33.9207796 41.0736155,33.9207796 C37.8450329,33.9207796 35.1294053,36.5017568 35.1294053,40.5647941 C35.1294053,43.9068184 37.2899083,45.9673549 40.221706,45.9673549 C41.3512443,45.9673549 42.4016311,45.7278232 43.2146965,45.2674334 L43.5311694,46.1276248 Z M42.4420715,37.4825872 C42.2434612,37.4222677 41.906369,37.3424686 41.4515472,37.3424686 C39.7072879,37.3424686 38.3002538,39.0037409 38.3002538,40.9444444 C38.3002538,41.8251901 38.7359195,42.4654638 39.6087143,42.4654638 C40.7576747,42.4654638 41.8079285,40.984344 42.0256948,39.7442336 L42.4420715,37.4825872 Z" id="@-Icon"></path>
                                        </g>
                                    </g>
                                </g>
                            </svg> Links
                        </label>
                        <!-- Tab 2 -->
                        <input type="radio" name="tabset" id="tab2" aria-controls="Contact-person">
                        <label for="tab2">
                            <svg width="12px" height="12px" viewBox="0 0 12 12" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <!-- Generator: Sketch 47.1 (45422) - http://www.bohemiancoding.com/sketch -->
                                <title>User icon</title>
                                <desc>Created with Sketch.</desc>
                                <defs></defs>
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                    <g id="Style-Guide" transform="translate(-639.000000, -3243.000000)" stroke="#000000">
                                        <g id="Group-5" transform="translate(605.000000, 3209.000000)">
                                            <path d="M40.0000414,39.611837 C38.7255381,39.611837 37.6923491,38.5794422 37.6923491,37.3059185 C37.6923491,36.0323949 38.7255381,35 40.0000414,35 C41.2745447,35 42.3077337,36.0323949 42.3077337,37.3059185 C42.3077337,38.5794422 41.2745447,39.611837 40.0000414,39.611837 Z M40.0000414,41.1491161 L40.0000414,41.1491161 C41.3827801,41.1894737 42.7368601,41.5527411 43.9538876,42.2098386 C44.5960871,42.5406068 44.9997381,43.201967 45.0000414,43.9239047 L45.0000414,44.2774789 C45.002096,44.4683931 44.9276333,44.652195 44.7932493,44.7879195 C44.6588653,44.9236441 44.4757289,45.000011 44.2846568,45 L35.715426,45 C35.5243539,45.000011 35.3412175,44.9236441 35.2068335,44.7879195 C35.0724496,44.652195 34.9979869,44.4683931 35.0000414,44.2774789 L35.0000414,43.9239047 C34.9974587,43.1992041 35.4015316,42.5341838 36.0461953,42.2021522 C37.2638822,41.5477308 38.6179262,41.1871054 40.0000414,41.1491161 Z" id="User-icon"></path>
                                        </g>
                                    </g>
                                </g>
                            </svg> Contact Person
                        </label>
                        <hr class="tab-hr">

                        <div class="tab-panels">
                            <section id="Links" class="tab-panel">
                                <div class="row" style="margin-bottom: 10px;">
                                    <div class="col-md-6">
                                        <label class="form-label-modal">Link</label>
                                        <input type="text" class="form-control input-text-modal" name="link-url" id="link-url" placeholder="http://">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label-modal">Title</label>
                                        <input type="text" class="form-control input-text-modal" name="link-title" id="link-title" placeholder="Link Title">
                                    </div>
                                </div>

                                <div class="row">
                                    <a href="#" class="add_more"><u>+ Add more Links</u></a>
                                </div>
                            </section>

                            <section id="Contact_person" class="tab-panel">
                                <div class="form-group">
                                    <label class="form-label-modal">Contact</label>
                                    <div class="row" style="margin-bottom: 10px;">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control input-text-modal" name="contact_name" id="contact_name" placeholder="Name">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control input-text-modal" name="contact_surname" id="contact_surname" placeholder="Surname">
                                        </div>
                                    </div>

                                    <div class="row" style="margin-bottom: 10px;">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control input-text-modal" name="contact_phone-number" id="contact_phone-number" placeholder="Phone Number">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control input-text-modal" name="contact_email" id="contact_email" placeholder="Email">
                                        </div>
                                    </div>

                                    <div class="row" style="margin-bottom: 10px;">
                                        <div class="col-md-12">
                                            <input type="text" class="form-control input-text-modal" name="contact_job-title" id="contact_job-title" placeholder="Job Title">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <a href="#" class="add_more"><u>+ Add more Contacts</u></a>
                                    </div>

                                </div>
                            </section>
                        </div>
                    </div>

            </div>
            <div class="modal-footer row" style="border:none;">
                <div class="col-md-6" align="left">
                    <a class="modal-cancel" style="color:#C74237;">
                        <svg width="10px" height="10px" viewBox="0 0 10 10" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <!-- Generator: Sketch 47.1 (45422) - http://www.bohemiancoding.com/sketch -->
                            <title>Tabs cross icon</title>
                            <desc>Created with Sketch.</desc>
                            <defs></defs>
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="Style-Guide" transform="translate(-205.000000, -3353.000000)" fill-rule="nonzero" fill="#C74237">
                                    <g id="Group-3" transform="translate(170.000000, 3318.000000)">
                                        <path d="M40.8839201,39.9999609 L44.8169503,36.0668052 C45.0610166,35.8227408 45.0610166,35.4269565 44.8169503,35.1830483 C44.572884,34.9389839 44.1772528,34.9389839 43.9331865,35.1830483 L40,39.1160478 L36.0669698,35.1830483 C35.8229035,34.9389839 35.427116,34.9389839 35.1830497,35.1830483 C34.9389834,35.4271127 34.9389834,35.8228971 35.1830497,36.0668052 L39.1162362,39.9999609 L35.1830497,43.9331167 C34.9389834,44.1771811 34.9389834,44.5729654 35.1830497,44.8168736 C35.3050829,44.9389058 35.4650854,45 35.6249316,45 C35.7847779,45 35.9449366,44.9389058 36.0669698,44.8168736 L40,40.8838741 L43.9331865,44.8168736 C44.0552196,44.9389058 44.2152221,45 44.3750684,45 C44.5349146,45 44.6950734,44.9389058 44.8169503,44.8168736 C45.0610166,44.5728092 45.0610166,44.1770248 44.8169503,43.9331167 L40.8839201,39.9999609 Z" id="Tabs-cross-icon"></path>
                                    </g>
                                </g>
                            </g>
                        </svg> Cancel
                    </a>
                </div>
                <div class="col-md-6" align="right">
                    <button class="btn btn-primary" type="submit">
                        Add Client <span class="icon-right glyphicon glyphicon-plus">
                    </button>
                </div>
            </div>
        </div>
    </div>
    @include('client.client_table')

@endsection