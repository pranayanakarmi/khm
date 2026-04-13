<script setup>
import PublicLayout from '@/layouts/PublicLayout.vue';
</script>

<template>
    <PublicLayout>
        <!-- Hero -->
        <div class="bg-blue-900 text-white py-16 px-4 text-center">
            <h1 class="text-4xl font-bold mb-3">About KMH Academics</h1>
            <p class="text-blue-300 max-w-2xl mx-auto">Kathmandu Model Hospital Institute of Health Sciences – Academics</p>
        </div>

        <div class="max-w-7xl mx-auto px-4 py-12 space-y-16">
            <!-- Overview -->
            <section class="grid md:grid-cols-2 gap-10 items-center">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Our Overview</h2>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Kathmandu Model Hospital Institute of Health Sciences (KMH) Academics is a premier institution dedicated to advancing health education in Nepal. Established with a vision to produce highly skilled health professionals, we offer a range of undergraduate, postgraduate, and certificate programs.
                    </p>
                    <p class="text-gray-600 leading-relaxed">
                        Our institute is affiliated with recognized universities and boards, ensuring our graduates meet the highest standards of academic and professional excellence. With state-of-the-art facilities and experienced faculty, we provide an environment conducive to both learning and research.
                    </p>
                </div>
                <div class="bg-blue-50 rounded-2xl p-8 space-y-4">
                    <div v-for="stat in [{n:'20+',l:'Years of Excellence'},{n:'1000+',l:'Alumni Worldwide'},{n:'50+',l:'Expert Faculty'},{n:'10+',l:'Programs'}]" :key="stat.l"
                        class="flex items-center gap-4">
                        <div class="text-2xl font-bold text-blue-800 w-16">{{ stat.n }}</div>
                        <div class="text-gray-600">{{ stat.l }}</div>
                    </div>
                </div>
            </section>

            <!-- Vision / Mission / Values -->
            <section>
                <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Our Vision, Mission & Values</h2>
                <div class="grid md:grid-cols-3 gap-6">
                    <div class="bg-blue-900 text-white rounded-xl p-8">
                        <div class="text-3xl mb-4">🎯</div>
                        <h3 class="text-xl font-bold mb-3">Vision</h3>
                        <p class="text-blue-200 leading-relaxed">To be a leading center of excellence in health sciences education and research in South Asia, producing competent, ethical, and compassionate health professionals.</p>
                    </div>
                    <div class="bg-red-600 text-white rounded-xl p-8">
                        <div class="text-3xl mb-4">🚀</div>
                        <h3 class="text-xl font-bold mb-3">Mission</h3>
                        <p class="text-red-100 leading-relaxed">To provide quality health sciences education, foster research and innovation, and develop health professionals who can serve the community with dedication and expertise.</p>
                    </div>
                    <div class="bg-gray-900 text-white rounded-xl p-8">
                        <div class="text-3xl mb-4">💎</div>
                        <h3 class="text-xl font-bold mb-3">Values</h3>
                        <ul class="text-gray-300 leading-relaxed space-y-1">
                            <li>• Excellence in Education</li>
                            <li>• Integrity & Ethics</li>
                            <li>• Innovation & Research</li>
                            <li>• Community Service</li>
                            <li>• Collaboration</li>
                        </ul>
                    </div>
                </div>
            </section>

            <!-- Leadership Message -->
            <section class="bg-gray-50 rounded-2xl p-10">
                <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Leadership Message</h2>
                <div class="max-w-3xl mx-auto">
                    <div class="flex flex-col md:flex-row gap-8 items-start">
                        <div class="flex-shrink-0">
                            <div class="w-24 h-24 bg-blue-900 rounded-full flex items-center justify-center text-white text-3xl">👤</div>
                        </div>
                        <div>
                            <blockquote class="text-gray-700 leading-relaxed italic text-lg mb-4">
                                "At KMH Academics, we are committed to nurturing the next generation of health professionals with the knowledge, skills, and compassion required to make a meaningful difference in healthcare. Our institution stands on pillars of academic excellence, ethical practice, and continuous learning."
                            </blockquote>
                            <div class="font-bold text-gray-900">Dr. Principal</div>
                            <div class="text-gray-500">Principal, KMH Academics</div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Accreditation -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Affiliations & Accreditations</h2>
                <div class="flex flex-wrap gap-4 justify-center">
                    <div v-for="org in ['Tribhuvan University','Nepal Medical Council','Nepal Nursing Council','Council for Technical Education','Ministry of Health, Nepal']"
                        :key="org"
                        class="bg-white border border-gray-200 rounded-lg px-6 py-3 text-sm font-medium text-gray-700 shadow-sm">
                        {{ org }}
                    </div>
                </div>
            </section>
        </div>
    </PublicLayout>
</template>
