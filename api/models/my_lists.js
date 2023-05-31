const Sequelize = require('sequelize');
module.exports = function (sequelize, DataTypes) {
  return sequelize.define('my_lists', {
    id: {
      autoIncrement: true,
      type: DataTypes.INTEGER,
      allowNull: false,
      primaryKey: true
    },
    user_id: {
      type: DataTypes.STRING(36),
      allowNull: false,
      defaultValue: ""
    },
    list_id: {
      type: DataTypes.STRING(255),
      allowNull: false,
      defaultValue: ""
    },

    name: {
      type: DataTypes.STRING(255),
      allowNull: true
    },

  }, {
    sequelize,
    tableName: 'my_lists',
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
