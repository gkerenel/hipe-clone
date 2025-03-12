<script setup lang="ts">
import networkIcon from "@/assets/network.svg"
</script>

<template>
	<section class="h-screen bg-gray-50 flex items-center">
		<div class="max-w-7xl mx-auto px-4">
			<div class="grid md:grid-cols-2 gap-12 items-center">
				<div class="space-y-6">
					<h2 class="text-4xl font-bold">
						Grow Your Network
					</h2>
					<p class="text-gray-600 text-lg">
						Connect with interesting people and build your community.
					</p>
					<div class="flex space-x-4">
						<div class="flex -space-x-3">
							<div class="w-12 h-12 rounded-full bg-blue-500"></div>
							<div class="w-12 h-12 rounded-full bg-green-500"></div>
							<div class="w-12 h-12 rounded-full bg-yellow-500"></div>
						</div>
						<p class="text-gray-500">Join 100M+ users worldwide</p>
					</div>
					<button class="flex items-center space-x-2 text-blue-500 font-semibold">
						<span>Explore who to follow</span>
						<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
							<path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
						</svg>
					</button>
				</div>
				<div class="relative">
					<img class="w-100" :src="networkIcon" alt="Network Image">
				</div>
			</div>
		</div>
	</section>
</template>
