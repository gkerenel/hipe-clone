import { useAuthStore } from '@/stores/auth'
import { User } from '@/interfaces/user'
import { Post } from '@/interfaces/post'
import axios from 'axios'


interface PostResult {
    success: boolean,
    user?: User,
    posts?: Post[],
    error?: string[],
    post?: Post
}

interface PostService {
    show(): Promise<PostResult>,
    create(body): Promise<PostResult>,
    update(post_id: number, body: string): Promise<PostResult>,
    delete(post_id: number): Promise<PostResult>,
    post(post_id: number): Promise<PostResult>,
    postComment(post_id: number, body:string): Promise<PostResult>,
    postCommentUpdate(comment_id: number, body:string): Promise<PostResult>,
    postCommentDelete(comment_id: number): Promise<PostResult>,
    postLike(post_id: number): Promise<PostResult>,
    postUnLike(post_id: number): Promise<PostResult>,
    postIsLiked(post_id: number): Promise<PostResult>
}

const TOKEN: string = useAuthStore().get()
const BASE_URL: string = 'http://127.0.0.1:8000/api'

export const PostApi: PostService = {
    async post(post_id: number): Promise<PostResult> {
        return axios.get(`${BASE_URL}/post/${post_id}`, { headers: { Authorization: `Bearer ${TOKEN}` }})
        .then((response) => {
            return { success: true, post: response.data.post }
        })
        .catch(() => {
            return { success: false }
        })
    },

    async create(body: string): Promise<PostResult> {
        return axios.post(`${BASE_URL}/post`, { body }, { headers: { Authorization: `Bearer ${TOKEN}` }})
        .then(() => {
            return { success: true }
        })
        .catch((error) => {
            return { success: false, error: error.response.datae.errors  }
        })
    },

    async show(): Promise<PostResult> {
        return axios.get(`${BASE_URL}/post`, { headers: { Authorization: `Bearer ${TOKEN}` }})
        .then((response) => {
            return { success: true, posts: response.data.posts }
        })
        .catch(() => {
            return { success: false }
        })
    },

    async update(post_id: number, body: string): Promise<PostResult> {
        return axios.put(`${BASE_URL}/post/${post_id}`, { body }, { headers: { Authorization: `Bearer ${TOKEN}` }})
        .then(() => {
            return { success: true }
        })
        .catch((error) => {
            return { success: false, error: error.response.data.errors }
        })
    },

    async delete(post_id: number): Promise<PostResult> {
        return axios.delete(`${BASE_URL}/post/${post_id}`, { headers: { Authorization: `Bearer ${TOKEN}` }})
        .then(() => {
            return { success: true }
        })
        .catch((error) => {
            return { success: false, error: error.response.datae.errors }
        })
    },

    async postLike(post_id: number): Promise<PostResult> {
        return axios.get(`${BASE_URL}/like/${post_id}/like`,{ headers: { Authorization: `Bearer ${TOKEN}` }})
        .then(() => {
            return { success: true }
        })
        .catch((error) => {
            return { success: false }
        })
    },

    async postUnLike(post_id: number): Promise<PostResult> {
        return axios.get(`${BASE_URL}/like/${post_id}/unlike`,{ headers: { Authorization: `Bearer ${TOKEN}` }})
            .then(() => {
                return { success: true }
            })
            .catch((error) => {
                return { success: false }
            })
    },

    async postIsLiked(post_id: number): Promise<PostResult> {
        return axios.get(`${BASE_URL}/like/${post_id}/isLiked`,{ headers: { Authorization: `Bearer ${TOKEN}` }})
        .then(() => {
            return { success: true }
        })
        .catch((error) => {
            return { success: false }
        })
    },

    async postComment(post_id: number, body: string): Promise<PostResult> {
        return axios.post(`${BASE_URL}/comment/${post_id}`, { body }, { headers: { Authorization: `Bearer ${TOKEN}` }})
        .then(() => {
            return { success: true }
        })
        .catch((error) => {
            return { success: false, error: error.response.data.errors  }
        })
    },

    async postCommentUpdate(comment_id: number, body: string): Promise<PostResult> {
        return axios.put(`${BASE_URL}/comment/${comment_id}`, { body }, { headers: { Authorization: `Bearer ${TOKEN}` }})
        .then(() => {
            return { success: true }
        })
        .catch((error) => {
            return { success: false, error: error.response.data.errors  }
        })
    },

    async postCommentDelete(comment_id: number): Promise<PostResult> {
        return axios.delete(`${BASE_URL}/comment/${comment_id}`, { headers: { Authorization: `Bearer ${TOKEN}` }})
        .then(() => {
            return { success: true }
        })
        .catch((error) => {
            return { success: false, error: error.response.data.errors  }
        })
    }
}
