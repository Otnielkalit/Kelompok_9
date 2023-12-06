const axios = require('axios');
const { expect } = require('chai');

describe('Testing API Hapus Kelas', () => {
  // Test penambahan kelas
  it('should add a new class successfully', async () => {
    try {
      const apiUrl = 'http://localhost:8080/kelas';
      const requestData = {
        kode: '1007',
        nama_kelas: 'Kelas ABC'
      };

      const response = await axios.post(apiUrl, requestData);

      expect(response.status).to.equal(200);
    } catch (error) {
      throw new Error(error.response ? error.response.data : error.message);
    }
  });

  // Test penghapusan kelas
  it('should delete a class successfully', async () => {
    try {
      const classIdToDelete = '161';

      const deleteUrl = `http://localhost:8080/kelas/${classIdToDelete}`;
      const response = await axios.delete(deleteUrl);

      expect(response.status).to.equal(200);
    } catch (error) {
      throw new Error(error.response ? error.response.data : error.message);
    }
  });
});
