import { defineStore } from 'pinia'

export const useAuthStore = defineStore('counter', () => {
    function set(token) {
        localStorage.setItem('auth_token', token)
    }

    function clear() {
        localStorage.removeItem('auth_token')
    }

    function get() {
        return localStorage.getItem('auth_token')
    }

    return { set, get, clear }
})
