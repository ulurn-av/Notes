<template>
  <div class="mx-auto grid w-full justify-center gap-8 lg:grid-cols-3 sm:grid-cols-2">
    <CardNote
        v-for="note in notes"
        :note="note"
        @remove="removeCard"
        @edit="$emit('edit', note)"
    >
    </CardNote>
  </div>
</template>

<script>
import CardNote from "@/components/CardNote.vue";

export default {
  props: {
    notes: {
      type: Array,
      required: true,
    }
  },
  methods: {
    removeCard(note) {
      this.$emit('remove', note);
    }
  },
  components: {
    CardNote,
  }
}
</script>

<style scoped>
</style>