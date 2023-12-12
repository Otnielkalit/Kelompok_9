const { expect } = require('@wdio/globals')
const LoginPage = require('../../../pageobjects/loginAdmin.page')


describe('Login Admin', () => {
    it('should login with valid credentials', async () => {
        await LoginPage.open()
        await LoginPage.login('admin', '121212')
    })

    it('should I redirect to dashboard page', async () => {
        await expect(LoginPage.txtDasboard).toBeDisplayed()
    })
})
