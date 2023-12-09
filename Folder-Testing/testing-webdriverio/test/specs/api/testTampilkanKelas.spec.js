const axios = require('axios');
const { expect } = require('chai');

describe('Testing API Mengambil Data Kelas', () => {
  it('should fetch class data successfully', async () => {
    try {
      const fetchUrl = 'http://localhost:8080/kelas'; // Ganti dengan URL yang sesuai untuk mengambil data kelas

      const response = await axios.get(fetchUrl);

      expect(response.status).to.equal(200);
      expect(response.data).to.be.an('array');
      expect(response.data.length).to.be.greaterThan(0);
    } catch (error) {
      throw new Error(error.response ? error.response.data : error.message);
    }
  });
});
