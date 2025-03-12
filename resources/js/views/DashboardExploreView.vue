<script setup lang="ts">
import { ref } from 'vue';

// Sample data for trending tags and users
const trendingTags = ref([
	{ name: '#VueJS', tweets: 1200 },
	{ name: '#TailwindCSS', tweets: 950 },
	{ name: '#WebDevelopment', tweets: 800 },
	{ name: '#JavaScript', tweets: 1500 },
]);

const trendingUsers = ref([
	{ username: 'john_doe', name: 'John Doe', followers: 12000 },
	{ username: 'jane_smith', name: 'Jane Smith', followers: 8500 },
	{ username: 'dev_guru', name: 'Dev Guru', followers: 23000 },
]);

const searchQuery = ref('');
const searchResults = ref([]);

// Function to handle search
const handleSearch = () => {
	// Simulate search results (replace with actual API call)
	searchResults.value = [
		{ type: 'tag', name: '#VueJS', tweets: 1200 },
		{ type: 'user', username: 'john_doe', name: 'John Doe' },
	];
};
</script>

<template>
	<div class="min-h-screen bg-gray-100 p-6">
		<!-- Search Bar -->
		<div class="max-w-4xl mx-auto mb-8">
			<div class="flex items-center bg-white rounded-full shadow-md p-2">
				<input
					v-model="searchQuery"
					type="text"
					placeholder="Search for tags or usernames..."
					class="flex-grow px-4 py-2 rounded-full focus:outline-none"
				/>
				<button
					@click="handleSearch"
					class="bg-blue-500 text-white px-6 py-2 rounded-full hover:bg-blue-600 transition duration-300"
				>
					Search
				</button>
			</div>
		</div>

		<!-- Search Results -->
		<div v-if="searchResults.length > 0" class="max-w-4xl mx-auto mb-8">
			<h2 class="text-xl font-bold mb-4">Search Results</h2>
			<div class="bg-white rounded-lg shadow-md p-6">
				<div v-for="(result, index) in searchResults" :key="index" class="mb-4">
					<div v-if="result.type === 'tag'" class="flex items-center justify-between">
						<span class="text-blue-500 font-semibold">{{ result.name }}</span>
						<span class="text-gray-500">{{ result.tweets }} tweets</span>
					</div>
					<div v-else-if="result.type === 'user'" class="flex items-center justify-between">
						<div class="flex items-center">
							<span class="font-semibold">{{ result.name }}</span>
							<span class="text-gray-500 ml-2">@{{ result.username }}</span>
						</div>
						<button class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 transition duration-300">
							Follow
						</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Trending Tags -->
		<div class="max-w-4xl mx-auto mb-8">
			<h2 class="text-xl font-bold mb-4">Trending Tags</h2>
			<div class="bg-white rounded-lg shadow-md p-6">
				<div v-for="(tag, index) in trendingTags" :key="index" class="mb-4">
					<div class="flex items-center justify-between">
						<span class="text-blue-500 font-semibold">{{ tag.name }}</span>
						<span class="text-gray-500">{{ tag.tweets }} tweets</span>
					</div>
				</div>
			</div>
		</div>

		<!-- Trending Users -->
		<div class="max-w-4xl mx-auto">
			<h2 class="text-xl font-bold mb-4">Trending Users</h2>
			<div class="bg-white rounded-lg shadow-md p-6">
				<div v-for="(user, index) in trendingUsers" :key="index" class="mb-4">
					<div class="flex items-center justify-between">
						<div class="flex items-center">
							<span class="font-semibold">{{ user.name }}</span>
							<span class="text-gray-500 ml-2">@{{ user.username }}</span>
						</div>
						<button class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 transition duration-300">
							Follow
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
