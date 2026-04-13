<script setup>
import { ref, watch } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import PublicLayout from '@/layouts/PublicLayout.vue';

const props = defineProps({
    notices: Object,
    filters: Object,
});

const search = ref(props.filters?.search || '');
const category = ref(props.filters?.category || 'all');

const categories = ['all', 'general', 'academic', 'admission', 'exam'];

function applyFilters() {
    router.get('/notices', { search: search.value, category: category.value }, { preserveState: true, replace: true });
}

let searchTimer;
watch(search, () => {
    clearTimeout(searchTimer);
    searchTimer = setTimeout(applyFilters, 400);
});
</script>

<template>
    <PublicLayout>
        <div class="bg-blue-900 text-white py-12 px-4 text-center">
            <h1 class="text-4xl font-bold mb-3">Notices & News</h1>
            <p class="text-blue-300">Stay updated with the latest announcements from KMH Academics.</p>
        </div>

        <div class="max-w-7xl mx-auto px-4 py-10">
            <!-- Search + Filter -->
            <div class="flex flex-col md:flex-row gap-4 mb-8">
                <input
                    v-model="search"
                    type="text"
                    placeholder="Search notices..."
                    class="flex-1 border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
                <div class="flex gap-2 flex-wrap">
                    <button
                        v-for="cat in categories"
                        :key="cat"
                        @click="category = cat; applyFilters()"
                        class="px-4 py-2 rounded-full text-sm font-medium transition-colors capitalize"
                        :class="category === cat ? 'bg-blue-800 text-white' : 'bg-white border border-gray-200 text-gray-700 hover:bg-blue-50'"
                    >
                        {{ cat }}
                    </button>
                </div>
            </div>

            <!-- Notice list -->
            <div v-if="notices?.data?.length" class="space-y-3">
                <Link
                    v-for="notice in notices.data"
                    :key="notice.id"
                    :href="`/notices/${notice.slug}`"
                    class="flex items-start gap-4 bg-white rounded-xl p-5 shadow-sm hover:shadow-md transition-shadow group border border-gray-100"
                >
                    <span class="mt-2 w-2 h-2 rounded-full bg-red-600 flex-shrink-0"></span>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-gray-900 group-hover:text-blue-700 transition-colors">{{ notice.title }}</h3>
                        <div class="flex items-center gap-3 mt-1">
                            <span class="text-xs bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full capitalize">{{ notice.category }}</span>
                            <span class="text-xs text-gray-400">{{ notice.published_at }}</span>
                        </div>
                    </div>
                    <span class="text-blue-500 text-sm group-hover:underline flex-shrink-0">Read →</span>
                </Link>
            </div>
            <div v-else class="text-center py-16 text-gray-400">
                <div class="text-4xl mb-4">📢</div>
                <p>No notices found.</p>
            </div>

            <!-- Pagination -->
            <div v-if="notices?.links" class="flex justify-center gap-2 mt-8">
                <component
                    v-for="link in notices.links"
                    :key="link.label"
                    :is="link.url ? Link : 'span'"
                    :href="link.url"
                    class="px-3 py-1.5 rounded text-sm"
                    :class="link.active ? 'bg-blue-800 text-white' : link.url ? 'bg-white border hover:bg-blue-50 text-gray-700' : 'text-gray-400'"
                    v-html="link.label"
                />
            </div>
        </div>
    </PublicLayout>
</template>
