const Sequelize = require('sequelize');
module.exports = function(sequelize, DataTypes) {
  return sequelize.define('ratings', {
    id: {
      autoIncrement: true,
      type: DataTypes.INTEGER,
      allowNull: false,
      primaryKey: true
    },
    user_id: {
      type: DataTypes.STRING(255),
      allowNull: false,
      defaultValue: ""
    },
    vendor_id: {
      type: DataTypes.STRING(255),
      allowNull: false,
      defaultValue: ""
    },
    product_id: {
      type: DataTypes.STRING(255),
      allowNull: false,
      defaultValue: ""
    },
    rating: {
      type: DataTypes.STRING(255),
      allowNull: false,
      defaultValue: "",
      comment: "1=website,2app"
    },
    feedback: {
      type: DataTypes.STRING(255),
      allowNull: false,
      defaultValue: "",
      comment: "1=website,2app"
    }
  }, {
    sequelize,
    tableName: 'ratings',
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
