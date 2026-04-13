<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import PublicLayout from '@/layouts/PublicLayout.vue';

const props = defineProps({
    banners: Array,
    latestNotices: Array,
    upcomingEvents: Array,
});

const currentSlide = ref(0);

function nextSlide() {
    if (props.banners?.length) {
        currentSlide.value = (currentSlide.value + 1) % props.banners.length;
    }
}
function prevSlide() {
    if (props.banners?.length) {
        currentSlide.value = (currentSlide.value - 1 + props.banners.length) % props.banners.length;
    }
}

const quickLinks = [
    { icon: '📚', label: 'Programs', href: '/programs' },
    { icon: '📢', label: 'Notices', href: '/notices' },
    { icon: '📅', label: 'Events', href: '/events' },
    { icon: '📥', label: 'Downloads', href: '/downloads' },
    { icon: '❓', label: 'FAQs', href: '/faqs' },
    { icon: '✉️', label: 'Contact', href: '/contact' },
];
</script>

<template>
    <PublicLayout>
        <!-- Hero Banner -->
        <section class="relative bg-blue-900 text-white overflow-hidden" style="min-height:420px">
            <div v-if="banners?.length" class="relative h-96 md:h-[480px]">
                <div
                    v-for="(banner, index) in banners"
                    :key="banner.id"
                    class="absolute inset-0 transition-opacity duration-700"
                    :class="index === currentSlide ? 'opacity-100' : 'opacity-0'"
                >
                    <img v-if="banner.image" :src="`/storage/${banner.image}`" :alt="banner.title" class="w-full h-full object-cover"/>
                    <div class="absolute inset-0 bg-blue-900/70 flex items-center">
                        <div class="max-w-7xl mx-auto px-8 w-full">
                            <h1 class="text-3xl md:text-5xl font-bold mb-4">{{ banner.title }}</h1>
                            <p v-if="banner.subtitle" class="text-lg md:text-xl text-blue-200 mb-6">{{ banner.subtitle }}</p>
                            <Link v-if="banner.link" :href="banner.link" class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors">
                                Learn More
                            </Link>
                        </div>
                    </div>
                </div>
                <button @click="prevSlide" class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/30 text-white rounded-full p-2 transition">◀</button>
                <button @click="nextSlide" class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/30 text-white rounded-full p-2 transition">▶</button>
                <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex space-x-2">
                    <button v-for="(_, i) in banners" :key="i" @click="currentSlide = i"
                        class="w-2.5 h-2.5 rounded-full transition-colors"
                        :class="i === currentSlide ? 'bg-white' : 'bg-white/40'"></button>
                </div>
            </div>
            <div v-else class="flex items-center justify-center h-96">
                <div class="text-center px-4">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">KMH Academics</h1>
                    <p class="text-xl text-blue-200 mb-6">Kathmandu Model Hospital Institute of Health Sciences</p>
                    <p class="text-blue-300 mb-8 max-w-2xl mx-auto">Committed to excellence in healthcare education. Shaping the future of health professionals.</p>
                    <div class="flex flex-wrap gap-3 justify-center">
                        <Link href="/programs" class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors">Explore Programs</Link>
                        <Link href="/about" class="bg-white/10 hover:bg-white/20 border border-white/30 text-white px-6 py-3 rounded-lg font-semibold transition-colors">About Us</Link>
                    </div>
                </div>
            </div>
        </section>

        <!-- Quick Links -->
        <section class="max-w-7xl mx-auto px-4 -mt-8 relative z-10">
            <div class="grid grid-cols-3 md:grid-cols-6 gap-3">
                <Link
                    v-for="link in quickLinks"
                    :key="link.href"
                    :href="link.href"
                    class="bg-white rounded-xl shadow-md p-4 text-center hover:shadow-lg hover:-translate-y-1 transition-all group"
                >
                    <div class="text-2xl mb-2">{{ link.icon }}</div>
                    <div class="text-sm font-medium text-gray-700 group-hover:text-blue-700">{{ link.label }}</div>
                </Link>
            </div>
        </section>

        <!-- Latest Notices + Upcoming Events -->
        <section class="max-w-7xl mx-auto px-4 py-12 grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Notices -->
            <div>
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Latest Notices</h2>
                    <Link href="/notices" class="text-blue-600 hover:underline text-sm font-medium">View All →</Link>
                </div>
                <div v-if="latestNotices?.length" class="space-y-3">
                    <Link
                        v-for="notice in latestNotices"
                        :key="notice.id"
                        :href="`/notices/${notice.slug}`"
                        class="flex items-start gap-3 bg-white rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow group"
                    >
                        <span class="mt-1 w-2 h-2 rounded-full bg-red-600 flex-shrink-0"></span>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 group-hover:text-blue-700 truncate">{{ notice.title }}</p>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="text-xs bg-blue-100 text-blue-700 px-2 py-0.5 rounded capitalize">{{ notice.category }}</span>
                                <span class="text-xs text-gray-400">{{ notice.published_at }}</span>
                            </div>
                        </div>
                    </Link>
                </div>
                <div v-else class="bg-white rounded-lg p-8 text-center text-gray-400 shadow-sm">No notices published yet.</div>
            </div>

            <!-- Events -->
            <div>
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Upcoming Events</h2>
                    <Link href="/events" class="text-blue-600 hover:underline text-sm font-medium">View All →</Link>
                </div>
                <div v-if="upcomingEvents?.length" class="space-y-3">
                    <Link
                        v-for="event in upcomingEvents"
                        :key="event.id"
                        :href="`/events/${event.slug}`"
                        class="flex gap-4 bg-white rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow group"
                    >
                        <div class="flex-shrink-0 bg-blue-900 text-white rounded-lg p-3 text-center w-14">
                            <div class="text-lg font-bold leading-none">{{ new Date(event.start_date).getDate() }}</div>
                            <div class="text-xs">{{ new Date(event.start_date).toLocaleString('en', { month: 'short' }) }}</div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 group-hover:text-blue-700">{{ event.title }}</p>
                            <p v-if="event.location" class="text-xs text-gray-500 mt-1">📍 {{ event.location }}</p>
                            <span class="text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded capitalize">{{ event.type }}</span>
                        </div>
                    </Link>
                </div>
                <div v-else class="bg-white rounded-lg p-8 text-center text-gray-400 shadow-sm">No upcoming events.</div>
            </div>
        </section>

        <!-- About Highlights -->
        <section class="bg-blue-900 text-white py-16">
            <div class="max-w-7xl mx-auto px-4 text-center mb-10">
                <h2 class="text-3xl font-bold mb-3">Why KMH Academics?</h2>
                <p class="text-blue-300 max-w-2xl mx-auto">We provide world-class health sciences education with experienced faculty, modern facilities, and strong clinical exposure.</p>
            </div>
            <div class="max-w-7xl mx-auto px-4 grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                <div v-for="item in [{n:'20+',l:'Years of Excellence'},{n:'1000+',l:'Alumni Worldwide'},{n:'50+',l:'Expert Faculty'},{n:'10+',l:'Programs Offered'}]" :key="item.l"
                    class="bg-blue-800/50 rounded-xl p-6">
                    <div class="text-4xl font-bold text-white mb-2">{{ item.n }}</div>
                    <div class="text-blue-300">{{ item.l }}</div>
                </div>
            </div>
        </section>
    </PublicLayout>
</template>
