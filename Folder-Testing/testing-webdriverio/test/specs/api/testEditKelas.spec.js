const axios = require('axios');
const { expect } = require('chai');

describe('Testing API Update Kelas', () => {
  it('should update a class successfully', async () => {
    try {
      // ID kelas yang akan diupdate
      const classIdToUpdate = '139';

      // Data yang akan digunakan untuk update kelas
      const updatedData = {
        nama_kelas: 'Tadikah Mesrah'
      };

      const updateUrl = `http://localhost:8081/kelas/${classIdToUpdate}`;
      const response = await axios.put(updateUrl, updatedData);

      // Periksa status respons
      expect(response.status).to.equal(200);
    } catch (error) {
      throw new Error(error.response ? error.response.data : error.message);
    }
  });
});
