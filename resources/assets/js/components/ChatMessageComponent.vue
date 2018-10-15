<template>
    <article class="media">
        <figure class="media-left">
            <p class="image is-64x64">
                <img class="is-grayscale" style="border-radius: 5px;"
                     v-if="message.user_from_id === user.id"
                     :src="user.picture_crop">
                <img class="is-grayscale" style="border-radius: 5px;"
                     v-if="message.user_from_id === userTo.id"
                     :src="userTo.picture_crop">
            </p>
        </figure>
        <div class="media-content">
            <div class="content">
                <p>
                    <strong v-if="message.user_from_id === user.id">{{ user.name }} {{ user.surname }}</strong>
                    <strong v-if="message.user_from_id === userTo.id">{{ userTo.name }} {{ userTo.surname }}</strong>

                    <br/><small>{{ message.created_at }}</small><br/>
                    <br>
                    {{ message.message }}
                </p>
            </div>
        </div>
    </article>
</template>

<script>
    export default {
        props: ['message', 'userId', 'userToId', 'user', 'userTo']
    }
</script>

<style scoped>

</style>