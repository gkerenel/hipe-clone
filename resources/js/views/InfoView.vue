<script setup lang="ts">
	import InfoNavbar from '@/components/InfoNavbar.vue'
	import InfoFooter from '@/components/InfoFooter.vue'
	import { RouterView } from 'vue-router'
</script>

<template>
	<InfoNavbar />
	<RouterView />
	<InfoFooter />
</template>
