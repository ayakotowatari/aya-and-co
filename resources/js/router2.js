import Vue from "vue";

import VueRouter from "vue-router";

Vue.use(VueRouter);

import AdminHome from "./components/admin/orders/OrdersListComponent";
import OrdersList from "./components/admin/orders/OrdersListComponent";
import ShipmentsList from "./components/admin/orders/ShipmentsListComponent";
import GuestOrdersList from "./components/admin/orders/GuestOrdersListComponent";
import GuestShipmentsList from "./components/admin/orders/GuestShipmentsListComponent";
import EachOrder from "./components/admin/orders/EachOrderComponent";
import EachGuestOrder from "./components/admin/orders/EachGuestOrderComponent";
import EachCategory from "./components/admin/products/EachCategoryComponent";
import EachProduct from "./components/admin/products/EachProductComponent";
import ProductsList from "./components/admin/products/ProductsListComponent";
import CategoriesList from "./components/admin/products/CategoriesListComponent";
import CreateCategory from "./components/admin/products/create/CreateCategoryComponent";
import CreateProduct from "./components/admin/products/create/CreateProductComponent";
import CreateCoupon from "./components/admin/coupons/create/CreateCouponComponent";
import CouponsList from "./components/admin/coupons/CouponsListComponent";
import EachCoupon from "./components/admin/coupons/EachCouponComponent";
import Sample from "./components/SampleComponent";

// import HomeTwo from "./components/HomeTwoComponent";
import AdminRegister from "./components/admin/AdminRegisterComponentTwo";
import AdminLogin from "./components/admin/AdminLoginComponent";

const routes = [
    // {
    //     path: "/" ,
    //     name: "hometwo" ,
    //     component: HomeTwo
    // },
    
    {
        path: "/admin/home" ,
        name: "admin-home" ,
        component: AdminHome
    },

    {
        path: "/admin/register" ,
        name: "admin-register" ,
        component: AdminRegister
    },

    {
        path: "/admin/login" ,
        name: "admin-login" ,
        component: AdminLogin
    },

    {
        path: "/admin/orders-list" ,
        name: "orders-list" ,
        component: OrdersList
    },

    {
        path: "/admin/shipments-list" ,
        name: "shipments-list" ,
        component: ShipmentsList
    },

    {
        path: "/admin/each-order/:id" ,
        name: "each-order" ,
        component: EachOrder
    },

    {
        path: "/admin/each-guestorder/:id" ,
        name: "each-guestorder" ,
        component: EachGuestOrder
    },

    {
        path: "/admin/guestorders-list" ,
        name: "guestorders-list" ,
        component: GuestOrdersList
    },

    {
        path: "/admin/guestshipments-list" ,
        name: "guestshipments-list" ,
        component: GuestShipmentsList
    },

    {
        path: "/admin/each-category/:id" ,
        name: "each-category" ,
        component: EachCategory
    },

    {
        path: "/admin/categories-list" ,
        name: "categories-list" ,
        component: CategoriesList
    },

    {
        path: "/admin/products-list" ,
        name: "products-list" ,
        component: ProductsList
    },

    {
        path: "/admin/each-product/:id" ,
        name: "each-product" ,
        component: EachProduct
    },

    {
        path: "/admin/create-category" ,
        name: "create-category" ,
        component: CreateCategory
    },

    {
        path: "/admin/create-product" ,
        name: "create-product" ,
        component: CreateProduct
    },

    {
        path: "/admin/create-coupon" ,
        name: "create-coupon" ,
        component: CreateCoupon
    },

    {
        path: "/admin/coupons-list" ,
        name: "coupons-list" ,
        component: CouponsList
    },

    {
        path: "/admin/each-coupon/:id" ,
        name: "each-coupon" ,
        component: EachCoupon
    },
   
   

];

export default new VueRouter ({
    //URLに#をつけなくする
    mode: "history" ,
    routes,
    scrollBehavior () {
        return { x: 0, y: 0 }
    }
});