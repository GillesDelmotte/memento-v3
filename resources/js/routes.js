import Meet from './components/Meet';
import Schedule from './components/Schedule';
import User from './components/User';
import Praticiens from './components/Praticiens';
import PraticienProfil from './components/Praticien';
import PraticiensSearch from './components/Search';
import Stat from './components/Stat';
import Report from './components/Report';
import CreateSchedule from './components/CreateSchedule';


export default [
    //{ path: '/home', redirect: '/meet' },
    {
        path: '/home',
        name: 'meet',
        component: Meet
    },
    {
        path: '/statistiques',
        name: 'stat',
        component: Stat
    },
    {
        path: '/signalement',
        name: 'report',
        component: Report
    },
    {
        path: '/mon-horaire',
        name: 'schedule',
        component: Schedule
    },
    {
        path: '/creation-horaire',
        name: 'newSchedule',
        component: CreateSchedule
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
            },
            {
                path: '/les-praticiens/:id',
                name: 'praticien',
                component: PraticienProfil
            },

        ]
    }
]
