<script setup>
import { useForm, Link } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
const props = defineProps({ page: Object });
const form = useForm({ title: props.page.title, slug: props.page.slug, content: props.page.content || '', meta_title: props.page.meta_title || '', meta_description: props.page.meta_description || '', is_published: props.page.is_published, _method: 'PUT' });
function submit() { form.post(`/admin/pages/${props.page.id}`); }
</script>
<template>
    <AdminLayout><template #title>Edit Page</template>
        <div class="max-w-3xl">
            <div class="flex items-center gap-3 mb-6">
                <Link href="/admin/pages" class="text-gray-500 hover:text-gray-700">← Pages</Link>
                <h2 class="text-xl font-bold">Edit Page: {{ page.title }}</h2>
            </div>
            <form @submit.prevent="submit" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="block text-sm font-medium text-gray-700 mb-1">Title *</label>
                        <input v-model="form.title" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"/></div>
                    <div><label class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                        <input v-model="form.slug" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"/></div>
                </div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                    <textarea v-model="form.content" rows="10" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea></div>
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="block text-sm font-medium text-gray-700 mb-1">Meta Title</label>
                        <input v-model="form.meta_title" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"/></div>
                    <div><label class="block text-sm font-medium text-gray-700 mb-1">Meta Description</label>
                        <input v-model="form.meta_description" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"/></div>
                </div>
                <div class="flex items-center gap-2"><input v-model="form.is_published" type="checkbox" id="pub"/><label for="pub" class="text-sm text-gray-700">Published</label></div>
                <div class="flex gap-3">
                    <button type="submit" :disabled="form.processing" class="bg-blue-800 text-white px-6 py-2 rounded-lg text-sm hover:bg-blue-900 disabled:opacity-50">
                        {{ form.processing ? 'Saving...' : 'Update Page' }}</button>
                    <Link href="/admin/pages" class="bg-gray-100 text-gray-700 px-6 py-2 rounded-lg text-sm hover:bg-gray-200">Cancel</Link>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
