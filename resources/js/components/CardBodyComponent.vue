<template>
    <div class="card-body my-card-body" ref="cont" v-chat-scroll="{always: true, smooth: true, scrollonremoved:true}">
        <div v-for="(message,index) in this.messages" v-bind:key="index">

            <div :class="user.id === message.sender_id ? 'messageReceived' : 'message'">
                <p>
                    {{message.body}}
                    <span class="small d-block ">{{message.created_at}}</span>
                </p>
            </div>

        </div>

        <template v-if="this.messages === null | this.messages.length === 0">
            <div class="empty">
                <p class="text-secondary">Empty</p>
            </div>
        </template>

    </div>
</template>

<script>
    export default {
        name: "CardBodyComponent",
        props: ['messages','user'],
        created() {
            window.Echo.private(`message.${Laravel.user.id}`)
                .listen('MessageCreated', (e) => {
                    // Before you push it make sure it's for this chat
                    // if not you can just send notification to the user..
                    if(this.user.id == e.message.sender_id){
                        this.messages.push(e.message);
                    }else {
                        // alert(`User with id ${this.user.id} want's to chat with you...`);
                    }
                });

        }
    }
</script>

<style scoped>
    .my-card-body {
        height: 40vh !important;
        min-height: 300px;
        overflow-y: scroll;
        overflow-x: hidden;
    }
    .message, .messageReceived {
        padding: 4px 15px;
        margin: 5px;
        text-align: left;
        max-width: 50%;
        border-radius: 10px;
        clear: both !important;
    }
    .messageReceived {
        background-color: #0084FF;
        color: white;
        float: right;
    }
    .message {
        float: left;
        background-color: #E9EBEE;
        color: black;
    }
    .empty {
        height: 100%;
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
    }
</style>
