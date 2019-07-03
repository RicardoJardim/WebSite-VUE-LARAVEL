<template>
  <div class="app">
    <div class="mt-2">
      <form autocomplete="off" @submit.prevent="register" v-if="!success" method="post">

        <div class="form-group row" v-bind:class="{ 'has-error': has_error && errors.nome }">
            <label class="col-sm-2 col-form-label" for="nome">Nome</label>
            <div class="col-sm-10">
              <input type="text" id="nome" class="form-control" placeholder="Nome completo" v-model="nome" autocomplete="off">
            </div>
            <span class="help-block" v-if="has_error && errors.nome">{{ errors.nome }}</span>
        </div>

        <div class="form-group row" v-bind:class="{ 'has-error': has_error && errors.email }">
            <label class="col-sm-2 col-form-label" for="email">E-mail</label>
            <div class="col-sm-10">
              <input type="email" id="email" class="form-control" placeholder="example@example.com" v-model="email" autocomplete="off">
            </div>
            <span class="help-block" v-if="has_error && errors.email">{{ errors.email }}</span>
        </div>

        <div class="form-group row" v-bind:class="{ 'has-error': has_error && errors.password }">
            <label class="col-sm-2 col-form-label" for="password">Password</label>
            <div class="col-sm-10">
              <input type="password" id="password" class="form-control" placeholder="Terá de possuir no mínimo 3 dígitos" v-model="password" autocomplete="off">
            </div>
            <span class="help-block" v-if="has_error && errors.password">{{ errors.password }}</span>
        </div>

        <div class="form-group row" v-bind:class="{ 'has-error': has_error && errors.password }">
            <label class="col-sm-2 col-form-label" for="password_confirmation">Confirmação da password</label>
            <div class="col-sm-10">
              <input type="password" id="password_confirmation" class="form-control" placeholder="Terá de possuir no mínimo 3 dígitos" v-model="password_confirmation" required>
            </div>
        </div>

        <div class="form-group row" v-bind:class="{ 'has-error': has_error && errors.morada }">
            <label class="col-sm-2 col-form-label" for="morada">Morada</label>
            <div class="col-sm-10">
              <input type="text" id="morada" class="form-control" placeholder="Morada" v-model="morada">
            </div>
            <span class="help-block" v-if="has_error && errors.morada">{{ errors.morada }}</span>
        </div>

        <div class="form-group row" v-bind:class="{ 'has-error': has_error && errors.NIF }">
            <label class="col-sm-2 col-form-label" for="NIF">NIF</label>
            <div class="col-sm-10">
              <input type="text" id="NIF" class="form-control" placeholder="NIF" v-model="NIF">
            </div>
            <span class="help-block" v-if="has_error && errors.NIF">{{ errors.NIF }}</span>
        </div>

        <div class="form-grou row" v-bind:class="{ 'has-error': has_error && errors.nmr_telefone }">
            <label class="col-sm-2 col-form-label" for="nmr_telefone">Número de telemóvel/telefone</label>
            <div class="col-sm-10">
              <input type="text" id="nmr_telefone" class="form-control" placeholder="Número de telemóvel/telefone" v-model="nmr_telefone">
            </div>
            <span class="help-block" v-if="has_error && errors.nmr_telefone">{{ errors.nmr_telefone }}</span>
        </div>

        <div v-if="type == 'comercial'">
          <div class="form-group row" v-bind:class="{ 'has-error': has_error && errors.ramo }">
            <label class="col-sm-2 col-form-label" for="ramo">Área de negócio</label>
            <div class="col-sm-10">
              <input type="text" id="ramo" class="form-control" placeholder="e.g. restauração, hotelaria, venda de eletrodomésticos" v-model="ramo">
            </div>
            <span class="help-block" v-if="has_error && errors.ramo">{{ errors.ramo }}</span>
          </div>
        </div>

        <div v-else-if="type == 'profissional'">

          <div class="form-group row" v-bind:class="{ 'has-error': has_error && errors.especialidade }">
              <label class="col-sm-2 col-form-label" for="especialidade">Especialidade</label>
              <div class="col-sm-10">
                <select id='especialidade' class="form-control" v-model="especialidade">
                    <option value='eletricidade'>Eletricista</option>
                    <option value='construcao'>Construtor</option>
                    <option value='canalizacao'>Canalizador</option>
                    <option value='carpintaria'>Carpinteiro</option>
                </select>
              </div>
              <span class="help-block" v-if="has_error && errors.especialidade">{{ errors.especialidade }}</span>
          </div>


          <div class="form-group row" v-bind:class="{ 'has-error': has_error && errors.preco_hora }">
            <label class="col-sm-2 col-form-label" for="preco_hora">Preço / Hora</label>
            <div class="col-sm-10">
              <input type="text" id="preco_hora" v-model="preco_hora" class="form-control" placeholder="e.g 12" name="preco_hora" min="1">
            </div>
            <span class="help-block" v-if="has_error && errors.preco_hora">{{ errors.preco_hora }}</span>
          </div>
          
          <div class="form-group row" v-bind:class="{ 'has-error': has_error && errors.descricao }">
            <label class="col-sm-2 col-form-label" for="descricao">Descrição</label>
            <div class="col-sm-10">
              <input type="text" id="descricao" class="form-control" placeholder="Descrição do seu perfil" v-model="descricao">
            </div>
            <span class="help-block" v-if="has_error && errors.descricao">{{ errors.descricao }}</span>
          </div>

           <div class="form-group row" v-bind:class="{ 'has-error': has_error && errors.equipamento }">
            <label class="col-sm-2 col-form-label" for="equipamento">Equipamento disponivel</label>
            <div class="col-sm-10">
              
              <div v-on:click="addEquipamento(equip_input)">
                <input type="text" id="equipamento" placeholder="e.g. rebarbadora, martelo.." v-model="equip_input">
                  <img width="30" height="30" src="add.png" alt="add" />
              </div>
            </div>
            <span class="help-block" v-if="has_error && errors.equipamento">{{ errors.equipamento }}</span>
          </div>

          <div v-if="!equipamento.lengh">
            <h4 v-for="(value, index) in equipamento" v-bind:key="index">
              <b> {{ value }} </b>
              <img width="30" height="30" src="remove.png" alt="remove" @click="remEquipamento(index)"/>
            </h4>
          </div>

        </div>

        <br>

        <button type="submit" class="btn btn-outline-primary btn-lg float-right">Registar</button>
      </form>
    </div>
  </div>
</template>

<script>

//MUDAR EQUIPAMENTO PARA ARRAY DE STRINGS
export default {
  name: "RegisterPage",

  data() {
    return {
      nome: "",
      email: "",
      equip_input: "",
      password: "",
      password_confirmation: '',
      morada: "",
      NIF: "",
      nmr_telefone: "",
      especialidade: "",
      preco_hora: "",
      equipamento: [],
      ramo: "",
      descricao: "",
      tipo: "",
      has_error: false,
      error: '',
      errors: {},
      success: false
    };
  },
  props: {
    type: String
  },

  components: {},

  methods: {
    addEquipamento: function(equip_input) {
      if (equip_input) {
        this.equipamento.push(equip_input);
        this.equip_input = "";
      }
    },
    remEquipamento: function(index) {
      this.equipamento.splice(index, 1);
    },
    register() {
      this.$auth.register({
        data: {
          tipo: this.type,
          nome: this.nome,
          email: this.email,
          password: this.password,
          password_confirmation: this.password_confirmation,
          morada: this.morada,
          nmr_telefone: this.nmr_telefone,
          especialidade: this.especialidade,
          preco_hora: this.preco_hora,
          ramo: this.ramo,
          descricao: this.descricao,
          NIF: this.NIF,
          equipamento: this.equipamento
        },
        success: function () {
          this.success = true
          this.$router.push({name: 'login', params: {successRegistrationRedirect: true}})
        },
        error: function (res) {
          console.log(res.response.data.errors)
          this.has_error = true
          this.error = res.response.data.error
          this.errors = res.response.data.errors || {}
        }
      })
    }
  }
};
</script>