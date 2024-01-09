import DashBoard from './components/DashBoard.vue'
import CustomerList from './Pages/Users/CustomerList.vue'

export default [
    {
        path: '/',
        name: 'admin.customers',
        component: CustomerList
    }
]