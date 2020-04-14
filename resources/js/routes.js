import Meet from './components/Meet';
import Schedule from './components/Schedule';


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
    }
]
