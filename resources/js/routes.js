import post from './components/Post.vue';
import CreatePost from './components/createPost.vue';
;
 
export const routes = [
    {
        name: 'home',
        path: '/',
        component: post
    },
    {
        name: 'create',
        path: '/create',
        component: CreatePost
    },
    // {
    //     name: 'edit',
    //     path: '/edit/:id',
    //     component: EditProduct
    // }
];