const {expect} = require('chai');

module.exports = {
  loginBO() {
    it('should login in BO', async function () {
      await this.pageObjects.loginPage.goTo(global.BO.URL);
      await this.pageObjects.loginPage.login(global.BO.EMAIL, global.BO.PASSWD);
      const pageTitle = await this.pageObjects.dashboardPage.getPageTitle();
      await expect(pageTitle).to.contains(this.pageObjects.dashboardPage.pageTitle);
      await this.pageObjects.boBasePage.closeOnboardingModal();
    });
  },
};
