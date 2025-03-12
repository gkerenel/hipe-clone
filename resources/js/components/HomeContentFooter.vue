<script setup lang="ts">
import twitterIcon from "@/assets/twitter.svg"
</script>

<template>
	<section class="h-screen bg-gray-900 text-white flex items-center">
		<div class="max-w-7xl mx-auto px-4 w-full">
			<div class="flex flex-col md:flex-row justify-between items-center">
				<div class="flex items-center space-x-2 mb-10">
					<img class="w-8 h-8" :src="twitterIcon" alt="Twitter Icon">
					<span class="text-xl font-bold">Twitter</span>
				</div>
				<div class="flex space-x-8">
					<a href="/info" class="hover:text-blue-400 transition-colors">About Us</a>
					<a href="/info" class="hover:text-blue-400 transition-colors">Terms & Conditions</a>
					<a href="/info" class="hover:text-blue-400 transition-colors">Privacy Policy</a>
					<a href="/info" class="hover:text-blue-400 transition-colors">Cookie Use</a>
				</div>
			</div>
		</div>
	</section>
</template>
