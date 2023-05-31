var express = require('express');
var AuthenticationController = require('../controller/AuthenticationController.js');
const requireAuthentication = require("../passport").authenticateUser;
var router = express.Router();
const passport = require('passport');

router.post('/login', AuthenticationController.login);
router.post('/signin', AuthenticationController.signin);
router.post('/socialLogin', AuthenticationController.socialLogin);
router.get('/banner', AuthenticationController.banner);
router.get('/myDetail', requireAuthentication, AuthenticationController.myDetail);
router.get('/catrecstoresorders', requireAuthentication, AuthenticationController.catrecstoresorders);
router.post('/location', requireAuthentication, AuthenticationController.location);
router.get('/selectshop', requireAuthentication, AuthenticationController.selectshop);
router.get('/shopdetails', requireAuthentication, AuthenticationController.shopDetails);
router.get('/shopItemSearch', requireAuthentication, AuthenticationController.shopItemSearch);
router.get('/cartslisting', requireAuthentication, AuthenticationController.cartslisting);
router.get('/itemDetails', requireAuthentication, AuthenticationController.itemDetails);
router.post('/deleteCartList', requireAuthentication, AuthenticationController.deleteCartList);
router.get('/searchbyItemName', requireAuthentication, AuthenticationController.searchbyItemName);
router.post('/createOrder', requireAuthentication, AuthenticationController.createOrder);
router.get('/myOrders', requireAuthentication, AuthenticationController.myOrders);
router.get('/myCards', requireAuthentication, AuthenticationController.myCards);
router.post('/orderDetails', requireAuthentication, AuthenticationController.orderDetails);
router.post('/submitReview', requireAuthentication, AuthenticationController.submitReview);
router.post('/forgotpassword', AuthenticationController.forgotpassword);
router.post('/confirmOtp', AuthenticationController.confirmOtp);
router.post('/changePassword', requireAuthentication, AuthenticationController.changePassword);
router.post('/newPassword', AuthenticationController.newPassword);
router.post('/otpverification', requireAuthentication, AuthenticationController.otpverification);
router.post('/updateProfile', requireAuthentication, AuthenticationController.updateProfile);
router.post('/addtocart', requireAuthentication, AuthenticationController.addtocart);
router.post('/addtocartv2', requireAuthentication, AuthenticationController.addtocartv2);
router.put('/updateaddress', requireAuthentication, AuthenticationController.updateaddress);
router.post('/addaddress', requireAuthentication, AuthenticationController.addaddress);
router.get('/addresslisting', requireAuthentication, AuthenticationController.addresslisting);
router.post('/removecart', requireAuthentication, AuthenticationController.removecart);
router.post('/paymentmethod', requireAuthentication, AuthenticationController.paymentmethod);
router.get('/cardlisting', requireAuthentication, AuthenticationController.cardlisting);
router.post('/orderconfirmation', requireAuthentication, AuthenticationController.orderconfirmation);
router.get('/myorderpending', requireAuthentication, AuthenticationController.myorderpending);
router.get('/myorderdelivred', requireAuthentication, AuthenticationController.myorderdelivred);
router.get('/orderdetail', requireAuthentication, AuthenticationController.orderdetail);
router.get('/seeAllCategories', requireAuthentication, AuthenticationController.seeAllCategories);
router.get('/seeAllProducts', requireAuthentication, AuthenticationController.seeAllProducts);
router.get('/seeAllStores', requireAuthentication, AuthenticationController.seeAllStores);

router.get('/myListCategories', requireAuthentication, AuthenticationController.myListCategories);


// my list
router.get('/searchProduct', requireAuthentication, AuthenticationController.searchProduct);
router.get('/product_offer', requireAuthentication, AuthenticationController.product_offer);
router.post('/addSearchProducts', requireAuthentication, AuthenticationController.addSearchProducts);
router.get('/getMyProducts', requireAuthentication, AuthenticationController.getMyProducts);
router.post('/removeProductList', requireAuthentication, AuthenticationController.removeProductList);

router.post('/addMyList', requireAuthentication, AuthenticationController.addMyList);
router.get('/fetchMyLists', requireAuthentication, AuthenticationController.fetchMyLists);
router.post('/editMyList', requireAuthentication, AuthenticationController.editMyList);
router.post('/boughtProduct', requireAuthentication, AuthenticationController.boughtProduct);
router.post('/allcomplete', requireAuthentication, AuthenticationController.allcomplete);

router.post('/deleteMyList', requireAuthentication, AuthenticationController.deleteMyList);

router.get('/notificationList', requireAuthentication, AuthenticationController.notificationList);

module.exports = router