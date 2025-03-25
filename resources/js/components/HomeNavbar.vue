<script setup lang="ts">
    import twitterIcon from "@/assets/twitter.svg"
</script>

<template>
	<nav class="bg-white/80 backdrop-blur-md shadow-sm fixed w-full z-50">
		<div class="max-w-7xl mx-auto px-4">
			<div class="flex justify-between items-center py-3">
				<div class="flex items-center space-x-2">
                    <span class="material-symbols-outlined">mobile_hand</span>
					<span class="text-2xl font-bold text-gray-900">Hipe</span>
				</div>
				<div class="flex space-x-4 items-center">
					<a href="/signin" class="text-gray-600 focus:outline-none hover:text-blue-500 transition-colors">Sign In</a>
					<a href="/signup" class="bg-blue-500 text-white px-6 py-2 focus:outline-none rounded-full hover:bg-blue-600 transition-colors shadow-lg">
						Get Started
					</a>
				</div>
			</div>
		</div>
	</nav>
</template>
