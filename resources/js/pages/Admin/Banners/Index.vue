<script setup>
import { Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';

defineProps({ banners: Array });

function del(id) {
    if (confirm('Delete this banner?')) router.delete(`/admin/banners/${id}`);
}
</script>
<template>
    <AdminLayout>
        <template #title>Banners</template>
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-gray-900">Banners</h2>
            <Link href="/admin/banners/create" class="bg-blue-800 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-900">+ Add Banner</Link>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b">
                    <tr><th class="px-4 py-3 text-left text-gray-600">Title</th><th class="px-4 py-3 text-left text-gray-600">Order</th><th class="px-4 py-3 text-left text-gray-600">Status</th><th class="px-4 py-3 text-left text-gray-600">Actions</th></tr>
                </thead>
                <tbody>
                    <tr v-for="b in banners" :key="b.id" class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-gray-900">{{ b.title }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ b.sort_order }}</td>
                        <td class="px-4 py-3"><span :class="b.is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600'" class="px-2 py-0.5 rounded-full text-xs">{{ b.is_active ? 'Active' : 'Inactive' }}</span></td>
                        <td class="px-4 py-3 flex gap-2">
                            <Link :href="`/admin/banners/${b.id}/edit`" class="text-blue-600 hover:underline">Edit</Link>
                            <button @click="del(b.id)" class="text-red-600 hover:underline">Delete</button>
                        </td>
                    </tr>
                    <tr v-if="!banners?.length"><td colspan="4" class="px-4 py-8 text-center text-gray-400">No banners yet.</td></tr>
                </tbody>
            </table>
        </div>
    </AdminLayout>
</template>
