const { $ } = require('@wdio/globals');
const Page = require('./page');

class TambahKelasPage extends Page {
    get inputKodeKelas() {
        return $('input[name="kode"]');
    }

    get inputNamaKelas() {
        return $('input[name="nama_kelas"]');
    }

    get btnSubmit() {
        return $('button[type="submit"]');
    }

    async addNewClass(kode, namaKelas) {
        await this.inputKodeKelas.setValue(kode);
        await this.inputNamaKelas.setValue(namaKelas);
        await this.btnSubmit.click();
    }

    open() {
        return super.open('kelas');
    }
}
module.exports = new TambahKelasPage();

