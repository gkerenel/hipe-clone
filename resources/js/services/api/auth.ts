import axios from 'axios'

const BASE_URL = 'http://127.0.0.1:8000/api'

export const authTest = async (token) => {
    return axios.get(`${BASE_URL}/test`, {
        headers: {
            Authorization: `Bearer ${token}`
        }
    }).
    then(() => {
        return true
    })
    .catch(() => {
        return false
    })
}

export const authSignIn = async (username, password) => {
    return axios.post(`${BASE_URL}/signin`,  {
        username: username,
        password: password,
    })
    .then((response) => {
        return { success: true, token: response.data.token, error: null }
    })
    .catch((error) => {
        return { success: false, token: null, error: error.response.data.errors }
    })
}

export const authSignUp = async (username, email, password) => {
    return axios.post(`${BASE_URL}/signup`,  {
        username: username,
        email: email,
        password: password,
    })
    .then((response) => {
        return { success: true, token: response.data.token, error: null }
    })
    .catch((error) => {
        return { success: false, token: null, error: error.response.data.errors }
    })
}

export const authSignOut = async (token) => {
    return axios.delete(`${BASE_URL}/signout`, {
        headers: {
            Authorization: `Bearer ${token}`,
        }
    })
    .then((response) => {
        return { success: true }
    })
    .catch((error) => {
        return { success: false }
    })
}
