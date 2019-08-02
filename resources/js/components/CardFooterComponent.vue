<template>
    <div class="card-footer">
        <form @submit.prevent="sendMessage" method="POST">
            <div class="form-group">
                <input type="hidden" name="_token" :value="this.csrf">
                <textarea class="form-control" name="body" rows="5" v-model="toSend" placeholder="Send message"></textarea>
<!--                <input type="submit" value="Send message" class="mt-3 btn btn-custom">-->
                <button type="submit" class="mt-3 btn btn-custom">Send message</button>
            </div>
        </form>
    </div>
</template>

<script>

    import Event from '../event';

    export default {
        name: "CardFooterComponent",
        data(){
            return {
               'csrf': '',
                'toSend': '',
            }
        },
        props: ['user'],
        created() {
            this.csrf = Laravel.csrfToken;
        },
        methods: {
            sendMessage(){
                if(!this.toSend || this.toSend.trim() === '')
                    return;
                let msg = this.toSend;
                this.toSend = '';
                axios.post('/send/' + this.user.id, {
                    'body': msg
                })
                    .then((res) => {
                        // Add res to messages;

                        let messageObj = {
                            'body': res.data.body,
                            'created_at': res.data.created_at,
                            'id': res.id,
                            'receiver_id': res.data.receiver_id,
                            'sender_id': res.data.sender_id,
                            'updated_at': res.data.updated_at
                        };
                        Event.$emit('added_message', messageObj);

                    })
                    .catch((err) => {
                        console.error(err);
                    });
            }
        }
    }
</script>

<style>
    * {
        font-family: BlinkMacSystemFont, -apple-system, "Segoe UI", "Roboto", "Oxygen", "Ubuntu", "Cantarell", "Fira Sans", "Droid Sans", "Helvetica Neue", "Helvetica", "Arial", sans-serif !important;
    }
    .btn-custom {
        color: white !important;
        background-color: #3f9ae5;
    }
    textarea:hover,
    input:hover,
    textarea:active,
    input:active,
    textarea:focus,
    input:focus,
    button:focus,
    button:active,
    button:hover,
    label:focus,
    .btn:active,
    .btn.active
    {
        outline:0px !important;
        -webkit-appearance:none;
        box-shadow: none !important;
    }

    .my-card {
        max-width: 600px !important;
        width: 95% !important;
        margin: 0 auto !important;
    }
</style>
