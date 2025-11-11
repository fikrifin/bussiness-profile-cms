<script setup>
import { ref, onMounted, watch, computed } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link, usePage } from '@inertiajs/vue3';
import { Bars3Icon, XMarkIcon, MoonIcon, SunIcon, HomeIcon, SparklesIcon, WrenchScrewdriverIcon, ChatBubbleLeftEllipsisIcon, BuildingOffice2Icon, PhoneIcon, Cog6ToothIcon } from '@heroicons/vue/24/outline';

const showingNavigationDropdown = ref(false);
const dark = ref(false);
const sidebarOpen = ref(false);
const confirmLogout = ref(false);

const page = usePage();
const isAdmin = computed(() => page?.props?.auth?.user?.is_admin ?? false);

const navItems = computed(() => {
    const items = [
        { label: 'Dashboard', href: route('dashboard'), active: route().current('dashboard'), icon: HomeIcon },
    ];
    if (isAdmin.value) {
        items.push(
            { label: 'Admin', href: route('admin.dashboard'), active: route().current('admin.dashboard'), icon: Cog6ToothIcon },
            { label: 'Hero', href: route('admin.hero-sections.index'), active: route().current('admin.hero-sections.*'), icon: SparklesIcon },
            { label: 'Services', href: route('admin.services.index'), active: route().current('admin.services.*'), icon: WrenchScrewdriverIcon },
            { label: 'Testimonials', href: route('admin.testimonials.index'), active: route().current('admin.testimonials.*'), icon: ChatBubbleLeftEllipsisIcon },
            { label: 'Company', href: route('admin.company-profile.index'), active: route().current('admin.company-profile.*'), icon: BuildingOffice2Icon },
            { label: 'Contact', href: route('admin.contact-info.index'), active: route().current('admin.contact-info.*'), icon: PhoneIcon },
            { label: 'Settings', href: route('admin.settings.index'), active: route().current('admin.settings.*'), icon: Cog6ToothIcon },
        );
    }
    return items;
});

onMounted(() => {
    // Backward compatibility: migrate legacy key `theme.dark` (boolean) to `theme` ('dark'|'light')
    const legacy = localStorage.getItem('theme.dark');
    const stored = localStorage.getItem('theme');

    if (stored === 'dark' || stored === 'light') {
        dark.value = stored === 'dark';
    } else if (legacy === 'true' || legacy === 'false') {
        dark.value = legacy === 'true';
        localStorage.removeItem('theme.dark');
        localStorage.setItem('theme', dark.value ? 'dark' : 'light');
    } else {
        // No preference stored, respect system preference
        const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
        dark.value = !!prefersDark;
        localStorage.setItem('theme', dark.value ? 'dark' : 'light');
    }
    applyDark();
});

function toggleDark() {
    dark.value = !dark.value;
    localStorage.setItem('theme', dark.value ? 'dark' : 'light');
    // Clean up legacy key if present
    localStorage.removeItem('theme.dark');
    applyDark();
}

function applyDark() {
    const root = document.documentElement;
    if (dark.value) {
        root.classList.add('dark');
    } else {
        root.classList.remove('dark');
    }
}
</script>

<template>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-black dark:via-gray-900 dark:to-black">
            <nav class="border-b border-gray-200 dark:border-gray-800 bg-white dark:bg-gradient-to-br dark:from-gray-900 dark:to-black sm:hidden">
                <!-- Primary Navigation Menu -->
                <div class="px-4">
                    <div class="flex h-16 justify-between">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="flex shrink-0 items-center gap-4">
                                <Link :href="route('dashboard')">
                                    <ApplicationLogo
                                        class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-100"
                                    />
                                </Link>
                                <button @click="toggleDark" type="button" class="rounded-md p-2 text-sm font-medium border border-gray-300 dark:border-gray-700 bg-gray-100 hover:bg-gray-200 dark:bg-black/30 dark:hover:bg-black/50 text-gray-700 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white transition">
                                    <component :is="dark ? SunIcon : MoonIcon" class="h-5 w-5" />
                                </button>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden"></div>
                        </div>

                        <div class="flex items-center gap-2">
                            <button @click="sidebarOpen = true" class="inline-flex items-center justify-center rounded-md p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-black/30 dark:hover:text-white">
                                <Bars3Icon class="h-6 w-6" />
                            </button>
                        </div>

                        <!-- Hamburger -->
                        <div class="hidden"></div>
                    </div>
                </div>

            </nav>

        <div class="flex">
            <!-- Desktop Sidebar -->
            <aside class="hidden sm:flex sm:flex-col sm:w-64 border-r border-gray-200 dark:border-gray-800 bg-white dark:bg-gradient-to-b dark:from-gray-900 dark:via-gray-800 dark:to-black h-screen fixed top-0 left-0 z-30 shadow-lg">
                <div class="h-16 flex items-center px-4 border-b border-gray-200 dark:border-gray-800">
                    <Link :href="route('dashboard')" class="flex items-center gap-2">
                        <ApplicationLogo class="block h-7 w-auto fill-current text-gray-800 dark:text-gray-100" />
                        <span class="font-bold text-gray-900 dark:text-white">CMS</span>
                    </Link>
                </div>
                <nav class="flex-1 p-3 space-y-1 overflow-y-auto">
                    <Link v-for="item in navItems" :key="item.label" :href="item.href" class="group flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200"
                          :class="item.active ? 'bg-gradient-to-r from-indigo-500 to-indigo-600 dark:from-gray-700 dark:to-gray-800 text-white shadow-lg border border-indigo-600 dark:border-gray-600' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-black/30 dark:hover:text-white border border-transparent'">
                        <component :is="item.icon" class="h-5 w-5" />
                        <span>{{ item.label }}</span>
                    </Link>
                </nav>
                <div class="p-3 border-t border-gray-200 dark:border-gray-800 space-y-3">
                    <button @click="toggleDark" class="inline-flex items-center gap-2 px-3 py-2 rounded-lg text-sm bg-gray-100 hover:bg-gray-200 dark:bg-black/30 dark:hover:bg-black/50 border border-gray-300 dark:border-gray-700 text-gray-700 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white w-full justify-center font-medium transition">
                        <component :is="dark ? SunIcon : MoonIcon" class="h-4 w-4" />
                        <span>{{ dark ? 'Light' : 'Dark' }}</span>
                    </button>
                    <div class="relative">
                        <Dropdown align="top-right" width="48">
                            <template #trigger>
                                <span class="inline-flex rounded-md w-full">
                                    <button type="button" class="inline-flex items-center gap-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-100 hover:bg-gray-200 dark:bg-black/30 dark:hover:bg-black/50 px-3 py-2 text-sm font-medium leading-4 text-gray-700 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white focus:outline-none w-full transition">
                                        <span class="inline-flex items-center justify-center h-7 w-7 rounded-full bg-gradient-to-br from-indigo-500 to-indigo-600 dark:from-gray-600 dark:to-gray-700 text-white text-xs font-semibold shadow-lg">
                                            {{ (page.props.auth.user.name || 'U')[0].toUpperCase() }}
                                        </span>
                                        <span class="truncate flex-1 text-left">{{ page.props.auth.user.name }}</span>
                                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            </template>
                            <template #content>
                                <DropdownLink :href="route('profile.edit')">Profile</DropdownLink>
                                <button @click="confirmLogout = true" class="block w-full text-start px-4 py-2 text-sm leading-5 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-500/10 focus:bg-red-50 dark:focus:bg-red-500/10 focus:outline-none">Log Out</button>
                            </template>
                        </Dropdown>
                        <!-- Logout Confirmation Modal (fixed positioning above sidebar) -->
                        <transition enter-active-class="duration-150 ease-out" enter-from-class="opacity-0 scale-95" enter-to-class="opacity-100 scale-100" leave-active-class="duration-100 ease-in" leave-from-class="opacity-100 scale-100" leave-to-class="opacity-0 scale-95">
                            <div v-if="confirmLogout" class="fixed inset-0 z-[100] flex items-center justify-center p-4">
                                <div class="fixed inset-0 bg-black/70 backdrop-blur-sm" @click="confirmLogout = false"></div>
                                <div class="relative bg-white dark:bg-gradient-to-br dark:from-gray-900 dark:to-black border border-gray-200 dark:border-gray-700 rounded-2xl shadow-2xl ring-1 ring-gray-200 dark:ring-gray-700 p-6 w-full max-w-sm space-y-4">
                                    <h3 class="text-lg font-bold bg-gradient-to-r from-gray-900 to-gray-600 dark:from-white dark:to-gray-400 bg-clip-text text-transparent">Konfirmasi Logout</h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Apakah Anda yakin ingin keluar dari sesi ini?</p>
                                    <div class="flex justify-end gap-2 pt-2">
                                        <button @click="confirmLogout = false" class="px-4 py-2 rounded-lg text-sm font-medium bg-gray-200 hover:bg-gray-300 dark:bg-black/30 dark:hover:bg-black/50 border border-gray-300 dark:border-gray-700 text-gray-700 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white transition">Batal</button>
                                        <button @click="$inertia.post(route('logout'))" class="px-4 py-2 rounded-lg text-sm font-bold bg-gradient-to-r from-red-600 to-red-700 hover:from-red-500 hover:to-red-600 text-white shadow-lg transition">Logout</button>
                                    </div>
                                </div>
                            </div>
                        </transition>
                    </div>
                </div>
            </aside>

            <!-- Mobile Sidebar Drawer -->
            <transition name="fade">
                <div v-if="sidebarOpen" class="fixed inset-0 z-40 flex sm:hidden">
                    <div class="fixed inset-0 bg-black/70" @click="sidebarOpen = false"></div>
                    <aside class="relative z-50 w-72 bg-white dark:bg-gradient-to-b dark:from-gray-900 dark:via-gray-800 dark:to-black h-full shadow-2xl border-r border-gray-200 dark:border-gray-800">
                        <div class="h-16 flex items-center justify-between px-4 border-b border-gray-200 dark:border-gray-800">
                            <Link :href="route('dashboard')" class="flex items-center gap-2">
                                <ApplicationLogo class="block h-7 w-auto fill-current text-gray-800 dark:text-gray-100" />
                                <span class="font-bold text-gray-900 dark:text-white">CMS</span>
                            </Link>
                            <button @click="sidebarOpen = false" class="p-2 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-black/30 dark:hover:text-white">
                                <XMarkIcon class="h-6 w-6" />
                            </button>
                        </div>
                        <nav class="p-3 space-y-1 overflow-y-auto">
                            <Link v-for="item in navItems" :key="item.label" :href="item.href" class="group flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200"
                                  :class="item.active ? 'bg-gradient-to-r from-indigo-500 to-indigo-600 dark:from-gray-700 dark:to-gray-800 text-white shadow-lg border border-indigo-600 dark:border-gray-600' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-black/30 dark:hover:text-white border border-transparent'">
                                <component :is="item.icon" class="h-5 w-5" />
                                <span>{{ item.label }}</span>
                            </Link>
                        </nav>
                    </aside>
                </div>
            </transition>

            <!-- Main content -->
            <div class="flex-1 min-w-0 sm:ml-64">
                <!-- Page Heading -->
                <header class="bg-white dark:bg-gradient-to-r dark:from-gray-900 dark:to-black border-b border-gray-200 dark:border-gray-800 shadow-sm dark:shadow-lg" v-if="$slots.header">
                    <div class="px-4 py-6 sm:px-6 lg:px-8">
                        <slot name="header" />
                    </div>
                </header>
                <main>
                    <slot />
                </main>
            </div>
        </div>
    </div>
</template>
