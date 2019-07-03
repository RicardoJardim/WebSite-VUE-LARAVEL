<template>
  <div class="profilepage">
    <div class="ref">
      <md-avatar v-if="profissional.especialidade == 'eletricidade'">
        <img src="/eletricidade.png" alt="Avatar" />
      </md-avatar>
      <md-avatar v-else-if="profissional.especialidade == 'construcao'">
        <img src="/construçaocivil.png" alt="Avatar" />
      </md-avatar>
      <md-avatar v-else-if="profissional.especialidade == 'carpintaria'">
        <img src="/carpintaria.png" alt="Avatar" />
      </md-avatar>
      <md-avatar v-else-if="profissional.especialidade == 'canalizacao'">
        <img src="/canalizador.png" alt="Avatar" />
      </md-avatar>
    </div>

    <md-card-media>
      <img src="/avatar.png" />
    </md-card-media>

    <md-card-header>
      <div class="md-title">{{ profissional.user.nome }}</div>
      <div class="md-heading">{{ profissional.especialidade }}</div>
    </md-card-header>

    <md-card-expand>
      <md-card-actions md-alignment="space-between">
        <div>
          <a <router-link class="user" v-bind:to="{ path: `/user/${profissional.user.id}` }"> <md-button type="button" >Perfil</md-button> </router-link></a>
        </div>

        <md-card-expand-trigger>
          <md-button>Descrição</md-button>
        </md-card-expand-trigger>
      </md-card-actions>

      <md-card-expand-content>
        <md-card-content>{{ profissional.descricao }}</md-card-content>
      </md-card-expand-content>
    </md-card-expand>
  </div>
</template>

<script>
export default {

  props: ['profissional'],

  methods: {
    goProfilePage: function() {
      //this.$router.push({ path: "/profiles/" + this.userData.id });
      this.$router.push({
        name: "espProfile",
        params: { id: this.profissional.user.id, data: this.profissional }
        //params:{ id:this.userData.id }
      });
    }
  }
};
</script>

<style lang="scss" scoped>
.profilepage {
  text-align: center;

}
.card-expansion {
  height: 480px;
}
.md-subhead {
  font-size: 100px;
}
.ref {
  text-align: left;
}
</style>