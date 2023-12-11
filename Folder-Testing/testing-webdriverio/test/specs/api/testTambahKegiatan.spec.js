const axios = require('axios');
const { expect } = require('chai');

describe('Testing API Edit Kegiatan', () => {
  it('should update an event successfully', async () => {
    try {
      // ID kegiatan yang akan diupdate
      const eventIdToUpdate = '1'; // Ganti dengan ID yang sesuai

      // Data yang akan digunakan untuk update kegiatan
      const updatedEventData = {
        title: 'Meeting Updated',
        start: '2023-01-01T13:00:00Z',
        end: '2023-01-01T15:00:00Z',
        description: 'Discuss project updates and new plans',
        status: '2',
        color: '#e74c3c'
      };

      const updateUrl = `http://localhost:8081/kegiatan/${eventIdToUpdate}`;
      const response = await axios.put(updateUrl, updatedEventData);

      // Periksa status respons
      expect(response.status).to.equal(200);
    } catch (error) {
      throw new Error(error.response ? error.response.data : error.message);
    }
  });
});
