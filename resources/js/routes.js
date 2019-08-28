//Main
import Main from './components/main/Main.vue'
import Landing from './components/main/Landing.vue'
import About from './components/main/About.vue'
import Login from './components/main/Login.vue'
import Home from './components/main/Home.vue'
import Register from './components/main/Register.vue'
import Activate from './components/main/Activate.vue'
//Home
import Dashboard from './components/home/Dashboard.vue'
import UserList from './components/home/UserList.vue'
import UserProfile from './components/home/UserProfile.vue'
import MyNumber from './components/home/Number.vue'
import Genealogy from './components/home/Genealogy.vue'
import GenealogySample from './components/home/GenealogySample.vue'
import Notification from './components/home/Notification.vue'
import Wallet from './components/home/Wallet.vue'
import Points from './components/home/Points.vue'
import Keys from './components/home/Keys.vue'
import Requests from './components/home/Requests.vue'
import Cashier from './components/POS/Cashier.vue'
import Inventory from './components/POS/Inventory.vue'

export const routes = [
  { path: '/', name: 'main', component: Main, 
    children: [
        { path: '/', name: 'landing', components: {main: Landing}},
        { path: '/about', name: 'about', components: {main: About}},
        { path: '/login', name: 'login', components: {main: Login}},
        { path: '/register', name: 'register', components: {main: Register}},
        { path: '/activate', name: 'activate', components: {main: Activate}},
        { path: '/cashier', name: 'cashier', components: {main: Cashier}},
        { path: '/inventory', name: 'inventory', components: {main: Inventory}},
    ]
  },
  { path: '/home', name: 'home', component: Home, 
      children: [
        { path: '/dashboard', components: {home: Dashboard} },
        { path: '/users', components: {home: UserList}},
        { path: '/profile', components: {home: UserProfile}},
        { path: '/number', components: {home: MyNumber}},
        { path: '/numbers', components: {home: Genealogy}},
        { path: '/genealogy', components: {home: GenealogySample}},
        { path: '/notification', components: {home: Notification} },
        { path: '/wallet', components: {home: Wallet} },
        { path: '/points', components: {home: Points} },
        { path: '/keys', components: {home: Keys} },
        { path: '/requests', components: {home: Requests} },
      ]
  },
]