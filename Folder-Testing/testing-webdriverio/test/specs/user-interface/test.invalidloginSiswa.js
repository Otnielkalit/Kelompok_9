const { expect } = require('@wdio/globals')
const LoginPage = require('../../pageobjects/loginSiswa.page')

describe('My Login application', () => {
    // ... (test cases for valid credentials)

    it('should show error for invalid username', async () => {
        await LoginPage.open()

        // Use an invalid username and a valid password
        await LoginPage.login('', 'yen123')

        // Assuming you have a method to get the text of the error message element
        const errorMessage = await LoginPage.getErrorMessage()

        // Assert that the error message text contains the expected message
        expect(errorMessage).toContain('username harus diisi')
    })

    it('should show error for invalid password', async () => {
        await LoginPage.open()

        // Use a valid username and an invalid password
        await LoginPage.login('yen', '')

        // Assuming you have a method to get the text of the error message element
        const errorMessage = await LoginPage.getErrorMessage()

        // Assert that the error message text contains the expected message
        expect(errorMessage).toContain('password harus diisi')
    })

    it('should show error for both invalid username and password', async () => {
        await LoginPage.open()

        // Use an invalid username and an invalid password
        await LoginPage.login('', '')

        // Assuming you have a method to get the text of the error message element
        const errorMessage = await LoginPage.getErrorMessage()

        // Assert that the error message text contains the expected message
        expect(errorMessage).toContain('username atau password harus diisi')
    })
})
