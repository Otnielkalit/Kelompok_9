const LoginPage = require('../../../pageobjects/loginGuru.page')
const PenilaianSiswaPage = require('../../../pageobjects/penilaianSiswa.page')

describe('Add penilaian siswa detail', () => {
    it('should login with valid credentials', async () => {
        await LoginPage.open()
        await LoginPage.login('guru', 'guru123')
    })

    it('should I redirect to dashboard page', async () => {
        await expect(LoginPage.txtDasboard).toBeDisplayed()
    })

    it('Click menu penilaian siswa', async () => {
        browser.pause(5000)
        await PenilaianSiswaPage.tabPenilaian.waitForDisplayed({ setTimeout: 5000 })
        await PenilaianSiswaPage.tabPenilaian.click();
    })

    it('I Succes redirect to Nilai page', async () => {
        await expect(PenilaianSiswaPage.txtNilai).toBeDisplayed();
    })

    it('Click lihat nilai with full name yennnnnnn', async () => {
        await browser.url('http://127.0.0.1:8000/nilai/66');
        browser.pause(5000);
    });

    it('I Redirect to page Nilai detail yennnnnnn', async () => {
        await expect(PenilaianSiswaPage.txtNilaiDetail).toBeDisplayed()
        browser.pause(50000);
    });

    it('Click Tambah data', async () => {
        browser.pause(50000);
        await PenilaianSiswaPage.btnAddData.click()
    })

    it('Show modal form for input data', async () => {
        await expect(PenilaianSiswaPage.modalForm).toBeDisplayed()
        browser.pause(50000);
    });

    it('Input semester', async () => {
        await PenilaianSiswaPage.inputSemester('2')
        browser.pause(30000)
    })

    it('Input awal ajaran', async () => {
        await PenilaianSiswaPage.inputAwalAjaran('1900')
        browser.pause(30000)
    })

    it('Input akhir ajaran', async () => {
        await PenilaianSiswaPage.inputAkhirAjaran('2000')
        browser.pause(30000)
    })

    it('Click Point Aspek Penilaian Drop Down', async () => {
        await PenilaianSiswaPage.poinDropdown.click();
        browser.pause(5000)
    });

    it('Choose poin aspek yang akan dinilai', async () => {
        await PenilaianSiswaPage.selecSecondPoin();
        browser.pause(5000)
    });

    it('Click Nilai Drop Down', async () => {
        await PenilaianSiswaPage.nilaiDropdown.click();
        browser.pause(5000)
    });

    it('Choose Nilai', async () => {
        await PenilaianSiswaPage.selectFirstNilai();
        browser.pause(5000)
    });

    it('Click Button Submit', async () => {
        await PenilaianSiswaPage.btnSubmit.click();
        browser.pause(30000);
    });

    it('Succes add penilaian siswa with name yennnnnnn', async () => {
        await expect(PenilaianSiswaPage.newData('2')).toBeDisplayed()
    })


})
