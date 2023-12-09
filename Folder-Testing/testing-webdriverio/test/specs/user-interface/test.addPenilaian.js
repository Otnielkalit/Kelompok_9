const LoginGuru = require('../../pageobjects/loginGuru.page')
const PenilaianPage = require('../../pageobjects/pointPenilaian.page')

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

    // it('I Chose Aspek', async () => {
    //     const PenilaianPage = new PenilaianPage();
    //     await PenilaianPage.selectFirstAspek();
    //     browser.pause(10000);
    // });


    // it('Input data to form Tambah Kelas', async () => {
    //     await KelasPage.addKelas('1008', 'Tadikah Mesrah')
    //     browser.pause(5000)
    // })

    // it('Succes add data kelas', async () => {
    //     await expect(KelasPage.newData('1008')).toBeDisplayed()
    // })
})
