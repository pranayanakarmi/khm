<script setup>
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

function submit() {
    form.post('/admin/login');
}
</script>

<template>
    <div class="min-h-screen bg-blue-900 flex items-center justify-center px-4">
        <div class="w-full max-w-md">
            <!-- Logo -->
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center text-blue-900 font-bold text-xl mx-auto mb-3">KMH</div>
                <h1 class="text-2xl font-bold text-white">KMH Academics</h1>
                <p class="text-blue-300 text-sm mt-1">Admin Panel</p>
            </div>

            <div class="bg-white rounded-2xl shadow-xl p-8">
                <h2 class="text-xl font-bold text-gray-900 mb-6 text-center">Sign In</h2>

                <form @submit.prevent="submit" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <input v-model="form.email" type="email" required autofocus
                            class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="admin@kmh.edu.np"/>
                        <p v-if="form.errors.email" class="text-red-600 text-xs mt-1">{{ form.errors.email }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input v-model="form.password" type="password" required
                            class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="••••••••"/>
                        <p v-if="form.errors.password" class="text-red-600 text-xs mt-1">{{ form.errors.password }}</p>
                    </div>
                    <div class="flex items-center">
                        <input v-model="form.remember" id="remember" type="checkbox" class="mr-2"/>
                        <label for="remember" class="text-sm text-gray-600">Remember me</label>
                    </div>
                    <button type="submit" :disabled="form.processing"
                        class="w-full bg-blue-800 text-white py-3 rounded-lg font-semibold hover:bg-blue-900 transition-colors disabled:opacity-50">
                        {{ form.processing ? 'Signing in...' : 'Sign In' }}
                    </button>
                </form>
            </div>

            <p class="text-center text-blue-400 text-xs mt-6">
                Powered by <a href="https://venturefour.com.np" class="text-blue-300 hover:text-white">Venture Four Technology</a>
            </p>
        </div>
    </div>
</template>
