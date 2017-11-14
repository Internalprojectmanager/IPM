<?php

Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push('Home', route('home'));
});

//client

Breadcrumbs::register('client', function ($breadcrumbs) {
    $breadcrumbs->push('Client Overview', route('overviewclient'));
});
Breadcrumbs::register('addclient', function ($breadcrumbs) {
    $breadcrumbs->parent('client');
    $breadcrumbs->push('New Company', route('addclient'));
});


Breadcrumbs::register('singleclient', function ($breadcrumbs, $clients) {
    $breadcrumbs->parent('client');
    $breadcrumbs->push($clients->name, route('clientdetails', $clients->name));
});

Breadcrumbs::register('editclient', function ($breadcrumbs, $clients) {
    $breadcrumbs->parent('client');
    $breadcrumbs->push($clients->name, route('clientdetails', $clients->name));
    $breadcrumbs->push('Edit', route('editclient', $clients->name));
});

//Projects

Breadcrumbs::register('projects', function ($breadcrumbs) {
    $breadcrumbs->push('Project Overview', route('overviewproject'));
});

Breadcrumbs::register('singleproject', function ($breadcrumbs, $projects) {
    $breadcrumbs->parent('projects');
    $breadcrumbs->push($projects->name, route('projectdetails', ['name'=> $projects->name, 'client_id' => $projects->client_id]));
});

Breadcrumbs::register('editproject', function ($breadcrumbs, $projects) {
    $breadcrumbs->parent('projects');
    $breadcrumbs->push($projects->name, route('projectdetails', ['name'=> $projects->name, 'client_id' => $projects->client_id]));
    $breadcrumbs->push('Edit', route('editproject', ['name'=> $projects->name, 'client_id' => $projects->client_id]));
});

Breadcrumbs::register('addproject', function ($breadcrumbs) {
    $breadcrumbs->parent('projects');
    $breadcrumbs->push('New project', route('addproject'));
});


//Release
Breadcrumbs::register('addrelease', function ($breadcrumbs, $projects) {
    $breadcrumbs->parent('projects');
    $breadcrumbs->push($projects->name, route('projectdetails', ['name'=> $projects->name, 'client_id' => $projects->client_id]));
    $breadcrumbs->push('New Release', route('addrelease', ['name'=> $projects->name, 'client_id' => $projects->client_id]));
});

Breadcrumbs::register('showrelease', function ($breadcrumbs, $projects, $release) {
    $breadcrumbs->parent('projects');
    $breadcrumbs->push($projects->name, route('projectdetails', ['name'=> $projects->name, 'client_id' => $projects->client_id]));
    $breadcrumbs->push($release->name. " ".$release->version, route('showrelease', ['name'=> $projects->name, 'client_id' => $projects->client_id,
        'version' => $release->version, 'release_name' => $release->name]));
});