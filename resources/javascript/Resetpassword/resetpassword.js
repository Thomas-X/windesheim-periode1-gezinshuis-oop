import $ from 'jquery';

validateForm('resetPassword', {
    rules: {
        password: 'required',
        password2: {
            equalTo: "#password1"
        }
    }
})

console.log('hello222123')