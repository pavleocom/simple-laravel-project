@component('mail::message')
# {{ __('New company was registered') }}

@component('mail::button', ['url' => route('companies.show', [
    'company' => $company->id
])])
{{ __('View') }}
@endcomponent

{{ config('app.name') }}
@endcomponent
