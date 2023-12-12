const axios = require('axios');
const { expect } = require('chai');

describe('Testing API Hapus Kelas', () => {
  // Test penghapusan kelas
  it('should delete a class successfully', async () => {
    try {
      const classIdToDelete = '138';

      const deleteUrl = `http://localhost:8081/kelas/${classIdToDelete}`;
      const response = await axios.delete(deleteUrl);

      expect(response.status).to.equal(200);
    } catch (error) {
      throw new Error(error.response ? error.response.data : error.message);
    }
  });
});
