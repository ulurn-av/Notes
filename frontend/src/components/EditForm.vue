<template>
  <div class="p-6 max-w-2xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
    <div class="px-6 py-4">
      <h3 class="text-lg font-semibold leading-7 text-gray-900">Note Information</h3>
    </div>
    <div class="border-t border-gray-100">
      <dl class="divide-y divide-gray-100">
        <div class="px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4">
          <div>
            <dt class="text-sm font-medium leading-6 text-gray-900">Title</dt>
            <p v-if="error.title" class="text-red-600">{{error.title}}</p>
          </div>
          <input
            v-model="note.title"
            type="text"
            class="border rounded p-2 w-full"
          />
        </div>
        <div class="px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4">
          <div>
            <dt class="text-sm font-medium leading-6 text-gray-900">Content</dt>
            <p v-if="error.content" class="text-red-600">{{error.content}}</p>
          </div>
          <input
            v-model="note.content"
            type="text"
            class="border rounded p-2 w-full"
          />
        </div>
        <div class="px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4">
          <dt class="text-sm font-medium leading-6 text-gray-900">Created at</dt>
          <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{note.created_at}}</dd>
        </div>
        <div class="px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4">
          <dt class="text-sm font-medium leading-6 text-gray-900">Updated at</dt>
          <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{note.updated_at}}</dd>
        </div>
      </dl>
    </div>
    <div class="pt-2 text-right">
      <button @click="resultForm" class="inline-flex items-center rounded-md text-white bg-indigo-600 mx-1 px-3 py-2 text-sm font-semibold shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-indigo-500">
        Saved
      </button>
      <button @click="$emit('cancelEdit')" class="inline-flex items-center rounded-md bg-white mx-1 px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
        Cancle
      </button>
    </div>
  </div>
</template>

<script>
import ButtonAdd from "@/components/UI/ButtonAdd.vue";

export default {
  components: {ButtonAdd},
  props: {
    note: {
      type: Object,
      default: () => {}
    }
  },
  data() {
    return {
      error: {
        title: '',
        content: ''
      }
    }
  },
  methods: {
    resultForm() {
      if (this.validate()) {
        this.$emit('savedNote', this.note);
      }
    },
    validate() {
      this.error = {
        title: '',
        content: ''
      }
      if (!this.note.title) {
        this.error.title = 'Title is required';
      }
      if (!this.note.content) {
        this.error.content = 'Content is required';
      }
      return !this.error.title && !this.error.content;
    }
  }
}
</script>

<style scoped>

</style>