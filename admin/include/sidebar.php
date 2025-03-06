<?php
ob_start();
session_start();
?>
<div class="admin-dashboard container-fluid">
        <div class="row">
            <div class="col-2">
                <div class="side-bar">
                    <ul>
                        <li>
                            <div class="side-bar_card" onclick="controlDropdown(this)">
                                <div class="card-text">
                                <div class="card-img">
                                    <img src="./svg/dashboard.svg" alt="">
                                </div>
                                <a href="?page=dashboard">Bảng điều khiển</a>
                            </div>
                            
                        </li>
                        <li>
                            <div class="side-bar_card" onclick="controlDropdown(this)">
                                <div class="card-text">
                                    <div class="card-img">
                                        <img src="./svg/page.svg" alt="">
                                    </div>
                                    <a href="?page=blog-list" >Bài viết</a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="side-bar_card" onclick="controlDropdown(this)">
                                <div class="card-text">
                                    <div class="card-img">
                                        <img src="./svg/bag.svg" alt="">
                                    </div>
                                    <a >Sản phẩm</a>
                                </div>
                                <div class="angle-down">
                                    <i class="fa-solid fa-angle-down"></i>
                                </div>
                            </div>
                            <ul data-sl="2">
                                <li><a href="?page=product-list">Danh sách sản phẩm</a></li>
                                <li><a href="?page=category">Quản lý danh mục</a></li>
                            </ul>
                        </li>
                        <li>
                            <div class="side-bar_card" onclick="controlDropdown(this)">
                                <div class="card-text">
                                    <div class="card-img">
                                        <img src="./svg/order.svg" alt style="margin-left: -3px;">
                                    </div>
                                    <a href="?page=order-list">Đơn hàng</a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="side-bar_card" onclick="controlDropdown(this)">
                                <div class="card-text">
                                    <div class="card-img">
                                        <img src="./svg/account.svg" alt="">
                                    </div>
                                    <a >Tài khoản</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="admin-page col-9">