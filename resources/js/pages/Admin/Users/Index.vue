<script setup>
import { Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
defineProps({ users: Array });
function del(id) { if (confirm('Delete this user?')) router.delete(`/admin/users/${id}`); }
</script>
<template>
    <AdminLayout><template #title>Users</template>
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold">Users</h2>
            <Link href="/admin/users/create" class="bg-blue-800 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-900">+ Add User</Link>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b"><tr>
                    <th class="px-4 py-3 text-left text-gray-600">Name</th>
                    <th class="px-4 py-3 text-left text-gray-600">Email</th>
                    <th class="px-4 py-3 text-left text-gray-600">Role</th>
                    <th class="px-4 py-3 text-left text-gray-600">Joined</th>
                    <th class="px-4 py-3 text-left text-gray-600">Actions</th>
                </tr></thead>
                <tbody>
                    <tr v-for="u in users" :key="u.id" class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-gray-900">{{ u.name }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ u.email }}</td>
                        <td class="px-4 py-3">
                            <span v-for="r in u.roles" :key="r.id" class="px-2 py-0.5 rounded-full text-xs bg-blue-100 text-blue-700 capitalize">{{ r.name }}</span>
                        </td>
                        <td class="px-4 py-3 text-gray-600">{{ u.created_at?.substring(0,10) }}</td>
                        <td class="px-4 py-3 flex gap-2">
                            <Link :href="`/admin/users/${u.id}/edit`" class="text-blue-600 hover:underline">Edit</Link>
                            <button @click="del(u.id)" class="text-red-600 hover:underline">Delete</button>
                        </td>
                    </tr>
                    <tr v-if="!users?.length"><td colspan="5" class="px-4 py-8 text-center text-gray-400">No users yet.</td></tr>
                </tbody>
            </table>
        </div>
    </AdminLayout>
</template>
