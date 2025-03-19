

export const dashboardRoutes = [
	{
		'path': '',
		'name': 'dashboard_home',
		meta: {
            requireAuth: true,
        },
        component: () => import('@/views/DashboardHomeView.vue')
	},
    {
        'path': 'user/:username',
        'name': 'dashboard_username',
        meta: {
            requireAuth: true,
        },
        component: () => import('@/views/DashboardUserView.vue')
    },
    {
        'path': 'post/:id?',
        'name': 'dashboard_post',
        meta: {
            requireAuth: true,
        },
        component: () => import('@/views/DashboardPostView.vue')
    },
	{
		'path': 'profile',
		'name': 'dashboard_profile',
		meta: {
            requireAuth: true,
        },
        component: () => import('@/views/DashboardProfileView.vue')
	},
	{
		'path': 'update',
		'name': 'dashboard_update',
		meta: {
            requireAuth: true,
        },
        component: () => import('@/views/DashboardUpdateView.vue')
	},
    {
        'path': 'update/password',
        'name': 'dashboard_update_password',
        meta: {
            requireAuth: true,
        },
        component: () => import('@/views/DashboardUpdatePasswordView.vue')
    },
	{
		'path': 'user/:username',
		'name': 'dashboard_user',
		'prop': true,
		meta: {
            requireAuth: true,
        },
        component: () => import('@/views/DashboardUserView.vue')
	},
	{
		'path': 'signout',
		'name': 'dashboard_signout',
		meta: {
            requireAuth: true,
        },
        component: () => import('@/views/DashboardSignoutView.vue')
	},
]
