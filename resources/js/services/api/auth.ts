import axios from 'axios'
import { useAuthStore } from '@/stores/auth'

interface AuthResult {
    success: boolean,
    token?: string,
    error?: Array<string>
}

interface AuthService {
    test(): Promise<boolean>,
    signin(username: string, password: string): Promise<AuthResult>,
    signup(username: string, email: string, password: string): Promise<AuthResult>,
    signout(): Promise<AuthResult>
}

const TOKEN: string = useAuthStore().get()
const BASE_URL: string = 'http://127.0.0.1:8000/api'

export const AuthApi: AuthService = {
    async test(): Promise<AuthResult> {
        return axios.get(`${BASE_URL}/test`, { headers: { Authorization: `Bearer ${TOKEN}` }})
        .then(() => {
            return { success: true }
        })
        .catch(() => {
            return { success: false }
        })
    },

    async signin(username: string, password: string): Promise<AuthResult> {
        return axios.post(`${BASE_URL}/signin`,  {username, password})
        .then((response) => {
            return { success: true, token: response.data.token, error: null }
        })
        .catch((error) => {
            return { success: false, token: null, error: error.response.data.errors }
        })
    },

    async signup(username: string, email: string, password: string): Promise<AuthResult> {
        return axios.post(`${BASE_URL}/signup`,  { username, email, password })
        .then((response) => {
            return { success: true, token: response.data.token, error: null }
        })
        .catch((error) => {
            return { success: false, token: null, error: error.response.data.errors }
        })
    },

    async signout(): Promise<AuthResult> {
        return axios.delete(`${BASE_URL}/signout`, { headers: { Authorization: `Bearer ${TOKEN}` }})
        .then((response) => {
            return { success: true }
        })
        .catch((error) => {
            return { success: false }
        })
    }
}
