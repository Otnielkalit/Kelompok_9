const { expect } = require('@wdio/globals')
const LoginGuru = require('../../../../../pageobjects/loginSiswa.page')

describe('Login with invalid username', () => {
    it('I input wrong username and input password', async () => {
        await LoginGuru.open()
        await LoginGuru.login('invalidusername', 'yen123')
    })

    it('I Failed to enter the admin dashboard page', async () => {
        await expect(LoginGuru.txtSignIn).toBeDisplayed()
    })
})
