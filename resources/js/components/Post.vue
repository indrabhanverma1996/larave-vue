<template>
    <div>
      <h2>Posts</h2>
      <router-link to="/create">Create Post</router-link>
     <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>description</th>
                    <th>Images</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="post in posts" :key="post.id">
                    <td>{{ post.title }}</td>
                    <td>{{ post.description}}</td>
                 
                    <td style="display: flex; justify-content: space-evenly;"> 
    <img v-for="(item) in post.post_images" :src="'http://127.0.0.1:8000/images/'+item.post_images" width="50px" alt="Post Image" class="preview-image" /></td>
                    
                </tr>
            </tbody>
        </table>
      
      
    </div>
  </template>
  
  <script>
  import axios from 'axios'
  
  export default {
    data() {
      return {
        posts: [],
        
      }
    },
    mounted() {
      this.fetchPosts()
    },
    methods: {
      fetchPosts() {
        axios.get('/api/posts')
          .then(response => {
            this.posts = response.data
         
           
          })
          .catch(error => {
            console.log(error)
          })
      },
      deletePost(id) {
        axios.delete(`/posts/${id}`)
          .then(response => {
            console.log(response.data)
            this.fetchPosts()
          })
          .catch(error => {
            console.log(error)
          })
      }
    }
  }
  </script>
  