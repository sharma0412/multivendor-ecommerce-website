const Sequelize = require('sequelize');
module.exports = function(sequelize, DataTypes) {
  return sequelize.define('orders', {
    id: {
      type: DataTypes.CHAR(255),
      allowNull: false,
      defaultValue: "",
      primaryKey: true
    },
    transaction_id: {
      type: DataTypes.STRING(255),
      allowNull: true,
      defaultValue: ""
    },
    vendor_id: {
      type: DataTypes.CHAR(255),
      allowNull: true
    },
    user_id: {
      type: DataTypes.CHAR(255),
      allowNull: true
    },
    user_address_id: {
      type: DataTypes.CHAR(255),
      allowNull: true
    },
    amount: {
      type: DataTypes.FLOAT(8,2),
      allowNull: false
    },
    status: {
      type: DataTypes.TINYINT,
      allowNull: true,
      defaultValue: 0,
      comment: "0=order confirm,1=packing,2=deliviring,3=done"
    },
    type: {
      type: DataTypes.TINYINT,
      allowNull: true,
      defaultValue: 0,
      comment: "1=app,2=web"
    }
  }, {
    sequelize,
    tableName: 'orders',
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
