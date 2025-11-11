<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import AdminCard from '@/Components/AdminCard.vue'
import { Head, useForm } from '@inertiajs/vue3'
const props = defineProps({ item: Object })
const form = useForm({
  about_text: props.item?.about_text || '',
  mission: props.item?.mission || '',
  vision: props.item?.vision || '',
  address: props.item?.address || '',
})
function submit(){ form.post(route('admin.company-profile.store')) }
</script>
<template>
  <AuthenticatedLayout>
    <Head title="Company Profile" />
    <div class="py-8 px-4 lg:px-8 space-y-6">
      <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Company Profile</h1>
      </div>
      <AdminCard title="Profil Perusahaan" subtitle="Perbarui informasi inti perusahaan.">
        <form @submit.prevent="submit" class="grid gap-3 max-w-3xl">
          <textarea v-model="form.about_text" placeholder="About" class="border rounded-md p-2 bg-white dark:bg-gray-800 border-gray-200 dark:border-gray-600 text-gray-800 dark:text-gray-200" rows="4" />
          <div class="grid sm:grid-cols-2 gap-3">
            <textarea v-model="form.mission" placeholder="Mission" class="border rounded-md p-2 bg-white dark:bg-gray-800 border-gray-200 dark:border-gray-600 text-gray-800 dark:text-gray-200" rows="3" />
            <textarea v-model="form.vision" placeholder="Vision" class="border rounded-md p-2 bg-white dark:bg-gray-800 border-gray-200 dark:border-gray-600 text-gray-800 dark:text-gray-200" rows="3" />
          </div>
          <input v-model="form.address" placeholder="Address" class="border rounded-md p-2 bg-white dark:bg-gray-800 border-gray-200 dark:border-gray-600 text-gray-800 dark:text-gray-200" />
          <div>
            <button class="bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-lg text-sm" :disabled="form.processing">Save</button>
          </div>
        </form>
      </AdminCard>
    </div>
  </AuthenticatedLayout>
</template>
