<script setup>
import { ref, watch } from 'vue';
import { router } from '@inertiajs/vue3';
import PublicLayout from '@/layouts/PublicLayout.vue';

const props = defineProps({ downloads: Array, filters: Object });

const search = ref(props.filters?.search || '');
const category = ref(props.filters?.category || 'all');
const categories = ['all', 'general', 'academic', 'administrative', 'forms'];

function applyFilters() {
    router.get('/downloads', { search: search.value, category: category.value }, { preserveState: true, replace: true });
}

let t;
watch(search, () => { clearTimeout(t); t = setTimeout(applyFilters, 400); });

function ext(filename) {
    return filename?.split('.').pop()?.toUpperCase() || 'FILE';
}
function extColor(filename) {
    const e = filename?.split('.').pop()?.toLowerCase();
    return { pdf: 'bg-red-100 text-red-700', doc: 'bg-blue-100 text-blue-700', docx: 'bg-blue-100 text-blue-700', xls: 'bg-green-100 text-green-700', xlsx: 'bg-green-100 text-green-700' }[e] || 'bg-gray-100 text-gray-700';
}
</script>

<template>
    <PublicLayout>
        <div class="bg-blue-900 text-white py-12 px-4 text-center">
            <h1 class="text-4xl font-bold mb-3">Downloads & Resources</h1>
            <p class="text-blue-300">Forms, notices, academic calendars, and other useful documents.</p>
        </div>

        <div class="max-w-7xl mx-auto px-4 py-10">
            <div class="flex flex-col md:flex-row gap-4 mb-8">
                <input v-model="search" type="text" placeholder="Search documents..." class="flex-1 border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                <div class="flex gap-2 flex-wrap">
                    <button v-for="cat in categories" :key="cat" @click="category = cat; applyFilters()"
                        class="px-4 py-2 rounded-full text-sm font-medium transition-colors capitalize"
                        :class="category === cat ? 'bg-blue-800 text-white' : 'bg-white border border-gray-200 text-gray-700 hover:bg-blue-50'">
                        {{ cat }}
                    </button>
                </div>
            </div>

            <div v-if="downloads?.length" class="space-y-3">
                <div v-for="dl in downloads" :key="dl.id" class="flex items-center gap-4 bg-white rounded-xl p-4 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="flex-shrink-0 w-12 h-12 rounded-lg flex items-center justify-center text-xs font-bold" :class="extColor(dl.file_name)">
                        {{ ext(dl.file_name) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-medium text-gray-900">{{ dl.title }}</h3>
                        <p v-if="dl.description" class="text-xs text-gray-500 mt-0.5">{{ dl.description }}</p>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="text-xs bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full capitalize">{{ dl.category }}</span>
                            <span v-if="dl.file_size" class="text-xs text-gray-400">{{ dl.file_size }}</span>
                            <span class="text-xs text-gray-400">{{ dl.download_count }} downloads</span>
                        </div>
                    </div>
                    <a :href="`/downloads/${dl.id}/get`" class="flex-shrink-0 bg-blue-800 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-900 transition-colors">⬇ Download</a>
                </div>
            </div>
            <div v-else class="text-center py-16 text-gray-400">
                <div class="text-4xl mb-4">📥</div>
                <p>No downloads found.</p>
            </div>
        </div>
    </PublicLayout>
</template>
