<script setup lang="ts">
	import HomeNavbar from '@/components/HomeNavbar.vue'
	import HomeContent from '@/components/HomeContent.vue'
</script>

<template>
	<HomeNavbar />
	<HomeContent />
</template>

<style>
@tailwind base;
@tailwind components;
@tailwind utilities;

.feature-card {
  box-shadow: 0 10px 30px rgba(0,0,0,0.05);
}

.trend-card:hover {
  transform: translateY(-4px);
}

.animate-fade-in-up {
  animation: fadeInUp 0.8s ease-out;
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>
