<script setup>
import { Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
defineProps({ faqs: Array });
function del(id) { if (confirm('Delete?')) router.delete(`/admin/faqs/${id}`); }
</script>
<template>
    <AdminLayout><template #title>FAQs</template>
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold">FAQs</h2>
            <Link href="/admin/faqs/create" class="bg-blue-800 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-900">+ Add FAQ</Link>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b"><tr>
                    <th class="px-4 py-3 text-left text-gray-600">Question</th>
                    <th class="px-4 py-3 text-left text-gray-600">Category</th>
                    <th class="px-4 py-3 text-left text-gray-600">Status</th>
                    <th class="px-4 py-3 text-left text-gray-600">Actions</th>
                </tr></thead>
                <tbody>
                    <tr v-for="f in faqs" :key="f.id" class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-gray-900 max-w-xs truncate">{{ f.question }}</td>
                        <td class="px-4 py-3 capitalize text-gray-600">{{ f.category }}</td>
                        <td class="px-4 py-3"><span :class="f.is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600'" class="px-2 py-0.5 rounded-full text-xs">{{ f.is_active ? 'Active' : 'Inactive' }}</span></td>
                        <td class="px-4 py-3 flex gap-2">
                            <Link :href="`/admin/faqs/${f.id}/edit`" class="text-blue-600 hover:underline">Edit</Link>
                            <button @click="del(f.id)" class="text-red-600 hover:underline">Delete</button>
                        </td>
                    </tr>
                    <tr v-if="!faqs?.length"><td colspan="4" class="px-4 py-8 text-center text-gray-400">No FAQs yet.</td></tr>
                </tbody>
            </table>
        </div>
    </AdminLayout>
</template>
