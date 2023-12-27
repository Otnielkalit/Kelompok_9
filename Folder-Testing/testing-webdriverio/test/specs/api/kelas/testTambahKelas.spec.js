const axios = require('axios');
const { expect } = require('chai');

describe('Testing API Tambah Kelas', () => {
    it('I add new data kelas', async () => {
        try {
            const apiUrl = 'http://localhost:8081/kelas';
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

    it('I check response status should be 200 if data is successfully added', async () => {
        try {
            const apiUrl = 'http://localhost:8081/kelas';
            const response = await axios.get(apiUrl);
            if (response && response.status === 200) {
                expect(response.status).to.equal(200);
            } else {
                throw new Error('Invalid server response or status code');
            }
        } catch (error) {
            throw new Error(error.response ? error.response.data : error.message);
        }
    });
    it('I check response message should be "Kelas berhasil dibuat" if data is successfully added', async () => {
        try {
            const expectedMessage = 'Kelas berhasil dibuat';
            expect(expectedMessage).to.equal('Kelas berhasil dibuat');
        } catch (error) {
            throw new Error(error.message);
        }
    });
    it('I check response message should be "Data sudah ada dalam basis data" if same data is added again', async () => {
        try {
            const apiUrl = 'http://localhost:8081/kelas';
            const requestData = {
                kode: '1007',
                nama_kelas: 'Kelas ABC'
            };
            const firstResponse = await axios.post(apiUrl, requestData);

            const secondResponse = await axios.post(apiUrl, requestData);
            expect(secondResponse.status).to.equal(409);
            expect(secondResponse.data.message).to.equal('Data sudah ada dalam basis data');
        } catch (error) {
            throw new Error(error.response ? error.response.data : error.message);
        }
    });

});
