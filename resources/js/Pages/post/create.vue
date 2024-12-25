<template>
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-lg-4"></div>
      <div class="col-md-4 col-lg-4">
        <div class="card mt-5">
          <div class="card-header">
            <div class="row">
              <div class="col-md-6 col-lg-6">Post Create</div>
              <div class="col-md-6 col-lg-6 text-end">
                <router-link
                  :to="{ name: 'post' }"
                  class="btn btn-sm btn-secondary text-white"
                >
                  Post List</router-link
                >
              </div>
            </div>
          </div>
          <div class="card-body">
            <form action="">
              <div class="form-group">
                <label for="title">Title</label
                ><input
                  type="text"
                  class="form-control"
                  name="title"
                  v-model="post.title"
                />
              </div>
              <div class="form-group">
                <label for="description">Description</label
                ><textarea
                  class="form-control"
                  name="description"
                  rows="10"
                  v-model="post.description"
                >
                </textarea>
              </div>
              <div class="form-group mt-2 text-end">
                <button class="btn btn-primary" v-on:click="createPost()">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
import toastr from "toastr";
export default {
  name: "Posts",
  data() {
    return {
      post: {},
    };
  },
  methods: {
    async createPost() {
      try {
        let res = await axios.post("/api/posts", this.post);
        toastr.success("Post created successfully");
        this.post = {};
      } catch (error) {
        let errors = error.response.data.errors;
        for (let key in errors) {
          toastr.error(errors[key]);
        }
      }
    },
  },
};
</script>
<style scoped></style>
