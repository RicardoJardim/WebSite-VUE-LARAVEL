<template>
<div>
    <center> <h3>Lista de Utilizadores</h3> </center>
    <div class="alert alert-danger" v-if="has_error">
        <p>Impossível recuperar a lista de utilizadores</p>
    </div>

    <table class="table">
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">Tipo de Utilizador</th>
            <th scope="col">Data de inscrição</th>
            <th scope="col">Funções</th>

        </tr>
        <tr v-for="user in users" v-bind:key="user.id" style="margin-bottom: 5px;">
            <th scope="row">{{ user.id }}</th>
            <td>{{ user.nome }}</td>
            <td>{{ user.email }}</td>
            <td>{{ user.tipo }}</td>
            <td>{{ user.created_at}}</td>
            <div v-if="user.suspend == false">
                <td><button class="btn btn-danger btn-sm" @click="suspend(user.id)"> Suspender </button></td>
            </div>
            <div v-else-if="user.suspend == true">
                <td><button class="btn btn-success btn-sm" @click="suspend(user.id)"> Readmitir </button></td>
            </div>
        </tr>
    </table>

</div>
</template>

<script>
  export default {
    data() {
      return {
        has_error: false,
        users: [],
        user: ''
      }
    },
    methods: {
        suspend: function(user_id){
           axios.put(`http://localhost:8000/api/admin/user/suspend/${user_id}`, {

            }).catch(error => {
                console.log(error.response)
                this.has_error = true
                this.error = error.response.data.error
                this.errors = error.response.data.errors || {}
            });
            window.location.reload()
        }
    },

    mounted() {
        axios.get("http://localhost:8000/api/admin/users").then((response) => {
            this.users = response.data.users
        }, () => {
          this.has_error = true
        })
        .catch(error => {
            console.log(error.response)
        });
    }
  }
</script>