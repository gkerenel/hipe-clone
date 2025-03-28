<script setup lang="ts">
    import SubmitButton from '@/components/auth/SubmitButton.vue'
    import InputField from '@/components/auth/InputField.vue'
    import { showErrors } from '@/services/utils/errors'
    import Navbar from '@/components/auth/Navbar.vue'
    import Alert from '@/components/auth/Alert.vue'
    import { AuthApi } from '@/services/api/auth'
    import { useAuthStore } from '@/stores/auth'

    import router from '@/router'
    import { ref } from 'vue'

    const username = ref('')
    const password = ref('')
    const is_submitting = ref(false)
    const errors = ref()

    async function onSubmit() {
        is_submitting.value = true
        const response = await AuthApi.signin(username.value, password.value)
        if (response.success) {
            useAuthStore().set(response.token)
            await router.push({
                name: 'dashboard_home'
            })
        }
        else {
            password.value = ''
            is_submitting.value = false
            showErrors(errors, response.errors)
        }
    }
</script>

<template>
    <div class="min-h-screen min-w-full flex flex-col">
        <Navbar long_description="Don't have an account?"  short_description="Sign Up" :url="{name: 'auth_signup'}"  class="sticky top-0 z-10" />
        <div class="flex items-center justify-center flex-grow bg-hipe-s4">
            <div class="w-[512px] bg-hipe-s2/10 p-8 rounded-2xl shadow-lg">
                <h1 class="text-3xl font-bold text-hipe-1 mb-8">Sign into Hipe</h1>
                <Alert :errors="errors" />
                <form class="space-y-6" @submit.prevent="onSubmit">
                    <InputField v-model="username" id="username" placeholder="enter username" label="Username" />
                    <InputField v-model="password" id="password" placeholder="enter password" label="Password" type="password" />
                    <SubmitButton :isSubmitting="is_submitting" :isSignInForm="true" />
                </form>
            </div>
        </div>
    </div>
</template>
