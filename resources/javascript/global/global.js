// for async (this is on every page via app.php)
// no need to import it in other .js files :)
import 'babel-polyfill';
import Notifier from './Notifier';

class Main {
    constructor() {
        new Notifier()
            .notifyError('hi world')
    }
}

new Main();

