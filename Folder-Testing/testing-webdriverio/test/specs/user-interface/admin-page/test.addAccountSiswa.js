const LoginPage = require('../../../pageobjects/loginGuru.page')
const AddSiswaPage = require('../../../pageobjects/addSiswa.page')
const addSiswaPage = require('../../../pageobjects/addSiswa.page')

describe('Add new class', () => {
    it('should login with valid credentials', async () => {
        await LoginPage.open()
        await LoginPage.login('admin', '121212')
    })

    it('should I redirect to dashboard page', async () => {
        await expect(LoginPage.txtDasboard).toBeDisplayed()
    })

    it('Click menu Siswa', async () => {
        browser.pause(5000)
        await AddSiswaPage.tabSiswa.waitForDisplayed({ setTimeout: 5000 })
        await AddSiswaPage.tabSiswa.click();
    })

    it('I Succes redirect to Siswa page', async () => {
        await expect(AddSiswaPage.txtSiswa).toBeDisplayed();
        browser.pause(5000)
    })

    it('Input username', async () => {
        await AddSiswaPage.inputUsername('anita')
        browser.pause(30000)
    })

    it('Input password', async () => {
        await AddSiswaPage.inputPassword('anita123')
        browser.pause(30000)
    })

    it('Input full name', async () => {
        await AddSiswaPage.inputName('Anita')
        browser.pause(30000)
    })

    it('Input NISN', async () => {
        await AddSiswaPage.inputNISN('123456')
        browser.pause(3000)
    })

    it('Input Tempat Lahir', async () => {
        await AddSiswaPage.inputTmptLahir('Narumonda Masuk ke dalam bidan desa')
        browser.pause(5000)
    })

    it('Input Tanggal Lahir', async () => {
        await AddSiswaPage.inputTglLahir('22122002')
        browser.pause(30000)
    })

    it('Choose Jenis Kelamin', async () => {
        await AddSiswaPage.fieldJenisKelamin.click();
        browser.pause(50000)
    });

    it('Click Agama Drop Down', async () => {
        await AddSiswaPage.agamaDropdown.click();
        browser.pause(5000)
    });

    it('Click Agama Kristen in drop down agama', async () => {
        await AddSiswaPage.selectAgama();
        browser.pause(5000)
    });

    it('Choose kelas', async () => {
        await AddSiswaPage.selectKelas();
        browser.pause(5000)
    });

    it('Input Nama Ayah', async () => {
        await AddSiswaPage.inputNamaAyah('Mardalan Munthe')
        browser.pause(30000)
    })

    it('Input Nama Ayah', async () => {
        await AddSiswaPage.inputNamaIbu('Cita Citata')
        browser.pause(30000)
    })

    it('Input Alamat', async () => {
        await AddSiswaPage.inputAlamat('Narumonda Masuk dalam belok kiri rumah hijau agak berabu')
        browser.pause(30000)
    })

    it('Click Button Submit and i Succes Register new siswa account', async () => {
        browser.pause(30000);
        await AddSiswaPage.btnSubmit.click();
        browser.pause(30000);
    });

    // it('Succes Register account siswa', async () => {
    //     await expect(KelasPage.newData('anita')).toBeDisplayed()
    // })

})
