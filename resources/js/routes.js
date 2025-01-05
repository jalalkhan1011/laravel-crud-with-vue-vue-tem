import Home from './Pages/Home.vue';
import PostList from './Pages/post/index.vue';
import PostCreate from './Pages/post/create.vue';
import PostEdit from './Pages/post/edit.vue';
import DaynamicTable from './Pages/DaynamicTable.vue';
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
        path: "/daynamicTable",
        name: "daynamicTable",
        component: DaynamicTable,
    }
];