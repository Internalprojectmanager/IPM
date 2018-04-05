<div class="modal modal-lg" id="editFeatureModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
     aria-hidden="true">
    <div class="modal-content">
        <div class="modal-header">
            <label>Edit Out of Scope</label>
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
                                    <path d="M40.8839201,39.9999609 L44.8169503,36.0668052 C45.0610166,35.8227408 45.0610166,35.4269565 44.8169503,35.1830483 C44.572884,34.9389839 44.1772528,34.9389839 43.9331865,35.1830483 L40,39.1160478 L36.0669698,35.1830483 C35.8229035,34.9389839 35.427116,34.9389839 35.1830497,35.1830483 C34.9389834,35.4271127 34.9389834,35.8228971 35.1830497,36.0668052 L39.1162362,39.9999609 L35.1830497,43.9331167 C34.9389834,44.1771811 34.9389834,44.5729654 35.1830497,44.8168736 C35.3050829,44.9389058 35.4650854,45 35.6249316,45 C35.7847779,45 35.9449366,44.9389058 36.0669698,44.8168736 L40,40.8838741 L43.9331865,44.8168736 C44.0552196,44.9389058 44.2152221,45 44.3750684,45 C44.5349146,45 44.6950734,44.9389058 44.8169503,44.8168736 C45.0610166,44.5728092 45.0610166,44.1770248 44.8169503,43.9331167 L40.8839201,39.9999609 Z"
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
            <form action="{{route('updateFeature', [$client->path, $project->path, $release->path, $feature->id])}}"
                  method="post">
                {{ csrf_field() }}
                <input type="hidden" name="type" value="{{$feature->type}}">
                <div class="form-group">
                    <div class="form-group">
                        <label for="featurename">Out of Scope name: <span class="required">*</span></label>
                        <input type="text" class="form-control input-text-modal" required name="feature_name" id="feature_name" value="{{$feature->name}}">

                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea rows="4" cols="50" name="feature_description" class="form-control input-text-modal"
                                  id="description">{{$feature->description}}</textarea>

                    </div>
                </div>
                <div class="modal-footer row" style="border:none;">
                    <div class="col-md-6" align="left">
                        <button type="button" class="btn-cancel" data-dismiss="modal">Close</button>
                    </div>
                    <div class="col-md-6" align="right">
                        <button class="btn btn-primary" type="submit">
                            Save Out of Scope <span class="icon-right glyphicon glyphicon-plus">
                        </button>
                    </div>
            </form>
        </div>
    </div>
</div>
</div>
