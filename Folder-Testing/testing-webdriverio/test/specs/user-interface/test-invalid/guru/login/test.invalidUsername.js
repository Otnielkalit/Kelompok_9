const { expect } = require('@wdio/globals')
const LoginGuru = require('../../../../../pageobjects/loginGuru.page')

describe('Login with invalid username', () => {
    it('I input wrong username and input password', async () => {
        await LoginGuru.open()
        await LoginGuru.login('adminawdaw', 'guru123')
    })

    it('I Failed to enter the admin dashboard page', async () => {
        await expect(LoginGuru.txtSignIn).toBeDisplayed()
    })
})
