<template>
  <div>
    <div class="container">
      <header class="header-of-notes">
        <h1>Notes</h1>
        <button>+</button>
      </header>
      <div class="cards-container">
        <div v-for="note in notes" v-if="notes.length > 0" class="card">
          <p class="card-delete">x</p>
          <p class="card-title">{{ note.title }}</p>
          <p class="card-text">{{ note.body }}</p>
          <p class="card-date">{{ note.date }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      notes: [
        {title: 't', body: 'sdf', date: '24-07-23'},
        {title: 'title', body: 'body', date: '24-07-23'},
        {title: 't', body: 'sdf', date: '24-07-23'},
        {title: 'title', body: 'body', date: '24-07-23'},
        {title: 't', body: 'sdf', date: '24-07-23'},
        {title: 'title', body: 'body', date: '24-07-23'},
      ]
    }
  }
}
</script>

<style scoped>

h1 {
  font-weight: bold;
  margin-bottom: 25px;
  font-size: 75px;
}

h1:hover {
  color: blueviolet;
  transition: color 0.2s ease;
}

header button {
  border: none;
  padding: 10px;
  width: 50px;
  height: 50px;
  cursor: pointer;
  background-color:rgb(21, 20, 20);
  border-radius: 1000px;
  color: white;
  font-size: 20px;
  font-weight: bold;
  transition: transform 0.2s ease-in-out;
}

@media (prefers-color-scheme: dark) {
  header button {
    background-color: gray;
  }
}

header button:hover {
  transform: scale(1.05);
  background-color: blueviolet;
}

header button:active {
  transform: scale(0.95);
  background-color: gray;
}

.container {
  max-width: 1000px;
  padding: 30px;
  margin: 0 auto;
}

.cards-container {
  display: flex;
  flex-wrap: wrap;
}

.header-of-notes{
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.card {
  width: 225px;
  height: 225px;
  background-color: gray;
  padding: 10px;
  border-radius: 15px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  margin-right: 20px;
  margin-bottom: 20px;
  position: relative;
  overflow: hidden;
  transition: transform 0.2s ease-in-out, background-color 0.2s ease-in-out;
}

.card:hover {
  transform: scale(1.02);
  background-color: lightyellow;
}

.card:active {
  transform: scale(0.98);
  background-color: lightgoldenrodyellow;
}

.card-delete {
  position: absolute;
  bottom: 5px;
  right: 5px;
  background-color: transparent;
  color: rgb(70, 52, 52);
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

.card-date {
  font-size: 12.5px;
  margin-top: auto;
  font-weight: 500;
  color: black;
}

</style>