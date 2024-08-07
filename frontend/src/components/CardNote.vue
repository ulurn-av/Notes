<template>
  <div>
    <p class="card-delete">x</p>
    <p class="card-title">{{ note.title }}</p>
    <p class="card-text">{{ note.content }}</p>
    <p class="card-date">{{ note.created_at }}</p>
  </div>
</template>

<script>
export default {
  props: {
    note: {
      type: Object,
      default: () => {}
    }
  }
}
</script>

<style scoped>

.card-delete {
  position: absolute;
  bottom: 5px;
  right: 5px;
  background-color: transparent;
  color: black;
  border: none;
  font-size: 20px;
  cursor: pointer;
  font-weight: 600;
  margin-right: 5px;
  transition: transform 0.2s ease-in-out;
}

.card-delete:hover {
  transform: scale(1.01);
  color: red;
}

.card-delete:active {
  transform: scale(0.9);
  color: darkred;
}

.card-title {
  line-height: 1.5;
  font-size: 22px;
  font-weight: bold;
  color: black;
}

.card-text {
  line-height: 1.2;
  font-size: 14px;
  word-wrap: break-word;
  white-space: normal;
  color: black;
}

@media (prefers-color-scheme: dark) {
  .card-text {
    color: black;
  }
  .card-title {
    color: black;
  }
}

.card-date {
  font-size: 12.5px;
  margin-top: auto;
  font-weight: 500;
  color: black;
}
</style>