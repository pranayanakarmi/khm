<script setup>
import { useForm, Link } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
const form = useForm({ question: '', answer: '', category: 'general', is_active: true, sort_order: 0 });
function submit() { form.post('/admin/faqs'); }
const cats = ['general', 'academic', 'admission', 'financial', 'facilities'];
</script>
<template>
    <AdminLayout><template #title>Create FAQ</template>
        <div class="max-w-2xl">
            <div class="flex items-center gap-3 mb-6">
                <Link href="/admin/faqs" class="text-gray-500 hover:text-gray-700">← FAQs</Link>
                <h2 class="text-xl font-bold">Create FAQ</h2>
            </div>
            <form @submit.prevent="submit" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-4">
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Question *</label>
                    <input v-model="form.question" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                    <p v-if="form.errors.question" class="text-red-600 text-xs mt-1">{{ form.errors.question }}</p></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Answer *</label>
                    <textarea v-model="form.answer" required rows="5" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    <p v-if="form.errors.answer" class="text-red-600 text-xs mt-1">{{ form.errors.answer }}</p></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select v-model="form.category" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option v-for="c in cats" :key="c" :value="c" class="capitalize">{{ c }}</option>
                    </select></div>
                <div class="flex items-center gap-2"><input v-model="form.is_active" type="checkbox" id="active"/><label for="active" class="text-sm text-gray-700">Active</label></div>
                <div class="flex gap-3">
                    <button type="submit" :disabled="form.processing" class="bg-blue-800 text-white px-6 py-2 rounded-lg text-sm hover:bg-blue-900 disabled:opacity-50">
                        {{ form.processing ? 'Saving...' : 'Create FAQ' }}</button>
                    <Link href="/admin/faqs" class="bg-gray-100 text-gray-700 px-6 py-2 rounded-lg text-sm hover:bg-gray-200">Cancel</Link>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
