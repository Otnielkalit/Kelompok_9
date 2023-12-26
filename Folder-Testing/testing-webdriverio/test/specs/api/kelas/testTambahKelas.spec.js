// const axios = require('axios');
// const { expect } = require('chai');

// describe('Testing API Tambah Kelas', () => {
//     it('should return expected response', async () => {
//         try {
//             const apiUrl = 'http://localhost:8081/kelas';
//             const requestData = {
//                 kode: '1007',
//                 nama_kelas: 'Kelas ABC'
//             };

//             const response = await axios.post(apiUrl, requestData);

//             // Lakukan asersi terhadap respons yang diterima
//             expect(response.status).to.equal(200);
//         } catch (error) {
//             throw new Error(error.response ? error.response.data : error.message);
//         }
//     });
// });

const expect = require('chai').expect;
const axios = require('axios');

describe('API Tests', function () {
  it('should return a successful response', async function () {
    const response = await axios.get('http://localhost:8081/kelas');

    expect(response.status).to.equal(200);
    expect(response.data).to.be.an('array');
    expect(response.data.length).to.be.greaterThan(0);
  });

  it('should return user details by ID', async function () {
    const kelasId = 2;
    const response = await axios.get(`http://localhost:8081/kelas/${kelasId}`);

    expect(response.status).to.equal(200);
    expect(response.data).to.be.an('object');
    expect(response.data.id).to.equal(kelasId);
    expect(response.data.kode).to.be.a('string');
  });

//   it('should create a new user', async function () {
//     const userData = {
//       name: 'John Doe',
//       email: 'john.doe@example.com',
//       age: 30,
//     };

//     const response = await axios.post('https://api.example.com/users', userData);
//     expect(response.status).to.equal(201);
//     expect(response.data).to.be.an('object');
//     expect(response.data.name).to.equal(userData.name);
//     expect(response.data.email).to.equal(userData.email);
//     expect(response.data.age).to.equal(userData.age);
//   });
});
