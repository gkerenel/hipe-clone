import axios from 'axios'
import { useAuthStore } from '@/stores/auth'
import { User } from '@/interfaces/user'

interface ProfileResult {
    success: boolean,
    user?: User,
    errors?: string[]
}

interface ProfileService {
    show(): Promise<ProfileResult>,
    update(name: string, username: string, email: string, password: string): Promise<ProfileResult>,
    updatePassword(current: string, new_password: string, new_password_confirmation): Promise<ProfileResult>
}

const TOKEN: string = useAuthStore().get()
const BASE_URL: string = 'http://127.0.0.1:8000/api'

export const ProfileApi: ProfileService = {
    async show(): Promise<ProfileResult> {
        return axios.get(`${BASE_URL}/profile`, { headers: { 'Authorization': `Bearer ${TOKEN}` }})
        .then((response) => {
            return { success: true, user: response.data.user }
        })
        .catch((error) => {
            return { success: false, errors: error.response.data.errors }
        })
    },

    async update(name: string, username: string, email: string, bio: string): Promise<ProfileResult> {
        return axios.put(`${BASE_URL}/profile/update`, { name, username, email, bio },{ headers: { 'Authorization': `Bearer ${TOKEN}` }})
        .then(() => {
            return { success: true }
        })
        .catch((error) => {
            return { success: false, errors: error.response.data.errors }
        })
    },

    async updatePassword(current: string, password_new: string, password_new_confirmation: string): Promise<ProfileResult> {
        return axios.put(`${BASE_URL}/profile/updatePassword`, { current, password_new, password_new_confirmation },{ headers: { 'Authorization': `Bearer ${TOKEN}` }})
        .then(() => {
            return { success: true }
        })
        .catch((error) => {
            return { success: false, errors: error.response.data.errors }
        })
    }
}
