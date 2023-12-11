const axios = require('axios');
const { expect } = require('chai');

describe('Testing API Hapus poin-aspek', () => {
  // Test penghapusan aspek
  it('should delete a aspect point successfully', async () => {
    try {
      const classIdToDelete = '22';

      const deleteUrl = `http://localhost:8081/poin-aspek/${classIdToDelete}`;
      const response = await axios.delete(deleteUrl);

      expect(response.status).to.equal(200);
    } catch (error) {
      throw new Error(error.response ? error.response.data : error.message);
    }
  });
});
