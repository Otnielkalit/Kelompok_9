const { expect } = require('@wdio/globals')
const LoginGuru = require('../../../../../pageobjects/loginSiswa.page')

describe('Login with empty username ', () => {
    it('I Input empty username and input password', async () => {
        await LoginGuru.open()
        await LoginGuru.login('', 'yen123123')
    })

    it('I Failed to enter the guru dashboard page', async () => {
        await expect(LoginGuru.txtSignIn).toBeDisplayed()
    })
})
