@extends('laravel-enso/core::layouts.app')

@section('pageTitle', __("Contacts"))

@section('content')

    <section class="content-header">
        @include('laravel-enso/menumanager::breadcrumbs')
    </section>
    <section class="content">
        <div class="row" v-cloak>
            <div class="col-md-12">
                <data-table source="/core/contacts"
                    @edit-contact="edit"
                    id="contacts"
                    ref="contacts">
                </data-table>
            </div>
        </div>
        <contact-form :show="showForm"
            v-if="showForm"
            :edit-mode="true"
            :contact="contact"
            @closed="showForm=false;contact={};"
            @updated="update()">
        </contact-form>
    </section>

@endsection

@push('scripts')

    <script type="text/javascript">

        const vm = new Vue({
            el: '#app',

            data: {
                showForm: false,
                contact: {},
            },

            methods: {
                edit(id) {
                    let data = this.$refs.contacts.dtHandle.data().toArray(),
                        contact = data.find(function(contact) {
                            return contact.DT_RowId === id;
                        });

                    this.setContact(contact);
                    this.showForm = true;
                },
                setContact(contact) {
                    this.contact.id = contact.DT_RowId;
                    this.contact.first_name = contact.first_name;
                    this.contact.last_name = contact.last_name;
                    this.contact.email = contact.email;
                    this.contact.phone = contact.phone;
                    this.contact.is_active = contact.is_active;
                },
                update() {
                    this.showForm = false;
                    this.$refs.contacts.dtHandle.ajax.reload();
                }
            }
        });

    </script>

@endpush