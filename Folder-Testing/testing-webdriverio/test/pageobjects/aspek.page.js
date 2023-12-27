const { $ } = require('@wdio/globals')
const Page = require('./page');

/**
 * sub page containing specific selectors and methods for a specific page
 */
class AspekPage extends Page {
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
 
    get clickDropDownd() {
        return $('select[id="kelas"]');
    }

    selectKelas() {
        const selectElement = this.clickDropDownd;
        selectElement.click();
        const firstOption = $('select[id="kelas"] option:nth-child(2)');
        firstOption.click();
    }
    get btnSubmit() {
        return $('button[id="btnAdd"]');
    }

    newData(kode) {
        return $$(`//table//span[contains(text(), "${kode}")]`)
    }

    async addAspek(nama_aspek, kode) {
        await this.fieldNamaAspek.setValue(nama_aspek);
        await this.fieldKode.setValue(kode);
    }
}

module.exports = new AspekPage();
