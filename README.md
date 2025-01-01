# 项目名称

> ClassHub，一个面向计算机专业的插件式多班级管家

[![GitHub stars](https://img.shields.io/github/stars/LiYunqingli/ClassHub?style=social)](https://github.com/LiYunqingli/ClassHub/stargazers)
[![GitHub forks](https://img.shields.io/github/forks/LiYunqingli/ClassHub?style=social)](https://github.com/LiYunqingli/ClassHub/network)
[![License](https://img.shields.io/github/license/LiYunqingli/ClassHub)](LICENSE)

---

## 📚 目录

- [项目介绍](#项目介绍)
- [功能特性](#功能特性)
- [安装指南](#安装指南)
- [许可证](#许可证)

---

## 📖 项目介绍

**ClassHub** 是一个面向计算机职业教育的班级管家，旨在更好的班级管理以及为学生提供一个项目开发的平台。该项目提供了一个简单而强大的插件市场以及开发工具，允许学生根据本项目的文档自由的开发插件并且上架插件市场

### 特性

- **高效**：使用传统的前后端分离技术，php使代码部署更加高效
- **简洁**：简洁易懂的API设计，更加符合年轻人的审美
- **跨平台**：回归本质：一个浏览器等于无穷无尽的应用
- **可扩展**：灵活的插件架构，方便二次开发，增加项目的可玩性以及功能的不确定性

---

## 🚀 功能特性

- **特性1**：与传统的定制化校园服务不同，这里真正的能够让校园管理者个性化自己所需要的内容，使服务脱离臃肿
- **特性2**：完全开源免费，无任何广告（署名除外）
- **特性3**：任意平台部署，提前设置好数据库并且打包成压缩包，即使是小白也能轻松部署

---

## 🛠 安装指南

### 前提条件

在开始安装之前，请确保您的系统已安装以下软件：

- [PHP](https://www.php.net/) (v7.1 或更高版本)
- [MySql](https://www.mysql.com/) (v5.7 或更高版本)
- [Nginx](http://nginx.org/) (v1.15 或更高版本)
- [Apache](https://httpd.apache.org/) (可选以替换Nginx作为Web服务器)

### 安装步骤

1. 克隆该仓库：

    ```bash
    git clone https://github.com/LiYunqingli/ClassHub.git
    ```

2. 修改参数：

    ```bash
    cd [clone的目录]/ClassHub/js
    //修改目录下的lib.js第九行为php服务器地址（api地址）
    cd [clone的目录]/ClassHub/php
    //修改目录下的config.json文件，将对应字段按照实际修改
    cd [clone的目录]/ClassHub/SQL
    //将目录下的server.sql导入到MySQL数据库中
    ```

3. 启动项目：

    - 启动Nginx或Apache服务器，并将项目目录指向到克隆的目录
    - 启动MySQL服务器，并且开放本地访问权限，若修改了端口，则修改php目录下的config.json文件，请注意需要保证php能够正确的连接数据库
    - 启动php服务器，并确保php服务器地址与lib.js中的一致
    - 打开浏览器，访问项目地址（127.0.0.1:80/~），即可开始使用

4. 推荐

    - 推荐使用服务器管理面板来快速部署项目，例如1panel和宝塔面板或者小皮面板

<!-- ## 💡 使用方法

### 示例代码

```javascript
const 项目名称 = require('项目名称');

const result = 项目名称.功能();
console.log(result); -->

## 📝 许可证

MIT 许可协议

版权所有 (c) 2024

特此免费授予任何获得本软件及相关文档文件（“软件”）副本的人，允许其在没有任何限制的情况下使用、复制、修改、合并、发布、分发、再许可和/或销售软件副本，并允许向其提供软件的人也可以这样做，前提是满足以下条件：

上述版权声明和本许可声明应包含在软件的所有副本或重要部分中。

软件是“按原样”提供的，不附带任何形式的明示或暗示的担保，包括但不限于对适销性、特定用途适用性和非侵权的担保。在任何情况下，作者或版权持有者均不对因使用或其他交易中产生的任何索赔、损害或其他责任负责，无论是基于合同诉讼、侵权诉讼还是其他方面，均不承担任何责任。