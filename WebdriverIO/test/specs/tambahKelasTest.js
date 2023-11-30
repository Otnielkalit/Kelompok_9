const { expect } = require('@wdio/globals');
const TambahKelasPage = require('../pageobjects/tambahKelas.page');

describe('Tambah Kelas Test', () => {
    it('should add a new class', async () => {
        await TambahKelasPage.open();
        await TambahKelasPage.addNewClass('10006', 'Kelas ABC');
        // You may add assertions to validate the successful addition of the class
        // For instance, checking if the added class appears in the list or if a success message is displayed.
        // Example:
        // await expect(/* Element showing success message or added class */).toBeDisplayed();
    });
});
celar
