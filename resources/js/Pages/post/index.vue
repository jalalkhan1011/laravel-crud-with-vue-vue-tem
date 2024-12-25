<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card mt-5">
          <div class="card-header">
            <div class="row">
              <div class="col-md-6">Post list</div>
              <div class="col-md-6 text-end">
                <router-link
                  :to="{ name: 'post.create' }"
                  class="btn btn-sm btn-info text-white font-bold"
                  >Post Create</router-link
                >
              </div>
            </div>
          </div>
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>#Sl</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(post, key) in posts" :key="post.id">
                  <td>{{ key + 1 }}</td>
                  <td>{{ post.title }}</td>
                  <td>{{ post.description }}</td>
                  <td>
                    <a href="#" class="btn btn-primary">Edit</a>
                    <a href="#" class="btn btn-danger">Delete</a>
                  </td>
                </tr>
              </tbody>
            </table>
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
      posts: [],
    };
  },
  mounted() {
    this.getPosts();
  },
  methods: {
    async getPosts() {
      let res = await axios.get("/api/posts");
      this.posts = res.data.posts;
    },
    async deletePost(id) {
      let res = await axios.delete(`/api/posts/delete/${id}`);
      this.getPosts();
      toastr.success(res.data.message);
    },
  },
};
</script>

<style></style>
