const helpers = require('../../pages/helpers');
Feature('Sales');

Scenario('@Accounting @Sales recievePayment',({ I, loginAs }) => {
    loginAs('admin');
        helpers.accDashboard();
        helpers.previewTransactions();
        helpers.sales();
        helpers.recievePayment();
}).tag('@Sales');
