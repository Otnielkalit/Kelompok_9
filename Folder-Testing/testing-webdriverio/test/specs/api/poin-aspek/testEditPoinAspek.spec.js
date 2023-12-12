const axios = require('axios');
const { expect } = require('chai');

describe('Testing API Update Poin-Aspek', () => {
  it('should update a aspect point successfully', async () => {
    try {
      // ID kelas yang akan diupdate
      const classIdToUpdate = '12';

      // Data yang akan digunakan untuk update kelas
      const updatedData = {
        nama_poin: 'bisa mengenal abjad',
        aspek_id: 39
      };

      const updateUrl = `http://localhost:8081/poin-aspek/${classIdToUpdate}`;
      const response = await axios.put(updateUrl, updatedData);

      // Periksa status respons
      expect(response.status).to.equal(200);
    } catch (error) {
      throw new Error(error.response ? error.response.data : error.message);
    }
  });
});
