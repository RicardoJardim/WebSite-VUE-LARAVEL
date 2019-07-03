<template>
    <div class="container">
        <div class="card card-default">
            <h2> <div class="card-header">Registo</div> </h2>

            <div class="card-body">
                <label>Qual é o tipo de utilizador que pretende ser?</label>
                <div class="reg">
                  <input type="radio" id="privado" value="privado" v-model="picked" />
                  <label for="privado">Cliente privado</label>
                  <br />
                  <input type="radio" id="comercial" value="comercial" v-model="picked" />
                  <label for="comercial">Cliente comercial</label>
                  <br />
                  <input type="radio" id="profissional" value="profissional" v-model="picked" />
                  <label for="profissional">Profissional</label>
                  <br />
                </div>
                <RegisterForm v-bind:type="picked" v-if="picked" />
            </div>
        </div>
    </div>
</template>

<script>
import RegisterForm from "./RegisterForm.vue";

export default {
  name: "register",
  data() {
    return {
      picked: ""
    };
  },
  components: {
    RegisterForm
  }
};
</script>
