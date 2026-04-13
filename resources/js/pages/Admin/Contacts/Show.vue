<script setup>
import { Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
defineProps({ contact: Object });
function del(id) { if (confirm('Delete?')) { router.delete(`/admin/contacts/${id}`); } }
</script>
<template>
    <AdminLayout><template #title>Contact Message</template>
        <div class="max-w-2xl">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <Link href="/admin/contacts" class="text-gray-500 hover:text-gray-700">← Contacts</Link>
                    <h2 class="text-xl font-bold">Contact Message</h2>
                </div>
                <button @click="del(contact.id)" class="bg-red-600 text-white px-3 py-1.5 rounded text-sm hover:bg-red-700">Delete</button>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-4">
                <dl class="grid grid-cols-2 gap-4">
                    <div><dt class="text-xs text-gray-500">Name</dt><dd class="font-medium text-gray-900">{{ contact.name }}</dd></div>
                    <div><dt class="text-xs text-gray-500">Email</dt><dd class="text-gray-900">{{ contact.email }}</dd></div>
                    <div v-if="contact.phone"><dt class="text-xs text-gray-500">Phone</dt><dd class="text-gray-900">{{ contact.phone }}</dd></div>
                    <div v-if="contact.subject"><dt class="text-xs text-gray-500">Subject</dt><dd class="text-gray-900">{{ contact.subject }}</dd></div>
                    <div><dt class="text-xs text-gray-500">Date</dt><dd class="text-gray-900">{{ contact.created_at }}</dd></div>
                </dl>
                <div>
                    <dt class="text-xs text-gray-500 mb-2">Message</dt>
                    <dd class="bg-gray-50 rounded-lg p-4 text-gray-800 text-sm leading-relaxed whitespace-pre-wrap">{{ contact.message }}</dd>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
