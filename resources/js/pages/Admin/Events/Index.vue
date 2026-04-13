<script setup>
import { Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
defineProps({ events: Array });
function del(id) { if (confirm('Delete?')) router.delete(`/admin/events/${id}`); }
</script>
<template>
    <AdminLayout><template #title>Events</template>
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold">Events & Trainings</h2>
            <Link href="/admin/events/create" class="bg-blue-800 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-900">+ Add Event</Link>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b"><tr>
                    <th class="px-4 py-3 text-left text-gray-600">Title</th>
                    <th class="px-4 py-3 text-left text-gray-600">Type</th>
                    <th class="px-4 py-3 text-left text-gray-600">Start Date</th>
                    <th class="px-4 py-3 text-left text-gray-600">Status</th>
                    <th class="px-4 py-3 text-left text-gray-600">Actions</th>
                </tr></thead>
                <tbody>
                    <tr v-for="e in events" :key="e.id" class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-gray-900">{{ e.title }}</td>
                        <td class="px-4 py-3 capitalize text-gray-600">{{ e.type }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ e.start_date }}</td>
                        <td class="px-4 py-3"><span :class="e.is_published ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700'" class="px-2 py-0.5 rounded-full text-xs">{{ e.is_published ? 'Published' : 'Draft' }}</span></td>
                        <td class="px-4 py-3 flex gap-2">
                            <Link :href="`/admin/events/${e.id}/edit`" class="text-blue-600 hover:underline">Edit</Link>
                            <button @click="del(e.id)" class="text-red-600 hover:underline">Delete</button>
                        </td>
                    </tr>
                    <tr v-if="!events?.length"><td colspan="5" class="px-4 py-8 text-center text-gray-400">No events yet.</td></tr>
                </tbody>
            </table>
        </div>
    </AdminLayout>
</template>
