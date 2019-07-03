<template>

<div class="conversa">
    <ul>
        <li><a <router-link class="user" v-bind:to="{ path: `/chat/${conversa.conversa_id}` }"> {{conversa.user.nome }} </router-link></a></li>
    </ul>
</div>

</template>

<style scoped>   
    li {
      font: 200 20px/1.5 Helvetica, Verdana, sans-serif;
      border-bottom: 1px solid #ccc;
    }
     
    li:last-child {
      border: none;
    }

    ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
    }
     
    li a {
      text-decoration: none;
      color: #000;
      display: block;
      width: 200px;
     
      -webkit-transition: font-size 0.3s ease, background-color 0.3s ease;
      -moz-transition: font-size 0.3s ease, background-color 0.3s ease;
      -o-transition: font-size 0.3s ease, background-color 0.3s ease;
      -ms-transition: font-size 0.3s ease, background-color 0.3s ease;
      transition: font-size 0.3s ease, background-color 0.3s ease;
    }
     
    li a:hover {
      font-size: 30px;
      background: #fffff;
    }  
</style>

<script>
    export default {
        props: ['conversa'], 
    }
</script>

