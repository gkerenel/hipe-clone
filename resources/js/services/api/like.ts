// import axios from 'axios'
//
// const BASE_URL = 'http://127.0.0.1:8000/api'
//
// export const likeLike = async (token, post_id) => {
//     return axios.post(`${BASE_URL}/like/${post_id}/like`, {}, {
//         headers: {
//             'Authorization': `Bearer ${token}`,
//     }})
//     .then((response) => {
//         return { success: true, error: null }
//     })
//     .catch((error) => {
//         return { success: false, error: error.response.data.errors }
//     })
// }
//
// export const likeUnLike = async (token, post_id) => {
//     return axios.post(`${BASE_URL}/like/${post_id}/unlike`, {}, {
//         headers: {
//             'Authorization': `Bearer ${token}`,
//     }})
//     .then((response) => {
//         return { success: true, error: null }
//     })
//     .catch((error) => {
//         return { success: false, error: error.response.data.errors }
//     })
// }
//
// export const likeIsLike = async (token, post_id) => {
//     return axios.get(`${BASE_URL}/like/${post_id}/isliked`, {
//         headers: {
//             'Authorization': `Bearer ${token}`,
//     }})
//     .then((response) => {
//         return true
//     })
//     .catch((error) => {
//         return false
//     })
// }
//
//
//
