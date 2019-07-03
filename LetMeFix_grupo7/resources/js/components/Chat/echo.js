import Event from './event';

Echo.join('chat')
    .listen('MensagemCriada', (data) => {
        Event.$emit('added_message', data.mensagem);
    });