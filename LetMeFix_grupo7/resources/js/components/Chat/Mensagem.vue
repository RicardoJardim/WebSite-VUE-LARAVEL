<template>
    <div class="message self">
        <strong class="user">{{mensagem.user.nome }}</strong>
        <p class="body">{{ mensagem.body }}</p>
    </div>
</template>

<style>
    .user {
        font-weight: 800;
    }
    .body {
        margin-bottom: 0;
        white-space: pre-wrap;
    }
    .message {
        border-bottom: 1px solid #000000
        
    }
    .self {
        background-color: #f0f0f0;
        padding: 10px;
    }
</style>

<script>
    export default {
        props: ['mensagem']
    }
</script>

