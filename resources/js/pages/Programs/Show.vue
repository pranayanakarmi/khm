<script setup>
import { Link } from '@inertiajs/vue3';
import PublicLayout from '@/layouts/PublicLayout.vue';

defineProps({ program: Object });
</script>

<template>
    <PublicLayout>
        <div class="bg-blue-900 text-white py-12 px-4">
            <div class="max-w-4xl mx-auto">
                <Link href="/programs" class="text-blue-300 hover:text-white text-sm mb-3 inline-block">← Back to Programs</Link>
                <span v-if="program.category" class="text-xs bg-blue-700 text-blue-200 px-3 py-1 rounded-full capitalize mb-2 inline-block">{{ program.category }}</span>
                <h1 class="text-3xl md:text-4xl font-bold">{{ program.title }}</h1>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-4 py-10">
            <div class="grid md:grid-cols-3 gap-8">
                <div class="md:col-span-2">
                    <div v-if="program.image" class="mb-6 rounded-xl overflow-hidden">
                        <img :src="`/storage/${program.image}`" :alt="program.title" class="w-full object-cover max-h-80"/>
                    </div>
                    <div v-if="program.description" class="prose max-w-none text-gray-700 leading-relaxed" v-html="program.description"></div>
                </div>
                <div class="space-y-4">
                    <div class="bg-blue-50 rounded-xl p-5">
                        <h3 class="font-bold text-gray-900 mb-4">Program Details</h3>
                        <dl class="space-y-3 text-sm">
                            <div v-if="program.duration">
                                <dt class="text-gray-500">Duration</dt>
                                <dd class="font-medium text-gray-900">{{ program.duration }}</dd>
                            </div>
                            <div v-if="program.intake">
                                <dt class="text-gray-500">Intake</dt>
                                <dd class="font-medium text-gray-900">{{ program.intake }}</dd>
                            </div>
                            <div v-if="program.eligibility">
                                <dt class="text-gray-500">Eligibility</dt>
                                <dd class="font-medium text-gray-900">{{ program.eligibility }}</dd>
                            </div>
                        </dl>
                    </div>
                    <Link href="/contact" class="block bg-blue-800 text-white text-center py-3 rounded-xl font-medium hover:bg-blue-900 transition-colors">Enquire Now</Link>
                </div>
            </div>
        </div>
    </PublicLayout>
</template>
