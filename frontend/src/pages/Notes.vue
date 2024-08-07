<template>
  <div>
    <div class="container">
      <header class="header-of-notes">
        <h1>Notes</h1>
        <InputSearch
          v-model="querySearch"
          :placeholder-search="placeholderSearch"
        />
        <button-add @click="showModal">+</button-add>
      </header>
      <ListCards :notes="searchedNotes" @remove="activateRemoveNote"/>
    </div>
    <modal-window v-model:show="isShowingModal">
      <note-form
          @create="createNote"
      >
      </note-form>
    </modal-window>
    <modal-window
        v-model:show="isRemovingNote"
    >
      <remove-note-form
          @remove="removeNote"
          @break="disableRemoveNote"
          :note="removeNote"
      >
      </remove-note-form>
    </modal-window>
  </div>
</template>

<script>
import axios from 'axios';
import ButtonAdd from "@/components/UI/ButtonAdd.vue";
import ListCards from "@/components/ListCards.vue";
import InputSearch from "@/components/UI/InputSearch.vue";
import ModalWindow from "@/components/UI/ModalWindow.vue";
import NoteForm from "@/components/NoteForm.vue";
import RemoveNoteForm from "@/components/RemoveNoteForm.vue";

export default {
  components: {RemoveNoteForm, NoteForm, ModalWindow, ButtonAdd, ListCards, InputSearch},
  data() {
    return {
      isLoading: false,
      querySearch: '',
      placeholderSearch: "Search your note...",
      notes: [],
      isShowingModal: false,
      isRemovingNote: false,
      removingNote: () => {},
    }
  },
  methods: {
    showModal() {
      this.isShowingModal = true;
    },
    async fetchNotes() {
      this.isLoading = true
      const token = localStorage.getItem('token');

      try {
        const response = await axios.get('http://localhost:8080/v1/notes', {
          headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${token}`,
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
    },
    async createNote(note) {
      try {
        const response = await axios.post('http://localhost:8080/v1/notes',
            {
              title: note.title,
              content: note.body,
            },
            {
              headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${localStorage.getItem('token')}`,
              }
            }
        )
      } catch (error) {
        console.error('Error:', error.message);
      }
      this.isShowingModal = false;
      await this.fetchNotes();
    },
    activateRemoveNote(note) {
      this.removingNote = note;
      this.isRemovingNote = true;
    },
    disableRemoveNote() {
      this.removingNote = {};
      this.isRemovingNote = false;
    },
    async removeNote() {
      try {
        const response = await axios.delete(`http://localhost:8080/v1/notes/${this.removingNote.id}`, {
          headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${localStorage.getItem('token')}`,
          }
        })
      } catch (error) {
        console.error('Error:', error.message);
      }
      this.isRemovingNote = false;
      await this.fetchNotes();
    }
  },
  mounted() {
    this.fetchNotes();
  },
  computed: {
    searchedNotes() {
      return this.notes.filter(note => (note.content.toLowerCase().includes(this.querySearch.toLowerCase())
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