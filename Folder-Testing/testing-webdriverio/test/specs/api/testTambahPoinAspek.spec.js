const axios = require('axios');
const { expect } = require('chai');

describe('Testing API - Tambah Poin-Aspek', () => {
  let apiUrl;
  const requestData = {
    nama_poin: 'Perkalian',
    aspek_id: 39
  };

  before(() => {
    apiUrl = 'http://localhost:8081/poin-aspek';
  });

  it('should successfully add a new poin-aspek', async () => {
    try {
      const response = await axios.post(apiUrl, requestData);

      // Assert against the received response
      expect(response.status).to.equal(200);
      // Add additional assertions if needed
    } catch (error) {
      console.error('Error:', error); // Log the actual error for more details
      console.log('Response:', error.response); // Log the entire response object
      throw new Error(error.response ? error.response.data : error.message);
    }
  });
});
