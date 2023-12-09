const axios = require('axios');
const { expect } = require('chai');

describe('Testing API - Tambah Aspek', () => {
  it('should successfully add a new aspect', async () => {
    try {
      const apiUrl = 'http://localhost:8081/aspek';
      const requestData = {
        kode: '12334',
        nama_aspek: 'Penilaian Otak',
        kelas_id: 2
      };

      const response = await axios.post(apiUrl, requestData);

      // Lakukan asersi terhadap respons yang diterima
      expect(response.status).to.equal(200);
      // Tambahkan asersi tambahan jika diperlukan
    } catch (error) {
      throw new Error(error.response ? error.response.data : error.message);
    }
  });
});