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
import axios from 'axios';
import ButtonAdd from "@/components/UI/ButtonAdd.vue";
import ListCards from "@/components/ListCards.vue";
import InputSearch from "@/components/UI/InputSearch.vue";

export default {
  components: {ButtonAdd, ListCards, InputSearch},
  data() {
    return {
      isLoading: false,
      querySearch: '',
      placeholderSearch: "Search your note...",
      notes: []
    }
  },
  methods: {
    async fetchNotes() {
      this.isLoading = true

      try {
        const response = await axios.get('http://localhost:8080/v1/notes', {
          headers: {
            'Content-Type': 'application/json'
          }
        })
        this.notes = response.data
      } catch (error) {
        if (error.response) {
          console.error('Response error:', error.response.data);
        } else if (error.request) {
          console.error('Request error:', error.request);
        } else {
          console.error('Error:', error.message);
        }
      } finally {
        this.isLoading = false
      }
    }
  },
  mounted() {
    this.fetchNotes();
  },
  computed: {
    searchedNotes() {
      console.log(this.notes)
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

.header-of-notes {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
</style>