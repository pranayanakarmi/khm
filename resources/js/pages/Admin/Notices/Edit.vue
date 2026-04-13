<script setup>
import { useForm, Link } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
const props = defineProps({ notice: Object });
const form = useForm({ title: props.notice.title, slug: props.notice.slug, category: props.notice.category, content: props.notice.content || '', is_published: props.notice.is_published, published_at: props.notice.published_at || '', attachment: null, image: null, _method: 'PUT' });
function submit() { form.post(`/admin/notices/${props.notice.id}`, { forceFormData: true }); }
const cats = ['general', 'academic', 'admission', 'exam'];
</script>
<template>
    <AdminLayout><template #title>Edit Notice</template>
        <div class="max-w-3xl">
            <div class="flex items-center gap-3 mb-6">
                <Link href="/admin/notices" class="text-gray-500 hover:text-gray-700">← Notices</Link>
                <h2 class="text-xl font-bold">Edit Notice</h2>
            </div>
            <form @submit.prevent="submit" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-4">
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Title *</label>
                    <input v-model="form.title" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                    <p v-if="form.errors.title" class="text-red-600 text-xs mt-1">{{ form.errors.title }}</p></div>
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                        <select v-model="form.category" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option v-for="c in cats" :key="c" :value="c" class="capitalize">{{ c }}</option>
                        </select></div>
                    <div><label class="block text-sm font-medium text-gray-700 mb-1">Published Date</label>
                        <input v-model="form.published_at" type="date" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"/></div>
                </div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                    <textarea v-model="form.content" rows="6" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea></div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Attachment</label>
                        <div v-if="notice.attachment" class="text-xs text-gray-500 mb-1">Current: {{ notice.attachment.split('/').pop() }}</div>
                        <input type="file" @change="e => form.attachment = e.target.files[0]" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm"/>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                        <div v-if="notice.image" class="mb-1"><img :src="`/storage/${notice.image}`" class="h-12 rounded object-cover"/></div>
                        <input type="file" accept="image/*" @change="e => form.image = e.target.files[0]" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm"/>
                    </div>
                </div>
                <div class="flex items-center gap-2"><input v-model="form.is_published" type="checkbox" id="pub"/><label for="pub" class="text-sm text-gray-700">Published</label></div>
                <div class="flex gap-3">
                    <button type="submit" :disabled="form.processing" class="bg-blue-800 text-white px-6 py-2 rounded-lg text-sm hover:bg-blue-900 disabled:opacity-50">
                        {{ form.processing ? 'Saving...' : 'Update Notice' }}</button>
                    <Link href="/admin/notices" class="bg-gray-100 text-gray-700 px-6 py-2 rounded-lg text-sm hover:bg-gray-200">Cancel</Link>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
