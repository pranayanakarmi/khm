<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import PublicLayout from '@/layouts/PublicLayout.vue';

const form = useForm({
    name: '',
    email: '',
    phone: '',
    subject: '',
    message: '',
    website: '', // honeypot
});

function submit() {
    form.post('/contact', { onSuccess: () => form.reset() });
}
</script>

<template>
    <PublicLayout>
        <div class="bg-blue-900 text-white py-12 px-4 text-center">
            <h1 class="text-4xl font-bold mb-3">Contact Us</h1>
            <p class="text-blue-300">We'd love to hear from you. Reach out for inquiries, admissions, or any questions.</p>
        </div>

        <div class="max-w-7xl mx-auto px-4 py-12 grid grid-cols-1 md:grid-cols-2 gap-10">
            <!-- Contact Info -->
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Get in Touch</h2>
                <div class="space-y-5">
                    <div v-for="item in [
                        { icon:'📍', label:'Address', val:'Kathmandu Model Hospital, Kathmandu, Nepal'},
                        { icon:'��', label:'Phone', val:'+977-1-XXXXXXX'},
                        { icon:'✉️', label:'Email', val:'academics@kmh.edu.np'},
                        { icon:'🕐', label:'Office Hours', val:'Sun–Fri: 9:00 AM – 5:00 PM'},
                    ]" :key="item.label" class="flex gap-4">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-lg flex-shrink-0">{{ item.icon }}</div>
                        <div>
                            <div class="font-medium text-gray-900">{{ item.label }}</div>
                            <div class="text-gray-500 text-sm">{{ item.val }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Send a Message</h2>
                <form @submit.prevent="submit" class="space-y-4">
                    <!-- Honeypot -->
                    <input type="text" v-model="form.website" class="hidden" tabindex="-1" autocomplete="off"/>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Name *</label>
                            <input v-model="form.name" type="text" required class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                            <p v-if="form.errors.name" class="text-red-600 text-xs mt-1">{{ form.errors.name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                            <input v-model="form.email" type="email" required class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                            <p v-if="form.errors.email" class="text-red-600 text-xs mt-1">{{ form.errors.email }}</p>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                        <input v-model="form.phone" type="tel" class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                        <input v-model="form.subject" type="text" class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Message *</label>
                        <textarea v-model="form.message" rows="4" required class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                        <p v-if="form.errors.message" class="text-red-600 text-xs mt-1">{{ form.errors.message }}</p>
                    </div>
                    <button type="submit" :disabled="form.processing" class="w-full bg-blue-800 text-white py-3 rounded-lg font-semibold hover:bg-blue-900 transition-colors disabled:opacity-50">
                        {{ form.processing ? 'Sending...' : 'Send Message' }}
                    </button>
                </form>
            </div>
        </div>
    </PublicLayout>
</template>
