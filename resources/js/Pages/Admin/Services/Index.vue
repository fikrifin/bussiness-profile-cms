<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import AdminCard from '@/Components/AdminCard.vue'
import { Head, useForm } from '@inertiajs/vue3'
const props = defineProps({ items: Array })
const form = useForm({ name: '', description: '', icon: '', sort_order: 0 })
function submit(){ form.post(route('admin.services.store'), { onSuccess: () => form.reset() }) }
</script>
<template>
  <AuthenticatedLayout>
    <Head title="Services" />
    <div class="py-8 px-4 lg:px-8 space-y-6">
      <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Services</h1>
      </div>
      <AdminCard title="Tambah Service" subtitle="Tambah layanan baru.">
        <form @submit.prevent="submit" class="grid gap-3 max-w-2xl">
          <input v-model="form.name" placeholder="Name" class="border rounded-md p-2 bg-white dark:bg-gray-800 border-gray-200 dark:border-gray-600 text-gray-800 dark:text-gray-200" />
          <textarea v-model="form.description" placeholder="Description" class="border rounded-md p-2 bg-white dark:bg-gray-800 border-gray-200 dark:border-gray-600 text-gray-800 dark:text-gray-200" />
          <div class="grid sm:grid-cols-2 gap-3">
            <input v-model="form.icon" placeholder="Icon (optional)" class="border rounded-md p-2 bg-white dark:bg-gray-800 border-gray-200 dark:border-gray-600 text-gray-800 dark:text-gray-200" />
            <input v-model.number="form.sort_order" type="number" placeholder="Sort Order" class="border rounded-md p-2 bg-white dark:bg-gray-800 border-gray-200 dark:border-gray-600 text-gray-800 dark:text-gray-200" />
          </div>
          <div>
            <button class="bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-lg text-sm" :disabled="form.processing">Add</button>
          </div>
        </form>
      </AdminCard>

      <AdminCard title="Daftar Services">
        <div class="overflow-x-auto">
          <table class="min-w-full text-sm">
            <thead>
              <tr class="text-left border-b border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300">
                <th class="p-3">Name</th>
                <th class="p-3">Sort</th>
                <th class="p-3">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="s in items" :key="s.id" class="border-b border-gray-100 dark:border-gray-700/60">
                <td class="p-3 text-gray-900 dark:text-gray-100">{{ s.name }}</td>
                <td class="p-3 text-gray-700 dark:text-gray-300">{{ s.sort_order }}</td>
                <td class="p-3">
                  <button class="text-red-600 dark:text-red-400 hover:underline" @click="$inertia.delete(route('admin.services.destroy', s.id))">Delete</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </AdminCard>
    </div>
  </AuthenticatedLayout>
</template>
