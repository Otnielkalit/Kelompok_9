const axios = require('axios');
const { expect } = require('chai');

describe('Testing API tambah kelas', () => {
  it('should return expected response', async () => {
    try {
      const apiUrl = 'http://localhost:8081/kegiatan';
      const requestData = {
        title: 'Meeting',
        start: '2023-01-01T10:00:00Z', // Updated time format
        end: '2023-01-01T12:00:00Z',   // Updated time format
        description: 'Discuss project updates',
        status: '1',
        color: '#3498db'
      };

      const response = await axios.post(apiUrl, requestData);

      // Lakukan asersi terhadap respons yang diterima
      expect(response.status).to.equal(200);
    } catch (error) {
      throw new Error(error.response ? error.response.data : error.message);
    }
  });
});