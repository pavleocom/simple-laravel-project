<?php

use Tabuna\Breadcrumbs\Trail;
use Tabuna\Breadcrumbs\Breadcrumbs;

Breadcrumbs::for('home', function (Trail $trail) {
    $trail->push('Home', route('home'));
});

Breadcrumbs::for('companies.index', function (Trail $trail) {
    $trail->parent('home')
        ->push('Companies', route('companies.index'));
});

Breadcrumbs::for('companies.create', function (Trail $trail) {
    $trail->parent('companies.index')
        ->push('Add New Company');
});

Breadcrumbs::for('companies.show', function (Trail $trail, $company) {
    $trail->parent('companies.index')
        ->push($company->name, route('companies.show', ['company' => $company->id]));
});

Breadcrumbs::for('companies.edit', function (Trail $trail, $company) {
    $trail
        ->parent('companies.show', $company)
        ->push('Edit');
});

Breadcrumbs::for('companies.employees.show', function (Trail $trail, $company, $employee) {
    $trail->parent('companies.show', $company)
        ->push($employee->fullName(), route('companies.employees.show', [
            'company' => $company->id,
            'employee' => $employee->id
        ]));
});

Breadcrumbs::for('companies.employees.create', function (Trail $trail, $company) {
    $trail->parent('companies.show', $company)
        ->push('Add New Employee');
});

Breadcrumbs::for('companies.employees.edit', function (Trail $trail, $company, $employee) {
    $trail->parent('companies.employees.show', $company, $employee)
        ->push('Edit');
});

