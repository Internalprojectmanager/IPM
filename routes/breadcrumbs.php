<?php

Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push('Home', route('home'));
});

//company

Breadcrumbs::register('client', function ($breadcrumbs) {
    $breadcrumbs->push('Client Overview', route('overviewcompany'));
});
Breadcrumbs::register('addcompany', function ($breadcrumbs) {
    $breadcrumbs->parent('company');
    $breadcrumbs->push('New Company', route('addcompany'));
});


Breadcrumbs::register('singleclient', function ($breadcrumbs, $companys) {
    $breadcrumbs->parent('client');
    $breadcrumbs->push($companys->name, route('companydetails', $companys->name));
});

Breadcrumbs::register('editclient', function ($breadcrumbs, $companys) {
    $breadcrumbs->parent('client');
    $breadcrumbs->push($companys->name, route('companydetails', $companys->name));
    $breadcrumbs->push('Edit', route('editcompany', $companys->name));
});

//Projects

Breadcrumbs::register('projects', function ($breadcrumbs) {
    $breadcrumbs->push('Project Overview', route('overviewproject'));
});

Breadcrumbs::register('singleproject', function ($breadcrumbs, $projects) {
    $breadcrumbs->parent('projects');
    $breadcrumbs->push($projects->name, route('projectdetails', ['name'=> $projects->name, 'company_id' => $projects->company_id]));
});

Breadcrumbs::register('editproject', function ($breadcrumbs, $projects) {
    $breadcrumbs->parent('projects');
    $breadcrumbs->push($projects->name, route('projectdetails', ['name'=> $projects->name, 'company_id' => $projects->company_id]));
    $breadcrumbs->push('Edit', route('editproject', ['name'=> $projects->name, 'company_id' => $projects->company_id]));
});

Breadcrumbs::register('addproject', function ($breadcrumbs) {
    $breadcrumbs->parent('projects');
    $breadcrumbs->push('New project', route('addproject'));
});


//Release
Breadcrumbs::register('addrelease', function ($breadcrumbs, $projects) {
    $breadcrumbs->parent('projects');
    $breadcrumbs->push($projects->name, route('projectdetails', ['name'=> $projects->name, 'company_id' => $projects->company_id]));
    $breadcrumbs->push('New Release', route('addrelease', ['name'=> $projects->name, 'company_id' => $projects->company_id]));
});

Breadcrumbs::register('showrelease', function ($breadcrumbs, $projects, $release) {
    $breadcrumbs->parent('projects');
    $breadcrumbs->push($projects->name, route('projectdetails', ['name'=> $projects->name, 'company_id' => $projects->company_id]));
    $breadcrumbs->push($release->name. " ".$release->version, route('showrelease', ['name'=> $projects->name, 'company_id' => $projects->company_id,
        'version' => $release->version, 'release_name' => $release->name]));
});