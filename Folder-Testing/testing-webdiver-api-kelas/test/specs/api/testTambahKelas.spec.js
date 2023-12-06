const axios = require('axios');
const { expect } = require('chai');

describe('Testing API', () => {
  it('should return expected response', async () => {
    try {
      const apiUrl = 'http://localhost:8080/kelas';
      const requestData = {
        kode: '1007',
        nama_kelas: 'Kelas ABC'
      };

      const response = await axios.post(apiUrl, requestData);

      // Lakukan asersi terhadap respons yang diterima
      expect(response.status).to.equal(200);
    } catch (error) {
      throw new Error(error.response ? error.response.data : error.message);
    }
  });
});
