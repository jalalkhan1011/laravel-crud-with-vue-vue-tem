import Home from './Pages/Home.vue';
import PostList from './Pages/post/index.vue';
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
    }
];