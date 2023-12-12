const { expect } = require('@wdio/globals')
const LoginPage = require('../../../../../pageobjects/loginAdmin.page')

describe('Login with empty password', () => {
    it('I input username and empty password', async () => {
        await LoginPage.open()
        await LoginPage.login('admin', '')
    })

    it('I Failed to enter the admin dashboard page', async () => {
        await expect(LoginPage.txtSignIn).toBeDisplayed()
    })
})
