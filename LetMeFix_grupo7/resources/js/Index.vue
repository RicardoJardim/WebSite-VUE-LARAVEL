<template>
    <div id="main">
        <header id="header">
          <navigationMenu></navigationMenu>
        </header>
        <div id="content">
            <router-view></router-view>
        </div>
    </div> 
</template>

<style>
  h2 {
    font: 400 30px/1.5 Helvetica, Verdana, sans-serif;
    margin: 0;
    padding: 0;
    justify-content: "center";
  }
</style>


<script>
  import navigationMenu from './components/Menu.vue'
  export default {
    data() {
      return {
        //
      }
    },
    components: {
      navigationMenu
    }
  }
</script>
