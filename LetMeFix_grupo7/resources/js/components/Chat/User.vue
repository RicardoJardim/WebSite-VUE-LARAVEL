<template>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Negociações</div>
            <div class="card-body">
                <div class="negociacoes">
                    <a href="#">Negociação</a>
                </div>
            </div>
            <div class="card-header">Users</div>
            <div class="card-body">
                <div class="users">
                    <a href="#">Krunal</a>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
    .negociacoes {
        background-color: #fff;
        border-radius: 3px;
    },
    .users {
        background-color: #fff;
        border-radius: 3px;
    }
</style>

<script>
    export default {
        mounted() {
            console.log('User mounted.')
        }
    }
</script>

