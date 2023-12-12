const { expect } = require('@wdio/globals')
const LoginGuru = require('../../../../../pageobjects/loginSiswa.page')

describe('Login with empty password', () => {
    it('I input username and empty password', async () => {
        await LoginGuru.open()
        await LoginGuru.login('yen', '')
    })

    it('I Failed to enter the guru dashboard page', async () => {
        await expect(LoginGuru.txtSignIn).toBeDisplayed()
    })
})
