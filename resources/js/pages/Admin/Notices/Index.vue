<script setup>
import { Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
defineProps({ notices: Array });
function del(id) { if (confirm('Delete?')) router.delete(`/admin/notices/${id}`); }
</script>
<template>
    <AdminLayout><template #title>Notices</template>
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold">Notices</h2>
            <Link href="/admin/notices/create" class="bg-blue-800 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-900">+ Add Notice</Link>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b"><tr>
                    <th class="px-4 py-3 text-left text-gray-600">Title</th>
                    <th class="px-4 py-3 text-left text-gray-600">Category</th>
                    <th class="px-4 py-3 text-left text-gray-600">Published</th>
                    <th class="px-4 py-3 text-left text-gray-600">Status</th>
                    <th class="px-4 py-3 text-left text-gray-600">Actions</th>
                </tr></thead>
                <tbody>
                    <tr v-for="n in notices" :key="n.id" class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-gray-900 max-w-xs truncate">{{ n.title }}</td>
                        <td class="px-4 py-3 capitalize text-gray-600">{{ n.category }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ n.published_at }}</td>
                        <td class="px-4 py-3"><span :class="n.is_published ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700'" class="px-2 py-0.5 rounded-full text-xs">{{ n.is_published ? 'Published' : 'Draft' }}</span></td>
                        <td class="px-4 py-3 flex gap-2">
                            <Link :href="`/admin/notices/${n.id}/edit`" class="text-blue-600 hover:underline">Edit</Link>
                            <button @click="del(n.id)" class="text-red-600 hover:underline">Delete</button>
                        </td>
                    </tr>
                    <tr v-if="!notices?.length"><td colspan="5" class="px-4 py-8 text-center text-gray-400">No notices yet.</td></tr>
                </tbody>
            </table>
        </div>
    </AdminLayout>
</template>
