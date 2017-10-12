<?php

Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push('Home', route('home'));
});

//company

Breadcrumbs::register('company', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Company', route('overviewcompany'));
});
Breadcrumbs::register('addcompany', function ($breadcrumbs) {
    $breadcrumbs->parent('company');
    $breadcrumbs->push('New Company', route('addcompany'));
});


Breadcrumbs::register('singlecompany', function ($breadcrumbs, $companys) {
    $breadcrumbs->parent('company');
    $breadcrumbs->push($companys->name, route('companydetails', $companys->name));
});

Breadcrumbs::register('editcompany', function ($breadcrumbs, $companys) {
    $breadcrumbs->parent('company');
    $breadcrumbs->push($companys->name, route('companydetails', $companys->name));
    $breadcrumbs->push('Edit', route('editcompany', $companys->name));
});

//Projects

Breadcrumbs::register('projects', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Projects', route('overviewproject'));
});

Breadcrumbs::register('singleproject', function ($breadcrumbs, $projects, $companys) {
    $breadcrumbs->parent('projects');
    $breadcrumbs->push($companys->name, route('companydetails', ['company_id' => $companys->name]));
    $breadcrumbs->push($projects->name, route('projectdetails', ['name'=> $projects->name, 'company_id' => $projects->company_id]));
});

Breadcrumbs::register('editproject', function ($breadcrumbs, $projects) {
    $breadcrumbs->parent('projects');
    $breadcrumbs->push($projects->company->name, route('companydetails', ['company_id' => $projects->company->name]));
    $breadcrumbs->push($projects->name, route('projectdetails', ['name'=> $projects->name, 'company_id' => $projects->company_id]));
    $breadcrumbs->push('Edit', route('editproject', ['name'=> $projects->name, 'company_id' => $projects->company_id]));
});

Breadcrumbs::register('addproject', function ($breadcrumbs) {
    $breadcrumbs->parent('projects');
    $breadcrumbs->push('New project', route('addproject'));
});


//Release
Breadcrumbs::register('addrelease', function ($breadcrumbs, $projects, $companys) {
    $breadcrumbs->parent('projects');
    $breadcrumbs->push($companys->name, route('companydetails', ['company_id' => $companys->name]));
    $breadcrumbs->push($projects->name, route('projectdetails', ['name'=> $projects->name, 'company_id' => $projects->company_id]));
    $breadcrumbs->push('New Release', route('addrelease', ['name'=> $projects->name, 'company_id' => $projects->company_id]));
});

Breadcrumbs::register('showrelease', function ($breadcrumbs, $projects, $companys, $release) {
    $breadcrumbs->parent('projects');
    $breadcrumbs->push($companys->name, route('companydetails', ['company_id' => $companys->name]));
    $breadcrumbs->push($projects->name, route('projectdetails', ['name'=> $projects->name, 'company_id' => $projects->company_id]));
    $breadcrumbs->push($release->version. " ". $release->name, route('showrelease', ['name'=> $projects->name, 'company_id' => $projects->company_id,
        'version' => $release->version, 'release_name' => $release->name]));
});