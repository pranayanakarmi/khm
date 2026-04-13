<script setup>
import { ref } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

const mobileOpen = ref(false);
const page = usePage();

const navLinks = [
    { href: '/', label: 'Home', name: 'home' },
    { href: '/about', label: 'About', name: 'about' },
    { href: '/programs', label: 'Programs', name: 'programs.index' },
    { href: '/notices', label: 'Notices', name: 'notices.index' },
    { href: '/events', label: 'Events', name: 'events.index' },
    { href: '/downloads', label: 'Downloads', name: 'downloads.index' },
    { href: '/faqs', label: 'FAQs', name: 'faqs.index' },
    { href: '/contact', label: 'Contact', name: 'contact.index' },
];
</script>

<template>
    <div class="min-h-screen flex flex-col">
        <!-- Top bar -->
        <div class="bg-blue-900 text-white text-xs py-1 px-4">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <span>Kathmandu Model Hospital Institute of Health Sciences</span>
                <span>📞 +977-1-XXXXXXX</span>
            </div>
        </div>

        <!-- Header -->
        <header class="bg-white shadow-md sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo -->
                    <Link href="/" class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-800 rounded-full flex items-center justify-center text-white font-bold text-sm">KMH</div>
                        <div class="hidden sm:block">
                            <div class="text-blue-900 font-bold text-sm leading-tight">KMH Academics</div>
                            <div class="text-gray-500 text-xs">Institute of Health Sciences</div>
                        </div>
                    </Link>

                    <!-- Desktop Nav -->
                    <nav class="hidden lg:flex items-center space-x-1">
                        <Link
                            v-for="link in navLinks"
                            :key="link.name"
                            :href="link.href"
                            class="px-3 py-2 text-sm font-medium rounded-md transition-colors"
                            :class="$page.url.startsWith(link.href) && link.href !== '/' || $page.url === '/' && link.href === '/'
                                ? 'text-blue-700 bg-blue-50'
                                : 'text-gray-700 hover:text-blue-700 hover:bg-blue-50'"
                        >
                            {{ link.label }}
                        </Link>
                    </nav>

                    <!-- Mobile menu button -->
                    <button
                        @click="mobileOpen = !mobileOpen"
                        class="lg:hidden p-2 rounded-md text-gray-700 hover:bg-gray-100"
                    >
                        <svg v-if="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <svg v-else class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Mobile Nav -->
                <div v-show="mobileOpen" class="lg:hidden pb-4">
                    <Link
                        v-for="link in navLinks"
                        :key="link.name"
                        :href="link.href"
                        class="block px-3 py-2 text-sm font-medium rounded-md mb-1"
                        :class="$page.url === link.href ? 'text-blue-700 bg-blue-50' : 'text-gray-700 hover:bg-gray-100'"
                        @click="mobileOpen = false"
                    >
                        {{ link.label }}
                    </Link>
                </div>
            </div>
        </header>

        <!-- Flash messages -->
        <div v-if="$page.props.flash?.success" class="bg-green-50 border-l-4 border-green-500 p-4">
            <div class="max-w-7xl mx-auto text-green-800">{{ $page.props.flash.success }}</div>
        </div>

        <!-- Main content -->
        <main class="flex-1">
            <slot />
        </main>

        <!-- Footer -->
        <footer class="bg-blue-900 text-white mt-12">
            <div class="max-w-7xl mx-auto px-4 py-10 grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-blue-900 font-bold text-sm">KMH</div>
                        <div>
                            <div class="font-bold">KMH Academics</div>
                            <div class="text-blue-300 text-xs">Institute of Health Sciences</div>
                        </div>
                    </div>
                    <p class="text-blue-300 text-sm">Kathmandu Model Hospital Institute of Health Sciences – Academics. Committed to excellence in health education.</p>
                </div>
                <div>
                    <h3 class="font-semibold mb-3 text-blue-200">Quick Links</h3>
                    <ul class="space-y-2">
                        <li v-for="link in navLinks" :key="link.name">
                            <Link :href="link.href" class="text-blue-300 hover:text-white text-sm transition-colors">{{ link.label }}</Link>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold mb-3 text-blue-200">Contact Us</h3>
                    <div class="text-blue-300 text-sm space-y-2">
                        <p>📍 Kathmandu, Nepal</p>
                        <p>📞 +977-1-XXXXXXX</p>
                        <p>✉️ academics@kmh.edu.np</p>
                    </div>
                </div>
            </div>
            <div class="border-t border-blue-800 py-4 px-4 text-center text-blue-400 text-xs">
                <p>© {{ new Date().getFullYear() }} KMH Academics. All rights reserved. |
                Powered by <a href="https://venturefour.com.np" class="text-blue-300 hover:text-white">Venture Four Technology</a></p>
            </div>
        </footer>
    </div>
</template>
