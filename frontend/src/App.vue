<template>
  <div>
    <div class="container">
      <header class="header-of-notes">
        <h1>Notes</h1>
        <InputSearch
          v-model="querySearch"
          :placeholder-search="placeholderSearch"
        />
        <button-add>+</button-add>
      </header>
      <ListCards :notes="searchedNotes"/>
    </div>
  </div>
</template>

<script>
import ButtonAdd from "@/components/UI/ButtonAdd.vue";
import ListCards from "@/components/ListCards.vue";
import InputSearch from "@/components/UI/InputSearch.vue";

export default {
  components: {ButtonAdd, ListCards, InputSearch},
  data() {
    return {
      querySearch: '',
      placeholderSearch: "Search your note...",
      notes: [
        {title: 't fd', body: 'sdf', date: '24-07-23'},
        {title: 'title', body: 'body', date: '24-07-23'},
        {title: 't', body: 'sdf', date: '24-07-23'},
        {title: 'title', body: 'body', date: '24-07-23'},
        {title: 't', body: 'sdf', date: '24-07-23'},
        {title: 'title', body: 'body', date: '24-07-23'},
      ]
    }
  },
  computed: {
    searchedNotes() {
      return this.notes.filter(note => (note.body.toLowerCase().includes(this.querySearch.toLowerCase())
      || (note.title.toLowerCase().includes(this.querySearch.toLowerCase()))
      ))
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
  color: lightgoldenrodyellow;
  transition: color 0.2s ease;
}

.container {
  max-width: 1000px;
  padding: 30px;
  margin: 0 auto;
}

.header-of-notes{
  display: flex;
  justify-content: space-between;
  align-items: center;
}
</style>