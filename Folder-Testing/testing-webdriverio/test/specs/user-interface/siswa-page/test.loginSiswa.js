const { expect } = require('@wdio/globals')
const LoginSiswa = require('../../../pageobjects/loginSiswa.page')


describe('Login Siswa Account', () => {
    it('should login with valid credentials', async () => {
        await LoginSiswa.open()
        await LoginSiswa.login('yen', 'yen123')
    })

    it('should I redirect to dashboard page', async () => {
        await expect(LoginSiswa.txtDasboard).toBeDisplayed()
    })
})

