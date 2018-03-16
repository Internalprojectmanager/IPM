<div class="modal modal-lg" id="addReleaseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
     aria-hidden="true">
    <div class="modal-content">
        <div class="modal-header">
            <label>New Release</label>
            <span class="modal-close"  data-dismiss="modal">
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
        <form action="{{route('storerelease', ['name' => $projects->path, 'company_id' => $client->path] )}}" method="post">
            {{ csrf_field() }}
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
                <div class="form-group">
                    <input type="hidden" id="project" name="project_id" value="{{$projects->id}}">
                    <input type="hidden" id="company_id" name="company_id" value="{{$client->id}}">
                    <div class="form-group">
                        <label for="release_name">Release name: <span class="required">*</span></label>
                        <input type="text" class="form-control input-text-modal" required name="release_name" id="release_name" {{old('release_name')}}>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea rows="4" cols="50" name="description" class="form-control input-text-modal" id="description" {{old('description')}}></textarea>

                    </div>
                    <div class="form-group">
                        <label for="status">Release Status: <span class="required">*</span></label>
                        <select class="form-control" required name="status">
                            @foreach($status as $s)
                                <option value="{{$s->id}}">{{$s->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="document_status">Document Status: <span class="required">*</span></label>
                        <select class="form-control" required name="document_status">
                            @foreach($status as $s)
                                <option value="{{$s->id}}">{{$s->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="deadline">Release Deadline: <span class="required">*</span></label>
                        <input type="text" required class="form-control datepicker" autocomplete="off" id="deadline" name="deadline" placeholder="YYYY/MM/DD">

                    </div>
                    <div class="form-group">
                        <label for="specification">Specification type: <span class="required">*</span></label>
                        <input type="text" required class="form-control input-text-modal" id="specification" name="specification" value="{{old('specification')}}">
                    </div>

                </div>
        </div>
        <div class="modal-footer row" style="border:none;">
            <div class="col-md-6" align="left">
                <button type="button" class="btn-cancel" data-dismiss="modal">Close</button>
            </div>
            <div class="col-md-6" align="right">
                <button class="btn btn-primary" type="submit">
                    Save Release <span class="glyphicon glyphicon-plus"></span>
                </button>
            </div>

        </div>
        </form>
    </div>
</div>