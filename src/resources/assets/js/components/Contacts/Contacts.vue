<template>

    <div class="box" :class="['box-' + headerClass, open ? '': 'collapsed-box']">
        <div class="box-header with-border">
            <i class="fa fa-address-card-o"></i>
            <h3 class="box-title">
                {{ labels.contacts }}
            </h3>
             <div class="box-tools pull-right">
                <i v-if="contacts.length > 1"
                    class="fa fa-search">
                </i>
                <input type="text"
                    size="15"
                    class="contacts-filter margin-right-xs"
                    v-model="query"
                    v-if="contacts.length > 1">
                <button class="btn btn-box-tool btn-sm fa fa-plus-square"
                    @click="showForm = true">
                </button>
                <span class="badge bg-orange">
                    {{ contacts.length }}
                </span>
                <button type="button"
                    class="btn btn-box-tool btn-sm"
                    @click="get()">
                    <i class="fa fa-refresh"></i>
                </button>
                <button class="btn btn-box-tool btn-sm"
                    data-widget="collapse">
                    <i :class="['fa', open ? 'fa-minus' : 'fa-plus']"></i>
                </button>
            </div>
        </div>
        <div class="box-body contacts">
            <div class="row">
                <div v-for="(contact, index) in filteredContacts">
                    <contact :contact="contact"
                        @delete="idToBeDeleted=$event;showModal=true"
                        @edit="edit($event)">
                    </contact>
                </div>
            </div>
        </div>
        <div class="overlay" v-if="loading">
            <i class="fa fa-spinner fa-spin spinner-custom" ></i>
        </div>
        <modal :show="showModal"
            @cancel-action="showModal=false;idToBeDeleted=null"
            @commit-action="destroy()">
        </modal>
        <contact-form :show="showForm"
            v-if="showForm"
            :edit-mode="editMode"
            :contact="selectedContact"
            :type="type"
            :id="id"
            @closed="showForm=false;selectedContact={};editMode=false"
            @updated="update()"
            @stored="store($event)">
        </contact-form>
    </div>

</template>

<script>

    export default {
        props: {
            id: {
                type: Number,
                required: true
            },
            type: {
                type: String,
                required: true
            },
            headerClass: {
                type: String,
                default: 'primary'
            },
            open: {
                type: Boolean,
                default: false
            }
        },

        computed: {
            filteredContacts() {
                return this.query
                    ? this.contacts.filter(contact => {
                        return contact.first_name.toLowerCase().indexOf(this.query.toLowerCase()) > -1
                            || contact.last_name.toLowerCase().indexOf(this.query.toLowerCase()) > -1;
                    })
                    : this.contacts;
            },
        },

        data() {
            return {
                labels: Store.labels,
                loading: false,
                query: '',
                contacts: [],
                selectedContact: {},
                showModal: false,
                showForm: false,
                editMode: false,
                idToBeDeleted: null
            };
        },

        methods: {
            get() {
                this.loading = true;

                axios.get('/core/contacts/list', { params: { id: this.id, type: this.type } }).then(response => {
                    this.contacts = response.data;
                    this.loading = false;
                }).catch(error => {
                    this.loading = false;
                    this.reportEnsoException(error);
                });
            },
            edit(contact) {
                this.editMode=true;
                Object.assign(this.selectedContact,contact);
                this.showForm = true;
            },
            store(contact) {
                this.contacts.push(contact);
                this.showForm = false;
                this.selectedContact = {};
            },
            update() {
                let self = this,
                    contact = this.contacts.find(function(contact) {
                        return contact.id === self.selectedContact.id;
                    })

                Object.assign(contact, this.selectedContact);
                this.selectedContact = {};
                this.editMode = false;
                this.showForm = false;
            },
            destroy() {
                this.showModal = false;
                this.loading = true;

                axios.delete('/core/contacts/' + this.idToBeDeleted).then(response => {
                    let self = this;

                    let index = this.contacts.findIndex(contact => {
                        return contact.id === self.idToBeDeleted;
                    });

                    this.contacts.splice(index,1);
                    this.loading = false;
                    this.idToBeDeleted = null;
                }).catch(error => {
                    this.loading = false;
                    this.reportEnsoException(error);
                });
            }
        },

        mounted() {
            this.get();
        }
    }

</script>

<style>

    .box-body.contacts {
        overflow-y:scroll;
        max-height: 350px
    }

</style>