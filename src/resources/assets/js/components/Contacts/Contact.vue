<template>

    <div class="col-sm-6 col-lg-4">
        <div class="small-box" :class="{'bg-olive': contact.is_active, 'bg-gray': !contact.is_active}">
            <div class="inner">
                <address class="contact-info">
                    <b>{{ contact.first_name }} {{ contact.last_name }}</b><br>
                    {{ contact.owner }} <br>
                    <i class="fa fa-envelope"></i> {{ contact.email }} <br>
                    <i class="fa fa-phone"></i> {{ contact.phone }} <br>
                    <i class="fa fa-sticky-note "></i> {{ contact.obs }} <br>
                </address>
            </div>
            <div class="icon">
                <i class="fa fa-address-card-o"></i>
            </div>
            <a class="small-box-footer controls">
                <i class="fa fa-pencil-square-o pull-left margin-left-md"
                    @click="$emit('edit', contact)"></i>
                <i class="fa fa-trash-o pull-right margin-right-md"
                    @click="$emit('delete', contact.id)"></i>
                <div class="clearfix"></div>
            </a>
        </div>
    </div>

</template>

<script>

    export default {
        props: {
            contact: {
                type: Object,
                default() {
                    return {
                        first_name: "",
                        last_name: "",
                        email: "",
                        phone: ""
                    }
                }
            }
        },
        data() {
            return {
                labels: Store.labels
            };
        },
        methods: {
            destroy() {
            },
            edit() {
            }
        }
    }

</script>

<style>

    address.contact-info {
        padding-left: 10px;
        padding-top: 10px;
    }

    .small-box-footer.controls > i {
        cursor: pointer;
    }

</style>