<template>
  <div>
    <form @submit.prevent="handelLogin">
      <div>
        <input v-model="email" placeholder="email..."/>
        <p v-if="errors.email">{{errors.email}}</p>
      </div>
      <div>
        <input v-model="password" placeholder="password..." type="password"/>
        <p v-if="errors.password">{{errors.password}}</p>
      </div>
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
      errors: {
        email: null,
        password: null,
      },
    }
  },
  methods: {
    async login(){
      this.errors.email = null;
      this.errors.password = null;
      let response;

      if(!this.email || !this.password){
        this.errors.email = 'Email is required';
        this.errors.password = 'Password is required';
        return;
      }

      response = await axios.post('http://localhost:8080/v1/auth/login', {
        email: this.email,
        password: this.password
      })
      localStorage.setItem('token', response.data.token)
    },
    async handelLogin() {
      try {
        await this.login();
        if (!this.errors.email && !this.errors.password) {
          this.$router.push('/');
        }
      } catch (error) {
        console.error('Login failed:', error);
      }
    }
  }
}
</script>

<style scoped>

</style>