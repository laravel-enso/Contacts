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
            <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <div class="box-title">
                            {{ __("Add Contact") }}
                        </div>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool btn-sm" data-widget="collapse">
                                <i class="fa fa-minus">
                                </i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        {!! Form::open(['method' => 'POST', 'url' => '/administration/contacts']) !!}
                        <div class="row">
                            @include('laravel-enso/contacts::form')
                        </div>
                        <center>
                            {!! Form::submit(__("Save"), ['class' => 'btn btn-primary ']) !!}
                        </center>
                        {!! Form::close() !!}
                    </div>
                </div>
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