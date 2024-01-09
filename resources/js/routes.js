import DashBoard from './components/DashBoard.vue'
import CustomerList from './Pages/Users/CustomerList.vue'

export default [
    {
        path: '/admin/dashboard',
        name: 'admin.dashboard',
        component: DashBoard
    },
    {
        path: '/admin/customers',
        name: 'admin.customers',
        component: CustomerList
    }
]