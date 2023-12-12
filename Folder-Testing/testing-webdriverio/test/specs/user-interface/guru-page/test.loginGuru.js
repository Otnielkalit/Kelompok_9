const { expect } = require('@wdio/globals')
const LoginPage = require('../../../pageobjects/loginGuru.page')


describe('Login Guru account', () => {
    it('should login with valid credentials', async () => {
        await LoginPage.open()
        await LoginPage.login('guru', 'guru123')
    })

    it('should I redirect to dashboard page', async () => {
        await expect(LoginPage.txtDasboard).toBeDisplayed()
    })
})

