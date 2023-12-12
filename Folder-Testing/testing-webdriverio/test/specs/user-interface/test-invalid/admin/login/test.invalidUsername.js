const { expect } = require('@wdio/globals')
const LoginPage = require('../../../../../pageobjects/loginAdmin.page')

describe('Login with invalid username', () => {
    it('Failed to enter the admin dashboard page', async () => {
        await LoginPage.open()
        await LoginPage.login('adminawdaw', '121212')
    })
})
