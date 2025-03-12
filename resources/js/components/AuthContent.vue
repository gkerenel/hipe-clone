<script setup lang="ts">
	defineProps({
		heading: {
			type: String,
			required: true
		}
	})
</script>

<template>
	<main class="max-w-md mx-auto py-12 px-4">
		<div class="bg-white p-8 rounded-2xl shadow-lg">
			<h1 class="text-3xl font-bold text-gray-900 mb-8">{{ heading }}</h1>
			<slot></slot>
		</div>
	</main>
</template>
