const { expect } = require('@wdio/globals');
const LoginSiswa = require('../../../pageobjects/loginGuru.page');

describe('Logout Siswa Account', () => {
    it('should logout successfully', async () => {
        // Lakukan login terlebih dahulu untuk masuk ke dashboard
        await LoginSiswa.open();
        await LoginSiswa.login('guru', 'guru123');

        // Lakukan langkah-langkah logout
        await LoginGuru.logout();

        // Verifikasi bahwa elemen login telah muncul setelah logout
        await expect(LoginGuru.txtLogin).toBeDisplayed();
    });
});
