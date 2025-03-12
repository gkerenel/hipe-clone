<script setup lang="ts">
	import HomeContentHero from '@/components/HomeContentHero.vue'
	import HomeContentFeature from '@/components/HomeContentFeature.vue'
	import HomeContentNetwork from '@/components/HomeContentNetwork.vue'
	import HomeContentFooter from '@/components/HomeContentFooter.vue'
</script>

<template>
	<main class="h-screen overflow-scroll">
		<HomeContentHero />
		<HomeContentFeature />
		<HomeContentNetwork />
		<HomeContentFooter />
	</main>
</template>
