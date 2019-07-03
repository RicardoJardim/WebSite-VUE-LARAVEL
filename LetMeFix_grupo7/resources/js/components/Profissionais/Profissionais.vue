<template>
  <div>
    <div class="reg">
      <md-card
        v-for="profissional in profissionais"
        v-bind:key="profissional.id"
        class="md-primary"
        v-bind:md-theme="profissional.cor"
        md-with-hover
      >
        <ProfilesPage v-bind:profissional="profissional" />
      </md-card>
    </div>
  </div>
</template>

<script>
import ProfilesPage from "./Profissional.vue";

export default {
  name: "profiles",
  data() {
    return {
      erros: [],
      profissionais: [],
    };
  },
  components: {
    ProfilesPage
  },
  mounted() {
        axios.get(`http://localhost:8000/api/profissionais/`).then((response) => {
            this.profissionais = response.data.profissionais;
        });
    }
};
</script>

<style lang="scss" scoped>
@import "~vue-material/dist/theme/engine";

.reg {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: left;
  color: #2c3e50;
  margin-left: 3%;
  margin-top: 3%;
}

#nav a {
  font-weight: bold;
  color: #2c3e50;
}

#nav a.router-link-exact-active {
  color: #42b983;
}
@include md-register-theme(
  "yellow-card",
  (
    primary: md-get-palette-color(yellow, 500)
  )
);
@include md-register-theme(
  "blue-card",
  (
    primary: md-get-palette-color(blue, 500)
  )
);
@include md-register-theme(
  "orange-card",
  (
    primary: md-get-palette-color(orange, 500)
  )
);
@include md-register-theme(
  "brown-card",
  (
    primary: md-get-palette-color(brown, 500)
  )
);

.md-card {
  width: 280px;
  margin: 4px;
  display: inline-block;
  vertical-align: top;
}

@import "~vue-material/dist/theme/all";
</style>