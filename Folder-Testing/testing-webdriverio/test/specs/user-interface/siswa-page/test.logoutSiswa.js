const { expect } = require('@wdio/globals');
const LoginSiswa = require('../../../pageobjects/loginSiswa.page');

describe('Logout Siswa Account', () => {
    it('should logout successfully', async () => {
        // Lakukan login terlebih dahulu untuk masuk ke dashboard
        await LoginSiswa.open();
        await LoginSiswa.login('yen', 'yen123');

        // Lakukan langkah-langkah logout
        await LoginSiswa.logout();

        // Verifikasi bahwa elemen login telah muncul setelah logout
        await expect(LoginSiswa.txtLogin).toBeDisplayed();
    });
});
