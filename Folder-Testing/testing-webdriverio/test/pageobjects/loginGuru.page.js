const { $ } = require('@wdio/globals')
const Page = require('./page');

/**
 * sub page containing specific selectors and methods for a specific page
 */
class LoginGuru extends Page {
    /**
     * define selectors using getter methods
     */
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
        return $('//*[@id="navbarBlur"]/div/nav/h6')
    }

    get errorPasswordEmpty() {
        return $('//div[contains(@class, "alert-danger")][contains(text(), "Password tidak boleh kosong")]');
    }

    get errorUsernameEmpty() {
        return $('//div[contains(@class, "alert-danger")][contains(text(), "Username tidak boleh kosong")]');
    }

    get errorBothEmpty() {
        return $('//div[contains(@class, "alert-danger")][contains(text(), "Username dan password tidak boleh kosong")]');
    }

    get errorPasswordIncorrect() {
        return $('//div[contains(@class, "alert-danger")][contains(text(), "Username atau password salah")]');
    }

    get errorUsernameIncorrect() {
        return $('//div[contains(@class, "alert-danger")][contains(text(), "Username atau password salah")]');
    }

    get txtSignIn() {
        return $('/html/body/main/div[1]/div/div/div/div/div[1]/div/h4');
    }

    /**
     * a method to encapsule automation code to interact with the page
     * e.g. to login using username and password
     */
    async login(username, password) {
        await this.inputUsername.setValue(username);
        await this.inputPassword.setValue(password);
        await this.btnSubmit.click();
        await this.txtDasboard.isDisplayed()
    }

    /**
     * overwrite specific options to adapt it to page object
     */
    open() {
        return super.open('signin');
    }
}

module.exports = new LoginGuru();
