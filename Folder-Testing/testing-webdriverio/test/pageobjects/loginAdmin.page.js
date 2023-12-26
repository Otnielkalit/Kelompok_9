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

    async login(username, password) {
        await this.inputUsername.setValue(username);
        await this.inputPassword.setValue(password);
        await this.btnSubmit.click();
        await this.txtDasboard.isDisplayed();
    }

    open() {
        return super.open('signin');
    }
}

module.exports = new LoginPage();
