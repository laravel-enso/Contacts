@extends('laravel-enso/core::layouts.app')

@section('pageTitle', __("Contacts"))

@section('content')

    <section class="content-header">
        <a class="btn btn-primary" href="/administration/contacts/create">
            {{ __("Add Contact") }}
        </a>
        @include('laravel-enso/menumanager::breadcrumbs')
    </section>
    <section class="content">
        <div class="row" v-cloak>
            <div class="col-md-12">
                <data-table source="/administration/contacts"
                    id="contacts">
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