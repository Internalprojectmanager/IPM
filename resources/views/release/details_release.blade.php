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
                <hr>
                @foreach($testreports as $tr)
                    <div class="row">
                        <div class="col-md-6">
                            {{$tr->title}}
                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-success" href="#"><span class="glyphicon glyphicon-search"></span></a>
                            <a class="btn btn-warning" href="#"><span class="glyphicon glyphicon-edit"></span></a>
                            <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')" href="#"><span class="glyphicon glyphicon-trash"></span></a>
                        </div>
                    </div>
                @endforeach
                <a href="{{route('addtestreport', $release->id)}}">Add Test Reports</a><br>
                <hr>
            </div>
        </div>
        <div class="feature row">
            <div class="col-md-12">
                <h2>Features</h2>
                <?php $i = 1; $k = 0; $status = NULL; ?>
                @foreach($features as $f)
                    @if($status !== $f->status)
                        @if($i !== 1)
            </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <span class="header-3 header-status status status_<?php echo substr($f->status, 0, 2); ?>">{{$f->status}}</span>
                </div>

                @endif
                <div class="col-md-12 col-xs-12 col-lg-6 feature-block" id="{{$f->id}}">
                    <span class="header-3">{{$f->name}} </span>
                    <span class="header-3 status status_<?php echo substr($f->status, 0, 2); ?>">{{$f->status}}</span>
                    <br>
                    @if($f->description)
                        {{$f->description}}
                    @endif

                    <button onclick="location.href='{{route('editFeature', ['name' => $project->name, 'company_id' => $project->company_id,
                         'release_name' => $release->name, 'feature_id' => $f->id])}}'" class="status status_edit"><span
                                class="glyphicon glyphicon-edit"></span> Edit
                    </button>

                    @foreach($requirements as $r)

                    @endforeach
                </div>
                <?php $status = $f->status; ?><?php $i++;$k++;?>

                @endforeach
            </div>
        </div>

        <div class="row">
            <button class="btn btn-primary" onclick="document.getElementById('addFeature').style.display='block'">
                <span class="glyphicon glyphicon-plus"></span> Add Feature
            </button>
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