const { expect } = require('@wdio/globals');
const LoginPage = require('../../../../../pageobjects/loginAdmin.page');

describe('Admin login invalid password', () => {
    it('I input username and input wrong password', async () => {
        await LoginPage.open();
        await LoginPage.login('admin', 'invalidpassword');
    });

    it('I get message error Username atau password salah.', async () => {
        await expect(LoginPage.errorPasswordIncorrect).toBeDisplayed()
    })

    it('I Failed to enter the admin dashboard page', async () => {
        await expect(LoginPage.txtSignIn).toBeDisplayed()
    })
});
