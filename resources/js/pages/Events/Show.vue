<script setup>
import { Link } from '@inertiajs/vue3';
import PublicLayout from '@/layouts/PublicLayout.vue';

defineProps({ event: Object });
</script>

<template>
    <PublicLayout>
        <div class="bg-blue-900 text-white py-12 px-4">
            <div class="max-w-4xl mx-auto">
                <Link href="/events" class="text-blue-300 hover:text-white text-sm mb-3 inline-block">← Back to Events</Link>
                <span class="text-xs bg-blue-700 text-blue-200 px-3 py-1 rounded-full capitalize mb-3 inline-block">{{ event.type }}</span>
                <h1 class="text-3xl font-bold">{{ event.title }}</h1>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-4 py-10">
            <div class="grid md:grid-cols-3 gap-8">
                <div class="md:col-span-2">
                    <div v-if="event.image" class="mb-6 rounded-xl overflow-hidden">
                        <img :src="`/storage/${event.image}`" :alt="event.title" class="w-full object-cover max-h-80"/>
                    </div>
                    <div v-if="event.description" class="prose max-w-none text-gray-700 leading-relaxed" v-html="event.description"></div>
                </div>
                <div class="bg-blue-50 rounded-xl p-5 h-fit">
                    <h3 class="font-bold text-gray-900 mb-4">Event Details</h3>
                    <dl class="space-y-3 text-sm">
                        <div>
                            <dt class="text-gray-500">Start Date</dt>
                            <dd class="font-medium">{{ new Date(event.start_date).toLocaleString() }}</dd>
                        </div>
                        <div v-if="event.end_date">
                            <dt class="text-gray-500">End Date</dt>
                            <dd class="font-medium">{{ new Date(event.end_date).toLocaleString() }}</dd>
                        </div>
                        <div v-if="event.location">
                            <dt class="text-gray-500">Location</dt>
                            <dd class="font-medium">{{ event.location }}</dd>
                        </div>
                        <div v-if="event.organizer">
                            <dt class="text-gray-500">Organizer</dt>
                            <dd class="font-medium">{{ event.organizer }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </PublicLayout>
</template>
