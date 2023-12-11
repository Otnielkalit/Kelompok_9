const { expect } = require('@wdio/globals');
const KelasPage = require('../pageobjects/KelasPage');

describe('Tambah Kelas', () => {
  it('Berhasil menambahkan data kelas', async () => {
    await KelasPage.open();
    await KelasPage.kelas_add('123', 'junior');
    await expect(KelasPage.someElement).toBeDisplayed();
  });
});