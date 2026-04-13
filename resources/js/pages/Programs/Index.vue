<script setup>
import { ref, computed } from 'vue';
import { Link } from '@inertiajs/vue3';
import PublicLayout from '@/layouts/PublicLayout.vue';

const props = defineProps({ programs: Array });

const selectedCategory = ref('all');
const categories = computed(() => {
    const cats = [...new Set(props.programs?.map(p => p.category).filter(Boolean))];
    return ['all', ...cats];
});
const filtered = computed(() => {
    if (selectedCategory.value === 'all') return props.programs;
    return props.programs?.filter(p => p.category === selectedCategory.value);
});
</script>

<template>
    <PublicLayout>
        <div class="bg-blue-900 text-white py-12 px-4 text-center">
            <h1 class="text-4xl font-bold mb-3">Academic Programs</h1>
            <p class="text-blue-300 max-w-xl mx-auto">Explore our range of health sciences programs designed to shape future healthcare leaders.</p>
        </div>

        <div class="max-w-7xl mx-auto px-4 py-10">
            <!-- Category filter -->
            <div class="flex flex-wrap gap-2 mb-8">
                <button
                    v-for="cat in categories"
                    :key="cat"
                    @click="selectedCategory = cat"
                    class="px-4 py-2 rounded-full text-sm font-medium transition-colors capitalize"
                    :class="selectedCategory === cat ? 'bg-blue-800 text-white' : 'bg-white text-gray-700 hover:bg-blue-50 border border-gray-200'"
                >
                    {{ cat }}
                </button>
            </div>

            <!-- Programs grid -->
            <div v-if="filtered?.length" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <Link
                    v-for="program in filtered"
                    :key="program.id"
                    :href="`/programs/${program.slug}`"
                    class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all group overflow-hidden border border-gray-100"
                >
                    <div class="h-48 bg-blue-100 flex items-center justify-center overflow-hidden">
                        <img v-if="program.image" :src="`/storage/${program.image}`" :alt="program.title" class="w-full h-full object-cover group-hover:scale-105 transition-transform"/>
                        <div v-else class="text-5xl">🏥</div>
                    </div>
                    <div class="p-5">
                        <span v-if="program.category" class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded-full capitalize">{{ program.category }}</span>
                        <h3 class="font-bold text-gray-900 mt-2 mb-2 group-hover:text-blue-700 transition-colors">{{ program.title }}</h3>
                        <div class="flex flex-wrap gap-2 text-xs text-gray-500">
                            <span v-if="program.duration">⏱ {{ program.duration }}</span>
                            <span v-if="program.intake">📅 {{ program.intake }}</span>
                        </div>
                        <div class="mt-3 text-blue-600 text-sm font-medium group-hover:underline">View Details →</div>
                    </div>
                </Link>
            </div>
            <div v-else class="text-center py-16 text-gray-400">
                <div class="text-4xl mb-4">📚</div>
                <p>No programs found in this category.</p>
            </div>
        </div>
    </PublicLayout>
</template>
