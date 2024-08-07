<template>
  <div>
    <form @submit.prevent>
      <h3>Do you want to remove this note?</h3>
      <button
          @click="removeNote"
          style="align-self: flex-end; margin-top: 15px;"
      >
        Yes
      </button>
      <button
          style="align-self: flex-end; margin-top: 15px;"
          @click="breakRemove"
      >
        No
      </button>
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