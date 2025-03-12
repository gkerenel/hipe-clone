<script setup lang="ts">
import twitterIcon from "@/assets/twitter.svg"
</script>

<template>
	<header class="text-black shadow-lg fixed w-full z-50 bg-white">
		<nav class="max-w-6xl mx-auto px-4 py-4">
			<div class="flex justify-between items-center">
				<img class="w-8 h-8" :src="twitterIcon" alt="Twitter Icon">
				<div class="space-x-6">
					<a href="/info/about" class="hover:text-blue-200">About</a>
					<a href="/info/terms" class="hover:text-blue-200">Terms</a>
					<a href="/info/policies" class="hover:text-blue-200">Policies</a>
					<a href="/info/cookies" class="hover:text-blue-200">Cookies</a>
				</div>
			</div>
		</nav>
	</header>
</template>
