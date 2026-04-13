<script setup>
import { useForm, Link } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
const props = defineProps({ user: Object, roles: Array });
const form = useForm({ name: props.user.name, email: props.user.email, password: '', password_confirmation: '', role: props.user.role || 'editor', _method: 'PUT' });
function submit() { form.post(`/admin/users/${props.user.id}`); }
</script>
<template>
    <AdminLayout><template #title>Edit User</template>
        <div class="max-w-2xl">
            <div class="flex items-center gap-3 mb-6">
                <Link href="/admin/users" class="text-gray-500 hover:text-gray-700">← Users</Link>
                <h2 class="text-xl font-bold">Edit User</h2>
            </div>
            <form @submit.prevent="submit" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-4">
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Name *</label>
                    <input v-model="form.name" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"/></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                    <input v-model="form.email" type="email" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"/></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">New Password (leave blank to keep)</label>
                    <input v-model="form.password" type="password" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"/></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                    <input v-model="form.password_confirmation" type="password" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"/></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Role *</label>
                    <select v-model="form.role" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option v-for="r in roles" :key="r.id" :value="r.name" class="capitalize">{{ r.name }}</option>
                    </select></div>
                <div class="flex gap-3">
                    <button type="submit" :disabled="form.processing" class="bg-blue-800 text-white px-6 py-2 rounded-lg text-sm hover:bg-blue-900 disabled:opacity-50">
                        {{ form.processing ? 'Saving...' : 'Update User' }}</button>
                    <Link href="/admin/users" class="bg-gray-100 text-gray-700 px-6 py-2 rounded-lg text-sm hover:bg-gray-200">Cancel</Link>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
