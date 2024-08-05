<template>
  <div>
    <register-form></register-form>
    <login-form></login-form>
  </div>
</template>

<script>
import RegisterForm from "@/components/RegisterForm.vue";
import LoginForm from "@/components/LoginFrom.vue";

export default {
  components: {LoginForm, RegisterForm}

}
</script>

<style scoped>

</style>