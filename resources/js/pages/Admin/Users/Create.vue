<script setup>
import { useForm, Link } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
defineProps({ roles: Array });
const form = useForm({ name: '', email: '', password: '', password_confirmation: '', role: 'editor' });
function submit() { form.post('/admin/users'); }
</script>
<template>
    <AdminLayout><template #title>Create User</template>
        <div class="max-w-2xl">
            <div class="flex items-center gap-3 mb-6">
                <Link href="/admin/users" class="text-gray-500 hover:text-gray-700">← Users</Link>
                <h2 class="text-xl font-bold">Create User</h2>
            </div>
            <form @submit.prevent="submit" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-4">
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Name *</label>
                    <input v-model="form.name" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                    <p v-if="form.errors.name" class="text-red-600 text-xs mt-1">{{ form.errors.name }}</p></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                    <input v-model="form.email" type="email" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                    <p v-if="form.errors.email" class="text-red-600 text-xs mt-1">{{ form.errors.email }}</p></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Password *</label>
                    <input v-model="form.password" type="password" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                    <p v-if="form.errors.password" class="text-red-600 text-xs mt-1">{{ form.errors.password }}</p></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password *</label>
                    <input v-model="form.password_confirmation" type="password" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"/></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Role *</label>
                    <select v-model="form.role" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option v-for="r in roles" :key="r.id" :value="r.name" class="capitalize">{{ r.name }}</option>
                    </select>
                    <p v-if="form.errors.role" class="text-red-600 text-xs mt-1">{{ form.errors.role }}</p></div>
                <div class="flex gap-3">
                    <button type="submit" :disabled="form.processing" class="bg-blue-800 text-white px-6 py-2 rounded-lg text-sm hover:bg-blue-900 disabled:opacity-50">
                        {{ form.processing ? 'Saving...' : 'Create User' }}</button>
                    <Link href="/admin/users" class="bg-gray-100 text-gray-700 px-6 py-2 rounded-lg text-sm hover:bg-gray-200">Cancel</Link>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
