<script setup>
import { Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
defineProps({ downloads: Array });
function del(id) { if (confirm('Delete?')) router.delete(`/admin/downloads/${id}`); }
</script>
<template>
    <AdminLayout><template #title>Downloads</template>
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold">Downloads</h2>
            <Link href="/admin/downloads/create" class="bg-blue-800 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-900">+ Add Download</Link>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b"><tr>
                    <th class="px-4 py-3 text-left text-gray-600">Title</th>
                    <th class="px-4 py-3 text-left text-gray-600">Category</th>
                    <th class="px-4 py-3 text-left text-gray-600">Size</th>
                    <th class="px-4 py-3 text-left text-gray-600">Downloads</th>
                    <th class="px-4 py-3 text-left text-gray-600">Status</th>
                    <th class="px-4 py-3 text-left text-gray-600">Actions</th>
                </tr></thead>
                <tbody>
                    <tr v-for="d in downloads" :key="d.id" class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-gray-900">{{ d.title }}</td>
                        <td class="px-4 py-3 capitalize text-gray-600">{{ d.category }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ d.file_size }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ d.download_count }}</td>
                        <td class="px-4 py-3"><span :class="d.is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600'" class="px-2 py-0.5 rounded-full text-xs">{{ d.is_active ? 'Active' : 'Inactive' }}</span></td>
                        <td class="px-4 py-3 flex gap-2">
                            <Link :href="`/admin/downloads/${d.id}/edit`" class="text-blue-600 hover:underline">Edit</Link>
                            <button @click="del(d.id)" class="text-red-600 hover:underline">Delete</button>
                        </td>
                    </tr>
                    <tr v-if="!downloads?.length"><td colspan="6" class="px-4 py-8 text-center text-gray-400">No downloads yet.</td></tr>
                </tbody>
            </table>
        </div>
    </AdminLayout>
</template>
