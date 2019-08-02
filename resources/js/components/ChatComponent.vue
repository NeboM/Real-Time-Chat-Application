<template>
    <div class="mt-5 card my-card">
        <div class="card-header">
            <h4 class="float-left">{{ this.user.name }}</h4>
            <span><a href="/" class="float-right">Go back</a></span>
        </div>

        <card-body-component :messages="this.messages" :user="user"></card-body-component>
        <card-footer-component :user="user"></card-footer-component>

    </div>
</template>

<script>

    import Event from '../event';

    export default {
        props: ['user'],
        data(){
            return {
                'messages': '',
            }
        },
        mounted() {
            Event.$on('added_message', (message) => {
                this.messages.push(message);
            });
        },
        created() {
            // Get CHAT between authenticated user and user with id this.user.id
            axios.get('/chat/' + this.user.id)
                .then((res) => {
                    this.messages = res.data;
                })
                .catch((err) => {
                    console.error(err);
                });
        }
    }
</script>
