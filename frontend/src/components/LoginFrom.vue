<template>
  <div>
    <form @submit.prevent="login">
      <input v-model="email" placeholder="email..."/>
      <input v-model="password" placeholder="password..." type="password"/>
      <button type="submit">Log In</button>
    </form>
  </div>
</template>

<script>
import ButtonAdd from "@/components/UI/ButtonAdd.vue";
import axios from "axios";

export default {
  name: 'login-form',

  components: {ButtonAdd},
  data() {
    return {
      email: '',
      password: '',
    }
  },
  methods: {
    async login(){
      let response;

      try{
        response = await axios.post('http://localhost:8080/v1/auth/login', {
          email: this.email,
          password: this.password
        })
      } catch (error){
        console.error('Error registering:', error);
      }
      localStorage.setItem('token', response.data.token)
    }
  }
}
</script>

<style scoped>

</style>