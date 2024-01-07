import DashBoard from './components/DashBoard.vue'
import ListUsers from './Pages/Users/ListUsers.vue'

export default [
    {
        path: '/admin/dashboard',
        name: 'admin.dashboard',
        component: DashBoard
    },
    {
        path: '/admin/users',
        name: 'admin.users',
        component: ListUsers
    }
]