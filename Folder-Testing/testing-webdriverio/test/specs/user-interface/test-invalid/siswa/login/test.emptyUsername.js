const { expect } = require('@wdio/globals')
const LoginPage = require('../../../../../pageobjects/loginSiswa.page')

describe('Login with empty username ', () => {
    it('I input empty username and input password', async () => {
        await LoginPage.open()
        await LoginPage.login('', 'yen123')
    })

    it('I see the error message Username tidak boleh kosong.', async () => {
        await expect(LoginPage.errorUsernameEmpty).toBeDisplayed();
    })

    it('I Failed to enter the siswa dashboard page', async () => {
        await expect(LoginPage.txtSignIn).toBeDisplayed()
    })
})
