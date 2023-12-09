const { $ } = require('@wdio/globals')
const Page = require('./page');

/**
 * sub page containing specific selectors and methods for a specific page
 */
class PenilaianPage extends Page {
    /**
     * define selectors using getter methods
     */
    get tabPoint() {
        return $('a[id="penilaian"]');
    }

    get txtPoin() {
        return $('//*[@id="navbarBlur"]/div/nav/h6');
    }

    get aspekDropdown() {
        return $('#aspek');
    }

    selectFirstAspek() {
        this.aspekDropdown.click();
        const firstAspekOption = this.aspekDropdown.$('option:nth-child(2)');
        firstAspekOption.click();
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

    async addPoint(kode, nama_kelas) {
        await this.fieldKode.setValue(kode);
        await this.fieldNamaKelas.setValue(nama_kelas);
        await this.btnSubmit.click();
    }
}

module.exports = new PenilaianPage();
