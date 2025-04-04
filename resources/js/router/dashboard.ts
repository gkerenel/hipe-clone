export const dashboardRoutes = [
	{
		'path': '',
		'name': 'dashboard_home',
		component: () => import('@/views/DashboardHomeView.vue')
	},
    {
        'path': 'user/:username',
        'name': 'dashboard_username',
        component: () => import('@/views/DashboardUserView.vue')
    },
    {
        'path': 'post/:id?',
        'name': 'dashboard_post',
        component: () => import('@/views/DashboardPostView.vue')
    },
	{
		'path': 'profile',
		'name': 'dashboard_profile',
		component: () => import('@/views/DashboardProfileView.vue')
	},
    {
        'path': 'explore',
        'name': 'dashboard_explore',
        component: () => import('@/views/DashboardExploreView.vue')
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
