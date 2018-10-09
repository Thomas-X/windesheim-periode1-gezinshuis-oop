import $ from 'jquery';

validateForm('resetPassword', {
    rules: {
        password2: {
            equalTo: "#password1"
        }
    }
})

console.log('hello222123')