<div class="modal modal-lg" id="editFeatureModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
     aria-hidden="true">
    <div class="modal-content">
        <div class="modal-header">
            <label>Edit Feature</label>
            <span class="modal-close" data-dismiss="modal">
                    <svg width="10px" height="10px" viewBox="0 0 10 10" version="1.1" xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink">
                        <!-- Generator: Sketch 47.1 (45422) - http://www.bohemiancoding.com/sketch -->
                        <title>Tabs cross icon</title>
                        <desc>Created with Sketch.</desc>
                        <defs></defs>
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="Style-Guide" transform="translate(-205.000000, -3353.000000)" fill-rule="nonzero"
                               fill="#ffffff">
                                <g id="Group-3" transform="translate(170.000000, 3318.000000)">
                                    <path
                                        d="M40.8839201,39.9999609 L44.8169503,36.0668052 C45.0610166,35.8227408 45.0610166,35.4269565 44.8169503,35.1830483 C44.572884,34.9389839 44.1772528,34.9389839 43.9331865,35.1830483 L40,39.1160478 L36.0669698,35.1830483 C35.8229035,34.9389839 35.427116,34.9389839 35.1830497,35.1830483 C34.9389834,35.4271127 34.9389834,35.8228971 35.1830497,36.0668052 L39.1162362,39.9999609 L35.1830497,43.9331167 C34.9389834,44.1771811 34.9389834,44.5729654 35.1830497,44.8168736 C35.3050829,44.9389058 35.4650854,45 35.6249316,45 C35.7847779,45 35.9449366,44.9389058 36.0669698,44.8168736 L40,40.8838741 L43.9331865,44.8168736 C44.0552196,44.9389058 44.2152221,45 44.3750684,45 C44.5349146,45 44.6950734,44.9389058 44.8169503,44.8168736 C45.0610166,44.5728092 45.0610166,44.1770248 44.8169503,43.9331167 L40.8839201,39.9999609 Z"
                                        id="Tabs-cross-icon"></path>
                                </g>
                            </g>
                        </g>
                    </svg>
                </span>
        </div>
        <div class="modal-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <a class="btn-edit delete-button" id="modal-delete"
                   href="{{route('deletefeature', [$client->path, $project->path, $release->path,$feature->id])}}"
                   onclick="return confirm('Are you sure you want to delete this Client?');">
                    <i class="far fa-times-circle white"></i>
                    <span class="white">Delete</span></a>
            <form
                action="{{route('updateFeature', [$client->path, $project->path, $release->path,$feature->id])}}"
                method="post">
                {{ csrf_field() }}
                <input type="hidden" name="type" value="{{$feature->type}}">
                <div class="form-group">
                    <div class="form-group">
                        <label for="featurename">Feature name: <span class="required">*</span></label>
                        <input type="text" class="form-control input-text-modal" required name="feature_name" id="feature_name"
                               value="{{$feature->name}}">

                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea rows="4" cols="50" name="feature_description" class="form-control input-text-modal"
                                  id="description">{{$feature->description}}</textarea>

                    </div>

                    <div class="form-group">
                        <label for="description">Status: <span class="required">*</span></label>
                        <select name="feature_status" required class="form-control input-text-modal">
                            @foreach($status as $s)
                                <option value="{{$s->id}}"
                                        @if($s->id == $feature->status) selected="" @endif>{{$s->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div id="featurereq" class="tabset" role="tablist">
                    <!-- Tab 1 -->

                    @php $i = 1; @endphp
                    @if($feature->requirements->count() == 0)
                        <input type="radio" class="fr-tabs tab" name="fr-tabsetreq" id="fr-tab{{$i}}"
                               aria-controls="fr-req{{$i}}" @if($i == 1) @endif>
                        <label id="fr-tablabel{{$i}}" class="non-cursive" for="fr-tab{{$i}}">Feature Requirement 1
                            <button class="remove_feature" id="{{$i}}" type="button">×</button>
                        </label>
                    @endif

                    @foreach($feature->requirements as $r)
                        <input type="radio" class="fr-tabs tab" name="fr-tabsetreq" id="fr-tab{{$i}}"
                               aria-controls="fr-req{{$i}}" @if($i == 1) @endif>
                        <label id="fr-tablabel{{$i}}" class="non-cursive" for="fr-tab{{$i}}">{{$r->name}}
                            <button class="remove_feature" id="{{$i}}" type="button">×</button>
                        </label>
                        @php $i++; @endphp
                    @endforeach
                    <i id="more-fr"></i>
                    <!-- Tab 2 -->
                    <input type="radio" class="btn-primary tab" name="fr-tabsetreq" id="fr-newreq">
                    <label for="fr-newreq" class="black new-tab">
                        Add more Requirements <span class="icon-right glyphicon glyphicon-plus"></span>
                    </label>
                    <span class="hidden" id="fr-removed">0</span>
                    <hr class="tab-hr">

                    <div class="tab-panels">
                        <div class="hidden" id="fr-feature-full">
                            <div class="alert alert-danger">
                                No more requirements can be added (Max of 10 reached)
                            </div>
                        </div>
                        <select class="form-control input-text-modal hidden" name="assignee[1][]" multiple>
                            @foreach($user as $u)
                                <option
                                    value="{{$u->users->id}}">{{$u->users->first_name}} {{$u->users->last_name}} @if(isset($u->users->jobtitles))
                                        (<i>{{$u->users->jobtitles->name}}</i>)@endif</option>
                            @endforeach
                        </select>

                        @php $i = 1; @endphp
                        @if($feature->requirements->count() == 0)
                            <section id="fr-req{{$i}}" class="tab-panel">
                                <input type="hidden" name="requirement_uuid[{{$i}}]">
                                <div class="row" style="margin-bottom: 10px;">
                                    <div class="col-md-12">
                                        <label>Requirement Name</label>
                                        <input type="text" class="form-control input-text-modal requirement_name"
                                               name="requirement_name[{{$i}}]"
                                               id="" placeholder="" value="">
                                    </div>
                                    <div class="col-md-12">
                                        <label>Description:</label>
                                        <textarea rows="4" cols="50" name="requirement_description[{{$i}}]"
                                                  class="form-control input-text-modal" id="description"></textarea>

                                    </div>
                                    <div class="col-md-12 assignee">
                                        <label>Assingees:</label>
                                        <select class="form-control input-text-modal selectpicker"
                                                name="assignee[{{$i}}][]"
                                                multiple>
                                            @foreach($user as $u)
                                                <option
                                                    value="{{$u->users->id}}">{{$u->users->first_name}} {{$u->users->last_name}} @if(isset($u->users->jobtitles))
                                                        (<i>{{$u->users->jobtitles->name}}</i>) @endif</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </section>
                        @endif
                        @foreach($feature->requirements as $r)
                            <section id="fr-req{{$i}}" class="tab-panel {{$i}}">
                                <input type="hidden" name="requirement_uuid[{{$i}}]" value="{{$r->requirement_uuid}}">
                                <div class="row" style="margin-bottom: 10px;">
                                    <div class="col-md-12">
                                        <label>Requirement Name</label>
                                        <input type="text" class="form-control input-text-modal requirement_name"
                                               name="requirement_name[{{$i}}]"
                                               id="" placeholder="" value="{{$r->name}}">
                                    </div>
                                    <div class="col-md-12">
                                        <label>Description:</label>
                                        <textarea rows="4" cols="50" name="requirement_description[{{$i}}]"
                                                  class="form-control input-text-modal"
                                                  id="description">{{$r->description}}</textarea>

                                    </div>
                                    <div class="col-md-12 assignee">
                                        <label>Assingees:</label>
                                        <select class="form-control input-text-modal selectpicker"
                                                name="assignee[{{$i}}][]"
                                                multiple>
                                            @foreach($user as $u)
                                                <option value="{{$u->users->id}}"
                                                        @foreach($r->assignees as $as)
                                                        @if($u->userid  == $as->userid)
                                                        selected
                                                    @endif
                                                    @endforeach
                                                >{{$u->users->first_name}} {{$u->users->last_name}} @if(isset($u->users->jobtitles))
                                                        (<i>{{$u->users->jobtitles->name}}</i>) @endif</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </section>
                            @php $i++; @endphp
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer row" style="border:none;">
                    <div class="col-md-6" align="left">
                        <button type="button" class="btn-cancel" data-dismiss="modal">Close</button>
                    </div>
                    <div class="col-md-6" align="right">
                        <button class="btn btn-primary" type="submit">
                            Save Feature <span class="icon-right glyphicon glyphicon-plus">
                        </button>
                    </div>
            </form>
        </div>
    </div>
</div>
</div>
