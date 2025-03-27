import { createRouter, createWebHistory } from 'vue-router'
import { dashboard_routes } from '@/router/dashboard'
import { auth_routes } from '@/router/auth'

const router = createRouter({
	history: createWebHistory(import.meta.env.BASE_URL),
	routes: [
		{
            name: 'index',
			path: '/',
			component: () => import('@/views/IndexView.vue')
		},
        {
            name: 'auth',
            path: '/auth',
            component: () => import('@/views/AuthView.vue'),
            children: auth_routes
        },
		{
			path: '/dashboard',
			name: 'dashboard',
			component: () => import('@/views/DashboardView.vue'),
			children: dashboard_routes
		}
	]
})

export default router
