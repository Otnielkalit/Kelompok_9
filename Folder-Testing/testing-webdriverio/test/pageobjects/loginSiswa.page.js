const { $ } = require('@wdio/globals')
const Page = require('./page');

/**
 * sub page containing specific selectors and methods for a specific page
 */
class LoginSiswa extends Page {
    /**
     * define selectors using getter methods
     */
    get inputUsername() {
        return $('input[name="username"]');
    }

    get inputPassword() {
        return $('input[name="password"]');
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

    get btnSubmit() {
        return $('button[type="submit"]');
    }

    get btnDropdownLogout() {
        return $('button[id="dropdownMenuButton1"]');
    }

    get btnLogout() {
        return $('button[id="keluar"]');
    }

    get txtDasboard() {
        return $('//*[@id="navbarBlur"]/div/nav/h6')
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

    async logout() {
        // Klik dropdown untuk menunjukkan menu logout
        await this.btnDropdownLogout.click();
    
        // Tunggu menu logout muncul dan klik
        await this.btnLogout.waitForDisplayed();
        await this.btnLogout.click();
    }
    /**
     * overwrite specific options to adapt it to page object
     */
    open() {
        return super.open('signin');
    }
}

module.exports = new LoginSiswa();
