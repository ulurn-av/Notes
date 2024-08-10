<template>
  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
    <form class="space-y-6" @submit.prevent="handleSignup">
      <div v-if="errors.matchingOrTaken" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
           role="alert">
        <span class="block sm:inline">{{errors.matchingOrTaken}}</span>
      </div>
      <div>
      <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
        <div class="mt-2">
          <input id='email' v-model="email" type="email" class="block w-full rounded-md border-0 px-2 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
          <p v-if="errors.email" class="text-red-700">{{errors.email}}</p>
        </div>
      </div>
      <div>
        <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">First name</label>
        <div class="mt-2">
          <input id="first-name" v-model="first_name" class="block w-full rounded-md border-0 px-2 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
          <p v-if="errors.first_name" class="text-red-700">{{errors.first_name}}</p>
        </div>
      </div>
      <div>
        <label for="last-name" class="block text-sm font-medium leading-6 text-gray-900">Last name</label>
        <div class="mt-2">
          <input id="last-name" v-model="last_name" class="block w-full rounded-md border-0 px-2 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
          <p v-if="errors.last_name" class="text-red-700">{{errors.last_name}}</p>
        </div>
      </div>
      <div>
        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
        <div class="mt-2">
          <input id="password" v-model="password" type="password" class="block w-full rounded-md border-0 px-2 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
          <p v-if="errors.password" class="text-red-700">{{errors.password}}</p>
        </div>
      </div>
      <div>
        <label for="retype-password" class="block text-sm font-medium leading-6 text-gray-900">Retype password</label>
        <div class="mt-2">
          <input id="retype-password" v-model="rePassword" type="password" class="block w-full rounded-md border-0 px-2 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
          <p v-if="errors.rePassword" class="text-red-700">{{errors.rePassword}}</p>
        </div>
      </div>
      <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign Up</button>
      <div class="text-right text-sm">
        <router-link to="/login" class="font-semibold text-indigo-600 hover:text-indigo-500">Already have an account?</router-link>
      </div>
    </form>
  </div>
</template>

<script>
import axios from "axios";
import { BASE_URL } from '@/config.js';

export default {
  name: 'register-form',
  data() {
    return {
      email: '',
      first_name: '',
      last_name: '',
      password: '',
      rePassword: '',
      errors: {
        email: null,
        first_name: null,
        last_name: null,
        password: null,
        rePassword: null,
        matchingOrTaken: null,
      }
    }
  },
  methods: {
    async register() {
      return await axios.post(`${BASE_URL}/v1/auth/signup`, {
        email: this.email,
        password: this.password,
        first_name: this.first_name,
        last_name: this.last_name
      });
    },
    async handleSignup() {
      this.errors.email = null;
      this.errors.password = null;
      this.errors.first_name = null;
      this.errors.last_name = null;
      this.errors.rePassword = null;
      this.errors.matchingOrTaken = null;

      if(!this.email || !this.password || !this.first_name || !this.last_name || !this.rePassword){
        if(!this.email)
          this.errors.email = 'Email is required';
        if(!this.password)
          this.errors.password = 'Password is required';
        if(!this.first_name)
          this.errors.first_name = 'First name is required';
        if(!this.last_name)
          this.errors.last_name = 'Last name is required';
        if(!this.rePassword)
          this.errors.rePassword = 'Retype password is required';
        return;
      }

      if(this.password.length < 8){
        this.errors.password = 'Password must be at least 8 characters';
        return;
      }

      if (this.password !== this.rePassword) {
        this.errors.matchingOrTaken = 'Passwords do not match';
        return;
      }
      try{
        const response = await this.register();
        this.$router.push('/login');
      } catch (error){
        this.errors.matchingOrTaken = 'Email is already taken';
      }
    }
  }
}
</script>

<style scoped>

</style>