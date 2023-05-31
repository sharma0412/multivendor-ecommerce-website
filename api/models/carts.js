const Sequelize = require('sequelize');
module.exports = function(sequelize, DataTypes) {
  return sequelize.define('carts', {
    id: {
      autoIncrement: true,
      type: DataTypes.INTEGER,
      allowNull: false,
      primaryKey: true
    },
    vendor_id: {
      type: DataTypes.STRING(255),
      allowNull: true
    },
    user_id: {
      type: DataTypes.STRING(255),
      allowNull: true
    },
    product_id: {
      type: DataTypes.STRING(255),
      allowNull: false,
      defaultValue: ""
    },
    product_price: {
      type: DataTypes.STRING(255),
      allowNull: false,
      defaultValue: "0"
    },
    market_price: {
      type: DataTypes.STRING(255),
      allowNull: false,
      defaultValue: "0"
    },
    actual_price: {
      type: DataTypes.STRING(255),
      allowNull: false,
      defaultValue: "0"
    },
    quantity: {
      type: DataTypes.STRING(255),
      allowNull: false,
      defaultValue: "0"
    }
  }, {
    sequelize,
    tableName: 'carts',
    timestamps: false,
    indexes: [
      {
        name: "PRIMARY",
        unique: true,
        using: "BTREE",
        fields: [
          { name: "id" },
        ]
      },
    ]
  });
};
