import Meet from './components/Meet';
import Schedule from './components/Schedule';
import User from './components/User';
import Praticiens from './components/Praticiens';
import PraticiensSearch from './components/Search';


export default [
    //{ path: '/home', redirect: '/meet' },
    {
        path: '/home',
        name: 'meet',
        component: Meet
    },
    {
        path: '/mon-horaire',
        name: 'schedule',
        component: Schedule
    },
    {
        path: '/mon-profil',
        name: 'user',
        component: User
    },
    {
        path: '/les-praticiens',
        name: 'praticiens',
        component: Praticiens,
        children: [
            {
                path: '/les-praticiens',
                name: 'search',
                component: PraticiensSearch
            }

        ]
    }
]
