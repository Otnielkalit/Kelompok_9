const { expect } = require('@wdio/globals');
const LoginGuru = require('../../../../../pageobjects/loginGuru.page');

describe('Login with wrong password', () => {
    it('I input username and input wrong password', async () => {
        await LoginGuru.open();
        await LoginGuru.login('guru', 'invalidpassword');
    });

    it('I Failed to enter the guru dashboard page', async () => {
        await expect(LoginGuru.txtSignIn).toBeDisplayed()
    })
});
