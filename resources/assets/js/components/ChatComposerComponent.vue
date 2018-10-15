<template>
    <div class="chat-composer">
        <div class="field has-addons">
            <div class="control is-expanded">
                <input class="input" type="text" placeholder="Start typing your message..."
                       v-model="messageText"
                       :disabled="isLoading"
                       @keydown.enter="sendMessage">
            </div>
            <div class="control">
                <button class="button is-marleq" :class="{ 'is-loading': isLoading }" :disabled="messageText === ''" @click="sendMessage">
                    <span>Send</span>
                    <span class="icon">
                        <i class="fa fa-paper-plane"></i>
                    </span>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                messageText: ''
            }
        },
        props: ['isLoading'],
        methods: {
            sendMessage() {
                if (this.messageText !== '') {
                    this.$emit('messagesent', {
                        message: this.messageText
                    });
                    this.messageText = '';
                }
            }
        }
    }
</script>

<style scoped>
    .chat-composer .field {
        display: flex;
    }
    .chat-composer .field .control input {
        flex: 1 auto;
    }
</style>