import DashBoard from './components/DashBoard.vue'
import UserList from './Pages/Users/UserList.vue'

export default [
    {
        path: '/admin/dashboard',
        name: 'admin.dashboard',
        component: DashBoard
    },
    {
        path: '/admin/users',
        name: 'admin.users',
        component: UserList
    }
]