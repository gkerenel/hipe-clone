<script setup lang="ts">
	import AuthNavbar from '@/components/AuthNavbar.vue'
	import AuthContent from '@/components/AuthContent.vue'
	import AuthSigninForm from '@/components/AuthSigninForm.vue'
</script>

<template>
  <div class="min-h-screen bg-gray-50">
		<AuthNavbar long-description="Don't have an account?" short-description="Sign Up" url="/signup" />
		<AuthContent heading="Sign in to Twitter">
			<AuthSigninForm />
		</AuthContent>
	</div>
</template>
