@extends('layout.app')

@section('title')
    {{$project->name}} - {{$release->version}} {{$release->name}}
@endsection

@section('breadcrumbs', Breadcrumbs::render('showrelease', $project, $company, $release))

@section('content')
    <div class="row">

        <div class="row">
            <div class="col-md-12">
                <h1>{{$company->name}} {{$project->name}}: {{$release->name}}</h1>
                <b>Version:</b> {{$release->version}}<br>
                <b>Author:</b> {{$release->author}}<br>
                <b>Description:</b><br> {{$release->description}}<br>
            </div>
        </div>
        <div class="feature row">
            <div class="col-md-12">
                <h2>Features</h2>
                @foreach($features as $f)
                    <div class="row">
                        <div class="col-md-12 col-xs-12 col-lg-12 feature-block" id="{{$f->id}}">
                            <span class="header-3">{{$f->name}} </span>
                            <?php $t = 0; $c = 0;?>
                            @foreach($requirements as $r)
                                @if($f->feature_uuid == $r->feature_uuid)
                                    @if($r->status == "Closed")
                                        <?php $c++;?>
                                    @endif
                                    <?php $t++;?>
                                @endif
                            @endforeach
                            <span class="header-3">
                                @if($c == 0 && $t == 0) @elseif($t !== 0) ({{$c}}/{{$t}}) @endif</span>
                            <button onclick="location.href='{{route('editFeature', ['name' => $project->name, 'company_id' => $project->company_id,
                                 'release_name' => $release->name, 'feature_id' => $f->id])}}'"
                                    class="status status_edit"><span
                                        class="glyphicon glyphicon-edit"></span> Edit
                            </button>
                            <br>
                            @if($f->description)
                                {{$f->description}}
                            @endif


                            <div class="requirement-block">
                                <?php $i = 0;?>
                                @foreach($requirements as $r)
                                    @if($f->feature_uuid == $r->feature_uuid)

                                        <div class="row requirement-row">
                                            <div class="col-md-4">
                                                Requirement:<br>
                                                {{$r->name}}
                                            </div>

                                            <div class="col-md-4">
                                                Requirement Defenition:<br>
                                                {{$r->description}}
                                            </div>
                                        </div>
                                        <?php $i++;?>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
            <div class="feature-block row">
                <button class="btn btn-primary" onclick="document.getElementById('addFeature').style.display='block'">
                    <span class="glyphicon glyphicon-plus"></span> Add Feature
                </button>
            </div>
        </div>
    </div>


    </div>

    <!-- ADD Feature -->
    <div id="addFeature" class="modal">
            <span onclick="document.getElementById('addFeature').style.display='none'" class="close"
                  title="Close Modal">&times;</span>

        <form action="{{route('storefeature', ['name' => $project->name, 'company_id' => $project->company_id, 'release_name' => $release->name])}}"
              method="post" class="modal-content animate">
            {{ csrf_field() }}
            <div id="feature">
                <h3>New Feature 1</h3>
                <div id="newfeature" class="form-group">
                    <input type="hidden" name="release_id[]" value="{{$release->id}}">
                    <input type="hidden" name="feature_id[]" value="{{$release->project_id}}F">

                    <label for="featurename">Feature name:</label>
                    <input type="text" class="form-control" name="feature_name[]" id="feature_name">
                    <br><br>
                    <label for="description">Description:</label>
                    <textarea rows="4" cols="50" name="description[]" class="form-control"
                              id="description"></textarea>
                    <br><br>
                </div>
            </div>

            <span id="newfeaturebtn" class="btn btn-success" onclick="newFeature()">
                    <span class="glyphicon glyphicon-plus"></span> Add another Feature
                </span>

            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    </div>



    <script>
        var i = 2;

        function newFeature() {

            var div = document.createElement('div');
            var featurename = "newfeature" + i;
            div.setAttribute('id', featurename);
            var title = "<h3>New feature " + i + "</h3>";
            div.innerHTML += title
            div.innerHTML += document.getElementById("newfeature").innerHTML;
            var feature = document.getElementById("feature");
            feature.appendChild(div);
            console.log(featurename);
            i++;

        }

        // Get the modal
        var modal = document.getElementById('addFeature');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
@endsection