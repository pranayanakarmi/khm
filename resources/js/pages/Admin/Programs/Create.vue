<script setup>
import { useForm, Link } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
const form = useForm({ title: '', slug: '', category: '', description: '', duration: '', intake: '', eligibility: '', is_active: true, sort_order: 0, image: null });
function submit() { form.post('/admin/programs', { forceFormData: true }); }
const cats = ['Undergraduate', 'Postgraduate', 'Certificate', 'Diploma'];
</script>
<template>
    <AdminLayout>
        <template #title>Create Program</template>
        <div class="max-w-3xl">
            <div class="flex items-center gap-3 mb-6">
                <Link href="/admin/programs" class="text-gray-500 hover:text-gray-700">← Programs</Link>
                <h2 class="text-xl font-bold">Create Program</h2>
            </div>
            <form @submit.prevent="submit" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="block text-sm font-medium text-gray-700 mb-1">Title *</label>
                        <input v-model="form.title" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                        <p v-if="form.errors.title" class="text-red-600 text-xs mt-1">{{ form.errors.title }}</p></div>
                    <div><label class="block text-sm font-medium text-gray-700 mb-1">Slug (auto)</label>
                        <input v-model="form.slug" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"/></div>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <div><label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                        <select v-model="form.category" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Select...</option>
                            <option v-for="c in cats" :key="c">{{ c }}</option>
                        </select></div>
                    <div><label class="block text-sm font-medium text-gray-700 mb-1">Duration</label>
                        <input v-model="form.duration" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"/></div>
                    <div><label class="block text-sm font-medium text-gray-700 mb-1">Intake</label>
                        <input v-model="form.intake" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"/></div>
                </div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Eligibility</label>
                    <input v-model="form.eligibility" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"/></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea v-model="form.description" rows="5" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea></div>
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                        <input type="file" accept="image/*" @change="e => form.image = e.target.files[0]" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm"/></div>
                    <div class="flex items-center gap-2 mt-6"><input v-model="form.is_active" type="checkbox" id="active"/><label for="active" class="text-sm text-gray-700">Active</label></div>
                </div>
                <div class="flex gap-3">
                    <button type="submit" :disabled="form.processing" class="bg-blue-800 text-white px-6 py-2 rounded-lg text-sm hover:bg-blue-900 disabled:opacity-50">
                        {{ form.processing ? 'Saving...' : 'Create Program' }}</button>
                    <Link href="/admin/programs" class="bg-gray-100 text-gray-700 px-6 py-2 rounded-lg text-sm hover:bg-gray-200">Cancel</Link>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
