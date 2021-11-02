import Vue from "vue";

import VueRouter from "vue-router";

Vue.use(VueRouter);

import Home from "./components/HomeComponent";
import Sample from "./components/SampleComponent";

// import HomeTwo from "./components/HomeTwoComponent";
import Register from "./components/RegisterComponent";
import Login from "./components/LoginComponent";
import Cart from "./components/CartComponent";
// import Product from "./components/ProductComponent";
//import Product from "./components/ProductComponentSix";
import Product from "./components/ProductComponentSeven";
import Sustainability from "./components/SustainabilityComponent";
import Faq from "./components/FaqComponent";
import Policy from "./components/PolicyComponent";
import Contact from "./components/ContactComponent";
// import Postages from "./components/PostagesComponent";
import PostagesTwo from "./components/PostagesComponentTwo";
// import PostagesThree from "./components/PostagesComponentThree";
import About from "./components/AboutComponent";
import Privacy from "./components/PrivacyComponent";
import MessageService from "./components/MessageServiceComponent";
import ProductsList from "./components/ProductsListComponent";

//user
// import OrderConfirmation from "./components/user/OrderConfirmationComponent";
// import CheckAddress from "./components/user/CheckAddressComponent";
// import HomeAddress from "./components/user/HomeAddressComponent";
// import OtherAddress from "./components/user/OtherAddressComponent";
// import ChangeAddress from "./components/ChangeAddressComponent";
// import Checkout from "./components/user/CheckoutComponent";
import OrderSummary from "./components/user/OrderSummaryComponent";
// import NewAddress from "./components/user/NewAddressComponent";
import Order from "./components/user/OrderComponent";
import OrderDetails from "./components/user/OrderDetailsComponent";
import Profile from "./components/user/edit/EditProfileComponent";

//guest
import GuestCheckAddress from "./components/guest/GuestCheckAddressComponent";
// import GuestOrderConfirmation from "./components/guest/GuestOrderConfirmationComponent";
// import GuestCheckout from "./components/guest/GuestCheckoutComponent";
import GuestRegister from "./components/guest/GuestRegisterComponentTwo";
// import GuestHomeAddress from "./components/guest/GuestHomeAddressComponent";
// import GuestOtherAddress from "./components/guest/GuestOtherAddressComponent";
import GuestOrder from "./components/guest/GuestOrderComponent";
// import ResetForm from "./components/user/password/ResetFormComponent";
import RequestReset from "./components/user/password/RequestResetComponentThree";

//admin
// import ShipmentsList from "./components/admin/ShipmentsListComponent";
// import OrdersList from "./components/admin/OrdersListComponent";
// import EachOrder from "./components/admin/EachOrderComponent";

const routes = [
    // {
    //     path: "/" ,
    //     name: "hometwo" ,
    //     component: HomeTwo
    // },
    
    {
        path: "/",
        name: "home",
        component: Home
    },

    {
        path: "/sample",
        name: "sample" ,
        component: Sample
    },

    {
        path: "/faq",
        name: "faq",
        component: Faq
    },

    {
        path: "/contact",
        name: "contact" ,
        component: Contact
    },

    {
        path: "/policy",
        name: "policy",
        component: Policy
    },
    
    {
        path: "/postage",
        name: "postages",
        component: PostagesTwo
    },

    {
        path: "/about",
        name: "about",
        component: About
    },

    {
        path: "/privacy-policy",
        name: "privacy",
        component: Privacy
    },

    {
        path: "/message-service",
        name: "message-service",
        component: MessageService
    },

    {
        path: "/products-list",
        name: "products-list",
        component: ProductsList
    },

    {
        path: "/guest/register",
        name: "register",
        component: Register
    },

    {
        path: "/guest/login",
        name: "login",
        component: Login
    },

    {
        path: "/cart",
        name: "cart",
        component: Cart
    },

    // {
    //     path: "/carttwo" ,
    //     name: "carttwo" ,
    //     component: CartTwo
    // },

    {
        path: "/products/:id",
        name: "products",
        component: Product
    },

    {
        path: "/sustainability",
        name: "sustainability",
        component: Sustainability
    },

    // {
    //     path: "/guest/order" ,
    //     component: GuestOrder, 
    //         children: [
    //             {
    //                 path: '',
    //                 component: GuestHomeAddress

    //             },
    //             {
    //                 //HomeAddress will be rendered inside GuestOrder's <router-view>
    //                 //when /guest/order/add-home is matched.
    //                 path: "add-home",
    //                 name: "add-home",
    //                 component: GuestHomeAddress, 
    //             },
    //             {
    //                 //OtherAddress will be rendered inside GuestOrder's <router-view>
    //                 //when /guest/order/add-others is matched.
    //                 path: "add-others",
    //                 name: "add-others",
    //                 component: GuestOtherAddress,
    //             },
    //         ]
    // },

    {
        path: "/member/order",
        name: "order",
        component: Order
    },

    {
        path: "/guest/order",
        name: "guest-order",
        component: GuestOrder
    },

    // {
    //     path: "/check-address" ,
    //     component: CheckAddress, 
    //         children: [
    //             {
    //                 path: '',
    //                 component: HomeAddress

    //             },
    //             {
    //                 //HomeAddress will be rendered inside GuestOrder's <router-view>
    //                 //when /guest/order/add-home is matched.
    //                 path: "add-homeaddress",
    //                 name: "add-homeaddress",
    //                 component: HomeAddress, 
    //             },
    //             {
    //                 //OtherAddress will be rendered inside GuestOrder's <router-view>
    //                 //when /guest/order/add-others is matched.
    //                 path: "add-otheraddresses",
    //                 name: "add-otheraddresses",
    //                 component: OtherAddress,
    //             },
    //         ]
    // },

    // {
    //     path: "/edit-home",
    //     name: "edit-home",
    //     component: EditAddress
    // },

    {
        path: "/member/summary",
        name: "order-summary",
        component: OrderSummary
    },

    {
        path: "/member/order-details/:id",
        name: "order-details",
        component: OrderDetails
    },

    {
        path: "/guest-register",
        name: "guest-register",
        component: GuestRegister
    },


    {
        path: "/request-reset",
        name: "request-reset",
        component: RequestReset
    },

    {
        path: "/member/profile",
        name: "profile",
        component: Profile
    },
    
];

export default new VueRouter ({
    //URLに#をつけなくする
    mode: "history",
    routes,
    scrollBehavior () {
        return { x: 0, y: 0 }
    }
});