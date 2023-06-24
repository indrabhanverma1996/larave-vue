

<template>
  <div>
    <h2>Create Post</h2>
    <form @submit.prevent="createPost">
      <div>
        <label for="title">Title</label>
        <input type="text" id="title" v-model="post.title" class="form-control" required>
      </div>
      <div>
        <label for="content">Description</label>
        <textarea id="content" class="form-control" v-model="post.content" required></textarea>
      </div>
      <div>
        <label for="images"> Multi Images</label>
        <input type="file" multiple class="form-control" id="images" @change="onFileChange" required>
        <div v-for="(image, index) in post.images" :key="index">
          <span>{{ image.name }}</span>
          <progress max="100" :value="image.progress"></progress>
        </div>
      </div>
      <div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary">Create</button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      post: {
        title: '',
        content: '',
        images: [], // array to store selected images
      },
    }
  },

  methods: {
    onFileChange(event) {
      const files = Array.from(event.target.files)
      this.post.images = files.map(file => ({
        file,
        progress: 0, // initialize progress to 0 for each image
      }))
    },

    createPost() {
      let formData = new FormData()
      formData.append('title', this.post.title)
      formData.append('content', this.post.content)

      for (let i = 0; i < this.post.images.length; i++) {
        formData.append('images[]', this.post.images[i].file)
      }

      axios.post('api/posts', formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
        onUploadProgress: progressEvent => {
          this.post.images.forEach((image, index) => {
            if (image.progress === 100) return; // Skip if already completed
            image.progress = parseInt(Math.round((progressEvent.loaded / progressEvent.total) * 100))
          })
        },
      })
        .then(response => {
          console.log(response.data)
          this.$router.push('/')
        })
        .catch(error => {
          console.log(error)
        })
    },
  },
}
</script>

<style>
.preview-image {
  max-width: 200px;
  margin-bottom: 10px;
}

progress {
  display: block;
  width: 100%;
  height: 10px;
  margin-top: 5px;
}

progress::-webkit-progress-bar {
  background-color: #e0e0e0;
  border-radius: 4px;
}

progress::-webkit-progress-value {
  background-color: #2196F3;
  border-radius: 4px;
}
</style>
