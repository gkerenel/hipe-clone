export const infoRoutes = [
	{
		path: '',
		name: 'info_home',
		component: () => import('@/views/InfoHomeView.vue')
	},
	{
		path: 'about',
		name: 'info_about',
		component: () => import('@/views/InfoAboutView.vue'),
	},
	{
		path: 'cookies',
		name: 'info_cookies',
		component: () => import('@/views/InfoCookiesView.vue'),
	},
	{
		path: 'policies',
		name: 'info_policies',
		component: () => import('@/views/InfoPoliciesView.vue'),
	},
	{
		path: 'terms',
		name: 'info_terms',
		component: () => import('@/views/InfoTermsView.vue'),
	}
]