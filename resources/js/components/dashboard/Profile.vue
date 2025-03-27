<script setup lang="ts">
    import { generateRandomHexColor } from '@/services/utils/colors'
    import { FollowButton } from '@/components/dashboard/FollowButton.vue'
    import { EditProfileButton } from '@/components/dashboard/EditProfileButton.vue'

    defineProps({
        name: {
            type: String,
            required: false,
            default: '? ?'
        },
        username: {
            type: String,
            required: true
        },
        bio: {
            type: String,
            required: false,
            default: ''
        },
        followers_count: {
            type: Number,
            required: false,
            default: 0
        },
        followings_count: {
            type: Number,
            required: false,
            default: 0
        },
        isCurrentUser: {
            type: Boolean,
            required: false,
            default: false
        }
    })
</script>

<template>
    <main class="flex-1 p-8">
        <div class="bg-[#0F111A] bg-opacity-95 border-[#2E3044] rounded-lg">
            <div class="relative">
                <div :style="{backgroundColor: generateRandomHexColor()}" class="w-full h-48  rounded-t-lg"></div>
                <div class="absolute left-6 bottom-[-32px]">
                    <div :style="{backgroundColor: generateRandomHexColor()}" class="w-20 h-20 rounded-full border-4 border-white flex items-center justify-center">
                        <span class="text-white font-bold text-xl">
                            {{ name.split(' ').map(n => n[0]).join('') }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="pt-10 px-6 pb-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-3xl font-bold">{{ name }}</h2>
                        <p class="text-gray-600">@{{ username }}</p>
                    </div>
                    <EditProfileButton v-if="isCurrentUser" />
                    <FollowButton v-else :username="username" />
                </div>
                <p class="mt-4 text-white font-bold">{{ bio }}</p>
                <div class="mt-6 flex space-x-8">
                    <div>
                        <span class="font-bold text-xl">{{ followers_count }}</span>
                        <span class="text-gray-600 ml-1">Followers</span>
                    </div>
                    <div>
                        <span class="font-bold text-xl">{{ followings_count }}</span>
                        <span class="text-gray-600 ml-1">Followings</span>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>
