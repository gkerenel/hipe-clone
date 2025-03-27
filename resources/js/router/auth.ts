
export const auth_routes = [
    {
        name: 'auth_signin',
        path: 'signin',
        component: () => import('@/views/auth/SignInView.vue')
    },
    {
        name: 'auth_signup',
        path: 'signup',
        component: () => import('@/views/auth/SignUpView.vue')
    }
]
