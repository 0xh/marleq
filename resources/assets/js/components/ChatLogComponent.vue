<template>
        <div id="chat-window" class="m-b-40">
                <chat-message
                        v-for="message in messages"
                        :key="message.id"
                        :message="message"
                        :user-id="userId"
                        :user-to-id="userToId"
                        :user="user"
                        :user-to="userTo"
                ></chat-message>
        </div>
</template>

<script>
    export default {
        props: ['messages', 'userId', 'userToId', 'user', 'userTo']
    }
</script>

<style scoped>

</style>