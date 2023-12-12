const { expect } = require('@wdio/globals')
const LoginPage = require('../../pageobjects/loginGuru.page')


describe('My Login application', () => {
    it('should login with valid credentials', async () => {
        await LoginPage.open()
        await LoginPage.login('yen', 'yen123')
    })

    it('should I redirect to dashboard page', async () => {
        await expect(LoginPage.txtDasboard).toBeDisplayed()
    })
})

