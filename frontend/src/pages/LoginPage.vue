<template>
  <div>
    <login-form></login-form>
    <p>Don't have an account?</p>
    <router-link to="/signup">Signup</router-link>
  </div>
</template>

<script>
import LoginForm from "@/components/LoginFrom.vue";

export default {
  components: {LoginForm}

}
</script>

<style scoped>

</style>