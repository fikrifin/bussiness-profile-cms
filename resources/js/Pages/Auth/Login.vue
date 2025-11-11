<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ArrowRightIcon, EnvelopeIcon, LockClosedIcon } from '@heroicons/vue/24/outline';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Log in" />

    <div class="min-h-screen bg-gradient-to-br from-black via-gray-900 to-black flex items-center justify-center p-4">
        <!-- Animated background pattern -->
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiMyMjIyMjIiIGZpbGwtb3BhY2l0eT0iMC4xIj48cGF0aCBkPSJNMzYgMzRjMC0yLjIxLTEuNzktNC00LTRzLTQgMS43OS00IDQgMS43OSA0IDQgNCA0LTEuNzkgNC00em0wLTEwaC0yYzAtNC40Mi0zLjU4LTgtOC04cy04IDMuNTgtOCA4aDJjMC0zLjMxIDIuNjktNiA2LTZzNiAyLjY5IDYgNnoiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-20"></div>

        <div class="relative w-full max-w-md">
            <!-- Back to home link -->
            <Link :href="route('landing')" class="inline-flex items-center gap-2 text-gray-400 hover:text-white transition mb-8">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Back to Home</span>
            </Link>

            <!-- Login Card -->
            <div class="bg-gradient-to-br from-gray-900 via-gray-800 to-black border border-gray-700 rounded-2xl shadow-2xl p-8 md:p-10">
                <!-- Header -->
                <div class="text-center mb-8">
                    <h1 class="text-3xl md:text-4xl font-bold mb-2">
                        <span class="bg-gradient-to-r from-white via-gray-300 to-gray-500 bg-clip-text text-transparent">
                            Welcome Back
                        </span>
                    </h1>
                    <p class="text-gray-400">Sign in to access your dashboard</p>
                </div>

                <!-- Status message -->
                <div v-if="status" class="mb-6 p-4 rounded-lg bg-emerald-500/10 border border-emerald-500/30">
                    <p class="text-sm text-emerald-400">{{ status }}</p>
                </div>

                <!-- Form -->
                <form @submit.prevent="submit" class="space-y-6">
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <EnvelopeIcon class="h-5 w-5 text-gray-500" />
                            </div>
                            <input
                                id="email"
                                type="email"
                                v-model="form.email"
                                required
                                autofocus
                                autocomplete="username"
                                class="w-full pl-12 pr-4 py-3 bg-black/50 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent transition"
                                placeholder="your@email.com"
                            />
                        </div>
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <LockClosedIcon class="h-5 w-5 text-gray-500" />
                            </div>
                            <input
                                id="password"
                                type="password"
                                v-model="form.password"
                                required
                                autocomplete="current-password"
                                class="w-full pl-12 pr-4 py-3 bg-black/50 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent transition"
                                placeholder="••••••••"
                            />
                        </div>
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <!-- Remember & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center cursor-pointer">
                            <Checkbox name="remember" v-model:checked="form.remember" class="rounded border-gray-600 bg-black/50 text-gray-500 focus:ring-gray-500" />
                            <span class="ml-2 text-sm text-gray-400">Remember me</span>
                        </label>

                        <Link
                            v-if="canResetPassword"
                            :href="route('password.request')"
                            class="text-sm text-gray-400 hover:text-white transition"
                        >
                            Forgot password?
                        </Link>
                    </div>

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="group w-full flex items-center justify-center gap-3 px-6 py-3 rounded-lg bg-gradient-to-r from-gray-100 to-gray-300 text-black font-bold text-lg hover:from-white hover:to-gray-200 transition shadow-lg hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed transform hover:-translate-y-0.5"
                    >
                        <span>{{ form.processing ? 'Signing in...' : 'Sign In' }}</span>
                        <ArrowRightIcon class="h-5 w-5 group-hover:translate-x-1 transition" />
                    </button>
                </form>

                <!-- Footer note -->
                <p class="mt-6 text-center text-sm text-gray-500">
                    Secure login protected by enterprise-grade encryption
                </p>
            </div>
        </div>
    </div>
</template>
