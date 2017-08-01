<template>

    <modal :show="show"
        header
        @cancel-action="$emit('closed')"
        @commit-action="save()"
        max-width="350">
        <span slot="header">
            <i class="fa fa-address-card-o"></i>
            <span v-if="editMode">{{ labels.edit }}</span>
            <span v-else>{{ labels.create }}</span>
        </span>
        <span slot="body">
            <div class="form-group" :class="{'has-error' : errors.first_name}">
                <label>{{ labels.firstName }}</label>
                <small class="text-danger" style="float:right;">
                    {{ errors.first_name ? errors.first_name[0] : null }}
                </small>
                <input type="text"
                    v-focus
                    class="form-control text-center margin-bottom-xs"
                    v-model="contact.first_name">
            </div>
            <div class="form-group" :class="{'has-error' : errors.last_name}">
                <label>{{ labels.lastName }}</label>
                <small class="text-danger" style="float:right;">
                    {{ errors.last_name ? errors.last_name[0] : null }}
                </small>
                <input type="text"
                    class="form-control text-center margin-bottom-xs"
                    v-model="contact.last_name">
            </div>
            <div class="form-group" :class="{'has-error' : errors.email}">
                <label>{{ labels.email }}</label>
                <small class="text-danger" style="float:right;">
                    {{ errors.email ? errors.email[0] : null }}
                </small>
                <input type="text"
                    class="form-control text-center margin-bottom-xs"
                    v-model="contact.email">
            </div>
            <div class="form-group" :class="{'has-error' : errors.phone}">
                <label>{{ labels.phone }}</label>
                <small class="text-danger" style="float:right;">
                    {{ errors.phone ? errors.phone[0] : null }}
                </small>
                <input type="text"
                    class="form-control text-center margin-bottom-xs"
                    v-model="contact.phone">
            </div>
            <div class="form-group text-center">
                <input type="checkbox" v-model="contact.is_active">
                <label>{{ labels.isActive }}</label>
            </div>
        </span>
    </modal>

</template>

<script>

    export default {
        props: {
            show: {
                type: Boolean,
                required: true
            },
            id: {
                default: null
            },
            editMode: {
                type: Boolean,
                default: false
            },
            type: {
                type: String,
                default: ""
            },
            contact: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                showModal: this.show,
                errors: {},
                labels: Store.labels
            };
        },
        methods: {
            save() {
                return this.editMode ? this.update() : this.store();
            },
            store() {
                axios.post('/core/contacts', {contact: this.contact, id: this.id, type: this.type}).then(response => {
                    this.$emit('stored', response.data);
                }).catch(error => {
                    this.reportEnsoException(error);
                    if (error.response.data.errorBag) {
                        this.errors = error.response.data.errorBag;
                    }
                });
            },
            update(index) {
                axios.patch('/core/contacts/' + this.contact.id, {contact: this.contact, id: this.id, type: this.type}).then(response => {
                    this.$emit('updated');
                }).catch(error => {
                    this.reportEnsoException(error);
                    if (error.response.data.errorBag) {
                        this.errors = error.response.data.errorBag;
                    }
                });
            },
        }
    }

</script>