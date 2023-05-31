var DataTypes = require("sequelize").DataTypes;
var _my_products_list = require("./my_products_list");

function initModels(sequelize) {
  var my_products_list = _my_products_list(sequelize, DataTypes);


  return {
    my_products_list,
  };
}
module.exports = initModels;
module.exports.initModels = initModels;
module.exports.default = initModels;
