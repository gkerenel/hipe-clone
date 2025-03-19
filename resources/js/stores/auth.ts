import { defineStore } from 'pinia'

export const useAuthStore = defineStore('counter', () => {
    function set(token): void {
        localStorage.setItem('auth_token', token)
    }

    function clear(): void {
        localStorage.removeItem('auth_token')
    }

    function get(): string | null {
        return localStorage.getItem('auth_token')
    }

    return { set, get, clear }
})
