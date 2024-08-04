<template>
  <div>
    <input
        class="search"
        :placeholder="placeholderSearch"
        @input="$emit('update:modelValue', $event.target.value)"
    />
  </div>
</template>

<script>
export default {
  props: {
    modelValue: [String, Number],
    placeholderSearch: String,
  },
}
</script>

<style scoped>

.search {
  width: 500px;
  height: 50px;
  font-size: 18px;
  padding: 10px;
  border: 3px solid lightslategray;
  border-radius: 15px;
}

</style>