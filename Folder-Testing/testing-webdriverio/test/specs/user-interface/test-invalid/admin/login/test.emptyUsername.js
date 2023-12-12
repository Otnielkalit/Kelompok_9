const { expect } = require('@wdio/globals')
const LoginPage = require('../../../../../pageobjects/loginAdmin.page')

describe('Login with empty username ', () => {
    it('Failed to enter the admin dashboard page', async () => {
        await LoginPage.open()
        await LoginPage.login('', '121212')
        const errorMessageElement = await LoginPage.getErrorElement()
        await expect(errorMessageElement).toBeDisplayed()
    })
})
