const axios = require('axios');
const { expect } = require('chai');

describe('Testing API - Login', () => {
  it('should successfully login', async () => {
    try {
      const apiUrl = 'http://localhost:8081/login';
      const requestData = {
        username: 'guru',
        password: 'guru123'
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
