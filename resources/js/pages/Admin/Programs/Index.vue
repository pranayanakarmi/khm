<script setup>
import { Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
defineProps({ programs: Array });
function del(id) { if (confirm('Delete this program?')) router.delete(`/admin/programs/${id}`); }
</script>
<template>
    <AdminLayout>
        <template #title>Programs</template>
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold">Programs</h2>
            <Link href="/admin/programs/create" class="bg-blue-800 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-900">+ Add Program</Link>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b"><tr>
                    <th class="px-4 py-3 text-left text-gray-600">Title</th>
                    <th class="px-4 py-3 text-left text-gray-600">Category</th>
                    <th class="px-4 py-3 text-left text-gray-600">Duration</th>
                    <th class="px-4 py-3 text-left text-gray-600">Status</th>
                    <th class="px-4 py-3 text-left text-gray-600">Actions</th>
                </tr></thead>
                <tbody>
                    <tr v-for="p in programs" :key="p.id" class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-gray-900">{{ p.title }}</td>
                        <td class="px-4 py-3 text-gray-600 capitalize">{{ p.category }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ p.duration }}</td>
                        <td class="px-4 py-3"><span :class="p.is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600'" class="px-2 py-0.5 rounded-full text-xs">{{ p.is_active ? 'Active' : 'Inactive' }}</span></td>
                        <td class="px-4 py-3 flex gap-2">
                            <Link :href="`/admin/programs/${p.id}/edit`" class="text-blue-600 hover:underline">Edit</Link>
                            <button @click="del(p.id)" class="text-red-600 hover:underline">Delete</button>
                        </td>
                    </tr>
                    <tr v-if="!programs?.length"><td colspan="5" class="px-4 py-8 text-center text-gray-400">No programs yet.</td></tr>
                </tbody>
            </table>
        </div>
    </AdminLayout>
</template>
