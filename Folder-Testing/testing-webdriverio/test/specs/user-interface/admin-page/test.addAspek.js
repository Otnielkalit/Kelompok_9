const LoginPage = require('../../../pageobjects/loginAdmin.page')
const AspekPage = require('../../../pageobjects/aspek.page')

describe('Add new aspek', () => {
    it('should login with valid credentials', async () => {
        await LoginPage.open()
        await LoginPage.login('admin', '121212')
    })

    it('should I redirect to dashboard page', async () => {
        await expect(LoginPage.txtDasboard).toBeDisplayed()
    })

    it('Click menu ', async () => {
        browser.pause(5000)
        await AspekPage.tabAspek.waitForDisplayed({ timeout: 5000 })
        await AspekPage.tabAspek.click()
    })

    it('I Success redirect to aspek page', async () => {
        await expect(AspekPage.txtAspek).toBeDisplayed()
    })

    it('Input data to form Tambah Aspek', async () => {
        await AspekPage.addAspek('49', 'Mencuci')
    })

    it('Click first option in dropdown', async () => {
        await AspekPage.selectKelas()
        browser.pause(5000)
    })

    it('Success add data aspek or display error message', async () => {
        const successMessage = 'Data berhasil ditambahkan'; // Teks pesan sukses yang diharapkan
        const errorMessage = 'Data tidak boleh sama'; // Teks pesan error yang diharapkan

        // Expect either success message or error message to be displayed
        await expect(AspekPage.newData('1008')).toHaveTextContainingAnyOf([successMessage, errorMessage])
    })
})
