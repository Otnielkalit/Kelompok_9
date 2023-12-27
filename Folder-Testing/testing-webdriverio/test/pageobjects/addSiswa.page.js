const { $ } = require('@wdio/globals')
const Page = require('./page');


/**
 * sub page containing specific selectors and methods for a specific page
 */
class AddSiswaPage extends Page {
    /**
     * define selectors using getter methods
     */
    get tabSiswa() {
        return $('a[id="siswa"]');
    }

    get txtSiswa() {
        return $('//*[@id="navbarBlur"]/div/nav/h6');
    }

    get fieldUsername() {
        return $('input[name="username"]');
    }

    get fieldPassword() {
        return $('input[name="password"]');
    }

    get fieldFullName() {
        return $('input[name="nama"]');
    }

    get fieldNISN() {
        return $('input[name="nisn"]');
    }

    get fieldTmptLahir() {
        return $('input[name="tempat_lahir"]');
    }

    get fieldTglLahir() {
        return $('input[name="tanggal_lahir"]');
    }

    get fieldJenisKelamin() {
        return $('input[id="perempuan"]');
    }

    get agamaDropdown() {
        return $('select[id="agama"]');
    }

    selectAgama() {
        this.agamaDropdown.click();
        const kristenOption = $(`#agama option[value="kristen"]`);
        kristenOption.waitForDisplayed();
        kristenOption.scrollIntoView();
        kristenOption.click();
    }


    get kelasDropdown() {
        return $('#dropdown-kelas');
    }

    selectKelas() {
        this.kelasDropdown.waitForDisplayed();
        this.kelasDropdown.click();
        const firstOption = this.kelasDropdown.$('option:nth-child(2)');
        firstOption.waitForDisplayed();
        firstOption.click();
    }

    get fieldNamaAyah() {
        return $('input[name="nama_ayah"]');
    }

    get fieldNamaIbu() {
        return $('input[name="nama_ibu"]');
    }

    get fieldAlamat() {
        return $('textarea[name="alamat"]');
    }


    get btnSubmit() {
        return $('button[id="tambah-siswa"]');
    }

    newData(username) {
        // const combinedSelector = $$(`//span[contains(text(), "${nama}")], //span[contains(text(),"${nama_kelas}")]`);
        // const selector = `//table//span[contains(text(), "${kode}")]`;
        // return selector;
        return $$(`//table//span[contains(text(), "${username}")]`)
    }

    async inputUsername(username) {
        await this.fieldUsername.setValue(username);
    }
    async inputPassword(password) {
        await this.fieldPassword.setValue(password);
    }
    async inputName(nama) {
        await this.fieldFullName.setValue(nama);
    }
    async inputNISN(nisn) {
        await this.fieldNISN.setValue(nisn);
    }
    async inputTmptLahir(tempat_lahir) {
        await this.fieldTmptLahir.setValue(tempat_lahir);
    }
    async inputTglLahir(tanggal_lahir) {
        await this.fieldTglLahir.setValue(tanggal_lahir);

    }
    async inputNamaAyah(nama_ayah) {
        await this.fieldNamaAyah.setValue(nama_ayah);
    }
    async inputNamaIbu(nama_ibu) {
        await this.fieldNamaIbu.setValue(nama_ibu);
    }

    async inputAlamat(alamat) {
        await this.fieldAlamat.setValue(alamat);
    }


}

module.exports = new AddSiswaPage();
