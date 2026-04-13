<script setup>
import { useForm, Link } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';

const props = defineProps({ banner: Object });
const form = useForm({ title: props.banner.title, subtitle: props.banner.subtitle || '', link: props.banner.link || '', is_active: props.banner.is_active, sort_order: props.banner.sort_order, image: null, _method: 'PUT' });
function submit() { form.post(`/admin/banners/${props.banner.id}`, { forceFormData: true }); }
</script>
<template>
    <AdminLayout>
        <template #title>Edit Banner</template>
        <div class="max-w-2xl">
            <div class="flex items-center gap-3 mb-6">
                <Link href="/admin/banners" class="text-gray-500 hover:text-gray-700">← Banners</Link>
                <h2 class="text-xl font-bold text-gray-900">Edit Banner</h2>
            </div>
            <form @submit.prevent="submit" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-4">
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Title *</label>
                    <input v-model="form.title" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                    <p v-if="form.errors.title" class="text-red-600 text-xs mt-1">{{ form.errors.title }}</p></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Subtitle</label>
                    <input v-model="form.subtitle" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"/></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Link</label>
                    <input v-model="form.link" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"/></div>
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="block text-sm font-medium text-gray-700 mb-1">Sort Order</label>
                        <input v-model="form.sort_order" type="number" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"/></div>
                    <div class="flex items-center gap-2 mt-6"><input v-model="form.is_active" type="checkbox" id="active"/><label for="active" class="text-sm text-gray-700">Active</label></div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                    <div v-if="banner.image" class="mb-2"><img :src="`/storage/${banner.image}`" class="h-24 rounded-lg object-cover"/></div>
                    <input type="file" accept="image/*" @change="e => form.image = e.target.files[0]" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm"/>
                </div>
                <div class="flex gap-3">
                    <button type="submit" :disabled="form.processing" class="bg-blue-800 text-white px-6 py-2 rounded-lg text-sm hover:bg-blue-900 disabled:opacity-50">
                        {{ form.processing ? 'Saving...' : 'Update Banner' }}
                    </button>
                    <Link href="/admin/banners" class="bg-gray-100 text-gray-700 px-6 py-2 rounded-lg text-sm hover:bg-gray-200">Cancel</Link>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
