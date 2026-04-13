<script setup>
import { useForm, Link } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
const form = useForm({ title: '', category: 'general', description: '', is_active: true, sort_order: 0, file: null });
function submit() { form.post('/admin/downloads', { forceFormData: true }); }
const cats = ['general', 'academic', 'administrative', 'forms'];
</script>
<template>
    <AdminLayout><template #title>Create Download</template>
        <div class="max-w-2xl">
            <div class="flex items-center gap-3 mb-6">
                <Link href="/admin/downloads" class="text-gray-500 hover:text-gray-700">← Downloads</Link>
                <h2 class="text-xl font-bold">Create Download</h2>
            </div>
            <form @submit.prevent="submit" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-4">
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Title *</label>
                    <input v-model="form.title" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                    <p v-if="form.errors.title" class="text-red-600 text-xs mt-1">{{ form.errors.title }}</p></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select v-model="form.category" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option v-for="c in cats" :key="c" :value="c" class="capitalize">{{ c }}</option>
                    </select></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <input v-model="form.description" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"/></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">File *</label>
                    <input type="file" required @change="e => form.file = e.target.files[0]" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm"/>
                    <p v-if="form.errors.file" class="text-red-600 text-xs mt-1">{{ form.errors.file }}</p></div>
                <div class="flex items-center gap-2"><input v-model="form.is_active" type="checkbox" id="active"/><label for="active" class="text-sm text-gray-700">Active</label></div>
                <div class="flex gap-3">
                    <button type="submit" :disabled="form.processing" class="bg-blue-800 text-white px-6 py-2 rounded-lg text-sm hover:bg-blue-900 disabled:opacity-50">
                        {{ form.processing ? 'Saving...' : 'Create Download' }}</button>
                    <Link href="/admin/downloads" class="bg-gray-100 text-gray-700 px-6 py-2 rounded-lg text-sm hover:bg-gray-200">Cancel</Link>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
