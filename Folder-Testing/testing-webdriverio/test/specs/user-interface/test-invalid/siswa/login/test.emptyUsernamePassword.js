const { expect } = require('@wdio/globals')
const LoginPage = require('../../../../../pageobjects/loginSiswa.page')

describe('Login with empty username and password', () => {
    it('I input empty username and password ', async () => {
        await LoginPage.open()
        await LoginPage.login('', '')
    })

    it('I Get the message error Username dan password tidak boleh kosong.', async () => {
        await expect(LoginPage.errorBothEmpty).toBeDisplayed()
    })
    it('I Failed to enter the siswa dashboard page', async () => {
        await expect(LoginPage.txtSignIn).toBeDisplayed()
    })
})
