<script setup lang="ts">
defineProps({
	longDescription: {
		type: String,
		required: true,
	},
	shortDescription: {
		type: String,
		required: true,
	},
	url: {
		type: String,
		required: true,
	},
})

import twitterIcon from "@/assets/twitter.svg"
</script>

<template>
	<nav class="bg-white shadow-sm">
		<div class="max-w-7xl mx-auto px-4">
			<div class="flex justify-between items-center py-3">
				<div class="flex items-center space-x-2">
					<img class="w-8 h-8" :src="twitterIcon" alt="Twitter Icon" />
					<span class="text-2xl font-bold text-gray-900">Twitter</span>
				</div>
				<div class="flex items-center space-x-4">
					<span class="text-gray-600">{{ longDescription }}</span>
					<a :href="url" class="text-blue-500 font-semibold hover:text-blue-600">{{
						shortDescription
					}}</a>
				</div>
			</div>
		</div>
	</nav>
</template>
