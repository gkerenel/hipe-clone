<script setup lang="ts">
    import { ref } from 'vue'
    import {PostApi} from "@/services/api/post";

    const props = defineProps({
        post_id: {
            required: true
        }
    })

    const comment = ref('')

    async function onSubmit() {
        await PostApi.postComment(props.post_id, comment.value)
        comment.value = ''
    }
</script>

<template>
    <div class="flex space-x-2 mt-2">
        <textarea v-model="comment" type="text" placeholder="Add a comment..." class="w-full border border-[#2E3039] bg-[#151821] text-[#E8E8E8] rounded p-3 text-sm font-inherit transition-colors duration-300 focus:border-[#4e89f5] focus:outline-none resize-none"/>
        <button @click="onSubmit" class="bg-blue-500 text-white px-4 py-1 rounded">Comment</button>
    </div>
</template>
