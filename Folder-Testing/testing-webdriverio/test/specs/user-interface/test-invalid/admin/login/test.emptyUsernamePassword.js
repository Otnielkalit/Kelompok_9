const { expect } = require('@wdio/globals')
const LoginPage = require('../../../../../pageobjects/loginAdmin.page')

describe('Login with empty username and password', () => {
    it('I input empty username and password ', async () => {
        await LoginPage.open()
        await LoginPage.login('', '')
    })
    it('I Failed to enter the admin dashboard page', async () => {
        await expect(LoginPage.txtSignIn).toBeDisplayed()
    })
})
