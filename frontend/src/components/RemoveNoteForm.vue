<template>
  <div>
    <form @submit.prevent class="bg-white shadow-md rounded-lg p-6 space-y-4">
      <h3 class="text-lg font-semibold text-gray-900">Do you want to remove this note?</h3>
      <div class="flex justify-end space-x-4">
        <button
          @click="removeNote"
          type="button"
          class="inline-flex items-center rounded-md bg-red-600 text-white px-3 py-2 text-sm font-semibold shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-red-500"
        >
          Yes
        </button>
        <button
          @click="breakRemove"
          type="button"
          class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-indigo-500 hover:text-white"
        >
          No
        </button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  props: {
    note: {
      type: Object,
      required: true
    }
  },
  methods: {
    removeNote() {
      this.$emit('remove', this.note)
    },
    breakRemove() {
      this.$emit('break')
    }
  }
}
</script>

<style scoped>

</style>