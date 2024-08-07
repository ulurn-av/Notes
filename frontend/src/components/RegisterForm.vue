<template>
  <div>
    <form @submit.prevent="register">
      <input v-model="email" placeholder="Your email..." />
      <input v-model="first_name" placeholder="Your name..."/>
      <input v-model="last_name" placeholder="Your last name..."/>
      <input v-model="password" placeholder="Type your password..."/>
      <button type="submit">Signup</button>
    </form>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: 'register-form',
  data() {
    return {
      email: '',
      first_name: '',
      last_name: '',
      password: '',
    }
  },
  methods: {
    async register() {
      try {
        const response = await axios.post('http://localhost:8080/v1/auth/signup', {
          email: this.email,
          password: this.password,
          first_name: this.first_name,
          last_name: this.last_name
        });

        if (response.data.status === 'success') {
          console.log(response.data.message);
        } else {
          console.error(response.data.message);
        }
      } catch (error) {
        console.error('Error registering:', error);
      }
    }
  }
}
</script>

<style scoped>

</style>