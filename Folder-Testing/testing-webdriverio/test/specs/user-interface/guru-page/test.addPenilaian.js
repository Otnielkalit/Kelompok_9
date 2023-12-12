const LoginGuru = require('../../../pageobjects/loginGuru.page')
const PenilaianPage = require('../../../pageobjects/pointPenilaian.page')

describe('Add new class', () => {
    it('should login with valid credentials', async () => {
        await LoginGuru.open()
        await LoginGuru.login('guru', 'guru123')
    })

    it('should I redirect to dashboard page', async () => {
        await expect(LoginGuru.txtDasboard).toBeDisplayed()
    })

    it('Click menu Point Penilaian', async () => {
        browser.pause(5000)
        await PenilaianPage.tabPoint.waitForDisplayed({ setTimeout: 5000 })
        await PenilaianPage.tabPoint.click();
    })

    it('I Succes redirect to Point Penilaian page', async () => {
        await expect(PenilaianPage.txtPoin).toBeDisplayed();
    })

    it('Click menu Drop Down Pilih Aspek', async () => {
        browser.pause(5000)
        await PenilaianPage.aspekDropdown.click();
        browser.pause(10000)
    })

    it('Click one aspek ', async () => {
        browser.pause(5000);
        await PenilaianPage.selectFirstAspek();
        browser.pause(20000);
    });

    it('I input point name', async () => {
        await PenilaianPage.addPoint('Ketepatan dalam menembak')
        browser.pause(5000)
    })

    it('Succes add data penilaian aspek', async () => {
        await expect(PenilaianPage.newData('Ketepatan dalam menembak')).toBeDisplayed()
    })

})
