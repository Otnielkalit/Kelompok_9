const { expect } = require('@wdio/globals')
const LoginPage = require('../../../../../pageobjects/loginAdmin.page')

describe('Login with invalid username', () => {
    it('I input wrong username and ai input password', async () => {
        await LoginPage.open()
        await LoginPage.login('adminawdaw', '121212')
    })

    it('I get error message Username atau password salah.', async () => {
        await expect(LoginPage.errorUsernameIncorrect).toBeDisplayed()
    })

    it('I Failed to enter the admin dashboard page', async () => {
        await expect(LoginPage.txtSignIn).toBeDisplayed()
    })
})
