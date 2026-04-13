<script setup>
import { ref } from 'vue';
import PublicLayout from '@/layouts/PublicLayout.vue';

const props = defineProps({ faqs: Object });
const openId = ref(null);

function toggle(id) {
    openId.value = openId.value === id ? null : id;
}
</script>

<template>
    <PublicLayout>
        <div class="bg-blue-900 text-white py-12 px-4 text-center">
            <h1 class="text-4xl font-bold mb-3">Frequently Asked Questions</h1>
            <p class="text-blue-300">Find answers to the most common questions about KMH Academics.</p>
        </div>

        <div class="max-w-3xl mx-auto px-4 py-12">
            <div v-if="faqs && Object.keys(faqs).length">
                <div v-for="(items, cat) in faqs" :key="cat" class="mb-10">
                    <h2 class="text-xl font-bold text-gray-900 mb-4 capitalize border-b pb-2">{{ cat }}</h2>
                    <div class="space-y-3">
                        <div v-for="faq in items" :key="faq.id" class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                            <button @click="toggle(faq.id)" class="w-full text-left flex justify-between items-center px-6 py-4 font-medium text-gray-900 hover:bg-blue-50 transition-colors">
                                <span>{{ faq.question }}</span>
                                <span class="text-blue-600 ml-4 flex-shrink-0">{{ openId === faq.id ? '−' : '+' }}</span>
                            </button>
                            <div v-show="openId === faq.id" class="px-6 pb-5 text-gray-600 text-sm leading-relaxed border-t border-gray-100 pt-3">
                                {{ faq.answer }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else class="text-center py-16 text-gray-400">
                <div class="text-4xl mb-4">❓</div>
                <p>No FAQs available yet.</p>
            </div>
        </div>
    </PublicLayout>
</template>
