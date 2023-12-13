const LoginPage = require('../../../pageobjects/loginAdmin.page')
const AspekPage = require('../../../pageobjects/aspek.page')



describe('Add new Aspek in admin page', () => {
    it('should login with valid credentials', async () => {
        await LoginPage.open()
        await LoginPage.login('admin', '121212')
    })

    it('should I redirect to dashboard page', async () => {
        await expect(LoginPage.txtDasboard).toBeDisplayed()
    })

    it('Click menu Aspek', async () => {
        browser.pause(5000)
        await AspekPage.tabAspek.waitForDisplayed({ setTimeout: 5000 })
        await AspekPage.tabAspek.click();
    })

    it('I Succes redirect to kelas page', async () => {
        await expect(AspekPage.txtAspek).toBeDisplayed();
    })

    it('Input data to form Tambah Aspek', async () => {
        await AspekPage.addAspek('Ketangkasan', '1001')
        browser.pause(5000)
    })

    it('Click Drop Down Select Kelas', async () => {
        await AspekPage.clickDropDownd.click();
        browser.pause(5000)
    })

    it('Click first data that is playgroup in drop down', async () => {
        await AspekPage.selectKelas()
        browser.pause(5000)
    })

    it('Click Button Submit', async () => {
        browser.pause(5000)
        await AspekPage.btnSubmit.waitForDisplayed({ setTimeout: 5000 })
        await AspekPage.btnSubmit.click();
    })

    it('Succes add data Aspek', async () => {
        await expect(AspekPage.newData('1001')).toBeDisplayed()
    })

})
