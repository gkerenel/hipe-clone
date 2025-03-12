<script setup lang="ts">
	import DashboardSidebar from '@/components/DashboardSidebar.vue'
	import { RouterView } from 'vue-router'
</script>

<template>
	<div class="min-h-screen flex">
		<DashboardSidebar />
		<div class="ms-56 w-full">
			<RouterView />
		</div>
	</div>
</template>
