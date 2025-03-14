export const dashboardRoutes = [
	{
		'path': '',
		'name': 'dashboard_home',
		component: () => import('@/views/DashboardHomeView.vue'),
        meta: { requiresAuth: true }
	},
	{
		'path': 'explore',
		'name': 'dashboard_explore',
		component: () => import('@/views/DashboardExploreView.vue'),
        meta: { requiresAuth: true }
	},
	{
		'path': 'notification',
		'name': 'dashboard_notification',
		component: () => import('@/views/DashboardNotificationView.vue'),
        meta: { requiresAuth: true }
	},
	{
		'path': 'ai',
		'name': 'dashboard_ai',
		component: () => import('@/views/DashboardAiView.vue'),
        meta: { requiresAuth: true }
	},
    {
        'path': 'post',
        'name': 'dashboard_post',
        component: () => import('@/views/DashboardPostView.vue'),
        meta: { requiresAuth: true }
    },
	{
		'path': 'profile',
		'name': 'dashboard_profile',
		component: () => import('@/views/DashboardProfileView.vue'),
        meta: { requiresAuth: true }
	},
	{
		'path': 'update',
		'name': 'dashboard_update',
		component: () => import('@/views/DashboardUpdateView.vue'),
        meta: { requiresAuth: true }
	},
    {
        'path': 'update/password',
        'name': 'dashboard_update_password',
        component: () => import('@/views/DashboardUpdatePasswordView.vue'),
        meta: { requiresAuth: true }
    },
	{
		'path': 'user/:username',
		'name': 'dashboard_user',
		'prop': true,
		component: () => import('@/views/DashboardUserView.vue'),
        meta: { requiresAuth: true }
	},
	{
		'path': 'signout',
		'name': 'dashboard_signout',
		component: () => import('@/views/DashboardSignoutView.vue'),
        meta: { requiresAuth: true }
	},
]
