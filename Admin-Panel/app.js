const express = require('express');
const app = express();
const bodyParser = require('body-parser');

app.use(bodyParser.urlencoded({extended: true}));
app.set('view engine', 'ejs');
app.use('/assets', express.static('assets'));

app.use('/profile', (req, res, next) => {
    res.render('profile');
});

app.use('/pages-login', (req, res, next) => {
    res.render('profile-login');
});

app.use('/history', (req, res, next) => {
    res.render('history');
});

app.use('/orders', (req, res, next) => {
    res.render('orders');
});

app.use('/inventory', (req, res, next) => {
    res.render('inventory');
});

app.use('/addRetailer', (req, res, next) => {
    res.render('addRetailer');
});

app.use('/addDistributor', (req, res, next) => {
    res.render('addDistrbutor');
});

app.use('/resetPass', (req, res, next) => {
    res.render('resetPass');
});

app.use('/contact', (req, res, next) => {
    res.render('contact');
});

app.use('/addSalesPerson', (req, res, next) => {
    res.render('addSalesPerson');
});

app.use('/setting', (req, res, next) => {
    res.render('setting');
});

app.use('/pages-sign-up', (req, res, next) => {
    res.render('pages-sign-up');
});


app.use('/pages-forgot-password', (req, res, next) => {
    res.render('pages-forgot-password');
});

app.use('/', (req, res, next) => {
    res.render('index', {user_name: "Gitesh Shastri" });
});


module.exports = app;