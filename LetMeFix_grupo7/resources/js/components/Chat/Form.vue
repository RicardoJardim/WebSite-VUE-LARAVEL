<template>
    <div>
        <form class="form">
            <textarea
                id="body"
                cols="28"
                rows="5"
                class="form-input"
                @keydown="typing"
                v-model="body">
            </textarea>

                <p>Carregue Enter para enviar a mensagem</p>

        </form>
    </div>
</template>

<style>
    .form {
        padding: 8px;
    }
    .form-input {
        width: 100%;
        border: 1px solid #d3e0e9;
        padding: 5px 10px;
        outline: none;
    }
    .notice {
        color: #aaa
    }
    
</style>

<script>

    import Event from './event.js';

    export default {
        data() {
            return {
                body: null,
                conversa_id: null
            }
        },
        methods: {
            typing(e) {
                if(e.keyCode === 13 && !e.shiftKey) {
                    e.preventDefault();
                    this.sendMessage();
                }        
            },
            sendMessage() {
                if(!this.body || this.body.trim() === '' || !this.$route.params.id) {
                    return
                }
                    let messageObj = this.buildMessage();
                    Event.$emit('added_message', messageObj);
                    axios.post('http://localhost:8000/api/mensagem', {
                        body: this.body.trim(),
                        conversa_id: this.$route.params.id,
                    }).catch(error => {
                        console.log(error.response)
                    });
                    this.body = null;
                },
            buildMessage() {
                return {
                    id: Date.now(),
                    body: this.body,
                    conversa_id: this.$route.params.id,
                    selfMessage: true,
                    user: {
                        id: Laravel.user.id,
                        nome: Laravel.user.nome
                    }
                }
            }
        }
    }
</script>

