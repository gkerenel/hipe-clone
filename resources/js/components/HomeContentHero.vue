<script setup lang="ts">
</script>

<template>
	<section class="h-screen pt-20 bg-gradient-to-br from-blue-500 to-purple-600 flex items-center">
		<div class="max-w-7xl mx-auto px-4 text-center">
			<h1 class="text-6xl font-bold text-white mb-8 animate-fade-in-up">
				What's happening now
			</h1>
			<p class="text-xl text-white/90 mb-12 max-w-2xl mx-auto">
				Join the conversation. Follow your interests. Hear what people are talking about.
			</p>
			<div class="space-y-4">
				<a href="/signup" class="inline-block bg-white text-blue-600 px-12 py-4 rounded-full text-lg font-semibold hover:bg-gray-50 transition-transform transform hover:scale-105 shadow-xl">
					Create Account
				</a>
				<p class="text-white/80 text-sm mt-8">
					Already have an account?
					<a href="/signin" class="text-white font-semibold hover:underline">
						Sign in
					</a>
				</p>
			</div>
		</div>
	</section>
</template>
