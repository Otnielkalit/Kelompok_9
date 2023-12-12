const { expect } = require('@wdio/globals')
const LoginGuru = require('../../../../../pageobjects/loginGuru.page')

describe('Login with empty username ', () => {
    it('I Input empty username and input password', async () => {
        await LoginGuru.open()
        await LoginGuru.login('', 'guru123')
    })

    it('I Failed to enter the guru dashboard page', async () => {
        await expect(LoginGuru.txtSignIn).toBeDisplayed()
    })
})
