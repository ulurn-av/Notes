<template>
  <header class="supports-backdrop-blur:bg-background/90 sticky top-0 z-40 w-full bg-background/40 backdrop-blur-lg">
    <div class="container mx-auto flex h-16 items-center px-4 justify-between">
        <div>
        <router-link to="/" class="flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 ml-2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 3.75H6.912a2.25 2.25 0 00-2.15 1.588L2.35 13.177a2.25 2.25 0 00-.1.661V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 00-2.15-1.588H15M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.013-1.244h3.859M12 3v8.25m0 0l-3-3m3 3l3-3"></path>
            </svg>
            <span class="hidden font-bold md:inline-block">Your Notes</span>
        </router-link>
        </div>
        <div>
          <button v-show="this.$store.getters.isAuthenticated" @click="logout" class="text-gray-500 hover:text-gray-700">
              <ArrowRightEndOnRectangleIcon class="h-6 w-6" />
          </button>
        </div>
    </div>
    <hr class="m-0 h-px w-full border-none bg-gradient-to-r from-neutral-200/0 via-neutral-400/30 to-neutral-200/0"/>
  </header>
</template>

<script>
import {ArrowRightEndOnRectangleIcon} from "@heroicons/vue/20/solid";

export default {
  components: {
    ArrowRightEndOnRectangleIcon
  },
  methods: {
    logout() {
      this.$store.dispatch('logout')
      this.$router.push('/login')
    }
  }
}
</script>

<style scoped>
</style>