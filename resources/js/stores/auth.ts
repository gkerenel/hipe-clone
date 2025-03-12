import { defineStore } from 'pinia'
import { ref, watch } from 'vue'

export const useAuthStore = defineStore('auth', () => {
	const token = ref(localStorage.getItem('auth_token') || '')

	function setToken(value: string) {
		token.value = value
		localStorage.setItem('auth_token', value)
	}

	function getToken() {
		return token.value
	}

	function isAuthenticated() {
		return !!token.value
	}

	function clearToken() {
		token.value = ''
		localStorage.removeItem('auth_token')
	}

	watch(token, (newValue) => {
		if (newValue) {
			localStorage.setItem('auth_token', newValue)
		} else {
			localStorage.removeItem('auth_token')
		}
	})

	return { token, setToken, getToken, clearToken, isAuthenticated }
})
