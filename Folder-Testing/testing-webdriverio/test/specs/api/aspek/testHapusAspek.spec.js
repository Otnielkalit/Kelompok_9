const axios = require('axios');
const { expect } = require('chai');

describe('Testing API Hapus aspek', () => {
  // Test penghapusan aspek
  it('should delete a aspek successfully', async () => {
    try {
      const classIdToDelete = '47';

      const deleteUrl = `http://localhost:8081/aspek/${classIdToDelete}`;
      const response = await axios.delete(deleteUrl);

      expect(response.status).to.equal(200);
    } catch (error) {
      throw new Error(error.response ? error.response.data : error.message);
    }
  });
});
