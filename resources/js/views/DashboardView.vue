<script setup lang="ts">
	import DashboardSidebar from '@/components/DashboardSidebar.vue'
	import { RouterView } from 'vue-router'
</script>

<template>
	<div class="min-h-screen flex bg-[#0F111A] text-[#A4C2F4]">
		<DashboardSidebar />
		<div class="ms-56 w-full">
			<RouterView />
		</div>
	</div>
</template>
