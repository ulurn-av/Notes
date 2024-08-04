<template>
  <div>
    <button>
      <slot></slot>
    </button>
  </div>
</template>

<script>
export default {
  name: "button-add",

}
</script>

<style scoped>
button {
  background-color: lightslategray;
  border: none;
  padding: 10px;
  width: 50px;
  height: 50px;
  cursor: pointer;
  border-radius: 1000px;
  color: black;
  font-size: 20px;
  font-weight: bold;
  transition: transform 0.2s ease-in-out;
}

@media (prefers-color-scheme: dark) {
  button {
    background-color: lightslategray;
  }
}

button:hover {
  transform: scale(1.05);
  background-color: lightgoldenrodyellow;
}

button:active {
  transform: scale(0.95);
  background-color: lightslategray;
}
</style>