@extends('laravel-enso/core::layouts.app')

@section('pageTitle', __("Contact Persons"))

@section('content')

    <section class="content-header">
        <a class="btn btn-primary" href="/administration/contactPersons/create">
            {{ __("Add Contact Person") }}
        </a>
        @include('laravel-enso/core::partials.breadcrumbs')
    </section>
    <section class="content">
        <div class="row" v-cloak>
            <div class="col-md-12">
                <data-table source="/administration/contactPersons">
                    <span slot="data-table-title">{{ __("Contact Persons") }}</span>
                    @include('laravel-enso/core::partials.modal')
                </data-table>
            </div>
        </div>
    </section>

@endsection

@push('scripts')

    <script type="text/javascript">

        let vm = new Vue({
            el: '#app'
        });

    </script>

@endpush