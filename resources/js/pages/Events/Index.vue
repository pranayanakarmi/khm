<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import PublicLayout from '@/layouts/PublicLayout.vue';

defineProps({ upcoming: Array, past: Array });

const tab = ref('upcoming');
</script>

<template>
    <PublicLayout>
        <div class="bg-blue-900 text-white py-12 px-4 text-center">
            <h1 class="text-4xl font-bold mb-3">Events & Trainings</h1>
            <p class="text-blue-300">Academic events, workshops, seminars, and training programs.</p>
        </div>

        <div class="max-w-7xl mx-auto px-4 py-10">
            <!-- Tabs -->
            <div class="flex gap-2 mb-8 border-b border-gray-200 pb-0">
                <button
                    v-for="t in ['upcoming','past']"
                    :key="t"
                    @click="tab = t"
                    class="px-6 py-3 text-sm font-medium border-b-2 transition-colors capitalize -mb-px"
                    :class="tab === t ? 'border-blue-800 text-blue-800' : 'border-transparent text-gray-500 hover:text-gray-700'"
                >
                    {{ t === 'upcoming' ? '📅 Upcoming' : '🕐 Past' }}
                </button>
            </div>

            <div :key="tab" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <template v-if="tab === 'upcoming'">
                    <Link
                        v-for="event in upcoming"
                        :key="event.id"
                        :href="`/events/${event.slug}`"
                        class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all border border-gray-100 group overflow-hidden"
                    >
                        <div class="h-40 bg-blue-50 flex items-center justify-center overflow-hidden">
                            <img v-if="event.image" :src="`/storage/${event.image}`" :alt="event.title" class="w-full h-full object-cover group-hover:scale-105 transition-transform"/>
                            <div v-else class="text-5xl">📅</div>
                        </div>
                        <div class="p-5">
                            <span class="text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded-full capitalize">{{ event.type }}</span>
                            <h3 class="font-bold text-gray-900 mt-2 mb-2 group-hover:text-blue-700">{{ event.title }}</h3>
                            <p class="text-xs text-gray-500">📅 {{ new Date(event.start_date).toLocaleDateString() }}</p>
                            <p v-if="event.location" class="text-xs text-gray-500">📍 {{ event.location }}</p>
                        </div>
                    </Link>
                    <div v-if="!upcoming?.length" class="col-span-3 text-center py-16 text-gray-400">No upcoming events at this time.</div>
                </template>
                <template v-else>
                    <Link
                        v-for="event in past"
                        :key="event.id"
                        :href="`/events/${event.slug}`"
                        class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all border border-gray-100 group overflow-hidden opacity-80"
                    >
                        <div class="h-40 bg-gray-50 flex items-center justify-center overflow-hidden">
                            <img v-if="event.image" :src="`/storage/${event.image}`" :alt="event.title" class="w-full h-full object-cover"/>
                            <div v-else class="text-5xl">🕐</div>
                        </div>
                        <div class="p-5">
                            <span class="text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded-full capitalize">{{ event.type }}</span>
                            <h3 class="font-bold text-gray-900 mt-2 mb-2 group-hover:text-blue-700">{{ event.title }}</h3>
                            <p class="text-xs text-gray-500">📅 {{ new Date(event.start_date).toLocaleDateString() }}</p>
                        </div>
                    </Link>
                    <div v-if="!past?.length" class="col-span-3 text-center py-16 text-gray-400">No past events.</div>
                </template>
            </div>
        </div>
    </PublicLayout>
</template>
