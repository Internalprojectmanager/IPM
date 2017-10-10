<?php

Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push('Home', route('home'));
});

Breadcrumbs::register('projects', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Projects', route('overviewproject'));
});

Breadcrumbs::register('company', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Company', route('overviewcompany'));
});

Breadcrumbs::register('singlecompany', function ($breadcrumbs, $companys) {
    $breadcrumbs->parent('company');
    $breadcrumbs->push($companys->name, route('companydetails', $companys->id));
});

Breadcrumbs::register('singleproject', function ($breadcrumbs, $projects, $companys) {
    $breadcrumbs->parent('projects');
    $breadcrumbs->push($companys->name, route('companydetails', ['company_id' => $companys->name]));
    $breadcrumbs->push($projects->name, route('projectdetails', ['name'=> $projects->name, 'company_id' => $projects->company_id]));
});