//import policies js
import policies from './policies';
import { type } from 'jquery';

export default {
    install (Vue, options){
        // authorize('modify', answer);
        // prototype is a way to inherit the class.
        Vue.prototype.authorize = function (policy, model){
            // dengan ini we add authorize function directly to component instance without any injection mechanism.
            if (! window.Auth.signedIn) return false;

            // method name in first argumen itu string
            if(typeof policy === 'string' && typeof model === 'object'){
                // pull curr user object
                const user = window.Auth.user;

                return policies[policy](user, model);
            }
        };

        Vue.prototype.signedIn = window.Auth.signedIn;
    }
}
