<script setup lang="ts">
    import Sidebar from '@/components/dashboard/Sidebar.vue'
	import { RouterView } from 'vue-router'
</script>

<template>
	<div class="min-h-screen flex bg-hipe-s1 text-hipe-1">
		<Sidebar />
		<div class="ms-56 w-full">
			<RouterView />
		</div>
	</div>
</template>
