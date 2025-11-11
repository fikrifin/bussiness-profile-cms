<script setup>
import { ref, computed } from 'vue'
import {
  RocketLaunchIcon,
  CpuChipIcon,
  CloudIcon,
  ShieldCheckIcon,
  CogIcon,
  LightBulbIcon,
  ChartBarIcon,
  DevicePhoneMobileIcon,
  GlobeAltIcon,
  ServerIcon,
  CodeBracketIcon,
  PaintBrushIcon,
  MegaphoneIcon,
  CameraIcon,
  VideoCameraIcon,
  MusicalNoteIcon,
  ShoppingCartIcon,
  CreditCardIcon,
  TruckIcon,
  BuildingOfficeIcon,
  UserGroupIcon,
  AcademicCapIcon,
  BeakerIcon,
  BookOpenIcon,
  BriefcaseIcon,
  CalculatorIcon,
  ClipboardDocumentCheckIcon,
  CubeIcon,
  CurrencyDollarIcon,
  DocumentTextIcon,
  EnvelopeIcon,
  FireIcon,
  FlagIcon,
  HeartIcon,
  HomeIcon,
  KeyIcon,
  LifebuoyIcon,
  MapPinIcon,
  PencilIcon,
  PhoneIcon,
  PuzzlePieceIcon,
  SparklesIcon,
  StarIcon,
  SunIcon,
  WrenchScrewdriverIcon,
} from '@heroicons/vue/24/outline'

const props = defineProps({
  modelValue: {
    type: String,
    default: ''
  }
})

const emit = defineEmits(['update:modelValue'])

const showPicker = ref(false)
const searchQuery = ref('')

// Daftar icon yang tersedia
const availableIcons = [
  { name: 'RocketLaunchIcon', component: RocketLaunchIcon, label: 'Rocket' },
  { name: 'CpuChipIcon', component: CpuChipIcon, label: 'CPU Chip' },
  { name: 'CloudIcon', component: CloudIcon, label: 'Cloud' },
  { name: 'ShieldCheckIcon', component: ShieldCheckIcon, label: 'Shield' },
  { name: 'CogIcon', component: CogIcon, label: 'Settings' },
  { name: 'LightBulbIcon', component: LightBulbIcon, label: 'Light Bulb' },
  { name: 'ChartBarIcon', component: ChartBarIcon, label: 'Chart' },
  { name: 'DevicePhoneMobileIcon', component: DevicePhoneMobileIcon, label: 'Mobile' },
  { name: 'GlobeAltIcon', component: GlobeAltIcon, label: 'Globe' },
  { name: 'ServerIcon', component: ServerIcon, label: 'Server' },
  { name: 'CodeBracketIcon', component: CodeBracketIcon, label: 'Code' },
  { name: 'PaintBrushIcon', component: PaintBrushIcon, label: 'Design' },
  { name: 'MegaphoneIcon', component: MegaphoneIcon, label: 'Marketing' },
  { name: 'CameraIcon', component: CameraIcon, label: 'Camera' },
  { name: 'VideoCameraIcon', component: VideoCameraIcon, label: 'Video' },
  { name: 'MusicalNoteIcon', component: MusicalNoteIcon, label: 'Music' },
  { name: 'ShoppingCartIcon', component: ShoppingCartIcon, label: 'Shopping' },
  { name: 'CreditCardIcon', component: CreditCardIcon, label: 'Payment' },
  { name: 'TruckIcon', component: TruckIcon, label: 'Delivery' },
  { name: 'BuildingOfficeIcon', component: BuildingOfficeIcon, label: 'Office' },
  { name: 'UserGroupIcon', component: UserGroupIcon, label: 'Team' },
  { name: 'AcademicCapIcon', component: AcademicCapIcon, label: 'Education' },
  { name: 'BeakerIcon', component: BeakerIcon, label: 'Science' },
  { name: 'BookOpenIcon', component: BookOpenIcon, label: 'Book' },
  { name: 'BriefcaseIcon', component: BriefcaseIcon, label: 'Business' },
  { name: 'CalculatorIcon', component: CalculatorIcon, label: 'Calculator' },
  { name: 'ClipboardDocumentCheckIcon', component: ClipboardDocumentCheckIcon, label: 'Checklist' },
  { name: 'CubeIcon', component: CubeIcon, label: 'Cube' },
  { name: 'CurrencyDollarIcon', component: CurrencyDollarIcon, label: 'Money' },
  { name: 'DocumentTextIcon', component: DocumentTextIcon, label: 'Document' },
  { name: 'EnvelopeIcon', component: EnvelopeIcon, label: 'Email' },
  { name: 'FireIcon', component: FireIcon, label: 'Fire' },
  { name: 'FlagIcon', component: FlagIcon, label: 'Flag' },
  { name: 'HeartIcon', component: HeartIcon, label: 'Heart' },
  { name: 'HomeIcon', component: HomeIcon, label: 'Home' },
  { name: 'KeyIcon', component: KeyIcon, label: 'Key' },
  { name: 'LifebuoyIcon', component: LifebuoyIcon, label: 'Support' },
  { name: 'MapPinIcon', component: MapPinIcon, label: 'Location' },
  { name: 'PencilIcon', component: PencilIcon, label: 'Edit' },
  { name: 'PhoneIcon', component: PhoneIcon, label: 'Phone' },
  { name: 'PuzzlePieceIcon', component: PuzzlePieceIcon, label: 'Plugin' },
  { name: 'SparklesIcon', component: SparklesIcon, label: 'Sparkles' },
  { name: 'StarIcon', component: StarIcon, label: 'Star' },
  { name: 'SunIcon', component: SunIcon, label: 'Sun' },
  { name: 'WrenchScrewdriverIcon', component: WrenchScrewdriverIcon, label: 'Tools' },
]

const filteredIcons = computed(() => {
  if (!searchQuery.value) return availableIcons
  const query = searchQuery.value.toLowerCase()
  return availableIcons.filter(icon => 
    icon.label.toLowerCase().includes(query) || 
    icon.name.toLowerCase().includes(query)
  )
})

const selectedIcon = computed(() => {
  return availableIcons.find(icon => icon.name === props.modelValue)
})

function selectIcon(iconName) {
  emit('update:modelValue', iconName)
  showPicker.value = false
  searchQuery.value = ''
}

function clearIcon() {
  emit('update:modelValue', '')
}
</script>

<template>
  <div class="relative">
    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
      Icon <span class="text-gray-500 text-xs">(Optional)</span>
    </label>
    
    <!-- Selected Icon Display -->
    <div 
      @click="showPicker = !showPicker"
      class="w-full border rounded-lg p-3 bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 cursor-pointer hover:border-gray-400 dark:hover:border-gray-600 transition flex items-center justify-between"
    >
      <div v-if="selectedIcon" class="flex items-center gap-3">
        <div class="h-8 w-8 flex items-center justify-center bg-gray-100 dark:bg-gray-700 rounded-lg">
          <component :is="selectedIcon.component" class="h-5 w-5 text-gray-700 dark:text-gray-300" />
        </div>
        <span class="text-gray-900 dark:text-gray-100 text-sm">{{ selectedIcon.label }}</span>
      </div>
      <span v-else class="text-gray-500 dark:text-gray-400 text-sm">Pilih icon untuk service...</span>
      
      <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
      </svg>
    </div>

    <!-- Icon Picker Modal -->
    <transition
      enter-active-class="transition ease-out duration-200"
      enter-from-class="opacity-0 scale-95"
      enter-to-class="opacity-100 scale-100"
      leave-active-class="transition ease-in duration-100"
      leave-from-class="opacity-100 scale-100"
      leave-to-class="opacity-0 scale-95"
    >
      <div 
        v-if="showPicker" 
        class="absolute z-50 mt-2 w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg shadow-2xl p-4 max-h-[500px] overflow-hidden flex flex-col"
      >
        <!-- Search Box -->
        <div class="mb-3">
          <input
            v-model="searchQuery"
            type="text"
            placeholder="Cari icon..."
            class="w-full border border-gray-300 dark:border-gray-700 rounded-lg p-2 text-sm bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400 focus:border-transparent"
          />
        </div>

        <!-- Clear Selection -->
        <button
          v-if="modelValue"
          @click.stop="clearIcon"
          type="button"
          class="mb-3 w-full text-left px-3 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-500/10 rounded-lg transition"
        >
          ✕ Hapus Icon
        </button>

        <!-- Icons Grid -->
        <div class="overflow-y-auto flex-1">
          <div v-if="filteredIcons.length === 0" class="text-center py-8 text-gray-500 dark:text-gray-400 text-sm">
            Tidak ada icon yang cocok dengan pencarian
          </div>
          <div v-else class="grid grid-cols-4 gap-2">
            <button
              v-for="icon in filteredIcons"
              :key="icon.name"
              type="button"
              @click.stop="selectIcon(icon.name)"
              :class="[
                'flex flex-col items-center gap-2 p-3 rounded-lg transition-all duration-200',
                modelValue === icon.name 
                  ? 'bg-gray-200 dark:bg-gray-700 ring-2 ring-gray-500 dark:ring-gray-400' 
                  : 'hover:bg-gray-100 dark:hover:bg-gray-700'
              ]"
              :title="icon.label"
            >
              <component 
                :is="icon.component" 
                class="h-6 w-6 text-gray-700 dark:text-gray-300" 
              />
              <span class="text-xs text-gray-600 dark:text-gray-400 text-center line-clamp-1">
                {{ icon.label }}
              </span>
            </button>
          </div>
        </div>

        <!-- Footer Info -->
        <div class="mt-3 pt-3 border-t border-gray-200 dark:border-gray-700 text-xs text-gray-500 dark:text-gray-400 text-center">
          {{ filteredIcons.length }} icon tersedia
        </div>
      </div>
    </transition>

    <!-- Backdrop -->
    <div 
      v-if="showPicker"
      @click="showPicker = false"
      class="fixed inset-0 z-40"
    ></div>
  </div>
</template>
