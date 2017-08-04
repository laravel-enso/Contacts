<template>

    <box :theme="theme"
        collapsible refresh search removable
        :solid="solid"
        max-height="415px"
        :open="open"
        @refresh="get()"
        icon="fa fa-address-card-o"
        :title="title || labels.contacts"
        :overlay="loading"
        @query-update="query = $event"
        :badge="contacts.length">
        <span slot="btn-box-tool">
            <button class="btn btn-box-tool btn-sm fa fa-plus-square"
                @click="showForm=true">
            </button>
        </span>
        <div class="contacts">
            <div v-for="(contact, index) in filteredContacts">
                <div class="col-sm-6 col-lg-4">
                    <contact :contact="contact"
                        @delete="destroy($event)"
                        @edit="edit($event)"
                        :index="index"
                        :type="type"
                        :id="id">
                    </contact>
                </div>
            </div>
        </div>
        <contact-form :show="showForm"
            v-if="showForm"
            :contact="emptyContact()"
            :type="type"
            :id="id"
            @closed="showForm=false"
            @store="add($event);showForm=false">
        </contact-form>
    </box>

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
            theme: {
                type: String,
                default: 'primary'
            },
            solid: {
                type: Boolean,
                default: false,
            },
            open: {
                type: Boolean,
                default: false
            },
            title: {
                type: String,
                default: null
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
                showForm: false
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
            emptyContact() {
                return {
                    first_name: "",
                    last_name: "",
                    email: "",
                    phone: "",
                    obs: ""
                };
            },
            add(contact) {
                this.contacts.push(contact);
            },
            destroy(index) {
                this.contacts.splice(index,1);
            }
        },

        mounted() {
            this.get();
        }
    }

</script>

<style>

    .box-body > div.contacts {
        overflow-y: auto;
        max-height: 358px;
    }

</style>