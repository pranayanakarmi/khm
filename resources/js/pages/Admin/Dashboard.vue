<script setup>
import { Link } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';

defineProps({ stats: Object, recentContacts: Array, latestNotices: Array });
</script>

<template>
    <AdminLayout>
        <template #title>Dashboard</template>

        <!-- Stats cards -->
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
            <div v-for="[key, val] in Object.entries(stats || {})" :key="key" class="bg-white rounded-xl shadow-sm p-5 border border-gray-100">
                <div class="text-2xl font-bold text-blue-800">{{ val }}</div>
                <div class="text-sm text-gray-500 capitalize mt-1">{{ key }}</div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent contacts -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-bold text-gray-900">Recent Messages</h3>
                    <Link href="/admin/contacts" class="text-sm text-blue-600 hover:underline">View All</Link>
                </div>
                <div v-if="recentContacts?.length" class="space-y-3">
                    <div v-for="c in recentContacts" :key="c.id" class="flex items-start gap-3 p-3 rounded-lg bg-gray-50">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-blue-800 font-bold text-sm flex-shrink-0">
                            {{ c.name[0].toUpperCase() }}
                        </div>
                        <div class="min-w-0">
                            <div class="text-sm font-medium text-gray-900">{{ c.name }}</div>
                            <div class="text-xs text-gray-500 truncate">{{ c.subject || c.message.substring(0, 50) }}</div>
                        </div>
                        <span v-if="!c.is_read" class="w-2 h-2 bg-red-500 rounded-full flex-shrink-0 mt-1"></span>
                    </div>
                </div>
                <div v-else class="text-center py-8 text-gray-400">No messages yet.</div>
            </div>

            <!-- Latest notices -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-bold text-gray-900">Latest Notices</h3>
                    <Link href="/admin/notices" class="text-sm text-blue-600 hover:underline">View All</Link>
                </div>
                <div v-if="latestNotices?.length" class="space-y-3">
                    <div v-for="n in latestNotices" :key="n.id" class="flex items-center gap-3 p-3 rounded-lg bg-gray-50">
                        <span class="w-2 h-2 rounded-full flex-shrink-0" :class="n.is_published ? 'bg-green-500' : 'bg-yellow-400'"></span>
                        <span class="text-sm text-gray-800 flex-1 min-w-0 truncate">{{ n.title }}</span>
                        <span class="text-xs text-gray-400">{{ n.created_at?.substring(0,10) }}</span>
                    </div>
                </div>
                <div v-else class="text-center py-8 text-gray-400">No notices yet.</div>
            </div>
        </div>

        <!-- Quick actions -->
        <div class="mt-6 bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="font-bold text-gray-900 mb-4">Quick Actions</h3>
            <div class="flex flex-wrap gap-3">
                <Link v-for="item in [
                    {href:'/admin/notices/create', label:'New Notice', color:'bg-blue-600'},
                    {href:'/admin/events/create', label:'New Event', color:'bg-green-600'},
                    {href:'/admin/programs/create', label:'New Program', color:'bg-purple-600'},
                    {href:'/admin/downloads/create', label:'New Download', color:'bg-orange-600'},
                    {href:'/admin/banners/create', label:'New Banner', color:'bg-red-600'},
                ]" :key="item.href" :href="item.href"
                    class="px-4 py-2 rounded-lg text-white text-sm font-medium hover:opacity-90 transition-opacity"
                    :class="item.color">
                    + {{ item.label }}
                </Link>
            </div>
        </div>
    </AdminLayout>
</template>
