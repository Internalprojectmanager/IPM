<div class="form-group">
    <label>Client<span class="required">*</span></label>
    <div class="row">
        <div class="form-group">
            <div class="col-md-6">
                <select required class="form-control selectpicker input-text-modal" name="team">
                    <option selected disabled="">-- Select Team --</option>
                    @foreach($teams as $u)
                        <option value="{{$u->id}}">{{$u->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control input-text-modal" placeholder="Client Name" name="client_name" id="client_name" value="{{ old('client_name', $client->name ?? '') }}">

            </div>

        </div>
    </div>
</div>

<div class="row">



<div class="form-group">
    <label>Client Description</label>
    <textarea rows="4" cols="50" name="description" class="form-control input-text-modal"
              id="description">{{ old('description', $client->description ?? '') }}</textarea>
</div>
<div class="form-group">
    <label>Status <span class="required">*</span></label><br>
    <select name="status" required="" class="modal-dropdown-search">
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
        <svg width="13px" height="14px" viewBox="0 0 13 14" version="1.1"
             xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <!-- Generator: Sketch 47.1 (45422) - http://www.bohemiancoding.com/sketch -->
            <title>@ Icon</title>
            <desc>Created with Sketch.</desc>
            <defs></defs>
            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <g id="Style-Guide" transform="translate(-965.000000, -3242.000000)"
                   fill-rule="nonzero" fill="#000000">
                    <g id="Group-8" transform="translate(931.000000, 3209.000000)">
                        <path d="M43.5311694,46.1276248 C42.4419385,46.707579 41.3318223,46.9285714 40.0039397,46.9285714 C36.7543387,46.9285714 34,44.526672 34,40.6844928 C34,36.561942 36.8333572,33 41.2335148,33 C44.681327,33 47,35.4416646 47,38.7836888 C47,41.7851562 45.3348921,43.5458416 43.4729033,43.5458416 C42.6789939,43.5458416 41.9464103,43.0056527 42.0062728,41.7852906 L41.9272543,41.7852906 C41.2336478,42.9657531 40.3218759,43.5458416 39.1327412,43.5458416 C37.9839139,43.5458416 36.9932565,42.6054481 36.9932565,41.0250496 C36.9932565,38.5433511 38.9342638,36.2815704 41.6886026,36.2815704 C42.540379,36.2815704 43.293848,36.4615885 43.8086652,36.7020606 L43.1358111,40.3243221 C42.8388932,41.8454758 43.0759486,42.5452629 43.7295137,42.5658172 C44.7410564,42.5854311 45.8705947,41.2248161 45.8705947,38.9035218 C45.8705947,36.0014674 44.1460235,33.9207796 41.0736155,33.9207796 C37.8450329,33.9207796 35.1294053,36.5017568 35.1294053,40.5647941 C35.1294053,43.9068184 37.2899083,45.9673549 40.221706,45.9673549 C41.3512443,45.9673549 42.4016311,45.7278232 43.2146965,45.2674334 L43.5311694,46.1276248 Z M42.4420715,37.4825872 C42.2434612,37.4222677 41.906369,37.3424686 41.4515472,37.3424686 C39.7072879,37.3424686 38.3002538,39.0037409 38.3002538,40.9444444 C38.3002538,41.8251901 38.7359195,42.4654638 39.6087143,42.4654638 C40.7576747,42.4654638 41.8079285,40.984344 42.0256948,39.7442336 L42.4420715,37.4825872 Z"
                              id="@-Icon"></path>
                    </g>
                </g>
            </g>
        </svg>
        Links
    </label>
    <!-- Tab 2 -->
    <input type="radio" name="tabset" id="tab2" aria-controls="Contact-person">
    <label for="tab2">
        <svg width="12px" height="12px" viewBox="0 0 12 12" version="1.1"
             xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <!-- Generator: Sketch 47.1 (45422) - http://www.bohemiancoding.com/sketch -->
            <title>User icon</title>
            <desc>Created with Sketch.</desc>
            <defs></defs>
            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
               stroke-linecap="round" stroke-linejoin="round">
                <g id="Style-Guide" transform="translate(-639.000000, -3243.000000)"
                   stroke="#000000">
                    <g id="Group-5" transform="translate(605.000000, 3209.000000)">
                        <path d="M40.0000414,39.611837 C38.7255381,39.611837 37.6923491,38.5794422 37.6923491,37.3059185 C37.6923491,36.0323949 38.7255381,35 40.0000414,35 C41.2745447,35 42.3077337,36.0323949 42.3077337,37.3059185 C42.3077337,38.5794422 41.2745447,39.611837 40.0000414,39.611837 Z M40.0000414,41.1491161 L40.0000414,41.1491161 C41.3827801,41.1894737 42.7368601,41.5527411 43.9538876,42.2098386 C44.5960871,42.5406068 44.9997381,43.201967 45.0000414,43.9239047 L45.0000414,44.2774789 C45.002096,44.4683931 44.9276333,44.652195 44.7932493,44.7879195 C44.6588653,44.9236441 44.4757289,45.000011 44.2846568,45 L35.715426,45 C35.5243539,45.000011 35.3412175,44.9236441 35.2068335,44.7879195 C35.0724496,44.652195 34.9979869,44.4683931 35.0000414,44.2774789 L35.0000414,43.9239047 C34.9974587,43.1992041 35.4015316,42.5341838 36.0461953,42.2021522 C37.2638822,41.5477308 38.6179262,41.1871054 40.0000414,41.1491161 Z"
                              id="User-icon"></path>
                    </g>
                </g>
            </g>
        </svg>
        Contact Person
    </label>
    <hr class="tab-hr">

    <div class="tab-panels">
        <section></section>
        <section></section>
        <section id="Links" class="tab-panel">
            <div class="row" style="margin-bottom: 10px;">
                <div class="col-md-6">
                    <label>Link</label>
                    <input type="text" class="form-control input-text-modal" name="link_url"
                           id="link-url" placeholder="http://" value="{{ old('link_url', $client->link_url ?? '') }}">
                </div>
                <div class="col-md-6">
                    <label>Title</label>
                    <input type="text" class="form-control input-text-modal" name="link_title"
                           id="link-title" placeholder="Link Title" value="{{ old('link_title', $client->link_title ?? '') }}">
                </div>
            </div>
        </section>

        <section id="Contact_person" class="tab-panel">
            <div class="form-group">
                <label>Contact</label>
                <div class="col-md-12">
                    <label for="contact_name">Name</label>
                    <input type="text" class="form-control input-text-modal" name="contact_name"
                           id="contact_name" placeholder="Name" value="{{ old('contact_name', $client->contactname ?? '') }}">
                </div>

                <div class="row" style="margin-bottom: 10px;">
                    <div class="col-md-6">
                        <input type="text" class="form-control input-text-modal"
                               name="contact_phonenumber" id="contact_phonenumber"
                               placeholder="Phone Number" value="{{ old('contact_phonenumber', $client->contactnumber ?? '') }}">
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control input-text-modal"
                               name="contact_email" id="contact_email" placeholder="Email" value="{{ old('contact_email', $client->contactemail ?? '') }}">
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
</div>