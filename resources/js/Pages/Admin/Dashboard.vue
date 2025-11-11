<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head } from '@inertiajs/vue3'
import { computed, ref, onMounted } from 'vue'
import { UserGroupIcon, WrenchScrewdriverIcon, ChatBubbleLeftEllipsisIcon, SparklesIcon, BuildingOfficeIcon, PhoneIcon, MoonIcon, SunIcon } from '@heroicons/vue/24/outline'

const props = defineProps({
  stats: Object,
  activity: Array,
})

const cards = computed(() => [
  { label: 'Users', value: props.stats?.users ?? 0, icon: UserGroupIcon, color: 'from-indigo-500 to-indigo-600' },
  { label: 'Services', value: props.stats?.services ?? 0, icon: WrenchScrewdriverIcon, color: 'from-blue-500 to-sky-500' },
  { label: 'Testimonials', value: props.stats?.testimonials ?? 0, icon: ChatBubbleLeftEllipsisIcon, color: 'from-teal-500 to-emerald-500' },
  { label: 'Active Hero', value: props.stats?.hero_active ?? 0, icon: SparklesIcon, color: 'from-pink-500 to-rose-500' },
  { label: 'Company Profile', value: props.stats?.company_profile_exists ? '✔︎' : '—', icon: BuildingOfficeIcon, color: 'from-slate-500 to-slate-600' },
  { label: 'Contact Info', value: props.stats?.contact_info_exists ? '✔︎' : '—', icon: PhoneIcon, color: 'from-amber-500 to-yellow-500' },
])

function formatTime(ts) {
  if (!ts) return ''
  const date = new Date(ts)
  return date.toLocaleString()
}

function timeAgo(ts) {
  if (!ts) return ''
  const now = Date.now()
  const then = new Date(ts).getTime()
  const diff = Math.max(0, Math.floor((now - then) / 1000))
  if (diff < 60) return `${diff}s lalu`
  const m = Math.floor(diff / 60)
  if (m < 60) return `${m}m lalu`
  const h = Math.floor(m / 60)
  if (h < 24) return `${h}j lalu`
  const d = Math.floor(h / 24)
  if (d < 30) return `${d}h lalu`
  const mo = Math.floor(d / 30)
  if (mo < 12) return `${mo}bln lalu`
  const y = Math.floor(mo / 12)
  return `${y}th lalu`
}

const typeLabel = {
  service: 'Service diperbarui',
  testimonial: 'Testimonial diperbarui',
  hero: 'Hero diperbarui',
  company_profile: 'Profil perusahaan',
  contact_info: 'Kontak diperbarui',
  user: 'User baru',
}

const typeIcon = {
  service: WrenchScrewdriverIcon,
  testimonial: ChatBubbleLeftEllipsisIcon,
  hero: SparklesIcon,
  company_profile: BuildingOfficeIcon,
  contact_info: PhoneIcon,
  user: UserGroupIcon,
}

const typeColor = {
  service: 'from-blue-500 to-sky-500',
  testimonial: 'from-emerald-500 to-teal-500',
  hero: 'from-pink-500 to-rose-500',
  company_profile: 'from-slate-500 to-slate-600',
  contact_info: 'from-amber-500 to-yellow-500',
  user: 'from-indigo-500 to-indigo-600',
}

// Local header theme toggle (quick access) syncing with global storage
const headerDark = ref(false)
onMounted(() => {
  const stored = localStorage.getItem('theme')
  headerDark.value = stored === 'dark'
})

function toggleHeaderTheme() {
  headerDark.value = !headerDark.value
  localStorage.setItem('theme', headerDark.value ? 'dark' : 'light')
  document.documentElement.classList.toggle('dark', headerDark.value)
}
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Admin Dashboard" />
    <div class="py-8 px-4 lg:px-8 mx-auto space-y-10">
      <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
        <div class="space-y-2">
          <h1 class="text-3xl font-bold tracking-tight">
            <span class="bg-gradient-to-r from-gray-900 to-gray-600 dark:from-white dark:to-gray-400 bg-clip-text text-transparent">Dashboard</span>
          </h1>
          <p class="text-gray-600 dark:text-gray-400 text-sm">Ringkasan cepat aktivitas dan konten situs Anda.</p>
        </div>
        <div class="flex gap-3 items-center">
          <button @click="$inertia.post(route('admin.dashboard.refresh'), {}, { preserveScroll: true })" class="px-4 py-2 rounded-lg bg-gradient-to-r from-gray-100 to-gray-300 hover:from-white hover:to-gray-200 text-black text-sm font-bold shadow-lg hover:shadow-xl transition transform hover:-translate-y-0.5">Refresh</button>
          <button @click="$inertia.visit(route('admin.settings.index'))" class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 dark:bg-black/30 dark:hover:bg-black/50 border border-gray-300 dark:border-gray-700 text-gray-700 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white text-sm font-medium transition">Settings</button>
          <button @click="toggleHeaderTheme" class="p-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-200 hover:bg-gray-300 dark:bg-black/30 dark:hover:bg-black/50 text-gray-700 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white transition" :aria-label="headerDark ? 'Switch to Light Mode' : 'Switch to Dark Mode'">
            <component :is="headerDark ? SunIcon : MoonIcon" class="h-5 w-5" />
          </button>
        </div>
      </div>

      <!-- Stat Cards -->
      <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
        <div v-for="c in cards" :key="c.label" class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-white to-gray-50 dark:from-gray-900 dark:via-gray-800 dark:to-black border border-gray-200 dark:border-gray-700 shadow-lg dark:shadow-2xl hover:shadow-xl dark:hover:shadow-gray-900/50 transition-all duration-300 transform hover:-translate-y-1">
          <div class="p-6 flex flex-col gap-5">
            <div class="flex items-start justify-between">
              <div class="space-y-2">
                <span class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">{{ c.label }}</span>
                <div class="text-4xl font-bold bg-gradient-to-r from-gray-900 to-gray-600 dark:from-white dark:to-gray-400 bg-clip-text text-transparent">{{ c.value }}</div>
              </div>
              <div class="h-12 w-12 rounded-xl flex items-center justify-center bg-gradient-to-br shadow-lg" :class="c.color + ' text-white'">
                <component :is="c.icon" class="h-6 w-6" />
              </div>
            </div>
            <div class="h-8 w-full relative opacity-30">
              <svg viewBox="0 0 100 40" fill="none" stroke-width="2" stroke-linecap="round" class="absolute inset-0 stroke-gray-400">
                <polyline points="0,30 18,20 36,26 54,14 72,22 90,8 100,12" fill="none" />
              </svg>
            </div>
            <div class="flex items-center justify-between text-xs">
              <span class="inline-flex items-center gap-1 text-emerald-600 dark:text-emerald-400"><span class="h-1.5 w-1.5 rounded-full bg-emerald-600 dark:bg-emerald-400 animate-pulse"></span><span class="font-medium">Live</span></span>
              <span class="text-gray-500">cache 60s</span>
            </div>
          </div>
          <div class="absolute inset-x-0 bottom-0 h-1 bg-gradient-to-r" :class="c.color"></div>
        </div>
      </div>

      <!-- Activity / Overview Section -->
      <div class="grid gap-8 lg:grid-cols-3">
        <div class="lg:col-span-2 space-y-6">
          <div class="rounded-2xl bg-gradient-to-br from-white to-gray-50 dark:from-gray-900 dark:via-gray-800 dark:to-black border border-gray-200 dark:border-gray-700 p-6 shadow-lg dark:shadow-2xl">
            <h2 class="text-sm font-semibold tracking-wide uppercase bg-gradient-to-r from-gray-900 to-gray-600 dark:from-white dark:to-gray-400 bg-clip-text text-transparent">Aktivitas Terbaru</h2>
            <ul class="mt-4 divide-y divide-gray-200 dark:divide-gray-800 text-sm" v-if="activity?.length">
              <li v-for="item in activity" :key="item.type + item.updated_at + item.title" class="py-4 flex items-center justify-between hover:bg-gray-100 dark:hover:bg-black/30 px-3 -mx-3 rounded-lg transition">
                <div class="flex items-center gap-3 min-w-0">
                  <div class="h-10 w-10 rounded-xl flex items-center justify-center bg-gradient-to-br text-white shadow-lg" :class="typeColor[item.type]">
                    <component :is="typeIcon[item.type] || UserGroupIcon" class="h-5 w-5" />
                  </div>
                  <div class="min-w-0">
                    <div class="text-gray-700 dark:text-gray-300 truncate">
                      <span class="font-medium text-gray-600 dark:text-gray-400">{{ typeLabel[item.type] || item.type }}:</span>
                      <span class="text-gray-900 dark:text-white font-semibold ml-1">{{ item.title }}</span>
                    </div>
                    <div class="text-xs text-gray-500 mt-0.5">{{ formatTime(item.updated_at) }}</div>
                  </div>
                </div>
                <span class="text-xs text-gray-500 whitespace-nowrap ms-3">{{ timeAgo(item.updated_at) }}</span>
              </li>
            </ul>
            <p v-else class="text-sm text-gray-500 mt-4 text-center py-8">Tidak ada aktivitas terbaru.</p>
          </div>

          <div class="rounded-2xl bg-gradient-to-br from-white to-gray-50 dark:from-gray-900 dark:via-gray-800 dark:to-black border border-gray-200 dark:border-gray-700 p-6 shadow-lg dark:shadow-2xl">
            <h2 class="text-sm font-semibold tracking-wide uppercase bg-gradient-to-r from-gray-900 to-gray-600 dark:from-white dark:to-gray-400 bg-clip-text text-transparent mb-4">Kinerja Singkat</h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 text-sm">
              <div class="p-5 rounded-xl bg-indigo-50 dark:bg-black/30 border border-indigo-200 dark:border-indigo-500/30 hover:border-indigo-300 dark:hover:border-indigo-500/50 transition">
                <div class="text-xs font-semibold text-indigo-600 dark:text-indigo-400 mb-2">Bounce Rate</div>
                <div class="text-2xl font-bold text-indigo-700 dark:text-indigo-300">38%</div>
              </div>
              <div class="p-5 rounded-xl bg-blue-50 dark:bg-black/30 border border-blue-200 dark:border-blue-500/30 hover:border-blue-300 dark:hover:border-blue-500/50 transition">
                <div class="text-xs font-semibold text-blue-600 dark:text-blue-400 mb-2">Page Views</div>
                <div class="text-2xl font-bold text-blue-700 dark:text-blue-300">1,240</div>
              </div>
              <div class="p-5 rounded-xl bg-emerald-50 dark:bg-black/30 border border-emerald-200 dark:border-emerald-500/30 hover:border-emerald-300 dark:hover:border-emerald-500/50 transition">
                <div class="text-xs font-semibold text-emerald-600 dark:text-emerald-400 mb-2">Avg. Time</div>
                <div class="text-2xl font-bold text-emerald-700 dark:text-emerald-300">2m 15s</div>
              </div>
            </div>
          </div>
        </div>

        <div class="space-y-6">
          <div class="rounded-2xl bg-gradient-to-br from-white to-gray-50 dark:from-gray-900 dark:via-gray-800 dark:to-black border border-gray-200 dark:border-gray-700 p-6 shadow-lg dark:shadow-2xl">
            <h2 class="text-sm font-semibold tracking-wide uppercase bg-gradient-to-r from-gray-900 to-gray-600 dark:from-white dark:to-gray-400 bg-clip-text text-transparent">Status Sistem</h2>
            <ul class="mt-4 space-y-3 text-xs">
              <li class="flex items-center justify-between p-3 rounded-lg bg-gray-100 dark:bg-black/30 border border-gray-200 dark:border-gray-800">
                <span class="text-gray-600 dark:text-gray-400">Queue</span>
                <span class="px-3 py-1 rounded-full bg-emerald-100 dark:bg-emerald-500/20 border border-emerald-200 dark:border-emerald-500/30 text-emerald-700 dark:text-emerald-400 font-medium">Normal</span>
              </li>
              <li class="flex items-center justify-between p-3 rounded-lg bg-gray-100 dark:bg-black/30 border border-gray-200 dark:border-gray-800">
                <span class="text-gray-600 dark:text-gray-400">Cache</span>
                <span class="px-3 py-1 rounded-full bg-indigo-100 dark:bg-indigo-500/20 border border-indigo-200 dark:border-indigo-500/30 text-indigo-700 dark:text-indigo-400 font-medium">OK</span>
              </li>
              <li class="flex items-center justify-between p-3 rounded-lg bg-gray-100 dark:bg-black/30 border border-gray-200 dark:border-gray-800">
                <span class="text-gray-600 dark:text-gray-400">Mail</span>
                <span class="px-3 py-1 rounded-full bg-yellow-100 dark:bg-yellow-500/20 border border-yellow-200 dark:border-yellow-500/30 text-yellow-700 dark:text-yellow-400 font-medium">Log Mode</span>
              </li>
            </ul>
          </div>
          <div class="rounded-2xl bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-800 dark:to-gray-900 border border-gray-300 dark:border-gray-700 p-6 shadow-lg dark:shadow-2xl">
            <h2 class="text-sm font-semibold tracking-wide uppercase text-gray-800 dark:text-gray-300">Tips Cepat</h2>
            <ul class="mt-4 space-y-3 text-xs text-gray-600 dark:text-gray-400">
              <li class="flex items-start gap-2">
                <span class="text-gray-400 dark:text-gray-600 mt-0.5">•</span>
                <span>Perbarui konten hero agar tetap relevan.</span>
              </li>
              <li class="flex items-start gap-2">
                <span class="text-gray-400 dark:text-gray-600 mt-0.5">•</span>
                <span>Tambahkan testimonial baru untuk meningkatkan kepercayaan.</span>
              </li>
              <li class="flex items-start gap-2">
                <span class="text-gray-400 dark:text-gray-600 mt-0.5">•</span>
                <span>Kelola warna di Settings untuk branding konsisten.</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
