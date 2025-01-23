import Home from './Pages/Home.vue';
import PostList from './Pages/post/index.vue';
import PostCreate from './Pages/post/create.vue';
import PostEdit from './Pages/post/edit.vue';
import ProductPurchaseList from './Pages/daynamicTable/index.vue';
import DaynamicTable from './Pages/daynamicTable/DaynamicTableold.vue';
import ProductPurchaseEdit from './Pages/daynamicTable/edit.vue';
export const routes= [
    {
        path: "/", 
        name: "dashboard",
        component: Home,
    },
    {
        path: "/posts",
        name: "post",
        component: PostList,
    },
    {
        path: "/posts/create",
        name: "post.create",
        component: PostCreate,
    },
    {
        path: "/posts/:id/edit",
        name: "post.edit",
        component: PostEdit,
    },
    {
        path: "/productPurchase",
        name: "productPurchase",
        component: ProductPurchaseList,
    },
    {
        path: "/productPurchase/create",
        name: "productPurchase.create",
        component: DaynamicTable,
    },
    {
        path: "/productPurchase/:id/edit",
        name: "productPurchase.edit",
        component: ProductPurchaseEdit,
    }
];