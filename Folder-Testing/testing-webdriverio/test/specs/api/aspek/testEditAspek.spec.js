const axios = require('axios');
const { expect } = require('chai');

describe('Testing API Update Aspek', () => {
    it('should update a aspek successfully', async () => {
        try {
            // ID kelas yang akan diupdate
            const classIdToUpdate = '54';

            // Data yang akan digunakan untuk update kelas
            const updatedData = {
                nama_aspek: 'Penailaian perilaku'
            };

            const updateUrl = `http://localhost:8081/aspek/${classIdToUpdate}`;
            const response = await axios.put(updateUrl, updatedData);

            // Periksa status respons
            expect(response.status).to.equal(200);
        } catch (error) {
            throw new Error(error.response ? error.response.data : error.message);
        }
    });
});
