<script setup>
import { useForm, Link } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
const props = defineProps({ event: Object });
const fmt = (d) => d ? d.replace(' ', 'T').substring(0, 16) : '';
const form = useForm({ title: props.event.title, slug: props.event.slug, type: props.event.type, description: props.event.description || '', location: props.event.location || '', organizer: props.event.organizer || '', start_date: fmt(props.event.start_date), end_date: fmt(props.event.end_date), is_published: props.event.is_published, image: null, _method: 'PUT' });
function submit() { form.post(`/admin/events/${props.event.id}`, { forceFormData: true }); }
const types = ['event', 'training', 'workshop', 'seminar', 'conference'];
</script>
<template>
    <AdminLayout><template #title>Edit Event</template>
        <div class="max-w-3xl">
            <div class="flex items-center gap-3 mb-6">
                <Link href="/admin/events" class="text-gray-500 hover:text-gray-700">← Events</Link>
                <h2 class="text-xl font-bold">Edit Event</h2>
            </div>
            <form @submit.prevent="submit" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="block text-sm font-medium text-gray-700 mb-1">Title *</label>
                        <input v-model="form.title" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                        <p v-if="form.errors.title" class="text-red-600 text-xs mt-1">{{ form.errors.title }}</p></div>
                    <div><label class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                        <select v-model="form.type" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option v-for="t in types" :key="t" :value="t" class="capitalize">{{ t }}</option>
                        </select></div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="block text-sm font-medium text-gray-700 mb-1">Start Date *</label>
                        <input v-model="form.start_date" type="datetime-local" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"/></div>
                    <div><label class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                        <input v-model="form.end_date" type="datetime-local" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"/></div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                        <input v-model="form.location" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"/></div>
                    <div><label class="block text-sm font-medium text-gray-700 mb-1">Organizer</label>
                        <input v-model="form.organizer" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"/></div>
                </div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea v-model="form.description" rows="5" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea></div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                    <div v-if="event.image" class="mb-2"><img :src="`/storage/${event.image}`" class="h-20 rounded-lg object-cover"/></div>
                    <input type="file" accept="image/*" @change="e => form.image = e.target.files[0]" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm"/>
                </div>
                <div class="flex items-center gap-2"><input v-model="form.is_published" type="checkbox" id="pub"/><label for="pub" class="text-sm text-gray-700">Published</label></div>
                <div class="flex gap-3">
                    <button type="submit" :disabled="form.processing" class="bg-blue-800 text-white px-6 py-2 rounded-lg text-sm hover:bg-blue-900 disabled:opacity-50">
                        {{ form.processing ? 'Saving...' : 'Update Event' }}</button>
                    <Link href="/admin/events" class="bg-gray-100 text-gray-700 px-6 py-2 rounded-lg text-sm hover:bg-gray-200">Cancel</Link>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
