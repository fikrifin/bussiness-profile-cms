<script setup>
const props = defineProps({
  padded: { type: Boolean, default: true },
  title: { type: String, default: '' },
  subtitle: { type: String, default: '' },
  actions: { type: Boolean, default: false },
});
</script>

<template>
  <div class="rounded-2xl bg-gradient-to-br from-white to-gray-50 dark:from-gray-900 dark:via-gray-800 dark:to-black border border-gray-200 dark:border-gray-700 shadow-lg dark:shadow-2xl hover:shadow-xl dark:hover:shadow-gray-900/50 transition-all duration-300">
    <div v-if="title || subtitle" class="px-6 pt-6" :class="{ 'pb-4': padded }">
      <div class="flex items-start justify-between gap-4">
        <div class="space-y-2">
          <h2 v-if="title" class="text-sm font-semibold tracking-wide uppercase bg-gradient-to-r from-gray-900 to-gray-600 dark:from-white dark:to-gray-400 bg-clip-text text-transparent">{{ title }}</h2>
          <p v-if="subtitle" class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">{{ subtitle }}</p>
        </div>
        <div v-if="actions" class="flex items-center gap-2">
          <slot name="actions" />
        </div>
      </div>
    </div>
    <div :class="padded ? 'px-6 pb-6' : ''">
      <slot />
    </div>
  </div>
</template>