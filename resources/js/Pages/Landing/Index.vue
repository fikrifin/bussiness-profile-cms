<script setup>
import { Head, Link } from '@inertiajs/vue3'
import { ref, onMounted } from 'vue'
import { 
  EnvelopeIcon,
  PhoneIcon,
  MapPinIcon,
  CheckCircleIcon,
  ArrowRightIcon
} from '@heroicons/vue/24/outline'
import * as HeroIcons from '@heroicons/vue/24/outline'

const props = defineProps({
  hero: Object,
  services: Array,
  testimonials: Array,
  company: Object,
  contact: Object,
  settings: Object,
})

const scrolled = ref(false)

onMounted(() => {
  window.addEventListener('scroll', () => {
    scrolled.value = window.scrollY > 50
  })

  // Intersection Observer for scroll animations
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('animate-fade-in-up')
        }
      })
    },
    { threshold: 0.1 }
  )

  document.querySelectorAll('.observe').forEach((el) => {
    observer.observe(el)
  })
})

// Helper function to get icon component from name
function getIconComponent(iconName) {
  return HeroIcons[iconName] || HeroIcons.SparklesIcon // fallback to SparklesIcon
}
</script>

<template>
  <Head :title="settings?.site_name || 'Landing'" />
  
  <div class="relative bg-black text-gray-100 font-sans antialiased">
    <!-- Navigation -->
    <nav 
      class="fixed top-0 w-full z-50 transition-all duration-300"
      :class="scrolled ? 'bg-black/95 backdrop-blur-lg shadow-lg' : 'bg-transparent'"
    >
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
          <div class="flex-shrink-0">
            <span class="text-2xl font-bold bg-gradient-to-r from-gray-200 via-gray-400 to-gray-600 bg-clip-text text-transparent">
              {{ settings?.site_name || 'Company' }}
            </span>
          </div>
          <div class="hidden md:flex space-x-8">
            <a href="#services" class="text-gray-300 hover:text-white transition">Services</a>
            <a href="#testimonials" class="text-gray-300 hover:text-white transition">Testimonials</a>
            <a href="#about" class="text-gray-300 hover:text-white transition">About</a>
            <a href="#contact" class="text-gray-300 hover:text-white transition">Contact</a>
          </div>
          <Link :href="route('login')" class="hidden md:inline-flex items-center gap-2 px-5 py-2 rounded-full bg-gradient-to-r from-gray-700 to-gray-900 text-white font-medium hover:from-gray-600 hover:to-gray-800 transition shadow-lg hover:shadow-xl">
            <span>Login</span>
            <ArrowRightIcon class="h-4 w-4" />
          </Link>
        </div>
      </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden">
      <!-- Animated background -->
      <div class="absolute inset-0 bg-gradient-to-br from-black via-gray-900 to-black">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiMyMjIyMjIiIGZpbGwtb3BhY2l0eT0iMC4xIj48cGF0aCBkPSJNMzYgMzRjMC0yLjIxLTEuNzktNC00LTRzLTQgMS43OS00IDQgMS43OSA0IDQgNCA0LTEuNzkgNC00em0wLTEwaC0yYzAtNC40Mi0zLjU4LTgtOC04cy04IDMuNTgtOCA4aDJjMC0zLjMxIDIuNjktNiA2LTZzNiAyLjY5IDYgNnoiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-20"></div>
      </div>
      
      <!-- Content -->
      <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="space-y-8 observe opacity-0">
          <h1 class="text-5xl md:text-7xl font-extrabold leading-tight">
            <span class="bg-gradient-to-r from-white via-gray-300 to-gray-500 bg-clip-text text-transparent">
              {{ hero?.title || 'Transform Your Business' }}
            </span>
          </h1>
          <p class="text-xl md:text-2xl text-gray-400 max-w-3xl mx-auto">
            {{ hero?.subtitle || 'Elevate your brand with cutting-edge solutions and unparalleled service excellence' }}
          </p>
          <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a 
              v-if="hero?.button_text"
              :href="hero.button_url || '#services'" 
              class="group inline-flex items-center gap-3 px-8 py-4 rounded-full bg-gradient-to-r from-gray-100 to-gray-300 text-black font-bold text-lg hover:from-white hover:to-gray-200 transition shadow-2xl hover:shadow-gray-500/50 transform hover:-translate-y-1"
            >
              <span>{{ hero.button_text }}</span>
              <ArrowRightIcon class="h-5 w-5 group-hover:translate-x-1 transition" />
            </a>
            <a 
              href="#about" 
              class="inline-flex items-center gap-2 px-8 py-4 rounded-full border-2 border-gray-700 text-gray-300 font-semibold hover:border-gray-500 hover:text-white transition"
            >
              Learn More
            </a>
          </div>
        </div>
      </div>

      <!-- Scroll indicator -->
      <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <div class="w-6 h-10 rounded-full border-2 border-gray-600 flex justify-center">
          <div class="w-1 h-3 bg-gray-500 rounded-full mt-2"></div>
        </div>
      </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-24 bg-gradient-to-b from-black to-gray-900">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 observe opacity-0">
          <h2 class="text-4xl md:text-5xl font-bold mb-4">
            <span class="bg-gradient-to-r from-white to-gray-400 bg-clip-text text-transparent">Our Services</span>
          </h2>
          <p class="text-gray-400 text-lg">Solusi terbaik untuk kebutuhan bisnis Anda</p>
        </div>
        
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
          <div 
            v-for="service in services" 
            :key="service.id"
            class="observe opacity-0 group relative overflow-hidden rounded-2xl bg-gradient-to-br from-gray-900 to-black border border-gray-800 p-8 hover:border-gray-600 transition-all duration-300 hover:transform hover:-translate-y-2"
          >
            <!-- Shine effect -->
            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-gray-700/10 to-transparent translate-x-[-200%] group-hover:translate-x-[200%] transition-transform duration-1000"></div>
            
            <div class="relative z-10">
              <div class="inline-flex items-center justify-center w-14 h-14 rounded-xl bg-gradient-to-br from-gray-700 to-gray-900 mb-6 group-hover:scale-110 transition">
                <component :is="getIconComponent(service.icon)" class="h-7 w-7 text-gray-300" />
              </div>
              <h3 class="text-2xl font-bold mb-3 text-white">{{ service.name }}</h3>
              <p class="text-gray-400 leading-relaxed">{{ service.description || 'Professional service tailored to your needs' }}</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-24 bg-black" v-if="testimonials?.length">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 observe opacity-0">
          <h2 class="text-4xl md:text-5xl font-bold mb-4">
            <span class="bg-gradient-to-r from-white to-gray-400 bg-clip-text text-transparent">What Clients Say</span>
          </h2>
          <p class="text-gray-400 text-lg">Kepercayaan mereka adalah prioritas kami</p>
        </div>
        
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
          <div 
            v-for="testimonial in testimonials" 
            :key="testimonial.id"
            class="observe opacity-0 relative rounded-2xl bg-gradient-to-br from-gray-900 via-gray-800 to-black border border-gray-700 p-8 hover:border-gray-600 transition-all duration-300"
          >
            <div class="absolute top-6 right-6 text-6xl text-gray-800 font-serif">"</div>
            <div class="relative z-10">
              <p class="text-gray-300 mb-6 italic leading-relaxed">{{ testimonial.content }}</p>
              <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-gray-700 to-gray-900 flex items-center justify-center text-white font-bold text-lg">
                  {{ testimonial.author[0] }}
                </div>
                <div>
                  <div class="font-semibold text-white">{{ testimonial.author }}</div>
                  <div class="text-sm text-gray-500" v-if="testimonial.role">{{ testimonial.role }}</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Company/About Section -->
    <section id="about" class="py-24 bg-gradient-to-b from-black to-gray-900" v-if="company">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
          <div class="observe opacity-0">
            <h2 class="text-4xl md:text-5xl font-bold mb-6">
              <span class="bg-gradient-to-r from-white to-gray-400 bg-clip-text text-transparent">About Us</span>
            </h2>
            <p class="text-gray-300 text-lg leading-relaxed mb-8">
              {{ company.about_text || 'We are committed to delivering excellence and innovation in everything we do.' }}
            </p>
            <div class="space-y-6">
              <div class="flex items-start gap-4" v-if="company.mission">
                <CheckCircleIcon class="h-6 w-6 text-gray-400 flex-shrink-0 mt-1" />
                <div>
                  <h3 class="font-bold text-white text-lg mb-2">Our Mission</h3>
                  <p class="text-gray-400">{{ company.mission }}</p>
                </div>
              </div>
              <div class="flex items-start gap-4" v-if="company.vision">
                <CheckCircleIcon class="h-6 w-6 text-gray-400 flex-shrink-0 mt-1" />
                <div>
                  <h3 class="font-bold text-white text-lg mb-2">Our Vision</h3>
                  <p class="text-gray-400">{{ company.vision }}</p>
                </div>
              </div>
            </div>
          </div>
          <div class="observe opacity-0 relative">
            <div class="aspect-square rounded-2xl bg-gradient-to-br from-gray-800 to-black border border-gray-700 flex items-center justify-center">
              <div class="text-center p-8">
                <div class="text-6xl font-bold bg-gradient-to-r from-gray-300 to-gray-600 bg-clip-text text-transparent mb-4">
                  {{ new Date().getFullYear() - 2020 }}+
                </div>
                <div class="text-gray-400 text-lg">Years of Excellence</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-24 bg-black" v-if="contact">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 observe opacity-0">
          <h2 class="text-4xl md:text-5xl font-bold mb-4">
            <span class="bg-gradient-to-r from-white to-gray-400 bg-clip-text text-transparent">Get In Touch</span>
          </h2>
          <p class="text-gray-400 text-lg">Hubungi kami untuk konsultasi gratis</p>
        </div>
        
        <div class="grid lg:grid-cols-3 gap-8">
          <div v-if="contact.email" class="observe opacity-0 rounded-2xl bg-gradient-to-br from-gray-900 to-black border border-gray-800 p-8 hover:border-gray-600 transition group">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-xl bg-gradient-to-br from-gray-700 to-gray-900 mb-6 group-hover:scale-110 transition">
              <EnvelopeIcon class="h-7 w-7 text-gray-300" />
            </div>
            <h3 class="font-bold text-white text-xl mb-2">Email</h3>
            <a :href="`mailto:${contact.email}`" class="text-gray-400 hover:text-white transition">{{ contact.email }}</a>
          </div>
          
          <div v-if="contact.phone" class="observe opacity-0 rounded-2xl bg-gradient-to-br from-gray-900 to-black border border-gray-800 p-8 hover:border-gray-600 transition group">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-xl bg-gradient-to-br from-gray-700 to-gray-900 mb-6 group-hover:scale-110 transition">
              <PhoneIcon class="h-7 w-7 text-gray-300" />
            </div>
            <h3 class="font-bold text-white text-xl mb-2">Phone</h3>
            <a :href="`tel:${contact.phone}`" class="text-gray-400 hover:text-white transition">{{ contact.phone }}</a>
          </div>
          
          <div v-if="contact.address" class="observe opacity-0 rounded-2xl bg-gradient-to-br from-gray-900 to-black border border-gray-800 p-8 hover:border-gray-600 transition group">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-xl bg-gradient-to-br from-gray-700 to-gray-900 mb-6 group-hover:scale-110 transition">
              <MapPinIcon class="h-7 w-7 text-gray-300" />
            </div>
            <h3 class="font-bold text-white text-xl mb-2">Location</h3>
            <p class="text-gray-400">{{ contact.address }}</p>
          </div>
        </div>

        <div v-if="contact.map_embed" class="mt-12 observe opacity-0 rounded-2xl overflow-hidden border border-gray-800" v-html="contact.map_embed"></div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="py-12 bg-gradient-to-b from-gray-900 to-black border-t border-gray-800">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
          <div class="text-2xl font-bold bg-gradient-to-r from-gray-200 via-gray-400 to-gray-600 bg-clip-text text-transparent">
            {{ settings?.site_name || 'Company' }}
          </div>
          <div class="text-gray-500 text-sm">
            © {{ new Date().getFullYear() }} All rights reserved.
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<style scoped>
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-fade-in-up {
  animation: fadeInUp 0.6s ease-out forwards;
}

.observe {
  transition: opacity 0.3s ease-out;
}

/* Smooth scroll */
html {
  scroll-behavior: smooth;
}
</style>
