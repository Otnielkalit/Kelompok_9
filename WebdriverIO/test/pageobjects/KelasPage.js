const { $ } = require('@wdio/globals')
const pageTambahKelas = require('./pageTambahKelas');

class KelasPage extends pageTambahKelas {

    get kodeInput() { 
      return $('input[name="kode"]'); 
    }

    get namaKelasInput() { 
      return $('input[name="nama_kelas"]'); 
    }

    get submitButton() { 
      return $('button[type="submit"]'); 
    }
  
    // Metode untuk mengisi formulir kelas
    async kelas_add (kode, namaKelas) {
      this.kodeInput.setValue(kode);
      this.namaKelasInput.setValue(namaKelas);
      this.submitButton.click();
    }
    open () {
      return super.open('submit');
  }
}

  module.exports = new KelasPage();
