import axios from 'axios'

const BASE_URL = 'http://127.0.0.1:8000/api'

export const profileInfo = async (token) => {
    return axios.get(`${BASE_URL}/profile`, {
        headers: {
            'Authorization': `Bearer ${token}`,
        }
    })
    .then((response) => {
        return { success: true, user: response.data.user, error: null }
    })
    .catch((error) => {
        return { success: false, user: null, error: error.response.data.errors }
    })
}

export const profileUpdate = async (token, name, username, email, bio) => {
    return axios.post(`${BASE_URL}/profile`, {
            name, username, email, bio
        },{
        headers: {
            'Authorization': `Bearer ${token}`,
        }
    })
    .then((response) => {
        return { success: true, user: response.data.user, error: null }
    })
    .catch((error) => {
        return { success: false, user: null, error: error.response.data.errors }
    })
}

export const profileUpdatePassword = async (token, current, password_new, password_new_confirmation) => {
    return axios.post(`${BASE_URL}/profile/password`, {
        current, password_new, password_new_confirmation
    },{
        headers: {
            'Authorization': `Bearer ${token}`,
        }
    })
        .then((response) => {
            return { success: true, user: response.data.user, error: null }
        })
        .catch((error) => {
            return { success: false, user: null, error: error.response.data.errors }
        })
}
