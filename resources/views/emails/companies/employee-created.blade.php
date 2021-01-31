@component('mail::message')
# {{ __('New employee was registered') }}

@component('mail::button', ['url' => route('companies.employees.show', [
    'company' => $employee->company->id, 'employee' => $employee->id
])])
{{ __('View') }}
@endcomponent

{{ config('app.name') }}
@endcomponent
