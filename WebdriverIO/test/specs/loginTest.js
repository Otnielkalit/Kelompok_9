const { expect } = require('@wdio/globals')
const LoginPage = require('../pageobjects/login.page')

describe('My Login application', () => {
    it('should login with valid credentials', async () => {
        await LoginPage.open()
        await LoginPage.login('admin', '121212')
        await expect(LoginPage.txtDashboard).toBeDisplayed()
    })
})
