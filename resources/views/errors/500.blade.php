@extends('layout.error_app')

@section('title')
    500 Something went wrong | {{env('APP_NAME')}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12 center">
                    <h1 class="supertitle">OOPS</h1>
                    <h3 class="undertitle">Something went wrong</h3>


                    @if(app()->bound('sentry') && !empty(Sentry::getLastEventID()))
                        <!-- Sentry JS SDK 2.1.+ required -->
                        <script src="https://cdn.ravenjs.com/3.3.0/raven.min.js"></script>

                        <script>
                            Raven.showReportDialog({
                                eventId: '{{ Sentry::getLastEventID() }}',
                                // use the public DSN (dont include your secret!)
                                dsn: '{{env('SENTRY_CLIENT')}}',
                                user: {
                                    @if(Auth::user())
                                    'name': '{{Auth::user()->first_name}} {{Auth::user()->last_name}}',
                                    'email': '{{Auth::user()->email}}',
                                    @else
                                    'name': '',
                                    'email': '',
                                    @endif
                                }
                            });
                        </script>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection