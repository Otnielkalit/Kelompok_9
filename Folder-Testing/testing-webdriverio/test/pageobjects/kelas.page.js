const { $ } = require('@wdio/globals')
const Page = require('./page');

/**
 * sub page containing specific selectors and methods for a specific page
 */
class KelasPage extends Page {
    /**
     * define selectors using getter methods
     */
    get tabKelas() {
        return $('a[id="kelas"]');
    }

    get txtKelas() {
        return $('//*[@id="navbarBlur"]/div/nav/h6');
    }

    get fieldKode() {
        return $('input[name="kode"]');
    }

    get fieldNamaKelas() {
        return $('input[name="nama_kelas"]');
    }

    get btnSubmit() {
        return $('button[id="tambah"]');
    }

    newData(kode) {
        // const combinedSelector = $$(`//span[contains(text(), "${nama}")], //span[contains(text(),"${nama_kelas}")]`);
        // const selector = `//table//span[contains(text(), "${kode}")]`;
        // return selector;
        return $$(`//table//span[contains(text(), "${kode}")]`)
    }

    async addKelas(kode, nama_kelas) {
        await this.fieldKode.setValue(kode);
        await this.fieldNamaKelas.setValue(nama_kelas);
        await this.btnSubmit.click();
    }
}

module.exports = new KelasPage();
