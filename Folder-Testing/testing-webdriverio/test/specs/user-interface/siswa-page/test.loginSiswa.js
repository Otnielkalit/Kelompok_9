const { expect } = require('@wdio/globals')
const LoginSiswa = require('../../../pageobjects/loginGuru.page')


describe('Login Siswa Account', () => {
    it('should login with valid credentials', async () => {
        await LoginSiswa.open()
        await LoginSiswa.login('guru', 'guru123')
    })

    it('should I redirect to dashboard page', async () => {
        await expect(LoginSiswa.txtDasboard).toBeDisplayed()
    })
})

