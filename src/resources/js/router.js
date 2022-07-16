import { createRouter, createWebHistory } from "vue-router";
import Home from "./views/Home";
import SearchResult from './views/SearchResult';
import Apartment from './views/Apartment/Apartment';
import CreateApartment from './views/Apartment/CreateApartment';
import Login from './views/Auth/Login';
import Registration from './views/Auth/Registration';
import Profile from './views/User/Profile';
import EmailSend from './views/Auth/EmailSend';
import EmailConfirmed from './views/Auth/EmailConfirmed';
import Booking from './views/Booking';
import CreateRoom from './views/Room/CreateRoom';
import UserBooking from './views/User/Booking';

const routes = [
    {
        path: "/",
        name: "Home",
        component: Home
    },
    {
        path: "/search-result",
        name: "SearchResult",
        component: SearchResult,
    },
    {
        path: "/apartment/:id",
        name: "Apartment",
        component: Apartment,
        props: true
    },
    {
        path: "/apartment/create",
        name: "CreateApartment",
        component: CreateApartment,
    },
    {
        path: "/apartment/:id/room/create",
        name: "CreateRoom",
        component: CreateRoom,
        props: true
    },
    {
        path: "/user/login",
        name: "Login",
        component: Login
    },
    {
        path: "/user/registration",
        name: "Registration",
        component: Registration
    },
    {
        path: "/user/profile",
        name: "Profile",
        component: Profile
    },
    {
        path: "/user/booking",
        name: "UserBooking",
        component: UserBooking
    },
    {
        path: "/email/send",
        name: "EmailSend",
        component: EmailSend
    },
    {
        path: "/email/confirmed",
        name: "EmailConfirmed",
        component: EmailConfirmed
    },
    {
        path: "/booking",
        name: "Booking",
        component: Booking,
    },
    {
        path: "/404",
        component: require('./views/Errors/NotFound').default,
    },
    {
        path: "/:catchAll(.*)",
        redirect: '/404',
    },
];

const router = createRouter({
    routes,
    history: createWebHistory()
})


router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('x_xsrf_token')

    if (!token) {
        if (to.name === 'Profile') {
            return next({
                name: 'Login'
            })

        } else {
            return next()
        }
    }

    if (token && to.name === 'login' || to.name === 'registration') {
        return next({
            name: 'profile'
        })
    }

    next()
})

export default router
