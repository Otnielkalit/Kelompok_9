const { expect } = require('@wdio/globals');
const LoginSiswa = require('../../../pageobjects/loginAdmin.page');

describe('Logout Siswa Account', () => {
    it('should logout successfully', async () => {
        // Lakukan login terlebih dahulu untuk masuk ke dashboard
        await LoginSiswa.open();
        await LoginSiswa.login('admin', '121212');

        // Lakukan langkah-langkah logout
        await LoginAdmin.logout();

        // Verifikasi bahwa elemen login telah muncul setelah logout
        await expect(LoginAdmin.txtLogin).toBeDisplayed();
    });
});
