<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
            <h2><div class="card-header">Conversas</div></h2>
            <div class="card-body">
              <conversasComponent></conversasComponent>
            </div>
          </div>
      </div>
    </div>
  </div>
</template>

<script>
  import conversasComponent from './Conversas.vue'

  export default {
    data() {
      return {
        //
      }
    },
    components: {
      conversasComponent
    }
  }
</script>