// for async (this is on every page via app.php)
// no need to import it in other .js files :)
import 'babel-polyfill';
import Store from './Store';
import Notifier from './Notifier';

class Main {
    constructor() {

    }

    notifications() {
        new Notifier()
            .determineNotifications(NOTIFICATIONS)
    }
}

new Main()
    .notifications();

