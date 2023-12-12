const { expect } = require('@wdio/globals')
const LoginPage = require('../../../../../pageobjects/loginGuru.page')

describe('Login with empty password', () => {
    it('Failed to enter the guru dashboard page', async () => {
        await LoginPage.open()
        await LoginPage.login('guru', '')
    })
})
