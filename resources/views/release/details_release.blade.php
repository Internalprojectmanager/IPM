@extends('layout.app')

@section('title')
    {{$project->name}} - {{$release->version}} {{$release->name}}
@endsection

@section('breadcrumbs', Breadcrumbs::render('showrelease', $project, $company, $release))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>{{$company->name}} {{$project->name}}: {{$release->name}}</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <b>Version:</b> {{$release->version}}<br>
                <b>Author:</b> {{$release->author}}<br>
                <a href="{{ route('testrapport', ['name' => $projects->name, 'company_id' => $projects->company_id, 'release_name' => $release->release_name])  }}">Testrapports</a>
                <b>Description:</b><br> {{$release->description}}<br>
            </div>
        </div>
        <div class="feature">
            <h2>Features</h2>
            <?php $i = 1; ?>
            @foreach($features as $f)

                <div class="row" id="{{$f->id}}">
                    <div class="col-md-12">
                        <h3>Feature {{$i}}: {{$f->name}}</h3>
                        <b>Status:</b>
                        <p>{{$f->status}}</p>
                        <b>Description:</b>
                        <p>{{$f->description}}</p>
                    </div>
                    <?php $i++;?>
                    @foreach($requirements as $r)

                    @endforeach
                </div>
            @endforeach


        </div>


        <button class="btn btn-primary" onclick="document.getElementById('addFeature').style.display='block'">
            <span class="glyphicon glyphicon-plus"></span> Add Feature
        </button>
        <br><br>

        <!-- ADD COMPANY -->
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
                        <textarea rows="4" cols="50" name="description[]" class="form-control" id="description"></textarea>
                        <br><br>
                        <label for="description">Status:</label>
                        <select name="status[]" class="form-control" id="status">
                            <option value="open">Open</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Testing">Testing</option>
                            <option value="Done">Done</option>
                        </select>
                    </div>
                </div>

                <span id="newfeaturebtn" class="btn btn-success" onclick="newFeature()">
                    <span class="glyphicon glyphicon-plus"></span> Add another Feature
                </span>

                <button class="btn btn-primary" type="submit">Submit</button>
            </form>
        </div>
        </div>



    <script>
        var i = 2;

        function newFeature(){

            var div = document.createElement('div');
            var featurename = "newfeature"+i;
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
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
@endsection