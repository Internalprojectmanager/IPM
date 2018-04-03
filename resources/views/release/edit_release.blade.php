@extends('layout.app')

@section('title')
    {{$project->name}} -  {{$release->name}} {{number_format($release->version, 1)}} | {{env('APP_NAME')}}
@endsection

@section('breadcrumbs', Breadcrumbs::render('editrelease', $project, $release))

@section('content')

    <button onclick="location.href='{{route('deleterelease', [$client->path, $project->path, $release->path, $release->version])}}'"
            class="btn-edit delete-button" id="project-edit">
        <svg id="delete-logo" width="19px" height="19px" viewBox="0 0 19 19" version="1.1" xmlns="http://www.w3.org/2000/svg"
             xmlns:xlink="http://www.w3.org/1999/xlink">
            <!-- Generator: Sketch 48.1 (47250) - http://www.bohemiancoding.com/sketch -->
            <title>Delete button icon</title>
            <desc>Created with Sketch.</desc>
            <defs></defs>
            <g id="Style-Guide" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
               transform="translate(-200.000000, -3239.000000)">
                <g id="Group-12" transform="translate(170.000000, 3209.000000)" fill="#FFFFFF" fill-rule="nonzero">
                    <path d="M39.5,30 C34.2567308,30 30,34.2567308 30,39.5 C30,44.7432692 34.2567308,49 39.5,49 C44.7432692,49 49,44.7432692 49,39.5 C49,34.2567308 44.7432692,30 39.5,30 Z M39.5,48.2692308 C34.6586538,48.2692308 30.7307692,44.3413462 30.7307692,39.5 C30.7307692,34.6586538 34.6586538,30.7307692 39.5,30.7307692 C44.3413462,30.7307692 48.2692308,34.6586538 48.2692308,39.5 C48.2692308,44.3413462 44.3413462,48.2692308 39.5,48.2692308 Z M43.3730769,35.7913462 C43.7932692,36.2115385 43.7932692,36.9057692 43.3730769,37.3442308 L41.1076923,39.6096154 L43.4278846,41.9298077 C43.8480769,42.35 43.8480769,43.0442308 43.4278846,43.4826923 C43.0076923,43.9028846 42.3134615,43.9028846 41.875,43.4826923 L39.5548077,41.1625 L37.1798077,43.5557692 C36.7596154,43.9759615 36.0653846,43.9759615 35.6269231,43.5557692 C35.1884615,43.1355769 35.2067308,42.4413462 35.6269231,42.0028846 L38.0201923,39.6096154 L35.6817308,37.2894231 C35.2615385,36.8692308 35.2615385,36.175 35.6817308,35.7365385 C36.1019231,35.2980769 36.7961538,35.3163462 37.2346154,35.7365385 L39.5548077,38.0567308 L41.8201923,35.7913462 C42.2586538,35.3711538 42.9528846,35.3711538 43.3730769,35.7913462 Z M43.6288462,35.5355769 C43.0625,34.9692308 42.1307692,34.9692308 41.5644231,35.5355769 L39.5548077,37.5451923 L37.4903846,35.4807692 C36.9240385,34.9144231 35.9923077,34.9144231 35.4259615,35.4807692 C34.8596154,36.0471154 34.8596154,36.9788462 35.4259615,37.5451923 L37.4903846,39.6096154 L35.3711538,41.7471154 C34.8048077,42.3134615 34.8048077,43.2451923 35.3711538,43.8115385 C35.9375,44.3778846 36.8692308,44.3778846 37.4355769,43.8115385 L39.5548077,41.6923077 L41.6192308,43.7567308 C42.1855769,44.3230769 43.1173077,44.3230769 43.6836538,43.7567308 C44.25,43.1903846 44.25,42.2586538 43.6836538,41.6923077 L41.6192308,39.6096154 L43.6288462,37.6 C44.1951923,37.0336538 44.1951923,36.1019231 43.6288462,35.5355769 Z"
                          id="Delete-button-icon"></path>
                </g>
            </g>
        </svg>
        <span class="delete-content" id="delete-content">Delete</span>
    </button>

    <div class="row">
        <div class="header-3" id="edit-project">
            <form action="{{route('updaterelease', [$client->path, $project->path, $release->path, $release->version])}}"
                  method="post">
                {{ csrf_field() }}
                <div class="form-group col-md-6">
                    <label class="edit-title" for="release_name">Release name</label>
                    <input type="text" class="form-control" name="release_name" id="release_name"
                           value="{{$release->name}}">

                    <br>

                    <label class="edit-title" for="release_description">Description</label>
                    <textarea rows="4" cols="50" name="description" class="form-control"
                              id="release_description">{{$release->description}}</textarea>

                    <br>

                    <label class="edit-title" for="project_code">Version</label>
                    <input type="text" class="form-control" name="version" id="release_version"
                           value="{{$release->version}}">

                    <a href=""
                       class="cancel">
                        <svg width="11px" height="11px" viewBox="0 0 11 11" version="1.1"
                             xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <!-- Generator: Sketch 47.1 (45422) - http://www.bohemiancoding.com/sketch -->
                            <title>Cancel icon</title>
                            <desc>Created with Sketch.</desc>
                            <defs></defs>
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="Style-Guide" transform="translate(-423.000000, -3243.000000)" fill-rule="nonzero"
                                   fill="#D35847">
                                    <g id="Group-20" transform="translate(388.000000, 3209.000000)">
                                        <path d="M45.5795598,34.4207545 C45.0185538,33.8597485 44.1080864,33.8597485 43.5474396,34.4207545 L40.4999775,37.4678573 L37.4528747,34.4211136 C36.8918687,33.8601077 35.9817604,33.8601077 35.4207545,34.4211136 C34.8597485,34.9821196 34.8597485,35.8922279 35.4207545,36.4525155 L38.4682165,39.4996184 L35.4207545,42.5467212 C34.8597485,43.1077272 34.8597485,44.0178355 35.4207545,44.5781231 C35.9817604,45.1391291 36.8918687,45.1391291 37.4528747,44.5781231 L40.4999775,41.5313794 L43.5470804,44.5781231 C44.1080864,45.1391291 45.0181946,45.1391291 45.5792006,44.5781231 C46.1402066,44.0171172 46.1402066,43.1066497 45.5792006,42.5467212 L42.5317386,39.4996184 L45.5792006,36.4525155 C46.1402066,35.8911504 46.1402066,34.9814013 45.5795598,34.4207545 Z"
                                              id="Cancel-icon"></path>
                                    </g>
                                </g>
                            </g>
                        </svg>
                        Cancel
                    </a>
                </div>
                <div class="form-group col-md-6">
                    <label class="edit-title" for="client">Release Status</label>
                    <br>
                    <select class="form-control input-text-modal" name="status" id="client">
                        @foreach($status as $s)
                            <option @if($s->id == $release->status) selected="" @endif value="{{$s->id}}">{{$s->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Deadline:</label>
                    <input type='text' class="form-control input-text-modal datepicker" autocomplete="off" placeholder="YYYY/MM/DD" name="deadline" value="@php echo  date("Y/m/d", strtotime($release->deadline)); @endphp"/>
                </div>

                <div class="form-group col-md-6">
                    <label for="release_document_status">Document Status:</label>
                    <select class="form-control input-text-modal" name="document_status">
                        @foreach($status as $s)
                            <option @if($s->id == $release->document_status) selected="" @endif value="{{$s->id}}">{{$s->name}}</option>
                        @endforeach
                    </select>

                    </div>

                <div class="form-group col-md-6">
                    <label for="release_specification">Specification type:</label>
                    <input type="text" class="form-control input-text-modal" name="specification" id=""
                           value="{{$release->specificationtype}}">
                </div>


                <div class="form-group col-md-6">
                    <button class="save-button" id="save-button" type="submit">
                        <svg id="save-logo" width="19px" height="19px" viewBox="0 0 19 19" version="1.1"
                             xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <!-- Generator: Sketch 48.1 (47250) - http://www.bohemiancoding.com/sketch -->
                            <title>Save icon</title>
                            <desc>Created with Sketch.</desc>
                            <defs></defs>
                            <g id="Style-Guide" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                               transform="translate(-1071.000000, -3131.000000)">
                                <g id="Group-29" transform="translate(1040.000000, 3100.000000)">
                                    <g id="Save-icon" transform="translate(31.000000, 31.000000)">
                                        <path d="M1,0 L1,18 L18,18 L18,0 L19,0 L19,19 L0,19 L0,0 L1,0 Z"
                                              id="Combined-Shape" fill="#FFFFFF"></path>
                                        <rect id="Rectangle-9" fill="#FFFFFF" x="10" y="0" width="9" height="1"></rect>
                                        <rect id="Rectangle-9" fill="#FFFFFF"
                                              transform="translate(9.500000, 4.500000) rotate(-90.000000) translate(-9.500000, -4.500000) "
                                              x="5" y="4" width="9" height="1"></rect>
                                        <path d="M9.5,9.5 L5.96446609,5.96446609" id="Line-2" stroke="#FFFFFF"
                                              stroke-linecap="square"></path>
                                        <path d="M13.5,9.5 L9.96446609,5.96446609" id="Line-2-Copy" stroke="#FFFFFF"
                                              stroke-linecap="square"
                                              transform="translate(11.500000, 7.500000) scale(-1, 1) translate(-11.500000, -7.500000) "></path>
                                    </g>
                                </g>
                            </g>
                        </svg>
                        <span class="button-content" id="button-save">Save</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection