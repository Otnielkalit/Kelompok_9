const LoginPage = require('../../pageobjects/loginAdmin.page')
const KelasPage = require('../../pageobjects/kelas.page')

describe('Add new class', () => {
    it('should login with valid credentials', async () => {
        await LoginPage.open()
        await LoginPage.login('admin', '121212')
    })

    it('should I redirect to dashboard page', async () => {
        await expect(LoginPage.txtDasboard).toBeDisplayed()
    })

    it('Click menu Aspek', async () => {
        browser.pause(5000)
        await KelasPage.tabKelas.waitForDisplayed({ setTimeout: 5000 })
        await KelasPage.tabKelas.click();
    })

    it('I Succes redirect to kelas page', async () => {
        await expect(AspekPage.txtAspek).toBeDisplayed();
    })

    it('Input data to form Tambah Aspek', async () => {
        await AspekPage.addKelas('Seni Budaya', '1001', 'playgroup')
        browser.pause(5000)
    })

    it('Succes add data Aspek', async () => {
        await expect(KelasPage.newData('1008')).toBeDisplayed()
    })

})
