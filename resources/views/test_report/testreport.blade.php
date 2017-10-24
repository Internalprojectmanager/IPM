extends('layout.app')

@section('title')
    Test Reports
@endsection

@section('content')

    <table class="table table-striped table-hover">
        @foreach($testreports as $testreport)
            <tbody>
            <tr>
                <td>
                    <div class="row">
                        <div class="col-md-6">
                            {{$testreport->title}}
                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-success" href="#"><span class="glyphicon glyphicon-search"></span></a>
                            <a class="btn btn-warning" href="#"><span class="glyphicon glyphicon-edit"></span></a>
                            <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')" href="#"><span class="glyphicon glyphicon-trash"></span></a>
                        </div>
                    </div>
                </td>
            </tr>
            </tbody>
        @endforeach
    </table>

@endsection