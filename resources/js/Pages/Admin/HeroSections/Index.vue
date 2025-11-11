<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import AdminCard from '@/Components/AdminCard.vue'
import { Head, useForm } from '@inertiajs/vue3'
const props = defineProps({ items: Array })
const form = useForm({
  title: '', subtitle: '', button_text: '', button_url: '', background_image: '', is_active: true,
})
function submit() {
  form.post(route('admin.hero-sections.store'), { onSuccess: () => form.reset() })
}
</script>
<template>
  <AuthenticatedLayout>
    <Head title="Hero Sections" />
    <div class="py-8 px-4 lg:px-8 space-y-6">
      <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Hero Sections</h1>
      </div>
      <AdminCard title="Buat Hero" subtitle="Tambah section hero baru untuk landing page.">
        <form @submit.prevent="submit" class="grid gap-3 max-w-2xl">
          <input v-model="form.title" placeholder="Title" class="border rounded-md p-2 bg-white dark:bg-gray-800 border-gray-200 dark:border-gray-600 text-gray-800 dark:text-gray-200" />
          <textarea v-model="form.subtitle" placeholder="Subtitle" class="border rounded-md p-2 bg-white dark:bg-gray-800 border-gray-200 dark:border-gray-600 text-gray-800 dark:text-gray-200" />
          <div class="grid sm:grid-cols-2 gap-3">
            <input v-model="form.button_text" placeholder="Button Text" class="border rounded-md p-2 bg-white dark:bg-gray-800 border-gray-200 dark:border-gray-600 text-gray-800 dark:text-gray-200" />
            <input v-model="form.button_url" placeholder="Button URL" class="border rounded-md p-2 bg-white dark:bg-gray-800 border-gray-200 dark:border-gray-600 text-gray-800 dark:text-gray-200" />
          </div>
          <label class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300"><input type="checkbox" v-model="form.is_active" class="rounded" /> Active</label>
          <div>
            <button class="bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-lg text-sm" :disabled="form.processing">Create</button>
          </div>
        </form>
      </AdminCard>

      <AdminCard title="Daftar Hero" subtitle="Semua hero yang tersimpan.">
        <div class="grid gap-4">
          <div v-for="h in items" :key="h.id" class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 bg-white dark:bg-gray-800">
            <div class="font-semibold text-gray-900 dark:text-gray-100">{{ h.title }}</div>
            <div class="text-sm text-gray-600 dark:text-gray-300" v-if="h.subtitle">{{ h.subtitle }}</div>
            <div class="mt-2 text-xs text-gray-500 dark:text-gray-400">Active: {{ h.is_active ? 'Yes' : 'No' }}</div>
          </div>
        </div>
      </AdminCard>
    </div>
  </AuthenticatedLayout>
</template>
