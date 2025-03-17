//
// interface CommentService {
//     commentCreate(post_id: number, body: string): Promise<boolean>,
//     commentUpdate(comment_id: number, body: string): Promise<boolean>,
//     commentDelete(comment_id: number): Promise<boolean>
// }
//
// import axios from 'axios'
// import { useAuthStore } from '@/stores/auth'
// import { BASE_API_URL } from '@/env'
//
// const token = useAuthStore().get()
//
// const commentCreate = async (post_id: number, body: string) : Promise<boolean> =>
// {
//     return axios.post(
//         `${BASE_API_URL}/comment/${post_id}`,
//         {
//             body
//         },
//         {
//             headers: {
//                 Authorization: `Bearer ${token}`
//             }
//     })
//     .then(() => true)
//     .catch(() => false)
// }
