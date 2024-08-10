<template>
  <div class="shadow-md relative flex flex-col gap-8 overflow-hidden p-4 text-black dark:text-white border rounded-2xl h-full">
    <p @click="removeCard" class="card-delete">x</p>
    <div class="lg:flex lg:items-center lg:justify-between">
      <p class="font-bold text-base leading-5 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">{{ note.title }}</p>
      <div class="mt-5 flex lg:ml-4 lg:mt-0">
        <button @click="$emit('edit')" type="button" class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-indigo-500 hover:text-white">
          <PencilIcon class="-ml-0.5 mr-1.5 h-4 w-4 text-gray-400" aria-hidden="true" />
          Edit
        </button>
      </div>
    </div>
    <p class="text-base text-gray-600">{{ note.content }}</p>
    <hr class="m-0 h-px w-full border-none bg-gradient-to-r from-neutral-200/0 via-neutral-500/30 to-neutral-200/0"/>
    <p class="card-date">{{ note.created_at }}</p>

  </div>
</template>

<script>
import {
  PencilIcon,
  ArrowRightEndOnRectangleIcon,
} from '@heroicons/vue/20/solid'

export default {
  components: {
    PencilIcon,
    ArrowRightEndOnRectangleIcon,
  },
  props: {
    note: {
      type: Object,
      default: () => {}
    }
  },
  methods: {
    removeCard() {
      this.$emit('remove', this.note);
    }
  }
}
</script>

<style scoped>

.card-delete {
  position: absolute;
  bottom: 5px;
  right: 5px;
  background-color: transparent;
  color: black;
  border: none;
  font-size: 20px;
  cursor: pointer;
  font-weight: 600;
  margin-right: 5px;
  transition: transform 0.2s ease-in-out;
}

.card-delete:hover {
  transform: scale(1.01);
  color: red;
}

.card-delete:active {
  transform: scale(0.9);
  color: darkred;
}

.card-date {
  font-size: 12.5px;
  margin-top: auto;
  font-weight: 500;
  color: black;
}
</style>