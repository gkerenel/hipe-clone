import axios from 'axios'
import { useAuthStore } from '@/stores/auth'

interface ProfileResult {
    success: boolean,
    user?: object,
    error?: Array<string>
}

interface ProfileService {
    getInfo(): Promise<ProfileResult>,
    infoUpdate(name: string, username: string, email: string, password: string): Promise<ProfileResult>,
    passwordUpdate(current: string, new_password: string, new_password_confirmation): Promise<ProfileResult>
}

const TOKEN: string = useAuthStore().get()
const BASE_URL: string = 'http://127.0.0.1:8000/api'

export const ProfileApi: ProfileService = {
    async getInfo(): Promise<ProfileResult> {
        return axios.get(`${BASE_URL}/profile`, {
            headers: {
                'Authorization': `Bearer ${TOKEN}`,
            }
        })
            .then((response) => {
                return { success: true, user: response.data.user }
            })
            .catch((error) => {
                return { success: false, error: error.response.data.errors }
            })
    },

    async infoUpdate(name: string, username: string, email: string, bio: string): Promise<ProfileResult> {
        return axios.post(`${BASE_URL}/profile`, {
            name, username, email, bio
        },{
            headers: {
                'Authorization': `Bearer ${TOKEN}`,
            }
        })
        .then((response) => {
            return { success: true, user: response.data.user }
        })
        .catch((error) => {
            return { success: false, error: error.response.data.errors }
        })
    },

    async passwordUpdate(current: string, password_new: string, password_new_confirmation: string): Promise<ProfileResult> {
        return axios.post(`${BASE_URL}/profile/password`, {
            current, password_new, password_new_confirmation
        },{
            headers: {
                'Authorization': `Bearer ${TOKEN}`,
            }
        })
        .then((response) => {
            return { success: true }
        })
        .catch((error) => {
            return { success: false }
        })
    }
}
