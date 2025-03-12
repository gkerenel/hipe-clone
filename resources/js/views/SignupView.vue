<script setup lang="ts">
	import AuthNavbar from '@/components/AuthNavbar.vue'
	import AuthContent from '@/components/AuthContent.vue'
	import AuthSignupForm from '@/components/AuthSignupForm.vue'
</script>

<template>
	<div class="min-h-screen bg-gray-50">
		<AuthNavbar long-description="Already have an account?" short-description="Sign In" url="/signin" />
		<AuthContent heading="Create your account">
			<AuthSignupForm />
		</AuthContent>
	</div>
</template>
