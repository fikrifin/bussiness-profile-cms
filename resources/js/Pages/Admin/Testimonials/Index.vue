<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import AdminCard from '@/Components/AdminCard.vue'
import { Head, useForm } from '@inertiajs/vue3'
const props = defineProps({ items: Array })
const form = useForm({ author: '', role: '', content: '', avatar: '', is_active: true })
function submit(){ form.post(route('admin.testimonials.store'), { onSuccess: () => form.reset() }) }
</script>
<template>
  <AuthenticatedLayout>
    <Head title="Testimonials" />
    <div class="py-8 px-4 lg:px-8 space-y-6">
      <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Testimonials</h1>
      </div>
      <AdminCard title="Tambah Testimonial" subtitle="Tambah kepercayaan pengunjung.">
        <form @submit.prevent="submit" class="grid gap-3 max-w-2xl">
          <div class="grid sm:grid-cols-2 gap-3">
            <input v-model="form.author" placeholder="Author" class="border rounded-md p-2 bg-white dark:bg-gray-800 border-gray-200 dark:border-gray-600 text-gray-800 dark:text-gray-200" />
            <input v-model="form.role" placeholder="Role" class="border rounded-md p-2 bg-white dark:bg-gray-800 border-gray-200 dark:border-gray-600 text-gray-800 dark:text-gray-200" />
          </div>
          <textarea v-model="form.content" placeholder="Content" class="border rounded-md p-2 bg-white dark:bg-gray-800 border-gray-200 dark:border-gray-600 text-gray-800 dark:text-gray-200" />
          <label class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300"><input type="checkbox" v-model="form.is_active" class="rounded" /> Active</label>
          <div>
            <button class="bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-lg text-sm" :disabled="form.processing">Add</button>
          </div>
        </form>
      </AdminCard>

      <AdminCard title="Daftar Testimonials">
        <div class="grid gap-4">
          <div v-for="t in items" :key="t.id" class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 bg-white dark:bg-gray-800">
            <div class="font-semibold text-gray-900 dark:text-gray-100">{{ t.author }} <span v-if="t.role" class="text-xs text-gray-500 dark:text-gray-400">- {{ t.role }}</span></div>
            <div class="text-sm mt-1 text-gray-700 dark:text-gray-300">{{ t.content }}</div>
            <div class="mt-2 text-xs text-gray-500 dark:text-gray-400">Active: {{ t.is_active ? 'Yes' : 'No' }}</div>
          </div>
        </div>
      </AdminCard>
    </div>
  </AuthenticatedLayout>
</template>
