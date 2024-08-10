<template>
  <div>
    <button class="bg-indigo-600 text-white font-bold text-lg w-12 h-12 rounded-full flex items-center justify-center hover:bg-indigo-500">
      <slot></slot>
    </button>
  </div>
</template>

<script>
export default {
  name: "button-add",
}
</script>