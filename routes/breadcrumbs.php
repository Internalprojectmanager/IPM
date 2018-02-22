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
    $breadcrumbs->push($clients->name, route('clientdetails', $clients->path));
});

Breadcrumbs::register('editclient', function ($breadcrumbs, $clients) {
    $breadcrumbs->parent('client');
    $breadcrumbs->push($clients->name, route('clientdetails', $clients->path));
    $breadcrumbs->push('Edit', route('editclient', $clients->name));
});

//Projects

Breadcrumbs::register('projects', function ($breadcrumbs) {
    $breadcrumbs->push('Project Overview', route('overviewproject'));
});

Breadcrumbs::register('singleproject', function ($breadcrumbs, $projects) {
    $breadcrumbs->parent('projects');
    $breadcrumbs->push($projects->name, route('projectdetails', ['name'=> $projects->path, 'client_id' => $projects->company->path]));
});

Breadcrumbs::register('editproject', function ($breadcrumbs, $projects) {
    $breadcrumbs->parent('projects');
    $breadcrumbs->push($projects->name, route('projectdetails', ['name'=> $projects->path, 'client_id' => $projects->company->path]));
    $breadcrumbs->push('Edit', route('editproject', ['name'=> $projects->path, 'client_id' => $projects->company->path]));
});

Breadcrumbs::register('addproject', function ($breadcrumbs) {
    $breadcrumbs->parent('projects');
    $breadcrumbs->push('New project', route('addproject'));
});

//Release
Breadcrumbs::register('addrelease', function ($breadcrumbs, $projects) {
    $breadcrumbs->parent('projects');
    $breadcrumbs->push($projects->name, route('projectdetails', ['name'=> $projects->path, 'client_id' => $projects->company->path]));
    $breadcrumbs->push('New Release', route('addrelease', ['name'=> $projects->path, 'client_id' => $projects->company->path]));
});

Breadcrumbs::register('showrelease', function ($breadcrumbs, $projects, $release) {
    $breadcrumbs->parent('projects');
    $breadcrumbs->push($projects->name, route('projectdetails', ['name'=> $projects->path, 'client_id' => $projects->company->path]));
    $breadcrumbs->push(number_format($release->version, 1)." ".$release->name, route('showrelease', ['name'=> $projects->path, 'client_id' => $projects->company->path,
        'version' => $release->version, 'release_name' => $release->path]));
});


//Documents
Breadcrumbs::register('documents', function ($breadcrumbs, $project) {
    $breadcrumbs->parent('projects');
    $breadcrumbs->push($project->name, route('projectdetails', ['name'=> $project->path, 'client_id' => $project->company->path]));
    $breadcrumbs->push('Document overview', route('documentoverview', ['name'=> $project->path, 'client_id' => $project->company->path]));
});

Breadcrumbs::register('detailsdocument', function ($breadcrumbs, $document) {
    $breadcrumbs->parent('projects');
    $breadcrumbs->push($document->projects->name, route('projectdetails', ['name'=> $document->projects->path, 'client_id' => $document->projects->company->path]));
    $breadcrumbs->push('Document overview', route('documentoverview', ['name'=> $document->projects->path, 'client_id' => $document->projects->company->path]));
    $breadcrumbs->push($document->title, route('showdocument', ['name'=> $document->projects->path, 'client_id' => $document->projects->company->path, $document->id]));
});

//Feature
Breadcrumbs::register('detailsfeature', function ($breadcrumbs, $feature) {
    $breadcrumbs->parent('projects');
    $breadcrumbs->push($feature->releases->projects->name, route('projectdetails', ['name'=> $feature->releases->projects->path, 'client_id' => $feature->releases->projects->company->path]));
    $breadcrumbs->push(number_format($feature->releases->version, 1)." ".$feature->releases->path, route('showrelease', ['name'=> $feature->releases->projects->path, 'client_id' => $feature->releases->projects->company->path,
        'version' => $feature->releases->version, 'release_name' => $feature->releases->path]));
    $breadcrumbs->push($feature->name. " (".$feature->type.")", route('showfeature', ['name'=> $feature->releases->projects->path, 'client_id' => $feature->releases->projects->company->path,
        'version' => $feature->releases->version, 'release_name' => $feature->releases->pathgit, 'feature_id' => $feature->id]));
});

