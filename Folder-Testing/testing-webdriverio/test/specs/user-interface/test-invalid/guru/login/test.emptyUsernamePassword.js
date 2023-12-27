const { expect } = require('@wdio/globals')
const LoginGuru = require('../../../../../pageobjects/loginGuru.page')

describe('Login with empty username and password', () => {
    it('I input empty username and empty password', async () => {
        await LoginGuru.open()
        await LoginGuru.login('', '')
    })

    it('I get message error Username dan password tidak boleh kosong.', async () => {
        await expect(LoginGuru.errorBothEmpty).toBeDisplayed()
    })

    it('I Failed to enter the guru dashboard page', async () => {
        await expect(LoginGuru.txtSignIn).toBeDisplayed()
    })

})
