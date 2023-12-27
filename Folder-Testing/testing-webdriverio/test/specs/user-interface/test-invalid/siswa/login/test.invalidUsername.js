const { expect } = require('@wdio/globals')
const LoginPage = require('../../../../../pageobjects/loginSiswa.page')

describe('Login with invalid username', () => {
    it('I input wrong username and ai input password', async () => {
        await LoginPage.open()
        await LoginPage.login('invalidusername', 'yen123')
    })

    it('I get error message Username atau password salah.', async () => {
        await expect(LoginPage.errorUsernameIncorrect).toBeDisplayed()
    })

    it('I Failed to enter the siswa dashboard page', async () => {
        await expect(LoginPage.txtSignIn).toBeDisplayed()
    })
})
