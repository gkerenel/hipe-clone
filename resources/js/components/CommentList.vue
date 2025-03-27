<script setup lang="ts">
    import { useRouter } from 'vue-router'
    import {ref} from 'vue'
    import {PostApi} from "@/services/api/post";
    const router = useRouter()

    const props = defineProps({
        commentss: {
            type: Object,
            required: true
        },
        currentUserId: {
            required: true,
        }
    })

    const comments = ref(props.commentss)

    const editingCommentId = ref(null);
    const editedCommentBody = ref('');

    const editComment = (comment) => {
        editingCommentId.value = comment.id;
        editedCommentBody.value = comment.body;
    };

    async function saveComment() {
        await PostApi.postCommentUpdate(editingCommentId.value, editedCommentBody.value)
        cancelEdit()
    }

    function cancelEdit() {
        editingCommentId.value = null;
        editedCommentBody.value = '';
    }

    async function deleteComment(id) {
        await PostApi.postCommentDelete(id)
        comments.value = comments.value.filter((comment) => comment.id != id)
    }
</script>

<template>
        <div v-for="comment in comments" :key="comment.id" class="border-b pb-2">
            <div class="flex items-center justify-between">
                <div>
                    <p>
          <span
              class="font-semibold text-blue-500 cursor-pointer hover:underline"
              @click="router.push(`/dashboard/user/${comment.user.username}`)"
          >
            {{ comment.user.name }}
          </span>:
                        <span v-if="!editingCommentId || editingCommentId !== comment.id">{{ comment.body }}</span>
                        <textarea v-else v-model="editedCommentBody" class="w-full p-2 border rounded" />
                    </p>
                </div>
                <div v-if="currentUserId === comment.user_id">
                    <div v-if="editingCommentId === comment.id" class="space-x-2">
                        <button @click="saveComment(comment.id)" class="cursor-pointer bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-sm">Save</button>
                        <button @click="cancelEdit()" class="cursor-pointer bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-1 px-2 rounded text-sm">Cancel</button>
                    </div>
                    <div v-else class="space-x-2">
                        <button @click="editComment(comment)" class="cursor-pointer text-blue-500 hover:text-blue-700 text-sm">Edit</button>
                        <button @click="deleteComment(comment.id)" class="cursor-pointer text-red-500 hover:text-red-700 text-sm">Delete</button>
                    </div>
                </div>
            </div>
        </div>

</template>
