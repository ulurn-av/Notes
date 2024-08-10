<template>
  <div v-if="show" @click="hideDialog" class="fixed inset-0 bg-black bg-opacity-20 flex z-50 bg-background/40 backdrop-blur-md">
    <div @click.stop class="m-auto bg-white rounded-lg min-h-[50px] min-w-[300px]">
      <slot></slot>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    show: {
      type: Boolean,
      default: false,
    }
  },
  methods: {
    hideDialog() {
      this.$emit('update:show', false)
    }
  }
}
</script>

<style scoped>
</style>