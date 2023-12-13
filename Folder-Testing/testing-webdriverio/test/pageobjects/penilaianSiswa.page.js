const { $ } = require('@wdio/globals')
const Page = require('./page');

/**
 * sub page containing specific selectors and methods for a specific page
 */
class PenilaianSiswaPage extends Page {
    /**
     * define selectors using getter methods
     */
    get tabPenilaian() {
        return $('a[id="penilaian-siswa"]');
    }

    get txtNilai() {
        return $('//*[@id="navbarBlur"]/div/nav/h6');
    }

    get txtNilaiDetail() {
        return $('//*[@id="navbarBlur"]/div/nav/h6')
    }

    get btnAddData() {
        return $('button[data-bs-target="#tambah_data"]');
    }

    get modalForm() {
        return $('//*[@id="tambah_data"]')
    }

    get fieldSemester() {
        return $('input[name="semester"]')
    }

    get fieldAwalAjaran() {
        return $('input[name="awal_ajaran"]');
    }

    get fieldAkhirAjaran() {
        return $('input[name="akhir_ajaran"]');
    }

    get poinDropdown() {
        return $('#poin');
    }


    selecSecondPoin() {
        this.poinDropdown.click();
        this.poinDropdown.waitForDisplayed();
        const secondOption = this.poinDropdown.$('option:nth-child(3)');
        secondOption.click();
    }

    get nilaiDropdown() {
        return $('#nilai');
    }

    selectFirstNilai() {
        this.nilaiDropdown.waitForDisplayed();
        this.nilaiDropdown.click();
        const firstOption = $(`#nilai option[value="mb"]`);
        firstOption.waitForDisplayed();
        firstOption.scrollIntoView();
        firstOption.click();
    }

    get btnSubmit() {
        return $('button[id="add-perkembangan"]');
    }

    newData(semester) {
        return $$('//table//tbody//td[2][contains(text(), "' + semester + '")]/ancestor::tr');
    }

    async inputSemester(semester) {
        await this.fieldSemester.setValue(semester);

    }

    async inputAwalAjaran(awal_ajaran) {
        await this.fieldAwalAjaran.setValue(awal_ajaran);

    }

    async inputAkhirAjaran(akhir_ajaran) {
        await this.fieldAkhirAjaran.setValue(akhir_ajaran);

    }
}

module.exports = new PenilaianSiswaPage();
