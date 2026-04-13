<script setup>
import { Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
defineProps({ contacts: Object });
function del(id) { if (confirm('Delete this contact?')) router.delete(`/admin/contacts/${id}`); }
</script>
<template>
    <AdminLayout><template #title>Contacts</template>
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold">Contact Messages</h2>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b"><tr>
                    <th class="px-4 py-3 text-left text-gray-600">Name</th>
                    <th class="px-4 py-3 text-left text-gray-600">Email</th>
                    <th class="px-4 py-3 text-left text-gray-600">Subject</th>
                    <th class="px-4 py-3 text-left text-gray-600">Date</th>
                    <th class="px-4 py-3 text-left text-gray-600">Status</th>
                    <th class="px-4 py-3 text-left text-gray-600">Actions</th>
                </tr></thead>
                <tbody>
                    <tr v-for="c in contacts.data" :key="c.id" class="border-b hover:bg-gray-50" :class="!c.is_read ? 'bg-blue-50' : ''">
                        <td class="px-4 py-3 font-medium text-gray-900">{{ c.name }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ c.email }}</td>
                        <td class="px-4 py-3 text-gray-600 max-w-xs truncate">{{ c.subject }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ c.created_at?.substring(0,10) }}</td>
                        <td class="px-4 py-3"><span :class="c.is_read ? 'bg-gray-100 text-gray-600' : 'bg-blue-100 text-blue-700'" class="px-2 py-0.5 rounded-full text-xs">{{ c.is_read ? 'Read' : 'Unread' }}</span></td>
                        <td class="px-4 py-3 flex gap-2">
                            <Link :href="`/admin/contacts/${c.id}`" class="text-blue-600 hover:underline">View</Link>
                            <button @click="del(c.id)" class="text-red-600 hover:underline">Delete</button>
                        </td>
                    </tr>
                    <tr v-if="!contacts?.data?.length"><td colspan="6" class="px-4 py-8 text-center text-gray-400">No messages yet.</td></tr>
                </tbody>
            </table>
        </div>
    </AdminLayout>
</template>
