<template>
  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
    <form class="space-y-6" @submit.prevent="handelLogin">
      <div v-if="errors.unauth" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
           role="alert">
        <span class="block sm:inline">Invalid email or password.</span>
      </div>
      <div>
      <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
        <div class="mt-2">
          <input id='email' v-model="email" type="email" class="block w-full rounded-md border-0 px-2 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
        </div>
        <p v-if="errors.email" class="text-red-700">{{errors.email}}</p>
      </div>
      <div>
        <div class="flex items-center justify-between">
          <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
        </div>
        <input id="password" v-model="password" type="password" class="block w-full rounded-md border-0 px-2 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
        <p v-if="errors.password" class="text-red-700">{{errors.password}}</p>
      </div>
      <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Log In</button>
      <div class="text-right text-sm">
        <router-link to="/signup" class="font-semibold text-indigo-600 hover:text-indigo-500">Don't have an account?</router-link>
      </div>
    </form>
  </div>
</template>

<script>
import ButtonAdd from "@/components/UI/ButtonAdd.vue";
import axios from "axios";
import { BASE_URL } from '@/config.js';

export default {
  name: 'login-form',

  components: {ButtonAdd},
  data() {
    return {
      email: '',
      password: '',
      errors: {
        unauth: null,
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
        if(!this.email)
          this.errors.email = 'Email is required';
        if(!this.password)
          this.errors.password = 'Password is required';
        return;
      }

      response = await axios.post(`${BASE_URL}/v1/auth/login`, {
        email: this.email,
        password: this.password
      })
      localStorage.setItem('token', response.data.token)
      return response.data.token;
    },
    async handelLogin() {
      try {
        const token = await this.login();

        this.$store.dispatch('login', token)

        if (!this.errors.email && !this.errors.password) {
          this.$router.push('/');
        }
      } catch (error) {
        this.errors.unauth = 'Unauthorized';
        console.error('Login failed:', error);
      }
    }
  }
}
</script>

<style scoped>

</style>