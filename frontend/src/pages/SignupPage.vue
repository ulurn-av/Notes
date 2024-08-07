<template>
  <div>
    <RegisterForm></RegisterForm>
    <p>Already have an account?</p>
    <router-link to="/login">Login</router-link>
  </div>
</template>

<script>
import RegisterForm from "@/components/RegisterForm.vue";

export default {
  components: {RegisterForm}

}
</script>

<style scoped>

</style>