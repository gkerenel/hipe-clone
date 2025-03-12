<template>
	<main class="flex-1 p-8 w-full">
		<div class="p-4 bg-gray-100 h-screen flex flex-col shadow-lg rounded-lg">
			<div class="flex-grow overflow-y-auto p-2 space-y-2" ref="chatContainer">
				<div v-for="message in messages" :key="message.id" class="flex">
					<div
						:class="{
							'bg-blue-500 text-white rounded-lg p-3 self-end ml-auto': message.role === 'assistant',
							'bg-gray-300 text-black rounded-lg p-3 self-start': message.role === 'user',
						}"
						class="max-w-xs"
					>
						<VueMarkdown :source="message.content" />
					</div>
				</div>
			</div>

			<div class="mt-2 p-2 bg-white shadow-md rounded-lg flex">
				<input
					v-model="userInput"
					type="text"
					placeholder="Type your message..."
					class="w-full rounded-lg border p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
					@keyup.enter="sendMessage"
				/>
				<div>
					<button @click="sendMessage" class="p-1 text-center text-white font-bold bg-blue-400 cursor-pointer ml-1 rounded w-full mb-0.5">send</button>
					<button @click="clearMessage" class="p-1 text-center text-white font-bold bg-green-400 cursor-pointer ml-1 rounded w-full">clear</button>
				</div>
			</div>
		</div>
	</main>
</template>

<script lang="ts">
import { defineComponent, ref, onMounted, nextTick } from 'vue';
import axios from 'axios';
import VueMarkdown from 'vue-markdown-render'

interface Message {
	id: number;
	role: 'user' | 'assistant';
	content: string;
}



export default defineComponent({
	components: {
		VueMarkdown
	},
	setup() {
		const userInput = ref('');
		const messages = ref<Message[]>([]);
		const chatContainer = ref<HTMLDivElement | null>(null);
		let messageId = 0;
		onMounted(() => {
			const savedMessages = localStorage.getItem('chatMessages');
			if (savedMessages) {
				messages.value = JSON.parse(savedMessages);
				messageId = messages.value.length;
			}
			scrollToBottom();
		});

		function clearMessage() {
			localStorage.removeItem('chatMessages')
			messages.value = []
		}

		const scrollToBottom = () => {
			nextTick(() => {
				if (chatContainer.value) {
					chatContainer.value.scrollTop = chatContainer.value.scrollHeight;
				}
			});
		};



		const sendMessage = async () => {
			if (!userInput.value.trim()) return;

			const userMessage: Message = {
				id: ++messageId,
				role: 'user',
				content: userInput.value,
			};
			messages.value.push(userMessage);
			userInput.value = '';

			// Save messages to localStorage
			localStorage.setItem('chatMessages', JSON.stringify(messages.value));

			try {
				const response = await axios.post(
					'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=AIzaSyANQBy9tI9mcWwIaI3kCxhluk2LwQdktTM',
					{
						contents: messages.value.map(msg => ({
							role: msg.role,
							parts: [{ text: msg.content }],
						})),
					},
					{
						headers: {
							'Content-Type': 'application/json',
						},
					}
				);

				const assistantMessage: Message = {
					id: ++messageId,
					role: 'assistant',
					content: response.data.candidates[0].content.parts[0].text,
				};
				messages.value.push(assistantMessage);

				// Save updated messages
				localStorage.setItem('chatMessages', JSON.stringify(messages.value));
			} catch (error) {
				console.error('Error communicating with Gemini API:', error);
				messages.value.push({
					id: ++messageId,
					role: 'assistant',
					content: 'Error: Could not retrieve a response. Please try again.',
				});
			}

			scrollToBottom();
		};

		return {
			userInput,
			messages,
			sendMessage,
			chatContainer,
			clearMessage
		};
	},
});
</script>
