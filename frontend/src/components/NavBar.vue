<template>
  <div>
    <div class="navbar">
      <p class="btn">Account</p>
      <p class="btn">Login</p>
      <p class="btn">Logout</p>
    </div>
  </div>
</template>

<script>
export default {

}
</script>

<style scoped>

.navbar {
  height: 60px;
  background-color: gray;
  display: flex;
  justify-content: flex-end;      /* Центрируем по горизонтали */
  align-items: center;
}

.btn {
  display: flex;
  font-weight: bold;
  background-color: transparent;
  color: black;
  border: none;
  font-size: 20px;
  cursor: pointer;
  transition: transform 0.2s ease-in-out;
  padding: 10px;
}

.btn:hover {
  color: lightgoldenrodyellow;
  transition: color 0.2s ease;
  transform: scale(1.02);
}

</style>