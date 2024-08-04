<template>
  <div class="cards-container">
    <CardNote
        v-for="note in notes"
        class="card"
        :note="note"
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

  components: {
    CardNote,
  }
}
</script>

<style scoped>

.cards-container {
  display: flex;
  flex-wrap: wrap;
}

.card {
  width: 225px;
  height: 225px;
  background-color: lightslategray;
  padding: 10px;
  border-radius: 15px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  margin-right: 20px;
  margin-bottom: 20px;
  position: relative;
  overflow: hidden;
  transition: transform 0.2s ease-in-out, background-color 0.2s ease-in-out;
}

.card:hover {
  transform: scale(1.02);
  background-color: lightyellow;
}

.card:active {
  transform: scale(0.98);
  background-color: lightgoldenrodyellow;
}
</style>