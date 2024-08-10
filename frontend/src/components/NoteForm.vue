<template>
  <div class="max-w-md mx-auto bg-white shadow-lg rounded-lg p-6">
    <form @submit.prevent class="flex flex-col space-y-4">
      <h3 class="text-xl font-semibold text-gray-800">Creating Note</h3>
      <div>
        <input
          v-model="note.title"
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
          type="text"
          placeholder="Title"
        />
        <p v-if="errors.title" class="text-red-600">{{errors.title}}</p>
      </div>
      <div>
        <textarea
          v-model="note.content"
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
          placeholder="Description"
          rows="4"
        ></textarea>
        <p v-if="errors.content" class="text-red-600">{{errors.content}}</p>
      </div>

      <button
        @click="createNote"
        type="submit"
        class="self-end bg-indigo-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500"
      >
        Create
      </button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      note: {
        title: '',
         content: '',
      },
      errors: {
        title: '',
        content: ''
      }
    }
  },
  methods: {
    validate() {
      this.errors = {
        title: this.note.title ? '' : 'Title is required',
        content: this.note.content ? '' : 'Content is required'
      }
      return !this.errors.title && !this.errors.content
    },
    createNote() {
      if(this.validate()){
       this.$emit('create', this.note)
        this.note = {
          title: '',
          content: '',
        }
      }
    }
  }
}
</script>
