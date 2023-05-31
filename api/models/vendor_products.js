const Sequelize = require('sequelize');
module.exports = function(sequelize, DataTypes) {
  return sequelize.define('vendor_products', {
    id: {
      type: DataTypes.CHAR(255),
      allowNull: false,
      defaultValue: "",
      primaryKey: true
    },
    vendor_id: {
      type: DataTypes.STRING(255),
      allowNull: true
    },
    product_id: {
      type: DataTypes.STRING(255),
      allowNull: true
    },
    market_price: {
      type: DataTypes.FLOAT(8,2),
      allowNull: false
    },
    selling_price: {
      type: DataTypes.FLOAT(8,2),
      allowNull: false
    },
    qty: {
      type: DataTypes.STRING(255),
      allowNull: false,
      defaultValue: ""
    },
    unit_name: {
      type: DataTypes.STRING(255),
      allowNull: false,
      defaultValue: ""
    },
    description: {
      type: DataTypes.STRING(255),
      allowNull: false,
      defaultValue: ""
    },
    stock: {
      type: DataTypes.STRING(255),
      allowNull: false,
      defaultValue: ""
    },
    tag: {
      type: DataTypes.STRING(255),
      allowNull: false,
      defaultValue: ""
    },
    remaining_stock: {
      type: DataTypes.STRING(255),
      allowNull: false,
      defaultValue: ""
    }
  }, {
    sequelize,
    tableName: 'vendor_products',
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
