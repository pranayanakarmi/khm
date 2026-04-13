<script setup>
import { Link } from '@inertiajs/vue3';
import PublicLayout from '@/layouts/PublicLayout.vue';

defineProps({ notice: Object });
</script>

<template>
    <PublicLayout>
        <div class="bg-blue-900 text-white py-12 px-4">
            <div class="max-w-3xl mx-auto">
                <Link href="/notices" class="text-blue-300 hover:text-white text-sm mb-3 inline-block">← Back to Notices</Link>
                <span class="text-xs bg-blue-700 text-blue-200 px-3 py-1 rounded-full capitalize mb-3 inline-block">{{ notice.category }}</span>
                <h1 class="text-2xl md:text-3xl font-bold">{{ notice.title }}</h1>
                <p class="text-blue-300 text-sm mt-2">{{ notice.published_at }}</p>
            </div>
        </div>

        <div class="max-w-3xl mx-auto px-4 py-10">
            <div v-if="notice.image" class="mb-6 rounded-xl overflow-hidden">
                <img :src="`/storage/${notice.image}`" :alt="notice.title" class="w-full object-cover max-h-64"/>
            </div>
            <div v-if="notice.content" class="prose max-w-none text-gray-700 leading-relaxed" v-html="notice.content"></div>
            <div v-if="notice.attachment" class="mt-8 bg-blue-50 rounded-xl p-5">
                <h3 class="font-semibold text-gray-900 mb-3">Attachment</h3>
                <a :href="`/storage/${notice.attachment}`" target="_blank" class="inline-flex items-center gap-2 bg-blue-800 text-white px-4 py-2 rounded-lg hover:bg-blue-900 transition-colors text-sm">
                    📎 Download Attachment
                </a>
            </div>
        </div>
    </PublicLayout>
</template>
