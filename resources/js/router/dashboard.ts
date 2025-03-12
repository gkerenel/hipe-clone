export const dashboardRoutes = [
	{
		'path': '',
		'name': 'dashboard_home',
		component: () => import('@/views/DashboardHomeView.vue')
	},
	{
		'path': 'explore',
		'name': 'dashboard_explore',
		component: () => import('@/views/DashboardExploreView.vue')
	},
	{
		'path': 'notification',
		'name': 'dashboard_notification',
		component: () => import('@/views/DashboardNotificationView.vue')
	},
	{
		'path': 'ai',
		'name': 'dashboard_ai',
		component: () => import('@/views/DashboardAiView.vue')
	},
    {
        'path': 'post',
        'name': 'dashboard_post',
        component: () => import('@/views/DashboardPostView.vue')
    },
	{
		'path': 'profile',
		'name': 'dashboard_profile',
		component: () => import('@/views/DashboardProfileView.vue')
	},
	{
		'path': 'update',
		'name': 'dashboard_update',
		component: () => import('@/views/DashboardUpdateView.vue')
	},
    {
        'path': 'update/password',
        'name': 'dashboard_update_password',
        component: () => import('@/views/DashboardUpdatePasswordView.vue')
    },
	{
		'path': 'user/:username',
		'name': 'dashboard_user',
		'prop': true,
		component: () => import('@/views/DashboardUserView.vue')
	},
	{
		'path': 'signout',
		'name': 'dashboard_signout',
		component: () => import('@/views/DashboardSignoutView.vue')
	},
]
