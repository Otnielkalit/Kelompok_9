const { expect } = require('@wdio/globals')
const LoginPage = require('../../../../../pageobjects/loginAdmin.page')

describe('Login with empty username ', () => {
    it('I input empty username and input password', async () => {
        await LoginPage.open()
        await LoginPage.login('', '121212')
    })

    it('I see the error message Username tidak boleh kosong.', async () => {
        await expect(LoginPage.errorUsernameEmpty).toBeDisplayed();
    })

    it('I Failed to enter the admin dashboard page', async () => {
        await expect(LoginPage.txtSignIn).toBeDisplayed()
    })
})
