/*const { expect } = require('@wdio/globals')
const LoginPage = require('../../pageobjects/loginAdmin.page')


describe('My Login application', () => {
    it('should login with valid credentials', async () => {
        await LoginPage.open()
        await LoginPage.login('admin', '121212')
    })

    it('should I redirect to dashboard page', async () => {
        await expect(LoginPage.txtDasboard).toBeDisplayed()
    })
})*/

const { expect } = require('@wdio/globals')
const LoginPage = require('../pageobjects/loginAdmin.page');



describe('My Login application', () => {
    it('should login with valid credentials', async () => {
        await LoginPage.open()
        await LoginPage.login('admin', '121212')
        await expect(LoginPage.txtDashboard).toBeDisplayed()
    })


    /*it('should not login with empty username and empty password', async () => {
        await LoginPage.open();
        await LoginPage.login('', '');        
    });*/

    /*it('should not login with valid username and invalid password', async () => {
        await LoginPage.open()
        await LoginPage.login('admin', '12')
    })*/

    /*it('should not login with invalid username and valid password', async () => {
        await LoginPage.open()
        await LoginPage.login('adm', '121212')
    })*/

    /*it('should not login with invalid username and invalid password', async () => {
        await LoginPage.open()
        await LoginPage.login('adm', '121')
    })*/ 

    /*it('should not login with invalid username and empty password', async () => {
        await LoginPage.open()
        await LoginPage.login('adm', '')
    })*/ 

    /*it('should not login with valid username and empty password', async () => {
        await LoginPage.open()
        await LoginPage.login('admin', '')
    })*/

    /*it('should not login with empty username and invalid password', async () => {
        await LoginPage.open()
        await LoginPage.login('', '121')
    })*/

    /*it('should not login with empty username and valid password', async () => {
        await LoginPage.open()
        await LoginPage.login('', '121212')
    })*/

    //Guru
        /*it('should login with valid credentials', async () => {
            await LoginPage.open()
            await LoginPage.login('guru', 'guru123')
            await expect(LoginPage.txtDashboard).toBeDisplayed()
        })*/
    
    
        /*it('should not login with valid username and invalid password', async () => {
            await LoginPage.open()
            await LoginPage.login('guru', '12')
        })*/
    
        /*it('should not login with invalid username and valid password', async () => {
            await LoginPage.open()
            await LoginPage.login('gur', 'guru123')
        })*/
    
        /*it('should not login with invalid username and invalid password', async () => {
            await LoginPage.open()
            await LoginPage.login('gur', 'gur121')
        })*/
    
        /*it('should not login with invalid username and empty password', async () => {
            await LoginPage.open()
            await LoginPage.login('adm', '')
        })*/ 
    
        /*it('should not login with valid username and empty password', async () => {
            await LoginPage.open()
            await LoginPage.login('admin', '')
        })*/
    
        /*it('should not login with empty username and invalid password', async () => {
            await LoginPage.open()
            await LoginPage.login('', '121')
        })*/
    
        /*it('should not login with empty username and valid password', async () => {
            await LoginPage.open()
            await LoginPage.login('', '121212')
        })*/















});






