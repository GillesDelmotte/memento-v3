import Meet from './components/Meet';
import Schedule from './components/Schedule';
import User from './components/User';


export default [
    //{ path: '/home', redirect: '/meet' },
    {
        path: '/home',
        name: 'meet',
        component: Meet
    },
    {
        path: '/schedule',
        name: 'schedule',
        component: Schedule
    },
    {
        path: '/user',
        name: 'user',
        component: User
    }
]
