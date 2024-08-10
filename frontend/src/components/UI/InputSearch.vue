<template>
  <div>
   <div class="inline-flex items-center transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 border border-input hover:bg-accent hover:text-accent-foreground px-4 py-2 relative h-10 w-full justify-start rounded-[0.5rem] bg-muted/50 text-sm font-normal text-muted-foreground shadow-none sm:pr-12 md:w-40 lg:w-96">
     <input class="flex h-10 w-full rounded-md bg-transparent py-3 text-sm outline-none placeholder:text-muted-foreground disabled:cursor-not-allowed disabled:opacity-50" placeholder="Search..."  spellcheck="false" aria-autocomplete="list" role="combobox" aria-expanded="true" aria-controls=":rf7:" aria-labelledby=":rf8:" id=":rf9:" type="text" value=""
            @input="$emit('update:modelValue', $event.target.value)"
     />
   </div>
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
</style>