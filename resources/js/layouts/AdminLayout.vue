<script setup>
import { ref, computed } from 'vue';
import { Link, router, usePage } from '@inertiajs/vue3';

const page = usePage();
const sidebarOpen = ref(true);

const user = computed(() => page.props.auth?.user);
const flash = computed(() => page.props.flash);

const navItems = [
    { href: '/admin', label: 'Dashboard', icon: '🏠', exact: true },
    { href: '/admin/banners', label: 'Banners', icon: '🖼️' },
    { href: '/admin/programs', label: 'Programs', icon: '📚' },
    { href: '/admin/notices', label: 'Notices', icon: '📢' },
    { href: '/admin/events', label: 'Events', icon: '📅' },
    { href: '/admin/downloads', label: 'Downloads', icon: '📥' },
    { href: '/admin/faqs', label: 'FAQs', icon: '❓' },
    { href: '/admin/pages', label: 'Pages', icon: '📄' },
    { href: '/admin/users', label: 'Users', icon: '👥' },
    { href: '/admin/contacts', label: 'Contacts', icon: '✉️' },
];

function isActive(href, exact = false) {
    if (exact) return page.url === href;
    return page.url.startsWith(href);
}

function logout() {
    router.post('/admin/logout');
}

const flashVisible = ref(true);
</script>

<template>
    <div class="min-h-screen flex bg-gray-100">
        <!-- Sidebar -->
        <aside
            class="fixed inset-y-0 left-0 z-40 flex flex-col bg-blue-900 text-white transition-all duration-300"
            :class="sidebarOpen ? 'w-64' : 'w-16'"
        >
            <!-- Logo -->
            <div class="flex items-center h-16 px-4 border-b border-blue-800">
                <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center text-blue-900 font-bold text-xs flex-shrink-0">KMH</div>
                <span v-if="sidebarOpen" class="ml-3 font-bold text-sm truncate">KMH Admin</span>
            </div>

            <!-- Nav -->
            <nav class="flex-1 overflow-y-auto py-4 px-2 space-y-1">
                <Link
                    v-for="item in navItems"
                    :key="item.href"
                    :href="item.href"
                    class="flex items-center rounded-lg px-3 py-2 text-sm transition-colors"
                    :class="isActive(item.href, item.exact)
                        ? 'bg-blue-700 text-white'
                        : 'text-blue-200 hover:bg-blue-800 hover:text-white'"
                    :title="item.label"
                >
                    <span class="text-base flex-shrink-0">{{ item.icon }}</span>
                    <span v-if="sidebarOpen" class="ml-3 truncate">{{ item.label }}</span>
                </Link>
            </nav>

            <!-- Toggle button -->
            <button
                @click="sidebarOpen = !sidebarOpen"
                class="p-4 text-blue-300 hover:text-white border-t border-blue-800 text-left"
            >
                <span v-if="sidebarOpen">◀ Collapse</span>
                <span v-else>▶</span>
            </button>
        </aside>

        <!-- Main content -->
        <div class="flex-1 flex flex-col" :class="sidebarOpen ? 'ml-64' : 'ml-16'">
            <!-- Top header -->
            <header class="bg-white shadow-sm h-16 flex items-center justify-between px-6 sticky top-0 z-30">
                <h1 class="text-lg font-semibold text-gray-800">
                    <slot name="title">Admin Panel</slot>
                </h1>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-600">{{ user?.name }}</span>
                    <button
                        @click="logout"
                        class="text-sm bg-red-600 text-white px-3 py-1.5 rounded hover:bg-red-700 transition-colors"
                    >
                        Logout
                    </button>
                </div>
            </header>

            <!-- Flash messages -->
            <div v-if="flash?.success && flashVisible" class="mx-6 mt-4 bg-green-50 border border-green-200 rounded-lg p-4 flex justify-between items-center">
                <span class="text-green-800 text-sm">✅ {{ flash.success }}</span>
                <button @click="flashVisible = false" class="text-green-600 hover:text-green-800">✕</button>
            </div>
            <div v-if="flash?.error && flashVisible" class="mx-6 mt-4 bg-red-50 border border-red-200 rounded-lg p-4 flex justify-between items-center">
                <span class="text-red-800 text-sm">❌ {{ flash.error }}</span>
                <button @click="flashVisible = false" class="text-red-600 hover:text-red-800">✕</button>
            </div>

            <!-- Page content -->
            <main class="flex-1 p-6">
                <slot />
            </main>

            <footer class="px-6 py-3 text-xs text-gray-400 border-t bg-white">
                KMH Academics Admin Panel — Powered by <a href="https://venturefour.com.np" class="text-blue-500 hover:underline">Venture Four Technology</a>
            </footer>
        </div>
    </div>
</template>
