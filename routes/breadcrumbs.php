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
    $breadcrumbs->parent('singleclient', $clients);
    $breadcrumbs->push('Edit', route('editclient', $clients->name));
});

//Projects

Breadcrumbs::register('projects', function ($breadcrumbs) {
    $breadcrumbs->push('Project Overview', route('overviewproject'));
});

Breadcrumbs::register('singleproject', function ($breadcrumbs, $projects) {
    $breadcrumbs->parent('projects');
    $breadcrumbs->push($projects->name, route('projectdetails', [$projects->company->path, $projects->path]));
});

Breadcrumbs::register('editproject', function ($breadcrumbs, $projects) {
    $breadcrumbs->parent('singleproject', $projects);
    $breadcrumbs->push('Edit', route('editproject', [$projects->company->path, $projects->path]));
});

Breadcrumbs::register('addproject', function ($breadcrumbs) {
    $breadcrumbs->parent('projects');
    $breadcrumbs->push('New project', route('addproject'));
});

//Release
Breadcrumbs::register('addrelease', function ($breadcrumbs, $projects) {
    $breadcrumbs->parent('singleproject', $projects);
    $breadcrumbs->push('New Release', route('addrelease', [$projects->company->path, $projects->path]));
});

Breadcrumbs::register('showrelease', function ($breadcrumbs, $projects, $release) {
    $breadcrumbs->parent('singleproject', $projects);
    $breadcrumbs->push(number_format($release->version, 1)." ".$release->name, route('showrelease', [$projects->company->path, $projects->path,$release->path, $release->version ]));
});

Breadcrumbs::register('editrelease', function ($breadcrumbs, $projects, $release) {
    $breadcrumbs->parent('showrelease', $projects, $release);
    $breadcrumbs->push('Edit');
});

//Documents
Breadcrumbs::register('documents', function ($breadcrumbs, $project) {
    $breadcrumbs->parent('singleproject', $project);
    $breadcrumbs->push('Document overview', route('documentoverview', [$project->company->path, $project->path]));
});

Breadcrumbs::register('detailsdocument', function ($breadcrumbs, $document) {
    $breadcrumbs->parent('documents', $document->projects);
    $breadcrumbs->push($document->title, route('showdocument', [$document->projects->company->path, $document->projects->path, $document->id]));
});

//Feature
Breadcrumbs::register('detailsfeature', function ($breadcrumbs, $feature) {
    $breadcrumbs->parent('showrelease', $feature->releases->projects, $feature->releases);
    $breadcrumbs->push($feature->name. " (".$feature->type.")", route('showfeature', [$feature->releases->projects->company->path, $feature->releases->projects->path,
        $feature->releases->path, $feature->releases->versiongit, $feature->id]));
});

