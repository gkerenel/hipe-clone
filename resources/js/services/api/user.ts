import axios from 'axios'
import { useAuthStore } from '@/stores/auth'
import { User } from '@/interfaces/user'

interface UserResult {
    success: boolean,
    users?: User[],
    user?: User
}

interface UserService {
    show(username:string): Promise<UserResult>,
    search(username:string): Promise<UserResult>,
    follow(username:string): Promise<UserResult>,
    unfollow(username:string): Promise<UserResult>,
    isFollowing(username:string): Promise<UserResult>
}

const TOKEN: string = useAuthStore().get()
const BASE_URL: string = 'http://127.0.0.1:8000/api'


export const UserApi: UserService = {
    async show(username:string): Promise<UserResult> {
        return axios.get(`${BASE_URL}/user/${username}`, {headers: {'Authorization': `Bearer ${TOKEN}`}})
            .then((response) => {
                return {success: true, user: response.data.user }
            })
            .catch((error) => {
                return {success: false}
            })
    },
    async search(username:string): Promise<UserResult> {
        return axios.get(`${BASE_URL}/user/${username}/search`, {headers: {'Authorization': `Bearer ${TOKEN}`}})
        .then((response) => {
            return {success: true, users: response.data.users}
        })
        .catch((error) => {
            return {success: false}
        })
    },
    async follow(username:string): Promise<UserResult> {
        return axios.get(`${BASE_URL}/follow/${username}/follow`, {headers: {'Authorization': `Bearer ${TOKEN}`}})
            .then((response) => {
                return {success: true }
            })
            .catch((error) => {
                return { success: false }
            })
    },
    async unfollow(username:string): Promise<UserResult> {
        return axios.get(`${BASE_URL}/follow/${username}/unfollow`, {headers: {'Authorization': `Bearer ${TOKEN}`}})
            .then((response) => {
                return {success: true }
            })
            .catch((error) => {
                return {success: false }
            })
    },
    async isFollowing(username:string): Promise<UserResult> {
        return axios.get(`${BASE_URL}/follow/${username}`, {headers: {'Authorization': `Bearer ${TOKEN}`}})
            .then((response) => {
                return {success: true }
            })
            .catch((error) => {
                return {success: false }
            })
    },
}
