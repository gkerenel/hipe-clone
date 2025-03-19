import { createRouter, createWebHistory } from 'vue-router'
import { infoRoutes } from '@/router/info.ts';
import { dashboardRoutes } from '@/router/dashboard.ts';
import { useAuthStore } from '@/stores/auth.ts';
import {authTest} from "@/services/api/auth";

const router = createRouter({
	history: createWebHistory(import.meta.env.BASE_URL),
	routes: [
		{
			path: '/',
			name: 'home',
			component: () => import('@/views/HomeView.vue'),
		},
		{
			path: '/signin',
			name: 'signin',
			component: () => import('@/views/SigninView.vue'),
		},
		{
			path: '/signup',
			name: 'signup',
			component: () => import('@/views/SignupView.vue'),
		},
		{
			path: '/info',
			name: 'info',
			component: () => import('@/views/InfoView.vue'),
			children: infoRoutes
		},
		{
			path: '/dashboard',
			name: 'dashboard',
			component: () => import('@/views/DashboardView.vue'),
			children: dashboardRoutes
		}
	],
})

export default router
