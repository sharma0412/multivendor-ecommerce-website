const jwt = require('jsonwebtoken');
const jwtToken = process.env.JWT_SECRET;
const bcrypt = require('bcrypt');
let helper = require("../config/helper");
var randomstring = require("randomstring");
const fetch = require("node-fetch");
const db = require('../models');
const sequelize = require('sequelize');
var uuid = require('uuid').v4;
const Op = sequelize.Op;

const request = require('request');
const cheerio = require('cheerio');
const fs = require('fs');


//models
const Users = db.users;
const UserAddress = db.user_address;
const Banners = db.banners;
const Category = db.category;
const Ordersitem = db.order_item;
const Orders = db.orders;
const OrderLogs = db.order_logs;

const Products = db.products;
const Ratings = db.ratings;
const Vendorproducts = db.vendor_products;
const Categories = db.categories;
const Carts = db.carts;
const Cards = db.cards;
const UsersCards = db.users_cards;

const MyListCategories = db.mylistcategory;


const MyProductsList = db.my_products_list;

const MyLists = db.my_lists;
const Notification = db.notifications;

const salt = 10;


const accessTokenKey = process.env.ACCESS_KEY;
const refreshTokenKey = process.env.REFRESH_KEY;
const accessTokenExp = process.env.TOKEN_EXPIRE;
const refreshTokenExp = process.env.REFRESH_EXPIRE;

const Stripe = require('stripe');
const { use } = require('passport');
const { title } = require('process');
// const notifications = require('./notifications');
const stripe = Stripe(process.env.STRIPE_KEY);
var offset = process.env.OFFSET;
var limit = process.env.LIMIT;


Orders.hasMany(OrderLogs, {
    'foreignKey': 'order_id',
    'targetKey': 'id',
    'as': 'order_status'
});


Products.belongsTo(Users, { 'foreignKey': 'id', 'as': 'store_name' });
Carts.belongsTo(Vendorproducts,
    {
        'foreignKey': 'product_id',
        'targetKey': 'id',
        'as': 'CartVendorproductDetails'
    });

Orders.belongsTo(Ordersitem,
    {
        'foreignKey': 'id',
        'targetKey': 'order_id',
        'as': 'orderDetail'
    });

Carts.hasOne(Products,
    {
        'foreignKey': 'id',
        'targetKey': 'product_id',
        'as': 'Product_Detail'
    });

Products.hasOne(Vendorproducts,
    {
        'foreignKey': 'product_id',
        'as': 'ProductUnits'
    });

Products.hasOne(Vendorproducts,
    {
        'foreignKey': 'product_id',
        'as': 'product_detail'
    });



Users.hasOne(Ratings,
    {
        'foreignKey': 'vendor_id',
        'as': 'store_rating'
    });

Categories.hasOne(Products,
    {
        'foreignKey': 'vendor_id',
        'targetKey': 'id',
        'as': 'productdetail'
    });

Categories.hasOne(Vendorproducts,
    {
        'foreignKey': 'product_id',
        'targetKey': 'id',
        'as': 'productPrise'
    });

Ratings.hasOne(Products,
    {
        'foreignKey': 'id',
        'targetKey': 'vendor_id',
        'as': 'product_Detail'
    });

Category.hasOne(Products,
    {
        'foreignKey': 'cat_id',
        'as': 'Vendor selling product'
    });

Category.hasOne(Vendorproducts,
    {
        'foreignKey': 'product_id',
        'as': 'Product_unit'
    });

Orders.belongsTo(Users,
    {
        'foreignKey': 'user_id',
        'as': 'Order_Pending'
    });

Orders.belongsTo(Users,
    {
        'foreignKey': 'user_id',
        'as': 'Order_delivered'
    });

Ordersitem.belongsTo(Products,
    {
        'foreignKey': 'product_id',
        'as': 'Order_details',
        'targetKey': 'id'
    });

Users.hasOne(Ratings,
    {
        'foreignKey': 'vendor_id',
        'as': 'venodr_category'
    });

Categories.hasMany(Products,
    {
        'foreignKey': 'cat_id',
        'targetKey': 'id',
        'as': 'products'
    });

Vendorproducts.hasMany(Products,
    {
        'foreignKey': 'id',
        'targetKey': 'product_id',
        'as': 'allProducts'
    });

Vendorproducts.hasMany(Products,
    {
        'foreignKey': 'product_id',
        'targetKey': 'id',
        'as': 'relatedProducts'
    });
Vendorproducts.belongsTo(Products,
    {
        'foreignKey': 'id',
        'targetKey': 'product_id',
        'as': 'productDetails'
    });


MyProductsList.hasOne(Categories, {
    'foreignKey': 'id',
    'sourceKey': 'category',
    'as': 'categoriesdetails'
})


login = async (req, res) => {
    try {
        const required = {
            email: req.body.email,
            password: req.body.password
        };
        const nonrequired = {
            deviceType: req.body.deviceType,
            deviceToken: req.body.deviceToken
        };
        let requestdata = await helper.vaildObject(required, nonrequired);
        var salt = 10;
        var user = await Users.findOne({
            where: {
                email: requestdata.email
            }
        });
        if (!user) {
            return helper.error(res, 'This account not registered with us. Please Signup', body);
        } else {
            var passcheck = "";
            await bcrypt.compare(req.body.password, user.password).then(function (result) {
                if (result == true) {
                    passcheck = 1;
                } else {
                    passcheck = 0;
                }
            });
            if (passcheck == 1) {
                const credentials = {
                    id: user.id,
                    email: user.email
                };
                var body = {};
                const token = jwt.sign({ data: credentials }, jwtToken);
                body.token = token
                body.address = user.address
                body.latitude = user.latitude
                body.longitude = user.longitude
                body.is_otp_verified = user.is_otp_verified

                var userdetails = { email: user.email, username: user.username, mobile: user.mobile }
                body.userdetail = userdetails;
                return helper.success(res, 'User login Succefully', body);
            } else {
                return helper.error(res, 'Incorrect email or password', body);
            }
        }
    } catch (err) {
        return helper.error(res, err);
    }
},

    signin = async (req, res) => {
        try {
            console.log(req.body);
            const required = {
                name: req.body.username,
                email: req.body.email,
                mobileno: req.body.mobileno,
                password: req.body.password,
                deviceType: req.body.deviceType,
                deviceToken: req.body.deviceToken
            };
            const nonrequired = {};
            let requestdata = helper.vaildObject(required, nonrequired);
            let email = await Users.findAll({
                attributes: ['email'],
                where: {
                    email: req.body.email
                }
            });
            if (email.length > 0) {
                return helper.error(res, "You account already registered with us. Please Login");
            }
            let salt = 10;
            await bcrypt.hash(req.body.password, salt).then(function (hash) {
                req.body.password = hash;
            });
            req.body.id = uuid();
            req.body.otp = "1596";

            let user = await Users.create(req.body);
            if (user) {
                const credentials = {
                    id: user.id,
                    email: user.email
                };
                var body = {};
                const token = jwt.sign({ data: credentials }, jwtToken);
                body.token = token;
                body.userDetails = user;

                return helper.success(res, 'User created successfully', body, user);
            } else {
                helper.error(res, "Some error occur, Please try again");
            }
        } catch (err) {
            return helper.error(res, err);
        }
    },


    socialLogin = async (req, res) => {
        console.log("******************** socialLogin ******************************");
        try {
            const required = {
                loginType: req.body.loginType,//1-google,2-facebook,3-twitter
                email: req.body.email,//email or some other social login ids
                deviceType: req.body.deviceType,
                deviceToken: req.body.deviceToken
            };
            const nonRequired = {};
            let requestData = await helper.vaildObject(required, nonRequired);
            userID = helper.randomUUID();
            var user = await Users.findOrCreate({
                where: { email: req.body.email },
                defaults: {
                    id: userID,
                    login_type: req.body.loginType,
                    email: req.body.email,
                    device_type: req.body.deviceType,
                    device_token: req.body.deviceToken,
                }, row: true
            })
            var update_device = Users.update(
                {
                    device_type: req.body.device_type,
                    device_token: req.body.device_token
                },
                {
                    where: {
                        email: req.body.email
                    },
                });
            if (user) {
                const credentials = {
                    id: user[0].id,
                    email: user[0].email,
                };
                const token = jwt.sign({ data: credentials }, jwtToken);
                var body = {
                    token: token,
                    user_id: user[0].id,
                    name: user[0].username,
                    email: user[0].email,
                    address: user[0].address,
                    latitude: user[0].latitude,
                    longitude: user[0].longitude,
                    is_otp_verified: user[0].is_otp_verified
                };
                return res.json({ success: 200, message: 'Login successfully', body: body });
            } else {
                return helper.error(res, err);

            }
        } catch (err) {
            return helper.error(res, err);
        }
    },

    banner = async (req, res) => {
        try {
            const banner = await Banners.findAll({
                attributes: ['image'],
                where: {
                    type: 2,
                    status: 1
                }
            });
            return helper.success(res, "Banner listing", banner);
        } catch (err) {
            return helper.error(res, err);
        }
    },



    seeAllCategories = async (req, res) => {

        console.log("******************** seeAllCategories ******************************");

        try {
            const required = { offset: req.query.offset, limit: req.query.limit }
            const nonRequired = {};
            let requestData = await helper.vaildObject(required, nonRequired);


            const categoriesList = await Categories.findAll({

                where: {
                    status: 1
                },
                offset: (!!req.query.offset) ? parseInt(req.query.offset) : parseInt(offset),
                limit: (!!req.query.limit) ? parseInt(req.query.limit) : parseInt(limit)

            });

            const categories = {
                "categories": categoriesList,

            }

            return helper.success(res, "Orders fetched successfully", categories);
        } catch (err) {
            helper.error(res, err);
        }

    },



    seeAllProducts = async (req, res) => {

        console.log("******************** seeAllProducts ******************************");

        try {
            const required = { offset: req.query.offset, limit: req.query.limit }
            const nonRequired = {};
            let requestData = await helper.vaildObject(required, nonRequired);

            const allProducts = await Products.findAndCountAll({

                attributes: ['image', 'name', 'colorcode'],
                include: [

                    {
                        model: Vendorproducts,
                        'as': 'product_detail',
                        attributes: ['selling_price', 'id',
                            [sequelize.literal(` (IFNULL ((select username from users where product_detail.vendor_id = users.id ), 0))`), 'store_name'],

                            [sequelize.literal(` (IFNULL (( select cat_id from products as pID where pID.id =  products.id ), 0))`), 'cat_id'],


                        ]
                    },
                ],
                offset: (!!req.query.offset) ? parseInt(req.query.offset) : parseInt(offset),
                limit: (!!req.query.limit) ? parseInt(req.query.limit) : parseInt(limit)

            });

            const products = {

                "products": allProducts,

            }


            return helper.success(res, "Products fetched successfully", products);
        } catch (err) {
            helper.error(res, err);
        }

    },

    seeAllStores = async (req, res) => {

        console.log("******************** seeAllStores ******************************");

        try {
            const required = { offset: req.query.offset, limit: req.query.limit }
            const nonRequired = {};
            let requestData = await helper.vaildObject(required, nonRequired);


            const allStores = await Users.findAndCountAll({
                attributes: ['profile', 'username', 'address',
                    [sequelize.literal(` (IFNULL (( select avg(rating) from ratings where ratings.vendor_id = users.id ), 0))`), 'rating'],
                ],

                where: {
                    role: 1
                },

                offset: (!!req.query.offset) ? parseInt(req.query.offset) : parseInt(offset),
                limit: (!!req.query.limit) ? parseInt(req.query.limit) : parseInt(limit)

            });

            const stores = {
                "stores": allStores,

            }


            return helper.success(res, "Stores fetched successfully", stores);
        } catch (err) {
            helper.error(res, err);
        }

    },

    catrecstoresorders = async (req, res) => {
        console.log("******************** Recomanded products and recomanded stores ******************************");
        try {
            const categories = await Categories.findAll({
                attributes: ["image", "name", "color", "id"],
                where: {
                    status: 1
                },

            });

            const products = await Products.findAndCountAll({
                attributes: ['image', 'name', 'colorcode',
                ],
                include: [

                    {
                        model: Vendorproducts,
                        'as': 'product_detail',
                        attributes: ['selling_price', 'id',
                            [sequelize.literal(` (IFNULL ((select username from users where product_detail.vendor_id = users.id ), 0))`), 'store_name'],
                            [sequelize.literal(` (IFNULL (( select cat_id from products as pID where pID.id =  products.id ), 0))`), 'cat_id'],
                        ]
                    },
                ],
                limit: 6
            });
         
            var stores = [];
            
            if(req.query.latitude && req.query.longitude){
                const latitude = req.query.latitude;
                const longitude = req.query.longitude;
                const distance = 10;
                
                const haversine = `(
                    6371 * acos(
                        cos(radians(${latitude}))
                        * cos(radians(latitude))
                        * cos(radians(longitude) - radians(${longitude}))
                        + sin(radians(${latitude})) * sin(radians(latitude))
                    )
                )`;
                
               
                var stores = await Users.findAll({
                    attributes: [
                        'id','profile','username','address',
                        [sequelize.literal(` (IFNULL (( select avg(rating) from ratings where ratings.vendor_id = users.id ), 0))`), 'rating'],
                        [sequelize.literal(haversine), 'distance'],
                    ],
                    where: {
                        role: 1
                    },
                    order: sequelize.col('distance'),
                    having: sequelize.literal(`distance <= ${distance}`),
                    limit: 6
                });
            }
            const categoryrecstoresorders = {
                "Categories": categories,
                "Recomanded products": products,
                "Recomanded stores": stores,
            }

            return helper.success(res, "Categories Recomanded products and recomanded stores Listing", categoryrecstoresorders);
        } catch (err) {
            helper.error(res, err);
        }
    },


    location = async (req, res) => {
        try {
            const required = {
                address: req.body.address,
                latitude: req.body.latitude,
                longitude: req.body.longitude
            }
            const nonrequired = {}
            const requestData = await helper.vaildObject(required, nonrequired);

            var updatePass = await Users.update({
                address: req.body.address,
                latitude: req.body.latitude,
                longitude: req.body.longitude
            }, {
                where: {
                    id: req.user.id
                }
            })
            return helper.success(res, "Location updated succesfully");
        } catch (err) {
            return helper.error(res, err);
        }
    },

    updateProfile = async (req, res) => {
        try {
            var required = {}
            var nonrequired = {
                name: req.body.name,
            }
            var requestedData = await helper.vaildObject(required, nonrequired);

            if (req.files && req.files.profile_picture) {
                profile_picture = helper.fileUpload(req.files.profile_picture);
                req.body.profile = `/uploads/${profile_picture}`;
            }
            await Users.update({
                username: req.body.name,
                profile: req.body.profile
            }, {
                where: {
                    id: req.user.id
                }
            })
            return helper.success(res, 'Profile updated successfully')
        } catch (err) {
            return helper.error(res, err)
        }
    },

    shopItemSearch = async (req, res) => {
        try {
            const required = { shop_id: req.query.shop_id }
            const nonRequired = { searchText: req.query.searchText, };
            let requestData = await helper.vaildObject(required, nonRequired);
            const searchItem = await Vendorproducts.findAll({
                attributes: {
                    include: [
                        [sequelize.literal(` (IFNULL ((select name from products where products.id = vendor_products.product_id), 0))`), 'item_name'],
                        [sequelize.literal(` (IFNULL ((select image from products where products.id = vendor_products.product_id), 0))`), 'item_image'],
                        [sequelize.literal(` (IFNULL ((select status from products where products.id = vendor_products.product_id), 0))`), 'item_status'],
                    ]
                },
                where: {
                    where: sequelize.literal("vendor_id = '" + requestData.shop_id + "' having item_name like '%" + req.query.searchText + "%'  ")
                },
            });
            const searchedItems = {
                "items": searchItem,
            }
            return helper.success(res, "Items fetched successfully", searchedItems);
        } catch (err) {
            return helper.error(res, err);
        }
    },

    createOrder = async (req, res) => {
        let orderID = uuid()
        try {
            const required = {
                stripeToken: req.body.stripe_token,
                address: req.body.address,
                latitude: req.body.latitude,
                longitude: req.body.longitude
            }
            const nonRequired = {};
            let requestData = await helper.vaildObject(required, nonRequired);



            const cartItems = await Carts.findAll({
                where: { user_id: req.user.id },
                include: ["CartVendorproductDetails"]
            });


            var orderDetail = await Orders.create({
                id: orderID,
                user_id: req.user.id,
                user_address_id: requestData.address,
                amount: 0
            })


            if (cartItems.length > 0) {
                let totalSellingAmount = 0;
                let totalMarketAmount = 0;

                cartItems.forEach(element => {
                    totalSellingAmount = totalSellingAmount + (parseInt(element.quantity) * parseFloat(element.CartVendorproductDetails.selling_price));
                    totalMarketAmount = totalMarketAmount + (parseInt(element.quantity) * parseFloat(element.CartVendorproductDetails.market_price));
                    Ordersitem.create({
                        id: uuid(),
                        product_id: element.product_id,
                        quantity: element.quantity,
                        order_id: orderID
                    })
                    OrderLogs.create({
                        id: uuid(),
                        order_id: orderID,
                        status: 0
                    })

                    let remaining_value = element.CartVendorproductDetails.remaining_stock - element.quantity;

                    console.log("remaining_value == ", remaining_value);

                    Vendorproducts.update({
                        remaining_stock: remaining_value

                    }, {
                        where: {
                            id: element.product_id
                        }
                    })
                });

                let discount = ([(totalMarketAmount - totalSellingAmount) / totalMarketAmount] * 100).toFixed(2)
                const charge = await stripe.charges.create({
                    amount: parseInt(totalSellingAmount * 100),
                    currency: 'inr',
                    source: requestData.stripeToken,
                    description: 'Payment of ORDERID:: ' + orderDetail.id,
                });

                orderDetail = await Orders.update({
                    transaction_id: charge.id,
                    vendor_id: cartItems[0].vendor_id,
                    amount: totalSellingAmount
                }, {
                    where: {
                        id: orderID
                    }
                })

                UsersCards.findOrCreate({
                    where: { user_id: req.user.id },
                    defaults: {
                        card_id: charge.payment_method,
                        user_id: req.user.id
                    },
                })

                Carts.destroy({ where: { user_id: req.user.id } })
                return helper.success(res, "Order created successfully", { orderID: orderID, transaction_id: charge.id });
            } else {
                Ordersitem.destroy({ where: { order_id: orderID } })
                Orders.destroy({ where: { id: orderID } })
                return helper.error(res, "No items in the cart");
            }
        }
        catch (err) {
            console.log("errrrrrrrrrrrrrrrrrrrrrrrrrrrr", err);
            Ordersitem.destroy({ where: { order_id: orderID } })
            Orders.destroy({ where: { id: orderID } })
            return helper.error(res, "Some error occur. Please try again");
        }
    },

    selectshop = async (req, res) => {
        try {
            const required = { latitude: req.query.latitude, longitude: req.query.longitude, offset: req.query.offset, limit: req.query.limit }
            const nonRequired = { id: req.query.category_id, };
            let requestData = await helper.vaildObject(required, nonRequired);
            let latitudeValue = requestData.latitude
            let longitudeValue = requestData.longitude

            if (req.query.category_id) {
                const shop = await Users.findAll({
                    attributes: ["address", "latitude", "longitude", "profile", "username", "description", "category", "email", "id",
                        [sequelize.literal(`((3956 * ACOS(COS(RADIANS(` + latitudeValue + `)) * COS(RADIANS(users.latitude)) * COS(RADIANS(` + longitudeValue + `) - RADIANS(users.longitude)) + SIN(RADIANS(` + latitudeValue + `)) * SIN(RADIANS(users.latitude) ) ) ))`), 'distance'],
                        [sequelize.literal(` (IFNULL (( select avg(rating) from ratings where ratings.vendor_id = users.id ), 0))`), 'rating'],
                    ],
                    where: {
                        role: 1,
                        status: 1,
                        category: {
                            [Op.like]: '%' + requestData.id + '%'
                        }
                    },
                    offset: (!!req.query.offset) ? parseInt(req.query.offset) : parseInt(offset),
                    limit: (!!req.query.limit) ? parseInt(req.query.limit) : parseInt(limit)
                });

                return helper.success(res, "Select shop and category listing", { "select_shop": shop });
            } else {
                const shop = await Users.findAll({
                    attributes: ["profile", "username", "address", "latitude", "longitude", "description", "category", "email", "id",
                        [sequelize.literal(`((3956 * ACOS(COS(RADIANS(` + latitudeValue + `)) * COS(RADIANS(users.latitude)) * COS(RADIANS(` + longitudeValue + `) - RADIANS(users.longitude)) + SIN(RADIANS(` + latitudeValue + `)) * SIN(RADIANS(users.latitude) ) ) ))`), 'distance'],
                        [sequelize.literal(` (IFNULL (( select avg(rating) from ratings where ratings.vendor_id = users.id ), 0))`), 'rating'],
                    ],
                    where: {
                        role: 1,
                        status: 1,
                    },
                    offset: (!!req.query.offset) ? parseInt(req.query.offset) : parseInt(offset),
                    limit: (!!req.query.limit) ? parseInt(req.query.limit) : parseInt(limit)
                });

                return helper.success(res, "Select shop and category listing", { "select_shop": shop });
            }
        } catch (err) {
            return helper.error(res, err);
        }
    },

    shopDetails = async (req, res) => {
        try {
            const required = { id: req.query.id }
            const nonRequired = {}
            let requestData = await helper.vaildObject(required, nonRequired)

            const shop = await Users.findOne({
                attributes: ["profile", "username", "address", "latitude", "longitude", "description", "category", "email", "id"],
                where: {
                    id: requestData.id,
                },
                include: [
                    {
                        model: Ratings,
                        'as': 'store_rating',
                        attributes: ['rating'],
                    },
                ],
            });
            let shopCategory = shop.dataValues.category;
            var array = shopCategory.split(',');
            const allCategories = await Categories.findAll({
                attributes: ["name", "id", "image"],
                include: [{
                    model: Products,
                    'as': 'products',
                    attributes: ['name', 'image', 'status'],
                    include: [
                        {
                            model: Vendorproducts,
                            'as': 'product_detail',
                            where: { vendor_id: requestData.id }
                        }
                    ]
                }],
                where: { id: { [Op.in]: array }, status: 1 },
            });
            return helper.success(res, "Shop detail fetched successfully", { "shop_detail": shop, "shop_Categories": allCategories });
        } catch (err) {
            return helper.error(res, err);
        }
    },

    itemDetails = async (req, res) => {
        try {
            const required = { id: req.query.id, cat_id: req.query.cat_id }
            const nonRequired = {}
            let requestData = await helper.vaildObject(required, nonRequired)
            const itemDetail = await Vendorproducts.findOne({
                attributes: ["id", "vendor_id", "product_id", "market_price", "selling_price", "unit_name", "description", "stock", "tag", "remaining_stock",
                    [sequelize.literal(` (IFNULL ((select name from products where products.id = vendor_products.product_id), 0))`), 'name'],
                    [sequelize.literal(` (IFNULL ((select image from products where products.id = vendor_products.product_id), 0))`), 'image'],
                    [sequelize.literal(` (IFNULL ((select status from products where products.id = vendor_products.product_id), 0))`), 'status'],
                    [sequelize.literal(` (IFNULL ((select (market_price-selling_price)/market_price*100 from vendor_products as vvv where vvv.id = vendor_products.id), 0))`), 'discount'],
                    [sequelize.literal(` (IFNULL ((select quantity from carts where carts.product_id = vendor_products.id and user_id='` + req.user.id + `' limit 1), 0))`), 'cart_items'],
                    [sequelize.literal(` (IFNULL ((select id from carts where carts.product_id = vendor_products.id and user_id='` + req.user.id + `' limit 1), 0))`), 'cart_id'],
                ],
                where: { id: requestData.id },
            });

            let allRealtedProductId = await Products.findOne({
                attributes: [[sequelize.fn('GROUP_CONCAT', sequelize.col('id')), 'product_id']],
                where: { cat_id: req.query.cat_id },
            });

            let ProductIds = "0";
            if (allRealtedProductId.product_id != null) ProductIds = ProductIds + "," + allRealtedProductId.product_id;
            ProductIds = ProductIds.split(",");

            const relatedProducts = await Vendorproducts.findAll({
                attributes: ["id", "vendor_id", "product_id", "market_price", "selling_price", "qty", "unit_name", "description", "stock", "tag", "remaining_stock",
                    [sequelize.literal(` (IFNULL ((select name from products where products.id = vendor_products.product_id), 0))`), 'name'],
                    [sequelize.literal(` (IFNULL ((select image from products where products.id = vendor_products.product_id), 0))`), 'image'],
                    [sequelize.literal(` (IFNULL ((select status from products where products.id = vendor_products.product_id), 0))`), 'status'],
                    [sequelize.literal(` (IFNULL ((select (market_price-selling_price)/market_price*100 from vendor_products as vvv where vvv.id = vendor_products.id), 0))`), 'discount'],
                    [sequelize.literal(` (IFNULL ((select quantity from carts where carts.product_id = vendor_products.id and user_id=user_id='` + req.user.id + `' limit 1), 0))`), 'cart_items'],
                ],
                where: { product_id: { [Op.in]: ProductIds } },
            });
            return helper.success(res, "item detail fetched successfully", { "item_details": itemDetail, "related_products": relatedProducts });
        } catch (err) {
            return helper.error(res, err);
        }
    },

    myOrders = async (req, res) => {
        try {
            const ongoingOrders = await Orders.findAll({
                where: { user_id: req.user.id, status: 0 },
                attributes: ["id", "transaction_id", "vendor_id", "user_id", "user_address_id", "amount", "status", "type",
                    [sequelize.literal(` (IFNULL ((select username from users where users.id =  orders.user_id limit 1 ), 0))`), 'buyer'],
                ],
            });

            const deliveredOrders = await Orders.findAll({
                where: { user_id: req.user.id, status: 1 },
                attributes: ["id", "transaction_id", "vendor_id", "user_id", "user_address_id", "amount", "status", "type",
                    [sequelize.literal(` (IFNULL ((select username from users where users.id =  orders.user_id limit 1 ), 0))`), 'buyer'],
                ],
            });
            return helper.success(res, "Orders fetched successfully", { "ongoingOrders": ongoingOrders, "deliveredOrders": deliveredOrders });
        } catch (err) {
            return helper.error(res, err);
        }
    },

    orderDetails = async (req, res) => {
        try {
            const required = { id: req.body.id }
            const nonRequired = {};
            let requestData = await helper.vaildObject(required, nonRequired);
            const detail = await Orders.findOne({
                where: { id: requestData.id },
                attributes: ["transaction_id", "vendor_id", "user_id", "user_address_id", "amount", "status", "type",
                    [sequelize.literal(` (IFNULL ((select order_id from order_item where orders.id =  order_item.order_id limit 1 ), 0))`), 'order_id'],
                    [sequelize.literal(` (IFNULL ((select product_id from order_item where orders.id =  order_item.order_id limit 1 ), 0))`), 'product_id'],
                    [sequelize.literal(` (IFNULL ((select quantity from order_item where orders.id =  order_item.order_id limit 1 ), 0))`), 'quantity'],
                    [sequelize.literal(` (IFNULL ((select username from users where users.id =  orders.user_id limit 1 ), 0))`), 'buyer'],

                    [sequelize.literal(` (IFNULL ((select status from order_logs where order_logs.order_id = orders.id limit 1 ), 0))`), 'order_status'],

                ],
            });
            const items = await Ordersitem.findAll({
                attributes: {
                    include: [
                        [sequelize.literal(` (IFNULL ((select name from products where products.id = order_item.product_id), 0))`), 'item_name'],
                        [sequelize.literal(` (IFNULL ((select image from products where products.id = order_item.product_id), 0))`), 'item_image'],
                    ]
                },
                where: { order_id: requestData.id }
            });


            return helper.success(res, "Order details fetched successfully", { "detail": detail, "items": items });
        } catch (err) {
            return helper.error(res, err);
        }
    },




    itemDetails = async (req, res) => {
        console.log("******************** itemDetails..... ******************************");

        try {
            const required = { id: req.query.id, cat_id: req.query.cat_id }
            const nonRequired = {}
            let requestData = await helper.vaildObject(required, nonRequired)

            const itemDetail = await Vendorproducts.findOne({

                attributes: ["id", "vendor_id", "product_id", "market_price", "selling_price", "unit_name", "description", "tag", "remaining_stock",
                    [sequelize.literal(` (IFNULL ((select name from products where products.id = vendor_products.product_id), 0))`), 'name'],
                    [sequelize.literal(` (IFNULL ((select image from products where products.id = vendor_products.product_id), 0))`), 'image'],
                    [sequelize.literal(` (IFNULL ((select status from products where products.id = vendor_products.product_id), 0))`), 'status'],

                    [sequelize.literal(` (IFNULL ((select (market_price-selling_price)/market_price*100 from vendor_products as vvv where vvv.id = vendor_products.id), 0))`), 'discount'],

                    [sequelize.literal(` (IFNULL ((select quantity from carts where carts.product_id = vendor_products.id and user_id='` + req.user.id + `' limit 1), 0))`), 'cart_items'],
                    [sequelize.literal(` (IFNULL ((select id from carts where carts.product_id = vendor_products.id and user_id='` + req.user.id + `' limit 1), 0))`), 'cart_id'],

                ],

                where: {
                    id: requestData.id
                },

            });

            let allRealtedProductId = await Products.findOne({
                attributes: [[sequelize.fn('GROUP_CONCAT', sequelize.col('id')), 'product_id']],
                where: { cat_id: req.query.cat_id },
            });
            let ProductIds = "0";
            if (allRealtedProductId.product_id != null) ProductIds = ProductIds + "," + allRealtedProductId.product_id;
            ProductIds = ProductIds.split(",");
            console.log("ProductIds == ", ProductIds);
            const relatedProducts = await Vendorproducts.findAll({

                attributes: ["id", "vendor_id", "product_id", "market_price", "selling_price", "qty", "unit_name", "description", "stock", "tag", "remaining_stock",
                    [sequelize.literal(` (IFNULL ((select name from products where products.id = vendor_products.product_id), 0))`), 'name'],
                    [sequelize.literal(` (IFNULL ((select image from products where products.id = vendor_products.product_id), 0))`), 'image'],
                    [sequelize.literal(` (IFNULL ((select status from products where products.id = vendor_products.product_id), 0))`), 'status'],

                    [sequelize.literal(` (IFNULL ((select (market_price-selling_price)/market_price*100 from vendor_products as vvv where vvv.id = vendor_products.id), 0))`), 'discount'],

                    [sequelize.literal(` (IFNULL ((select quantity from carts where carts.product_id = vendor_products.id and user_id=user_id='` + req.user.id + `' limit 1), 0))`), 'cart_items'],

                ],

                where: {
                    product_id: { [Op.in]: ProductIds },
                },

            });

            itemDetails = {
                "item_details": itemDetail,
                "related_products": relatedProducts
            }


            return helper.success(res, "item detail fetched successfully", itemDetails);

        }


        catch (err) {
            helper.error(res, err);

        }


    },


    myOrders = async (req, res) => {

        console.log("******************** myOrders ******************************");

        try {
            const required = {}
            const nonRequired = {};
            let requestData = await helper.vaildObject(required, nonRequired);


            const ongoingOrders = await Orders.findAll({

                where: {
                    user_id: req.user.id,
                    status: 0
                },

                attributes: ["id", "transaction_id", "vendor_id", "user_id", "user_address_id", "amount", "status", "type",

                    [sequelize.literal(` (IFNULL ((select username from users where users.id =  orders.user_id limit 1 ), 0))`), 'buyer'],

                ],
            });

            const deliveredOrders = await Orders.findAll({

                where: {
                    user_id: req.user.id,
                    status: 1
                },

                attributes: ["id", "transaction_id", "vendor_id", "user_id", "user_address_id", "amount", "status", "type",

                    [sequelize.literal(` (IFNULL ((select username from users where users.id =  orders.user_id limit 1 ), 0))`), 'buyer'],

                ],
            });

            const myOrders = {

                "ongoingOrders": ongoingOrders,
                "deliveredOrders": deliveredOrders
            }

            return helper.success(res, "Orders fetched successfully", myOrders);
        } catch (err) {
            helper.error(res, err);
        }

    }


orderDetails = async (req, res) => {

    console.log("******************** orderDetailssssssssss ******************************");

    try {

        const required = { id: req.body.id }
        const nonRequired = {};
        let requestData = await helper.vaildObject(required, nonRequired);

        const detail = await Orders.findOne({
            where: { id: requestData.id },

            attributes: ["transaction_id", "vendor_id", "user_id", "user_address_id", "amount", "status", "type",

                [sequelize.literal(` (IFNULL ((select order_id from order_item where orders.id =  order_item.order_id limit 1 ), 0))`), 'order_id'],
                [sequelize.literal(` (IFNULL ((select product_id from order_item where orders.id =  order_item.order_id limit 1 ), 0))`), 'product_id'],
                [sequelize.literal(` (IFNULL ((select quantity from order_item where orders.id =  order_item.order_id limit 1 ), 0))`), 'quantity'],
                [sequelize.literal(` (IFNULL ((select username from users where users.id =  orders.user_id limit 1 ), 0))`), 'buyer'],
            ],
            include: [

                {
                    model: OrderLogs,
                    as: 'order_status',
                    attributes: ["status", "created_at", "updated_at"],

                    where: {
                        order_id: requestData.id,
                    }

                },
            ],

        });
        const items = await Ordersitem.findAll({

            attributes: {
                include: [

                    [sequelize.literal(` (IFNULL ((select selling_price from vendor_products where vendor_products.id = order_item.product_id), 0))`), 'selling_price'],

                    [sequelize.literal(` (IFNULL ((select  products.name from vendor_products  join products on products.id = vendor_products.product_id  where vendor_products.id = order_item.product_id), 0))`), 'item_name'],

                    [sequelize.literal(` (IFNULL ((select  products.image from vendor_products  join products on products.id = vendor_products.product_id  where vendor_products.id = order_item.product_id), 0))`), 'item_image'],

                ]
            },
            where: {
                order_id: requestData.id,
            }

        });

        const orderDetails = {
            "detail": detail,
            "items": items
        }

        return helper.success(res, "Order details fetched successfully", orderDetails);

    } catch (err) {
        helper.error(res, err);
    }


}


searchbyItemName = async (req, res) => {
    console.log("******************** searchbyItemName ******************************");
    try {
        const required = { offset: req.query.offset, limit: req.query.limit }
        const nonRequired = { searchText: req.query.searchText };
        let requestData = await helper.vaildObject(required, nonRequired);
        const products = await Products.findAll({
            attributes: ['image', 'name'],
            include: [
                {
                    model: Vendorproducts,
                    'as': 'product_detail',
                    attributes: ['selling_price', 'description', 'vendor_id', 'product_id', 'id', 'unit_name', 'qty', 'tag', 'stock']
                },
            ],
            where: {
                status: 1,
                name: {
                    [Op.like]: '%' + req.query.searchText + '%'
                }

            },
            offset: (!!req.query.offset) ? parseInt(req.query.offset) : parseInt(offset),
            limit: (!!req.query.limit) ? parseInt(req.query.limit) : parseInt(limit)
        });
        return helper.success(res, "Products fetched successfully", products);
    } catch (err) {
        helper.error(res, err);
    }

},

    forgotpassword = async (req, res) => {
        try {
            const required = { email: req.body.email, }
            const nonRequired = {}
            let requestData = await helper.vaildObject(required, nonRequired);
            var newpassword = await randomstring.generate({
                length: 4,
                charset: 'numeric',
            });
            if (newpassword) {
                console.log("new password: " + newpassword);
                Users.update({
                    confirm_otp: newpassword
                },
                    {
                        where: { email: req.body.email }

                    })
            }
            let url = 'https://api.sendinblue.com/v3/smtp/email';
            let options = {
                method: 'POST',
                headers: {
                    Accept: 'application/json',
                    'Content-Type': 'application/json',
                    'api-key': process.env.SEND_IN_BLUE
                },
                body: JSON.stringify({
                    sender: { name: process.env.APP_NAME, email: process.env.SEND_BY },
                    to: [{ email: requestData.email }],
                    replyTo: { email: process.env.REPLY_TO, name: process.env.REPLY_TO_NAME },
                    htmlContent: '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Password</title></head><body style="font-family: sans-serif;"><div class="forget_password" style="background: #6da62c1c;padding: 30px;width: 80%;margin: 0 auto;"><div class="bottom_content" style="padding: 40px 30px;"><h1 style="margin-top: 0px;text-align: center;color: #4b6198;font-size: 20px;">Your forgot password otp is </h1><h2 style="margin-top: 0px;text-align: center;color: #4b6198;font-size: 20px;">' + newpassword + '</h2></body></html>',
                    subject: `Welcome to ${process.env.APP_NAME}`
                })
            };
            fetch(url, options);
            return helper.success(res, 'email sent succesfully !!');
        } catch (err) {
            return helper.error(res, err);
        }
    },


    confirmOtp = async (req, res) => {
        try {
            var required = { otp: req.body.otp }
            var nonrequired = await helper.vaildObject(required, nonrequired);
            let otp = await Users.findOne({
                where: { email: req.body.email, }
            });
            if (req.body.otp == otp.dataValues.confirm_otp) {
                return helper.success(res, "Otp matched successfully");
            } else {
                return helper.error(res, "Invalid OTP. Please try again");
            }
        }
        catch (err) {
            return helper.error(res, err);
        }
    },


    changePassword = async (req, res) => {
        try {
            var required = {
                oldPassword: req.body.oldPassword,
                newPassword: req.body.newPassword
            }
            var nonrequired = {}
            var requestedData = await helper.vaildObject(required, nonrequired);
            var salt = 10;
            await bcrypt.hash(req.body.newPassword, salt).then(function (hash) {
                req.body.newPassword = hash
            })
            oldPassword = req.body.newPassword
            Users.update({
                password: req.body.newPassword
            },
                {
                    where: { id: req.user.id }

                })
            return helper.success(res, 'Password changed successfully !!')
        } catch (err) {
            return helper.error(res, err)
        }
    },



    newPassword = async (req, res) => {
        try {
            var required = {
                email: req.body.email,
                newPassword: req.body.newPassword
            }
            var nonrequired = {}
            var requestedData = await helper.vaildObject(required, nonrequired);
            var salt = 10;
            await bcrypt.hash(req.body.newPassword, salt).then(function (hash) {
                req.body.newPassword = hash
            })
            await Users.update({
                password: req.body.newPassword
            },
                {
                    where: { email: req.body.email }
                })
            return helper.success(res, 'Password changed successfully !!')
        } catch (err) {
            return helper.error(res, err)
        }
    },




    otpverification = async (req, res) => {
        try {
            var required = { otp: req.body.otp }
            var nonrequired = await helper.vaildObject(required, nonrequired);
            let otp = await Users.findOne({
                where: { email: req.user.email, }
            });
            if (req.body.otp == otp.dataValues.otp) {
                await Users.update({
                    is_otp_verified: 1
                }, {
                    where: { email: req.user.email }
                });
                return helper.success(res, "Otp matched successfully");
            } else {
                return helper.error(res, "Invalid OTP. Please try again");
            }
        }
        catch (err) {
            return helper.error(res, err);
        }
    },

    submitReview = async (req, res) => {
        try {
            var required = { vendor_id: req.body.vendor_id, product_id: req.body.product_id }
            var nonrequired = { rating: req.body.rating, feedback: req.body.feedback }
            var requestedData = await helper.vaildObject(required, nonrequired);
            Ratings.create({
                id: uuid(),
                user_id: req.user.id,
                vendor_id: req.body.vendor_id,
                product_id: req.body.product_id,
                rating: req.body.rating,
                feedback: req.body.feedback
            })
            return helper.success(res, 'Feedback submitted successfully !!.')
        } catch (err) {
            return helper.error(res, err);
        }
    },

    myDetail = async (req, res) => {
        try {
            let myData = await Users.findOne({
                where: { id: req.user.id, }
            });
            return helper.success(res, "Fetch my data succefully", myData);
        } catch (err) {
            return helper.error(res, err);
        }
    },

    myCards = async (req, res) => {
        try {
            let myData = await UsersCards.findAll({
                where: { user_id: req.user.id }
            });
            return helper.success(res, "Cards listing fetched succefully", myData);
        } catch (err) {
            return helper.error(res, err);
        }
    },

    updateaddress = async (req, res) => {
        try {
            const required = {
                id: req.body.id,
                user_id: req.body.user_id,
                address: req.body.address
            }
            const nonrequired = {}
            const requestedata = await helper.vaildObject(required, nonrequired);
            UserAddress.update(req.body, {
                where: { id: req.user.id }
            })
            return helper.success(res, "Address updated successfully")
        } catch (err) {
            return helper.error(res, err)
        }
    },

    addaddress = async (req, res) => {
        try {
            var required = {
                address: req.body.address
            }
            var nonrequired = await helper.vaildObject(required, nonrequired)
            await UserAddress.update(req.body, {
                where: { email: req.user.email }
            })
            return helper.success(res, 'Address added successfully')
        } catch (err) {
            return helper.error(res, err);
        }
    },

    addresslisting = async (req, res) => {
        try {
            const addresslisting = await UserAddress.findAll({})
            return helper.success(res, 'Address listing', addresslisting)
        } catch {
            return helper.error(res, err);
        }
    },

    addtocart = async (req, res) => {
        try {
            const required = {
                user_id: req.body.user_id,
                product_id: req.body.product_id,
                market_price: req.body.market_price,
                product_price: req.body.product_price,
                vendor_id: req.body.vendor_id
            }
            const nonrequired = {}
            const requestedata = await helper.vaildObject(required, nonrequired);
            const carts = await Carts.findOne({
                where: { user_id: req.body.user_id }
            });
            if (carts == null || carts == '' || carts.vendor_id == req.body.vendor_id) {
                let vendorProduct = await Vendorproducts.findOne({
                    where: {
                        id: req.body.product_id
                    }
                })
                const cartsItem = await Carts.findOne({
                    where: {
                        user_id: req.body.user_id,
                        product_id: req.body.product_id,
                    }
                });
                if (!cartsItem) {
                    req.body.quantity = 1;
                    req.body.actual_price = vendorProduct.selling_price;
                    Carts.create(req.body)
                } else {
                    let qty = parseInt(cartsItem.quantity) + 1
                    let actualPrice = vendorProduct.selling_price * qty;
                    Carts.update({
                        quantity: qty,
                        actual_price: actualPrice
                    }, {
                        where: {
                            user_id: req.body.user_id,
                            product_id: req.body.product_id,

                        }
                    })
                }
                return helper.success(res, 'Item added in the cart')
            } else {
                return helper.error(res, 'Please remove the previous item from the cart');
            }
        } catch (err) {
            return helper.error(res, err);
        }
    },


    addtocartv2 = async (req, res) => {
        try {
            const required = {
                product_id: req.body.product_id,
            }
            const nonrequired = { user_id: req.user.id }
            const requestedata = await helper.vaildObject(required, nonrequired);
            let vendorProduct = await Vendorproducts.findOne({
                where: {
                    id: requestedata.product_id
                }
            })
            const carts = await Carts.findOne({
                where: { user_id: requestedata.user_id }
            });
            if (carts == null || carts == '' || carts.vendor_id == vendorProduct.vendor_id) {
                const cartsItem = await Carts.findOne({
                    where: {
                        user_id: requestedata.user_id,
                        product_id: requestedata.product_id,
                    }
                });
                if (!cartsItem) {
                    requestedata.quantity = 1;
                    requestedata.actual_price = requestedata.product_price;
                    Carts.create({
                        vendor_id: vendorProduct.vendor_id,
                        user_id: requestedata.user_id,
                        product_id: requestedata.product_id,
                        product_price: vendorProduct.selling_price,
                        market_price: vendorProduct.market_price,
                        actual_price: vendorProduct.selling_price,
                        quantity: 1,
                    })
                } else {
                    let qty = parseInt(cartsItem.quantity) + 1
                    let actualPrice = vendorProduct.selling_price * qty;
                    Carts.update({
                        quantity: qty,
                        actual_price: actualPrice
                    }, {
                        where: {
                            user_id: requestedata.user_id,
                            product_id: requestedata.product_id,
                        }
                    })
                }
                return helper.success(res, 'Item added in the cart')
            } else {
                return helper.error(res, 'Please remove the previous item from the cart');
            }
        } catch (err) {
            return helper.error(res, err);
        }
    },

    removecart = async (req, res) => {
        try {
            const required = { id: req.body.id }
            const nonRequired = {};
            let requestData = await helper.vaildObject(required, nonRequired);

            const cartsItem = await Carts.findOne({
                where: { id: req.body.id, }
            });
            let qty = parseInt(cartsItem.quantity - 1)
            let actualPrice = cartsItem.product_price * qty;
            if (qty == 0) {
                Carts.destroy({ where: { id: req.body.id, } });
            } else {
                await Carts.update({
                    quantity: qty,
                    actual_price: actualPrice
                }, {
                    where: { id: requestData.id, }
                })
            }
            return helper.success(res, 'Item removed from cart successfully')
        } catch (err) {
            return helper.error(req, err);
        }
    },

    deleteCartList = async (req, res) => {
        try {
            const required = { id: req.body.id }
            const nonRequired = {};
            let requestData = await helper.vaildObject(required, nonRequired);
            Carts.destroy({ where: { id: req.body.id, } });
            return helper.success(res, 'Cart Item deleted successfully')
        } catch (err) {
            return helper.error(req, err);
        }
    },

    cartslisting = async (req, res) => {
        try {
            const cartslisting = await Carts.findAll({
                attributes: {
                    include: [
                        [sequelize.literal(` (IFNULL ((select name from products where products.id = CartVendorproductDetails.product_id), ""))`), 'item_name'],
                        [sequelize.literal(` (IFNULL ((select image from products where products.id = CartVendorproductDetails.product_id), ""))`), 'item_image'],
                        [sequelize.literal(` (IFNULL ((select status from products where products.id = CartVendorproductDetails.product_id), 0))`), 'item_status'],
                    ]
                },
                where: { user_id: req.user.id },
                include: ["CartVendorproductDetails"]
            });
            let grandTotal = [];
            let totalAmount = 0;
            for (var i = 0; i < cartslisting.length; i++) {
                grandTotal.push(parseInt(cartslisting[i].actual_price))
            }
            for (let num of grandTotal) {
                totalAmount = totalAmount + num
            }
            return helper.success(res, 'Cart listing', { "cartItems": cartslisting, "totalAmount": totalAmount })
        } catch (err) {
            return helper.error(res, err)
        }
    },

    paymentmethod = async (req, res) => {
        try {
            const require = {
                id: req.body.id,
                user_id: req.body.user_id,
                card_number: req.body.card_number,
                card_name: req.body.card_name,
                cvv: req.body.cvv,
                date: req.body.date
            }
            const nonrequire = {}
            const requestedata = await helper.vaildObject(require, nonrequire);
            Cards.create(req.body);
            return helper.success(res, 'Card added')
        } catch (err) {
            return helper.error(res, err)
        }
    },

    cardlisting = async (req, res) => {
        try {
            const cardlisting = await Cards.findAll({
                where: { user_id: req.body.user_id }
            });
            return helper.success(res, 'Card listing', cardlisting)
        } catch (err) {
            return helper.error(res, err)
        }
    },

    orderconfirmation = async (req, res) => {
        try {
            let required = {
                transaction_id: req.body.transaction_id,
                user_id: req.body.user_id,
                amount: req.body.amount
            }
            let nonrequired = {}
            let requestedata = await helper.vaildObject(required, nonrequired);
            let order = await Orders.create(req.body)
            for (var i = 0; i < req.body.products.length; i++)
                var orderitem = await Ordersitem.create({
                    product_id: req.body.products[i].product_id,
                    quantity: req.body.products[i].quantity,
                    order_id: order.id
                })
            return helper.success(res, 'Order Confirmed')
        }
        catch (err) {
            return helper.error(res, err)
        }
    },

    myorderpending = async (req, res) => {
        try {
            const orderpending = await Orders.findAll({
                attributes: ["transaction_id"],
                where: { status: 0 },
                include: [{
                    model: Users,
                    'as': 'Order_Pending',
                    attributes: ['username', 'address']
                }]
            });
            return helper.error(res, 'Orders not delivred', orderpending);
        } catch (err) {
            return helper.error(res, err)
        }
    },

    myorderdelivred = async (req, res) => {
        try {
            let orderDel = await Orders.findAll({
                attributes: ["transaction_id"],
                where: { status: 1 },
                include: [{
                    model: Users,
                    'as': 'Order_delivered',
                    attributes: ['username', 'address']
                }]
            })
            return helper.success(res, 'Order delivered', orderDel)
        } catch (err) {
            return helper.error(res, err)
        }
    },

    orderdetail = async (req, res) => {
        try {
            const orderdetail = await Ordersitem.findAll({
                attributes: ["product_id"],
                where: { product_id: req.body.product_id },
                include: [{
                    model: Products,
                    'as': 'Order_details',
                    attributes: ['name', 'image', 'created_at']
                }]
            });
            return helper.success(res, 'Order detail', orderdetail)
        } catch (err) {
            return helper.error(res, err)
        }
    },

    categoryListingSeeAll = async (req, res) => {
        try {
            const pageAsNumber = Number.parseInt(req.query.page);
            const sizeAsNumer = Number.parseInt(req.query.size);
            let page = 0;
            let size = 10;
            if (!Number.isNaN(pageAsNumber) && pageAsNumber > 0)
                page = pageAsNumber;
            if (!Number.isNaN(sizeAsNumer) && sizeAsNumer > 0 && sizeAsNumer < 10)
                size = sizeAsNumer;
            var categorySeeAll = await Categories.findAll({
                attributes: ['name', 'image'],
                where: { status: 1 },
                limit: size,
                offset: page * size,
            });
            return helper.success(res, 'All category listing', categorySeeAll)
        } catch (err) {
            return helper.error(res, err)
        }
    },


    searchProduct = async (req, res) => {
        try {
            const required = { search: req.query.search }
            const nonRequired = {};
            let requestData = await helper.vaildObject(required, nonRequired);
            const arr = [];
            const products = await Products.findAll({
                attributes: ['name',
                    [sequelize.literal(` (IFNULL ((select selling_price as price from vendor_products where vendor_products.product_id = products.id limit 1 ), 0))`), 'price'],
                    [sequelize.literal(` (IFNULL ((select product_id as link from vendor_products where vendor_products.product_id = products.id limit 1 ), 0))`), 'link'],
                ],
                where: {
                    status: 1,
                    name: {
                        [Op.like]: '%' + requestData.search + '%'
                    }
                },
            });

            return helper.success(res, "Products fetched successfully", products);

        } catch (err) {
            return helper.error(res, err);
        }
    },

    addSearchProducts = async (req, res) => {
        try {
            var required = {
                name: req.body.name,
                category: req.body.category,
                quantity: req.body.quantity,
                listo_product: req.body.listo_product,
                list_id: req.body.list_id,
            }
            var nonrequired = {
                product_id: req.body.product_id,
            }
            var requestedData = await helper.vaildObject(required, nonrequired);

            let product = await MyProductsList.findAll({
                attributes: ['category', 'name'],
                where: {
                    category: req.body.category,
                    name: req.body.name,


                }
            });
            if (product.length > 0) {
                return helper.error(res, "product already added with this name and category");
            }
            await MyProductsList.create({
                id: uuid(),
                user_id: req.user.id,
                name: requestedData.name,
                category: requestedData.category,
                quantity: requestedData.quantity,
                listo_product: requestedData.listo_product,
                product_id: requestedData.product_id,
                list_id: req.body.list_id,

            })
            return helper.success(res, 'Product added successfully !!.')
        } catch (err) {
            return helper.error(res, err);
        }
    },

    product_offer = async (req, res) => {
        try {
            var required = {
                search: req.query.search
            }
            var nonrequired = {}
            var requestData = await helper.vaildObject(required, nonrequired);
            let totalPro = 0;
            var prod = [];
            var arr = [];
            var product = await db.sequelize.query("SELECT products.name,vendor_products.selling_price AS price,vendor_products.id AS link, 'Listo' AS source FROM  vendor_products JOIN products ON products.`id` = `vendor_products`.`product_id` WHERE products.`name` LIKE '%" + requestData.search + "%'", {
                type: db.sequelize.QueryTypes.SELECT
            });
            product.forEach((element, index) => {
                product[index].price = "£" + element.price;
            });
            if (product.length > 0) {
                prod.push({ title: "Listo", value: product });
            }
            totalPro = totalPro + parseInt(product.length);
            product = request("https://www.falcononline.co.uk/catalogsearch/result/?q=" + requestData.search, function (err, response, body) {
                if (err) {
                    return helper.success(res, "Products fetched successfully", arr);
                } else {
                    let $ = cheerio.load(body);
                    let count = 0;
                    $('li.product-item').each(function (index) {
                        const link = $(this).find('a.product-item-link').attr('href');
                        let name = (($(this).find('a.product-item-link').text()).replaceAll('  ', '')).replaceAll("\n", '');
                        let price = (($(this).find('div.price-final_price').text()).replaceAll('  ', '')).replaceAll("\n", '');
                        arr.push({ name: name, price: price, link: link, source: "falcononline" });
                    });
                    if (arr.length > 0) {
                        prod.push({ title: "falcononline", value: arr });
                    }
                    totalPro = totalPro + parseInt(arr.length);
                    product = request("https://veenas.com/search?q=" + requestData.search, function (err, response, body) {
                        if (err) {
                            return helper.success(res, "Products fetched successfully", arr);
                        } else {
                            let $ = cheerio.load(body);
                            let count = 0;
                            $('li.productgrid--item').each(function (index) {
                                const link = $(this).find('h2.productitem--title>a').attr('href');
                                let name = (($(this).find('h2.productitem--title>a').text()).replaceAll('  ', '')).replaceAll("\n", '');
                                let price = ((($(this).find('div.productitem--price>div.price--main').text()).replaceAll('  ', '')).replaceAll("\n", '')).replaceAll("from ", '');
                                arr.push({ name: name, price: price, link: link, source: "veenas" });
                            });
                            if (arr.length > 0) {
                                prod.push({ title: "veenas", value: arr });
                            }
                            totalPro = totalPro + parseInt(arr.length);
                            return helper.success(res, "Products fetched successfully", { product: prod, total: totalPro });
                        }
                    });
                }
            });
        } catch (err) {
            return helper.error(res, err);
        }
    },


    getMyProducts = async (req, res) => {
        try {
            var required = { offset: req.query.offset, limit: req.query.limit, list_id: req.query.listId }
            var nonrequired = {}
            var requestedData = await helper.vaildObject(required, nonrequired);
            const productsList = await MyProductsList.findAll({
                include: ["categoriesdetails"],
                where: {
                    user_id: req.user.id,
                    list_id: req.query.listId
                },
                offset: (!!req.query.offset) ? parseInt(req.query.offset) : parseInt(offset),
                limit: (!!req.query.limit) ? parseInt(req.query.limit) : parseInt(limit)
            });
            return helper.success(res, 'Product list fetched successfully', productsList)
        } catch (err) {
            return helper.error(res, err)
        }
    },

    removeProductList = async (req, res) => {
        try {
            var required = { id: req.body.id }
            var nonrequired = {}
            var requestedData = await helper.vaildObject(required, nonrequired);
            MyProductsList.destroy({ where: { id: req.body.id } })
            return helper.success(res, 'Product deleted successfully !!.')
        } catch (err) {
            return helper.error(res, err);
        }
    },

    myListCategories = async (req, res) => {
        try {
            var required = {}
            var nonrequired = {}
            var requestedData = await helper.vaildObject(required, nonrequired);

            const myListCategories = await MyListCategories.findAll({
                where: {
                    status: 1
                },

            });
            return helper.success(res, 'Categories list fetched successfully', myListCategories)
        } catch (err) {
            return helper.error(res, err)
        }
    },


    addMyList = async (req, res) => {
        try {
            var required = {
                name: req.body.name,

            }
            var nonrequired = {

            }
            var requestedData = await helper.vaildObject(required, nonrequired);
            await MyLists.create({
                list_id: helper.randomUUID(),
                user_id: req.user.id,
                name: requestedData.name,


            })
            return helper.success(res, 'List added successfully !!.')
        } catch (err) {
            return helper.error(res, err);
        }
    },

    editMyList = async (req, res) => {
        try {
            var required = {
                name: req.body.name,
                listId: req.body.listId,
            }
            var nonrequired = {
            }
            var requestedData = await helper.vaildObject(required, nonrequired);

            var updateList = MyLists.update(
                {
                    name: requestedData.name,

                },
                {
                    where: {
                        user_id: req.user.id,
                        id: req.body.listId
                    },
                });
            return helper.success(res, 'List updated successfully !!.')
        } catch (err) {
            return helper.error(res, err);
        }
    },

    fetchMyLists = async (req, res) => {
        try {
            var required = {}
            var nonrequired = {}
            var requestedData = await helper.vaildObject(required, nonrequired);

            const myAllLists = await MyLists.findAll({
                where: { user_id: req.user.id },

                attributes: ['id', 'user_id', 'list_id', 'name', 'created_at', 'updated_at',
                    [sequelize.literal(` (IFNULL ((select count(*) from my_products_list where my_lists.list_id = my_products_list.list_id ), 0))`), 'total_items'],

                ],
            });
            let data = myAllLists.reverse();
            return helper.success(res, 'Lists fetched successfully', data)
        } catch (err) {
            return helper.error(res, err)
        }
    },

    deleteMyList = async (req, res) => {
        console.log("*********** deleteMyList ************");
        try {
            var required = {
                id: req.body.id,

            }
            var nonrequired = {}
            var requestedData = await helper.vaildObject(required, nonrequired);

            MyLists.destroy({ where: { list_id: req.body.id, } });

            MyProductsList.destroy({ where: { list_id: req.body.id, } });

            return helper.success(res, 'List Deleted successfully')
        } catch (err) {
            return helper.error(res, err)
        }

    },




    boughtProduct = async (req, res) => {
        try {
            var required = {
                status: req.body.status, //0-not bought,2-bought
                id: req.body.id,

            }
            var nonrequired = {
            }
            var requestedData = await helper.vaildObject(required, nonrequired);

            var updateList = MyProductsList.update(
                {
                    status: req.body.status,

                },
                {
                    where: {
                        user_id: req.user.id,
                        id: req.body.id
                    },
                });
            if (req.body.status == "1") {
                return helper.success(res, 'Product successfully added to bought !!.')

            } else {
                return helper.success(res, 'Product successfully removed from boughted !!.')

            }
        } catch (err) {
            return helper.error(res, err);
        }
    },
    allcomplete = async (req, res) => {
        try {
            var required = {
                status: req.body.status, //0-not bought,2-bought
                id: req.body.id,
            }
            var nonrequired = {
            }
            var requestedData = await helper.vaildObject(required, nonrequired);

            var updateList = MyProductsList.update(
                {
                    status: req.body.status,

                },
                {
                    where: {
                        user_id: req.user.id,
                        list_id: req.body.id
                    },
                });
            if (req.body.status == "1") {
                return helper.success(res, 'Product successfully added to bought !!.')

            } else {
                return helper.success(res, 'Product successfully removed from boughted !!.')

            }
        } catch (err) {
            return helper.error(res, err);
        }
    },



    notificationList = async (req, res) => {
        try {
            // console.log(req.user.id)
            var notification = await  Notification.findAll(
                {
                    where: {
                        receiver_id: req.user.id,
                    },
                });
        return helper.success(res, 'Notification list get successfully',notification)
        } catch (err) {
            return helper.error(res, err);
        }
    },

    module.exports = {
        login,
        signin,
        banner,
        catrecstoresorders,
        location,
        selectshop,
        shopDetails,
        shopItemSearch,
        itemDetails,
        forgotpassword,
        changePassword,
        otpverification,
        updateProfile,
        addtocart,
        addtocartv2,
        updateaddress,
        addaddress,
        addresslisting,
        removecart,
        cartslisting,
        paymentmethod,
        cardlisting,
        orderconfirmation,
        myorderpending,
        myorderdelivred,
        orderdetail,
        categoryListingSeeAll,
        myDetail,
        deleteCartList,
        searchbyItemName,
        createOrder,
        myOrders,
        orderDetails,
        submitReview,
        myCards,
        seeAllCategories,
        seeAllProducts,
        seeAllStores,
        confirmOtp,
        newPassword,
        searchProduct,
        addSearchProducts,
        getMyProducts,
        removeProductList,
        product_offer,
        socialLogin,
        myListCategories,
        addMyList,
        fetchMyLists,
        editMyList,
        boughtProduct,
        allcomplete,
        deleteMyList,
        notificationList
    }

