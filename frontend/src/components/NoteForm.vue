<template>
  <div>
    <form @submit.prevent>
      <h3>Creating Note</h3>
      <input
          v-model="note.title"
          class="input"
          type="text"
          placeholder="Title"
      />
      <input
          v-model="note.body"
          class="input"
          type="text"
          placeholder="Description"
      />
      <button
          @click="createNote"
          style="align-self: flex-end; margin-top: 15px;"
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
        body: '',
      }
    }
  },
  methods: {
    createNote() {
      this.$emit('create', this.note)
      this.note = {
        title: '',
        body: '',
      }
    }
  }
}
</script>

<style scoped>

</style>