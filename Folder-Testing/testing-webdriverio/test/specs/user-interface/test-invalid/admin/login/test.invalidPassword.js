const { expect } = require('@wdio/globals');
const LoginPage = require('../../../../../pageobjects/loginAdmin.page');

describe('My Login application', () => {
    it('Failed to enter the admin dashboard page', async () => {
        await LoginPage.open();
        await LoginPage.login('admin', 'invalidpassword');
    });
});
