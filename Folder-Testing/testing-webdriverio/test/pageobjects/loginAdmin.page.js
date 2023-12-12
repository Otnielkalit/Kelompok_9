const { $ } = require('@wdio/globals');
const Page = require('./page');

class LoginPage extends Page {
    get inputUsername() {
        return $('input[name="username"]');
    }

    get inputPassword() {
        return $('input[name="password"]');
    }

    get btnSubmit() {
        return $('button[type="submit"]');
    }

    get txtDasboard() {
        return $('//*[@id="navbarBlur"]/div/nav/h6');
    }

    get errorMessageElement() {
        // Assume there is an element on the page to display error messages
        // You might need to adjust this based on your actual implementation
        return $('.error-message');
    }

    async login(username, password) {
        if (!username) {
            throw new Error('Username cannot be empty');
        }
        if (!password) {
            throw new Error('Password cannot be empty');
        }

        if (!username && !password) {
            throw new Error('password and username cannot be empty');
        }

        await this.inputUsername.setValue(username);
        await this.inputPassword.setValue(password);
        await this.btnSubmit.click();
        await this.txtDasboard.isDisplayed();
    }

    open() {
        return super.open('signin');
    }
    async getErrorElement() {
        return this.errorMessageElement;
    }
}

module.exports = new LoginPage();
