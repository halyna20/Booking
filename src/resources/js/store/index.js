import Vuex from 'vuex';

import main from './modules/main';
import apartment from './modules/apartment';
import auth from './modules/auth';
import booking from './modules/booking';
import typeApartment from './modules/typeApartment';
import city from './modules/city';
import room from './modules/room';
import user from './modules/user';
import country from './modules/country';

export default new Vuex.Store({
    modules: {
        main,
        apartment,
        auth,
        booking,
        typeApartment,
        city,
        room,
        country,
        user
    }
})
