@extends('laravel-enso/core::layouts.app')

@section('pageTitle', __("Contacts"))

@section('content')

    <page v-cloak>
        <div class="col-md-12">
            <data-table source="/core/contacts"
                @edit-contact="edit"
                id="contacts"
                ref="contacts">
            </data-table>
        </div>
        <contact-form :show="showForm"
            v-if="showForm"
            :edit-mode="true"
            :contact="contact"
            @closed="showForm=false;contact={};"
            @update="update()">
        </contact-form>
    </page>

@endsection

@push('scripts')

    <script>

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
                    Object.assign(this.contact, contact);
                    this.contact.id = contact.DT_RowId;
                    this.contact.is_active = contact.is_active_bool;
                },
                update() {
                    this.showForm = false;
                    this.$refs.contacts.dtHandle.ajax.reload();
                }
            }
        });

    </script>

@endpush