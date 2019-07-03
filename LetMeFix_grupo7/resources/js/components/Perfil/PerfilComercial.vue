<template>
  <div class="espProfile">
    <md-card class="md-primary" v-bind:md-theme="'green-card'">
      <md-card-area>
        <div class="shadow">
          <md-card-header>
            <img src="/company.png" >

            <md-card-header-text class="box">
            	Cliente Comercial
              <h1>{{ user.user.nome }} | {{user.ramo}}</h1>
              <h3><b> Número: </b>{{ user.nmr_telefone }}</h3>
              <h3><b>Morada</b> {{ user.morada }}</h3>
              <h3><b>Email</b> {{ user.user.email }}</h3>
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
 


        <md-content
        <b-card-text>
          <p v-for="(value, index) in avaliacoes" v-bind:key="index">
            <Registos
              v-bind:getObject="value"
            />
          </p>
      </b-card-text>
        </md-content>
        
      </md-card-content>
    </md-card>
  </div>
</template>

<script>
//import axios from "axios";
import Registos from "./regPrivado.vue";
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
  width: 1000px;
  max-height: 55%;
  border-style: solid;
  border-width: 2px;
  border-radius: 5px;
  overflow: auto;
  right: 2%;
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
  "green-card",
  (
    primary: md-get-palette-color(green, 50),
  )
);

@include md-register-theme(
  "yellow-card",
  (
    primary: md-get-palette-color(yellow, 500),
    accent: md-get-palette-color(yellow, 200)
  )
);
@include md-register-theme(
  "blue-card",
  (
    primary: md-get-palette-color(blue, 500),
    accent: md-get-palette-color(blue, 200)
  )
);
@include md-register-theme(
  "orange-card",
  (
    primary: md-get-palette-color(orange, 500),
    accent: md-get-palette-color(orange, 200)
  )
);
@include md-register-theme(
  "brown-card",
  (
    primary: md-get-palette-color(brown, 500),
    accent: md-get-palette-color(brown, 200)
  )
);

@import "~vue-material/dist/theme/all";
</style>