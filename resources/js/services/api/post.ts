import axios from 'axios'

const BASE_URL = 'http://127.0.0.1:8000/api'

export const postGet = async (token) => {
    return axios.get(`${BASE_URL}/post`,{
        headers: {
            'Authorization': `Bearer ${token}`,
    }})
    .then((response) => {
        return { success: true, posts: response.data.posts, error: null }
    })
    .catch((error) => {
        return { success: false, posts: null, error: error.response.data.errors }
    })
}

export const postCreate = async (token, body) => {
    return axios.post(`${BASE_URL}/post`,  {
       body
    },{
        headers: {
            'Authorization': `Bearer ${token}`,
        }})
    .then((response) => {
        return { success: true, error: null }
    })
    .catch((error) => {
        return { success: false, error: error.response.data.errors }
    })
}

export const postUpdate = async (token, id, body) => {
    return axios.put(`${BASE_URL}/post/${id}/update`,  {
        body
    },{
        headers: {
            'Authorization': `Bearer ${token}`,
        }})
    .then((response) => {
        return { success: true, error: null }
    })
    .catch((error) => {
        return { success: false, error: error.response.data.errors }
    })
}

export const postDelete = async (token, id) => {
    return axios.delete(`${BASE_URL}/post/${id}/delete`, {
        headers: {
            'Authorization': `Bearer ${token}`,
    }})
    .then((response) => {
        return { success: true, error: null }
    })
    .catch((error) => {
        return { success: false, error: error.response.data.errors }
    })
}
