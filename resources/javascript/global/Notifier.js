import $ from 'jquery';
export default class Notifier {

    constructor() {
        // I tried to use a babel-loader plugin but after fiugring it out for 1 hour I gave up so no field types for us :)
        this.success = 'success';
        this.error = 'danger';
        this.warning = 'warning';
        this.info = 'info';
    }

    notifySuccess(val) {
        return this.init(this.success, val)
    }

    notifyError(val) {
        return this.init(this.error, val)
    }

    notifyWarning(val) {
        return this.init(this.warning, val)
    }

    notifyInfo(val) {
        return this.init(this.info, val)
    }

    init(type, val) {
        const className = type;
        const html = `<div class="alert alert-${className}">${val}</div>`;
        $("body").append(html);
    }

}