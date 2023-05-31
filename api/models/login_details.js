const Sequelize = require('sequelize');
module.exports = function(sequelize, DataTypes) {
  return sequelize.define('login_details', {
    id: {
      type: DataTypes.CHAR(255),
      allowNull: false,
      defaultValue: "",
      primaryKey: true
    },
    user_id: {
      type: DataTypes.STRING(191),
      allowNull: false,
      defaultValue: ""
    },
    login_ip: {
      type: DataTypes.STRING(255),
      allowNull: false,
      defaultValue: ""
    },
    country: {
      type: DataTypes.STRING(255),
      allowNull: false,
      defaultValue: ""
    },
    browser: {
      type: DataTypes.STRING(255),
      allowNull: false,
      defaultValue: ""
    },
    login_date: {
      type: DataTypes.STRING(255),
      allowNull: false,
      defaultValue: ""
    },
    login_time: {
      type: DataTypes.STRING(255),
      allowNull: false,
      defaultValue: ""
    }
  }, {
    sequelize,
    tableName: 'login_details',
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
