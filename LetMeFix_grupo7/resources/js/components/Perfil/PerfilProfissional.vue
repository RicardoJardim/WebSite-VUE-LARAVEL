<template>
  <div class="espProfile">
    <md-card class="md-primary" v-bind:md-theme="user.cor">
      <md-card-area>
        <div class="shadow">
          <md-card-header>
            <img src="/avatar.png" >

            <md-card-header-text class="box">
              Cliente Profissional
              <h1>{{ user.user.nome }} | {{ user.especialidade }}</h1>
              <h3><b> Número: </b>{{ user.nmr_telefone }}</h3>
              <h3><b>Descrição: </b> {{ user.descricao }}</h3>
            </md-card-header-text>

            <div class="button">
              <div
                class="aval"
                v-if="user.avaliacao != null"
              >
                <div v-if="user.avaliacao % 1 == 0">
                  <h3>Avaliação</h3>
                  <img
                    class="stars"
                    src="/star.png"
                    v-for="index in user.avaliacao"
                    alt="stars"
                    v-bind:key="index"
                  />
                </div>
                <div v-if="user.avaliacao % 1 != 0">
                  <h3>Avaliação</h3>
                  <img
                    class="stars"
                    src="/star.png"
                    v-for="index in Math.floor(user.avaliacao)"
                    alt="stars"
                    v-bind:key="index"
                  />
                  <img />
                  <img
                    class="stars_half"
                    src="/half.png"
                    alt="stars_half"
                  />
                </div>
              </div>
            </div>
          </md-card-header>
        </div>
      </md-card-area>


      <md-card-content>
        <b-card class="text-left">
          <b-card-text>
            <h3><b>Preço/Hora:</b> {{ user.preco_hora }} €/hora </h3>
            <h3><b>Morada:</b> {{ user.morada }}</h3>
            <h3><b>Email:</b>{{ user.user.email }}</h3>

            <h3 class="bold">Equipamento disponivel</h3>

              <h4
                v-for="(value, index) in user.equipamento"
                v-bind:key="index"
              >
                <center> <i> {{ value }} </i> </center>
              </h4>
            <br>
          </b-card-text>
        </b-card>


        <md-content
          class="md-scrollbar md-accent"
          v-bind:md-theme="user.cor"
        >
          <p v-for="(value, index) in avaliacoes" v-bind:key="index">
            <Registos
              v-bind:getObject="value"
            />
          </p>
        </md-content>
        
      </md-card-content>
    </md-card>
  </div>
</template>

<script>

import Registos from "./regProfissional.vue";
export default {
  data() {
    return {
      user: [],
      avaliacoes: [],
      erros: [],
      bool: null,
    };
  },

  components: {
    Registos
  },
  mounted() 
    {  

        axios.get(`http://localhost:8000/api/user/${this.$route.params.id}`).then((response) => {
            this.user = response.data.user;
        })
        .then(response => { 
          console.log(response.data)
        })
        .catch(error => {
            console.log(error.response)
        })
        axios.get(`http://localhost:8000/api/avaliacoes/${this.$route.params.id}`).then((response) => {
            this.avaliacoes = response.data.avaliacoes;
        })
        .then(response => { 
          console.log(response.data)
        })
        .catch(error => {
            console.log(error.response)
        });
    },
};
</script>

<style lang="scss" scoped>
@import "~vue-material/dist/theme/engine";

.md-card-content {
  height: 600px;
}
.md-card {
  width: 100%;
  height: 90%;
}

.md-content {
  width: 1050px;
  max-height: 60%;
  border-style: none;
  overflow: auto;
  right: 3%;
  position: absolute;
  text-align: center;
}
.text-left {
  background: rgba(255, 255, 255, 0.2);
  width: 30%;
  position: absolute;
  text-align: left;
  left: 3%;
}

.desc {
  width: 30%;
  position: absolute;
  text-align: left;
  left: 36%;
}
.bold {
  font-weight: bold;
}

.midle {
  text-align: center;
}

.h3g {
  margin-top: 5%;
  margin-left: 20%;
}
.box {
  margin-right: 20%;
  margin-top: 2%;
  margin-left: 3%;
  text-align: left;
}

.button {
  margin-right: 5%;
  margin-top: 5%;
  width: 20%;
  height: 20%;
  text-align: left;
}

.shadow {
  box-shadow: 0 5px 0 lightgray;
  text-align: left;
}
.image {
  margin-left: 7%;
  width: 20%;
  height: 20%;
}

.stars {
  width: 20%;
  height: 20%;
}
.stars_half {
  width: 15%;
  height: 20%;
  text-align: left;
}

@include md-register-theme(
  "yellow-card",
  (
    primary: md-get-palette-color(yellow, 200),
    accent: md-get-palette-color(yellow, 100)
  )
);
@include md-register-theme(
  "blue-card",
  (
    primary: md-get-palette-color(blue, 200),
    accent: md-get-palette-color(blue, 100)
  )
);
@include md-register-theme(
  "orange-card",
  (
    primary: md-get-palette-color(orange, 200),
    accent: md-get-palette-color(orange, 100)
  )
);
@include md-register-theme(
  "brown-card",
  (
    primary: md-get-palette-color(brown, 200),
    accent: md-get-palette-color(brown, 100)
  )
);

@import "~vue-material/dist/theme/all";
</style>