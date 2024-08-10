<template>
  <div>
    <div class="mx-auto max-w-screen-xl px-4 md:px-8 gap-8 flex flex-col py-14">
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
      <modal-window
          v-model:show="isEditingNote"
      >
        <edit-form
            :note="{...editingNote}"
            @cancelEdit="cancelEditNote"
            @savedNote="savedEditNote"
        >
        </edit-form>

      </modal-window>
      <header class="container mx-auto flex h-16 items-center px-12">
        <h1 class="mb-4 text-5xl font-bold tracking-tight text-foreground container py-14">
          <span class="hover:text-indigo-600">
            Notes
          </span>
        </h1>
        <InputSearch
          class="m-4"
          v-model="querySearch"
          :placeholder-search="placeholderSearch"
        />
        <button-add
          @click="showModal"
          class="m-4"
        >
          +
        </button-add>
      </header>
      <ListCards :notes="searchedNotes" @remove="activateRemoveNote" @edit="showEditNote"/>
    </div>
  </div>
</template>

<script>
import { BASE_URL } from '@/config.js';
import axios from 'axios';
import ButtonAdd from "@/components/UI/ButtonAdd.vue";
import ListCards from "@/components/ListCards.vue";
import InputSearch from "@/components/UI/InputSearch.vue";
import ModalWindow from "@/components/UI/ModalWindow.vue";
import NoteForm from "@/components/NoteForm.vue";
import RemoveNoteForm from "@/components/RemoveNoteForm.vue";
import EditForm from "@/components/EditForm.vue";

export default {
  components: {EditForm, RemoveNoteForm, NoteForm, ModalWindow, ButtonAdd, ListCards, InputSearch},
  data() {
    return {
      isLoading: false,
      querySearch: '',
      placeholderSearch: "Search your note...",
      notes: [],
      isShowingModal: false,
      isRemovingNote: false,
      isEditingNote: false,
      removingNote: () => {},
      editingNote: () => {},
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
        const response = await axios.get(`${BASE_URL}/v1/notes`, {
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
        const response = await axios.post(`${BASE_URL}/v1/notes`,
            {
              title: note.title,
              content: note.content,
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
        const response = await axios.delete(`${BASE_URL}/v1/notes/${this.removingNote.id}`, {
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
    },
    showEditNote(note) {
      this.isEditingNote = true;
      this.editingNote = note;
    },
    cancelEditNote() {
      this.isEditingNote = false;
      this.editingNote = {};
    },
    async savedEditNote(note){
      try {
        const response = await axios.put(`${BASE_URL}/v1/notes/${note.id}`,
            {
              title: note.title,
              content: note.content,
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
      this.isEditingNote = false;
      this.editingNote = {};
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
</style>