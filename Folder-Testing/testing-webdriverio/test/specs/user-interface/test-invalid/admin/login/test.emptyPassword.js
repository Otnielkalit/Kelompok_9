const { expect } = require('@wdio/globals')
const LoginPage = require('../../../../../pageobjects/loginAdmin.page')

describe('Login with empty password', () => {
    it('Failed to enter the admin dashboard page', async () => {
        await LoginPage.open()
        await LoginPage.login('admin', '')
    })
})
