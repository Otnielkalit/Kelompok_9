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
        this.aspekDropdown.waitForDisplayed();
        const firstOption = this.aspekDropdown.$('option:nth-child(2)'); // Adjust the index accordingly
        firstOption.click();
    }

    get fieldNamaPoint() {
        return $('input[name="nama_poin"]');
    }

    get btnSubmit() {
        return $('button[id="tambahPoint"]');
    }

    newData(nama_poin) {
        return $$(`//table//span[contains(text(), "${nama_poin}")]`)
    }

    async addPoint(fieldNamaPoint) {
        await this.fieldNamaPoint.setValue(fieldNamaPoint);
        await this.btnSubmit.click();
    }
}

module.exports = new PenilaianPage();
