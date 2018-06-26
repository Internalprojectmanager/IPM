@extends('layout.app')

@section('content')
    <div class="row block-white">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <span class="block-white-title">IPM Terms of Use</span>
                <span id="count_projects_bar">|</span>
                <span>25 June 2018 - {{Auth::user()->email}}</span>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                    By accepting this Terms of Use you agree to the following.
            </div>
        </div>

    </div>

    <div class="row block-white">
        <div class="row">
            <div class="col-md-12">
                <span class="block-white-title">1.  Ownership</span>
                <p>
                    Ownership, copyright and title of any software that is developed by IPM shall at all times remain with IPM.
                    You shall not acquire directly, indirectly or by implication any title, copyright or ownership in the software or any parts thereof.
                    We do not claim any ownership rights to the information that you submit to the IPM Hosted application itself, your data is yours. This includes all projects and releases.
                </p>
            </div>
        </div>

        <div class="row margin-top-50">
            <div class="col-md-12">
                <span class="block-white-title">2.  Your Account</span>
                <p>If you create an account on the Website, you are responsible for maintaining the security of your account,
                    and you are fully responsible for all activities that occur under the account and any other actions taken in connection with the account.
                    You must immediately notify IPM of any unauthorized use of your account or any other breaches of security.
                    IPM will not be liable for any acts or omissions by You, including any damages of any kind incurred as a result of such acts or omissions.</p>

                <p>
                    We only store the following personal data in IPM:
                <ul>
                    <li>First name</li>
                    <li>Last name</li>
                    <li>Email</li>
                </ul>
                </p>
            </div>
        </div>

        <div class="row margin-top-50">
            <div class="col-md-12">
                <span class="block-white-title">3. Acceptable Use of Your Account and the Website</span>
                <p>
                    By accepting this Agreement, you agree not to use, encourage, promote, or facilitate others to use,
                    the Website or your account in a way that is harmful to others ("Acceptable Use").
                    Examples of harmful use include, but are not limited to, engaging in illegal or fraudulent activities,
                    infringing upon others' intellectual property rights, distributing harmful or offensive content that is
                    defamatory, obscene, abusive, an invasion of privacy, or harrassing, violating the security or integrity of any computer,
                    network or communications system, and taxing resources with activities such as cryptocurrency mining.</p>
            </div>
        </div>

        <div class="row margin-top-50">
            <div class="col-md-12">
                <span class="block-white-title">4. Termination</span>
                <p>
                    IPM may terminate your access to all or any part of the Website at any time,
                    with or without cause, with or without notice, effective immediately.
                    If you wish to terminate this Agreement or your IPM account, you may simply discontinue using the Website.
                    All provisions of this Agreement which by their nature should survive termination shall survive termination,
                    including, without limitation, ownership provisions, warranty disclaimers, indemnity and limitations of liability.
                </p>
            </div>
        </div>



        <div class="row margin-top-50">
            <div class="col-md-12">
                <span class="block-white-title">5. Changes to Terms of Use</span>
                <p>
                    IPM reserves the right, at its sole discretion,
                    to modify or replace any part of this Agreement.
                    It is your responsibility to check this Agreement periodically for changes.
                    Your continued use of or access to the Website following the posting of
                    any changes to this Agreement constitutes acceptance of those changes.
                    IPM may also, in the future, offer new services and/or features through the Website
                    (including, the release of new tools and resources).
                    Such new features and/or services shall be subject to the terms and conditions of this Agreement. 
                    IPM may also, in the future, remove features at any time without warning.</p>
            </div>
        </div>
    </div>
    @if(count(Auth::user()->teams()) > 1)
    <div class="row margin-top-50 bg-danger">
        <div class="col-md-12">
            If you decline this Terms of Use your account will be deleted from IPM.

            The following Teams will be removed:
            <ul>
                @foreach(Auth::user()->teams() as $team)
                    @if($team->name == Auth::user()->first_name.' '. Auth::user()->last_name)
                        <li>Your Personal Space</li>
                    @else
                        <li>{{$team->name}}</li>
                    @endif

                @endforeach
            </ul>

            <p>All projects with these team(s) will be removed as well</p>
        </div>


    </div>
    @endif
    <div class="row margin-top-50">
        <div class="col-md-3 col-xs-12 pull-right">
            <form class="" method="POST" action="{{route('termschoice')}}">
                <input type="hidden" value="declined">
                <input class="btn-danger btn" type="submit" name="submit" value="Decline" onclick="return confirm('Are you sure you want to decline this Terms of Use');">
                {{ csrf_field() }}
                <input class="btn-success btn" type="submit" name="submit" value="Accept">
            </form>
        </div>

    </div>


@endsection