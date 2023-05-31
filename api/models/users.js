const Sequelize = require('sequelize');
module.exports = function(sequelize, DataTypes) {
  return sequelize.define('users', {
    id: {
      type: DataTypes.CHAR(255),
      allowNull: false,
      defaultValue: "",
      primaryKey: true
    },
    username: {
      type: DataTypes.STRING(191),
      allowNull: false,
      defaultValue: ""
    },
    is_otp_verified: {
      type: DataTypes.INTEGER,
      allowNull: true,
      defaultValue: 0,
      comment: "0 - not , 1- verified"
    },
    email: {
      type: DataTypes.STRING(191),
      allowNull: false,
      defaultValue: "",
      unique: "users_email_unique"
    },
    email_verified_at: {
      type: DataTypes.DATE,
      allowNull: true
    },
    password: {
      type: DataTypes.STRING(191),
      allowNull: true
    },
    confirm_otp: {
      type: DataTypes.STRING(255),
      allowNull: true,
      defaultValue: ""
    },
    login_type: {
      type: DataTypes.ENUM('1','2','3'),
      allowNull: false,
      defaultValue: "1",
      comment: "1- google, 2-facebook,3-twitter"
    },
    profile: {
      type: DataTypes.STRING(191),
      allowNull: true,
      defaultValue: ""
    },
    mobile: {
      type: DataTypes.STRING(255),
      allowNull: true,
      defaultValue: ""
    },
    address: {
      type: DataTypes.STRING(255),
      allowNull: true,
      defaultValue: ""
    },
    latitude: {
      type: DataTypes.STRING(255),
      allowNull: true,
      defaultValue: ""
    },
    longitude: {
      type: DataTypes.STRING(255),
      allowNull: true,
      defaultValue: ""
    },
    description: {
      type: DataTypes.STRING(255),
      allowNull: true,
      defaultValue: ""
    },
    otp: {
      type: DataTypes.STRING(255),
      allowNull: true,
      defaultValue: ""
    },
    role: {
      type: DataTypes.TINYINT,
      allowNull: false,
      defaultValue: 3,
      comment: "0=admin,1=vendor,2=staff,3=user"
    },
    status: {
      type: DataTypes.TINYINT,
      allowNull: false,
      defaultValue: 1
    },
    category: {
      type: DataTypes.STRING(255),
      allowNull: true,
      defaultValue: ""
    },
    device_type: {
      type: DataTypes.STRING(100),
      allowNull: true
    },
    device_token: {
      type: DataTypes.STRING(255),
      allowNull: true,
      defaultValue: ""
    },
    web_token: {
      type: DataTypes.STRING(255),
      allowNull: true,
      defaultValue: ""
    },
    remember_token: {
      type: DataTypes.STRING(100),
      allowNull: true
    },
    google_id: {
      type: DataTypes.CHAR(255),
      allowNull: true
    },
    facebook_id: {
      type: DataTypes.CHAR(255),
      allowNull: true
    },
    twitter_id: {
      type: DataTypes.CHAR(255),
      allowNull: true
    }
  }, {
    sequelize,
    tableName: 'users',
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
      {
        name: "users_email_unique",
        unique: true,
        using: "BTREE",
        fields: [
          { name: "email" },
        ]
      },
    ]
  });
};
