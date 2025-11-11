<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import AdminCard from '@/Components/AdminCard.vue'
import { Head, useForm } from '@inertiajs/vue3'
const props = defineProps({ items: Object })
const form = useForm({
  settings: {
    site_name: props.items?.site_name || '',
    site_tagline: props.items?.site_tagline || '',
    primary_color: props.items?.primary_color || '#0ea5e9',
    secondary_color: props.items?.secondary_color || '#111827',
  }
})
function submit(){ form.post(route('admin.settings.store')) }
</script>
<template>
  <AuthenticatedLayout>
    <Head title="Settings" />
    <div class="py-8 px-4 lg:px-8 space-y-6">
      <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Settings</h1>
      </div>
      <AdminCard title="Pengaturan Situs" subtitle="Atur nama, tagline, dan warna utama untuk branding.">
        <form @submit.prevent="submit" class="grid gap-4 max-w-xl">
          <input v-model="form.settings.site_name" placeholder="Site Name" class="border rounded-md p-2 bg-white dark:bg-gray-800 border-gray-200 dark:border-gray-600 text-gray-800 dark:text-gray-200" />
          <input v-model="form.settings.site_tagline" placeholder="Tagline" class="border rounded-md p-2 bg-white dark:bg-gray-800 border-gray-200 dark:border-gray-600 text-gray-800 dark:text-gray-200" />
          <div class="grid sm:grid-cols-2 gap-3">
            <input v-model="form.settings.primary_color" placeholder="Primary Color" class="border rounded-md p-2 bg-white dark:bg-gray-800 border-gray-200 dark:border-gray-600 text-gray-800 dark:text-gray-200" />
            <input v-model="form.settings.secondary_color" placeholder="Secondary Color" class="border rounded-md p-2 bg-white dark:bg-gray-800 border-gray-200 dark:border-gray-600 text-gray-800 dark:text-gray-200" />
          </div>
          <div>
            <button class="bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-lg text-sm" :disabled="form.processing">Save</button>
          </div>
        </form>
      </AdminCard>
    </div>
  </AuthenticatedLayout>
</template>
