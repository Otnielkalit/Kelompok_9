const { $ } = require('@wdio/globals')
const Page = require('./page');

/**
 * sub page containing specific selectors and methods for a specific page
 */
class KelasPage extends Page {
    /**
     * define selectors using getter methods
     */
    get tabAspek() {
        return $('a[id="aspek"]');
    }

    get txtAspek() {
        return $('//*[@id="navbarBlur"]/div/nav/h6');
    }

    get fieldNamaAspek() {
        return $('input[name="nama_aspek"]');
    }

    get fieldKode() {
        return $('input[name="kode"]');
    }

    get fieldKelas() {
        return $('select[name="kelas_id"]');
    }

    get btnSubmit() {
        return $('button[id="submit"]');
    }
    newData(kode) {
        // const combinedSelector = $$(`//span[contains(text(), "${nama}")], //span[contains(text(),"${nama_kelas}")]`);
        // const selector = `//table//span[contains(text(), "${kode}")]`;
        // return selector;
        return $$(`//table//span[contains(text(), "${kode}")]`)
    }

    async addKelas(kode, nama_kelas) {
        await this.fieldKode.setValue(kode);
        await this.fieldNamaKelas.setValue(nama_aspek);
        await this.fieldKelas.setValue(kelas_id);
        await this.btnSubmit.click();
    }
}

module.exports = new KelasPage();
