<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import AdminCard from '@/Components/AdminCard.vue'
import { Head, useForm } from '@inertiajs/vue3'
const props = defineProps({ item: Object })
const form = useForm({
  email: props.item?.email || '',
  phone: props.item?.phone || '',
  address: props.item?.address || '',
  map_embed: props.item?.map_embed || '',
})
function submit(){ form.post(route('admin.contact-info.store')) }
</script>
<template>
  <AuthenticatedLayout>
    <Head title="Contact Info" />
    <div class="py-8 px-4 lg:px-8 space-y-6">
      <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Contact Info</h1>
      </div>
      <AdminCard title="Informasi Kontak" subtitle="Update detail kontak dan embed peta.">
        <form @submit.prevent="submit" class="grid gap-3 max-w-2xl">
          <div class="grid sm:grid-cols-2 gap-3">
            <input v-model="form.email" placeholder="Email" class="border rounded-md p-2 bg-white dark:bg-gray-800 border-gray-200 dark:border-gray-600 text-gray-800 dark:text-gray-200" />
            <input v-model="form.phone" placeholder="Phone" class="border rounded-md p-2 bg-white dark:bg-gray-800 border-gray-200 dark:border-gray-600 text-gray-800 dark:text-gray-200" />
          </div>
          <input v-model="form.address" placeholder="Address" class="border rounded-md p-2 bg-white dark:bg-gray-800 border-gray-200 dark:border-gray-600 text-gray-800 dark:text-gray-200" />
          <textarea v-model="form.map_embed" placeholder="Map Embed" class="border rounded-md p-2 bg-white dark:bg-gray-800 border-gray-200 dark:border-gray-600 text-gray-800 dark:text-gray-200" rows="4" />
          <div>
            <button class="bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-lg text-sm" :disabled="form.processing">Save</button>
          </div>
        </form>
      </AdminCard>
    </div>
  </AuthenticatedLayout>
</template>
