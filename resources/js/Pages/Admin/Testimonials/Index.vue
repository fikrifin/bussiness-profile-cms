<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import AdminCard from '@/Components/AdminCard.vue'
import { Head, useForm } from '@inertiajs/vue3'
import { ref } from 'vue'
import { PencilIcon, TrashIcon, XMarkIcon } from '@heroicons/vue/24/outline'

const props = defineProps({ items: Array })

const form = useForm({ 
  author: '', 
  role: '', 
  content: '', 
  avatar: '', 
  is_active: true 
})

const editForm = useForm({ 
  author: '', 
  role: '', 
  content: '', 
  avatar: '', 
  is_active: true 
})

const editingItem = ref(null)
const deleteConfirm = ref(null)

function submit() { 
  form.post(route('admin.testimonials.store'), { 
    onSuccess: () => form.reset(),
    preserveScroll: true
  }) 
}

function startEdit(item) {
  editingItem.value = item.id
  editForm.author = item.author
  editForm.role = item.role || ''
  editForm.content = item.content
  editForm.avatar = item.avatar || ''
  editForm.is_active = item.is_active
}

function cancelEdit() {
  editingItem.value = null
  editForm.reset()
  editForm.clearErrors()
}

function updateItem(id) {
  editForm.put(route('admin.testimonials.update', id), {
    onSuccess: () => {
      editingItem.value = null
      editForm.reset()
    },
    preserveScroll: true
  })
}

function confirmDelete(item) {
  deleteConfirm.value = item
}

function deleteItem() {
  if (!deleteConfirm.value) return
  useForm({}).delete(route('admin.testimonials.destroy', deleteConfirm.value.id), {
    onSuccess: () => {
      deleteConfirm.value = null
    },
    preserveScroll: true
  })
}
</script>
<template>
  <AuthenticatedLayout>
    <Head title="Testimonials" />
    <div class="py-8 px-4 lg:px-8 space-y-6">
      <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold bg-gradient-to-r from-gray-900 to-gray-600 dark:from-white dark:to-gray-400 bg-clip-text text-transparent">Testimonials</h1>
      </div>
      
      <!-- Create Form -->
      <AdminCard title="Tambah Testimonial" subtitle="Tambahkan testimoni pelanggan untuk membangun kepercayaan.">
        <form @submit.prevent="submit" class="grid gap-4 max-w-2xl">
          <div class="grid sm:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Author *</label>
              <input 
                v-model="form.author" 
                placeholder="Contoh: John Doe" 
                class="w-full border rounded-lg p-2.5 bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400 focus:border-transparent"
                required
              />
              <span v-if="form.errors.author" class="text-xs text-red-500 mt-1">{{ form.errors.author }}</span>
            </div>
            
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Posisi/Perusahaan</label>
              <input 
                v-model="form.role" 
                placeholder="Contoh: CEO di ABC Company" 
                class="w-full border rounded-lg p-2.5 bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400 focus:border-transparent"
              />
            </div>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Testimoni *</label>
            <textarea 
              v-model="form.content" 
              placeholder="Tuliskan testimoni pelanggan..." 
              rows="4"
              class="w-full border rounded-lg p-2.5 bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400 focus:border-transparent"
              required
            />
            <span v-if="form.errors.content" class="text-xs text-red-500 mt-1">{{ form.errors.content }}</span>
          </div>

          <div>
            <label class="flex items-center gap-2 cursor-pointer">
              <input 
                type="checkbox" 
                v-model="form.is_active" 
                class="rounded border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 focus:ring-gray-500 dark:focus:ring-gray-400"
              />
              <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Aktifkan testimoni ini</span>
            </label>
          </div>

          <div>
            <button 
              type="submit"
              class="bg-gradient-to-r from-gray-700 to-gray-800 dark:from-gray-600 dark:to-gray-700 hover:from-gray-600 hover:to-gray-700 dark:hover:from-gray-500 dark:hover:to-gray-600 text-white px-6 py-2.5 rounded-lg text-sm font-medium shadow-lg transition-all duration-200 disabled:opacity-50" 
              :disabled="form.processing"
            >
              {{ form.processing ? 'Menambahkan...' : 'Tambah Testimonial' }}
            </button>
          </div>
        </form>
      </AdminCard>

      <!-- List -->
      <AdminCard title="Daftar Testimonials" subtitle="Semua testimoni yang tersimpan.">
        <div v-if="items.length === 0" class="text-center py-12 text-gray-500 dark:text-gray-400">
          <p class="text-sm">Belum ada testimonial. Buat yang pertama di atas!</p>
        </div>

        <div v-else class="grid gap-4">
          <div v-for="t in items" :key="t.id" class="border border-gray-200 dark:border-gray-700 rounded-xl p-5 bg-white dark:bg-gray-800/50 hover:shadow-lg transition-all duration-200">
            <!-- View Mode -->
            <div v-if="editingItem !== t.id">
              <div class="flex items-start justify-between gap-4">
                <div class="flex items-start gap-4 flex-1 min-w-0">
                  <!-- Avatar -->
                  <div class="flex-shrink-0 h-12 w-12 flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 rounded-full text-gray-700 dark:text-gray-300 font-bold text-lg">
                    {{ t.author[0] }}
                  </div>
                  
                  <!-- Content -->
                  <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-3 mb-2">
                      <h3 class="font-semibold text-lg text-gray-900 dark:text-gray-100">{{ t.author }}</h3>
                      <span 
                        class="text-xs px-2 py-1 rounded-full"
                        :class="t.is_active 
                          ? 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400' 
                          : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400'"
                      >
                        {{ t.is_active ? 'Aktif' : 'Nonaktif' }}
                      </span>
                    </div>
                    <p v-if="t.role" class="text-sm text-gray-500 dark:text-gray-400 mb-2">{{ t.role }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 italic">"{{ t.content }}"</p>
                  </div>
                </div>
                
                <!-- Actions -->
                <div class="flex items-center gap-2 flex-shrink-0">
                  <button 
                    @click="startEdit(t)"
                    class="p-2 text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-500/10 rounded-lg transition"
                    title="Edit"
                  >
                    <PencilIcon class="h-5 w-5" />
                  </button>
                  <button 
                    @click="confirmDelete(t)"
                    class="p-2 text-gray-600 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-500/10 rounded-lg transition"
                    title="Delete"
                  >
                    <TrashIcon class="h-5 w-5" />
                  </button>
                </div>
              </div>
            </div>

            <!-- Edit Mode -->
            <div v-else>
              <form @submit.prevent="updateItem(t.id)" class="grid gap-4">
                <div class="grid sm:grid-cols-2 gap-4">
                  <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Author *</label>
                    <input 
                      v-model="editForm.author" 
                      class="w-full border rounded-lg p-2.5 bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400 focus:border-transparent"
                      required
                    />
                    <span v-if="editForm.errors.author" class="text-xs text-red-500 mt-1">{{ editForm.errors.author }}</span>
                  </div>
                  
                  <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Posisi/Perusahaan</label>
                    <input 
                      v-model="editForm.role" 
                      class="w-full border rounded-lg p-2.5 bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400 focus:border-transparent"
                    />
                  </div>
                </div>

                <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Testimoni *</label>
                  <textarea 
                    v-model="editForm.content" 
                    rows="4"
                    class="w-full border rounded-lg p-2.5 bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400 focus:border-transparent"
                    required
                  />
                  <span v-if="editForm.errors.content" class="text-xs text-red-500 mt-1">{{ editForm.errors.content }}</span>
                </div>

                <div>
                  <label class="flex items-center gap-2 cursor-pointer">
                    <input 
                      type="checkbox" 
                      v-model="editForm.is_active" 
                      class="rounded border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 focus:ring-gray-500 dark:focus:ring-gray-400"
                    />
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Aktifkan testimoni ini</span>
                  </label>
                </div>

                <div class="flex items-center gap-3 pt-2">
                  <button 
                    type="submit"
                    class="bg-gradient-to-r from-gray-700 to-gray-800 dark:from-gray-600 dark:to-gray-700 hover:from-gray-600 hover:to-gray-700 dark:hover:from-gray-500 dark:hover:to-gray-600 text-white px-6 py-2 rounded-lg text-sm font-medium shadow-lg transition-all duration-200 disabled:opacity-50" 
                    :disabled="editForm.processing"
                  >
                    {{ editForm.processing ? 'Updating...' : 'Update' }}
                  </button>
                  <button 
                    type="button"
                    @click="cancelEdit"
                    class="px-6 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 rounded-lg text-sm font-medium transition"
                  >
                    Cancel
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </AdminCard>

      <!-- Delete Confirmation Modal -->
      <transition 
        enter-active-class="duration-150 ease-out" 
        enter-from-class="opacity-0 scale-95" 
        enter-to-class="opacity-100 scale-100" 
        leave-active-class="duration-100 ease-in" 
        leave-from-class="opacity-100 scale-100" 
        leave-to-class="opacity-0 scale-95"
      >
        <div v-if="deleteConfirm" class="fixed inset-0 z-[100] flex items-center justify-center p-4">
          <div class="fixed inset-0 bg-black/70 backdrop-blur-sm" @click="deleteConfirm = null"></div>
          <div class="relative bg-white dark:bg-gradient-to-br dark:from-gray-900 dark:to-black border border-gray-200 dark:border-gray-700 rounded-2xl shadow-2xl ring-1 ring-gray-200 dark:ring-gray-700 p-6 w-full max-w-md space-y-4">
            <div class="flex items-start justify-between">
              <div>
                <h3 class="text-lg font-bold bg-gradient-to-r from-gray-900 to-gray-600 dark:from-white dark:to-gray-400 bg-clip-text text-transparent">Konfirmasi Hapus</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                  Apakah Anda yakin ingin menghapus testimoni dari "<strong>{{ deleteConfirm.author }}</strong>"?
                </p>
              </div>
              <button 
                @click="deleteConfirm = null"
                class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300"
              >
                <XMarkIcon class="h-5 w-5" />
              </button>
            </div>
            <div class="flex justify-end gap-2 pt-2">
              <button 
                @click="deleteConfirm = null" 
                class="px-4 py-2 rounded-lg text-sm font-medium bg-gray-200 hover:bg-gray-300 dark:bg-black/30 dark:hover:bg-black/50 border border-gray-300 dark:border-gray-700 text-gray-700 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white transition"
              >
                Batal
              </button>
              <button 
                @click="deleteItem" 
                class="px-4 py-2 rounded-lg text-sm font-bold bg-gradient-to-r from-red-600 to-red-700 hover:from-red-500 hover:to-red-600 text-white shadow-lg transition"
              >
                Hapus
              </button>
            </div>
          </div>
        </div>
      </transition>
    </div>
  </AuthenticatedLayout>
</template>
